<?php
//echo $this->Html->css(array('validationEngine.jquery', 'plugins/datetimepicker/build/css/bootstrap-datetimepicker.min'));
//echo $this->Html->script(array('plugins/moment/moment', 'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min', 'edit_individual'));
?>
<style>
    .chosen-choices{
        min-height: 29px !important;
    }
</style>
<?php
echo $this->Html->css(array('validationEngine.jquery', 'plugins/datetimepicker/build/css/bootstrap-datetimepicker.min'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine', 'plugins/moment/moment', 'plugins/datetimepicker/build/js/bootstrap-datetimepicker.min', 'edit_individual'));
echo $this->Html->css(array('chosen/chosen'));
echo $this->Html->script('chosen/chosen.jquery', array('inline' => false)); 
echo $this->Html->script('chosen/chosen.ajaxaddition.jquery', array('inline' => false)); 
echo $this->Html->script('ckeditor/ckeditor.js', array('inline' => false));
?>
<?php
//echo $this->Html->script('https://maps.google.com/maps/api/js?sensor=false&libraries=places');
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
		//getcitieslistdata();
        taxt_chk();

		
        jQuery("#UsermgmtEditIndividualForm").validationEngine();
        if ($('#UsermgmtUserRoleId5').is(':checked')) {
            $('#ndad').fadeOut();
        }

        $('#CompanySfrom').datetimepicker({
            pickDate: false,
        });
        //alert(2);
        $('#CompanySto').datetimepicker({
            pickDate: false,
        });
        //alert(3);		

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

        $("#CompanyTaxApplicable").click(function () {
            if ($("#CompanyTaxApplicable").is(':checked')) {
                $("#tax_registeration_no_div").show();
            } else {
                $("#tax_registeration_no_div").hide();
            }
        });

        if ($("#CompanyCountryId").val()) {
            var state_id = '<?php echo @$result['Company']["state_id"]; ?>';
            var city_id = '<?php echo @$result['Company']["city_id"]; ?>';
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'state', 'controller' => 'state', 'action' => 'get_state')); ?>",
                data: {'cat_id': $("#CompanyCountryId").val()},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select State'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        if (state_id == index) {
                            options += "<option selected='selected' value='" + index + "'>" + value + "</option>";
                        } else {
                            options += "<option value='" + index + "'>" + value + "</option>";
                        }
                    });
                    $("#CompanyStateId").empty().html(options);
                    $.ajax({
                        url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'get_city')); ?>",
                        data: {'cat_id': $("#CompanyStateId").val()},
                        type: 'post',
                        dataType: 'json',
                        success: function (subcat_data) {
                            options = "<option value=''><?php echo __('Select City'); ?></option>";
                            $.each(subcat_data, function (index, value) {
                                if (city_id == index) {
                                    options += "<option selected='selected' value='" + index + "'>" + value + "</option>";
                                } else {
                                    options += "<option value='" + index + "'>" + value + "</option>";
                                }
                            });
                            $("#CompanyCityId").empty().html(options);
                        }
                    });
                }
            });
        }

    });
    var aid = 1;
    function add_information()
    {

        if (aid < 5)
        {
            var html = '<div id="aimageremove' + aid + '" class="ad_imgs" style="position:relative; margin-top:15px;display: block !important;height: auto !important;"><input type="file" class="valaidate[checkFileType[\'png,jpg,pdf,doc,docx\']]" id="ADealImageImage' + aid + '" onchange="$(&quot;#upload-file-info' + aid + '&quot;).html($(this).val());" class="textbox browsers_button" name="data[CompanyInformation][image][' + aid + ']"><span style="color: #B94A48;" class="help-inline"></span></a></span><a href="javascript:;" class="text-danger" id="aremove' + aid + '"><i class=" icon icon-remove"></i></a></div>';
            $("#aimages").append(html);
            $("#aremove" + aid).click(function () {
                $("#" + this.parentNode.id).remove();
                aid--;
            });
            aid++;
        }
    }

    function taxt_chk() {
        if ($("#CompanyTaxApplicable").is(':checked')) {
            $("#tax_registeration_no_div").show();
        } else {
            $("#tax_registeration_no_div").hide();
        }
    }

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



    function delete_doc(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        swal({
            title: "Are you sure?",
            text: "Doc will be deleted permanently",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'delete_doc')); ?>',
                        data: 'id=' + user_id,
                        dataType: 'json',
                        success: function (data) {
                            if (data.succ == 1) {
                                swal({
                                    title: "Deleted!",
                                    text: data.msg,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonColor: '#d6e9c6',
                                    confirmButtonText: 'OK',
                                    closeOnConfirm: false,
                                }, function () {
                                    window.location.reload();
                                });
                            } else {
                                swal({
                                    title: "Error!",
                                    text: data.msg,
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonColor: '#d6e9c6',
                                    confirmButtonText: 'OK',
                                    closeOnConfirm: false,
                                }, function () {
                                    window.location.reload();
                                });
                            }
                        }
                    });
                });
    }
