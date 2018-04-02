<?php

//bootstrap.min.js
echo $this->Html->script(array('jquery.min.js', 'main.js'));

echo $this->Html->css(array('morris'));
?>



<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>
    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->

        <div class="main-content" >
            <div class="wrap-content container" id="container">  
                <?php echo $this->Session->flash(); ?>				
                <div class="container-fluid container-fullw bg-white">

                    <div class="row">



                        <div class="col-sm-12 col-md-12" style="margin-bottom: 10px;"></div>




                        <div class="dashboard_panel">



                            <div class='clear'></div>


                            <div class="col-sm-3">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">

                                        <h2 class="StepTitle">JOB CATEGORY</h2>
                                        <span class="links cl-effect-1"><?php echo $job_categories_active; ?></span>
                                        <p class="links cl-effect-1">
                                         <?php echo $this->Html->link('view more', array('plugin'=>'job_category','controller' => 'job_categories', 'action' => 'index'), array('escape' => false)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-3">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">

                                        <h2 class="StepTitle">TRAINING CATEGORY</h2>
                                        <span class="links cl-effect-1"><?php echo $training_categories_active; ?></span>
                                        <p class="links cl-effect-1">
                                         <?php echo $this->Html->link('view more', array('plugin'=>'training_category','controller' => 'training_categories', 'action' => 'index'), array('escape' => false)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-sm-3">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">

                                        <h2 class="StepTitle">JOB</h2>
                                        <span class="links cl-effect-1"><?php echo $job_active; ?></span>
                                        <p class="links cl-effect-1">
                                         <?php echo $this->Html->link('view more', array('plugin'=>'job','controller' => 'jobs', 'action' => 'index'), array('escape' => false)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="panel panel-white no-radius text-center">
                                    <div class="panel-body">

                                        <h2 class="StepTitle">TRAINING</h2>
                                        <span class="links cl-effect-1"><?php echo $Training_active; ?></span>
                                        <p class="links cl-effect-1">
                                         <?php echo $this->Html->link('view more', array('plugin'=>'training','controller' => 'trainings', 'action' => 'index'), array('escape' => false)); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>




















                        </div>
                        <div class='clear'></div>










                    </div>






                </div>
            </div> 
            <!-- end: FOURTH SECTION -->
        </div>
    </div>

    <?php
//}
    ?> 


<!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
<!-- end: FOOTER -->    
</div>

<script type="text/javascript">
    $(document).ready(function() {








        $(".slide_class").on("click", function() {
            var chks = $(this).hasClass("open");
            $(".slide_class").each(function() {
                if ($(this).hasClass("active")) {

                } else {
                    $(this).removeClass('open');
                    $(this).children(".sub-menu").slideUp();
                }
            });

            if (chks) {
                $(this).removeClass('open');
                $(this).children(".sub-menu").slideUp();
            } else {
                // alert("d2");
                $(this).addClass('open');
                $(this).children(".sub-menu").slideDown();
            }
        });



    });





</script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-1.11.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/bootstrap.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/modernizr.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.sparkline.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/toggles.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/retina.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.cookies.js"></script>


<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.symbol.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.crosshair.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.categories.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/morris.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/raphael-2.1.0.min.js"></script>

<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/custom.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/charts.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
