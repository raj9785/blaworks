 
<div class='clear'></div>
<?php if ($dashboard_type == 1) { ?>
    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcity']) && $permissions['dcity'] == 1)) { ?>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">

                    <h2 class="StepTitle">CITIES</h2>
                    <span class="links cl-effect-1"><?php echo $count_city; ?></span>
                    <p class="links cl-effect-1">
                        <?php echo $this->Html->link('view more', array('controller' => 'city', 'action' => 'index'), array('escape' => false)); ?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dvendors']) && $permissions['dvendors'] == 1)) { ?>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">

                    <h2 class="StepTitle">VENDORS</h2>
                    <span class="links cl-effect-1"><?php echo $count_vendors; ?></span>
                    <p class="links cl-effect-1">
                        <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'individual', 'action' => 'index')); ?>">view more</a>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dvehicles']) && $permissions['dvehicles'] == 1)) { ?>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">

                    <h2 class="StepTitle">VEHICLES</h2>
                    <span class="links cl-effect-1"><?php echo $vehicles_list; ?></span>
                    <p class="links cl-effect-1">
                        <a href="<?php echo $this->Html->url(array('plugin' => "taxi", 'controller' => 'taxis', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['ddrivers']) && $permissions['ddrivers'] == 1)) { ?>
        <div class="col-sm-3">
            <div class="panel panel-white no-radius text-center">
                <div class="panel-body">

                    <h2 class="StepTitle">DRIVERS</h2>
                    <span class="links cl-effect-1"><?php echo $drivers_list; ?></span>
                    <p class="links cl-effect-1">
                        <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'driver', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class='clear'></div>
    <div id="account_report_data" class="">
        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">CUSTOMER INVOICES</h2>
                        <span class="links cl-effect-1" id="CI">&#8377; <?php echo $customer_invoices_count; ?></span>
                        <p class="links cl-effect-1">
                            <?php echo $this->Html->link('view more', array('controller' => 'invoice', 'action' => 'index'), array('escape' => false)); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_receipts']) && $permissions['dcustomer_receipts'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">CUSTOMER RECEIPTS</h2>
                        <span class="links cl-effect-1" id="CR">&#8377; <?php echo $customer_recipts_count; ?></span>
                        <p class="links cl-effect-1">
                            <a href="<?php echo $this->Html->url(array('plugin' => 'transaction', 'controller' => 'transactions', 'action' => 'index')); ?>">view more</a>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>
        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_refunds']) && $permissions['dcustomer_refunds'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">CUSTOMER REFUNDS</h2>
                        <span class="links cl-effect-1" id="CF">&#8377; <?php echo $count_refunds; ?></span>
                        <p class="links cl-effect-1">
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'cancelled_bookings', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

                        </p>
                    </div>
                </div>
            </div>   
        <?php } ?>
        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dvendor_receipts']) && $permissions['dvendor_receipts'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">VENDOR INVOICES</h2>
                        <span class="links cl-effect-1" id="VR">&#8377; <?php echo $vendoe_invoice_count; ?></span>
                        <p class="links cl-effect-1">
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'vendor_invoices', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

                        </p>
                    </div>
                </div>
            </div> 
        <?php } ?>



        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">TOTAL GST COLLECTED</h2>
                        <span class="links cl-effect-1" id="TGST">&#8377;<?php echo $total_GST; ?></span>
                        <p class="links cl-effect-1">
                            <?php echo $this->Html->link('view more', array('controller' => 'invoice', 'action' => 'index'), array('escape' => false)); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">MMT BASE FARE</h2>
                        <span class="links cl-effect-1" id="BMMT">&#8377;<?php echo $total_base_mmt; ?></span>
                        <p class="links cl-effect-1">
                            <?php echo $this->Html->link('view more', array('controller' => 'invoice', 'action' => 'index'), array('escape' => false)); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">MMT CANCELLATION CHARGED</h2>
                        <span class="links cl-effect-1" id="BMMT">&#8377;<?php echo $total_mmt_can_charged; ?></span>
                        <p class="links cl-effect-1">
                            <?php echo $this->Html->link('view more', array('controller' => 'lead_company_soas', 'action' => 'cancellation_invoices'), array('escape' => false)); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>


        <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcustomer_invoices']) && $permissions['dcustomer_invoices'] == 1)) { ?>
            <div class="col-sm-3">
                <div class="panel panel-white no-radius text-center">
                    <div class="panel-body">

                        <h2 class="StepTitle">VENDORS EXCESS PAYMENT</h2>
                        <span class="links cl-effect-1" id="VEXP">&#8377;<?php echo $total_ex_payment; ?></span>
                        <p class="links cl-effect-1">
                            <a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'vendor_invoices', 'action' => 'excess_payments')); ?>"><span class="title"> view more</span></a>

                        </p>
                    </div>
                </div>
            </div>
        <?php } ?>







    </div>
    <div class='clear'></div>



    <div class="contentpanel">

        <div class="panel panel-default">

            <div class="panel-body">

                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['ddaily_booking_trend']) && $permissions['ddaily_booking_trend'] == 1)) { ?>
                        <div class="col-md-12 mb30">
                            <div id="divLoading1" class="divLoading"></div>
                            <div  id="line_chart_count_booking"></div>
                        </div>
                    <?php } ?>

                </div>

                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['ddaily_booking_trend']) && $permissions['ddaily_booking_trend'] == 1)) { ?>
                        <div class="col-md-5 col-sm-12">
                            <div id="divLoading212" class="divLoading"></div>
                            <div id="line_chart_hour_booking"></div>
                        </div>

                    <?php } ?>
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['ddaily_booking_trend']) && $permissions['ddaily_booking_trend'] == 1)) { ?>
                        <div class="col-md-4 col-sm-12">
                            <div id="divLoading213" class="divLoading"></div>
                            <div id="line_chart_weekly_booking"></div>
                        </div>

                    <?php } ?>

                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dbooking_status']) && $permissions['dbooking_status'] == 1)) { ?>
                        <div class="col-md-3 mb30">
                            <div id="divLoading4" class="divLoading"></div>
                            <div id="booking_status"></div>
                        </div>
                    <?php } ?>


                </div>



                <div class="row" style="margin-bottom: 30px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dbooking_types']) && $permissions['dbooking_types'] == 1)) { ?>
                        <div class="col-md-6 mb30">
                            <div id="divLoading3" class="divLoading"></div>
                            <div id="piechart_bookings"></div>
                        </div>
                    <?php } ?>
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['btimegf']) && $permissions['btimegf'] == 1)) { ?>
                        <div class="col-md-6 mb30">
                            <div id="divLoading102" class="divLoading"></div>
                            <div id="BookingTimeGraph"></div>
                        </div>
                    <?php } ?>




                    <?php //if (!isset($permissions) || (isset($permissions) && isset($permissions['dtrip_feedback']) && $permissions['dtrip_feedback'] == 1)) { ?>
                    <!--                        <div class="col-md-3 mb30">
                                                <div id="divLoading5" class="divLoading"></div>
                                                <div id="booking_feedback"></div>
                                            </div>-->
                    <?php //} ?>
                </div>
                
                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcity_wise_bookings']) && $permissions['dcity_wise_bookings'] == 1)) { ?>
                        <div class="col-md-12 mb30">
                            <div id="divLoading104" class="divLoading"></div>
                            <div  id="HotRoutes"></div>
                        </div>
                    <?php } ?>
                </div>

                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dcity_wise_bookings']) && $permissions['dcity_wise_bookings'] == 1)) { ?>
                        <div class="col-md-12 col-sm-12">
                            <div id="divLoading2" class="divLoading"></div>
                            <div id="bar_chart_city_wise_booking"></div>
                        </div>
                    <?php } ?>
                </div>
                
                
                 

                <div class="row" style="margin-bottom: 18px;">

                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['bsource']) && $permissions['bsource'] == 1)) { ?>
                        <!--                        <div class="col-md-5 mb30">
                                                    <div id="divLoading101" class="divLoading"></div>
                                                    <div id="piechart_bsource"></div>
                                                </div>-->
                    <?php } ?>


                    <?php //if (!isset($permissions) || (isset($permissions) && isset($permissions['dtrip_feedback']) && $permissions['dtrip_feedback'] == 1)) { ?>
                    <!--                        <div class="col-md-3 mb30">
                                                <div id="divLoading5" class="divLoading"></div>
                                                <div id="booking_feedback"></div>
                                            </div>-->
                    <?php //} ?>
                </div>




                <div class="row" style="margin-bottom: 18px;">




                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['enquirycon']) && $permissions['enquirycon'] == 1)) { ?>
                        <!--                        <div class="col-md-3 mb30">
                                                    <div id="divLoading103" class="divLoading"></div>
                                                    <div id="EnquiryConversion"></div>
                                                </div>-->
                    <?php } ?>

                </div>







                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['duser_pattern']) && $permissions['duser_pattern'] == 1)) { ?>
                        <!--                        <div class="col-md-6 mb30">
                                                    <h4 class="subtitle">User Pattern</h4>
                                                    <div class="col-md-4 mb30">
                                                        <div id="divLoading6" class="divLoading"></div>
                                                        <div id="bar_chart_user_repuser"></div>
                                                    </div>
                                                    <div class="col-md-4 mb30">
                                                        <div id="divLoading7" class="divLoading"></div>
                                                        <div  id="bar_chart_guest_registered"></div>
                                                    </div>
                                                    <div class="col-md-4 mb30">
                                                        <div id="divLoading8" class="divLoading"></div>
                                                        <div id="bar_chart_user_pattern"></div>
                                                    </div>
                                                </div>-->
                    <?php } ?>
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dpanic_button']) && $permissions['dpanic_button'] == 1)) { ?>
                        <div class="col-md-6 mb30">
                            <div id="divLoading9" class="divLoading"></div>
                            <div id="panic_button"></div>
                        </div>
                    <?php } ?>
                </div>


                <div class="row" style="margin-bottom: 18px;">
                    <?php if (!isset($permissions) || (isset($permissions) && isset($permissions['dwebsite_visitor_pattern']) && $permissions['dwebsite_visitor_pattern'] == 1)) { ?>
                        <!--                        <div class="col-md-6 mb30">
                                                    <div id="divLoading10" class="divLoading"></div>
                                                    <h4 class="subtitle">Website Visitor Pattern</h4>
                                                    <div id="visiters"></div>
                                                </div>
                                                <div class="col-md-6 mb30">
                                                    <div id="divLoading11" class="divLoading"></div>
                                                    <div  id="line_chart_visitors"></div>
                                                </div>-->

                    <?php } ?>


                </div><!-- row -->

               




            </div>

        </div>

    </div>
