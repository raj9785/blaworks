<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<style>
    .yesitisbook {
        background: red !important;
        color: #fff !important;
    }

    .yesitisbook a {
        font-weight: bold;
        color: #fff !important;
    }

    .noitisnotbook {
        background: green !important;
        color: #fff !important;
    }

    .noitisnotbook a {
        font-weight: bold;
        color: #fff !important;
    }

</style>
<SCRIPT language="javascript">
    $(function () {

        $(".super-raj-pop").fancybox({
            type: 'ajax',
            helpers: {
                overlay: {closeClick: false, locked: false},
                closeBtn: false,
            },
//            closeBtn: false, // hide close button
//            closeClick: false,
        });
       /*  $('#UsermgmtFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#UsermgmtToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#UsermgmtToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#UsermgmtFromDate").datepicker("option", "maxDate", selectedDate);
            }

        }); */
		
		
		
		$('#UsermgmtFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,            
            maxDate: '<?php echo MAX_DATE_RANGE; ?>',
            onSelect: function (selectedDate) {
                var nyd = new Date(selectedDate);
                nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
                $('#UsermgmtToDate').datepicker("option", {
                    minDate: new Date(selectedDate),
                    maxDate: nyd
                });
              
                //$("#UsermgmtToDate").datepicker("option", "minDate", selectedDate);
            },
        });
		$('#UsermgmtToDate').datepicker({
            dateFormat: "yy-mm-dd",
            //dateFormat: "dd-mm-yy",
            changeMonth: true,
            changeYear: true,
			minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
            onClose: function (selectedDate) {
                $("#UsermgmtFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });
		

        $(".my_status").on('click', function () {
            var id = $(this).attr('id');

            $('#' + id).hide();
            var main_status_id = id.split("_");
            var status_id = main_status_id[1];
            $('#status_aja_' + status_id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'status_ajax')); ?>",
                data: {'id': status_id},
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

        $(".my").on('click', function () {
            var id = $(this).attr('id');
            var license_no = $("#license_no_" + id).val();
            if (license_no == '' || license_no == 'NA') {
                alert("Please Update License No. To Verify driver");
                return false;
            }


            $('#' + id).hide();
            $('#v_aja_' + id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'verified_ajax')); ?>",
                data: {'id': id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {
                    if(subcat_data==1){
                    window.location.reload();
                    }else{
                        alert("You can not verify");
                        window.location.reload();
                    }
                },
                error: function (e) {
                    alert('fali');
                    window.location.reload();
                }
            });
        });

        $("#UsermgmtMyAction").on('change', function () {
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




    });
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
    function show_message(msg, obj) {
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
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_status')); ?>',
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

    function verify_driver(status, obj) {
        user_id = $(obj).attr('id').replace("verify_", "");
        var msg = "Driver will be verified";
        if (status == 1) {
            var msg = "Driver will be Verified";
            var hd_title = "Verified!";
        } else {
            var msg = "Driver will be Unverified";
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
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'verified_ajax')); ?>',
                        data: {
                            'id': user_id,
                            'status': status,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data == 1) {
                                swal({
                                    title: hd_title,
                                    text: "Driver Verified",
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
                                    text: "You can not verify",
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
	
	function block_driver(status, obj) {
        user_id = $(obj).attr('id').replace("block_", "");
      
        var msg = "Driver will be Blocked";
		 var hd_title = "Blocked!";
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
				url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'block_driver')); ?>',
				data: {
					'id': user_id,
					'status': status,
				},
				dataType: 'json',
				success: function (data) {
					
					if (data == 1) {
						//alert(data);
						swal({
							title: hd_title,
							text: "Driver Blocked",
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
							text: "You can not Blocked",
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

    function move_to_dco(status, obj) {
        user_id = $(obj).attr('id').replace("move_to_dco_", "");
        var msg = "Driver will be move to DCO";
        var hd_title = "MOve TO DCO!";
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
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'move_to_dco')); ?>',
                        data: {
                            'id': user_id,
                            'status': status,
                        },
                        dataType: 'json',
                        success: function (data) {
                            if (data == 1) {
                                swal({
                                    title: hd_title,
                                    text: "Driver moved to DCO",
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
                                    text: "Error occurred please try again",
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

    function delete_user(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        swal({
            title: "Are you sure?",
            text: "Driver will be deleted permanently",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'delete_driver')); ?>',
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



    function confirmDelete() {
        return confirm("Are you sure you want to delete these?");
    }
    function confirmActive() {
        return confirm("Are you sure you want to active these?");
    }
    function confirmInactive() {
        return confirm("Are you sure you want to inactive these?");
    }
</SCRIPT>
<style>
    .input-sm{margin: 5px 5px; width: 18% !important;}
</style>
<?php
$can_edit = 1;
if ($loggedin_user['user_role_id'] != 1) {
    if ($loggedin_user['edit_driver'] != 1) {
        $can_edit = 0;
    }
}

$can_add = 1;
if ($loggedin_user['user_role_id'] != 1) {
    if ($loggedin_user['add_driver'] != 1) {
        $can_add = 0;
    }
}
?>
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
                            <h1 class="mainTitle">Driver List</h1>
                        </div>
                        <?php
                        if ($can_add == 1) {
                            ?>
                            <div class="col-sm-4 text-align-right">
                                <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Driver', true) . "", array('plugin' => false, 'controller' => 'driver', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white table_top_margin">
                    <?php
                    echo $this->Form->create($model, array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                echo $this->Form->select('state_id', $states, array('value' => isset($state_id) ? $state_id : '', 'class' => 'textbox form-control input-sm', 'empty' => __('Select State', true), 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('city_id', $city, array('value' => isset($city_id) ? $city_id : '', 'class' => 'textbox form-control input-sm', 'empty' => __('Select City', true), "style" => "width: 184px;", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('driver_uniqid', array('value' => isset($driver_uniqid) ? $driver_uniqid : '', 'placeholder' => __('Driver ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('driver_firstname', array('value' => isset($driver_firstname) ? $driver_firstname : '', 'placeholder' => __('Driver Name', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('driver_mobile', array('value' => isset($driver_mobile) ? $driver_mobile : '', 'placeholder' => __('Mobile Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('license_no', array('value' => isset($license_no) ? $license_no : '', 'placeholder' => __('Driving License Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('vendor_uniqid', array('value' => isset($vendor_uniqid) ? $vendor_uniqid : '', 'placeholder' => __('Vendor ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->text('vendor_firstname', array('value' => isset($vendor_firstname) ? $vendor_firstname : '', 'placeholder' => __('Vendor Name', true), 'class' => 'form-control input-sm'));
                                echo $this->Form->select('vendor_firstname', $company, array("default" => isset($vendor_firstname) ? $vendor_firstname : '', 'empty' => __('Vendor Name', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('status', array('2' => 'Pending', '1' => 'Active', '0' => 'Inactive'), array('value' => isset($status) ? $status : '', 'empty' => __('Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('verified', array('2' => 'Pending', '1' => 'Verified', '0' => 'Not-Verified', '3' => 'Blocked'), array('value' => isset($verified) ? $verified : '', 'empty' => __('Verification Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('from_date', array('placeholder' => __('From', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                ?>
                                &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search')); ?>
                                <a class="btn btn-green add-row new-style" href="<?php echo $this->Html->url(array('action' => 'driver')); ?>">Reset</a>

                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getpdf_driver', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'driver_uniqid' => @$driver_uniqid, 'driver_firstname' => @$driver_firstname, 'driver_mobile' => @$driver_mobile, 'vendor_uniqid' => @$vendor_uniqid, 'vendor_firstname' => @$vendor_firstname, 'status' => @$status, 'verified' => @$verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false)) . "&nbsp;";

                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getcsv_driver', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'driver_uniqid' => @$driver_uniqid, 'driver_firstname' => @$driver_firstname, 'driver_mobile' => @$driver_mobile, 'vendor_uniqid' => @$vendor_uniqid, 'vendor_firstname' => @$vendor_firstname, 'status' => @$status, 'verified' => @$verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>

                    <div style="width:100% !important;overflow-y:auto"> 
                        <table class="table table-striped table-bordered  table-full-width"  id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                            <thead>
                                <tr>
                                    <!-- <th><?php echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall')); ?></th> -->
                                    <th class="hidden-xs">S.No.</th>
                                    <th class="hidden-xs" width="10%">Image</th>                              
                                    <th class="hidden-xs">State</th>
                                    <th class="hidden-xs">City</th>
                                    <th class="hidden-xs">Driver ID</th>
                                    <th class="hidden-xs">Driver Name</th>
                                    <th class="hidden-xs">Mobile Number</th>
                                    <th class="hidden-xs">Driving License Number</th>
                                    <th class="hidden-xs">Age</th>
                                    <th class="hidden-xs">Rating</th>
                                    <th class="hidden-xs">Registered On</th>
                                    <th class="hidden-xs">Vendor ID</th>
                                    <th class="hidden-xs">Vendor Name</th>
<!--                                    <th class="hidden-xs">Total Booking</th>-->
                                                                        <!--<th class="hidden-xs">Calender Status</th>-->
                                    <th class="hidden-xs">Status</th>
                                    <th class="hidden-xs">Verified</th>
                                    <th class="hidden-xs"><?php echo __('Action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($result)) {
                                    $count_new_bookings = $this->Paginator->counter(array('format' => '%count%'));
                                    if ($page == 0 || $page == 1) {
                                        $i = $count_new_bookings;
                                    } else {
                                        $i = $count_new_bookings - $limit * ($page - 1);
                                    }
                                    ?>
                                    <?php
                                    foreach ($result as $records) {
                                        //pr($records);
										
                                        ?>
                                        <tr style="height:30px;" class="gallerytr">
                                            <!-- <td>
                                            <?php //echo $this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id'])); ?>
                                            </td> -->
                                            <td><?php echo $i; ?></td>
                                            <td align="left">
                                                <?php
                                                //Configure::write('debug', 2);
                                                //pr($records['UserDocument']);
                                                if (isset($records[$model]['image']) && !empty($records[$model]['image'])) {
                                                    ?>
                                                    <?php
                                                    $file_path = WEBSITE_APP_WEBROOT_ROOT_PATH . DS . 'uploads' . DS . 'drivers' . DS . 'photos' . DS;
                                                    $file_name = $records[$model]['image'];
                                                    if (file_exists($file_path . $file_name)) {
                                                        //echo $records[$model]['image'];
                                                        echo $this->Html->image(WEBSITE_URL . 'uploads/drivers/photos/' . $file_name, array('alt' => $records[$model]['firstname'], 'title' => $records[$model]['firstname'], 'width' => 65, 'height' => 65));
                                                        ;
                                                        ?>
                                                        <?php
                                                    } else {
                                                        echo $this->Html->image('no_image.jpg', array('width' => '65px', 'height' => '65px'));
                                                    }
                                                } else {

                                                    $file_name = '';
                                                    if (isset($records["UserDocument"]) && !empty($records["UserDocument"])) {
                                                        foreach ($records["UserDocument"] as $UserDocument) {
                                                            if ($UserDocument['type'] == 8) {
                                                                $file_name = $UserDocument['document_image'];
                                                            }
                                                        }
                                                    }

                                                    if (isset($file_name) && !empty($file_name)) {
                                                        $file_path = USERDOCS;
                                                        //$file_name = $records['UserDocument'][0]['document_image'];

                                                        $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 65, 65, base64_encode($file_path), $file_name), true);
                                                        $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                                        if (is_file($file_path . $file_name)) {

                                                            $images = $this->Html->image($image_url, array('alt' => $records[$model]['firstname'], 'title' => $records[$model]['firstname']));
                                                            ?>
                                                            <a id="single_1" href="<?php echo $big_image_url; ?>" title='<?php echo ucfirst($records[$model]['firstname']); ?>'>
                                                                <?php echo $images; ?>
                                                            </a>
                                                            <?php
                                                        } else {
                                                            echo $this->Html->image('no_image.jpg', array('width' => '65px', 'height' => '65px'));
                                                        }
                                                    } else {
                                                        echo $this->Html->image('no_image.jpg', array('width' => '65px', 'height' => '65px'));
                                                    }
                                                }
                                                ?>

                                            </td> 

                                            <td align="left">
                                                <?php
                                                if (!empty($records["UserState"]['state_name'])) {
                                                    echo $records["UserState"]['state_name'];
                                                } else {
                                                    echo 'N.A';
                                                }
                                                ?>
                                            </td>
                                            <td align="left">
                                                <?php
                                                if (!empty($records["UserCity"]['city_name'])) {
                                                    echo $records["UserCity"]['city_name'];
                                                } else {
                                                    echo 'N.A';
                                                }
                                                ?>
                                            </td>
                                            <td align="left">
                                                <?php echo ($records[$model]['uniqid']) ? $records[$model]['uniqid'] : 'N.A'; ?>
                                            </td>
                                            <td align="left">
                                                <?php echo $this->Html->link($records[$model]['firstname'] . ' ' . $records[$model]['lastname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_driver', $records[$model]['id']), array('class' => '', 'escape' => false)); ?>

                                            </td>
                                            <td align="left">
                                                <?php $vehicle_cat = ($records[$model]['mobile']) ? $records[$model]['mobile'] : 'N.A'; ?>
                                                <a href="<?php echo WEBSITE_URL; ?>admin/usermgmt/usermgmt/view_logs/<?php echo $records[$model]['id'] . "/" . $records[$model]['uniqid']; ?>"  title="Driver History" class="super-raj-pop"><?php echo $vehicle_cat; ?></a>
                                            </td>

                                            <td align="left">
                                                <?php
                                                echo $records[$model]['license_no'];

                                                echo $this->Form->input('license_no', array('type' => 'hidden', 'id' => 'license_no_' . $records[$model]['id'], 'value' => $records[$model]['license_no']));
                                                ?>



                                            </td>
                                            <td align="left">
                                                <?php
                                                $current_year = date('Y');
                                                $dob_year = date('Y', strtotime($records[$model]['dob']));
                                                echo $current_year - $dob_year;
                                                ?>
                                            </td>
											<td>
											<?php //echo   $records[$model]['avgRating'];
						 echo ($records[$model]['avgRating']) ? number_format($records[$model]['avgRating'],1) : '0'; 



											?>	
											
											</td>
											
                                            <td align="left">
                                                <?php echo date(DATE_FORMAT, strtotime($records[$model]['created'])); ?>
                                            </td>
                                            <td align="left">
                                                <?php echo ($records['Vendor']['uniqid']) ? $records["Vendor"]['uniqid'] : 'N.A'; ?>
                                            </td>
                                            <td align="left">
                                                <?php echo $records["Vendor"]['firstname'] . ' ' . $records["Vendor"]['lastname']; ?>
                                            </td>
        <!--                                            <td align="left">
                                            <?php //echo $records[$model]['total_booking']; ?>
                                            </td>-->

                                            <?php
                                            $can_take_action = 1;
                                            if ($loggedin_user['user_role_id'] != 1) {
                                                if ($loggedin_user['driver_verification'] != 1) {
                                                    $can_take_action = 0;
                                                }
                                            }
                                            ?>
                                            <td style="text-align: center;">
                                                <?php
                                                //echo $records[$model]['status']."--".$records[$model]['status_by_admin']."ssssss";
                                                if ($records[$model]['status'] == 1 && $records[$model]['status_by_admin'] == 1) {
                                                    $status_img = 'active.png';
                                                    $chang = "Active";
                                                    $title = "Inactivate";
                                                } else if ($records[$model]['status'] == 0 && $records[$model]['status_by_admin'] == 0) {
                                                    $status_img = 'inactive.png';
                                                    $chang = "Inactivated By Admin";
                                                    $title = "Activate";
                                                } else if ($records[$model]['status'] == 2) {
                                                    $status_img = 'hold.png';
                                                    $chang = "Pending For Approval";
                                                    $title = "Approve";
                                                } else {
                                                    $status_img = 'inactive.png';
                                                    $chang = "Inactivate";
                                                    $title = "Activate";
                                                }
                                                //my_status //status_aja_
                                                ?>
                                                <?php
                                                if ($can_take_action == 1) {
                                                    ?>
                                                    <img style="cursor:pointer;" id="changestatus_<?php echo $records[$model]['id']; ?>" title="Clik here to <?php echo $title; ?>" class="my_status" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
                                                    <img src="<?php echo WEBSITE_URL . "/img/ajax.gif"; ?>" id="status_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                                <?php } else { ?>
                                                    <img title="<?php echo $chang; ?>" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
                                                <?php } ?>
                                            </td>
                                            <td style="text-align: center;">

                                                <?php
												
												//echo $records[$model]['verified']; 
												
                                                if ($records[$model]['verified'] == 1) {
                                                    $veri_img = 'active.png';
                                                    $chang = "Unverify";
                                                } else if ($records[$model]['verified'] == 2) {
                                                    $veri_img = 'hold.png';
                                                    $chang = "Approve";
                                                } else if ($records[$model]['verified'] == 3) {
                                                    $veri_img = 'blocked.png';
                                                    $chang = "Blocked";
                                                } else {
                                                    $veri_img = 'inactive.png';
                                                    $chang = "Verify";
                                                }
                                                ?>
                                                <?php    
                                                if ($can_take_action == 1) {
                                                    ?>
													<?php if ($records[$model]['verified'] == 3) { ?>
													
														<img title="Blocked" class="myblocked" id="<?php echo $records[$model]['id']; ?>" src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="18" height="18"/>
													
														
													<?php }else{ ?>
													
														<img title="Click here to <?php echo $chang; ?>" style="cursor:pointer;" class="my" id="<?php echo $records[$model]['id']; ?>" src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="20" height="20"/>
														<img src="<?php echo WEBSITE_URL . "/img/ajax.gif"; ?>" id="v_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
														
													<?php }?>
													
                                                <?php } else { ?>
												
                                                    <img  src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="20" height="20"/>
													
                                                <?php } ?>
                                            </td>
                                            <td align="center">
											<?php if( $records[$model]['verified'] == 3){ ?>
											
													<h4>Blocked</h4>
											
											<?php }else{  ?>										
                                                <div class="dropdown" style='float:left'>
                                                    <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                       data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                       style='text-decoration:none'>
                                                        <?php echo __('Action'); ?> <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                        <?php
                                                        if ($can_edit == 1) {
                                                            ?>
                                                            <li><?php
                                                                echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_driver', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                                ?>
                                                            </li>
                                                        <?php } ?>

                                                        <?php 
                                                        if ($can_take_action == 1) {   
                                                            ?>
                                                            <li>
                                                                <?php if ($records[$model]['verified'] == 1) { ?>	
                                                                    <a href='javascript:void(0)' onclick='return verify_driver(0, this);' id='verify_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to unverify.">Unverify</a>
                                                                <?php } else { ?> 
                                                                    <a href='javascript:void(0)' onclick='return verify_driver(1, this);' id='verify_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to verify.">Verify</a>	
                                                                <?php } ?>
                                                            </li>
															
															<li>
                                                               
                                                                    <a href='javascript:void(0)' onclick='return block_driver(3, this);' id='block_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to verify.">Block </a>	
                                                               
                                                            </li>
															
															

                                                            <li><?php if ($records[$model]['status'] == 1) { ?>
                                                                    <a href='javascript:void(0)'
                                                                       onclick='return show_message("Are you sure you want to inactivate this driver?", this);'
                                                                       id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="Click here to inactivate."><i
                                                                            class="icon-ok-sign icon-black"></i><?php echo __("Inactivate"); ?>
                                                                    </a>
                                                                <?php } else { ?>
                                                                    <a href='javascript:void(0)'
                                                                       onclick='return show_message("Are you sure you want to activate this driver?", this);'
                                                                       id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                                       data-toggle="tooltip" data-placement="top"
                                                                       title="Click here to activate."><i
                                                                            class="icon-ok-sign icon-black"></i> <?php echo __("Activate"); ?>
                                                                    </a>
                                                                <?php } ?>
                                                            </li>
                                                        <?php } ?>

                                                        <li>

                                                            <a href='javascript:void(0)' onclick='return move_to_dco(0, this);' id='move_to_dco_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to move dco.">Move TO DCO</a>


                                                        </li>




                                                    </ul>
                                                </div>
											<?php 	} ?>
                                            </td>
                                        </tr>
                                        <?php
                                        $i--;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                    </tr>

                                <?php } else { ?>
                                    <tr>
                                        <td colspan="20">No Record Found</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
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
                        alert('k');
                        $('.case').attr('checked', this.checked);
                        if ($(".case:checked").length == 0) {
                            $("input[type='submit']").attr('disabled', 'disabled');
                        }
                        ;
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
                </script>

            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>
