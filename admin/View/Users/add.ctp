<?php //echo $this->Html->script('add_user', array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
	jQuery("#cancel_button").click(function() {
	    window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'index')); ?>';
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
			     <h1 class="mainTitle">Add Customer</h1>
			</div>
			<div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To Customers List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
			    <?php echo $this->Form->create('Customer', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>
                            <br/>
                            <div class="row">
                                <div class="col-md-6">
				    <div class="form-group">
                                        <label class="control-label">Salutations <span class="symbol required"></span></label> 
					<?php echo $this->Form->select("title", array('MR' => 'MR', 'MS' => 'MS', 'MRS' => 'MRS'), array('empty' => false, 'div' => false, 'class' => 'form-control','tabindex' => 1)); ?>
                                        <span id="firstname-error" class="help-block"></span>
                                    </div> 
				    <div class="form-group">
                                        <label class="control-label">Last Name <span class="symbol required"></span></label> 
					<?php echo $this->Form->input('lastname', array('type' => 'text', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'lastname', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 3)); ?>
                                        <span id="lastname-error" class="help-block"></span>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Mobile <span class="symbol required"></span></label>
					<?php echo $this->Form->input('mobile', array('type' => 'text', 'maxlength' => '15', 'class' => 'form-control', 'id' => 'mobile', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 5)); ?>
                                        <span id="phone_no-error" class="help-block"></span>
                                    </div>
				    <div class="form-group">
                                        <label class="control-label">Confirm Password <span class="symbol required"></span></label>
					<?php echo $this->Form->input('confirm_password', array('type' => 'password', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'confirm_password', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 7)); ?>
                                        <span id="confirm_password-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
				    <div class="form-group">
                                        <label class="control-label">First Name <span class="symbol required"></span></label> 
					<?php echo $this->Form->input('firstname', array('type' => 'text', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'firstname', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 2)); ?>
                                        <span id="firstname-error" class="help-block"></span>
                                    </div> 
                                    <div class="form-group">
                                        <label class="control-label">Email <span class="symbol required"></span></label>
					<?php echo $this->Form->input('email', array('type' => 'text', 'maxlength' => '75', 'class' => 'form-control', 'id' => 'email', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 4)); ?>
                                        <span id="email-error" class="help-block"></span>
                                    </div>
				    <div class="form-group">
                                        <label class="control-label">Password <span class="symbol required"></span></label>
					<?php echo $this->Form->input('user_password', array('type' => 'password', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'user_password', 'div' => false, 'label' => false, 'required' => true,'tabindex' => 6)); ?>
                                        <span id="user_password-error" class="help-block"></span>
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
				    <?php echo $this->Form->button('Save <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button')) ?>
				    <?php echo $this->Form->button('Cancel <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary btn-wide pull-right', 'type' => 'button', 'id' => 'cancel_button')) ?>
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