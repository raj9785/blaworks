<?php
//'add_individual'
echo $this->Html->css(array('validationEngine.jquery', 'plugins/datetimepicker/build/css/bootstrap-datetimepicker.min'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', 'plugins/moment/moment', 'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min', 'https://maps.googleapis.com/maps/api/js?libraries=places&sensor=false', 'geocomplete.js'));
?>
<?php
echo $this->Html->script('https://maps.google.com/maps/api/js?sensor=false&libraries=places');
echo $this->Html->css(array('chosen/chosen'));
echo $this->Html->script('chosen/chosen.jquery', array('inline' => false));
echo $this->Html->script('chosen/chosen.ajaxaddition.jquery', array('inline' => false));
?>

<style type="text/css">
    .chosen-choices{ min-height: 29px !important;}
	.chosen-container-multi .chosen-choices li.search-field input[type="text"]{height:35px !important;}
    .popover-title { display: none; }
</style>
<script type="text/javascript">
    jQuery(document).ready(function () {

		getcitieslistdata();
		getzoneslistdata();
	
	
        $('#UsermgmtUserRoleId5').on('change', function () {
            if ($('#UsermgmtUserRoleId5').is(':checked')) {
                $('#ndad').fadeOut();
            }
        });
        jQuery("#UsermgmtAddIndividualForm").validationEngine();

        $('#UsermgmtUserRoleId2').on('change', function () {
            if ($('#UsermgmtUserRoleId2').is(':checked')) {
                $('#ndad').fadeIn();
            }
        });

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


        $("#destination_city_vendor_fare_1,#destination_city_vendor_fare_2,#destination_city_vendor_fare_3,#destination_city_vendor_fare_4,#destination_city_vendor_fare_5").geocomplete({
            componentRestrictions: {country: 'IN'}
        }).bind("geocode:result", function (event, result) {
            var selected_field = $(this).attr('id');
            for (var counter = 1; counter <= 5; counter++) {
                if (selected_field == 'destination_city_vendor_fare_' + counter) {
                    $("#destination_latitude_" + counter).val(result.geometry.location.lat());
                    $("#destination_longitude_" + counter).val(result.geometry.location.lng());
                }
            }
        });


        //alert(1);
        $('#CompanySfrom').datetimepicker({
            pickDate: false
        });
        //alert(2);
        $('#CompanySto').datetimepicker({
            pickDate: false
        });

        $("a#add_multiple_city").on("click", function () {
            var already_open = $("#UsermgmtShownMultiCityTab").val();
            var next_to_open = parseInt(already_open) + 1;
            $("#div_vendor_fare_block_" + next_to_open).show();
            $("#UsermgmtShownMultiCityTab").val(next_to_open);
            if (parseInt($("#UsermgmtShownMultiCityTab").val()) > 1)
                $("a#remove_multiple_city").show();
            else
                $("a#remove_multiple_city").hide();
            if (parseInt($("#UsermgmtShownMultiCityTab").val()) == 10)
                $("a#add_multiple_city").hide();
            else
                $("a#add_multiple_city").show();
            var already_open2 = parseInt($("#UsermgmtShownMultiCityTab").val());
            var upto_show = 10 - already_open2;
            $("a#add_multiple_city > span").html("(up to " + upto_show + ")");
        });
        $("a#remove_multiple_city").on("click", function () {
            var already_open = $("#UsermgmtShownMultiCityTab").val();
            var next_to_open = parseInt(already_open);
            $("#div_vendor_fare_block_" + next_to_open).hide();
            $("#UsermgmtShownMultiCityTab").val(next_to_open - 1);
            if (parseInt($("#UsermgmtShownMultiCityTab").val()) > 1)
                $("a#remove_multiple_city").show();
            else
                $("a#remove_multiple_city").hide();
            if (parseInt($("#UsermgmtShownMultiCityTab").val()) == 10)
                $("a#add_multiple_city").hide();
            else
                $("a#add_multiple_city").show();
            var already_open2 = parseInt($("#UsermgmtShownMultiCityTab").val());
            var upto_show = 10 - already_open2;
            $("a#add_multiple_city > span").html("(up to " + upto_show + ")");
        });


        $("#UsermgmtUserRoleId5").change(function () {
            $(".company").fadeOut();
            $('#comind').html('Individual  Information');
            $('.comindlbl').html('Individual Name');
        });
        $("#UsermgmtUserRoleId2").change(function () {
            $(".company").fadeIn();
            $('#comind').html('Company Information')
            $('.comindlbl').html('Company Name')
        });

        $('#CompanyStime2').change(function () {
            $('#sfrom').fadeIn();
            $('#sto').fadeIn();
        });

        $('#CompanyStime1').change(function () {
            $('#sfrom').fadeOut();
            $('#sto').fadeOut();
        });




        $("#CompanyTaxApplicable").click(function () {
            if ($("#CompanyTaxApplicable").is(':checked')) {
                $("#tax_registeration_no_div").show();
            } else {
                $("#tax_registeration_no_div").hide();
            }
        });


        $("#UsermgmtStateId").on('change', function () {
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
                    $("#UsermgmtCityId").empty().html(options);
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
        $('select[id^=vendor_fare_category_]').on('change', function () {
            var thisID = $(this).attr('id');
            var breakid = thisID.split("_");
            var block_id = breakid[3];
            var cat_id = $(this).val();
            if (cat_id) {
                if (cat_id == 1) {
                    //$('.part_2').hide();
                    $('#vendor_fare_minimum_km_' + block_id).show();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).show();
                    $("#vendor_fare_timemgmt_id_" + block_id).show();
                    $("#vendor_fare_airport_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).show();
                    $("#vendor_fare_driver_fare_" + block_id).hide();
                } else if (cat_id == 2) {
                    $('#vendor_fare_minimum_km_' + block_id).hide();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).hide();
                    $("#vendor_fare_airport_id_" + block_id).show();
                    $("#vendor_fare_timemgmt_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).hide();
                    $("#vendor_fare_driver_fare_" + block_id).hide();
                } else if (cat_id == 3) {
                    $('#vendor_fare_destination_city_' + block_id).hide();
                    $('#vendor_fare_minimum_km_' + block_id).show();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).hide();
                    $("#vendor_fare_driver_fare_" + block_id).show();
                    $("#vendor_fare_airport_id_" + block_id).hide();
                    $("#vendor_fare_timemgmt_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).hide();
                } else if (cat_id == 4) {
                    $('#vendor_fare_destination_city_' + block_id).show();
                    $('#vendor_fare_minimum_km_' + block_id).hide();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).hide();
                    $("#vendor_fare_airport_id_" + block_id).hide();
                    $("#vendor_fare_timemgmt_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).hide();
                    $("#vendor_fare_driver_fare_" + block_id).hide();
                } else if (cat_id == 5) {
                    $('#vendor_fare_destination_city_' + block_id).hide();
                    $('#vendor_fare_minimum_km_' + block_id).show();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).hide();
                    $("#vendor_fare_driver_fare_" + block_id).show();
                    $("#vendor_fare_airport_id_" + block_id).hide();
                    $("#vendor_fare_timemgmt_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).hide();
                } else {
                    $('#vendor_fare_destination_city_' + block_id).hide();
                    $('#vendor_fare_minimum_km_' + block_id).show();
                    $("#vendor_fare_after_minimum_houre_fare_" + block_id).show();
                    $("#vendor_fare_driver_fare_" + block_id).show();
                    $("#vendor_fare_airport_id_" + block_id).hide();
                    $("#vendor_fare_timemgmt_id_" + block_id).hide();
                    $("#vendor_fare_base_fare_" + block_id).show();
                    $("#vendor_fare_after_minimum_km_fare_" + block_id).hide();
                }
            }

        });

        $("#VendorFareTimemgmtId").on('change', function () {
            var selected_text = $("#VendorFareTimemgmtId option:selected").text();
            if (selected_text) {
                $("#after_minimum_houre_fare").html('After ' + selected_text + ' Fare :<span class="symbol required"></span>');
            } else {
                $("#after_minimum_houre_fare").html('After Minimum Hour Fare :<span class="symbol required"></span>');
            }
        });

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
	

    count = 0;
    function getMap(lat, lng, state, city, address, address_id, page_type) {
        //var count = $('.gmap_garag_address').length;
        $.ajax({
            url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'add_more_address')); ?>",
            data: {'count': count, 'lat': lat, 'lng': lng, 'state': state, 'city': city, 'address': address, 'address_id': address_id, 'page_type': page_type},
            type: 'post',
            dataType: 'html',
            beforeSend: function () {
                $(".loadings").html("Loading..");
            },
            success: function (subcat_data) {
                $("#addresses").append(subcat_data);
                $(".loadings").html('');
                //initialize1();
            }
        });
        count++;
    }

    function remove_addrs(adrs_index, address_id) {
        var r = confirm("Are you sure,you want to remove address!");

        if (r == true) {
            if (address_id != 0) {
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'remove_operation_address')); ?>",
                    data: {'cities_id': address_id},
                    type: 'post',
                    dataType: 'json',
                    success: function (subcat_data) {
                        if (subcat_data == 1) {
                            $("#AD_" + adrs_index).remove();
                            count--;
                        } else {
                            alert("Error Occurs.");
                        }
                    }
                });
            } else {
                $("#AD_" + adrs_index).remove();
                count--;
            }
        }


    }

    $(document).ready(function () {
        $("#add_more_address").click(function () {
            getMap('26.826651', '75.999', '', '', '', '', '');
        });
    });

    var aid = 1;
    function add_information()
    {

        if (aid < 5)
        {
            var html = '<div id="aimageremove' + aid + '" class="ad_imgs" style="position:relative; margin-top:15px;display: block !important;height: auto !important;"><input type="file" class="input-sm valaidate[checkFileType[\'png,jpg,pdf,doc,docx\']]" id="ADealImageImage' + aid + '" onchange="$(&quot;#upload-file-info' + aid + '&quot;).html($(this).val());" class="textbox browsers_button" name="data[CompanyInformation][image][' + aid + ']"><span style="color: #B94A48;" class="help-inline"></span></a></span><a href="javascript:void(0);" class="text-danger" id="aremove' + aid + '"><i class=" fa fa-remove"></i></a></div>';
            $("#aimages").after(html);
            $("#aremove" + aid).click(function () {
                $("#" + this.parentNode.id).remove();
                aid--;
            });
            aid++;
        }
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
                            <h1 class="mainTitle">Add New Vendor</h1>
                        </div> 
                        <div class="col-md-3">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Vendor Partner List', true) . "", array("action" => "individual"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'add_individual'), 'enctype' => 'multipart/form-data')); ?>
                    <div class="row">

                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0;font-size: 18px;">
                                <?php echo __('Personal Details'); ?>
                            </h2>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">First Name:<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".firstname", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true)); ?> 
                                <span id="firstname-error" class="help-block"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Last Name:<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".lastname", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true)); ?> 
                                <span id="lastname-error" class="help-block"></span>	
                            </div>
                        </div>

                        <div class="col-md-6">                         

                            <div class="form-group<?php echo ($this->Form->error('gender')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.gender', __('Gender', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('gender')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->select($model . '.gender', array('1' => 'Male', '2' => 'Female'), array('empty' => false, 'class' => 'form-control')); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.gender', array('wrap' => false)); ?> </span> </div>
                            </div>					

                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('status')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.status', __('Status', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('status')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->select($model . '.status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => false, 'class' => 'form-control')); ?>
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.status', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.mobile', __('Mobile Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".mobile", array('class' => 'form-control validate[required]', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.mobile', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('Alternate Mobile Number')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.alternate_mobile', __('Alternate Mobile Number', true) . '', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('alternate_mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".alternate_mobile", array('class' => 'form-control', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.alternate_mobile', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						


                        <div class="col-md-6">							  
                            <div class="form-group<?php echo ($this->Form->error('email')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.email', __('Email ID', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->text($model . ".email", array('class' => 'form-control validate[required,custom[email]]')); ?> 
                                    <span id="email-error" class="help-block"></span>
                                </div>
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
							  <?php /* ?>							  
                              <div class="form-group<?php echo ($this->Form->error('wmndsrv')) ? 'error' : ''; ?>">
                              <?php
                              echo $this->Form->label("Company" . '.wmndsrv', __('Woman Driver Service', true) . ' :', array('style' => ""));
                              ?>
                              <?php echo $this->Form->checkbox("Company" . ".wmndsrv", array('class' => '', 'value' => 1,)); ?>
                              </div>
                              <?php */ ?>	
                            <div class="form-group<?php echo ($this->Form->error('wmndsrv')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.wmndsrv', __('Woman Driver Service', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('wmndsrv')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->select("Company" . '.wmndsrv', array('1' => 'Yes', '0' => 'No'), array('empty' => false, 'class' => 'form-control')); ?>
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.wmndsrv', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('image')) ? 'error' : ''; ?>">
                                <?php
                                //echo $this->Form->label($model . '.image', __('Upload Photo', true) . ' :', array('style' => ""));
                                echo $this->Form->label($model . '.image', __('Upload Photo (Document Type shoud be jpg, jpeg, png.)', true) . ' :<span class="symbol required ">  </span>', array('style' => "margin-bottom:10px"));
                                ?>
                                </br>
                                <div class="input" style=""> <?php echo $this->Form->file($model . ".image", array('class' => ' validate[required, validate[image/jpeg|image/png]]', 'id' => 'uploadimage')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div> 

                        <div class="space20">
                            <!----
       <p style="padding: 3px 13px 0px; color: rgb(133, 133, 133);">
           Upload Identity Proof ( + Passport,  + Voter ID, + Aadhar Card, + Driving License) Upload Atleast one Document<span class="symbol required"></span>
       </p>
                            -->
                            <p style="padding: 3px 13px 0px; color: rgb(133, 133, 133);">
                                Upload Identity Proof ( Document Type shoud be jpg, jpeg, png.) <span class="symbol required"></span>
                            </p>
                            <p style="padding:0px 13px; color: rgb(133, 133, 133);">

                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('passport_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Passport', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".passport_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'passport_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('identity_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Voter ID', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".identity_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'identity_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('aadhar_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Aadhar Card', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".aadhar_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'aadhar_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('license_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Driving License', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".license_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'license_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Company Details'); ?>
                            </h2>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('comp_type')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.comp_type', __('Company Type', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('comp_type')) ? 'error' : ''; ?>" style="" > 
                                    <?php
                                    $company_type = array(1 => "Proprietor", 2 => "Partnership", 3 => "Private Limited");
                                    echo $this->Form->select("Company" . '.comp_type', $company_type, array("class" => "form-control validate[required]", 'empty' => "Select Type",));
                                    ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.comp_type', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>						

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.name', __('Company Name', true) . ' :<span class="symbol required"></span>', array('style' => "", 'class' => 'comindlbl'));
                                ?>
                                <div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".name", array('class' => 'form-control validate[required]',)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.name', array('wrap' => false)); ?> </span> </div>
                            </div>								
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.state_id', __('Select State', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('state_id')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("Company" . '.state_id', $state, array("class" => "form-control validate[required]", 'empty' => "Select State",)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.state_id', array('wrap' => false)); ?> </span> </div>
                            </div>                                        
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>">										
                                <?php
                                echo $this->Form->label("Company" . '.city_id', __('Select City', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('city_id')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->select("Company" . '.city_id', $city, array("class" => "form-control validate[required]", 'empty' => "Select City",)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.city_id', array('wrap' => false)); ?> </span> </div>									
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.registered_address', __('Registered Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea("Company" . ".registered_address", array('class' => 'form-control validate[required]')); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.registered_address', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.address', __('Office Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea("Company" . ".address", array('class' => 'form-control validate[required]')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.address', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Pan Card Number :<span class="symbol required"></span></label>
                                <?php echo $this->Form->text($model . ".pen_card", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true,)); ?> 
                                <span id="pencard-error" class="help-block"></span>
                            </div>							
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">GSTIN :</label>

                                <div class="input 
                                     <?php echo ($this->Form->error('tax_registeration_no')) ? 'error' : ''; ?>" style="" > 
                                     <?php echo $this->Form->text("Company" . ".tax_registeration_no", array('class' => 'form-control',)); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.tax_registeration_no', array('wrap' => false)); ?>
                                    </span> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Bank Account Details'); ?>
                            </h2>
                        </div>	


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('ac_holder_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.ac_holder_name', __('Account Holder Name (As on Checkbook)', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('ac_holder_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".ac_holder_name", array('class' => 'form-control ')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.ac_holder_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>



                        <div class="col-md-6">                   

                            <div class="form-group<?php echo ($this->Form->error('account_type')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.account_type', __('Account Type', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('account_type')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->select($model . '.account_type', array('savings' => 'Savings', 'current' => 'Current', 'cash_credit' => 'Cash Credit', 'over_draft' => 'Over Draft'), array('empty' => 'Select Account Type', 'class' => 'form-control')); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.account_type', array('wrap' => false)); ?> </span> </div>
                            </div>					

                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.bank', __('Account Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->text("Company" . ".bank", array('class' => 'form-control validate[required] ')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.bank', array('wrap' => false)); ?> </span> </div>
                            </div>								
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.vrerify_bank', __('Verify Account Number', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('vrerify_bank')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->text("Company" . ".vrerify_bank", array('class' => 'validate[required] ,equalss[CompanyBank] form-control ')); ?> <span class="help-inline" id="CompanyVrerifyBank-error" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.vrerify_bank', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>



                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('bank_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.bank_name', __('Bank Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('bank_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".bank_name", array('class' => 'form-control ')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.bank_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>


                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('branch_name')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.branch_name', __('Branch Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('branch_name')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".branch_name", array('class' => 'form-control ',)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.branch_name', array('wrap' => false)); ?> </span> </div>
                            </div>							
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('ifsc_code')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.ifsc_code', __('Bank IFS Code', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('ifsc_code')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".ifsc_code", array('class' => 'form-control', 'maxlength' =>11,'min'=>11)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.ifsc_code', array('wrap' => false)); ?> </span> </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('branch_address')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label("Company" . '.branch_address', __('Branch Address', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('branch_address')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->textarea("Company" . ".branch_address", array('class' => 'form-control validate[required]')); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.branch_address', array('wrap' => false)); ?> </span> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                   <?php echo $this->Form->input($model . '.mgf_vendor', array('type' => 'checkbox', 'div' => false, 'label' => false, 'tabindex' => 4)); ?> MBG Route Vendor 
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                   <?php echo $this->Form->input($model . '.allow_corporate_booking', array('type' => 'checkbox', 'div' => false, 'label' => false, 'tabindex' => 4)); ?> Allow Corporate Booking
                            </div>
                        </div>
						
						<div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php echo __('Contracting Details'); ?>
                            </h2>
                        </div>	
                        <!--div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('one_way')) ? 'error' : ''; ?>">		
                                <?php
                                //echo $this->Form->label("one_way", __('Select Zone', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php //echo ($this->Form->error('one_way')) ? 'error' : ''; ?>" style="" > <?php //echo $this->Form->select("OperationArea.zone_ids", $zones, array("class" => "form-control validate[required]", 'empty' => "Select Zone", 'required'=>true)); ?> <span class="help-inline" style="color: #B94A48;"> <?php //echo $this->Form->error("one_way", array('wrap' => false)); ?> </span> </div>									
                            </div>
                        </div -->
						
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

                        <!--div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php
                                //echo $this->Form->label('OperationCity.garage_address.0', __('Operational Address', true) . ' <span class="required"></span>', array('style' => ""));
                                ?>
                            </h2>
                        </div-->
                        <div class="col-md-12 clear clr"></div>

                        <!---div id="addresses" class="">
                            <script>
                                getMap('<?php //echo $lat; ?>', '<?php echo $lng; ?>', '', '', '', '', 'add');
                            </script>
                        </div-->
						<?php /* 
                        <div class="col-md-12 company">
                            <div class="col-sm-2" style="margin-left: 44px;">
								<a style="margin-top: 11px; margin-left: 26px;" id="add_more_address" class="btn btn-primary btn-sm" href="javascript:void(0)" >
									<strong>+</strong>
								</a>
								<span style="margin: 0px 7px; top: 15px; font-size: 14px;" class="loadings"></span>
							</div>
                        </div> 
						*/ ?>
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
										<?php echo $this->Html->link(__('Cancel', true), array("action" => "individual"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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

	$('#UsermgmtMobile').on('blur', function () {

		$(this).before('<i id="kkload ing" style="position: absolute;right: 15px;top: 10p x;font-size: 20px;" class="fa fa-spinner fa-spin"></i>');
		var val = $(this).val();
		//	return false;
		$.ajax({
			url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'check_mobile')); ?>",
			data: {'mobile': val},
			type: 'post',
			dataType: 'html',
			success: function (subcat_data) {
				if (subcat_data == "NOT_OK") {
					$("#UsermgmtMobile").prev('i').remove();
					$("#UsermgmtMobile").val('');
					$("#UsermgmtMobile").focus();
					$("#UsermgmtMobile").next("span").html('this mobile number already exist.');
				} else {
					$("#UsermgmtMobile").prev('i').remove();
				}
			}
		});
	});
	$("#CompanyCompType").change(function () {
		var comp_type = parseInt($(this).val());

		if (comp_type == 1 || isNaN(comp_type)) {
			$('#CompanyCompPenCard').css('display', 'none');
			$('.comp_pen_lbl').css('display', 'none');
		}
		else {
			$('#CompanyCompPenCard').css('display', 'block');
			$('.comp_pen_lbl').css('display', 'block');
		}
	});
</script>
<script>

$(document).ready(function () {
    $("#submit_button").click(function () {
		
		 if ($.trim($("#CompanyIfscCode").val()) == "") {
            alert("Please enter IFSC Code");
            $("#CompanyIfscCode").focus();
            return false;
        }
        //if (isNaN($.trim($("#CompanyIfscCode").val()))) {
        if (!($.trim($("#CompanyIfscCode").val())).match(/^(?=.*[a-zA-Z])(?=.*[0-9])/)) {
            alert("Bank IFS Code Only alphanumeric value is allowed");
            $("#CompanyIfscCode").focus();
            return false;
        }
		
		if ($("#CompanyIfscCode").val().length < 11 || $("#CompanyIfscCode").val().length > 11) {
            alert("Bank IFS Code should be of 11 digits only ");
            $("#CompanyIfscCode").focus();
            return false;
        }
		var alphanumers = /^[a-zA-Z0-9]+$/;
		if(!alphanumers.test($("#CompanyIfscCode").val())){
			alert("Bank IFS Code should not contain any special character or whitespace");
			$("#CompanyIfscCode").focus();
            return false;
		}
		
		});
	});		
		
</script>



<style type="text/css">
	#CompanyCompPenCard{
		display: none;
	}
	.comp_pen_lbl{
		display: none;
	}
</style>