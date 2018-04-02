
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false));

echo $this->Html->script(array('jquery-ui.min'));
?>
<script>
    $(document).ready(function() {
	$('#VendorVehicleFromDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#VendorVehicleToDate").datepicker("option", "minDate", selectedDate);
	    }
	});
	$('#VendorVehicleToDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#VendorVehicleFromDate").datepicker("option", "maxDate", selectedDate);
	    }

	});
    });
</script>
<script type='text/javascript'>
    $(function() {

	$("#VendorVehicleMyAction").on('change', function() {
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
	    text: "Vehicle will be deleted permanently",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#DD6B55',
	    confirmButtonText: 'Yes, delete it!',
	    closeOnConfirm: false,
	},
		function() {
		    $.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'vehicle_deleterow')); ?>',
			data: 'id=' + user_id,
			dataType: 'json',
			success: function(data) {
			    if (data.succ == 1) {
				swal({
				    title: "Deleted!",
				    text: data.msg,
				    type: "success",
				    showCancelButton: false,
				    confirmButtonColor: '#d6e9c6',
				    confirmButtonText: 'OK',
				    closeOnConfirm: false,
				}, function() {
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
				}, function() {
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
		function() {
		    $.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'vehicle_change_status_active')); ?>',
			data: 'id=' + user_id,
			dataType: 'json',
			success: function(data) {
			    if (data.succ == 1) {
				swal({
				    title: "Changed!",
				    text: data.msg,
				    type: "success",
				    showCancelButton: false,
				    confirmButtonColor: '#d6e9c6',
				    confirmButtonText: 'OK',
				    closeOnConfirm: false,
				}, function() {
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
				}, function() {
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
		function() {
		    $.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'vehicle_change_status_inactive')); ?>',
			data: 'id=' + user_id,
			dataType: 'json',
			success: function(data) {
			    if (data.succ == 1) {
				swal({
				    title: "Changed!",
				    text: data.msg,
				    type: "success",
				    showCancelButton: false,
				    confirmButtonColor: '#d6e9c6',
				    confirmButtonText: 'OK',
				    closeOnConfirm: false,
				}, function() {
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
				}, function() {
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
    function ck(id) {
	$("#VendorVehicleVehicleMotorId").val(id);
    }

</script>
<style>
    .input-sm{margin: 5px 5px; width: 18% !important;}
</style>
<?php
//pr($uniqid);
if (!empty($vendor_company) && !empty($uniqid)) {
    $Vname = $vendor_company['Company']['name'] . "  (" . $uniqid['User']['uniqid'] . ")";
} else {
    $Vname = "My";
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
                            <h1 class="mainTitle"><?php echo $Vname; ?> List of Vehicles </h1>
                        </div>
			<div class="col-sm-4 text-align-right">
			    <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Vehicle', true) . "", array('plugin' => "taxi", 'controller' => 'taxis', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>

                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white table_top_margin">

                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left1 driver_index1">

				<?php
				echo $this->Form->create("VendorVehicle", array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
				?>
				<?php //echo $this->Form->text('VendorVehicle.firstname', array('placeholder' => __('Search By Vendor First Name', true), 'class' => 'form-control input-medium'));	?>
				<?php //echo $this->Form->text('VendorVehicle.lastname', array('placeholder' => __('Search By Vendor Last Name', true), 'class' => 'form-control input-medium'));	?>
				<?php //echo $this->Form->text('VendorVehicle.uniqid', array('placeholder' => __('Search By Vehicle Id', true), 'class' => 'form-control input-medium')); ?>
				<?php //echo $this->Form->text('Vehicle Motor', array('placeholder' => __('Search By Vehicle Motor', true), 'class' => 'form-control input-medium'));  ?>

				<?php echo $this->Form->select('Taxi.motor_type_id', $motor_type_id, array("default" => isset($Typename) && $Typename ? $Typename : '', 'empty' => __('Vehicle Type', true), 'class' => 'form-control input-sm')) . '&nbsp;'; ?>		
				<?php echo $this->Form->select('Taxi.motor_model_id', $motor_model_id, array("default" => isset($mdel_name) && $mdel_name ? $mdel_name : '', 'empty' => __('Vehicle Model', true), 'class' => 'form-control input-sm')) . '&nbsp;'; ?>		
				<?php echo $this->Form->text('Vehicle No', array('placeholder' => __('Vehicle Number', true), 'class' => 'form-control input-medium')); ?>			
				<?php echo $this->Form->select('status', array('1' => 'Active', '0' => 'Inactive'), array('empty' => __('Status', true), 'class' => 'form-control input-sm')) . '&nbsp;'; ?>								  
				<?php echo $this->Form->select('verified', array('1' => 'Verified', '0' => 'Not-Verified'), array('empty' => __('Verification Status', true), 'class' => 'form-control input-sm')) . '&nbsp;'; ?>				
				<?php echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;'; ?>				
				<?php echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;'; ?>				
				<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style-top', 'escape' => false)) . '&nbsp;'; ?>
				<?php echo $this->Html->link('Reset', array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'vehiclelist', $vendorid), array('class' => 'btn btn-green add-row new-style-top ')); ?>				
				<?php echo $this->Form->end(); ?>

			    </div>
			</div>
		    </div>
		    <div class="clear"></div>

		    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
			<thead>
			    <tr style="height:30px;">
				<th class="hidden-xs" width="5%"><?php echo __('S.No.', true); ?></th>
				<th class="hidden-xs"><?php echo __('Vehicle Type', true); ?></th>
				<!--th class="hidden-xs"><?php //echo __('Vehicle Model', true); ?></th-->			
				<th class="hidden-xs"><?php echo __('Vehicle Number', true); ?></th>
				<th class="hidden-xs"><?php echo __('Registered On', true); ?></th>
				<th class="hidden-xs"> <?php echo __('Status'); ?></th>
				<th class="hidden-xs"><?php echo __('Verified'); ?></th>
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
				    // pr($records); 
				    ?>
				    <tr style="height:30px;" class="gallerytr">
					<td>
					    <?php echo $i; ?>
					</td>
					<td>
					    <?php echo $records['MotorType']['name']; ?>
					</td>
					<!--td>
					    <?php // echo $records['Motor']['name'] . ' ' . $records['MotorModel']['name']; ?>
					</td--->

					<td>
					    <?php echo $records["Taxi"]['plate_no']; ?>
					</td>



					<td >
					    <?php echo date(DATE_FORMAT, $records["Taxi"]['created']); ?>
					</td>


					<td  >

					    <?php
					    if ($records['VendorVehicle']['status'] == 1) {
						$status_img = 'active.png';
						$chang = "Inactive";
					    } else {
						$status_img = 'inactive.png';
						$chang = "Active";
					    }
					    ?>

					    <img title="Click here for <?php echo $chang; ?>" style="cursor:pointer;" class="my_status" id="status_<?php echo $records['VendorVehicle']['id']; ?>" src="<?php echo WEBSITE_URL . "img/" . $status_img; ?>" width="20" height="20" />
					    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"  id="status_aja_<?php echo $records['VendorVehicle']['id']; ?>" style="display:none;" />
					</td>
					<td>

					    <?php
					    if ($records['Taxi']['verified'] == 1) {
						$veri_img = 'veri.png';
						$chang = "UnVerified";
					    } else {
						$veri_img = 'not_veri.gif';
						$chang = "Verified";
					    }
					    ?>

					    <img title="Click here for <?php echo $chang; ?>" style="cursor:pointer;" class="my" id="<?php echo $records['Taxi']['id']; ?>" src="<?php echo WEBSITE_URL . "img/" . $veri_img; ?>" width="20" height="20" />
					    <img src="<?php echo WEBSITE_URL . "img/ajax.gif"; ?>"  id="aja_<?php echo $records['Taxi']['id']; ?>" style="display:none;" /> 

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
							echo $this->Html->link(__('Edit', true), array('plugin' => 'taxi', 'controller' => 'taxis', 'action' => 'edit', $records['Taxi']['id'],$vendorid), array('class' => '', 'escape' => false));
							?>

						    </li>	
						    <li>
							<?php if ($records["VendorVehicle"]['status'] == 1) { ?>	
	    						<a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactivate this Vehicle?", this);' id='inactive_<?php echo $records["VendorVehicle"]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactive.">Inactivate</a>
							<?php } else { ?> 
	    						<a href='javascript:void(0)' onclick='return active("Are you sure you want to activate this Vehicle?", this);' id='active_<?php echo $records["VendorVehicle"]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to active.">Activate</a>	
							<?php } ?>
						    </li>
						    <li>
							<a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this Vehicle?", this);' id='delete_<?php echo $records['VendorVehicle']['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete.">Delete</a>
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
    				<td align="center" style="text-align:center;" colspan="10" class=""><?php echo __('No Record Found'); ?></td>
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

    checkboxes.click(function() {
	submitButt.attr("disabled", !checkboxes.is(":checked"));
    });
    $('#selectall').click(function() {
	submitButt.attr("disabled", !checkboxes.is(":checked"));
    });
    // add multiple select / deselect functionality
    $("#selectall").click(function() {

	$('.case').attr('checked', this.checked);
	if ($(".case:checked").length == 0)
	{
	    $('input[type="submit"]').attr('disabled', 'disabled');
	}
	;

    });


    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function() {

	if ($(".case").length == $(".case:checked").length) {
	    $("#selectall").attr("checked", "checked");
	} else {
	    $("#selectall").removeAttr("checked");
	}

    });

    $("#VendorVehicleIndexForm").on("submit", function() {
	var other_data = $(this).serialize();
	$.ajax({
	    beforeSend: function() {
		$("#loader").show();
	    },
	    url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'add_vehicle')); ?>',
	    type: 'post',
	    data: other_data,
	    success: function(res) {
		$("#loader").hide();
		if (res == 1) {
		    $("#msg").html("Vehicle assigned to Vendor successfully");
		}
		else if (res == 0) {
		    $("#msg").html("Unable to assigne vehicle to Vendor ! Try Again");
		    $("#msg").css('color', '#ff0000');
		}
		else if (res == 2) {
		    $("#msg").html("Vehicle No alreadt exist");
		    $("#msg").css('color', '#ff0000');
		}
		$("#msg").show();

		setTimeout(function() {
		    $("#msg").hide();
		    $("#VendorVehicleIndexForm")[0].reset();
		}, 2000);

	    },
	    error: function(err) {
		$("#loader").hide();
		$("#msg").html("Unable to assigne vehicle to Vendor ! Try Again");
		$("#msg").css('color', '#ff0000');
		$("#msg").show();

	    }

	});
    });
</script>
