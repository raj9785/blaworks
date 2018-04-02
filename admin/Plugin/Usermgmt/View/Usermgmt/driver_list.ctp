<?php
echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<SCRIPT language="javascript">
    $(function () {

        /* $('#UsermgmtFromDate').datepicker({
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

                    if (subcat_data == 1) {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/active.png"; ?>");
                        $("#" + id).attr('title', "Click here for Inactive");
                    } else {
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
        });


        $(".mgf_status").on('click', function () {

            var user_role_id = 5;
            var id = $(this).attr('id');
            $('#' + id).hide();
            var main_status_id = id.split("_");
            var status_id = main_status_id[1];
            $('#mgf_status_aja_' + status_id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'mgf_status_ajax')); ?>",
                data: {'id': status_id, 'user_role_id': user_role_id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {
                    //alert(subcat_data);

                    if (subcat_data == 1) {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/active.png"; ?>");
                        $("#" + id).attr('title', "Click here for Inactive");
                    }
                    else {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/inactive.png"; ?>");
                        $("#" + id).attr('title', "Click here for Active");
                    }

                    $('#mgf_status_aja_' + status_id).hide();
                    $('#' + id).show();

                },
                error: function (e) {
                    alert('fali');
                    $('#mgf_status_aja_' + status_id).hide();
                }
            });
        });


        $(".my").on('click', function () {
            var id = $(this).attr('id');

            palate_no = $("#palate_no_" + id).val();
            //alert(palate_no);
            if (palate_no == '') {
                alert('Plate No. Mandatory to verified DCO');
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

                    window.location.reload();
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
            $("#search_button").attr('disabled', 'disabled');
            $("#UsermgmtCityId").attr('disabled', 'disabled');
            $("#UsermgmtCityId").empty();
            $.ajax({
                type: 'POST',
                url: '<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'getCitiesByState')) ?>',
                data: 'state_id=' + $("#UsermgmtStateId").val(),
                success: function (data) {
                    $("#search_button").removeAttr('disabled');
                    $("#UsermgmtCityId").removeAttr('disabled');
                    $("#UsermgmtCityId").html(data);
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



    });


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
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'delete_company')); ?>',
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



    $(document).ready(function () {
        $('.btn').tooltip();
        $("#single_1").fancybox({
            helpers: {
                title: {
                    type: 'float'
                }
            }
        });
        $(".super-raj-pop").fancybox({
            type: 'ajax',
            helpers: {
                overlay: {closeClick: false}
            },
        });

    })









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
                        <div class="col-sm-7">
                            <h1 class="mainTitle">Driver List</h1>
                        </div>
                        <div class="col-sm-3 text-align-right">
                            <?php //echo $this->Html->link(__('Send Message to Vendors', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "send_message_vendors"), array("class" => "btn btn-primary super-raj-pop", "escape" => false));  ?>
                        </div>
                        <?php
                        if ($can_add == 1) {
                            ?>
                            <div class="col-sm-2 text-align-right">
                                <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Driver', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "add_new_driver"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                            </div>
                        <?php } ?>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                //echo $this->Form->select('country_id', $country, array('class' => 'textbox form-control input-sm', 'empty' => __('Select Country', true), 'class' => ' form-control input-sm')) . '&nbsp;';				
                                echo $this->Form->select('state_id', $states, array('value' => isset($state_id) ? $state_id : '', 'class' => 'textbox form-control input-sm', 'empty' => __('Select State', true), 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('city_id', $city, array('value' => isset($city_id) ? $city_id : '', 'class' => 'textbox form-control input-sm', 'empty' => __('Select City', true), "style" => "width: 184px;", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('uniqid', array('value' => isset($uniqid) ? $uniqid : '', 'placeholder' => __('Driver ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('driver_firstname', array('value' => isset($driver_firstname) ? $driver_firstname : '', 'placeholder' => __('Driver Name', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('mobile', array('value' => isset($mobile) ? $mobile : '', 'placeholder' => __('Mobile Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('license_no', array('value' => isset($license_no) ? $license_no : '', 'placeholder' => __('Driving License Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';

                                echo $this->Form->select('status', array('2' => 'Pending', '1' => 'Active', '0' => 'Inactive'), array('value' => isset($status) ? $status : '', 'empty' => __('Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('verified', array('2' => 'Pending', '1' => 'Verified', '0' => 'Not-Verified'), array('value' => isset($verified) ? $verified : '', 'empty' => __('Verification Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';

                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search'));
                                ?>
                                <a class="btn btn-green add-row new-style" href="<?php echo $this->Html->url(array('action' => 'driver_list')); ?>">Reset</a>			
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getpdf_dco', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>

                                <?php
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getcsv_dco', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>
                    <div style="width:100% !important;overflow-y:auto;min-height: 300px;">
                        <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>" > 
                            <thead>

                                <tr style="height:30px;">
                                    <th class="hidden-xs">S.No.</th>
                                    <th class="hidden-xs" width="10%">Image</th>
<!--                                    <th class="hidden-xs">State</th>-->
                                    <th class="hidden-xs">City</th>
                                    <th class="hidden-xs">Driver ID</th>
                                    <th class="hidden-xs">Driver Name</th>
                                    <th class="hidden-xs">Mobile No.</th>
                                    <th class="hidden-xs">Vehicle No.</th>
                                    <th class="hidden-xs">DL Number</th>
                                    <th class="hidden-xs">Age</th>
                                    <th class="hidden-xs">Registered On</th>
                                        <!--      <th class="hidden-xs">Created By</th>
                                         <th class="hidden-xs">Verified By</th>-->
                                    <th class="hidden-xs">Status</th>
                                    <th class="hidden-xs">Verified</th>
                                    <?php
                                    $can_pair = 1;
                                    if ($loggedin_user['user_role_id'] != 1) {
                                        if ($loggedin_user['pair_booking_status'] != 1) {
                                            $can_pair = 0;
                                        }
                                    }
                                    ?>
                                    <?php if ($can_pair == 1) { ?>
                                        <th class="hidden-xs">Pair Booking</th>
                                    <?php } ?>
                                    <th class="hidden-xs">Action</th>
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
                                    foreach ($result as $records) {  //pr($records);
                                        ?>
                                        <tr class="gallerytr">

                                            <td><?php echo $i; ?></td>
                                            <td align="left">
                                                <?php
                                                // $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                                //  $file_name = $records[$model]['image'];
                                                //pr($records['UserDocument']);
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
                                                ?>

                                            </td> 
        <!--                                            <td align="left">
                                            <?php //echo isset($records['Usermgmt']['state_name']) ? $records['Usermgmt']['state_name'] : '----'; ?>
                                            </td>-->

                                            <td align="left">
                                                <?php echo isset($records['Usermgmt']['city_name']) ? $records['Usermgmt']['city_name'] : '----'; ?>
                                            </td>

                                            <td align="left">
                                                <?php echo $this->Html->link($records['Usermgmt']['uniqid'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual_driver', $records['Usermgmt']['id']), array('class' => '', 'escape' => false)); ?>
                                            </td>    

                                            <td align="left">
                                                <?php
                                                echo $records['Usermgmt']['firstname'] . ' ' . $records['Usermgmt']['lastname'];


                                                //$this->Html->link($records['Usermgmt']['firstname'] . ' ' . $records['Usermgmt']['lastname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual_driver', $records['Usermgmt']['id']), array('class' => '', 'escape' => false)); 
                                                ?>
                                            </td>                                  


                                            <td align="left">
                                                <?php $vehicle_cat = ($records[$model]['mobile']) ? $records[$model]['mobile'] : 'N.A'; ?>
                                                <a href="<?php echo WEBSITE_URL; ?>admin/usermgmt/usermgmt/view_logs/<?php echo $records[$model]['id'] . "/" . $records[$model]['uniqid']; ?>"  title="Driver History" class="super-raj-pop"><?php echo $vehicle_cat; ?></a>
                                            </td>

                                            <td align="left">
                                                <?php echo isset($records['Usermgmt']['plate_no']) ? $records['Usermgmt']['plate_no'] : 'N.A'; ?>
                                                <?php echo $this->Form->input('Usermgmt.plate_no', array('type' => 'hidden', "id" => 'palate_no_' . $records['Usermgmt']['id'], "class" => "", "value" => $records['Usermgmt']['plate_no'])); ?>
                                            </td>


                                            <td align="left">
                                                <?php echo $records[$model]['license_no']; ?>
                                            </td>
                                            <td align="left">
                                                <?php
                                                $current_year = date('Y');
                                                $dob_year = date('Y', strtotime($records[$model]['dob']));
                                                echo $current_year - $dob_year;
                                                ?>
                                            </td>

                                            <td align="left">
                                                <?php echo date(DATE_FORMAT, strtotime($records[$model]['created'])); ?>
                                            </td>
                                            <?php /* ?>
                                              <td align="left">
                                              <?php echo isset($records['Usermgmt']['created_by']) ? $records['Usermgmt']['created_by'] : 'N.A'; ?>
                                              </td>
                                              <td align="left">
                                              <?php echo isset($records['Usermgmt']['verified_by']) ? $records['Usermgmt']['verified_by'] : 'N.A'; ?>
                                              </td>

                                              <?php
                                             */
                                            ?>
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
                                                if ($records[$model]['verified'] == 1) {
                                                    $veri_img = 'active.png';
                                                    $chang = "Unverify";
                                                } else if ($records[$model]['verified'] == 2) {
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
                                                    <img title="Click here to <?php echo $chang; ?>" style="cursor:pointer;" class="my" id="<?php echo $records[$model]['id']; ?>" src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="20" height="20"/>
                                                    <img src="<?php echo WEBSITE_URL . "/img/ajax.gif"; ?>" id="v_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                                <?php } else { ?>
                                                    <img  src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="20" height="20"/>
                                                <?php } ?>
                                            </td>


                                            
                                            <?php if ($can_pair == 1) { ?>

                                                <td style="text-align: center;">
                                                    <?php
                                                    if ($records[$model]['mgf_vendor'] == 1) {
                                                        $status_img = 'active.png';
                                                        $chang = "Inactivate";
                                                    } else {
                                                        $status_img = 'inactive.png';
                                                        $chang = "Activate";
                                                    }
                                                    ?>
                                                    <img title="Click here to <?php echo $chang; ?>" style="cursor:pointer;"
                                                         class="mgf_status" id="mgfstatus_<?php echo $records[$model]['id']; ?>"
                                                         src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20"/>
                                                    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"
                                                         id="mgf_status_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                                </td>
                                            <?php } ?>

                                            <td align="center">
                                                <div class="dropdown" style='float:left'>
                                                    <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                       data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                       style='text-decoration:none'>
                                                        <?php echo __('Action'); ?> <span class="caret"></span>
                                                    </a>
                                                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                        <?php
                                                        //$can_add
                                                        $can_edit_user = 0;
                                                        if ($can_edit == 1) {
                                                            $can_edit_user = 1;
                                                        } else {
                                                            if ($records[$model]['verified'] != 1) {
                                                                if ($can_add == 1) {
                                                                    $can_edit_user = 1;
                                                                }
                                                            }
                                                        }
                                                        

                                                        if ($can_edit_user == 1) {
                                                            ?>
                                                            <li>
                                                                <?php echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'update_driver', $records['Usermgmt']['id']), array('class' => '', 'escape' => false)); ?>
                                                            </li>
                                                        <?php } ?>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php //if($i=='10'){echo "a";exit;}    ?>
                                        <?php
                                        $i--;
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                    </tr>
                                    <!--paging information-->
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="20">No record found.</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>





