<?php

/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Welcome to Tueeter');

?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <meta name="format-detection" content="telephone=no"> 
        <title>
            Skillshaat Admin Panel : <?php echo $title_for_layout; ?>
        </title>
<!--        <title>
        <?php //echo SITE_TITLE;  ?> Administrator panel  -:
        <?php //echo $title_for_layout;  ?>
        </title>-->
        <script type="text/javascript">
            window.WEBSITE_URL = "<?php echo WEBSITE_URL; ?>";

        </script>
        <?php echo $this->Html->meta('favicon.ico', 'images/favicon.ico', array('type' => 'icon')); ?>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <?php
        echo $this->Html->css(array('plugins/pageguide/pageguide.css', 'plugins/fullcalendar/fullcalendar.css', 'bootstrap.min.css', 'font-awesome.min.css', 'themify-icons.min.css', 'animate.min.css', 'perfect-scrollbar.min.css', 'switchery.min.css', 'styles', 'plugins', 'themes/theme-1.css'));

        $controller = $this->params['controller'];
        $action = $this->params['action'];
        if ($action != "dashboard") {


            echo $this->Html->script(array('jquery.min.js', 'bootstrap.min.js', 'modernizr.js', 'jquery.cookie.js', 'perfect-scrollbar.min.js', 'switchery.min.js', 'jquery.sparkline.min.js', 'main.js'));
            echo $this->Html->scriptBlock("
		jQuery(document).ready(function () {
                                            Main.init();
                                    });", array('inline' => false));


            $css = array('styles');
            echo $this->Html->css($css);

            echo $this->fetch('meta');
            echo $this->fetch('css');
            echo $this->fetch('script');
            ?>
            <script type="text/javascript">
                var Config = {
                    'Site_URL': "<?php echo $this->webroot; ?>",
                };
                setTimeout(function () {
                    $('.alert').fadeOut('slow');
                }, 5000);




            </script>
        <?php } ?>
    </head>
    <body>
        <div class="progress modal_loader" style="display: none">
            <div class="center_loader">
                <img src="<?php echo WEBSITE_URL; ?>admin/img/loader_image.gif"/>
            </div>
        </div>
        <?php echo $this->fetch('content'); ?>
        <?php //echo $this->element('sql_dump'); ?>
    </body>
</html>
