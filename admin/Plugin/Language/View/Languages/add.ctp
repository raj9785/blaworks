<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {

        $("#check_all").on("click", function () {
            $("input[id^=city_id_]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });

        $("#uncheck_all").on("click", function () {
            $("input[id^=city_id_]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });


        $("#submit_button").on("click", function () {
            if ($("#MotorTypeName").val() == "") {
                alert("Please enter Vehicle Type");
                $("#MotorTypeName").focus();
                return false;
            }
            if ($("#MotorTypeMotorCategoryId").val() == "") {
                alert("Please Select Category");
                $("#MotorTypeMotorCategoryId").focus();
                return false;
            }
            if ($("#capacity").val() == "") {
                alert("Please enter capacity");
                $("#capacity").focus();
                return false;
            }
            

        });
        jQuery("#LanguageAddForm").validationEngine();
       
    });
    
</script>

<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
        <?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Language List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'language', 'controller' => 'languages', 'action' => 'add'), 'enctype' => 'multipart/form-data')); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".name", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.code', __('Code', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".code", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.code', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
								
                               
                            </div>
                           
                           
                          
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <span class="symbol required"></span>Required Fields
                                        <hr>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
                                    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                                </div>
                            </div>



                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>

                </div>
            </div>

        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>

