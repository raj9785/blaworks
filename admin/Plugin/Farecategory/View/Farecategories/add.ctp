

<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

	jQuery("#FareAddForm").validationEngine();

	$("#FareStateId").on('change', function() {
	    cat_id = $(this).val();
	    $.ajax({
		url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'get_city')); ?>",
		data: {'cat_id': cat_id},
		type: 'post',
		dataType: 'json',
		success: function(subcat_data) {
		    options = "<option value=''><?php echo __('Select City'); ?></option>";
		    $.each(subcat_data, function(index, value) {
			options += "<option value='" + index + "'>" + value + "</option>";
		    });
		    $("#FareCityId").empty().html(options);
		}
	    });
	});

	$('#FareFarecategoryId').on('change', function() {
	    var cat_id = $(this).val();
	    if (cat_id) {
		if (cat_id == 1) {
		    //$('.part_2').hide();
		    $('.part_1').show();
		    $('.part_3').show();
		    $('.part_4').hide();
		    $('.part_6').hide();
		    $(".changable").html("Rs");
		    $('.perkm').html('Minimum KM :<span class="symbol required"></span>');
		} else if (cat_id == 2) {
		    $('.part_1').show();
		    $('.part_6').show();
		    $('.part_3').hide();
		    $('.part_4').hide();
		    $('.part_5').hide();
		    $('.perkm').html('Minimum KM :<span class="symbol required"></span>');
		    $(".changable").html("Rs");
		} else {
		    $('.part_1').hide();
		    $('.part_2').show();
		    $('.part_3').hide();
		    $('.part_4').show();
		    $('.part_6').hide();
		    $(".changable").html("Per Km Rs");
		    $('.perkm').html('Minimum KM (Per Day) :<span class="symbol required"></span>');
		}
	    } else {
		$(".changable").html("Rs");
		$('.perkm').html('Minimum KM :<span class="symbol required"></span>');
		$('.part_1').hide();
		$('.part_2').hide();
		$('.part_3').hide();
		$('.part_4').hide();
		$('.part_6').hide();
	    }

	});

	$("#FareTimemgmtId").on('change', function() {
	 var selected_text=$("#FareTimemgmtId option:selected").text();
	 if(selected_text){
	 $("#after_minimum_houre_fare").html('After '+selected_text+' Fare :<span class="symbol required"></span>');
         }else{
	    $("#after_minimum_houre_fare").html('After Minimum Hour Fare :<span class="symbol required"></span>');  
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
			<div class="col-sm-10">
			    <h1 class="mainTitle"> Add New Booking Type</h1>
			</div>
			<div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>
		    </div>
		</section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white">
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'farecategory', 'controller' => 'farecategories', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
		    ?>
		    <div class="row">
			<div class="col-md-12">

			    <div class="row" style="">
				<div class="col-md-6">
				 

				  
				   
					
				    <div class="form-group part_1 part_2 part_5" >
					<?php
					echo $this->Form->label('Farecategory.name', __('Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
					?>
					<div class="input <?php echo ($this->Form->error('Fare.name')) ? 'error' : ''; ?>" style="" >
					    <?php echo $this->Form->input('Farecategory.name', array("label"=>false,"class" => "form-control textbox validate[required]",'tabindex' => 9)); ?>
					    <span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error('Farecategory.name', array('wrap' => false)); ?> 
					    </span>
					</div>
				    </div>
					
					<div class="clearfx control-group <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
						<?php
						echo $this->Form->label($model . '.status', __('Status', true) . ' :<span class="symbol required"></span>', array('style' => ""));
						?>
						<div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="" >
						<?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false,'class'=>'form-control')); ?>
						<span class="help-inline" style="color: #B94A48;">
							<?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
						</span>
						</div>
					</div>



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



