<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#UserEditForm").validationEngine();


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
                            <h1 class="mainTitle">Edit User</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'user', 'controller' => 'users', 'action' => 'edit', $id), 'enctype' => 'multipart/form-data'));
                    ?>
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row" style="">
                                <div class="col-md-6">

                                    <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.access_right_category_id', __('Access Right Category', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                        <div class="input <?php echo ($this->Form->error('access_right_category_id')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->select($model . '.access_right_category_id', array($access_right_category), array('type' => 'select', "class" => "form-control  validate[required]", 'empty' => 'Select Categories', 'label' => false)); ?>
                                            <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.access_right_category_id', array('wrap' => false, 'hiddenField' => false)); ?>
                                            </span>
                                        </div>
                                    </div>





                                    <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.firstname', __('First Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                        <div class="input <?php echo ($this->Form->error('firstname')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.firstname', array("class" => "form-control textbox validate[required]")); ?>
                                            <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.firstname', array('wrap' => false, 'hiddenField' => false)); ?>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.lastname', __('Last Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                        <div class="input <?php echo ($this->Form->error('lastname')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.lastname', array("class" => "form-control textbox validate[required]")); ?>
                                            <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.lastname', array('wrap' => false, 'hiddenField' => false)); ?>
                                            </span>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.mobile', __('Mobile', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                        <div class="input <?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.mobile', array("class" => "form-control textbox validate[required]")); ?>
                                            <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.mobile', array('wrap' => false, 'hiddenField' => false)); ?>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.email', __('Email', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                        <div class="input <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.email', array("class" => "form-control textbox validate[custom[email],required]")); ?>
                                            <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.email', array('wrap' => false, 'hiddenField' => false)); ?>
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

