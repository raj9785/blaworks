<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>

<script>
    $(document).ready(function () {
        $('#RateFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#RateToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#RateToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#RateFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });
    });

</script>
<style>
    .input-sm{margin: 5px 5px; width: 18% !important;}
    /* Ensure that the demo table scrolls */
    th, td { white-space: nowrap; }
    div.dataTables_wrapper {
        width: 800px;
        margin: 0 auto;
    }
</style>
<?php 
$can_add = 1;
if ($loggedin_user['user_role_id'] != 1) {
    if ($loggedin_user['add_cust_fare'] != 1) {
        $can_add = 0;
    }
}

$can_edit = 1;
if ($loggedin_user['user_role_id'] != 1) {
    if ($loggedin_user['edit_cust_fare'] != 1) {
        $can_edit = 0;
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
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>
                         <?php
                        if ($can_add == 1) {
                            ?>
                        <div class="col-sm-4 text-align-right">	
                            <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Rate', true) . "", array('plugin' => "rate", 'controller' => 'rates', "action" => "add_one_way_fixed"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                        <?php } ?>

                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!--<div class="row">
                        <div class="col-md-12 space20">
                          
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">

                                <?php
                                echo $this->Form->create($model, array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));

                                //echo $this->Form->select('city_id', $city, array('empty' => __('Select City', true), 'value' => @$city_id, 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('destination', array('placeholder' => __('Destination', true), 'value' => @$destination, 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';

                                
                                echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => 'form-control input-sm')) . '&nbsp;';
                                ?>
                                <?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                                <a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('plugin' => 'rate', 'controller' => 'rates', 'action' => 'one_way_fixed')); ?>">Reset</a>
                                <?php
                                $val_url = json_encode($this->params->query);
                                $search_val_url = base64_encode(base64_encode($val_url));
                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => 'rate', 'controller' => 'rates', 'action' => 'export', $search_val_url, 'page' => $page_no, '?' => array('farecategory_id' => @$farecategory_id, 'invoice_type' => @$invoice_type)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl', 'style' => 'margin: 0 0 0 4px;', 'escape' => false)) . '&nbsp;';

                                echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => 'rate', 'controller' => 'rates', 'action' => 'export', $search_val_url, 'page' => $page_no, '?' => array('farecategory_id' => @$farecategory_id, 'invoice_type' => @$invoice_type)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl', 'style' => 'margin: 0 0 0 9px;', 'escape' => false));
                                ?>

                                <?php echo $this->Form->end(); ?>



                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div style="float: left; width: 20%;overflow: auto;">
                        <table class="table table-striped table-bordered" id="example2" width="20%">
                            <thead>
                                <tr style="height: 61px;">

                                    <th rowspan="2" align="center">S.No.</th>
                                    <th rowspan="2" align="center">Location Type</th>
                                    <th rowspan="2" align="center">Location name</th>
                                    <th rowspan="2" align="center">Km Included</th>
                                    <th rowspan="2" align="center">Booking Types</th>
                                    <th rowspan="2" align="center">Created</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php
                                if (!empty($result)) {
                                    if ($page == 0 || $page == 1) {
                                        $i = $count_new_garage;
                                    } else {
                                        $i = $count_new_garage - $limit * ($page - 1);
                                    }
                                    foreach ($result as $records) {
                                        ?>
                                        <tr style="cursor: pointer;" title="Double click to edit rates" class="gallerytr list_data" id="<?php echo $records['Rate']['id']; ?>">

                                            <td><?php echo $i; ?></td>	
                                            <td><?php echo ($records['Garage']['location_type']==1)?'Fixed':'Actuals'; ?></td>
                                            <td><?php echo $records['Garage']['location_name']; ?></td>	
                                            <td><?php echo $records['Garage']['km_included']; ?></td>	
                                            <td>
                                               

                                            </td>
                                              <td> <?php echo date(DATE_FORMAT, strtotime($records['Garage']['created'])); ?></td>
                                        </tr>

                                        <?php
                                        $i--;
                                    }
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                    <div style="overflow-x: auto; float: right; width: 80%;" class="table_list"> 
                        <table class="table table-striped table-bordered  table-full-width" id="example" width="80%">
                            <thead>
                                <tr style="height: 32px;">


                                    <?php
                                    if (!empty($motortype)) {
                                        foreach ($motortype as $madata) {
                                            $index = $madata['MotorType']['id'];
                                            $cab_name = $madata['MotorType']['name'] . " (" . $madata['MotorType']['capacity'] . " Seater)";
                                            ?>
                                            <th colspan="4" style="text-align: center;"><?php echo $cab_name; ?></th>
                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>
                                <tr>

                                    <?php
                                    if (!empty($motortype)) {
                                        foreach ($motortype as $madata) {
                                            ?>
                                            <th style="text-align: center;">Customer</th>
                                            <th style="text-align: center;">Vendor</th>
                                           


                                            <?php
                                        }
                                    }
                                    ?>
                                </tr>


                            </thead>
                            <tbody >
                                <?php
                                if (!empty($result)) {

                                    foreach ($result as $records) {
                                        //pr($records);
                                        ?>
                                        <tr style="cursor: pointer;" title="Double click to edit rates" class="gallerytr list_data" id="<?php echo $records['Rate']['id']; ?>">



                                            <?php
                                            $RateDetail = $records['RateDetail'];
                                            $new_arr = array();
                                            if (!empty($RateDetail)) {
                                                foreach ($RateDetail as $dts) {
                                                    $new_arr[$dts['motortype_id']] = $dts;
                                                }
                                            }
                                            //pr($new_arr);
                                            ?>


                                            <?php
                                            if (!empty($motortype)) {
                                                foreach ($motortype as $madata) {
                                                    $t = $madata['MotorType']['id'];
                                                    ?>
                                                    <?php
                                                    if (isset($new_arr[$t]) && !empty($new_arr[$t])) {
                                                        ?>

                                                        <td><?php echo $new_arr[$t]['base_fare_cust'] ? $new_arr[$t]['base_fare_cust'] : "0.00"; ?></td>
                                                        <td><?php echo $new_arr[$t]['base_fare_vend'] ? $new_arr[$t]['base_fare_vend'] : "0.00"; ?></td>

                                                        <td>&#8377;<?php echo $new_arr[$t]['company_margin_amount'] ? $new_arr[$t]['company_margin_amount'] : "0"; ?></td>
                                                        <td><?php echo $new_arr[$t]['company_margin_percent'] ? number_format($new_arr[$t]['company_margin_percent'], 2) : "0.00"; ?>%</td>

                                                    <?php } else { ?>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    <?php } ?>

                                                    <?php
                                                }
                                            }
                                            ?>

                                        </tr>
                                        <?php
                                    }
                                    ?>


                                    <?php
                                } else {
                                    ?>
                                    <tr>
                                        <td align="center" style="text-align:center;" colspan="40" class=""><?php echo __('No Result Found'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="clear"></div>
                    <div>
                        <?php echo $this->element('pagination'); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
</div>

<script>
    $(document).ready(function () {
//        $(".list_data").on("click", function () {
//            var id_fare = $(this).attr('id');
//           deletediv(id_fare); 
//            
//        });



        $(".list_data").on("dblclick", function () {
           
            var id_fare = $(this).attr('id');
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'rate', 'controller' => 'rates', 'action' => 'edit_one_way_fixed')); ?>/' + id_fare;
             
        });

    });

</script>

<?php
//echo $this->Html->script('https://maps.google.com/maps/api/js?key='.MAP_API_KEY.'&sensor=false&libraries=places');
?>

<?php //echo $this->Html->script('geocomplete.js', array('inline' => false));  ?>
<!--<script type="text/javascript">
    $(function () {
        $("#RateDestination").geocomplete({
            componentRestrictions: {country: 'IN'}, types: ['(cities)']
        }).bind("geocode:result", function (event, result) {
          var locations=result.formatted_address;
          if(locations){
              locations=locations.split(",");
              $("#RateDestination").val(locations[0]);
          }
            
        });

    });
</script>-->
