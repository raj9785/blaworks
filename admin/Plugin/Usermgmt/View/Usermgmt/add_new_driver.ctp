<?php
//echo $this->Html->script('add_doc', array('inline' => false));  
//'add_individual'
echo $this->Html->css(array('validationEngine.jquery', 'plugins/datetimepicker/build/css/bootstrap-datetimepicker.min'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', 'plugins/moment/moment', 'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min', 'https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false', 'geocomplete.js'));
echo $this->Html->script(array('jquery-ui.min'));
echo $this->Html->css(array('chosen/chosen'));
echo $this->Html->script('chosen/chosen.jquery', array('inline' => false));
echo $this->Html->script('chosen/chosen.ajaxaddition.jquery', array('inline' => false));
?>
<style type="text/css">
    .chosen-choices{ min-height: 29px !important;}
	.chosen-container-multi .chosen-choices li.search-field input[type="text"]{height:35px !important;}
    .popover-title { display: none; }

    #user-list{float:left;list-style:none;margin-top:-3px;padding:0;width:495px; z-index: 1010;position: absolute;}
    #user-list li{line-height: 15px;
                  list-style: outside none none;
                  margin: 0;
                  padding: 5px 6px;
                  background: #fff; border-outer: #bbb9b9 1px solid;
                  position: relative;
                  width: 495px;
                  z-index: 1010;
    }
    #user-list li:hover{background:#ece3d2;cursor: pointer;}
</style>
<script type="text/javascript">
    function selectUser(val) {
        $("#UsermgmtReferredId").val(val);
        $("#suggesstion-box").hide();
    }
    jQuery(document).ready(function () {
		
		getcitieslistdata();
		getzoneslistdata();
		
        jQuery("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            yearRange: '1940:<?php echo date('Y') - 18; ?>',
            defaultDate: "01-01-1990"
        });

        jQuery("#dc_issue_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            maxDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#dc_expiry_date").datepicker("option", "minDate", selectedDate);
            }
        });
        jQuery("#dc_expiry_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#dc_issue_date").datepicker("option", "maxDate", selectedDate);
            }
        });


        $("#UsermgmtReferredId").keyup(function () {
            $.ajax({
                type: "POST",
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_referred_users')); ?>",
                data: {'term': $(this).val()},
                //data: 'keyword=' + $(this).val(),
                beforeSend: function () {
                    $("#UsermgmtReferredId").css("background", "#FFF url(LoaderIcon.gif) no-repeat 165px");
                },
                success: function (subcat_data) {
                    //console.log(subcat_data);
                    $("#suggesstion-box").show();
                    $("#suggesstion-box").html(subcat_data);
                    $("#UsermgmtReferredId").css("background", "#FFF");
                }
            });
        });
//
//        $('#UsermgmtUserRoleId5').on('change', function () {
//            if ($('#UsermgmtUserRoleId5').is(':checked')) {
//                $('#ndad').fadeOut();
//            }
//        });
//        jQuery("#UsermgmtAddIndividualForm").validationEngine();
//
//        $('#UsermgmtUserRoleId2').on('change', function () {
//            if ($('#UsermgmtUserRoleId2').is(':checked')) {
//                $('#ndad').fadeIn();
//            }
//        });

        $("select[id^=vendor_fare_state_id_]").on('change', function () {
            var thisID = $(this).attr('id');
            var breakid = thisID.split("_");
            var mainid = breakid[4];
            var cat_id = $(this).val();

            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'get_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });

                    $("#vendor_fare_city_id_" + mainid).empty().html(options);
                }
            });
        });

     /*  $("#CompanyStateId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_user_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + value['UserCity']['id'] + "'>" + value['UserCity']['name'] + "</option>";
                    });
                    $("#CompanyCityId").empty().html(options);
                }
            });
        });
		
		 $("#CompanyStateId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + value['UserCity']['id'] + "'>" + value['UserCity']['name'] + "</option>";
                    });
                    $("#CompanyCityId").empty().html(options);
                }
            });
        });
		
		*/
		 $("#CompanyStateId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'get_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#CompanyCityId").empty().html(options);
                }
            });
        });
		
        $("#CompanyCountryId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'state', 'controller' => 'state', 'action' => 'get_state')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select State'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#CompanyStateId").empty().html(options);
                }
            });
        });
        $("#ownership_type").on('change', function () {
			
			type = $(this).val();
			//alert(type);
			if(type == 1){
				 $(".employeeshowhide").show();
				
			}else{
				
				$(".employeeshowhide").hide();
			}
			
		});	
			
       /* $("#CompanyStateId").on('change', function () {
            cat_id = $(this).val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_user_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + value['UserCity']['id'] + "'>" + value['UserCity']['name'] + "</option>";
                    });
                    $("#CompanyCityId").empty().html(options);
                }
            });
        });*/

    });

	

