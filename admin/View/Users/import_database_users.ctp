<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));

echo $this->Html->script(array('jquery-ui.min'));


?>
<style>
    .help-block {
        color: #a94442;
    }
</style>
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
                        <div class="col-sm-10">
                            <h1 class="mainTitle"><?php echo isset($title_for_page)?$title_for_page:'Add Enquiry';?></h1>
                        </div>
                        <div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array('plugin' => false,'controller' => 'users',"action" => "database_users"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="">
                        <?php echo $this->Session->flash(); ?>
		    <?php
		    echo $this->Form->create('User', array('url' => array('plugin' => false, 'controller' => 'users', 'action' => 'import_database_users'), 'enctype' => 'multipart/form-data'));
		    ?>								

                        <div class="row">	
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label class="control-label">Upload Csv File<span class="symbol required"></span></label>
                                    <div id="filediv"> 
                                        <?php 
                              echo $this->Form->input('database_users', array('type' => 'file','label' => false,'div' => false,'id'=>'database_users','class' => "database_users textbox validate[required]")); ?>

                                    </div>
                                    <span id="database_users-error" class="help-block"></span>
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
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'upload_db_users', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array('plugin' => false, 'controller' => 'users', 'action' => 'database_users'), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>
		    <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>

<script type="text/javascript">

    jQuery(document).ready(function () {

        $("#upload_db_users").click(function () {
            if ($.trim($("#database_users").val()) == "") {
                $("#database_users-error").html("Please upload file");
                $("#database_users").parent('div').addClass('has-error');
                $("#database_users").focus();
                return false;
            } else {
                $("#database_users").parent('div').removeClass('has-error');
                $("#database_users-error").html("");
            }
        });
    });
</script>
