<?php $this->beginContent('//layouts/main'); ?>
<div class="row-fluid">
    <div class="span12">
        <div class="date_bg"><?php echo date('l jS \of F Y h:i:s A'); ?></div> 
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbCarousel', array(
            'slide' => FALSE,
            'displayPrevAndNext' => false,
            'items' => array(
                //array('image' => Yii::app()->baseUrl . '/images/banner2.jpg', 'label' => '', 'caption' => ''),
                array('image' => Yii::app()->baseUrl . '/images/banner3.jpg', 'label' => '', 'caption' => ''),
                //array('image' => Yii::app()->baseUrl . '/images/banner.jpg', 'label' => '', 'caption' => ''),
            ),
        ));
        ?>
    </div>
</div>
<div class="row-fluid">
    <div class="span12">
        <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'pills', // '', 'tabs', 'pills' (or 'list')
            'stacked' => false, // whether this is a stacked menu
            'items' => array(
                array('label' => $this->get_menu_name(1), 'url' => array('site/index')),
                array('label' => $this->get_menu_name(2), 'url' => array('content/index', 'id' => 2)),
                array('label' => $this->get_menu_name(3), 'url' => array('content/index', 'id' => 3)),
                array('label' => $this->get_menu_name(4), 'url' => array('content/index', 'id' => 4)),
                array('label' => $this->get_menu_name(5), 'url' => array('content/index', 'id' => 5)),
                array('label' => $this->get_menu_name(6), 'url' => array('content/index', 'id' => 6)),
                array('label' => $this->get_menu_name(7), 'url' => array('content/index', 'id' => 7)),
                array('label' => $this->get_menu_name(8), 'url' => array('content/index', 'id' => 8)),
                array('label' => $this->get_menu_name(9), 'url' => array('content/index', 'id' => 9)),
                array('label' => $this->get_menu_name(10), 'url' => array('content/index', 'id' => 10)),
                array('label' => $this->get_menu_name(11), 'url' => array('content/index', 'id' => 11)),
                array('label' => $this->get_menu_name(12), 'url' => array('content/index', 'id' => 12)),
                array('label' => $this->get_menu_name(13), 'url' => array('content/index', 'id' => 13)),
                array('label' => $this->get_menu_name(14), 'url' => array('content/index', 'id' => 14)),
                array('label' => $this->get_menu_name(15), 'url' => array('content/index', 'id' => 15)),
                array('label' => $this->get_menu_name(16), 'url' => array('content/index', 'id' => 16)),
                array('label' => $this->get_menu_name(17), 'url' => array('content/index', 'id' => 17)),
                array('label' => $this->get_menu_name(18), 'url' => array('content/index', 'id' => 18)),
                array('label' => $this->get_menu_name(19), 'url' => array('content/index', 'id' => 19)),
                array('label' => $this->get_menu_name(20), 'url' => array('content/index', 'id' => 20)),
                array('label' => $this->get_menu_name(21), 'url' => array('content/index', 'id' => 21)),
                array('label' => $this->get_menu_name(22), 'url' => array('content/index', 'id' => 22)),
                array('label' => $this->get_menu_name(23), 'url' => array('content/index', 'id' => 23)),
                array('label' => $this->get_menu_name(24), 'url' => array('content/index', 'id' => 24)),
                array('label' => $this->get_menu_name(25), 'url' => array('content/index', 'id' => 25)),
                array('label' => $this->get_menu_name(26), 'url' => array('content/index', 'id' => 26)),
                array('label' => $this->get_menu_name(27), 'url' => array('content/index', 'id' => 27)),
                array('label' => $this->get_menu_name(28), 'url' => array('content/index', 'id' => 28)),
            //array('label' => $this->get_menu_name(29), 'url' => array('content/index', 'id' => 29)),
            ),
            'htmlOptions' => array('style' => 'font-size:16px;height:20px;'),
        ));
        ?>
    </div>
</div>
<div class="hrline">&nbsp;</div>
<div class="row-fluid">
    <div class="span12">
        <div style="float: left; width: 100px; background-color: #D37632; padding: 5px 0px; color: #FFF;">
            <span class="marquee_news_title">&nbsp;&nbsp;Top News:</span>
        </div>
        <div style="float: left; width: 1065px; background-color: #F4F4F4; padding: 5px 0px 5px 5px;">
            <marquee behavior="scroll" onmouseover="this.stop()" onmouseout="this.start()"><?php $this->get_marquee_news(); ?></marquee>
        </div>            
    </div>
</div>
<div class="hrline_top">&nbsp;</div>
<div class="hrline">&nbsp;</div>
<div class="row-fluid">
    <div class="span12">
        <?php if (isset($this->breadcrumbs)): ?>
            <?php
            $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links' => $this->breadcrumbs,
            ));
            ?>
        <?php endif ?> 
    </div>
</div>
<div class="row-fluid">
    <div class="span3">
        <?php $this->get_latest_news(); ?>
        <div class="row-fluid">
            <div class="span12">
                <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fnjbdnews&amp;width=268&amp;height=290&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=true&amp;header=true&amp;appId=252780244860590" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:268px; height:290px;" allowTransparency="true"></iframe>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span12">
                <?php $this->get_advertisement_inner(29); ?>
            </div>
        </div>
    </div>
    <div class="span9">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>