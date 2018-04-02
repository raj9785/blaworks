<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    function checkValiValue(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
            return false;
        }
    }


    jQuery(document).ready(function () {

        $('#LeadCompanyFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#LeadCompanyToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#LeadCompanyToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#LeadCompanyFromDate").datepicker("option", "maxDate", selectedDate);
            }

        });

        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'lead_company', 'controller' => 'lead_companies', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Lead Companu will be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => 'lead_company', 'controller' => 'lead_companies', 'action' => 'delete')) ?>',
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
<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- start: TOP NAVBAR -->
    <?php echo $this->element('header'); ?>
    <!-- end: TOP NAVBAR -->
    <div class="main-content">
        <div class="wrap-content container" id="container">

            <?php echo $this->Session->flash(); ?>

            <section id="page-title">
                <div class="row">
                    <div class="col-sm-10">
                        <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                    </div>

                </div>
            </section>	


            <div class="container-fluid container-fullw bg-white">
                <?php
                echo $this->Form->create($model, array('url' => array('plugin' => 'time_category', 'controller' => 'time_categories', 'action' => 'index'), 'enctype' => 'multipart/form-data'));
                ?>
                <?php //echo $this->Form->input('TimeCategory.id', array('type' => 'hidden')); ?>
                <div class="row">
                    <div class="col-md-12">



                        <table class="table table-bordered  table-full-width add_fares">

                            <tr>
                                <th align="center">Pickup - Current Time</th>
                                <th align="center">Hold Time</th>
                                <th  align="center">One Way (F)</th>
                                <th align="center">One Way (R)</th>
                                <th  align="center">RT / MC</th>										
                                <th align="center" >Day Package</th>
                                <th align="center" >Cancelled</th>

                            </tr>

                            <?php
                            //pr($motortype);
                            $i = 0;
                            foreach ($HoldBookingData as $madata) {
                                $index = $madata['TimeCategory']['id'];
                                ?>
                                <tr>
                                    <td ><?php echo $madata['TimeCategory']['title_range']; ?>
                                        <?php echo $this->Form->input('TimeCategory.' . $index . '.id', array('value' => $index, 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
                                    </td>

                                    <td >
                                        <?php echo $madata['TimeCategory']['hold_time_title']; ?>
                                    </td>
                                    <td align="center"> <?php echo $this->Form->input('TimeCategory.' . $index . '.oneway.charges', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "100", "class" => "form-control textbox rate_inputs_b", 'value' => @$HoldBookingData[$i]['CancelChargeManagement'][0]['charges'])); ?></td>

                                    <td >
                                        <?php echo $this->Form->input('TimeCategory.' . $index . '.onewayfixed.charges', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "100", "class" => "form-control textbox rate_inputs_b", 'value' => @$HoldBookingData[$i]['CancelChargeManagement'][1]['charges'])); ?>

                                    </td>

                                    <td >

                                        <?php echo $this->Form->input('TimeCategory.' . $index . '.round.charges', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "100", "class" => "form-control textbox rate_inputs_b", 'value' => @$HoldBookingData[$i]['CancelChargeManagement'][2]['charges'])); ?>

                                    </td>



                                    <td >
                                        <?php echo $this->Form->input('TimeCategory.' . $index . '.daypackage.charges', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "100", "class" => "form-control textbox rate_inputs_b", 'value' => @$HoldBookingData[$i]['CancelChargeManagement'][3]['charges'])); ?>

                                    </td>

                                    <td >
                                        <?php echo $this->Form->input('TimeCategory.' . $index . '.cancel_charges', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "100", "class" => "form-control textbox rate_inputs_b", 'value' => @$HoldBookingData[$i]['TimeCategory']['cancel_charges'])); ?>

                                    </td>

                                </tr>

                                <?php
                                $i++;
                            }
                            ?>

                        </table>


                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div>

                            <hr>
                        </div>
                    </div>
                </div>
                <?php
                //  if ($can_edit == 1) {
                ?>
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button')) ?>
                        <?php echo $this->Html->link(__('Cancel', true), array("action" => "day_package"), array("class" => "btn btn-primary btn-wide", "escape" => false)); ?>
                    </div>
                </div>
                <?php //} ?>    



            </div>
        </div>

        <?php echo $this->Form->end(); ?>

    </div>

    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
