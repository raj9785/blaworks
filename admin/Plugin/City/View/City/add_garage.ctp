<?php

echo $this->Html->script('https://maps.google.com/maps/api/js?key=' . MAP_API_KEY . '&sensor=false&libraries=places');
?>

<script type="text/javascript">
    jQuery(document).ready(function () {
        $("#check_all_f").on("click", function () {
            $("input[id^=booking_type]").each(function () {
                $("#" + $(this).attr('id')).prop('checked', 'checked');
            });
        });
        $("#uncheck_all_f").on("click", function () {
            $("input[id^=booking_type]").each(function () {
                $("#" + $(this).attr('id')).removeAttr('checked');
            });
        });

       

        $("#submit_button").on("click", function () {
            if ($("#CityLocationType").val() == '') {
                alert("Please select location type");
                return false;
            }
            if ($("#CityDestination").val() == '') {
                alert("Please select destination");
                return false;
            }

            if ($("#CityKmIncluded").val() == '') {
                alert("Please enter Fixed Kms");
                return false;
            }
            
            if ($("input[id^=booking_type]:checked").length == 0) {
                alert("Please Select booking type");
                return false;
            }

            var chks = 0
            $(".rate_inputs_b").each(function () {
                if ($(this).val() != '' && $(this).val() != 0) {
                    chks++;
                }

            });
            if (chks == 0) {
                alert("Please insert rate for atleast one Vehicle Category");
                return false;
            }

        });
    });

    function checkValiValue(evt) {
        var charCode = (evt.which) ? evt.which : evt.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46) {
            return false;
        }
    }

</script>
<style>
    .form-control{margin: 5px 5px; width: 90% !important;}

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
                        <div class="col-sm-10">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>
                        <div class="col-md-2 text-align-right">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to Cities List', true) . "", array('plugin' => false,'controller' => 'city',"action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                   
                     <?php echo $this->Form->create('City', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>
                   
                    <div class="row">
                        <div class="col-md-12">

                            <div class="row" style="">

                                <table class="table table-bordered  table-full-width add_fares">
                                    <tr>
                                        <td colspan="20">
                                            <table class="table-full-width ">
                                                <tr>
                                                    <td colspan="2">
                                                        <?php echo $this->Form->select('City.location_type', array(1=>'Fixed',2=>'Actuals'), array('empty' => "Select Location Type", "class" => "form-control textbox validate[required]", 'tabindex' => 1)); ?>
                                                    </td>
                                                    <td colspan="2">
                                                        <?php echo $this->Form->text('City.destination', array("placeholder" => "Destination", "class" => "form-control input_text validate[required]", 'tabindex' => 2)); ?>


                                                        <?php echo $this->Form->input('City.destination_latitude', array('type' => 'hidden', 'class' => 'input_text', 'label' => false, 'div' => false, 'id' => 'destination_latitude')); ?>
                                                        <?php echo $this->Form->input('City.destination_longitude', array('type' => 'hidden', 'class' => 'input_text', 'label' => false, 'div' => false, 'id' => 'destination_longitude')); ?>
                                                        <?php echo $this->Form->input('City.farecategory_id', array('type' => 'hidden', 'value' => '4', 'class' => 'input_text', 'label' => false, 'div' => false)); ?>
                                                    </td>
                                                    <td colspan="2">
                                                        <?php echo $this->Form->text('City.km_included', array("placeholder" => "Fixed Kms", 'onkeypress' => "return checkValiValue(event)", "class" => "form-control input_text validate[required]", 'tabindex' => 3)); ?>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="mult_chk">
                                                            <label class="control-label">Booking Type <span class="symbol required"></span>
                                            <?php
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Check All', 'javascript:void(0)', array('escape' => false, 'id' => 'check_all_f'));
                                            echo '&nbsp;&nbsp;' . $this->Html->link('Uncheck All', 'javascript:void(0)', array('escape' => false, 'id' => 'uncheck_all_f'));
                                            ?>
                                                            </label>
                                        <?php echo $this->Form->input('fare_category_id', array('type' => 'select', 'div' => false, 'multiple' => 'checkbox', 'options' => $fare_category_list, 'class' => '', 'id' => 'booking_type', 'label' => false, 'tabindex' => 4, 'required' => true)); ?>

                                                        </div>
                                                    </td>
                                                    <td colspan="12"></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="width: 30%;text-align: center;" rowspan="2" align="center">Vehicle Category</th>
                                    </tr>
                                    <tr>
                                        <th align="center">Customer Price</th>
                                        <th align="center">Vendor Price</th>
                                    </tr>
                                    <?php
                                    //pr($motortype);
                                    $i = 0;
                                    foreach ($motortype as $madata) {
                                        $index = $madata['MotorType']['id'];
                                        $cab_name = $madata['MotorType']['name'] . " (" . $madata['MotorType']['capacity'] . " Seater)";

                                        $j = $i * 8 + 4;
                                        ?>
                                    <tr>
                                        <td align="center"><?php echo $cab_name; ?>
                                                <?php echo $this->Form->input('RateDetail.' . $i . '.motortype_id', array('value' => $index, 'type' => 'hidden', 'label' => false, 'div' => false)); ?>
                                        </td>
                                        <td align="center"> <?php echo $this->Form->input('RateDetail.' . $i . '.base_fare_cust', array("type" => "text", "label" => false, "min" => "0", 'onkeypress' => "return checkValiValue(event)", "max" => "10000000", "class" => "form-control textbox rate_inputs_b", 'tabindex' => $j + 3)); ?></td>
                                        <td align="center"><?php echo $this->Form->input('RateDetail.' . $i . '.base_fare_vend', array("type" => "text", "label" => false, "min" => "0", "max" => "10000000", 'onkeypress' => "return checkValiValue(event)", "class" => "form-control textbox rate_inputs", 'tabindex' => $j + 4, 'step' => 'any')); ?>
                                    </tr>

                                        <?php
                                        $i++;
                                    }
                                    ?>

                                </table>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div>

                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                        </div>
                        <div class="col-md-4">
                            <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide', 'type' => 'submit', 'id' => 'submit_button')) ?>
                            <?php echo $this->Html->link(__('Cancel', true), array('plugin' => false,'controller' => 'city',"action" => "index"), array("class" => "btn btn-primary btn-wide", "escape" => false)); ?>
                        </div>
                    </div>



                </div>
            </div>

            <?php echo $this->Form->end(); ?>

        </div>
    </div>



    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
<?php echo $this->Html->script('geocomplete.js', array('inline' => false)); ?>
<script type="text/javascript">
    $(function () {
        $("#CityDestination").geocomplete({
            componentRestrictions: {country: 'IN'}, types: []
        }).bind("geocode:result", function (event, result) {
            $("#destination_latitude").val(result.geometry.location.lat());
            $("#destination_longitude").val(result.geometry.location.lng());
        });

    });
</script>
