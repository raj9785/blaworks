<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {


        jQuery("#TrainingCategoryAddForm").validationEngine();

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
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Training Category List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'training_category', 'controller' => 'training_categories', 'action' => 'add'), 'enctype' => 'multipart/form-data')); ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">


                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Upload Icon <span class="symbol required"></span></label>  
				     <?php  echo $this->Form->input('icon', array('type' => 'file','label' => false,'div' => false,'id'=>'image','class' => "")); ?>

                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>


                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group mult_chk types" id="type_1">
                                        <label class="control-label">Choose Job Category <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_f'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_f'));
                                            ?>
                                        </label>
                                        <?php echo $this->Form->input('job_category_id', array('type' => 'select', 'div' => false, 'multiple' => 'checkbox', 'options' => $jobcat_list, 'class' => '', 'id' => 'job_category_id', 'label' => false, 'tabindex' => 4, 'required' => true)); ?>
                                        <span id="type1-error" class="help-block"></span>
                                    </div>
                                </div>  
                            </div>
                            
                            <div class="row">	
				<?php foreach($language_list as $lang){
				?>

                                <div class="col-md-6">
                                    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                        <label for="districtName" style="">Name (<?php echo $lang['Language']['name']; ?>) :<span class="symbol required"></span></label>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
										    <?php 
											if($lang['Language']['id']==1){
												$req=" validate[required]";
											}else{
												$req="";
											}
											?>

                                            <?php echo $this->Form->text("LanguageMapTrainingCategory.".$lang['Language']['id'].".title", array('class' => 'form-control textbox '.$req)); ?>
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

