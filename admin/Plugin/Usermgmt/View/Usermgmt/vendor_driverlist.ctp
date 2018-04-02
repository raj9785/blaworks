<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
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
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "/img/active.png"; ?>");
                        $("#" + id).attr('title', "Click here for Inactive");
                    } else {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "/img/inactive.png"; ?>");
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

        $(".my").on('click', function () {
            var id = $(this).attr('id');
            $('#' + id).hide();
            $('#v_aja_' + id).show();
            $.ajax({
                url: "<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'verified_ajax')); ?>",
                data: {'id': id},
                type: 'post',
                //dataType:'json',
                success: function (subcat_data) {

                    if (subcat_data == 1) {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "/img/veri.png"; ?>");
                        $("#" + id).attr('title', "Click here for Unverified");
                    } else if (subcat_data == 2) {
                        alert("Cab Can not verified Please pay cab Attachment fee .");
                    } else {
                        $("#" + id).attr('src', "<?php echo WEBSITE_URL . "/img/not_veri.gif"; ?>");
                        $("#" + id).attr('title', "Click here for Verified");
                    }

                    $('#v_aja_' + id).hide();
                    $('#' + id).show();
                },
                error: function (e) {
                    alert('fali');
                    $('#v_aja_' + id).hide();
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
//pr($uniqid);
if(!empty($vendor_company) && !empty($uniqid)){
	$Vname=$vendor_company['Company']['name']."  (".$uniqid['User']['uniqid'].")";
}
else { $Vname="My";  }

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
                            <h1 class="mainTitle"><?php echo $Vname; ?> List of Drivers</h1>
                        </div>
                        <div class="col-sm-4 text-align-right">
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Driver', true) . "", array('plugin' => false, 'controller' => 'driver', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white table_top_margin">



                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
								
								 echo $this->Form->text('uniqid', array('placeholder' => __('Driver ID', true), 'class' => 'form-control input-sm')) . '&nbsp;';
								
								  echo $this->Form->text('firstname', array('placeholder' => __('Driver Name', true), 'class' => 'form-control input-sm')) . '&nbsp;';
								
								  echo $this->Form->text('mobile', array('placeholder' => __('Mobile Number', true), 'class' => 'form-control input-sm')) . '&nbsp;';
																
                                  echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => __('Status', true), 'class' => 'form-control input-sm')) . '&nbsp;';
								  
								   echo $this->Form->select('status', array('1' => 'Verified', '0' => 'Not-Verified'), array('empty' => __('Verification Status', true), 'class' => 'form-control input-sm')) . '&nbsp;';
								  
								  
                               // echo $this->Form->text('email', array('placeholder' => __('Search By Email', true), 'class' => 'form-control input-sm')) . '&nbsp;';
								
                               
                                ?>
                                &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style-top2', 'escape' => false)); ?>
                                <a class="btn btn-green add-row new-style-top" href="<?php echo $this->Html->url(array('action' => 'vendor_driverlist',$id)); ?>">Reset</a>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <?php
                  /*  echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    echo '<div class="kk" style="position: relative;">';
                    echo $this->Form->select('my_action', array('delete' => 'Delete', 'active' => 'Active', 'inactive' => 'Inactive'), array('empty' => __('Select', true), 'class' => 'form-control input-medium', 'disabled' => false, 'style' => 'position: absolute;right: 0;top: -50px;')) . '&nbsp;';
                    echo $this->Form->submit("delete" . __("delete", true), array('id' => 'delete', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmDelete()'));
                    echo $this->Form->submit("active" . __("active", true), array('id' => 'active', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmActive()'));
                    echo $this->Form->submit("inactive" . __("inactive", true), array('id' => 'inactive', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmInactive()'));
                    echo '</div>'; */
                    ?>
                    <?php //echo $this->Session->Flash();   ?>

                    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                        <thead>
                            <tr>
                                <th class="hidden-xs" width="5%">S.No.</th>
                                <th class="hidden-xs" width="10%">Driver Image</th>
                                <th class="hidden-xs" width="10%">Driver ID</th>
                                <th class="hidden-xs">Driver Name</th>
                                <th class="hidden-xs">Mobile Number</th>
                                <th class="hidden-xs">Driving License No.</th>
                                <th class="hidden-xs">Age</th>

                                <th class="hidden-xs">Created</th>
                                                                <!--<th class="hidden-xs">Calender Status</th>-->
                                <th class="hidden-xs">Status</th>
                                <th class="hidden-xs">Verified</th>
                                <th class="hidden-xs"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($result)) { 
                                $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
                                if ($page == 0 || $page == 1) {
                                    $i = $count_new_bookings;
                                } else {
                                    //echo $count_new_bookings;
                                    $i = $count_new_bookings - $limit * ($page - 1);
                                }
							
                            ?>
                                <?php foreach ($result as $records) { ?>
                            <tr style="height:30px;" class="gallerytr">
                                <td>
                                            <?php echo $i; //$this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id'])); ?>
                                </td>
                                <td align="left">
                                            <?php
													/* $file_path = WEBSITE_APP_WEBROOT_ROOT_PATH . DS . 'uploads' . DS . 'drivers' . DS . 'photos'. DS ;
													$file_name = $records[$model]['image'];
													if (file_exists($file_path . $file_name)) {
														 echo $this->Html->image(WEBSITE_URL.'uploads/drivers/photos/'.$file_name, array('alt' => $records[$model]['firstname'], 'title' => $records[$model]['firstname'],'width' => 75));; ?>
														<?php
													} else {
														echo $this->Html->image('/img/no_image.jpg', array('width' => '75px'));
													} */
													
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
                                <td align="left"> <?php echo $records[$model]['uniqid']; ?> </td>
                                </td>
                                <td align="left">
                                            <?php echo $this->Html->link($records[$model]['firstname'] .' '. $records[$model]['lastname'], array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'detail_driver', $records[$model]['id']), array('class' => '', 'escape' => false)); ?>
                                            <?php //echo $records[$model]['firstname'];  ?>
                                </td>
                                <td align="left"> <?php echo $records[$model]['mobile']; ?> </td>

                                <td align="left">
                                    <div title="<?php echo $records[$model]['license_no']; ?>"><?php echo ((strlen($records[$model]['license_no']) > 50) ? substr($records[$model]['license_no'], 0, 20) . '.....' : $records[$model]['license_no']); ?></div>
                                </td>
                                <td align="left">
										<?php if(isset($records[$model]['dob']) && !empty($records[$model]['dob']))
											//echo $records[$model]['dob'];
											 $dob = date("d-m-Y",strtotime($records[$model]['dob']));

											$from = new DateTime($dob);
											$to   = new DateTime('today');
											 echo $from->diff($to)->y;

											?>


                                </td>


                                <td align="left">
                                            <?php echo date('d-m-y H:i:s A',strtotime($records[$model]['created'])); ?>
                                </td>
<!--					<td align="left">
                                    <a href="<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'showevents', $records[$model]['id'])); ?>" class="fancyBox" onclick='return check_Taxi(<?php echo $records[$model]['id']; ?>);' id="btnForm">Check It</a>
                                </td>-->
                                <td align="left">

                                            <?php
                                            if ($records[$model]['status'] == 1) {
                                                $status_img = 'active.png';
                                                $chang = "Inactive";
                                            } else {
                                                $status_img = 'inactive.png';
                                                $chang = "Active";
                                            }
                                            ?>
                                    <img title="Click here for <?php echo $chang; ?>" style="cursor:pointer;"
                                         class="my_status" id="status_<?php echo $records[$model]['id']; ?>"
                                         src="<?php echo WEBSITE_URL . "/img/" . $status_img; ?>" width="20" height="20"/>
                                    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"
                                         id="status_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                </td>
                                <td align="left">
									<?php
										if ($records[$model]['verified'] == 1) {
											$veri_img = 'active.png';
											$chang = "UnVerified";
										} else {
											$veri_img = 'inactive.png';
											$chang = "Verified";
										}
									?>
                                    <img title="Click here for <?php echo $chang; ?>" style="cursor:pointer;" class="my" id="<?php echo $records[$model]['id']; ?>" src="<?php echo WEBSITE_URL . "/img/" . $veri_img; ?>" width="20" height="20"/>
                                    <img src="<?php echo WEBSITE_URL . "/img/ajax.gif"; ?>" id="v_aja_<?php echo $records[$model]['id']; ?>" style="display:none;"/>
                                </td>
                                <td align="center">
                                    <div class="dropdown" style='float:left'>
                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                           style='text-decoration:none'>
                                                    <?php echo __('Action'); ?> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li><?php
                                                        echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Edit Details', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'edit_driver', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                        ?>
                                            </li>
                                            <li><?php
                                                        echo $this->Html->link('<i class="icon-pencil icon-black"></i> ' . __('Change Password', true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'change_password', $records[$model]['id']), array('class' => '', 'escape' => false));
                                                        ?>
                                            </li>
                                                    <?php if (authComponent::user('user_role_id') == 1) { ?>
                                            <li><?php if ($records[$model]['status'] == 1) { ?>
                                                <a href='javascript:void(0)'
                                                   onclick='return show_message("Are you sure you want to inactive this driver?", this);'
                                                   id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Click here to inactive."><i
                                                        class="icon-ok-sign icon-black"></i><?php echo __("Inactivate Driver"); ?>
                                                </a>
                                                            <?php } else { ?>
                                                <a href='javascript:void(0)'
                                                   onclick='return show_message("Are you sure you want to active this driver?", this);'
                                                   id='inactive_<?php echo $records[$model]['id']; ?>' class=''
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Click here to Active."><i
                                                        class="icon-ok-sign icon-black"></i> <?php echo __("Active Driver"); ?>
                                                </a>
                                                            <?php } ?>
                                            </li>
                                            <li>
                                                <a href='javascript:void(0)'
                                                   onclick='return delete_user("Are you sure you want to delete this driver?", this);'
                                                   id='delete_<?php echo $records[$model]['id']; ?>' class=''
                                                   data-toggle="tooltip" data-placement="top"
                                                   title="Click here to delete."><i
                                                        class="icon-trash icon-black"></i> <?php echo __("Delete Driver"); ?>
                                                </a>
                                            </li>
                                                    <?php } ?>
                                        </ul>
                                    </div>

                                </td>
                            </tr>
                                <?php  $i--;} ?>
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