</script>
<script>
	function getcitieslistdata(){	
	
		$.ajax({
			url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_cities')); ?>",
			data: {'city_id': 0},
			type: 'post',
			//dataType: 'json',
			success: function (data) {
				//alert(data);
				$('#citieslistdata').html(data).show();
			}
		});	
		
	}
	function getzoneslistdata(){	
	
		$.ajax({
			url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_zones')); ?>",
			data: {'city_id': 0},
			type: 'post',
			//dataType: 'json',
			success: function (data) {
				//alert(data);
				$('#zoneslistdata').html(data).show();
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
                        <div class="col-sm-9">
                            <h1 class="mainTitle">Add New Driver</h1>
                        </div> 
                        <div class="col-md-3">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Drivers List', true) . "", array("action" => "driver_list"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'add_new_driver'), 'enctype' => 'multipart/form-data')); ?>
                    <div class="row">

                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size: 18px;">
                                <?php echo __('Personal Details'); ?>
                            </h2>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driver First Name:<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".firstname", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'id' => 'full_name', 'required' => true)); ?> 
                                <span id="name-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driver Last Name:<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".lastname", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true)); ?> 
                                <span id="lastname-error" class="help-block"></span>	
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driver DOB <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('dob', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'dob', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', )); ?>
                                <span id="dob-error" class="help-block"></span>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.mobile', __('Driver Mobile Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".mobile", array('class' => 'form-control validate[required]', 'required'=>true, 'autocomplete' => 'off', 'title' => 'please enter 10 digit number','id' => 'mobile',)); ?> 
								<?php /*<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.mobile', array('wrap' => false)); ?> </span>
								*/ ?>	
								<span id="phone_no-error" class="help-block"></span>
							   </div> 
                            </div>						
                        </div>
                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('alternate_mobile')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.alternate_mobile', __('Driver Alternate Mobile Number', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('alternate_mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".alternate_mobile", array('class' => 'form-control', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number')); ?> 
								<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.alternate_mobile', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('ownership_type')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.ownership_type', __('Driver Status', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('ownership_type')) ? 'error' : ''; ?>" style="" >
								<?php //echo $this->Form->text($model . ".alternate_mobile", array('class' => 'form-control', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number')); ?> 
								
								 <?php echo $this->Form->select('ownership_type', array(0 => 'Owner ',1 => 'Employee'), array('id' => 'ownership_type', "class" => "form-control validate[required]", 'empty' => "Select Driver Status")); ?>
					
								<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.ownership_type', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						
						
						
						<div class="col-md-6 employeeshowhide" style="display:none">
                            <div class="form-group<?php echo ($this->Form->error('contact_person')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.contact_person', __('Vehicle Owner Name', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('contact_person')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".contact_person", array('class' => 'form-control',  'title' => 'Vehicle Owner Name')); ?> 
								<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.contact_person', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						
						<div class="col-md-6 employeeshowhide" style="display:none">
                            <div class="form-group<?php echo ($this->Form->error('contact_person_mo')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.contact_person_mo', __('Vehicle Owner Mobile Number', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('contact_person_mo')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".contact_person_mo", array('class' => 'form-control', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number')); ?> 
								<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.contact_person_mo', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						
                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>">
                                <?php
								
								//pr($state);
                                echo $this->Form->label("Company" . '.state_id', __('Select State', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("Company" . '.state_id', $state, array("class" => "form-control validate[required]", 'required'=>true, 'empty' => "Select State",)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.state_id', array('wrap' => false)); ?> </span> </div>
                            </div>                                        
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>">										
                                <?php
                                echo $this->Form->label("Company" . '.city_id', __('Select City', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("Company" . '.city_id', $city, array("class" => "form-control validate[required]", 'required'=>true, 'empty' => "Select City",)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.city_id', array('wrap' => false)); ?> </span> </div>									
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.address', __('Permanent Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea($model . ".address", array('class' => 'form-control validate[required]', 'required' => true,)); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.address', array('wrap' => false)); ?>
                                    </span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('residence_address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.residence_address', __('Current Residence Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('residence_address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea($model . ".residence_address", array('class' => 'form-control validate[required]', 'required' => true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.residence_address', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                            <?php echo $this->Form->label($model . '.referred_id', __('Referred By', true) . ' :', array('style' => "")); ?>
                                <div class="input <?php echo ($this->Form->error('referred_id')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->input($model . ".referred_id", array('type' => 'text', 'label' => false, 'maxlength' => 10, 'class' => 'form-control','placeholder'=>'Mobile No')); ?>
                                    <div id="suggesstion-box"></div>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Name on RC :<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".name_as_on_rc", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true,)); ?> 
                                <span id="name_as_on_rc-error" class="help-block"></span>
                            </div>							
                        </div>
						
						
						
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Document Details'); ?>
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DL Number :<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".dc_number", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true,)); ?> 
                                <span id="dc_number-error" class="help-block"></span>
                            </div>							
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DL Issuing Authority :<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".dc_issuing_authority", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true,)); ?> 
                                <span id="dc_issuing_authority-error" class="help-block"></span>
                            </div>							
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DL Issue Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('dc_issue_date', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'dc_issue_date', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', )); ?>
                                <span id="dc_issue_date-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DL Expiry Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('dc_expiry_date', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'dc_expiry_date', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', )); ?>
                                <span id="dc_expiry_date-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Aadhar Card Number :</label>
                                <?php echo $this->Form->text($model . ".aadhar_card", array('class' => 'form-control', 'div' => false, 'label' => false)); ?> 
                                <span id="aadhar_card-error" class="help-block"></span>
                            </div>							
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Voter ID :</label>
                                <?php echo $this->Form->text($model . ".voter_id", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => false,)); ?> 
                                <span id="pencard-error" class="help-block"></span>
                            </div>							
                        </div>
                        <!--div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Pan Card Number :</label>
                                <?php //echo $this->Form->text($model . ".pen_card", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false)); ?> 
                                <span id="pencard-error" class="help-block"></span>
                            </div>							
                        </div-->


                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Bank Account Details'); ?>
                            </h2>
                        </div>	
						
						
						<div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('ac_holder_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.ac_holder_name', __('A/C Holder Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('ac_holder_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Usermgmt" . ".ac_holder_name", array('class' => 'form-control ', 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.ac_holder_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>
						

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.bank', __('Account Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->text("Usermgmt" . ".bank", array('class' => 'form-control validate[required] ', 'required'=>true)); ?> <span id="UsermgmtBank-error" class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.bank', array('wrap' => false)); ?> </span> </div>
                            </div>								
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.vrerify_bank', __('Verify Account Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('vrerify_bank')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->text("Usermgmt" . ".vrerify_bank", array('class' => 'validate[required] ,equalss[CompanyBank] form-control ', 'required'=>true)); ?> <span class="help-inline" id="CompanyVrerifyBank-error" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.vrerify_bank', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>



                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.bank_name', __('Bank Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('bank_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Usermgmt" . ".bank_name", array('class' => 'form-control ', 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.bank_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('branch_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.branch_name', __('Branch Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('branch_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Usermgmt" . ".branch_name", array('class' => 'form-control ', 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.branch_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('ifsc_code')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.ifsc_code', __('Bank IFS Code', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('ifsc_code')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Usermgmt" . ".ifsc_code", array('class' => 'form-control ', 'required'=>true,'maxlength' =>11,'min'=>11)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.ifsc_code', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>
						
						
						
						
						

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('branch_address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Usermgmt" . '.branch_address', __('Branch Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('branch_address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea("Usermgmt" . ".branch_address", array('class' => 'form-control validate[required]', 'required'=>true)); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Usermgmt" . '.branch_address', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Contracting Details'); ?>
                            </h2>
                        </div>	
						
						<div class="col-md-6">  
							<div class="form-group" id="zoneslistdata"> 
							</div>
							<?php echo $this->Form->hidden('OperationArea.zones', array("id" => "zones","class" => "zones"));?>
                        </div>
						
                        <div class="col-md-6">  
                                <div class="form-group" id="citieslistdata"> 
                                </div>
                                <?php echo $this->Form->hidden('OperationArea.cities', array("id" => "cities","class" => "cities"));?>
                        </div>
						
						<?php /*
                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('one_way')) ? 'error' : ''; ?>">										
                                <?php
                                echo $this->Form->label("one_way", __('Select Zone', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('one_way')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("one_way", $zones, array("class" => "form-control validate[required]", 'empty' => "Select Zone", 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("one_way", array('wrap' => false)); ?> </span> </div>									
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('round_trip')) ? 'error' : ''; ?>">										
                                <?php
                                echo $this->Form->label("round_trip", __('Select City', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('round_trip')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("round_trip", $city_list, array("class" => "form-control validate[required]", 'empty' => "Select Zone", 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("round_trip", array('wrap' => false)); ?> </span> </div>									
                            </div>
                        </div>
						*/ ?>
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Upload Documents'); ?>
                            </h2>
                        </div>	
                        <div class="col-md-3">
                            <div class="form-group<?php echo ($this->Form->error('license_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.license_proof_img', __('Driver License', true) . ' :<span class="symbol required"></span>', array('style' => ""));
									
									
									echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'license_proof_img','class' => " validate[validate[image/jpeg|image/png]] license_proof_img" ,'name'=> 'data[Usermgmt][license_proof_img][]','required'=>true));
									
									
                                    ?>
                                <div class="input" style=""> <?php //echo $this->Form->file($model . ".license_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'license_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.license_proof_img', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group<?php echo ($this->Form->error('aadhar_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Aadhar Card', true) . ' :<span class="symbol required"></span>', array('style' => ""));
									
									echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'aadhar_proof_img','class' => " validate[validate[image/jpeg|image/png]] aadhar_proof_img" ,'name'=> 'data[Usermgmt][aadhar_proof_img][]','required'=>true));
									
									
                                    ?>
                                <div class="input" style=""> <?php //echo $this->Form->file($model . ".aadhar_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'aadhar_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group<?php echo ($this->Form->error('pancard_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.pancard_img', __('Pan Card', true) . ' :<span class="symbol required"></span>', array('style' => ""));
									
									echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'pancard_img','class' => " validate[validate[image/jpeg|image/png]] pancard_img" ,'name'=> 'data[Usermgmt][pancard_img][]','required'=>true));
									
                                    ?>
                                <div class="input" style=""> <?php //echo $this->Form->file($model . ".pancard_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'pancard_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.pancard_img', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group<?php echo ($this->Form->error('image')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.image', __('Driver Photo', true) . ':<span class="symbol required"></span>', array('style' => "margin-bottom:10px"));
								
								
								echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'driver_image','class' => " validate[validate[image/jpeg|image/png]] driver_image" ,'name'=> 'data[Usermgmt][image][]','required'=>true));
								
                                ?>
                         
                                <div class="input" style=""> <?php //echo $this->Form->file($model . ".image", array('class' => ' validate[required, validate[image/jpeg|image/png]]', 'id' => 'uploadimage')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div> 
						
						<div class="col-md-3">
                            <div class="form-group<?php echo ($this->Form->error('check_copy')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.image', __('Cheque Copy', true) . ':<span class="symbol required"></span>', array('style' => "margin-bottom:10px"));
								
								
								echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'check_copy','class' => " validate[validate[image/jpeg|image/png]] check_copy" ,'name'=> 'data[Usermgmt][check_copy][]','required'=>true));
								
                                ?>
                         
                                <div class="input" style=""> <?php //echo $this->Form->file($model . ".image", array('class' => ' validate[required, validate[image/jpeg|image/png]]', 'id' => 'uploadimage')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.check_copy', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div> 
                        <div class="clr clear"></div>
                        <div class="col-md-12">
                            <div class="col-md-12">
                                <div style="margin-top: 20px;" class="clr clear">
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
                                <?php echo $this->Html->link(__('Cancel', true), array("action" => "driver_list"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>						
                        <div>
                        </div>
                        <?php echo $this->Form->end(); ?>	
                    </div>

                </div>
            </div>
        </div>
    </div>


    <!-- start: FOOTER -->
                <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
<script>
    $(document).ready(function () {
        $(".chzn-select").chosen().change(function (e, params) {
            values = $(".chzn-select").chosen().val();
			//alert(values);
            $('.cities').val(values);
            //values is an array containing all the results.
        });
		
		$(".chznone-select").chosen().change(function (e, params) {
            values = $(".chznone-select").chosen().val();
			//alert(values);
            $('.zones').val(values);
            //values is an array containing all the results.
        });
        
	});	
</script>
<script>
    $('#mobile').on('blur', function () {

        $(this).before('<i id="kkload ing" style="position: absolute;right: 15px;top: 10p x;font-size: 20px;" class="fa fa-spinner fa-spin"></i>');
        var val = $(this).val();
		if(val !=''){
        //	return false;
			$.ajax({
				url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'check_mobile')); ?>",
				data: {'mobile': val},
				type: 'post',
				dataType: 'html',
				success: function (subcat_data) {
					if (subcat_data == "NOT_OK") {
						$("#mobile").prev('i').remove();
						$("#mobile").val('');
						$("#mobile").focus();
						$("#mobile").next("span").html('this mobile number already exist.');
					} else {
						$("#mobile").prev('i').remove();
						 $("#mobile").next("span").html('');
					}
				}
			});
		}
    });
//    $("#CompanyCompType").change(function () {
//        var comp_type = parseInt($(this).val());
//
//        if (comp_type == 1 || isNaN(comp_type)) {
//            $('#CompanyCompPenCard').css('display', 'none');
//            $('.comp_pen_lbl').css('display', 'none');
//        } else {
//            $('#CompanyCompPenCard').css('display', 'block');
//            $('.comp_pen_lbl').css('display', 'block');
//        }
//    });
</script>
<!--<style type="text/css">
    #CompanyCompPenCard{
        display: none;
    }
    .comp_pen_lbl{
        display: none;
    }
</style>-->
<script>
$(document).ready(function () {
    $("#submit_button").click(function () {
		if ($.trim($("#full_name").val()) == "") {
            $("#name-error").html("Please specify first name of user");
            $("#full_name").parent('div').addClass('has-error');
            $("#full_name").focus();
            return false;
        } else {
            $("#full_name").parent('div').removeClass('has-error');
            $("#name-error").html("");
        }
        if ($.trim($("#UsermgmtLastname").val()) == "") {
            $("#lastname-error").html("Please specify last name of user");
            $("#UsermgmtLastname").parent('div').addClass('has-error');
            $("#UsermgmtLastname").focus();
            return false;
        } else {
            $("#UsermgmtLastname").parent('div').removeClass('has-error');
            $("#lastname-error").html("");
        }
        
        if ($.trim($("#mobile").val()) == "") {
            $("#phone_no-error").html("Please specify mobile number");
            $("#mobile").parent('div').addClass('has-error');
            $("#mobile").focus();		
            return false;
        } else {
            $("#mobile").parent('div').removeClass('has-error');
            $("#phone_no-error").html("");			
        }
		
		 if (isNaN($.trim($("#mobile").val()))) {
            alert("Only numeric value is allowed");
            $("#mobile").focus();
            return false;
        }
        if ($("#mobile").val().length < 10 || $("#mobile").val().length > 10) {
            alert("Mobile number can be of 10 digits only ");
            $("#mobile").focus();
            return false;
        }
		
		
		
		
		
		
		
        if ($.trim($("#UsermgmtBank").val()) == "") {
            $("#UsermgmtBank-error").html("Please specify Account Number");
            $("#UsermgmtBank").parent('div').addClass('has-error');
            $("#UsermgmtBank").focus();		
            return false;
        } else {
            $("#UsermgmtBank").parent('div').removeClass('has-error');
            $("#UsermgmtBank-error").html("");	
        }
        if ($.trim($("#UsermgmtBank").val()) == "") {
            $("#UsermgmtBank-error").html("Please confirm Verify Account Number");
            $("#UsermgmtBank").parent('div').addClass('has-error');
            $("#UsermgmtBank").focus();
			alert("8");
            return false;
        } else {	
            $("#UsermgmtBank").parent('div').removeClass('has-error');
            $("#UsermgmtBank-error").html("");
        }

        if ($.trim($("#UsermgmtVrerifyBank").val()) != $.trim($("#UsermgmtBank").val())) {			
            $("#CompanyVrerifyBank-error").html("Both Account Number or Verify Account Number do not match");
            $("#CompanyVrerifyBank").parent('div').addClass('has-error');
            $("#CompanyVrerifyBank").focus();
            return false;
        } else {			
            $("#UsermgmtVrerifyBank").parent('div').removeClass('has-error');
            $("#CompanyVrerifyBank-error").html("");
        } 		
		
		if ($.trim($("#UsermgmtIfscCode").val()) == "") {			
            alert("Please enter IFSC Code");
            $("#UsermgmtIfscCode").focus();
            return false;
        }
        //if (isNaN($.trim($("#UsermgmtIfscCode").val()))) {
        if (!($.trim($("#UsermgmtIfscCode").val())).match(/^(?=.*[a-zA-Z])(?=.*[0-9])/)) {			
            alert("Bank IFS Code Only alphanumeric value is allowed");
            $("#UsermgmtIfscCode").focus();
            return false;
        }
		
		if ($("#UsermgmtIfscCode").val().length < 11 || $("#UsermgmtIfscCode").val().length > 11) {		
            alert("Bank IFS Code should be of 11 digits only ");
            $("#UsermgmtIfscCode").focus();
            return false;
        }
		var alphanumers = /^[a-zA-Z0-9]+$/;
		if(!alphanumers.test($("#UsermgmtIfscCode").val())){		
			alert("Bank IFS Code should not contain any special character or whitespace");
			$("#UsermgmtIfscCode").focus();
            return false;
		} 
		
		//return false;

    });
});

</script>




