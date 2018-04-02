<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

        $("#range_type").on("change", function() {
            if ($(this).val() == 2) {
                $(".max_range_class").hide();
                $("#SalaryMaxRange").removeClass("validate[required]");
            } else {
                $(".max_range_class").show();
                $("#SalaryMaxRange").addClass("validate[required]");
            }
        });

        if ($("#range_type").val() == 2) {
            $(".max_range_class").hide();
            $("#SalaryMaxRange").removeClass("validate[required]");
        } else {
            $(".max_range_class").show();
            $("#SalaryMaxRange").addClass("validate[required]");
        }

        jQuery("#SalaryEditForm").validationEngine();

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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Salary List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                     <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'salary', 'controller' => 'salaries', 'action' => 'edit'), 'enctype' => 'multipart/form-data'));
                    echo $this->Form->hidden('id');
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Salary Type <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('range_type', array('type' => 'select', 'empty' => 'Select','options' => $range_types, 'class' => 'form-control  validate[required]', 'id' => 'range_type', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('min_range')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.min_range', __('Minimum', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('min_range')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".min_range", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.min_range', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-6 max_range_class">
                                    <div class="form-group <?php echo ($this->Form->error('max_range')) ? 'error' : ''; ?>">
                                        <?php
                                        echo $this->Form->label($model . '.max_range', __('Maximum', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                        ?>
                                        <div class="input <?php echo ($this->Form->error('max_range')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".max_range", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.max_range', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="row">	
								<?php foreach($language_list as $lang){
									?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <label for="SalaryName" style="">Name (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->text("LanguageMapSalaries.".$lang['Language']['id'].".name", array('class' => 'form-control textbox '.$req)); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
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

