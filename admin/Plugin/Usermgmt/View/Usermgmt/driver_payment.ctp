<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type='text/javascript'>
    $(document).ready(function () {



        $('#UsermgmtFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#InvoiceToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#UsermgmtToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#InvoiceFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });
    });
    function ajax_pay_amount(invoiceID) {
        swal({
            title: "Are you sure?",
            text: "Net Payable Amount will be transferred.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('controller' => 'vendor_invoices', 'action' => 'ajax_pay_amount')); ?>',
                        data: {
                            'invoiceID': invoiceID,
                        },
                        dataType: 'json',
                        beforeSend: function () {
                            swal({
                                title: "Please Wait...",
                                text: "Transaction in Progress...",
                                type: "warning",
                                showCancelButton: false,
                                showConfirmButton: false,
                                confirmButtonColor: '#d6e9c6',
                                confirmButtonText: "Wait",
                                closeOnConfirm: false,
                            }, function () {

                            });
                        },
                        success: function (data) {

                            if (data.error == 1) {
                                window.location.reload();
                            } else {
                                swal({
                                    title: "Error!",
                                    text: data.message,
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
                            <h1 class="mainTitle"><?php echo $user_dtls['User']['firstname'] ?> - Statement of Account</h1>
                        </div>   
                        <div class="col-sm-4 text-align-right">
                            <?php
                            echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Driver SOA', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'driversoa'), array("class" => "btn btn-green add-row", "escape" => false));
                            ?>
                        </div>

                    </div>
                </section>


                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white" style="padding: 15px 30px 30px;">

                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                echo $this->Form->create($model, array('type' => 'get', 'class' => 'form-inline filterform', 'inputDefaults' => array('label' => false, 'div' => false)));

                              
                                echo $this->Form->text('transaction_id', array('placeholder' => __('Transaction ID', true), 'value' => isset($transaction_id) ? $transaction_id : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                              
                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false, 'name' => 'button', 'value' => 'Search')) . '&nbsp;&nbsp;';
                                ?>
                                <a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'driver_payment', $uid)); ?>">Reset</a>
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                $params_arr = array('transaction_id' => @$transaction_id, 'from_date' => @$from_date, 'to_date' => @$to_date, 'uid' => $uid);
                              //  echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'export', $search_val_url, 'page' => $page, 'export_type' => "pdf", '?' => $params_arr), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl', 'escape' => false)) . "&nbsp;&nbsp;";

                             //   echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => 'usermgmt', 'controller' => 'usermgmt', 'action' => 'export', $search_val_url, 'page' => $page, 'export_type' => "csv", '?' => $params_arr), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl', 'escape' => false));
                                ?>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>

                    <div class="clear"></div>
                    <div style="width:100% !important;overflow-y:auto">

                        <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                            <thead>
                                <tr style="height:30px;">
                                    <th class="hidden-xs">S.No.</th>
                                    <th class="hidden-xs">Transaction Date</th>
                                    <th class="hidden-xs">Transaction ID</th> 
                                    <th class="hidden-xs">Booking ID</th> 
                                    <th class="hidden-xs">Invoice No</th> 
                                    <th class="hidden-xs" style="width: 20%;">Particulars</th> 

                                    <th class="hidden-xs">DR</th>
                                    <th class="hidden-xs">CR</th>
                                    <th class="hidden-xs">Current Balance</th>
                                   
                                </tr>
                            </thead>
                            <tbody >
                                <?php
                             //  pr($invoices_list); 
                                if (!empty($invoices_list)) {
                                    $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
                                    if ($page == 0 || $page == 1) {
                                        $i = $count_new_bookings;
                                    } else {
                                        //echo $count_new_bookings;
                                        $i = $count_new_bookings - $limit * ($page - 1);
                                    }
                                    foreach ($invoices_list as $records) {
                                        ?>
                                        <tr class="gallerytr">



                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo date("d-m-y", strtotime($records['DriverPayment']['created'])); ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (@$records['DriverPayment']['walletSysTransactionId']) {
                                                    echo @$records['DriverPayment']['walletSysTransactionId'];
                                                } else {
                                                    if (@$records['DriverPayment']['type'] == 2) {
                                                        echo "Cash";
                                                    } else {
                                                        echo "N.A";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $records['DriverSos']['trip_id'] ? $records['DriverSos']['trip_id'] : "N.A"; ?>
                                            </td>
                                            <td>
                                                <?php echo @$records['DriverSos']['invoice_number'] ? $records['DriverSos']['invoice_number'] : "N.A"; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($records['DriverSos']['type'] == 6) {
                                                    if ($records['DriverSos']['description'] == "Payment Reverse") {
                                                        echo "Incentive - Diwali 2016";
                                                    } else {
                                                        echo $records['DriverSos']['description'];
                                                    }
                                                }else if ($records['DriverSos']['type'] == 7) {
                                                     echo $records['DriverSos']['description'];
                                                } else {
                                                    echo $payment_status[$records['DriverSos']['type']];
                                                }
                                                if (@$records['DriverSos']['return_payment'] == 1) {
                                                    echo " (Return Entry)";
                                                }
                                                ?>

                                            </td>

                                            <td>
                                                <?php
                                                if ($records['DriverSos']['amount_type'] == 1) {
                                                    echo number_format($records['DriverSos']['amount'], 2);
                                                }
                                                ?>
                                            </td> 
                                            <td>
                                                <?php
                                                if ($records['DriverSos']['amount_type'] != 1) {
                                                    echo number_format($records['DriverSos']['amount'], 2);
                                                };
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($records['DriverSos']['balance'] >= 0) {
                                                    echo number_format($records['DriverSos']['balance'], 2);
                                                } else {
                                                    echo "(" . number_format(abs($records['DriverSos']['balance']), 2) . ")";
                                                }
                                                ?>
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
                                        <td align="center" style="text-align:center;" colspan="18" class=""><?php echo __('No Record Found'); ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

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
