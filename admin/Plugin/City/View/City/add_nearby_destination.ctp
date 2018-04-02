<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
echo $this->Html->script(array('jquery-ui.min'));
echo $this->Html->script(array('destination'));

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
                <!-- start: PAGE TITLE -->
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'Add New Destination';?></h1>
                        </div>        
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => 'city','controller' => 'city',"action" => "nearby_destinations",'?' => array('id' => $city_id)), array("class" => "btn btn-green add-row", "escape" => false)); ?>	
                        </div> 

                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                    <div class="">
                        <?php echo $this->Session->flash(); ?>
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'city', 'controller' => 'city', 'action' => 'add_nearby_destination',$city_id), 'enctype' => 'multipart/form-data'));
		    ?>								


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Destination <span class="symbol required"></span></label>  
				    <?php echo $this->Form->text("destination_name", array('id'=>'destination_name','label' => false,'div' => false,'class' => 'form-control textbox validate[required]')); ?>
                                    <span id="destination_name-error" class="help-block"></span>
                                </div>				
                            </div>
                            <div class="col-md-6">				
                                <div class="form-group">
                                    <label class="control-label">Description <span class="symbol required"></span></label>
                                    <?php echo $this->Form->textarea('description', array('class' => 'form-control textarea validate[required,ajax[validate_plate]]', 'id' => 'description', 'label' => false, 'div' => false)); ?>
                                    <span id="description-error" class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Upload Image <span class="symbol required"></span></label>  
				    <?php echo $this->Form->input('destination_image', array('type' => 'file','label' => false,'div' => false,'id'=>'destination_image','class' => "")); 
                                    echo $this->Form->hidden('destination_image_wt', array("id" => "destination_image_wt"));
                                    echo $this->Form->hidden('destination_image_ht', array("id" => "destination_image_ht"));?>

                                    <span id="destination_image-error" class="help-block"></span>
                                </div>	
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">                                        
                            </div>
                            <div class="col-md-4">
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'add_destination', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array("action" => "nearby_destinations",'?' => array('id' => $city_id)), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>
		    <?php echo $this->Form->end(); ?>
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