</script>

<script>

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


        swal({
            title: "Are you sure?",
            text: "Address will be deleted permanently",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
        },
                function () {
                    if (address_id != 0) {
                        $.ajax({
                            type: 'post',
                            url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'remove_operation_address')); ?>',
                            data: 'cities_id=' + address_id,
                            dataType: 'json',
                            success: function (data) {
                                if (data == 1) {
                                    swal({
                                        title: "Deleted!",
                                        text: "Address Deleted",
                                        type: "success",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: true,
                                    }, function () {
                                        $("#AD_" + adrs_index).remove();
                                        count--;
                                    });
                                } else {
                                    swal({
                                        title: "Error!",
                                        text: "Error",
                                        type: "error",
                                        showCancelButton: false,
                                        confirmButtonColor: '#d6e9c6',
                                        confirmButtonText: 'OK',
                                        closeOnConfirm: true,
                                    }, function () {
                                        alert("Error Occurs.");
                                    });
                                }
                            }
                        });
                    } else {
                        swal({
                            title: "Deleted!",
                            text: "Address Deleted",
                            type: "success",
                            showCancelButton: false,
                            confirmButtonColor: '#d6e9c6',
                            confirmButtonText: 'OK',
                            closeOnConfirm: true,
                        }, function () {
                            $("#AD_" + adrs_index).remove();
                            count--;
                        });
                    }

                });


    }

    $(document).ready(function () {
        $("#add_more_address").click(function () {
            getMap('26.826651', '75.999', '', '', '', '', '');
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
                            <h1 class="mainTitle"><?php echo __('Edit Vendor Partner'); ?> </h1>
                        </div>
                        <div class="col-md-3">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back To  Vendor Partner List', true) . "", array("action" => "individual"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php echo $this->Form->create($model, array('url' => array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_individual'), 'enctype' => 'multipart/form-data')); ?>
                    <?php echo $this->Form->input($model . ".user_role_id", array('type' => 'hidden')); ?>
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
                                <?php echo $this->Form->text($model . ".lastname", array('class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true,)); ?> 
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
                                <div class="input <?php echo ($this->Form->error('mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".mobile", array('class' => 'form-control validate[required]', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number',)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.mobile', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>


						<div class="col-md-6">
                            <div class="form-group<?php echo ($this->Form->error('alternate_mobile')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.alternate_mobile', __('Alternate Number', true) . '', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('alternate_mobile')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text($model . ".alternate_mobile", array('class' => 'form-control ', 'autocomplete' => 'off', 'title' => 'please enter 10 digit number',)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.alternate_mobile', array('wrap' => false)); ?> </span>
                                </div>
                            </div>						
                        </div>
						
						
						
						
                        <div class="col-md-6">							  
                            <div class="form-group<?php echo ($this->Form->error('email')) ? 'error' : ''; ?>">
                                <?php
                                echo $this->Form->label($model . '.email', __('Email ID', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->input($model . ".email", array('class' => 'form-control ', 'label' => false, 'type' => 'text')); ?> 
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
                                <div class="input" style=""> <?php echo $this->Form->file($model . ".image", array('class' => '', 'id' => 'uploadimage')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.image', array('wrap' => false)); ?> </span> 										
                                    <br>
                                    <?php
                                    $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                    $file_name = @$result[$model]['image'];
                                    $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                    $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                    if (is_file($file_path . $file_name)) {
                                        $images = $this->Html->image($image_url, array('alt' => 'Image', 'title' => "Image"));
                                        ?>
                                        <?php echo $images; ?>

                                        <?php
                                    } else {
                                        echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                    }
                                    ?>


                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="row">




                        <div class="col-md-12">
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
                                    <br>
                                    <?php
                                    $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                    $file_name = @$result[$model]['passport_proof_img'];
                                    $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                    $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                    if (is_file($file_path . $file_name)) {
                                        $images = $this->Html->image($image_url, array('alt' => 'Image', 'title' => "Image"));
                                        ?>
                                        <?php echo $images; ?>

                                        <?php
                                    } else {
                                        echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('identity_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Voter ID', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".identity_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'identity_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                    <br>
                                    <?php
                                    $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                    $file_name = @$result[$model]['identity_proof_img'];
                                    $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                    $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                    if (is_file($file_path . $file_name)) {
                                        $images = $this->Html->image($image_url, array('alt' => 'Image', 'title' => "Image"));
                                        ?>
                                        <?php echo $images; ?>

                                        <?php
                                    } else {
                                        echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('aadhar_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Aadhar Card', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".aadhar_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'aadhar_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                    <br>
                                    <?php
                                    $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                    $file_name =@$result[$model]['aadhar_proof_img'];
                                    $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                    $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                    if (is_file($file_path . $file_name)) {
                                        $images = $this->Html->image($image_url, array('alt' => 'Image', 'title' => "Image"));
                                        ?>
                                        <?php echo $images; ?>

                                        <?php
                                    } else {
                                        echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group<?php echo ($this->Form->error('license_proof_img')) ? 'error' : ''; ?>">
                                    <?php
                                    echo $this->Form->label($model . '.image', __('Driving License', true) . ' :', array('style' => ""));
                                    ?>
                                    <div class="input" style=""> <?php echo $this->Form->file($model . ".license_proof_img", array('class' => ' validate[validate[image/jpeg|image/png]]', 'id' => 'license_proof_img')); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error($model . '.identity_proof_img', array('wrap' => false)); ?> </span> 
                                    </div>
                                    <br>
                                    <?php
                                    $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                    $file_name = @$result[$model]['license_proof_img'];
                                    $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                    $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                    if (is_file($file_path . $file_name)) {
                                        $images = $this->Html->image($image_url, array('alt' => 'Image', 'title' => "Image"));
                                        ?>
                                        <?php echo $images; ?>

                                        <?php
                                    } else {
                                        echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                    }
                                    ?>
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
                                echo $this->Form->label('Company' . '.account_type', __('Account Type', true) . ' :', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('account_type')) ? 'error' : ''; ?>" style="" > 
                                    <?php echo $this->Form->select('Company' . '.account_type', array('savings' => 'Savings', 'current' => 'Current', 'cash_credit' => 'Cash Credit', 'over_draft' => 'Over Draft'), array('empty' => 'Select Account Type', 'class' => 'form-control')); ?> 
                                    <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error('Company' . '.account_type', array('wrap' => false)); ?> </span> </div>
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
                                <div class="input <?php echo ($this->Form->error('ifsc_code')) ? 'error' : ''; ?>" style="" > <?php echo $this->Form->text("Company" . ".ifsc_code", array('class' => 'form-control', 'maxlength' => 11,'min'=>11)); ?> <span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("Company" . '.ifsc_code', array('wrap' => false)); ?> </span> </div>
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
                        <div class="col-md-6 mult_chk">
                            <div class="form-group<?php echo ($this->Form->error('one_way')) ? 'error' : ''; ?>">	
							<?php 	echo $this->Form->input('OperationArea.id', array('type' => 'hidden',"id" => "","class" => ""));?>								
                                <?php
								//pr($default_zone_ids);
                                echo $this->Form->label("one_way", __('Select Zone', true) . ' :<span class="required"></span>', array('style' => ""));
                                ?>
                                <div class="input <?php echo ($this->Form->error('one_way')) ? 'error' : ''; ?>" style="" > <?php //echo $this->Form->select("OperationArea.zone_ids", $zones, array("class" => "form-control validate[required] chznone-select",'multiple',"default" =>$parentdata['OperationArea']['zone_ids'], 'empty' => "Select Zone", 'required'=>true)); ?>

								<?php echo $this->Form->select('OperationArea.to_zone_ids',$zones, array('type' => 'select','multiple', 'default' =>$default_zone_ids,'class' => 'form-control chznone-select', 'id' => 'to_zone_ids', 'div' => false, 'label' => false)); ?>									
								<span class="help-inline" style="color: #B94A48;"> <?php echo $this->Form->error("one_way", array('wrap' => false)); ?> </span> 
	
								 <?php echo $this->Form->input('OperationArea.zones', array("type" => "hidden","id" => "zones","class" => "zones"));?>
								</div>									
                            </div>
                        </div>
												
						<div class="col-md-6">  
							<div class="form-group mult_chk" id="citiesss">
								<?php 																	
								
								//pr($cities_list);
								if(!empty($cities_list)){?>
								<label class="control-label">Cities <span class="symbol required"></span></label>
								<?php echo $this->Form->select('OperationArea.to_cities_id',$cities_list, array('type' => 'select','multiple', 'default' =>$default_cities_list,'class' => 'form-control chzn-select', 'id' => 'to_cities_id', 'div' => false, 'label' => false)); ?>									
								<span id="to_cities_id-error" class="help-block"></span>
								<?php } echo $this->Form->input('OperationArea.city_ids', array("type" => "hidden","id" => "cities","class" => "cities"));?>
							</div>
                        </div> 
						
						
						<?php /*
                        <div class="col-md-6">  
                                <div class="form-group" id="citieslistdata"> 
								
									<?php echo $this->Form->input('to_cities_id', array('type' => 'select','multiple', 'options' =>$cities_list,'class' => 'form-control chzn-select', 'id' => 'to_cities_id', 'div' => false, 'label' => false)); ?> 					
								
									 <?php if(!empty($cities_list)){?>
											<label class="control-label">Cities <span class="symbol required"></span></label>
											<?php echo $this->Form->input('OperationArea.to_cities_id', array('type' => 'select','multiple', 'options' =>$cities_list,'class' => 'form-control chzn-select', 'id' => 'to_cities_id', 'div' => false, 'label' => false)); ?>                                 											
											<span id="to_cities_id-error" class="help-block"></span>
                                    <?php }	 ?>																			
                                </div>
                               
                        </div>
						 <?php echo $this->Form->input('OperationArea.city_ids', array('type' => 'hidden',"id" => "cities","class" => "cities"));?>
					
                        <div class="col-md-12">
                            <h2 class='heading' id="comind" style="margin-bottom: 16px; border-bottom: 2px solid #d5d5d5; padding: 8px 0; font-size: 18px;">
                                <?php
                                echo $this->Form->label('OperationCity.garage_address.0', __('Operational Address', true) . ' <span class="required"></span>', array('style' => ""));
                                ?>
                            </h2>
                        </div>



                        <div id="addresses" class="">

                            <?php
                            //pr($result['OperationCity']); exit;
                            if (!empty($result['OperationCity'])) {

                                for ($i = 0; $i < count($result['OperationCity']); $i++) {
                                    $lat = $result['OperationCity'][$i]['lat'];
                                    $addrs_id = $result['OperationCity'][$i]['id'];
                                    $lng = $result['OperationCity'][$i]['lng'];
                                    $state = $result['OperationCity'][$i]['state_id'];
                                    $city = $result['OperationCity'][$i]['city_id'];
                                    $address = $result['OperationCity'][$i]['garage_address'];
                                    ?>
                                    <script>
                                        getMap('<?php echo $lat; ?>', '<?php echo $lng; ?>', '<?php echo $state; ?>', '<?php echo $city; ?>', '<?php echo $address; ?>', '<?php echo $addrs_id; ?>', '');</script>
                                        <?php
                                }
                            } else {
                                ?>
                                <script>
                                    getMap('<?php echo $lat; ?>', '<?php echo $lng; ?>', '', '', '', '', '');</script>

                            <?php } ?>


                        </div>
                        <div class="col-md-12 <?php
                            if ($this->data[$model]["user_role_id"] == 5) {
                                echo "style='display:none'";
                            }
							
                            ?>">
							<?php /* ?>
                            <div class="col-sm-2" style="margin-left: 44px;"><a style="margin-top: 11px; margin-left: 26px;" id="add_more_address" class="btn btn-primary btn-sm" href="javascript:void(0)" ><strong>+</strong></a><span style="margin: 0px 7px; top: 15px; font-size: 14px;" class="loadings"></span></div>
							<?php */ ?>
                    <?php  /*   </div> */
					 ?>
                        <div class="col-md-12">
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
                                <?php echo $this->Html->link(__('Cancel ', true), array("action" => "individual"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
                            </div>
                        </div>
                    </div>		
                </div>
            </div>

            <?php echo $this->Form->end(); ?>

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
    var comp_current_type = parseInt($('#CompanyCompType').val());
    if (comp_current_type == 2 || comp_current_type == 3) {
        $('#CompanyCompPenCard').css('display', 'block');
        $('.comp_pen_lbl').css('display', 'block');
    }
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
<style type="text/css">
    #CompanyCompPenCard{
        display: none;
    }
    .comp_pen_lbl{
        display: none;
    }
</style>


