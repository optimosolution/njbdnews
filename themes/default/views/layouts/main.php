<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <meta name="author" content="S.M. Saidur Rahman">
        <meta name="generator" content="Optimo Solution" />
        <?php Yii::app()->bootstrap->register(); ?>
        <link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/styles.css" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>        
    </head>
    <body>                
        <div class="container">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $content; ?>
                </div>
            </div> 
        </div>
        <div class="container-fluid" style="padding: 0px;">
            <div class="row-fluid">
                <div class="span12">
                    <div class="bottom">
                        <div class="bottom_text">
                            <div class="span12">
                                <!--<div class="bottom_title">Editor & Publisher: MD Nasir</div>-->
                                <!--<p class="footer_text">132-71st Street ( First Floor) Guttenberg New Jersey, NJ07093 USA, Phone: 201-978-8107, Email: <a href="mailto:njbdnews@outlook.com">njbdnews@outlook.com</a>, <a href="mailto:njbdnews@aol.com">njbdnews@aol.com</a></p>-->
                                <p class="footer_text">Email: <a href="mailto:njbdnews@outlook.com">njbdnews@outlook.com</a>, <a href="mailto:njbdnews@aol.com">njbdnews@aol.com</a></p>
                                <p class="footer_text">Copyright &copy; 2012-2017 All Rights Reserved. NJBDNEWS.COM.</p>
                            </div>
                        </div>
                    </div>
                    <div class="copyright">
                        <div class="copyright_text">
                            Designed and Developed by <a href="http://www.optimosolution.com" target="_blank" style="color: #333;">Optimo Solution</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
