<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->script('jquery-ui.min', array('inline' => false));
?>
<style>

</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#check_all_f").on("click", function () {
            $("input[id^=fare_category_id]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all_f").on("click", function () {
            $("input[id^=fare_category_id]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });

        $("#check_all_v").on("click", function () {
            $("input[id^=cab_type]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all_v").on("click", function () {
            $("input[id^=cab_type]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });
        $("#advance_required").click(function () {
            if ($('input[name="data[City][fare_category_id][]"]:checked').length == 0) {
                $("#fare_category_id-error").html("Please select booking type");
                $("#fare_category_id").parent('div').addClass('has-error');
                $("#fare_category_id").focus();
                return false;
            } else {
                $("#fare_category_id").parent('div').removeClass('has-error');
                $("#fare_category_id-error").html("");
            }
            if ($('input[name="data[City][cab_type][]"]:checked').length == 0) {
                $("#cab_type-error").html("Please select vehicle type");
                $("#cab_type").parent('div').addClass('has-error');
                $("#cab_type").focus();
                return false;
            } else {
                $("#cab_type").parent('div').removeClass('has-error');
                $("#cab_type-error").html("");
            }
        });

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
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Advance Payment Required</h1>                            
                        </div> 
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Cities List', true) . "", array('plugin' => false,'controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
                        </div>						
                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                   <?php echo $this->Form->create('City', array('url' => array('plugin' => false, 'controller' => 'city', 'action' => 'advance_payment', '?' => array('id' => $city_id)))); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mult_chk">
                                <label class="control-label">Booking Type <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_f'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_f'));
                                            ?>
                                </label>
                                        <?php echo $this->Form->input('fare_category_id', array('type' => 'select', 'div' => false, 'multiple' => 'checkbox', 'options' => $fare_category_list, 'class' => '', 'id' => 'fare_category_id', 'label' => false, 'tabindex' => 4, 'required' => true)); ?>
                                <span id="fare_category_id-error" class="help-block"></span>
                            </div>
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col-md-12">  
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mult_chk vehicle_types">
                                        <label class="control-label">Vehicle Type <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_v'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_v'));
                                            ?>
                                        </label>
                                        <?php echo $this->Form->input('cab_type', array('type' => 'select', 'multiple' => 'checkbox', 'options' => $cab_type_list, 'class' => '', 'id' => 'cab_type', 'div' => false, 'label' => false, 'tabindex' => 5, 'required' => true)); ?>
                                        <span id="cab_type-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'advance_required')) ?>
                                    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                </div>
                <!-- end: FORM VALIDATION EXAMPLE 1 -->
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>