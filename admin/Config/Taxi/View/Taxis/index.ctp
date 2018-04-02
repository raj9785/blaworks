<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<div id="divForm" style="display:none">
    <div id="eventCal"></div>
</div>
<style>
    .yesitisbook {background: #ffb522 !important; color: #fff !important;}
    .yesitisbook a { font-weight:bold; color: #fff !important; }
    .noitisnotbook {background: green !important; color: #fff !important;}
    .noitisnotbook a { font-weight:bold; color: #fff !important; }

</style>
<script>
    $(document).ready(function () {
        $('#TaxiFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#TaxiToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#TaxiToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#TaxiFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });
        $(".super-raj-pop").fancybox({
            type: 'ajax',
            helpers: {
                overlay: {closeClick: false, locked: false},
                closeBtn: false,
            },
//            closeBtn: false, // hide close button
//            closeClick: false,
        });
    });

</script>

<script type='text/javascript'>

    $(document).ready(function () {
        $(".my").on('click', function () {
            var id = $(this).attr('id');

            $('#' + id).hide();
            $('#aja_' + id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'verified_ajax')); ?>",
                data: {'id': id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {

                    window.location.reload();

                },
                error: function (e) {
                    alert('fali');
                    window.location.reload();
                }
            });
        });



        $(".your").on('click', function () {
            //var id=$(this).attr('id');
            var id = $(this).attr('id').replace("y", "");
            ;

            $('#y' + id).hide();
            $('#v_aja_' + id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'payment_ajax')); ?>",
                data: {'id': id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {

                    if (subcat_data == 1)
                    {
                        $("#y" + id).attr('src', "<?php echo WEBSITE_URL . "img/veri.png"; ?>");
                        $("#y" + id).attr('title', "Click here for payment");
                    } else if (subcat_data == 2) {
                        alert("Cab Can not verified Please pay cab Attachment fee .");
                    } else
                    {
                        $("#y" + id).attr('src', "<?php echo WEBSITE_URL . "img/not_veri.gif"; ?>");
                        $("#y" + id).attr('title', "Click here for payment");
                    }

                    $('#v_aja_' + id).hide();
                    $('#y' + id).show();

                },
                error: function (e) {
                    alert('fali');
                    $('#v_aja_' + id).hide();
                }
            });
        });
        $(".my_status").on('click', function () {
            var id = $(this).attr('id');


            var main_status_id = id.split("_");
            var status_id = main_status_id[1];
            var img_src = $('#' + status_id).attr('src');
            var img_arr = img_src.split("/");
            var last_element = img_arr[img_arr.length - 1];
            if (last_element == 'veri.png')
            {


                $('#' + id).hide();
                $('#status_aja_' + status_id).show();
                $.ajax({
                    url: "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'status_ajax')); ?>",
                    data: {'id': status_id},
                    type: 'post',
                    //dataType:'json',
                    success: function (subcat_data) {

                        if (subcat_data == 1)
                        {
                            $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/active.png"; ?>");
                            $("#" + id).attr('title', "Click here for Inactive");
                        } else
                        {
                            $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/inactive.png"; ?>");
                            $("#" + id).attr('title', "Click here for Active");
                        }

                        $('#status_aja_' + status_id).hide();
                        $('#' + id).show();

                    },
                    error: function (e) {
                        alert('fali');
                        $('#status_aja_' + status_id).hide();
                    }
                });
            }
        });
        $("#TaxiStateId").on('change', function () {
            $("#TaxiCityId").empty();
            $("#TaxiCityId").attr('disabled', 'disabled');
            cat_id = $('#TaxiStateId').val();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'get_city')); ?>",
                data: {'cat_id': cat_id},
                type: 'post',
                dataType: 'json',
                success: function (subcat_data) {
                    options = "<option value=''><?php echo __('Select City'); ?></option>";
                    $.each(subcat_data, function (index, value) {
                        options += "<option value='" + index + "'>" + value + "</option>";
                    });
                    $("#TaxiCityId").empty().html(options);
                    $("#TaxiCityId").removeAttr('disabled');
                }
            });
        });
        $("#TaxiMyAction").on('change', function () {
            value = $(this).val();
            if (value == 'active') {
                $("#active").click();
            }
            if (value == 'inactive') {
                $("#inactive").click();
            }
            if (value == 'delete') {
                $("#delete").click();
            }
        });



    });
    function deletediv(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        swal({
            title: "Are you sure?",
            text: "Record will be deleted permanently",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'deleterow')); ?>',
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

    function change_status(id, status) {
        $('#ajatt_' + id).hide();
        $('#ajast_' + id).show();
        if (status != 1) {
            url = "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'change_status_active')); ?>";
        } else {
            url = "<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'change_status_inactive')); ?>";
        }

        $.ajax({
            url: url,
            data: {'id': id},
            type: 'post',
            dataType: 'json',
            success: function (subcat_data) {
                if (subcat_data.succ == 1) {
                    window.location.reload();
                } else {
                    swal({
                        title: "Error!",
                        text: subcat_data.msg,
                        type: "error",
                        showCancelButton: false,
                        confirmButtonColor: '#d6e9c6',
                        confirmButtonText: 'OK',
                        closeOnConfirm: false,
                    }, function () {
                        window.location.reload();
                    });
                }


            },
            error: function (e) {
                alert('fali');
                window.location.reload();
            }
        });
    }
    function active(msg, obj) {
        user_id = $(obj).attr('id').replace("active_", "");
        swal({
            title: "Are you sure?",
            text: "Status will be changed.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'change_status_active')); ?>',
                        data: 'id=' + user_id,
                        dataType: 'json',
                        success: function (data) {
                            if (data.succ == 1) {
                                swal({
                                    title: "Changed!",
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
    function inactive(msg, obj) {
        user_id = $(obj).attr('id').replace("inactive_", "");
        swal({
            title: "Are you sure?",
            text: "Status will be changed.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'change_status_inactive')); ?>',
                        data: 'id=' + user_id,
                        dataType: 'json',
                        success: function (data) {
                            if (data.succ == 1) {
                                swal({
                                    title: "Changed!",
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


    function verify_taxi(status, obj) {
        user_id = $(obj).attr('id').replace("verify_", "");
        var msg = "Vehicle will be verified";
        if (status == 1) {
            var msg = "Vehicle will be Verified";
            var hd_title = "Verified!";
        } else {
            var msg = "Vehicle will be Unverified";
            var hd_title = "Unverified!";
        }
        swal({
            title: "Are you sure?",
            text: msg,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'verify_taxi')); ?>',
                        data: {
                            'id': user_id,
                            'status': status,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data.succ == 1) {
                                swal({
                                    title: hd_title,
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
    function check_Taxi(tid) {
        // tid stand for taxi id or pk
        $(".fancyBox").fancybox({
            type: 'ajax',
            ajax: {
                type: "POST",
                url: '/taxis/taxi/showevents/' + tid,
                dataType: "html", // Expected response type
                success: function (response) {
                    alert(1);
                    console.log(1);
                },
                error: function (response) {
                    alert(2);
                    console.log(2);

                }
            }
        });
    }
    function confirmDelete() {
        return confirm("Are you sure you want to delete these?");
    }
    function confirmActive() {
        return confirm("Are you sure you want to active these?");
    }
    function confirmInactive() {
        return confirm("Are you sure you want to inactive these?");
    }

    function ck(id) {
        $("#VendorVehicleTaxiId").val(id);
    }

</script>
<style>
    .input-sm{margin: 5px 5px; width: 18% !important;}
</style>
<div id="app">
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">ADD Taxi to Vendor</h4>
                </div>
                <?php echo $this->Form->create("VendorVehicle", array('onsubmit' => 'return false', 'url' => array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'add_vehicle'), 'enctype' => 'multipart/form-data'));
                ?>

                <div class="modal-body">
                    <h5 id="msg" style="display:none;color:green;"></h5>
                    <?php echo $this->Form->input('taxi_id', array('type' => 'hidden', 'class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true, 'empty' => 'Select', 'tabindex' => 1)); ?>
                    <div class="form-group">
                        <label class="control-label">Select Vendor <span class="symbol required"></span></label>
                        <?php echo $this->Form->input('vendor_id', array('type' => 'select', 'options' => $vlarray, 'class' => 'form-control validate[required]', 'div' => false, 'label' => false, 'required' => true, 'empty' => 'Select', 'tabindex' => 1)); ?>
                        <span id="vendor_id-error" class="help-block"></span>
                    </div>
                </div>

                <div class="modal-footer">
                    <div id="loader" style="display:none;"><?php echo $this->Html->image("loader.png"); ?></div>
                    <?php echo $this->Form->button('Save <i class="fa fa-arrow-circle-right"></i>', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                </div>
                <?php
                echo $this->Form->end();
                ?>
            </div>

        </div>
    </div>

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
                            <h1 class="mainTitle">Vehicles List</h1>
                        </div>

                        <div class="col-sm-4 text-align-right">
                            <?php
                            $can_take_action = 1;
                            if ($loggedin_user['user_role_id'] != 1) {
                                if ($loggedin_user['vehicle_verification'] != 1) {
                                    $can_take_action = 0;
                                }
                            }
                            if ($can_take_action) {
                                echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Vehicle', true) . "", array('plugin' => "taxi", 'controller' => 'taxis', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false));
                            }
                            ?>
                        </div>

                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">

                    <?php
                    echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                //echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => __('Search By Status', true), 'class' => 'form-control input-medium')) . '&nbsp;';
                                echo $this->Form->select('Taxi.state_id', $state, array("default" => $state_id_selected, 'empty' => __('Select State', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.city_id', $city, array("default" => $city_id_selected, 'empty' => __('Select City', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.motor_type_id', $motor_type_id, array("default" => $motor_type_id_selected, 'empty' => __('Vehicle Type', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->select('Taxi.motor_id', $motors, array("default" => $motor_id_selected, 'empty' => __('Vehicle Manufacturer', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->select('Taxi.motor_model_id', $motor_model_id, array("default" => $motor_model_id_selected, 'empty' => __('Vehicle Model', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('plate_no', array('value' => isset($plate_no_selected) && $plate_no_selected ? $plate_no_selected : '', 'placeholder' => __('Vehicle Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('uniqid', array('value' => isset($uniqid) && $uniqid ? $uniqid : '', 'placeholder' => __('Vendor ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.company_id', $company, array("default" => $company_id_selected, 'empty' => __('Vendor Name', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.status', array("2" => "Pending", "1" => "Active", "0" => "Inactive"), array('value' => @$this->params->named['status'], 'empty' => __('Vehicle Status', true), 'class' => 'form-control input-sm new-style')) . '&nbsp;&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.verified', array("2" => "Pending", "1" => "Verified", "0" => "Not Verified"), array('value' => @$this->params->named['verified'], 'empty' => __('Verification Status', true), 'class' => 'form-control input-sm new-style')) . '&nbsp;&nbsp;';

                                echo $this->Form->select('Taxi.gps_availability', $gps_status_options, array('value' => @$gps_availability, 'empty' => __('GPS Status', true), 'class' => 'form-control input-sm new-style')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Taxi.ownership_type', array(1=>'Vendor Cum Owner',2=>'Driver Cum Owner',3=>'Other'), array("default" => isset($ownership_type) && $ownership_type ? $ownership_type : '', 'empty' => __('Ownership Type', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false));
                                ?>
                                &nbsp;&nbsp;<a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Reset</a>
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'getpdf', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id_selected, 'city_id' => @$city_id_selected, 'motor_type_id' => @$motor_type_id_selected, 'motor_id' => @$motor_id_selected, 'motor_model_id' => @$motor_model_id_selected, 'driverid' => @$driverid, 'company_id' => @$company_id_selected, 'plate_no' => @$plate_no_selected, 'uniqid' => @$uniqid, 'status' => @$this->params->named['status'], 'verified' => @$this->params->named['verified'], 'from_date' => @$from_date, 'to_date' => @$to_date)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style-top2', 'escape' => false)) . "&nbsp;";
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'getcsv', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id_selected, 'city_id' => @$city_id_selected, 'motor_type_id' => @$motor_type_id_selected, 'motor_id' => @$motor_id_selected, 'motor_model_id' => @$motor_model_id_selected, 'driverid' => @$driverid, 'company_id' => @$company_id_selected, 'plate_no' => @$plate_no_selected, 'uniqid' => @$uniqid, 'status' => @$this->params->named['status'], 'verified' => @$this->params->named['verified'], 'from_date' => @$from_date, 'to_date' => @$to_date)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style-top', 'escape' => false));

                                echo $this->Form->end();
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>		    
                    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                        <thead>
                            <tr style="height:30px;">
                               	<th class="hidden-xs" width="5%">S.No.<?php //echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall'));            ?></th>

                                <th class="hidden-xs">State</th>
                                <th class="hidden-xs">City</th>
                                <th class="hidden-xs">Vehicle Type</th>
<!--                                <th class="hidden-xs">Vehicle Model</th>-->
                                <th class="hidden-xs">Vehicle Number</th>
                                    <!--<th class="hidden-xs">Plate Type</th>-->
                                <th class="hidden-xs">Vendor ID </th>
                                <th class="hidden-xs">Vendor Name</th>
                                <th class="hidden-xs">Driver</th>
                                <th class="hidden-xs">Created On</th> 
                                <th class="hidden-xs">GPS</th>
                                <th class="hidden-xs">Status</th>
                                <th class="hidden-xs"><?php echo __('Verified'); ?></th>

                                <th class="hidden-xs"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody >
                            <?php
                            if (!empty($result)) {
                                $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
                                if ($page == 0 || $page == 1) {
                                    $i = $count_new_bookings;
                                } else {
                                    //echo $count_new_bookings;
                                    $i = $count_new_bookings - $limit * ($page - 1);
                                }
                                foreach ($result as $records) {

                                    //pr($records);
                                    ?>
                            <tr style="height:30px;" class="gallerytr">
                                <td><?php echo $i; //echo $this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id']));            ?></td>
                                <td>
                                            <?php echo $records["UserState"]['state_name']; ?>
                                </td> 
                                <td>
                                            <?php echo $records["UserCity"]['city_name']; ?>
                                </td> 

                                <td>

                                            <?php echo $records["Taxi"]['motor_type'] . " (" . $records["Taxi"]['capacity'] . " Seater)"; ?>

                                </td>


<!--                                        <td>
                                            <?php //echo $records["Taxi"]['motor_model']; ?>
                                        </td> -->
                                <td> <?php echo $this->Html->link($records[$model]['plate_no'], array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'detail', $records[$model]['id']), array('class' => '', 'escape' => false));
                                            ?></td>


                                <td>
                                            <?php echo $records['Taxi']['uniqid']; ?>
                                </td>
                                <td>
                                            <?php echo $this->Html->link($records['Company']['name'], array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'taxi_chats', $records[$model]['id']), array('title' => 'Vehicle Updates', 'escape' => false));
                                            ?>

                                </td>
                                <td>
                                            <?php if(!empty($records['User']['id'])){?>
                                            <?php echo ucfirst($records['User']['firstname']).' '.ucfirst($records['User']['lastname']);?><br><a href="<?php echo WEBSITE_URL; ?>admin/taxi/taxis/driver_lists/<?php echo $records['Taxi']['id']; ?>/<?php echo $records['Taxi']['company_id']; ?>"  title="Driver Lists" class="btn btn-info btn-orange super-raj-pop"><?php echo 'Reassign Driver';?></a>
                                            <?php }else{ ?>
                                    <a href="<?php echo WEBSITE_URL; ?>admin/taxi/taxis/driver_lists/<?php echo $records['Taxi']['id']; ?>/<?php echo $records['Taxi']['company_id']; ?>"  title="Driver Lists" class="btn btn-info super-raj-pop">Assign Driver</a>
                                            <?php }?>
                                </td>

                                <td><?php echo date(DATE_FORMAT, $records[$model]['created']); ?></td>


                                        <?php
                                        $can_take_action = 1;
                                        if ($loggedin_user['user_role_id'] != 1) {
                                            if ($loggedin_user['vehicle_verification'] != 1) {
                                                $can_take_action = 0;
                                            }
                                        }
                                        ?>

                                <td style="text-align: center;">

                                            <?php
                                            //echo $records['Taxi']['status']."--".$records['Taxi']['status_by_admin']."ssssss";
                                            if ($records['Taxi']['gps_availability'] == 1) {
                                                $status_img = 'active.png';
                                                $title = "Installed";
                                            } else if ($records['Taxi']['gps_availability'] == 2) {
                                                $status_img = 'not_like.png';
                                                $title = "Not Interested";
                                            } else if ($records['Taxi']['gps_availability'] == 3) {
                                                $status_img = 'interested.png';
                                                $title = "Interested in Installation";
                                            } else if ($records['Taxi']['gps_availability'] == 4) {
                                                $status_img = 'inactive.png';
                                                $title = "Not Installed";
                                            } else {
                                                $status_img = 'hold.png';
                                                $title = "Response Pending";
                                            }
                                            ?>
                                    <img title="<?php echo $title; ?>" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
                                </td>

                                <td style="text-align: center;">

                                            <?php
                                            //echo $records['Taxi']['status']."--".$records['Taxi']['status_by_admin']."ssssss";
                                            if ($records['Taxi']['status'] == 1 && $records['Taxi']['status_by_admin'] == 1) {
                                                $status_img = 'active.png';
                                                $chang = "Active";
                                                $title = "Inactivate";
                                            } else if ($records['Taxi']['status'] == 0 && $records['Taxi']['status_by_admin'] == 0) {
                                                $status_img = 'inactive.png';
                                                $chang = "Inactivated By Admin";
                                                $title = "Activate";
                                            } else if ($records['Taxi']['status'] == 2) {
                                                $status_img = 'hold.png';
                                                $chang = "Pending For Approval";
                                                $title = "Approve";
                                            } else {
                                                $status_img = 'inactive.png';
                                                $chang = "Inactive";
                                                $title = "Activate";
                                            }
                                            ?>
                                            <?php
                                            if ($can_take_action == 1) {
                                                ?>
                                    <img title="Click here to <?php echo $title; ?>" style="cursor:pointer;" id="ajatt_<?php echo $records[$model]['id']; ?>" class="status_change" onclick="return change_status(<?php echo $records[$model]['id']; ?>,<?php echo $records['Taxi']['status']; ?>)" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
                                    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"  id="ajast_<?php echo $records[$model]['id']; ?>" style="display:none;" />
                                            <?php } else { ?>
                                    <img title="<?php echo $chang; ?>" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
                                            <?php } ?> 
                                </td>
                                <td style="text-align: center;">

                                            <?php
                                            if ($records['Taxi']['verified'] == 1) {
                                                $veri_img = 'active.png';
                                                $chang = "Unverify";
                                            } else if ($records['Taxi']['verified'] == 2) {
                                                $veri_img = 'hold.png';
                                                $chang = "Approve";
                                            } else {
                                                $veri_img = 'inactive.png';
                                                $chang = "Verify";
                                            }
                                            ?>
                                            <?php
                                            if ($can_take_action == 1) {
                                                ?>
                                    <img title="Click here to <?php echo $chang; ?>" style="cursor:pointer;" class="my" id="<?php echo $records[$model]['id']; ?>" src="<?php echo WEBSITE_URL . "img/" . $veri_img; ?>" width="20" height="20" />
                                    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"  id="aja_<?php echo $records[$model]['id']; ?>" style="display:none;" />
                                            <?php } else { ?>
                                    <img title="<?php echo $chang; ?>" src="<?php echo WEBSITE_URL . "img/" . $veri_img; ?>" width="20" height="20" />
                                            <?php } ?>
                                </td>

                                <td>
                                        <!--<button onclick="ck(this.id);" style="width:auto;font-size:10px;" id="<?php //echo $records[$model]['id'];            ?>" type="button" class="btn btn-info btn-lg pop" data-toggle="modal" data-target="#myModal">Add To Vendor</button>-->

                                    <div class="dropdown" style='float:left'>
                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                           style='text-decoration:none'>
                                                    <?php echo __('Action'); ?> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li>								
                                                        <?php
                                                       // echo $this->Html->link('Edit' . __('', true), array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'edit', $records[$model]['id']), array('class' => '', 'escape' => false));

														echo $this->Html->link('Edit' . __('', true), array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'edit',$records[$model]['id'],"?"=>$query_data ), array('class' => '', 'escape' => false));
                                                        ?>	   

                                            </li>

                                                    <?php
                                                    if ($can_take_action == 1) {
                                                        ?>
                                            <li>
                                                            <?php if ($records[$model]['verified'] == 1) { ?>	
                                                <a href='javascript:void(0)' onclick='return verify_taxi(0, this);' id='verify_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to unverify.">Unverify</a>
                                                            <?php } else { ?> 
                                                <a href='javascript:void(0)' onclick='return verify_taxi(1, this);' id='verify_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to verify.">Verify</a>	
                                                            <?php } ?>
                                            </li>




                                            <li>
                                                            <?php if ($records["Taxi"]['status'] == 1) { ?>	
                                                <a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactivte this TaxiColor?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactivate.">Inactivate</a>
                                                            <?php } else { ?> 
                                                <a href='javascript:void(0)' onclick='return active("Are you sure you want to activate this TaxiColor?", this);' id='active_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to activate.">Activate</a>	
                                                            <?php } ?>
                                            </li>

                                                    <?php } ?>
                                            <!--                                                    <li>
                                                                                                    <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this TaxiColor?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete.">Delete</a>
                                                                                                </li>-->


                                        </ul>
                                    </div>	


                                </td>
                            </tr>
                                    <?php
                                    $i--;
                                }
                                ?>
                            <tr>
                                <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                            </tr>

                                <?php
                            } else {
                                ?>
                            <tr>
                                <td align="center" style="text-align:center;" colspan="20" class=""><?php echo __('No Result Found'); ?></td>
                            </tr>
                            <?php } ?>   
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>


<script>

    var checkboxes = $("input[type='checkbox']"),
            submitButt = $("input[type='submit']");

    checkboxes.click(function () {
        submitButt.attr("disabled", !checkboxes.is(":checked"));
    });
    $('#selectall').click(function () {
        submitButt.attr("disabled", !checkboxes.is(":checked"));
    });
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
        $('.case').attr('checked', this.checked);
        if ($(".case:checked").length == 0)
        {
            $('input[type="submit"]').attr('disabled', 'disabled');
        }
    });
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function () {
        if ($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }

    });


    $("#VendorVehicleIndexForm").on("submit", function () {
        var other_data = $(this).serialize();
        $.ajax({
            beforeSend: function () {
                $("#loader").show();
            },
            url: '<?php echo $this->Html->url(array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'add_vehicle')); ?>',
            type: 'post',
            data: other_data,
            success: function (res) {
                $("#loader").hide();
                if (res == 1) {
                    $("#msg").html("Vehicle assigned to Vendor successfully");
                } else if (res == 0) {
                    $("#msg").html("Unable to assigne vehicle to Vendor ! Try Again");
                    $("#msg").css('color', '#ff0000');
                } else if (res == 2) {
                    $("#msg").html("This vehicle is already exist");
                    $("#msg").css('color', '#ff0000');
                }
                $("#msg").show();

                setTimeout(function () {
                    $("#msg").hide();
                    $("#VendorVehicleIndexForm")[0].reset();
                }, 2000);

            },
            error: function (err) {
                $("#loader").hide();
                $("#msg").html("Unable to assigne vehicle to Vendor ! Try Again");
                $("#msg").css('color', '#ff0000');
                $("#msg").show();

            }

        });
    });




</script>


