<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController {

    public $userData;

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = 'application.views.layouts.column1';

    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();

    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'users' => array('*'),
                'actions' => array('login'),
            ),
            array('allow',
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function init() {
        /*
          //if you want to use reflection
          $reflection = new ReflectionClass('scholarshipController');
          $methods = $reflection->getMethods();
          //uncomment this if you want to get the class methods with more details
          print "<pre>";
          print_r($methods);
          print "</pre>";
          //uncomment this if you want to get the class methods
          //print_r(get_class_methods($class));

         */
//Yii::app()->theme = Yii::app()->user->getCurrentTheme();
//Yii::app()->theme = 'teacher';
//parent::init();
    }

    public function firstNwords($str, $n) {
        return preg_replace('/((\b\w+\b.*?){' . $n . '}).*$/s', '$1', $str);
    }

    public function get_static_content($content_id) {
        $value = Yii::app()->db->createCommand()
                ->select('introtext')
                ->from('{{content}}')
                ->where('id=' . $content_id)
                ->queryScalar();
        return $value;
    }

    public function get_category_name($id) {
        $value = Yii::app()->db->createCommand()
                ->select('title')
                ->from('{{content_category}}')
                ->where('id=' . $id)
                ->queryScalar();
        return $value;
    }

    public function featured_news_home() {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{content}}')
                ->where('featured=1 AND state=1')
                ->limit('2')
                ->order('created DESC, id DESC')
                ->queryAll();
        $oDbConnection = Yii::app()->db;
        $oCommand = $oDbConnection->createCommand('SELECT id, title FROM {{content}} WHERE featured=1 AND state = 1 ORDER BY created DESC, id DESC LIMIT 2,3');
        $oCDbDataReader = $oCommand->queryAll();

        foreach ($array as $key => $values) {
            echo '<div>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_top_news', 'target' => '_blank')) . '</div>';
            echo '<div class="hr_border">&nbsp;</div>';
            echo '<span style="float:left; margin:5px;">' . CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $values["profile_picture"], $values['title'], array("width" => 80, "height" => 70, 'title' => $values['title'])) . '</span>';
            echo '<span>' . $this->text_cut(htmlspecialchars_decode(CHtml::encode($this->strip_html_tags($values["introtext"]))), 400) . '</span>';
        }

        echo '<ul>';
        foreach ($oCDbDataReader as $key => $values) {
            echo '<li>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_news', 'target' => '_blank')) . '</li>';
        }
        echo '</ul>';
    }

    public function latest_news_home() {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{content}}')
                ->where('state=1')
                ->limit('5')
                ->order('created DESC, id DESC')
                ->queryAll();
        //$oDbConnection = Yii::app()->db;
        //$oCommand = $oDbConnection->createCommand('SELECT id, title FROM {{content}} WHERE state = 1 ORDER BY created DESC, id DESC LIMIT 2,3');
        //$oCDbDataReader = $oCommand->queryAll();
        echo '<div style="border-bottom:1px solid #FFFF00; margin-bottom:10px; font-size:26px;line-height:30px">' . $this->get_menu_name(31) . '</div>';
        foreach ($array as $key => $values) {
            echo '<div>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_top_news', 'target' => '_blank')) . '</div>';
            echo '<div class="hr_border">&nbsp;</div>';
            echo '<span style="float:left; margin:5px;">' . CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $values["profile_picture"], $values['title'], array("width" => 80, "height" => 70, 'title' => $values['title'])) . '</span>';
            echo '<span>' . $this->text_cut(htmlspecialchars_decode(CHtml::encode($this->strip_html_tags($values["introtext"]))), 400) . '</span>';
        }
        /*
          echo '<ul>';
          foreach ($oCDbDataReader as $key => $values) {
          echo '<li>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_news', 'target' => '_blank')) . '</li>';
          }
          echo '</ul>';
         */
    }

    public function get_categories($parent_id) {
        $rValue = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{content_category}}')
                ->where('parent_id=' . $parent_id . ' AND published=1 ')
                ->order('title ASC')
                ->queryAll();
        echo '<table class="table table-bordered table-striped table-hover">';
        echo '<tbody>';
        foreach ($rValue as $key => $values) {
            echo '<tr>';
            echo '<td>';
            echo CHtml::link($values["title"], array('content/category', 'id' => $values["id"]), array());
            echo '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }

    public function strip_html_tags($string) {

        $string = str_replace("\r", ' ', $string);
        $string = str_replace("\n", ' ', $string);
        $string = str_replace("\t", ' ', $string);
        $pattern = '/<[^>]*>/';
        $string = preg_replace($pattern, ' ', $string);
        $string = trim(preg_replace('/ {2,}/', ' ', $string));

        return $string;
    }

    public function text_cut($text, $length = 200, $dots = true) {
        $text = trim(preg_replace('#[\s\n\r\t]{2,}#', ' ', $text));
        $text_temp = $text;
        while (substr($text, $length, 1) != " ") {
            $length++;
            if ($length > strlen($text)) {
                break;
            }
        }
        $text = substr($text, 0, $length);
        return $text . ( ( $dots == true && $text != '' && strlen($text_temp) > $length ) ? '...' : '');
    }

    public function get_news_by_category_home($catid) {
        $model = Content::model()->findAll(
                array(
                    'condition' => 'catid=' . $catid . ' AND state=1',
                    'order' => 'created DESC, id DESC',
                    'limit' => '10'
        ));
        //category title
        echo '<div style="border-bottom:2px solid #666666; margin-bottom:10px;">' . CHtml::link($this->get_category_name($catid), array('content/index', 'id' => $catid), array('class' => 'category_title', 'target' => '_blank')) . '</div>';
        $i = 1;
        echo '<ul>';
        foreach ($model as $key => $values) {
            if ($i == 1) {
                echo '<div>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_top_news', 'target' => '_blank')) . '</div>';
                echo '<div class="hr_border">&nbsp;</div>';
                echo '<p><span style="float:left; margin:5px;">' . CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $values["profile_picture"], $values['title'], array("width" => 80, "height" => 70, 'title' => $values['title'])) . '</span>';
                echo '<span>' . $this->text_cut(htmlspecialchars_decode(CHtml::encode($this->strip_html_tags($values["introtext"]))), 400) . '</span></p>';
            } else {
                echo '<li>' . CHtml::link($values['title'], array('content/view', 'id' => $values['id']), array('class' => 'home_news', 'target' => '_blank')) . '</li>';
            }
            $i++;
        }
        echo '</ul>';
    }

    public function get_advertisement($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{advertisement}}')
                ->where('category_id=' . $catid)
