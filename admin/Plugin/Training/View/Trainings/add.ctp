<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->script(array('jquery.dataTables.min.js','jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        
        $('#last_date_apply').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
             minDate: new Date(),
        });
        
        $("#check_all_f").on("click", function() {
            $("input[id^=education_id]").each(function() {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all_f").on("click", function() {
            $("input[id^=education_id]").each(function() {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });

        $("#state_id").on('change', function() {
            $("#submit_button").attr('disabled', 'disabled');
            $("#distrcit_id").attr('disabled', 'disabled');
            $("#distrcit_id").empty();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Html->url(array('plugin' => 'training', 'controller' => 'trainings', 'action' => 'get_district_list')) ?>',
                data: 'state_id=' + $("#state_id").val(),
                success: function(data) {
                    $("#submit_button").removeAttr('disabled');
                    $("#district_id").removeAttr('disabled');
                    $("#district_id").html(data);
                }
            });
        });

        jQuery("#TrainingAddForm").validationEngine();

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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Training List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'training', 'controller' => 'trainings', 'action' => 'add'), 'enctype' => 'multipart/form-data')); ?>

                    <div class="row">
                        <div class="col-md-12">


                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select State <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('state_id', array('type' => 'select', 'empty' => 'Select','options' => $state_list, 'class' => 'form-control  validate[required]', 'id' => 'state_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select District <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('district_id', array('type' => 'select', 'empty' => 'Select','options' => array(), 'class' => 'form-control  validate[required]', 'id' => 'district_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.name', __('Training Code', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('code')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".code", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.code', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Last Date Apply <span class="symbol required"></span></label>
                                        
                                        
                                           <?php 
                                        echo $this->Form->text($model . ".last_date_apply", array('id'=>'last_date_apply','class' => 'form-control'));
                                        ?> 
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                                


                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mult_chk types" id="type_1">
                                        <label class="control-label">Choose Education <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_f'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_f'));
                                            ?>
                                        </label>
                                        <?php echo $this->Form->input('education_id', array('type' => 'select', 'div' => false, 'multiple' => 'checkbox', 'options' => $education_list, 'class' => '', 'id' => 'education_id', 'label' => false, 'tabindex' => 4, 'required' => true)); ?>
                                        <span id="type1-error" class="help-block"></span>
                                    </div>
                                </div>  
                            </div>



                            <div class="row">


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Training Category <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('training_category_id', array('type' => 'select', 'empty' => 'Select','options' => $trainingcat_list, 'class' => 'form-control  validate[required]', 'id' => 'training_category_id', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Duration <span class="symbol required"></span></label>
                                        
                                        
                                           <?php 
                                        echo $this->Form->text($model . ".duration", array('class' => 'form-control validate[required]'));
                                        ?> 
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>

                               


                            </div>
                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('training_name')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Title (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('training_name')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->text("LanguageMapTraining.".$lang['Language']['id'].".training_name", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.title', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               <?php
			      } ?>




                            </div>



                            


                            



                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('description')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Training Description (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('training_description')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->textarea("LanguageMapTraining.".$lang['Language']['id'].".description", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.description', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                               <?php
			      } ?>
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

