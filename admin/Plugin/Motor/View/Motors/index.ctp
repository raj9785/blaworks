<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type='text/javascript'>
    $(function() {

	$("#MotorMyAction").on('change', function() {
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
	    text: "Category will be deleted permanently",
	    type: "warning",
	    showCancelButton: true,
	    confirmButtonColor: '#DD6B55',
	    confirmButtonText: 'Yes, delete it!',
	    closeOnConfirm: false,
	},
		function() {
		    $.ajax({
			type: 'post',
			url: '<?php echo $this->Html->url(array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'deleterow')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'change_status_active')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'change_status_inactive')); ?>',
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
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Vehicle Manufacturers</h1>
                        </div>
						 <div class="col-sm-4 text-align-right">
						<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New Manufacturer', true) . "", array('plugin' => "motor", 'controller' => 'motors', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
						 </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white table_top_margin">
                            <div class="row">
							</div>
		    <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
			<thead>
			    <tr style="height:30px;">
					<th class="hidden-xs" width="5%">S.No.</th>				
				<th class="hidden-xs">Vehicle Manufacturers</th>
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
					$i = $count_new_bookings - $limit * ($page - 1);
				    }
				foreach ($result as $records) {
				    //pr($records);
				    ?>
				    <tr style="height:30px;" class="gallerytr">
					<td><?php echo $i ; ?></td>
					
					<td>
					    <?php echo $records[$model]['name']; ?>
					</td>


					<td>
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
											echo $this->Html->link(__('Edit', true), array('plugin' => 'motor', 'controller' => 'motors', 'action' => 'edit', $records[$model]['id']), array('class' => '', 'escape' => false));
										?>
										
										</li>
										<li>
											<?php
											if ($records[$model]['status'] == 1) {
											?>	
												<a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactivate this Motor?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactivate.">Inactivate</a>
											<?php } else {
											?> 
												<a href='javascript:void(0)' onclick='return active("Are you sure you want to activate this Motor?", this);' id='active_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to activate.">Activate</a>	


											<?php }
											?>
										</li>
										<li>
										     <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this MotorType?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete.">Delete</a>					 
										</li>
									<!---	<li>
										 <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this Transportation Category?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='btn btn-transparent btn-xs' data-toggle="tooltip" data-placement="top" title="Click here to delete."><i class="fa fa-times fa fa-white"></i></a>
										
										</li> --->
										
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
