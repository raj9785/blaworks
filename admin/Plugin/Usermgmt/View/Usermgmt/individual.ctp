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

                    if (subcat_data == 1) {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "img/active.png"; ?>");
                        $("#" + id).attr('title', "Click here for Inactive");
                    }
                    else {
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

            var user_role_id = 2;
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


    function payment_status(id, hold_payment) {
        var text_head = "";
        if (hold_payment == 1) {
            text_head = "From tomorrow payment will continue";
        } else {
            text_head = "From tomorrow payment will stop";
        }

        swal({
            title: "Are you sure?",
            text: text_head,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'payment_status')); ?>',
                        data: {'id': id, 'hold_payment': hold_payment},
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
                            <h1 class="mainTitle">Vendor Partner Details</h1>
                        </div>
                        <div class="col-sm-3 text-align-right">
                            <?php //echo $this->Html->link(__('Send Message to Vendors', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "send_message_vendors"), array("class" => "btn btn-primary super-raj-pop", "escape" => false)); ?>
                        </div>

                        <?php
                        $can_transfer = 1;
                        if ($loggedin_user['user_role_id'] != 1) {
                            if ($loggedin_user['add_vendor'] != 1) {
                                $can_transfer = 0;
                            }
                        }

                        //offlinepayment_verification
                        if ($can_transfer == 1) {
                            ?>

                            <div class="col-sm-2 text-align-right">
                                <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Vendor', true) . "", array('plugin' => false, 'controller' => 'individual', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
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
                                echo $this->Form->text('uniqid', array('value' => isset($uniqid) ? $uniqid : '', 'placeholder' => __('Vendor ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->text('firstname', array('value' => isset($firstname) ? $firstname : '','placeholder' => __('Vendor Name', true), 'class' => 'form-control input-sm')) . '&nbsp;';		
                                echo $this->Form->select('firstname', $company, array("default" => isset($firstname) ? $firstname : '', 'empty' => __('Vendor Name', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';

                                echo $this->Form->text('mobile', array('value' => isset($mobile) ? $mobile : '', 'placeholder' => __('Mobile Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                
                                echo $this->Form->text('ac_holder_name', array('value' => @$ac_holder_name, 'placeholder' => __('Account Holder Name', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                
                                echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive'), array('value' => isset($status) ? $status : '', 'empty' => __('Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('tax_registeration_no', array('1' => 'Registered', '0' => 'Non Registered'), array('value' => isset($tax_registeration_no) ? $tax_registeration_no : '', 'empty' => __('GST Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';

                                echo $this->Form->select('hold_payment', array('1' => 'Hold Payment', '0' => 'Unhold Payment'), array('value' => @$hold_payment, 'empty' => __('Payment Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';


                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search'));
                                ?>
                                <a class="btn btn-green add-row new-style" href="<?php echo $this->Html->url(array('action' => 'individual')); ?>">Reset</a>			
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getpdf', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>

                                <?php
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'getcsv', $search_val_url, 'page' => $page, '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>

                    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                        <thead>

                            <tr style="height:30px;">
                                <!-- <th><?php echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall')); ?></th> -->
                                <th class="hidden-xs">S.No.</th>
                                <th class="hidden-xs" width="10%">Image</th>
                                <th class="hidden-xs">Vendor ID</th>
                                <th class="hidden-xs">Vendor Name</th>
                                <th class="hidden-xs">A/C Holder</th>
                                <th class="hidden-xs">Company Name</th>
                                <th class="hidden-xs">Mobile No.</th>							
<!--                                <th class="hidden-xs">Email ID</th>-->
<!--                                <th class="hidden-xs">State</th>-->
                                <th class="hidden-xs">City</th>
                                <!-- <th class="hidden-xs"><?php echo $this->Paginator->sort('mobile', __('Mobile', true), array('char' => true)); ?></th> -->
                                <!--<th class="hidden-xs"><?php echo $this->Paginator->sort('address', __('Address', true), array('char' => true)); ?></th>-->
                                <th class="hidden-xs">Registered On</th>
                                <th class="hidden-xs">GST Status</th>
                                <th class="hidden-xs">Status</th>
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

                                foreach ($result as $records) {
                                    // pr($records);
                                    ?>
                                    <tr class="gallerytr">
                                        <!-- <td>
                                        <?php echo $this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id'])); ?>
                                        </td> -->
                                        <td><?php echo $i; ?></td>
                                        <td align="left">
                                            <?php
                                            $file_path = ALBUM_UPLOAD_IMAGE_PATH;
                                            $file_name = $records[$model]['image'];
                                            $image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 75, 75, base64_encode($file_path), $file_name), true);
                                            $big_image_url = $this->Html->url(array('plugin' => 'imageresize', 'controller' => 'imageresize', 'action' => 'get_image', 400, 400, base64_encode($file_path), $file_name), true);
                                            if (is_file($file_path . $file_name)) {

                                                $images = $this->Html->image($image_url, array('alt' => $records[$model]['firstname'], 'title' => $records[$model]['firstname']));
                                                ?>
                                                <a id="single_1" href="<?php echo $big_image_url; ?>"
                                                   title='<?php echo ucfirst($records[$model]['firstname']); ?>'>
                                                       <?php echo $images; ?>
                                                </a>
                                                <?php
                                            } else {
                                                echo $this->Html->image('no_image.jpg', array('width' => '75px', 'height' => '75px'));
                                            }
                                            ?>
                                        </td> 
                                        <td align="left">
                                            <?php echo ((isset($records[$model]['uniqid']) && $records[$model]['uniqid'] != NULL) ? $records[$model]['uniqid'] : ''); ?>
                                        </td>

                                        <td align="left">
                                            <?php echo $this->Html->link($records[$model]['firstname'] . ' ' . $records[$model]['lastname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual', $records[$model]['id']), array('class' => '', 'escape' => false)); ?>
                                        </td>  
                                        
                                        <td align="left">
                                            <?php echo $records['Company'][0]['ac_holder_name']; ?>
                                        </td>

                                        <td>
                                            <?php //if ($records[$model]['type'] == 0) { ?>
                                            <?php echo ((isset($records['Company'][0]['name']) && $records['Company'][0]['name'] != NULL) ? $records['Company'][0]['name'] : '---'); ?>
                                            <?php //} ELSE { ?>

                                            <?php // } ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['mobile']; ?> 
                                        </td>

                                        <!--                                        <td align="left"><a href='mailto:<?php //echo $records[$model]['email'];      ?>'>
                                        <?php //echo $records[$model]['email']; ?> </a>
                                                                                </td>-->

                                        <!--                                        <td align="left">
                                        <?php //echo isset($records['State']['name']) ? $records['State']['name'] : '----'; ?>
                                                                                </td>-->

                                        <td align="left">
                                            <?php
                                            //echo isset($records['City']['name']) ? $records['City']['name'] : '----'; 

                                            if (isset($records['City']['name']) && !empty($records['City']['name'])) {

                                                $cityname = explode(',', $records['City']['name']);
                                                echo $cityname[0];
                                            }
                                            ?>
                                        </td>

                                                                                <!-- <td align="left">
                                        <?php echo $this->Html->link($records[$model]['mobile'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_individual', $records[$model]['id']), array('class' => '', 'escape' => false)); ?>
                                                                                </td> -->

                                                                                                        <!--<td align="left">
                                        <?php echo $records[$model]['address']; ?>
                                                                                                        </td>-->

                                        <td align="left">
                                            <?php echo date(DATE_FORMAT, strtotime($records[$model]['created'])); ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <?php
                                            //echo $records['Company'][0]['tax_registeration_no'];
                                            if (@$records['Company'][0]['tax_registeration_no'] != '') {
                                                $status_img = 'active.png';
                                                $chang = "Inactivate";
                                            } else {
                                                $status_img = 'inactive.png';
                                                $chang = "Activate";
                                            }
                                            ?>
                                            <img title="Click here to <?php echo $chang; ?>" style=""
                                                 class="set_status" id="set_status<?php echo $records[$model]['id']; ?>"
                                                 src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20"/>
                                            <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"
                                                 id="set_status_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                        </td>



                                        <td style="text-align: center;">
                                            <?php
                                            if ($records[$model]['status'] == 3) {
                                                echo "CLOSED";
                                            } else {
                                                if ($records[$model]['status'] == 1) {
                                                    $status_img = 'active.png';
                                                    $chang = "Inactivate";
                                                } else {
                                                    $status_img = 'inactive.png';
                                                    $chang = "Activate";
                                                }
                                                ?>
                                                <img title="Click here to <?php echo $chang; ?>" style="cursor:pointer;"
                                                     class="my_status" id="status_<?php echo $records[$model]['id']; ?>"
                                                     src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20"/>
                                                <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"
                                                     id="status_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                                 <?php } ?>

                                        </td>

                                        <?php if ($can_pair == 1) { 
                                            if ($records[$model]['status'] == 3) {
                                                echo "<td>CLOSED</td>";
                                            }else{
                                            ?>

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
                                            <?php } } ?>

                                        <td align="center">
                                            <?php 
                                            if ($records[$model]['status'] == 3) {
                                                echo "CLOSED";
                                            }else{
                                            ?>
                                            
                                            <div class="dropdown" style='float:left'>
                                                <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                   data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                   style='text-decoration:none'>
                                                    <?php echo __('Action'); ?> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                    <li><?php
                                                        echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('View Drivers', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'vendor_driverlist', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                        ?>
                                                    <li>
                                                    <li><?php
                                                        echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('View Vehicles', true), array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'vehiclelist', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                        ?>

                                                        <?php
                                                        $can_edit = 1;
                                                        if ($loggedin_user['user_role_id'] != 1) {
                                                            if ($loggedin_user['edit_vendor'] != 1) {
                                                                $can_edit = 0;
                                                            }
                                                        }

                                                        //offlinepayment_verification
                                                        if ($can_edit == 1) {
                                                            ?>

                                                        <li>
                                                            <?php echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_individual', $records[$model]['id']), array('class' => '', 'escape' => false)); ?>
                                                        </li>
                                                    <?php } ?>
                                                    <!-- <li><?php
                                                    //echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Change Password', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_password', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                    ?>
                                                    </li> -->
                                                    <li><?php if ($records[$model]['status'] == 1) { ?>
                                                            <a href='javascript:void(0)'
                                                               onclick='return show_message("Are you sure you want to inactivate this employee?", this);'
                                                               id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                               data-toggle="tooltip" data-placement="top"
                                                               title="Click here to inactivate."><i
                                                                    class="icon-ok-sign icon-black"></i><?php echo __("Inactivate"); ?>
                                                            </a>

                                                        <?php } else { ?>
                                                            <a href='javascript:void(0)'
                                                               onclick='return show_message("Are you sure you want to activate this employee?", this);'
                                                               id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                               data-toggle="tooltip" data-placement="top"
                                                               title="Click here to activate."><i
                                                                    class="icon-ok-sign icon-black"></i><?php echo __("Activate"); ?>
                                                            </a>


                                                        <?php } ?>
                                                    </li>
                                                    <?php
                                                    $can_hold_payment = 1;
                                                    if ($loggedin_user['user_role_id'] != 1) {
                                                        if ($loggedin_user['can_hold_payment'] != 1) {
                                                            $can_hold_payment = 0;
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($can_hold_payment == 1) {
                                                        ?>
                                                        <li>
                                                            <a href='javascript:void(0)' onclick='return payment_status("<?php echo $records[$model]['id']; ?>", "<?php echo $records[$model]['hold_payment']; ?>");' title="Click here">
                                                                <?php
                                                                if ($records[$model]['hold_payment'] == 1) {
                                                                    echo "Unhold Payment";
                                                                } else {
                                                                    echo "Hold Payment";
                                                                }
                                                                ?>
                                                            </a>
                                                        </lI>
                                                    <?php } ?>












                                                    <!-- <li>
                                                        <a href='javascript:void(0)'
                                                           onclick='return delete_user("Are you sure you want to delete this employee?", this);'
                                                           id='delete_<?php echo $records[$model]['id']; ?>' class=''
                                                           data-toggle="tooltip" data-placement="top" title="Click here to delete."><i
                                                                class="icon-trash icon-black"></i><?php echo __("Delete"); ?></a>
                                                    </li> -->

                                                </ul>
                                            </div>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <?php //if($i=='10'){echo "a";exit;}  ?>
                                    <?php
                                    $i--;
                                }
                                ?>
                                <tr>
                                    <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                                </tr>

                                <!--paging information-->
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td colspan="20">No record found.</td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>



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
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>
