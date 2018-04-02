
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type='text/javascript'>
    $(function() {

	$("#MotorModelMyAction").on('change', function() {
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
		function() {
		    $.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'deleterow')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'change_status_active')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'change_status_inactive')); ?>',
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
	return confirm("Are you sure you want to active these?");
    }
    function confirmInactive() {
	return confirm("Are you sure you want to inactive these?");
    }
</script>


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
                        <div class="col-sm-12">
                            <h1 class="mainTitle">Vehicle Model Management</h1>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left"><?php echo $this->element('paging_info'); ?></div>
			    <div class="pull-right">
				<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add', true) . "", array('plugin' => "motor_model", 'controller' => 'motor_models', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			    </div>
			</div>
		    </div>
                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left1 driver_index1">

				<?php
				echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
				?>
				<?php
				echo $this->Form->text('MotorModel.name', array('placeholder' => __('Search By Motor Model', true), 'class' => 'form-control input-medium'));
				?>&nbsp;&nbsp;
				<?php echo $this->Form->text('Motorname', array('placeholder' => __('Search By Motor', true), 'class' => 'form-control input-medium', 'value' => $Motorname)); ?>&nbsp;&nbsp;
				<?php echo $this->Form->text('Typename', array('placeholder' => __('Search By Category', true), 'class' => 'form-control input-medium', 'value' => $Typename)); ?>&nbsp;&nbsp;


				&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false)); ?>
				<?php echo $this->Form->end(); ?>
			    </div>
			</div>
		    </div>
		    <div class="clear"></div>
		    <?php
		    echo $this->Form->create($model, array('class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
		    echo '<div class="kk" style="position: relative;">';
		    echo $this->Form->select('my_action', array('delete' => 'Delete', 'active' => 'Active', 'inactive' => 'Inactive'), array('empty' => __('Select', true), 'class' => 'form-control input-medium', 'disabled' => false, 'style' => 'position: absolute;right: 0;top: -50px;')) . '&nbsp;';
		    echo $this->Form->submit("delete" . __("delete", true), array('id' => 'delete', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmDelete()'));
		    echo $this->Form->submit("active" . __("active", true), array('id' => 'active', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmActive()'));
		    echo $this->Form->submit("inactive" . __("inactive", true), array('id' => 'inactive', 'class' => 'btn btn-primary', 'escape' => false, 'style' => "display:none;", 'disabled' => true, 'onClick' => 'return confirmInactive()'));
		    echo '</div>';
		    ?>
		    <table class="table table-striped table-bordered table-hover table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
			<thead>
			    <tr style="height:30px;">
				<th class="hidden-xs"><?php echo $this->form->checkbox('id1', array('div' => false, 'label' => false, 'id' => 'selectall')); ?></th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('MotorType.name', __('Motor Category', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('Motor.name', __('Motor Company', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('name', __('Motor Model', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('created', __('Created', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo __('Action'); ?></th>
			    </tr>
			</thead>
			<tbody >
			    <?php
			    if (!empty($result)) {
				//pr($result);
				$i = 1;

				foreach ($result as $records) {
				    //pr($records);
				    ?>
				    <tr style="height:30px;" class="gallerytr">
					<td>
					    <?php echo $this->form->checkbox('id', array('hiddenField' => false, 'class' => 'case', 'name' => 'data[id][]', 'div' => false, 'label' => false, 'value' => $records[$model]['id'])); ?>
					</td>
					<td>
					    <?php echo $records["MotorType"]['name']; ?>
					</td>
					<td>
					    <?php echo $records["Motor"]['name']; ?>
					</td>

					<td>
					    <?php echo $records[$model]['name']; ?>
					</td>


					<td >
					    <?php echo date("m/d/Y", $records[$model]['created']); ?>
					</td>

					<td>
					    <?php
					    if ($records[$model]['status'] == 1) {
						?>	
	    				    <a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactive this MotorModel?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactive.">Inactive</a>
					    <?php } else {
						?> 
	    				    <a href='javascript:void(0)' onclick='return active("Are you sure you want to active this MotorModel?", this);' id='active_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to active.">Active</a>	


					    <?php }
					    ?>
					    <?php
					    echo $this->Html->link('<i class="fa fa-pencil"></i>' . __('', true), array('plugin' => 'motor_model', 'controller' => 'motor_models', 'action' => 'edit', $records[$model]['id']), array('class' => '', 'escape' => false));
					    ?>
					    

					    <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this MotorModel?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete."><i class="fa fa-times fa fa-white"></i></a>
					    &nbsp;

					</td>
				    </tr>
				    <?php
				    $i++;
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
</script>