



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
			    <h1 class="mainTitle">Change Password</h1>
			</div>
		    </div>
		</section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white">
<!--		    <div class="row">
			<div class="col-md-12 space20">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To Drivers List', true) . "", array("action" => "driver"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>
		    </div>-->
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_password'), 'enctype' => 'multipart/form-data'));
		    echo $this->Form->hidden('id');
		    ?>
		    <div class="row">
			<div class="col-md-12">

			    <div class="row">
				<div class="col-md-6">
				    <div class="form-group">
					<label class="control-label">Password <span class="symbol required"></span></label>
					<?php echo $this->Form->password($model . ".password", array('class' => 'form-control textbox validate[required]','required' => true)); ?>
					<span id="password-error" class="help-block"></span>
				    </div>

				    <div class="form-group">
					<label class="control-label">Confirm Password <span class="symbol required"></span></label>
					<?php echo $this->Form->password($model . ".confirm_password", array('class' => 'form-control textbox validate[required,equals[UsermgmtPassword]]','required' => true)); ?>
					<span id="confirm_password-error" class="help-block"></span>
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
				    <?php echo $this->Form->button('Save <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
				
				    <a class="btn btn-primary btn-wide pull-right" href="javascript:history.back()">Cancel <i class="fa fa-arrow-circle-right"></i></a>
					
			       <?php //echo $this->Html->link(__('Cancel <i class="fa fa-arrow-circle-right"></i>', true), array("action" => "driver"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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







