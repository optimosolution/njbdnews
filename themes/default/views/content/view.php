<?php
$this->pageTitle = $model->title . '-' . Yii::app()->name;
$this->breadcrumbs = array(
    $this->get_category_name($model->catid) => array('/content/index', 'id' => $model->catid),
    $model->title,
);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=252780244860590";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
<h2><?php echo $model->title; ?></h2>
<p class="news_date"><?php echo date("F j, Y, g:i A", strtotime($model->created)); ?>, Hits: <?php echo $model->hits; ?></p>
<p>
    <?php
	$this->widget('application.extensions.SocialShareButton.SocialShareButton', array(
		'style' => 'horizontal',
		'networks' => array('facebook', 'googleplus', 'linkedin', 'twitter'),
		'data_via' => '', //twitter username (for twitter only, if exists else leave empty) //thumbnail
	));
	?>
</p>
<div style="clear: both;">&nbsp;</div>
<div>
    <span class="" style="margin: 0px 15px 15px 0px; float: left;"><?php echo CHtml::image(Yii::app()->baseUrl . '/uploads/profile_picture/' . $model->profile_picture, '', array("width" => 370)); ?></span>
    <span><?php echo $model->introtext; ?></span>
</div>
<div style="clear: both;">&nbsp;</div>
<div class="fb-comments" data-href="<?php echo 'http://www.njbdnews.com/' . Yii::app()->request->url; ?>" data-width="850" data-num-posts="10"></div>