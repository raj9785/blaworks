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

        $('#UsermgmtFromDate').datepicker({
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

        });



    });




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
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Vendor SOA</h1>
                        </div>

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
                                //echo $this->Form->select('state_id', $states, array('value' => isset($state_id) ? $state_id : '','class' => 'textbox form-control input-sm', 'empty' => __('Select State', true), 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';				
                                echo $this->Form->select('city_id', $city, array('value' => isset($city_id) ? $city_id : '', 'class' => 'textbox form-control input-sm', 'empty' => __('Select City', true), "style" => "width: 184px;", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('uniqid', array('value' => isset($uniqid) ? $uniqid : '', 'placeholder' => __('Vendor ID', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                //echo $this->Form->text('firstname', array('value' => isset($firstname) ? $firstname : '','placeholder' => __('Vendor Name', true), 'class' => 'form-control input-sm')) . '&nbsp;';		
                                echo $this->Form->select('firstname', $company, array("default" => isset($firstname) ? $firstname : '', 'empty' => __('Vendor Name', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('recharge_history', $recharge_history_list, array("default" => isset($recharge_history) ? $recharge_history : '', 'empty' => __('Recharge Date', true), 'style' => 'width: 156px;', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';

                                //echo $this->Form->text('mobile', array('value' => isset($mobile) ? $mobile : '','placeholder' => __('Mobile Number', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';	
                                echo $this->Form->select('total_balance_order', array('asc' => 'Lowest on top', "desc" => "Highest on top"), array('value' => isset($total_balance_order) ? $total_balance_order : '', 'empty' => __('Account Balance', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('user_role_id', $user_role, array('value' => isset($user_role_id) ? $user_role_id : '', 'empty' => __('Select Vendor Type', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
								echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive', "2" => "Hold"), array('value' => isset($status) ? $status : '', 'empty' => __('Account Status', true), 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search'));
                                ?>
                                <a class="btn btn-green add-row new-style" href="<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'vendors')); ?>">Reset</a>			
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'export', $search_val_url, 'page' => $page, 'export_type' => "pdf", '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date, 'total_balance_order' => @$total_balance_order)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>

                                <?php
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => "usermgmt", 'controller' => 'usermgmt', 'action' => 'export', $search_val_url, 'page' => $page, 'export_type' => "csv", '?' => array('state_id' => @$state_id, 'city_id' => @$city_id, 'uniqid' => @$uniqid, 'firstname' => @$firstname, 'mobile' => @$mobile, 'status' => @$status, 'from_date' => @$from_date, 'to_date' => @$to_date, 'total_balance_order' => @$total_balance_order)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
                                ?>
                            </div>
                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>
                    <div class="clear"></div>

                    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                        <thead>

                            <tr style="height:30px;">

                                <th class="hidden-xs">S.No.</th>
                                <th class="hidden-xs">Vendor ID</th>
                                <th class="hidden-xs">Vendor Name</th>
                                <th class="hidden-xs">Company Name</th>
                                <th class="hidden-xs">Mobile No</th>
                                <th class="hidden-xs">City</th>
																
                                <!--th class="hidden-xs">Last Recharge Amount</th>
                                <th class="hidden-xs">Last Recharge Date</th>
                                <th class="hidden-xs">Total Recharge Amount</th>
                                <th class="hidden-xs">Total Credit Amount</th>
                                <th class="hidden-xs">Total Debit Amount</th-->												
								<!--th class="hidden-xs">Urgent Booking Incentive</th-->
								
<!--                                <th class="hidden-xs">Incentive</th>-->
                                <th class="hidden-xs">Hold Charges</th>
                                <th class="hidden-xs">Cancellation Charges</th>
                                <th class="hidden-xs">Penalties</th>
								
                                <th class="hidden-xs">Account Balance</th>
                                <th class="hidden-xs">Account Status</th>

                                <th class="hidden-xs">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($result)) {
                                $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
                                if ($page == 0 || $page == 1) {
                                    $i = $count_new_bookings;
                                } else {
                                    $i = $count_new_bookings - $limit * ($page - 1);
                                }

                                foreach ($result as $records) {
                                    //pr($records);
                                    ?>
                                    <tr class="gallerytr">

                                        <td><?php echo $i; ?></td>

                                        <td align="left">
                                            <?php echo ((isset($records[$model]['uniqid']) && $records[$model]['uniqid'] != NULL) ? $records[$model]['uniqid'] : ''); ?>
                                        </td>

                                        <td align="left">
                                            <?php echo $records[$model]['firstname'] . ' ' . $records[$model]['lastname']; ?>
                                        </td> 
                                        <td align="left">
                                            <?php echo @$records['Company'][0]['name']; ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['mobile']; ?> 
                                        </td>
                                        <td align="left">
                                            <?php
                                            //echo isset($records['City']['name']) ? $records['City']['name'] : '----'; 

                                            if (isset($records['City']['name']) && !empty($records['City']['name'])) {

                                                $cityname = explode(',', $records['City']['name']);
                                                echo $cityname[0];
                                            }
                                            ?>
                                        </td>

									<?php /*
                                        <td align="left">
                                            <?php echo $records[$model]['last_recharge_amount'] ? number_format($records[$model]['last_recharge_amount'], 2) : "N.A"; ?> 
                                        </td>

                                        <td align="left">
                                            <?php echo $records[$model]['last_recharge_date'] ? date("d-m-y H:i", strtotime($records[$model]['last_recharge_date'])) : "N.A"; ?>
                                        </td>

                                        <td align="left">
                                            <?php echo $records[$model]['total_recharge'] ? number_format($records[$model]['total_recharge'], 2) : "N.A"; ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['total_credit'] ? number_format($records[$model]['total_credit'], 2) : "N.A"; ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['total_debit'] ? number_format($records[$model]['total_debit'], 2) : "N.A"; ?>
                                        </td>
									*/ ?>
									
										<!--td align="left">
                                            <?php //echo $records[$model]['urgent_booking_incentive'] ? number_format($records[$model]['urgent_booking_incentive'], 2) : "N.A"; ?> 
                                        </td -->

<!--                                        <td align="left">
                                            <?php //echo $records[$model]['monthly_incentive'] ? date("d-m-y H:i", strtotime($records[$model]['monthly_incentive'])) : "N.A"; ?>
                                        </td>-->

                                        <td align="left">
                                            <?php echo $records[$model]['hold_booking_charges'] ? number_format($records[$model]['hold_booking_charges']-$records[$model]['hold_booking_charges_r'], 2) : "N.A"; ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['cancellation_charges'] ? number_format($records[$model]['cancellation_charges']-$records[$model]['cancellation_charges_r'], 2) : "N.A"; ?>
                                        </td>
                                        <td align="left">
                                            <?php echo $records[$model]['driver_penalties'] ? number_format($records[$model]['driver_penalties'], 2) : "N.A"; ?>
                                        </td>
									
									
									
									
                                        <td align="left">
                                            <?php
                                            if ($records[$model]['total_balance'] >= 0) {
                                                echo number_format($records[$model]['total_balance'], 2);
                                            } else {
                                                echo "(" . number_format(abs($records[$model]['total_balance']), 2) . ")";
                                            }
                                            ?> 
                                        </td>

                                        <td>
                                            <?php
                                            if ($records[$model]['status'] == 1) {
                                                if ($records[$model]['total_balance'] > MINIMUM_AMOUNT_FOR_VENDOR) {
                                                    $status_img = 'active.png';
                                                    $chang = "Active";
                                                } else {
                                                    $status_img = 'hold.png';
                                                    $chang = "Hold";
                                                }
                                            } else {
                                                $status_img = 'inactive.png';
                                                $chang = "Inactive";
                                            }
                                            ?>
                                            <img  class="my_status" title="<?php echo $chang; ?>" id="status_<?php echo $records[$model]['id']; ?>"
                                                  src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20"/>

                                        </td>

                                        <td style="width: 7%;">

                                            <div class="dropdown" style='float:left'>
                                                <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                                   data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                                   style='text-decoration:none'>
                                                    <?php echo __('Action'); ?> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                                    <li>

                                                        <?php
                                                        echo $this->Html->link('' . __('View Statement of Account', true), array('plugin' => false, 'controller' => 'payments', 'action' => 'index', $records[$model]['uniqid']), array('class' => '', 'escape' => false));
                                                        ?>

                                                    </li>

                                                    <?php
                                                    if (isset($loggedin_user) && $loggedin_user['user_role_id'] == 1) {
                                                        ?>

                                                        <?php
                                                        if ($records[$model]['total_balance'] > 0 && $records[$model]['status'] != 1) {
                                                            ?>
                                                            <li><a href="javascript:void(0)">Full & Final Settlement</a></li>
                                                            <?php
                                                        }
                                                        ?>

<!--                                                        <li>

                                                            <?php
                                                            //echo $this->Html->link('' . __('Update Offline Payment', true), array('plugin' => false, 'controller' => 'payments', 'action' => 'made_payment', $records[$model]['uniqid']), array('class' => '', 'escape' => false));
                                                            ?>

                                                        </li> -->

                                                    <?php } ?>



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

                                <!--paging information-->
                                <?php
                            } else {
                                ?>
                                <tr>
                                    <td colspan="20" style="text-align: center;">No Record Found.</td>
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
