<?php

echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<?php
echo $this->Html->script(array('jquery-ui.min'));
?>
<style type="text/css">
    #TaxiPlateNo {
        text-transform:uppercase;	
    }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {
        var calculateAge = function (yearofpurchasing) {
            var now = new Date();
            var past = new Date(yearofpurchasing);
            var nowYear = now.getFullYear();
            var pastYear = past.getFullYear();
            var age = nowYear - pastYear;
            return age;
        };
        $('#TaxiPurchasing').on('change', function () {
            var $yop = $(this).val().split('-');
            if ((calculateAge($yop[2] + '-' + $yop[1] + '-' + $yop[0]) == 1) || ((calculateAge($yop[2] + '-' + $yop[1] + '-' + $yop[0]) == 0))) {
                $('#gaddi_info').html('').append('Your taxi is new.');
            } else {
                $('#gaddi_info').html('');
            }
        });
        $('#TaxiOwnerId').on('change', function () {
            var cur_id = $(this).val();
            var vendor_id = $('#TaxiCompanyId').val();
            if (cur_id == 2) {
                $('#driver_owner').show();
                if (vendor_id == '') {
                    alert('Please select vendor first');
                    return false;
                }
            } else {
                $('#driver_owner').hide();
            }
            get_drivers(vendor_id);
        });
        $('#TaxiCompanyId').on('change', function () {
            var vendor_id = $(this).val();
            var owner = $('#TaxiOwnerId').val();
            if (owner == 2) {
                $('#driver_owner').show();
            } else {
                $('#driver_owner').hide();
            }
            get_drivers(vendor_id);
        });

        $("#TaxiServiceCategoryId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'service_type', 'controller' => 'service_types', 'action' => 'get_service_type')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    if (subcat_data == '') {
                        alert('There are no service type found.');
                        $('#sti').hide();
                    } else {
                        options = "";
                        $.each(subcat_data, function (index, value) {
                            options += "<p><input type='checkbox' name='data[Taxi][service_type_id][]' value='" + index + "' /> " + value + "</p>";
                        });
                        $(' #sti').show();
                        $('#sti2').html(options);
                    }
                }
            });
        });

        /* $("#TaxiCompanyId").on('change', function() {
         cat_id = $(this).val();
         $.ajax({
         url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_state')); ?>",
         data: {'cat_id': cat_id},
         type: 'post',
         dataType: 'json',
         success: function(subcat_data) {
         options = "<option value=''><?php echo __('Select State'); ?></option>";
         $.each(subcat_data, function(index, value) {
         options += "<option value='" + index + "'>" + value + "</option>";
         });
         $("#TaxiStateId").empty().html(options);
         }
         });
         }); */

        $("#TaxiStateId").on('change', function () {
            cat_id = $('#TaxiStateId').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_city_all')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#TaxiCityId").empty().html(options);
                }
            });
        });


        $("#TaxiMotorCategoryId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'motor_type', 'controller' => 'motor_types', 'action' => 'get_motor_type')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select Motor Type'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#TaxiMotorTypeId").empty().html(options);
                }
            });
        });
        $("#TaxiMotorModelId").on('change', function () {
            $('#motor_type_img').show();
            $('#motor_cat_img').show();
            model_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'get_motor_ajax')); ?>",
                data: {'model_id': model_id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {
                    $('#motor_type_img').hide();
                    $('#motor_cat_img').hide();
                    var res = subcat_data.split(",");
                    $("#TaxiMotorCategoryId").val(res[0]);
                    $("#TaxiMotorTypeId").val(res[1]);
                },
                error: function (e) {
                    alert('fail');
                    $('#motor_type_img').show();
                    $('#motor_cat_img').show();
                }
            });
        });
        jQuery("#TaxiPurchasing").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            defaultDate: "<?php echo date("d-m-Y",strtotime("-4 year")); ?>",
            maxDate: new Date(),
        });
        jQuery("#TaxiCabPermitExpire,#TaxiVehicleInsuranceExpiry,#TaxiFitnessExpiry,#TaxiPucExpiry,#TaxiManufacturing").datepicker({
            dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
            minDate: 0
        });
        jQuery("#TaxiAddForm").validationEngine();


        $("#TaxiMotorId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'get_model')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Model'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#TaxiMotorModelId").empty().html(options);
                }
            });
        });
        $('.TaxiManufacturing').datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy',
            onClose: function (dateText, inst) {
                var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                $(this).datepicker('setDate', new Date(year, 1));
            }
        });
        $(".TaxiManufacturing").focus(function () {
            $(".ui-datepicker-month").hide();
        });
    });
    $(function () {

    });

    function get_drivers(vendor_id) {
        $.ajax({
            url: "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'get_driver_ids')); ?>",
            data: {'vendor_id': vendor_id},
            type: 'post',
            dataType: 'json',
            success: function (subcat_data) {
                options = "<option value=''><?php echo __('Select Driver'); ?></option>";
                $.each(subcat_data, function (index, value) {
                    options += "<option value='" + index + "'>" + value + "</option>";
                });
                $("#driver_owner_id").empty().html(options);
            }
        });
    }
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
                            <h1 class="mainTitle">Add New Vehicle</h1>
                        </div>
                        <div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">

		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
		    ?>								
                    <div class="row">							
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
				<?php echo __('Vehicle Details'); ?>
                            </h2>
                        </div>	

                    </div>		

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('plate_no')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.plate_no', __('Vehicle Registration Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('plate_no')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".plate_no", array('class' => 'form-control textbox validate[required,ajax[validate_plate]]')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.plate_no', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>				
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('company_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.company_id', __('Select Vendor', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('company_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.company_id', $company, array("class" => "form-control validate[required]", 'empty' => "Select  Company")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.company_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>					
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('owner_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.owner_id', __('Select Ownership Type', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('owner_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.owner_id', array(1=>'Vendor Cum Owner',2=>'Driver Cum Owner',3=>'Other'), array("default"=>1,"class" => "form-control validate[required]", 'empty' => "Select Ownership Type")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.owner_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>					
                        </div>

                        <div class="col-md-6" id="driver_owner" style="display:none;">
                            <div class="form-group <?php echo ($this->Form->error('driver_owner_id')) ? 'error' : ''; ?>">
                                <?php
				echo $this->Form->label($model . '.driver_owner_id', __('Select Driver', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                            <?php echo $this->Form->select('driver_owner_id', array(), array('empty' => "Select Driver", "class" => "form-control", 'id' => 'driver_owner_id')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('mmt_assured')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.mmt_assured', __('MMT Assured', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('mmt_assured')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->input('mmt_assured', array("type" => "checkbox", "id" => "mmt_assured", "div" => false, "label" => false, "class" => "mmt_assured")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.mmt_assured', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>					
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">				
                            <div class="form-group <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.status', __('Vehicle Status', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('Vehicle Status')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">		  
                            <div class="form-group <?php echo ($this->Form->error('Verification Status')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.verified', __('Verification Status', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('verified')) ? 'error' : ''; ?>"  >
				    <?php //echo $this->Form->Checkbox($model . '.verified', array('empty' => false)); ?>
				    <?php echo $this->Form->select($model . '.verified', array('1' => 'Yes', '0' => 'No'), array('empty' => false, 'class' => 'form-control')); ?>


                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.verified', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.state_id', __('Select State', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.state_id', $state, array("class" => "form-control validate[required]", 'empty' => "Select State")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.state_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>	
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.city_id', __('Select City', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.city_id', array(), array("class" => "form-control validate[required]", 'empty' => "Select City")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.city_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">						
                            <div class="form-group <?php echo ($this->Form->error('motor_type_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.motor_type_id', __('Vehicle Type', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('motor_type_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.motor_type_id', $motor_type, array("class" => "form-control validate[required]", 'empty' => "Select")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.motor_type_id', array('wrap' => false)); ?>
                                    </span><img src="<?php echo WEBSITE_URL; ?>img/ajax.gif" id="motor_type_img" style="display:none;"   />
                                </div>
                            </div>
                        </div>

                        <div  class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('motor_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.motor_id', __('Vehicle Manufacturer', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('motor_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.motor_id', $motor, array("class" => "form-control validate[required]", 'empty' => "Select")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.motor_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>							
                        </div>						
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('motor_model_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.motor_model_id', __('Vehicle Model', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('motor_model_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.motor_model_id', array(), array("class" => "form-control validate[required]", 'empty' => "Select")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.motor_model_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('taxi_fuel_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.taxi_fuel_id', __('Fuel Type', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('taxi_fuel_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.taxi_fuel_id', $car_fuel, array('empty' => false, 'class' => 'form-control')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.taxi_fuel_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>							
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('taxi_color_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.taxi_color_id', __('Vehicle Colour', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('taxi_color_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.taxi_color_id', $car_color, array('empty' => false, 'class' => 'form-control')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.taxi_color_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('purchasing')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.purchasing', __('Date of Purchase', true) . ' :<span class="symbol"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('purchasing')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".purchasing", array('class' => 'form-control textbox')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
                                        <span id="gaddi_info"></span>
					<?php echo $this->Form->error($model . '.purchasing', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div> 							
                        </div>							
                    </div>
                    <div class="row">							
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
				<?php echo __('Documents Details'); ?>
                            </h2>
                        </div>	

                    </div>	
                    <div class="row">							
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('permit_id')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.permit_id', __('Permit Type', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('permit_id')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->select($model . '.permit_id', $permit, array('class' => 'form-control validate[required]', 'empty' => "Select Taxi Permit")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.permit_id', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>										
                        </div>	
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('permit_no')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.permit_no', __('Permit Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('permit_no')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".permit_no", array('class' => 'form-control textbox validate[required]')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.permit_no', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>								
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('cab_permit_expire')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.cab_permit_expire', __('Permit Expiry Date', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('cab_permit_expire')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".cab_permit_expire", array('class' => 'form-control textbox validate[required]', 'required' => true)); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.cab_permit_expire', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div> 					 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('permit_issued_by')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.permit_issued_by', __('Permit Issuing Authority', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('permit_issued_by')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . '.permit_issued_by', array("class" => "form-control validate[required]")); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.permit_issued_by', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>							
                        </div>						   
                    </div>

                    <div class="row">
                        <div class="col-md-6">					  
                            <div class="form-group <?php echo ($this->Form->error('vehicle_insurance_expiry')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.vehicle_insurance_expiry', __('Insurance Expiry Date', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('vehicle_insurance_expiry')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".vehicle_insurance_expiry", array('class' => 'form-control textbox validate[required]', 'required' => true)); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.vehicle_insurance_expiry', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('vehicle_insurance_no')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.vehicle_insurance_comp', __(' Insurance Company', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('vehicle_insurance_comp')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".vehicle_insurance_comp", array('class' => 'form-control textbox validate[required]')); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.vehicle_insurance_comp', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>						
                        </div>
                    </div>		


                    <div class="row">		
                        <div class="col-md-6">	
                            <div class="form-group <?php echo ($this->Form->error('vehicle_insurance_expiry')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.fitness_expiry', __('Fitness Expiry Date', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('fitness_expiry')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".fitness_expiry", array('class' => 'form-control textbox validate[required]', 'required' => true)); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.fitness_expiry', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group <?php echo ($this->Form->error('puc_expiry')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.puc_expiry', __('PUC Expiry Date', true) . ' :<span class="symbol required"></span>', array('style' => ""));
				?>
                                <div class="input <?php echo ($this->Form->error('puc_expiry')) ? 'error' : ''; ?>" style="" >
				    <?php echo $this->Form->text($model . ".puc_expiry", array('class' => 'form-control textbox validate[required]', 'required' => true)); ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.puc_expiry', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>						
                        </div>						
                    </div>
                    <div class="row">							
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
				<?php echo __('Features Details'); ?>
                            </h2>
                        </div>							
                    </div>
                    <style>
                        .featuresdetailsfontsize{font-size: 13px;}
                        .featuresdetailsfontsize input[type="radio"] {
                            margin-right: 3px;
                        }
                    </style>
                    <div class="row">
                        <div class="col-md-6">						
                            <div class="form-group <?php echo ($this->Form->error('ac')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.ac', __('Air-Conditioning', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input featuresdetailsfontsize<?php echo ($this->Form->error('ac')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.ac', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => Configure::read("AC_NONAC"),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.gender', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">						
                            <div class="form-group <?php echo ($this->Form->error('transmission')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.transmission', __('Transmission', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input featuresdetailsfontsize <?php echo ($this->Form->error('transmission')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.transmission', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('auto' => 'Auto', 'manual' => 'Manual'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.transmission', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div> 
                        </div>							
                    </div>
                    <div class="row">
                        <div class="col-md-6">	
                            <div class="form-group <?php echo ($this->Form->error('seat_cover')) ? 'error' : ''; ?>">
				<?php
				echo $this->Form->label($model . '.seat_cover', __('Seat Cover', true) . ' :<span class="required"></span>', array('style' => ""));
				?>
                                <div class="input featuresdetailsfontsize<?php echo ($this->Form->error('seat_cover')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.seat_cover', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('fabric' => 'Fabric', 'leather' => 'Leather'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.seat_cover', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div> 							
                        </div>	
                        <div class="col-md-6">	
                            <div class="form-group ">
				<?php
				echo $this->Form->label($model . '.carroof_carrier', __('Roof Carrier', true) . ' :<span class="required"></span>', array('class' => ""));
				?>
                                <div class="input featuresdetailsfontsize <?php echo ($this->Form->error('carroof_carrier')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.carroof_carrier', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('1' => 'Yes', '0' => 'No'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.carroof_carrier', array('wrap' => false)); ?>
                                    </span>
                                </div>
				<?php /* ?>
				  <div class="input col-sm-8" style="" >
				  <?php echo $this->Form->Checkbox($model . '.carroof_carrier', array('empty' => false)); ?>Yes
				  <span class="help-inline" style="color: #B94A48;">
				  <?php echo $this->Form->error($model . '.carroof_carrier', array('wrap' => false)); ?>
				  </span>
				  </div>
				  <?php */ ?>	
                            </div>
                        </div>	
                    </div>

                    <div class="row">
                        <div class="col-md-6">	
                            <div class="form-group ">
				<?php
				echo $this->Form->label($model . '.airbag', __('Air Bags', true) . ' :<span class="required"></span>', array('class' => ""));
				?>
                                <div class="input featuresdetailsfontsize <?php echo ($this->Form->error('airbag')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.airbag', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('1' => 'Yes', '0' => 'No'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.airbag', array('wrap' => false)); ?>
                                    </span>
                                </div>

                            </div>
                        </div>	
                        <div class="col-md-6">	
                            <div class="form-group ">
				<?php
				echo $this->Form->label($model . '.anti_thief_alarm', __('GPS Device', true) . ' :<span class="required"></span>', array('class' => ""));
				?>
                                <div class="input featuresdetailsfontsize  <?php echo ($this->Form->error('anti_thief_alarm')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.anti_thief_alarm', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('1' => 'Yes', '0' => 'No'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.anti_thief_alarm', array('wrap' => false)); ?>
                                    </span>
                                </div>									
                            </div>
                        </div>							
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
			    <?php
			    echo $this->Form->label($model . '.break_system', __('Brake System', true) . ' :<span class="required"></span>', array('class' => ""));
			    ?>
                            <div class="input featuresdetailsfontsize <?php echo ($this->Form->error('break_system')) ? 'error' : ''; ?>" style="" >
				<?php
				echo $this->Form->input($model . '.break_system', array(
				    'div' => false,
				    'label' => false,
				    "separator" => "&nbsp &nbsp &nbsp",
				    'type' => 'radio',
				    'legend' => false,
				    'options' => array('ABS' => 'ABS', 'Disk break' => 'Disc'),
				    "class" => "validate[required]"
				));
				?>
                                <span class="help-inline" style="color: #B94A48;">
				    <?php echo $this->Form->error($model . '.break_system', array('wrap' => false)); ?>
                                </span>
                            </div>
                        </div> 	

                        <div class="col-md-6">	
                            <div class="form-group ">
				<?php
				echo $this->Form->label($model . '.music_system', __('Music System', true) . ' :<span class="required"></span>', array('class' => ""));
				?>
                                <div class="input featuresdetailsfontsize <?php echo ($this->Form->error('music_system')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.music_system', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('1' => 'Yes', '0' => 'No'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.music_system', array('wrap' => false)); ?>
                                    </span>
                                </div>									
                            </div>
                        </div>

                        <div class="col-md-6">	
                            <div class="form-group ">
				<?php
				echo $this->Form->label($model . '.heating', __('Heater	', true) . ' :<span class="required"></span>', array('class' => ""));
				?>
                                <div class="input featuresdetailsfontsize<?php echo ($this->Form->error('heating')) ? 'error' : ''; ?>" style="" >
				    <?php
				    echo $this->Form->input($model . '.heating', array(
					'div' => false,
					'label' => false,
					"separator" => "&nbsp &nbsp &nbsp",
					'type' => 'radio',
					'legend' => false,
					'options' => array('1' => 'Yes', '0' => 'No'),
					"class" => "validate[required]"
				    ));
				    ?>
                                    <span class="help-inline" style="color: #B94A48;">
					<?php echo $this->Form->error($model . '.music_system', array('wrap' => false)); ?>
                                    </span>
                                </div>									
                            </div>
                        </div>
                    </div>

                    <div class="row">							
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
				<?php echo __('Upload Documents'); ?>
                            </h2>
                        </div>	

                    </div>	

                    <div class="row">
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Registration Certificate :<span class="required"></span></label>                                          
                                <div >
				    <?php echo $this->Form->file('TaxiInformation.registration_certificate', array('class' => " validate[required]")); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="form-group">
                                <label >Permit :<span class="required"></span></label>                                           
                                <div>
				    <?php echo $this->Form->file('TaxiInformation.permit', array('class' => " validate[required]")); ?>

                                </div>
                            </div>
                        </div>
                    </div>	

                    <div class="row">	
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label >Insurance :<span class="required"></span></label>                                           
                                <div >
				    <?php echo $this->Form->file('TaxiInformation.insurance', array('class' => "textbox validate[required]")); ?>

                                </div>
                            </div>
                        </div>	
                        <div class="col-md-6 ">
                            <div class="form-group">
                                <label >Fitness :<span class="required"></span></label>                                           
                                <div>
				    <?php echo $this->Form->file('TaxiInformation.fitness', array('class' => "textbox validate[required]")); ?>

                                </div>
                            </div>
                        </div>		

                        <div class="col-sm-6 ">
                            <div class="form-group">
                                <label>PUC :</label>                                           
                                <div >
				    <?php echo $this->Form->file('TaxiInformation.puc', array('class' => "textbox validate[required]")); ?>

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



		    <?php echo $this->Form->end(); ?>

                </div>
            </div>

        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>



<script>

    $("#TaxiMusicSystem").click(function () {
        if ($(this).is(':checked'))
        {
            $("#TaxiMusicSystem1").prop("checked", true);
            $("#music").show();
        } else
        {
            $("#TaxiMusicSystem1").prop("checked", false);
            $("#music").hide();
        }
    });
    $("#TaxiAirbag").click(function () {
        if ($(this).is(':checked'))
        {
            $("#TaxiAirbag1").prop("checked", true);
            $("#air").show();
        } else
        {
            $("#TaxiAirbag1").prop("checked", false);
            $("#air").hide();
        }
    });
    var id = 1;
    var aid = 1;
    function add_image()
    {
        if (id < 6)
        {
            var html = '<div id="imageremove' + id + '" class="ad_img" style="position:relative; margin-top:15px;display: block !important;height: auto !important;"><a href="javascript:;" class=""><input type="file" class="validate[required,checkFileType[\'png,jpg,gif\']]" id="DealImageImage' + id + '" onchange="$(&quot;#upload-file-info' + id + '&quot;).html($(this).val());" class="form-control textbox browsers_button" name="data[TaxiImage][image][' + id + ']"><span style="color: #B94A48;" class="help-inline"></span></a></span><a href="javascript:void(0)" class="text-danger" id="remove' + id + '"><i class=" fa fa-times fa fa-white"></i></a><input type="radio" name="data[TaxiImage][featured][]" value="' + id + '" id="DealImageFeatured' + id + '" /></div>';
            $("#images").append(html);
            $("#remove" + id).click(function () {
                $("#" + this.parentNode.id).remove();
                id--;
            });
            id++;
        }
    }



    function add_information()
    {

        if (aid < 5)
        {
            var html = '<div id="aimageremove' + aid + '" class="ad_imgs" style="margin-top:15px;"><a href="javascript:void(0)" class=""><input type="file" class="valaidate[checkFileType[\'png,jpg,pdf,doc,docx\']]" id="ADealImageImage' + aid + '" onchange="$(&quot;#upload-file-info' + aid + '&quot;).html($(this).val());" class="form-control textbox browsers_button" name="data[TaxiInformation][image][' + aid + ']"><span style="color: #B94A48;" class="help-inline"></span></a></span><a href="javascript:;" class="text-danger" id="aremove' + aid + '"><i class=" fa fa-times fa fa-white"></i></a></div>';
            $("#aimages").append(html);
            $("#aremove" + aid).click(function () {
                $("#" + this.parentNode.id).remove();
                aid--;
            });
            aid++;
        }
    }
</script>
