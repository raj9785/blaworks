<?php echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false)); ?>

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
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>   
                        <div class="col-md-2 text-align-right" >
                            <?php echo $this->Html->link(__('Back to Vehicles List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <!-- end: PAGE TITLE -->
                <!-- Global Messages -->
                <?php echo $this->Session->flash(); ?>
                <!-- Global Messages End -->
                <!-- start: FORM VALIDATION EXAMPLE 1 -->
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12 space20">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php echo $this->Form->create('TaxiChat', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="form-group">
                                        <label class="control-label">Message <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('message', array('type' => 'textarea', 'class' => 'form-control ckeditor', 'id' => 'content', 'div' => false, 'label' => false)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Submit', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button')) ?>
                                    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right cancel_booking", "escape" => false)); ?>
                                </div>

                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 space20">

                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <?php
                            if (!empty($records)) {
                                foreach ($records as $showreply) {
                                    ?>
                                    <div class="customerreplay col-md-10" >

                                        <div class="col-md-12 msg-div">                                  
                                            <div class="messsage-box">
                                                <?php echo $showreply['TaxiChat']['message']; ?>
                                            </div>							
                                        </div>

                                        <div class="col-md-9 text-align-right">
                                            <div class="replyed_by">
                                                <?php echo $showreply['TaxiChat']['user_name']; ?>
                                            </div>											
                                        </div>
                                        <div class="col-md-3 text-align-right">
                                            <div class="replyed_on">
                                                <?php echo date("d-m-y h:i:s A", strtotime($showreply['TaxiChat']['created'])); ?>
                                            </div>											
                                        </div>

                                    </div>

                                <?Php }
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
                                      
                                            <?php echo $this->element('pagination'); ?>

                                       
                                    </div>
                                </div> 

                            <?php } ?> 					   
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