//->limit('1')
                ->order('ordering ASC')
                ->queryAll();

        foreach ($array as $key => $values) {
            echo '<div style="margin-bottom:5px;">';
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/advertisement/' . $values['picture'], $values['title'], array("width" => 370, 'title' => $values['title']));
            echo CHtml::link($banner, $values['link'], array('class' => ''));
            echo '</div>';
        }
    }

    public function get_advertisement_inner($catid) {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{advertisement}}')
                ->where('category_id=' . $catid)
//->limit('1')
                ->order('ordering ASC')
                ->queryAll();

        foreach ($array as $key => $values) {
            echo '<div style="margin-bottom:5px;">';
            $banner = CHtml::image(Yii::app()->baseUrl . '/uploads/advertisement/' . $values['picture'], $values['title'], array("width" => 270, 'title' => $values['title']));
            echo CHtml::link($banner, $values['link'], array('class' => '', 'target' => '_blank'));
            echo '</div>';
        }
    }

    public function get_latest_news() {
        $array = Yii::app()->db->createCommand()
                ->select('*')
                ->from('{{content}}')
                ->where('catid IN (2,3,4,5,6,7,8,9,10,11)')
                ->limit('15')
                ->order('created DESC, id DESC')
                ->queryAll();
        //echo '<h4>Latest News</h4>';
        echo '<ul class="nav nav-tabs nav-stacked">';
        foreach ($array as $key => $values) {
            echo '<li>';
            echo CHtml::link($values['title'], array('content/view', 'id' => $values['id']));
            echo '</li>';
        }
        echo '</ul>';
    }

    public function get_menu_name($id) {
        $value = Yii::app()->db->createCommand()
                ->select('nemu_name')
                ->from('{{menu}}')
                ->where('id=' . $id)
                ->queryScalar();
        return $value;
    }

    public function get_marquee_news() {
        $array = Yii::app()->db->createCommand()
                ->select('id,title')
                ->from('{{content}}')
                ->where('state=1')
                ->limit('20')
                ->order('created DESC, id DESC')
                ->queryAll();
        foreach ($array as $key => $values) {
            echo '<span>';
            echo CHtml::link($values['title'], array('/content/view', 'id' => $values['id']), array('class' => 'home_marquee_news', 'target' => '_blank'));
            echo '</span>';
            echo '<span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>';
        }
    }

    public function get_max_hits_news() {
        $date = new DateTime('30 days ago');
        $pre_sev = $date->format('Y-m-d H:i:s');

        $array = Yii::app()->db->createCommand()
                ->select('id,title,profile_picture')
                ->from('{{content}}')
                ->where('created >="' . $pre_sev . '" AND state=1 AND profile_picture IS NOT NULL')
                ->limit('1')
                ->order('hits DESC, id DESC')
                ->queryAll();
        echo '<div style="border-bottom:1px solid #FFFF00; margin-bottom:10px; font-size:26px;line-height:30px">' . $this->get_menu_name(30) . '</div>';
        echo '<ul class="thumbnails">';
        foreach ($array as $key => $values) {
            echo '<li class="span12">';
            echo '<div class="thumbnail">' . CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $values['profile_picture'], $values['title'], array('title' => $values['title']));
            echo '<div class="caption"><div>' . CHtml::link($values['title'], array('/content/view', 'id' => $values['id']), array('class' => 'home_top_news')) . '</div></div></div>';
            echo '</li>';
        }
        echo '</ul>';
    }

    public function get_max_hits_news2() {
        $date = new DateTime('30 days ago');
        $pre_sev = $date->format('Y-m-d H:i:s');
        $array = Yii::app()->db->createCommand('SELECT id,title,profile_picture FROM {{content}} WHERE state=1 AND created >="' . $pre_sev . '" ORDER BY hits DESC, id DESC LIMIT 2,4')->queryAll();
        foreach ($array as $key => $values) {
            echo '<div>' . CHtml::link('&CircleDot; ' . $values['title'], array('/content/view', 'id' => $values['id']), array('class' => 'home_news')) . '</div>';
        }
        echo '<div style="line-height:20px;">&nbsp;</div>';
    }

}
