<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
      
        //UINotifications.init();
        //TableData.init();
       /*  $('#CustomerFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#CustomerToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#CustomerToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#CustomerFromDate").datepicker("option", "maxDate", selectedDate);
            }

        }); */
		
		
		$('#CustomerFromDate').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,            
			maxDate: '<?php echo MAX_DATE_RANGE; ?>',
			onSelect: function (selectedDate) {
				var nyd = new Date(selectedDate);
				nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
				$('#CustomerToDate').datepicker("option", {
					minDate: new Date(selectedDate),
					maxDate: nyd
				});
			  
				//$("#CustomerToDate").datepicker("option", "minDate", selectedDate);
			},
		});
		$('#CustomerToDate').datepicker({
			dateFormat: "yy-mm-dd",
			//dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
			onClose: function (selectedDate) {
				$("#CustomerFromDate").datepicker("option", "maxDate", selectedDate);
			}

		});
		
		
		
		
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "User will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'delete')) ?>',
                            data: 'id=' + record_id,
                            dataType: 'json',
                            success: function (data) {
                                if (data.succ == '1') {
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
        });
    });
</script>
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
        <div class="main-content" >
            <div class="wrap-content container" id="container">

                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>

                    </div>
                </section>


                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!---
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left"><?php //echo $this->element('paging_info');      ?></div>
                            <div class="pull-right">
                                <button class="btn btn-green add-row" id='add_new_user'>
                                    Add Customer <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    -->					
                    <?php
                    echo $this->Form->create('Customer', array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
                    ?>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">

                                <?php
                                echo $this->Form->select('Customer.register_from', $reg_from, array('empty' => 'Registration Source', 'value' => isset($register_from) ? $register_from : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('Customer.firstname', array('placeholder' => 'Name', 'value' => isset($firstname) ? $firstname : '', 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
                                echo $this->Form->text('Customer.mobile', array('placeholder' => 'Mobile Number', 'value' => isset($mobile) ? $mobile : '', 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
                                echo $this->Form->text('Customer.email', array('placeholder' => 'Email ID', 'value' => isset($email) ? $email : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Customer.status', array("A" => "Active", "D" => "Inactive"), array('value' => isset($status) ? $status : '', 'empty' => 'Customer Status', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('Customer.is_verified', array("Y" => "Verified", "N" => "Not Verified"), array('value' => isset($is_verified) ? $is_verified : '', 'empty' => 'Verification Status', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                ?>

                                <?php
                                echo $this->Form->text('Customer.from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';

                                echo $this->Form->text('Customer.to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';
                                ?>
                                &nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search')); ?>

                                <?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Reset", true), array('class' => 'btn btn-green add-row new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Reset')); ?>

                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getpdf', $search_val_url, 'page' => $page, '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style2', 'escape' => false));
                                ?>

                                <?php
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getcsv', $search_val_url, 'page' => $page, '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>

                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">S.No.</th>
                                        <th class="hidden-xs">Date</th>
<!--                                        <th class="hidden-xs">Source </th>-->
                                        <th class="hidden-xs">Name</th>
<!--                                        <th class="hidden-xs">Mobile Number</th>
                                        <th class="hidden-xs">Email ID </th>-->

                                        <th class="hidden-xs">Total Calls</th>
                                        <th class="hidden-xs">Enquiries</th>
                                        <th class="hidden-xs">Bookings</th>
                                        <th class="hidden-xs">Completed</th>
                                        <th class="hidden-xs">Cancelled</th>
                                        <th class="hidden-xs">Co. Cancelled</th>
                                        
                                        <th class="hidden-xs">Revenue</th>
                                       
                                        <th class="hidden-xs">Amount Due</th>
                                        <th class="hidden-xs">Conversion</th>

                                        <th class="hidden-xs">Happiness Index</th>
<!--                                        <th>Action</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($users_list)) {
                                        $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
                                        if ($page == 0 || $page == 1) {
                                            $i = $count_new_bookings;
                                        } else {
                                            //echo $count_new_bookings;
                                            $i = $count_new_bookings - $limit * ($page - 1);
                                        }
                                        ?>

                                        <?php foreach ($users_list as $user) { ?>  
                                            <tr>
                                                <td> <?php echo $i; ?></td>
                                                <td> <?php echo date("d-m-y", strtotime($user['Customer']['created'])); ?></td>
        <!--                                                <td><?php echo $reg_from[$user['Customer']['register_from']]; ?></td>-->
                                                <td width="10%">
                                                    <a data-toggle="tooltip" data-html="true"  data-placement="top"  title="" class="" data-original-title="<?php 
                                                    echo "Mobile No : ".$user['Customer']['mobile']." </br>";
                                                    echo "Email ID : ".$user['Customer']['email'];
                                                    
                                                    ?>">
                                                        
                                                        <?php echo $user['Customer']['title'] . ' ' . $user['Customer']['firstname'] . ' ' . $user['Customer']['lastname']; ?>
                                                    </a>
                                                </td>
        <!--                                                <td><?php echo $user['Customer']['mobile']; ?></td>
                                                <td><?php echo $user['Customer']['email']; ?></td>-->
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                 <td></td>
                                               



<!--                                                <td>
                                                    <?php
                                                    if ($user['Customer']['status'] == 'A') {
                                                        echo $this->Html->image('/img/active.png', array('border' => 0, 'width' => '20', 'alt' => 'Active', 'title' => 'Active'));
                                                    } else {
                                                        echo $this->Html->image('/img/inactive.png', array('border' => 0, 'width' => '20', 'alt' => 'Inactive', 'title' => 'Inactive'));
                                                    }
                                                    ?>


                                                </td>-->

<!--                                                <td>

                                                    <div class="dropdown" style='float:left'>
                                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                           style='text-decoration:none'>
                                                            <?php echo __('Action'); ?> <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                            <li>

                                                                <?php
                                                                if ($user['Customer']['status'] == 'A') {
                                                                    echo $this->Html->link('Inactivate', array('controller' => 'users', 'action' => 'status', 'id' => $user['Customer']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                                } else {
                                                                    echo $this->Html->link('Activate', array('controller' => 'users', 'action' => 'status', 'id' => $user['Customer']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                                }
                                                                ?>							
                                                            </li>
                                                            <li>
                                                                <?php
                                                                if ($user['Customer']['is_verified_mobile'] == 'N') {
                                                                    echo $this->Html->link('Verify', array('controller' => 'users', 'action' => 'verify', 'id' => $user['Customer']['id'], 'status' => 'Y'), array('title' => 'Click here to verify.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to verify.'));
                                                                }
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link(__('View Logs', true), array('plugin' => false, 'controller' => 'users', 'action' => 'view_logs', 'id' => $user['Customer']['id']), array('class' => '', 'escape' => false));
                                                                ?>

                                                            </li>


                                                        </ul>
                                                    </div>



                                                    <?php
                                                    //echo $this->Html->link('<i class="fa fa-pencil"></i>', array('plugin' => false, 'controller' => 'users', 'action' => 'edit', '?' => array('id' => $user['Customer']['id'])), array('class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                    //echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)', array('class' => 'btn btn-transparent btn-xs tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Customer']['id'], 'escape' => false));
                                                    ?>
                                                </td>-->
                                            </tr>
                                            <?php
                                            $i--;
                                        }
                                        ?>
                                        <tr>
                                            <td  colspan="30"><?php echo $this->element('pagination'); ?></td>
                                        </tr> 
                                        <?php
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="30">No user exists.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
