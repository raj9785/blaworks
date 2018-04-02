<?php //echo $this->Html->script('add_user', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#cancel_button").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'dashboard')); ?>';
        });
        
         $('#submit').click(function(event){
        data = $('.newpassword').val();
        var len = data.length;
        
        if($('.newpassword').val() != $('.confirmpassword').val()) {
            alert("New Password and Confirm Password don't match");
            // Prevent form submission
            event.preventDefault();
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
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Change Password</h1>                            
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
                        <div class="col-md-12">   
                            <?php echo $this->Form->create('User', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>                    
                            <br/>
                            <div class="row">
								
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Old Password <span class="symbol required"></span></label> 
                                        <?php echo $this->Form->input('oldpassword', array('type' => 'password', 'maxlength' => '100', 'class' => 'form-control', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="name-error" class="help-block"></span>
                                    </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">New Password <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('newpassword', array('type' => 'password', 'maxlength' => '75', 'class' => 'form-control newpassword', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="confirm_email-error" class="help-block"></span>
                                    </div>                                                                                                        
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('confirmpassword', array('type' => 'password', 'maxlength' => '75', 'class' => 'form-control confirmpassword', 'div' => false, 'label' => false, 'required' => true)); ?>
                                        <span id="email-error" class="help-block"></span>
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
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit')) ?>
                                    <?php echo $this->Form->button('Cancel', array('class' => 'btn btn-primary btn-wide pull-right', 'type' => 'button', 'id' => 'cancel_button')) ?>
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
