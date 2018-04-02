<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
		jQuery("#AccessRightUserAddForm").validationEngine();
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
			    <h1 class="mainTitle">Add User & Permissions</h1>
			</div>
			<div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To List', true) . "", array("action" => "index",$cate_id), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>
		    </div>
		</section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white">
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'access_right_user', 'controller' => 'access_right_users', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
		    echo $this->Form->hidden($model.'.access_right_category_id',array('value'=>$cate_id));
		    ?>
		    <div class="row">
			<div class="col-md-12">

			    <div class="row" style="">
				<div class="col-md-6">


				    <div class="form-group <?php echo ($this->Form->error('username')) ? 'error' : ''; ?>">
					<?php
					echo $this->Form->label($model . '.username', __('Username', true) . ' :<span class="symbol required"></span>', array('style' => ""));
					?>
					<?php
					$errorval 	= '';
					$txtval 	= '';
						if($this->Session->check('errors')){
							$sessionval = $this->Session->read('errors');
							$errorval   =  isset($sessionval['username'][0]) ? $sessionval['username'][0] : '';
							$txtval     = $this->Session->read('txtval');
						}
					?>
					<div class="input <?php echo ($this->Form->error('username')) ? 'error' : ''; ?>" style="" >
					 <?php echo $this->Form->text($model . '.username', array("class" => "form-control textbox validate[required]",'value'=>$txtval)); ?>
						<span class="help-inline" style="color: #B94A48;">
							<?php
								if($this->Session->check('errors')){
									echo $errorval;
									$this->Session->delete('errors');
								}
							?>
						<?php //echo $this->Form->error($model . '.username', array('wrap' => false)); ?>
						</span>
					</div>
				    </div>
				   
				   <div class="form-group <?php echo ($this->Form->error('password')) ? 'error' : ''; ?>">
					<?php
					echo $this->Form->label($model . '.password', __('Password', true) . ' :<span class="symbol required"></span>', array('style' => ""));
					?>
					<div class="input <?php echo ($this->Form->error('password')) ? 'error' : ''; ?>" style="" >
					    <?php echo $this->Form->password($model . '.password', array("class" => "form-control textbox validate[required]")); ?>
					    <span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model . '.password', array('wrap' => false)); ?>
					    </span>
					</div>
				    </div>
				    
				    <div class="form-group <?php echo ($this->Form->error('confirm_password')) ? 'error' : ''; ?>">
					<?php
					echo $this->Form->label($model . '.confirm_password', __('Confirm Password', true) . ' :<span class="symbol required"></span>', array('style' => ""));
					?>
					<div class="input <?php echo ($this->Form->error('confirm_password')) ? 'error' : ''; ?>" style="" >
					    <?php echo $this->Form->password($model . '.confirm_password', array("class" => "form-control textbox validate[required,equals[AccessRightUserPassword]]")); ?>
					    <span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model . '.confirm_password', array('wrap' => false)); ?>
					    </span>
					</div>
				    </div>

				<div>
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
					<div class="col-md-12">
						<div>
							<span class='access_title'><u>Access Permission</u></span><br/><br/>
				
						</div>
					</div>
		    </div>
		    <div class="row" style="">
				<div class="col-md-12">
			
						 <!-- Nav tabs -->
							  <ul class="nav nav-tabs" role="tablist">
								<?php /* <li role="presentation" class="active"><a href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">Dashboard</a></li> */ ?>
								<li role="presentation" class="active"><a href="#booking" aria-controls="booking" role="tab" data-toggle="tab">Booking</a></li>
								<li role="presentation"><a href="#finance" aria-controls="finance" role="tab" data-toggle="tab">Finance</a></li>
								<li role="presentation"><a href="#customer" aria-controls="customer" role="tab" data-toggle="tab">Customer</a></li>
								<li role="presentation" class=""><a href="#partner" aria-controls="partner" role="tab" data-toggle="tab">Partner</a></li>
								<li role="presentation"><a href="#vehicle" aria-controls="vehicle" role="tab" data-toggle="tab">Vehicle</a></li>
								<li role="presentation"><a href="#team" aria-controls="team" role="tab" data-toggle="tab">Team</a></li>
								<li role="presentation"><a href="#location" aria-controls="location" role="tab" data-toggle="tab">Location</a></li>
								<li role="presentation" class=""><a href="#destination" aria-controls="home" role="tab" data-toggle="tab">Destination</a></li>
								<li role="presentation"><a href="#rate" aria-controls="rate" role="tab" data-toggle="tab">Rate</a></li>
								<li role="presentation"><a href="#promotioncode" aria-controls="promotioncode" role="tab" data-toggle="tab">Promotion Code</a></li>
								<li role="presentation"><a href="#feedbackrating" aria-controls="feedbackrating" role="tab" data-toggle="tab">Feedback & Rating</a></li>
								
								<li role="presentation" class=""><a href="#transaction" aria-controls="transaction" role="tab" data-toggle="tab">Transaction</a></li>
								<li role="presentation"><a href="#testimonial" aria-controls="testimonial" role="tab" data-toggle="tab">Testimonial</a></li>
								<li role="presentation"><a href="#webcontent" aria-controls="webcontent" role="tab" data-toggle="tab">Website Content</a></li>
								<li role="presentation"><a href="#refundcontent" aria-controls="refundcontent" role="tab" data-toggle="tab">Refund Content</a></li>
							  </ul>
							  

							  <div class="tab-content">
								<?php /* 
								<div role="tabpanel" class="tab-pane active" id="dashboard">
									<span class='access_title'>Dashboard</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.dashboard',array('value'=>1)).' <b>Show Dashboard</b>';
								?>
								</div> */ ?>
								
								<div role="tabpanel" class="tab-pane active" id="booking">
									<span class='access_title'>Booking</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.booking',array('value'=>1)).' <b>Show Booking</b>';
								?>
								</div>
								<div role="tabpanel" class="tab-pane" id="finance">
									<span class='access_title'>Finance</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.customer_invoice',array('value'=>1)).' <b>Show Customer Invoice</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.vendor_invoice',array('value'=>1)).' <b>Show Vendor Invoice</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.vendor_payment',array('value'=>1)).' <b>Show Vendor Payment</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.payu_panel',array('value'=>1)).' <b>Show Payu Panel</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.ezetap_panel',array('value'=>1)).' <b>Show Ezetap Panel</b>'.'<br/>';
								?>
								</div>
								<div role="tabpanel" class="tab-pane" id="customer">
									<span class='access_title'>Customer</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.customer',array('value'=>1)).' <b>Show Customer</b>';
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="partner">
									<span class='access_title'>Partner</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.driver',array('value'=>1)).' <b>Show Driver</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.corporatebusiness',array('value'=>1)).' <b>Show Corporate Business</b>'.'<br/>';
								?>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="vehicle">
									<span class='access_title'>Vehicle</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.vehicle_category',array('value'=>1)).' <b>Show Vehicle Category</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.vehicle_manufacturer',array('value'=>1)).' <b>Show Vehicle Manufacturer</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.vehicle_model',array('value'=>1)).' <b>Show Vehicle Model</b>'.'<br/>';
								?>
								
								</div>
								
								<div role="tabpanel" class="tab-pane" id="team">
									<span class='access_title'>Team</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.team',array('value'=>1)).' <b>Show Team</b>'.'<br/>';
								?>
								</div>
								
								<div role="tabpanel" class="tab-pane" id="location">
									<span class='access_title'>Location</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.country',array('value'=>1)).' <b>Show Country</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.state',array('value'=>1)).' <b>Show State</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.city',array('value'=>1)).' <b>Show City</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.airport',array('value'=>1)).' <b>Show Airport</b>'.'<br/>';
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="destination">
									<span class='access_title'>Destination</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.superdestination',array('value'=>1)).' <b>Show Super Destination</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.moredestination',array('value'=>1)).' <b>Show More Destination</b>'.'<br/>';
								
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="rate">
									<span class='access_title'>Rates</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.fare_category',array('value'=>1)).' <b>Show Fare Category</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.fare_time_management',array('value'=>1)).' <b>Show Fare Time management</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.customer_fare',array('value'=>1)).' <b>Show Customer Fare</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.vendor_fare',array('value'=>1)).' <b>Show Vendor Fare</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.charges_management',array('value'=>1)).' <b>Show Charge Management</b>'.'<br/>';
								
								?>
								</div>
								<div role="tabpanel" class="tab-pane" id="promotioncode">
									<span class='access_title'>Promotion Code</span><br/><br/>
									<?php 
									echo $this->Form->checkbox($model.'.promotion_code',array('value'=>1)).' <b>Show Promotion Code</b>'.'<br/>';
								?>
								</div>
								<div role="tabpanel" class="tab-pane" id="feedbackrating">
									<span class='access_title'>Feedback & Rating</span><br/><br/>
									<?php 
									echo $this->Form->checkbox($model.'.feedback_rating',array('value'=>1)).' <b>Show Feedback & Rating</b>'.'<br/>';
									
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="transaction">
									<span class='access_title'>Transaction</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.transaction',array('value'=>1)).' <b>Show Transaction</b>'.'<br/>';
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="testimonial">
									<span class='access_title'>Testimonial</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.testimonial',array('value'=>1)).' <b>Show Testimonial</b>'.'<br/>';
									
								?>
								
								</div>
								<div role="tabpanel" class="tab-pane" id="webcontent">
									<span class='access_title'>Web Content</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.pages',array('value'=>1)).' <b>Show Pages</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.terms',array('value'=>1)).' <b>Show Terms</b>'.'<br/>';
									echo $this->Form->checkbox($model.'.faqs',array('value'=>1)).' <b>Show Faqs</b>'.'<br/>';
									
								?>
								</div>
								<div role="tabpanel" class="tab-pane" id="refundcontent">
									<span class='access_title'>Refund Content</span><br/><br/>
								<?php 
									echo $this->Form->checkbox($model.'.refund_management',array('value'=>1)).' <b>Show Refund Management</b>'.'<br/>';
								?>
								</div>
							  </div>

						
				 </div>
			</div>
		  
		    <div class="row">
			<div class="col-md-8">
			</div>
			<div class="col-md-4">
			    <?php echo $this->Form->button('Save <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel <i class="fa fa-arrow-circle-right"></i>', true), array("action" => "index",$cate_id), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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