<?php } else if ($dashboard_type == 4) { ?>

    <div class="contentpanel">


        <div class="panel panel-default">
            <div class="panel-body">

                <div class="row" style="margin-bottom: 18px;">
                    <?php
                    if (!empty($city_listing)) {

                        if (isset($permissions) && !empty($permissions)) {
                            if ((isset($permissions['checkdashboard4']) && $permissions['checkdashboard4'] == 1)) {
                                $check_for_city_permission = 1;
                            }
                        } else {
                            $check_for_city_permission = 0;
                        }

                        foreach ($city_listing as $ctData) {
                            $show_ct_graph = 1;
                            if ($check_for_city_permission == 1) {
                                if (isset($permissions['City_' . $ctData['City']['id']])) {
                                    $show_ct_graph = 1;
                                } else {
                                    $show_ct_graph = 0;
                                }
                            } else {
                                $show_ct_graph = 1;
                            }
                            if ($show_ct_graph) {
                                ?>
                                <div class="col-md-6 col-sm-6 loadGrapg" id="loadGrapg_<?php echo $ctData['City']['id'] ?>">
                                    <div id="divLoad_<?php echo $ctData['City']['id'] ?>" class="divLoading"></div>
                                    <div id="cityWiseBooking_<?php echo $ctData['City']['id'] ?>"></div>
                                    <div style="display:none" id="cityName_<?php echo $ctData['City']['id'] ?>"><?php echo $ctData['City']['name'] ?></div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>

                </div>

            </div>

        </div>

    </div>

    <div id="graphOpen" class="modal fade col-sm-12" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header" style="border: medium none;">

                    <div class="col-sm-12 col-md-12">
                        <div class="col-sm-9"><h4 class="modal-title">Route wise performance for all cities from <span class="city_name_header">Delhi</span></h4>
                        </div>
                        <div class="col-sm-2"><a href="<?php echo WEBSITE_URL ?>admin/users/export_graph_data" class="export_url btn btn-sm btn-success">Export as CSV</a></div>
                        <div class="col-sm-1 close_bootstrap"><button type="button" class="close bootstrap-close" data-dismiss="modal">&times;</button></div>
                    </div>
                </div>
                <div class="col-sm-12 clr clear"></div>
                <div class="modal-body" style="margin-top: 10px;">

                    <div id="divLoad_Single" class="divLoading"></div>
                    <div class="graph_div" id="graph_div">

                    </div>

                </div>

            </div>

        </div>
    </div>

<?php } ?>


