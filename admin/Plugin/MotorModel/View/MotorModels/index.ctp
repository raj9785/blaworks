<?php

echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));
 echo $this->Html->script(array('jquery-ui.min'));
 ?>
<script>
    $(document).ready(function () {
       /*  $('#MotorModelFromDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#MotorModelToDate").datepicker("option", "minDate", selectedDate);
            }
        });
        $('#MotorModelToDate').datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            onClose: function (selectedDate) {
                $("#MotorModelFromDate").datepicker("option", "maxDate", selectedDate);
            }

        }); */
		
		$('#MotorModelFromDate').datepicker({
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,            
			maxDate: '<?php echo MAX_DATE_RANGE; ?>',
			onSelect: function (selectedDate) {
				var nyd = new Date(selectedDate);
				nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
				$('#MotorModelToDate').datepicker("option", {
					minDate: new Date(selectedDate),
					maxDate: nyd
				});
			  
				//$("#MotorModelToDate").datepicker("option", "minDate", selectedDate);
			},
		});
		$('#MotorModelToDate').datepicker({
			dateFormat: "yy-mm-dd",
			//dateFormat: "dd-mm-yy",
			changeMonth: true,
			changeYear: true,
			minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
			onClose: function (selectedDate) {
				$("#MotorModelFromDate").datepicker("option", "maxDate", selectedDate);
			}

		});
		
		
    });
</script>
<script type='text/javascript'>
    $(function () {

        $("#MotorModelMyAction").on('change', function () {
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

    })



    function deletediv(msg, obj) {
        user_id = $(obj).attr('id').replace("delete_", "");
        swal({
            title: "Are you sure?",
            text: "Vehicle Model will be deleted permanently",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes, delete it!',
            closeOnConfirm: false,
        },
                function () {
                    $.ajax({
                        type: 'post',
                        url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'deleterow')); ?>',
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
    function active(msg, obj) {
        user_id = $(obj).attr('id').replace("active_", "");
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
                        url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'change_status_active')); ?>',
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
    function inactive(msg, obj) {
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
                        url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'change_status_inactive')); ?>',
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

    function confirmDelete() {
        return confirm("Are you sure you want to delete these?");
    }
    function confirmActive() {
        return confirm("Are you sure you want to activate these?");
    }
    function confirmInactive() {
        return confirm("Are you sure you want to inactivate these?");
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
                            <h1 class="mainTitle">Vehicle Models</h1>
                        </div>
                        <div class="col-sm-4 text-align-right">
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __(' Add New Vehicle Model', true) . "", array('plugin' => "motor_model", 'controller' => 'motor_models', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">

                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">

				<?php
				echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
				?>




				<?php 	echo $this->Form->select('motor_type_id', $motor_type_id, array("default" => isset($Typename) && $Typename?$Typename:'', 'empty' => __('Vehicle Type', true), 'class' => 'form-control input-sm', 'value' => @$this->params->named['motor_type_id'])) . '&nbsp;'; ?>


				<?php   echo $this->Form->select('vehicle_manufacturer', $vehicle_manufacturer, array('empty' => __('Vehicle  Manufacturer', true), 'class' => 'form-control input-sm', 'value' => @$this->params->named['vehicle_manufacturer'])) . '&nbsp;'; ?>



				<?php   echo $this->Form->select('MotorModel.id', $motor_model_id, array('empty' => __('Vehicle Model', true), 'value' => @$this->params->named['id'], 'class' => 'form-control input-sm')) . '&nbsp;'; ?>

				<?php
				echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => @$this->params->named['from_date'],  'class' => ' form-control input-sm')) . '&nbsp;';

				echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => @$this->params->named['to_date'], 'class' => ' form-control input-sm')) . '&nbsp;';
				?>	



				<?php //echo $this->Form->text('Typename', array('value' => isset($Typename) ? $Typename : '','placeholder' => __('Vehicle Category', true), 'class' => 'form-control input-sm', 'value' => $Typename)); ?>
				<?php
				//echo $this->Form->text('MotorModel.name', array('value' => isset($Categoryname) ? $Categoryname : '','placeholder' => __('Vehicle Model', true), 'class' => 'form-control input-sm'));
				?>

				<?php //echo $this->Form->text('Motorname', array('value' => isset($Motorname) ? $Motorname : '','placeholder' => __('Vehicle Manufacturer', true), 'class' => 'form-control input-sm', 'value' => $Motorname)); ?>



                                &nbsp;&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false)); ?>
                                &nbsp;&nbsp;<a class="btn btn-green add-row new-style-top2" href="<?php echo $this->Html->url(array('action' => 'index')); ?>">Reset</a>
                                &nbsp;&nbsp;
				    <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>		    
                    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
                        <thead>
                            <tr style="height:30px;">
                                <th class="hidden-xs">S.No.<?php //echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall')); ?></th>
                                <th class="hidden-xs">Vehicle Type</th>
                                <th class="hidden-xs">Vehicle Manufacturer</th>
                                <th class="hidden-xs">Vehicle Model</th>
                                <th class="hidden-xs">Created</th>
                                <th class="hidden-xs"><?php echo __('Action'); ?></th>
                            </tr>
                        </thead>
                        <tbody >
			    <?php
			    if (!empty($result)) {
				$count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
				if ($page == 0 || $page == 1) {
                                                    $i = $count_new_bookings;
                                                } else {
                                                    //echo $count_new_bookings;
                                                    $i = $count_new_bookings - $limit * ($page - 1);
                                                }

				foreach ($result as $records) {
				    //pr($records);
				    ?>
                            <tr style="height:30px;" class="gallerytr">
                                <td>
					    <?php echo $i; ?>
                                </td>
                                <td>
					    <?php echo $records["MotorType"]['name']; ?>
                                </td>
                                <td>
					    <?php echo $records["Motor"]['name']; ?>
                                </td>

                                <td>
					    <?php 
						//echo $model;
						echo $records[$model]['name']; ?>
                                </td>


                                <td >
					    <?php echo date(DATE_FORMAT,$records[$model]['created']); ?>
                                </td>

                                <td>

                                    <div class="dropdown" style='float:left'>
                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button"
                                           data-toggle="dropdown" data-target="#" href="javascript:void(0)"
                                           style='text-decoration:none'>
						    <?php echo __('Action'); ?> <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                                            <li> 
									<?php
									echo $this->Html->link( __('Edit', true), array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'edit', $records[$model]['id']), array('class' => '', 'escape' => false));
									?>
                                            </li>		


                                            <li>
							  <?php
					    if ($records[$model]['status'] == 1) {	?>	
                                                <a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactivate this MotorModel?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactivate.">Inactivate</a>
					    <?php } else { 	?> 
                                                <a href='javascript:void(0)' onclick='return active("Are you sure you want to activate this MotorModel?", this);' id='active_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to activate.">Activate</a>	


					    <?php } ?>
                                            </li>

                                            <li>
                                                <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this MotorModel?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete.">Delete</a>				 
                                            </li>
                                        </ul>
                                    </div>


                                </td>
                            </tr>
				    <?php
				    $i--;
				}
				?>

                            <!--paging information-->
                            <tr>
                                <td colspan="20"><?php echo $this->element('pagination'); ?></td>
                            </tr>
				<?php
			    } else {
				?>
                            <tr>
                                <td align="center" style="text-align:center;" colspan="6" class=""><?php echo __('No Result Found'); ?></td>
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
        if ($(".case:checked").length == 0)
        {
            $('input[type="submit"]').attr('disabled', 'disabled');
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
