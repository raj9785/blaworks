<?php
//echo $this->Html->css(array('jquery-ui-1.8.22.custom', 'jquery-ui_new'));
echo $this->Html->script(array('jquery-ui.min', 'add_driver'));
?>
<script type="text/javascript">
    function verify_otp() {
        $.ajax({
            url: WEBSITE_URL + "admin/usermgmt/usermgmt/verify_otp",
            data: {'mobile': $("#mobile").val(), 'code': $("#otp_code").val()},
            type: 'post',
            //dataType: 'json',
            success: function (result) {
                if (result == 1) {
                    $("#UsermgmtOtpStatus").val("1");
                    $("#UsermgmtOtp").val($("#otp_code").val());
                    $("#UsermgmtAddDriverForm").submit();
                } else if (result == 2) {
                    $("#UsermgmtOtpStatus").val("");
                    alert("OTP expired");
                } else {
                    alert("Please enter a valid OTP");
                }
            }
        });
    }

    /* 	function verify_otp() {
     $("#UsermgmtOtpStatus").val("1");
     $("#UsermgmtOtp").val($("#otp_code").val());
     $("#UsermgmtAddDriverForm").submit();
     } */


    function resend_otp() {
        $.ajax({
            url: WEBSITE_URL + "admin/usermgmt/usermgmt/send_otp",
            data: {'mobile': $("#mobile").val()},
            type: 'post',
            //dataType: 'json',
            success: function (result) {
                if (result) {

                    alert("OTP sent to Driver's Mobile No.");
                }
            }
        });
    }



    jQuery(document).ready(function () {

        $("#license_from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            maxDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#license_to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#license_to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#license_from").datepicker("option", "maxDate", selectedDate);
            }
        });
        $("#UsermgmtCountryId").on('change', function () {
            cat_id = $('#UsermgmtCountryId').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_state')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select State'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#UsermgmtStateId").empty().html(options);
                }
            });
        });
        $("#UsermgmtStateId").on('change', function () {
            cat_id = $('#UsermgmtStateId').val();
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
                    $("#UsermgmtCityId").empty().html(options);
                }
            });
        });

        $("#vendor_id").on('change', function () {
            cat_id = $('#vendor_id').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_company')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    if (subcat_data == '') {
                        alert('No Company available for this vendor');
                        return false;
                    } else {
                        options = "<option value=''><?php echo __('Select Company'); ?></option>";
                        $.each(subcat_data, function (index, value) {
                            options += "<option value='" + index + "'>" + value + "</option>";
                        });
                        $("#UsermgmtCompanyId").empty().html(options);
                    }


                }
            });
        });


        jQuery("#dob").datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: "dd-mm-yy",
            yearRange: '1940:<?php echo date('Y') - 18; ?>',
            defaultDate: "01-01-1990"
        });

        jQuery("#batch_start_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            maxDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#batch_end_date").datepicker("option", "minDate", selectedDate);
            }
        });
        jQuery("#batch_end_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function (selectedDate) {
                $("#batch_start_date").datepicker("option", "maxDate", selectedDate);
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
                            <h1 class="mainTitle">Add New Driver</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Drivers List', true) . "", array("action" => "driver"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'add_driver'), 'enctype' => 'multipart/form-data'));
                    echo $this->Form->input('otp', array('type' => 'hidden'));
                    echo $this->Form->input('otp_status', array('type' => 'hidden'));
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size:16px;">
                                <?php echo __('Personal Details'); ?>
                            </h2>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name <span class="symbol required"></span></label>
                                <?php echo $this->Form->input('firstname', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'firstname', 'div' => false, 'label' => false, 'required' => true)); ?>
                                <span id="firstname-error" class="help-block"></span>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name <span class="symbol required"></span></label>
                                <?php echo $this->Form->input('lastname', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'lastname', 'div' => false, 'label' => false, 'required' => true)); ?>
                                <span id="lastname-error" class="help-block"></span>
                            </div>
                        </div> 

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Vendor <span class="symbol required"></span></label>
                                <?php echo $this->Form->select('company_id', $company, array("class" => "form-control validate[required]", 'empty' => "Select Company",)); ?>
                                <span id="company_id-error" class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">

                                <label class="control-label">Mobile Number <span class="symbol required"></span></label>
                                <?php echo $this->Form->input('mobile', array('type' => 'text', 'class' => 'form-control', 'id' => 'mobile', 'div' => false, 'label' => false, 'required' => true)); ?>
                                <span id="mobile-error" class="help-block"></span>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Alternate Mobile Number <span class="symbol"></span></label>
                                <?php echo $this->Form->input('alternate_mobile', array('type' => 'text', 'class' => 'form-control', 'id' => 'alternate_mobile', 'div' => false, 'label' => false, 'required' => false)); ?>
                                <span id="alternate_mobile-error" class="help-block"></span>
                            </div>
                        </div>
                        

                        <!--                        <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Status <span class="symbol required"></span></label>
                                                        <div class="input <?php //echo ($this->Form->error('status')) ? 'error' : '';  ?>" style="" > <?php //echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control'));  ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?> </span> </div>
                                                    </div>
                                                </div>						-->
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <?php /* ?>
                              <div class="form-group">
                              <label class="control-label">Gender <span class="symbol required"></span></label>
                              </br>
                              <?php echo $this->Form->radio('gender', array("1" => " Male ", "2" => " Female "), array("class" => "validate[required]", "label" => false, 'separator' => "<span>", 'label' => false, 'legend' => false, 'hiddenField' => false)); ?>
                              <span id="gender-error" class="help-block"></span>
                              </div>
                              <?php */ ?>			

                            <div class="form-group">
                                <label class="control-label">Gender </label>
                                <div class="input <?php echo ($this->Form->error('gender')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select($model . '.gender', array('1' => 'Male', '2' => 'Female'), array('empty' => false, 'class' => 'form-control')); ?> 
                                    <span id="gender-error" class="help-block"></span> </div>
                            </div>



                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">DOB </label>
                                <?php echo $this->Form->input('dob', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'dob', 'div' => false, 'label' => false, 'readonly' => 'readonly',)); ?>
                                <span id="dob-error" class="help-block"></span>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        

                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label">Email ID<span class="symbol"></span></label>
                                    <?php echo $this->Form->input('email', array('type' => 'email', 'maxlength' => '75', 'class' => 'form-control textbox', 'id' => 'email', 'div' => false, 'label' => false)); ?>
                                    <span id="email-error" class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> State </label>
                                <?php echo $this->Form->select('state_id', $state, array("class" => "form-control", 'empty' => "Select State")); ?>
                                <span id="state_id-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label"> City </label>
                                <?php echo $this->Form->select('city_id', array(), array("class" => "form-control", 'empty' => "Select City")); ?>
                                <span id="city_id-error" class="help-block"></span>
                            </div> 				 
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Permanent Address </label>
                                <?php echo $this->Form->input('permanent_address', array('type' => 'textarea', 'rows' => '2', 'maxlength' => '150', 'class' => 'form-control', 'id' => 'permanent_address', 'div' => false, 'label' => false)); ?>
                                <span id="permanent_address-error" class="help-block"></span>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Current Address </label>
                                <?php echo $this->Form->input('address', array('type' => 'textarea', 'rows' => '2', 'maxlength' => '150', 'class' => 'form-control', 'id' => 'address', 'div' => false, 'label' => false)); ?>
                                <span id="address-error" class="help-block"></span>
                            </div>					
                        </div>

                        

                        <!--div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Upload Photo (Document Type shoud be jpg, jpeg, png.) <span class="symbol required"></span></label>
                        <?php //echo $this->Form->file("image", array('class' => 'textbox validate[required]', 'tabindex' => 22,'id'=>'uploadphoto'));  ?>
                                <span id="image-error" class="help-block"></span>
                            </div>
                        </div-->
                    </div>

                    <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size:16px;">
                        <?php echo __('Document Details'); ?>
                    </h2>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driving License Number </label>
                                <?php echo $this->Form->input('license_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'license_no', 'div' => false, 'label' => false)); ?>
                                <span id="license_no-error" class="help-block"></span>
                            </div> 						
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Driving License Issuing Authority </label>
                            <?php echo $this->Form->input('rto_office', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'rto_office', 'div' => false, 'label' => false)); ?>
                            <span id="rto_office-error" class="help-block"></span>

                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driving License Issue Date </label>
                                <?php echo $this->Form->input('license_from', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'license_from', 'div' => false, 'label' => false,'readonly' => 'readonly',)); ?>
                                <span id="license_from-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Driving License Expiry Date </label>
                                <?php echo $this->Form->input('license_to', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'license_to', 'div' => false, 'label' => false, 'readonly' => 'readonly',)); ?>
                                <span id="license_to-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Badge Number</label>
                                <?php echo $this->Form->input('rto_batch_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'rto_batch_no', 'div' => false, 'label' => false, 'required' => false,)); ?>
                                <span id="rto_batch_no-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Badge Issuing Authority</label>
                                <?php echo $this->Form->input('badge_issue_authority', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'badge_issue_authority', 'div' => false, 'label' => false, 'required' => false,)); ?>
                                <span id="badge_issue_authority-error" class="help-block"></span>
                            </div>
                        </div>		
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Badge Issue Date</label>
                                <?php echo $this->Form->input('batch_start_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'batch_start_date', 'div' => false, 'label' => false, 'required' => false, 'readonly' => 'readonly')); ?>
                                <span id="batch_start_date-error" class="help-block"></span>
                            </div>
                        </div>	
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Badge Expiry Date</label>
                                <?php echo $this->Form->input('batch_end_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'batch_end_date', 'div' => false, 'label' => false, 'required' => false, 'readonly' => 'readonly')); ?>
                                <span id="batch_end_date-error" class="help-block"></span>
                            </div>
                        </div>	

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Adhaar Card Number</label>
                                <?php echo $this->Form->input('aadhar_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control cardtype', 'id' => 'aadhar_no', 'div' => false, 'label' => false, 'required' => false)); ?>
                                <span id="aadhar_no-error" class="help-block"></span>
                            </div>							 
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Voter ID Card Number</label>
                                <?php echo $this->Form->input('voter_id', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control cardtype', 'id' => 'voter_id', 'div' => false, 'label' => false, 'required' => false)); ?>
                                <span id="voter_id-error" class="help-block"></span>
                                <span id="card-error" style='color:#ff0000' class="help-block"></span>
                            </div>
                        </div>
                    </div>		

                    <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                        <?php echo __('Verification Documents'); ?>
                    </h2>
                    <!--div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Permanent Address Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('address_verification_doc', array('type' => 'file', 'class' => '', 'id' => 'address_verification_doc', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 25));  ?>
                                <span id="address_verification_doc-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Current Address Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('curr_address_verification_doc', array('type' => 'file', 'class' => '', 'id' => 'curr_address_verification_doc', 'div' => false, 'label' => false, 'required' => false));  ?>
                                <span id="curr_address_verification_doc-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Police Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('criminal_background_doc', array('type' => 'file', 'class' => '', 'id' => 'criminal_background_doc', 'div' => false, 'label' => false, 'required' => false,));  ?>
                                <span id="criminal_background_doc-error" class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Reference Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('reference_verification', array('type' => 'file', 'class' => '', 'id' => 'reference_verification', 'div' => false, 'label' => false, 'required' => false));  ?>
                                <span id="reference_verification-error" class="help-block"></span>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-md-3 space20">
                            <div class="form-group">
                                <label class="control-label"> Driving License Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('driving_licence', array('type' => 'file', 'class' => '', 'id' => 'driving_licence', 'div' => false, 'label' => false, 'required' => true,));  ?>
                                <span id="driving_licence-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Adhaar Card Verification <span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('adhaar_card', array('type' => 'file', 'class' => '', 'id' => 'adhaar_card', 'div' => false, 'label' => false, 'required' => false));  ?>
                                <span id="adhaar_card-error" class="help-block"></span>
                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label"> Voter ID Card Verification<span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('driver_voter_id', array('type' => 'file', 'class' => '', 'id' => 'driver_voter_id', 'div' => false, 'label' => false, 'required' => false));  ?>
                                <span id="driver_voter_id-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label class="control-label">Ration Card Verification<span class="symbol required"></span></label>
                    <?php //echo $this->Form->input('ration_card_doc', array('type' => 'file', 'class' => '', 'id' => 'ration_card_doc', 'div' => false, 'label' => false, 'required' => false,));  ?>
                                <span id="ration_card_doc-error" class="help-block"></span>
                            </div>
                        </div>

                    </div--->


                    <div class="col-md-3">
                        <div class="form-group<?php echo ($this->Form->error('license_proof_img')) ? 'error' : ''; ?>">
                            <?php
                            echo $this->Form->label('UserDocument.license_proof_img', __('Driver License', true) . ' :', array('style' => ""));

                            echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'license_proof_img', 'class' => " validate[validate[image/jpeg|image/png]] license_proof_img", 'name' => 'data[UserDocument][license_proof_img][]', 'required' => true));
                            ?>
                            <div class="input" style=""> <?php //echo $this->Form->file($model . ".license_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'license_proof_img'));       ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.license_proof_img', array('wrap' => false)); ?> </span> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group<?php echo ($this->Form->error('aadhar_proof_img')) ? 'error' : ''; ?>">
                            <?php
                            echo $this->Form->label('UserDocument.image', __('Aadhar Card', true) . ' :', array('style' => ""));

                            echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'aadhar_proof_img', 'class' => " validate[validate[image/jpeg|image/png]] aadhar_proof_img", 'name' => 'data[UserDocument][aadhar_proof_img][]'));
                            ?>
                            <div class="input" style=""> <?php //echo $this->Form->file($model . ".aadhar_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'aadhar_proof_img'));       ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group<?php echo ($this->Form->error('pancard_img')) ? 'error' : ''; ?>">
                            <?php
                            echo $this->Form->label('UserDocument.pancard_img', __('Pan Card', true) . ' :', array('style' => ""));

                            echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'pancard_img', 'class' => " validate[validate[image/jpeg|image/png]] pancard_img", 'name' => 'data[UserDocument][pancard_img][]'));
                            ?>
                            <div class="input" style=""> <?php //echo $this->Form->file($model . ".pancard_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'pancard_img'));       ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.pancard_img', array('wrap' => false)); ?> </span> 
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group<?php echo ($this->Form->error('image')) ? 'error' : ''; ?>">
                            <?php
                            echo $this->Form->label('UserDocument.image', __('Driver Photo', true) . ' :', array('style' => "margin-bottom:10px"));


                            echo $this->Form->input('', array('type' => 'file', 'multiple', 'label' => false, 'div' => false, 'id' => 'driver_image', 'class' => " validate[validate[image/jpeg|image/png]] driver_image", 'name' => 'data[UserDocument][image][]'));
                            ?>

                            <div class="input" style=""> <?php //echo $this->Form->file($model . ".image", array('class' => ' validate[required, validate[image/jpeg|image/png]]', 'id' => 'uploadimage'));       ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?> </span> 
                            </div>
                        </div>
                    </div> 
                    <div class="clr clear"></div>


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
                            <?php echo $this->Html->link(__('Cancel', true), array("action" => "driver"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg otp_box" data-backdrop="static" data-keyboard="false" style="display:none" data-toggle="modal" data-target="#myModal"></button>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content" style="width: 76%;">

            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12"></div>
                    <div class="col-sm-12">
                        <h5>Please enter the 4 digit Verification Code sent to Driver's Mobile No</h5>
                    </div>
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <?php echo $this->Form->input('otp_code', array('type' => 'text', 'class' => 'form-control', 'id' => 'otp_code', 'div' => false, 'label' => false)); ?>
                        </div>
                        <div class="col-sm-6" style="margin-top: 5px;">
                            <button class="btn btn-green verify_mobile_no" onclick="verify_otp()" id="verify_mobile_no" >Verify</button>
                        </div>
                    </div>
                    <div class="col-sm-12" style="margin-top: 5px;">
                        <div class="col-sm-6">
                            Didn't receive OTP? <a id="resend_otp" onclick="resend_otp()" class="resend_otp" href="javascript:void(0)">Re-Send</a>
                        </div>
                    </div>
                </div>
            </div>
            <!--      <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>-->
        </div>

    </div>
</div>
