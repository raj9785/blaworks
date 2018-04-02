<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#MotorAddForm").validationEngine();
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
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Add New Vehicle Manufacturer</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">

                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
                    ?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo $this->Form->label($model . '.name', __('Vehicle Manufacturer Name', true) . ' :<span class="symbol required"></span>', array('style' => "")); ?>
                                        <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->text($model . ".name", array('class' => 'form-control textbox validate[required]')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <?php echo $this->Form->label($model . '.status', __('Status', true) . ' :<span class="symbol required"></span>', array('style' => "")); ?>
                                        <div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="" >
                                            <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control')); ?>
                                            <span class="help-inline" style="color: #B94A48;">
                                                <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
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
