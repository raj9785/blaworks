<?php
//echo $this->Html->css(array('jquery-ui-1.8.22.custom', 'jquery-ui_new'));
echo $this->Html->script(array('jquery-ui.min', 'add_driver'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {

        $("#license_from").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            maxDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function(selectedDate) {
                $("#license_to").datepicker("option", "minDate", selectedDate);
            }
        });
        $("#license_to").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function(selectedDate) {
                $("#license_from").datepicker("option", "maxDate", selectedDate);
            }
        });
        $("#UsermgmtCountryId").on('change', function() {
            cat_id = $('#UsermgmtCountryId').val();
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
                    $("#UsermgmtStateId").empty().html(options);
                }
            });
        });
        $("#UsermgmtStateId").on('change', function() {
            cat_id = $('#UsermgmtStateId').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function(subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function(index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#UsermgmtCityId").empty().html(options);
                }
            });
        });

        $("#vendor_id").on('change', function() {
            cat_id = $('#vendor_id').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_company')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function(subcat_data) {
                    if (subcat_data == '') {
                        alert('No Company available for this vendor');
                        return false;
                    } else {
                        options = "<option value=''><?php echo __('Select Company'); ?></option>";
                        $.each(subcat_data, function(index, value) {
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
            onClose: function(selectedDate) {
                $("#batch_end_date").datepicker("option", "minDate", selectedDate);
            }
        });
        jQuery("#batch_end_date").datepicker({
            defaultDate: "+1w",
            changeMonth: true,
            changeYear: true,
            minDate: 0,
            dateFormat: 'dd-mm-yy',
            onClose: function(selectedDate) {
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
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size:16px;">
                                <?php echo __('Vendor Details'); ?>
                            </h2>
                            <div class="row">                               
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Vendor <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('vendor_id', array('type' => 'select', 'options' => $vendors_list, 'class' => 'form-control validate[required]', 'id' => 'vendor_id', 'div' => false, 'label' => false, 'required' => true, 'empty' => 'Select', 'tabindex' => 1)); ?>
                                        <span id="vendor_id-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Select Vendor Company <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('company_id', array(), array("class" => "form-control validate[required]", 'empty' => "Select Company", 'tabindex' => 17)); ?>
                                        <span id="company_id-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size:16px;">
                                <?php echo __('Driver Basic Details'); ?>
                            </h2>
                            <div class="row"> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Driver's First Name <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('firstname', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'firstname', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 3)); ?>
                                        <span id="firstname-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Driver's Email <span class="symbol"></span></label>
                                        <?php echo $this->Form->input('email', array('type' => 'email', 'maxlength' => '75', 'class' => 'form-control textbox', 'id' => 'email', 'div' => false, 'label' => false, 'tabindex' => 2)); ?>
                                        <span id="email-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Driver's Date of Birth <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('dob', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'dob', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', 'tabindex' => 6)); ?>
                                        <span id="dob-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Current Address <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('address', array('type' => 'textarea', 'rows' => '2', 'maxlength' => '150', 'class' => 'form-control', 'id' => 'address', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 16)); ?>
                                        <span id="address-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Select Country <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('country_id', $country, array("class" => "form-control validate[required]", 'empty' => "Select Country", 'tabindex' => 19)); ?>
                                        <span id="country_id-error" class="help-block"></span>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Select City <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('city_id', array(), array("class" => "form-control validate[required]", 'empty' => "Select City", 'tabindex' => 21)); ?>
                                        <span id="city_id-error" class="help-block"></span>
                                    </div>                                  
								<?php /* ?>
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('confirm_password', array('type' => 'password', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'confirm_password', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 24)); ?>
                                        <span id="confirm_password-error" class="help-block"></span>
                                    </div>
                                  	<?php */ ?>  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Driver's Last Name <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('lastname', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'lastname', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 4)); ?>
                                        <span id="lastname-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Gender <span class="symbol required"></span></label>
                                        <?php echo $this->Form->radio('gender', array("1" => " Male ", "2" => " Female "), array("class" => "validate[required]", "label" => false, 'separator' => "<span>", 'label' => false, 'legend' => false, 'tabindex' => 5, 'hiddenField' => false)); ?>
                                        <span id="gender-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <br/><br/>
                                        <label class="control-label">Mobile Number <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('mobile', array('type' => 'text', 'class' => 'form-control', 'id' => 'mobile', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 16)); ?>
                                        <span id="mobile-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Permanent Address <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('permanent_address', array('type' => 'textarea', 'rows' => '2', 'maxlength' => '150', 'class' => 'form-control', 'id' => 'permanent_address', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 18)); ?>
                                        <span id="permanent_address-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Select State <span class="symbol required"></span></label>
                                        <?php echo $this->Form->select('state_id', array(), array("class" => "form-control validate[required]", 'empty' => "Select State", 'tabindex' => 20)); ?>
                                        <span id="state_id-error" class="help-block"></span>
                                    </div>
									<?php /* ?>
                                    <div class="form-group">
                                        <label class="control-label">Password <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('password', array('type' => 'password', 'maxlength' => '100', 'class' => 'form-control', 'id' => 'password', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 23)); ?>
                                        <span id="password-error" class="help-block"></span>
                                    </div>
									<?php */ ?>
                                     <div class="form-group">
                                        <label class="control-label">Upload Driver Photo<span class="symbol required"></span></label>
                                        <?php echo $this->Form->file("image", array('class' => 'textbox validate[required]', 'tabindex' => 22,'id'=>'uploadphoto')); ?>
                                        <span id="image-error" class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size:16px;">
                                <?php echo __('Permit Details'); ?>
                            </h2> 
                            <div class='row'>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">License no <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('license_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'license_no', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 8)); ?>
                                        <span id="license_no-error" class="help-block"></span>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="control-label">License Expiry Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('license_to', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control textbox validate[required]', 'id' => 'license_to', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', 'tabindex' => 9)); ?>
                                        <span id="license_to-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Badge Issue Date<span class="symbol"></span></label>
                                        <?php echo $this->Form->input('batch_start_date', array('type' => 'text', 'class' => 'form-control', 'id' => 'batch_start_date', 'div' => false, 'label' => false, 'required' => false, 'readonly' => 'readonly', 'tabindex' => 15)); ?>
                                        <span id="batch_start_date-error" class="help-block"></span>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label class="control-label">Voter Id <span class="symbol"></span></label>
                                        <?php echo $this->Form->input('voter_id', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control cardtype', 'id' => 'voter_id', 'div' => false, 'label' => false, 'required' => false, 'tabindex' => 12)); ?>
                                        <span id="voter_id-error" class="help-block"></span>
                                        <span id="card-error" style='color:#ff0000' class="help-block"></span>
                                    </div>
                                    
                                      <div class="form-group">
                                        <label class="control-label">Aadhar No <span class="symbol"></span></label>
                                        <?php echo $this->Form->input('aadhar_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control cardtype', 'id' => 'aadhar_no', 'div' => false, 'label' => false, 'required' => false, 'tabindex' => 10)); ?>
                                        <span id="aadhar_no-error" class="help-block"></span>
                                    </div>
                                    
                                  
                                    
                                    
                                    
                                 
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">License Issue Date <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('license_from', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'license_from', 'div' => false, 'label' => false, 'required' => true, 'readonly' => 'readonly', 'tabindex' => 7)); ?>
                                        <span id="license_from-error" class="help-block"></span>
                                    </div>
                                    
                                      <div class="form-group">
                                        <label class="control-label">RTO (Transport Issuing Authority)<span class="symbol"></span></label>
                                        <?php echo $this->Form->input('rto_office', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'rto_office', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 13)); ?>
                                        <span id="rto_office-error" class="help-block"></span>
                                    </div>
                                   
                                   <div class="form-group">
                                        <label class="control-label">Badge No.<span class="symbol"></span></label>
                                        <?php echo $this->Form->input('rto_batch_no', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control', 'id' => 'rto_batch_no', 'div' => false, 'label' => false, 'required' => false, 'tabindex' => 14)); ?>
                                        <span id="rto_batch_no-error" class="help-block"></span>
                                    </div>
                                    <span id="aadhar_no-error" class="help-block"></span>
                                    
                                    <div class="form-group">
                                        <label class="control-label">Ration Card <span class="symbol"></span></label>
                                        <?php echo $this->Form->input('ration_card', array('type' => 'text', 'maxlength' => '50', 'class' => 'form-control cardtype', 'id' => 'ration_card', 'div' => false, 'label' => false, 'required' => false, 'tabindex' => 11)); ?>
                                        <span id="ration_card-error" class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Police Verification <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('police_verification', array('type' => 'checkbox', 'value' => '1', 'class' => '', 'id' => 'police_verification', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 16)); ?>
                                        <span id="police_verification-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    

                                </div>
                                <div class="clear"></div>
                                <div class="col-md-6">
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="clear"></div>
                                <div class="clear"></div>

                            </div>
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;">
                                <?php echo __('Verification Documents'); ?>
                            </h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Permanent Address Verification <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('address_verification_doc', array('type' => 'file', 'class' => 'form-control', 'id' => 'address_verification_doc', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 25)); ?>
                                        <span id="address_verification_doc-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Current Address Verification <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('curr_address_verification_doc', array('type' => 'file', 'class' => 'form-control', 'id' => 'curr_address_verification_doc', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 25)); ?>
                                        <span id="curr_address_verification_doc-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Police Verification <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('criminal_background_doc', array('type' => 'file', 'class' => 'form-control', 'id' => 'criminal_background_doc', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 26)); ?>
                                        <span id="criminal_background_doc-error" class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Reference Verification <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('reference_verification', array('type' => 'file', 'class' => 'form-control', 'id' => 'reference_verification', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 27)); ?>
                                        <span id="reference_verification-error" class="help-block"></span>
                                    </div>
                                </div>
								
								
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Driving Licence <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('driving_licence', array('type' => 'file', 'class' => 'form-control', 'id' => 'driving_licence', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 27)); ?>
                                        <span id="driving_licence-error" class="help-block"></span>
                                    </div>
                                </div>
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Adhaar Card <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('adhaar_card', array('type' => 'file', 'class' => 'form-control', 'id' => 'adhaar_card', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 27)); ?>
                                        <span id="adhaar_card-error" class="help-block"></span>
                                    </div>
                                </div>
								
								
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label"> Voter ID <span class="symbol required"></span></label>
                                        <?php echo $this->Form->input('driver_voter_id', array('type' => 'file', 'class' => 'form-control', 'id' => 'driver_voter_id', 'div' => false, 'label' => false, 'required' => true, 'tabindex' => 27)); ?>
                                        <span id="driver_voter_id-error" class="help-block"></span>
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
                                    <?php echo $this->Html->link(__('Cancel', true), array("action" => "driver"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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
