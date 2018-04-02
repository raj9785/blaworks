<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5', 'validationEngine.jquery'));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5', 'jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
	jQuery("#FarecategoryEditForm").validationEngine();
	$("#single_1").fancybox({
	    helpers: {
		title: {
		    type: 'float'
		}
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
	<div class="main-content">
	    <div class="wrap-content container" id="container">
		<section id="page-title">
		    <div class="row">
			<div class="col-sm-9">
			    <h1 class="mainTitle"> Update Booking Type</h1>
			</div>
			<div class="col-md-3">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Booking Types', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>
		    </div>
		</section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white">

		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'farecategory', 'controller' => 'farecategories', 'action' => 'edit'), 'enctype' => 'multipart/form-data'));
		    echo $this->Form->hidden('id');
		    ?>

		    <div class="row">
			<div class="col-md-12">
			    <div class="row">
				<div class="col-md-6">
				    <div class="form-group">
					<label class="control-label">Fare Category Name <span class="symbol required"></span></label>
					<?php echo $this->Form->text($model . ".name", array('class' => 'form-control textbox validate[required]', 'div' => false, 'label' => false, 'required' => true)); ?>
					<span id="firstname-error" class="help-block"></span>
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
		    <!--add form end-->
		</div>
	    </div>

	</div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>