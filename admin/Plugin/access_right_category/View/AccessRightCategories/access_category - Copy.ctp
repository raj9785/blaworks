<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type='text/javascript'>
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
			url: '<?php echo $this->Html->url(array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'deleterow')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'change_status_active')); ?>',
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
			url: '<?php echo $this->Html->url(array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'change_status_inactive')); ?>',
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
                            <h1 class="mainTitle">Access Right User Management </h1>
                        </div>
                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left"><?php //echo $this->element('paging_info'); ?></div>
			    <div class="pull-right">
				<?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add New User', true) . "", array('plugin' => "access_right_user", 'controller' => 'access_right_users', "action" => "add"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			    </div>
			</div>
			
			 <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                echo $this->Form->create($model, array('type' => 'get','class' => 'form-inline filterform', 'inputDefaults' => array('label' => false, 'div' => false)));
                              						
								echo $this->Form->text('user_name', array('placeholder' => __('User Name', true),'value'=>isset($name)?$name:'', 'class' => ' form-control input-sm')) . '&nbsp;';										
								echo $this->Form->text('name', array('placeholder' => __('Category Name', true),'value'=>isset($name)?$name:'', 'class' => ' form-control input-sm')) . '&nbsp;';	
								
                                echo $this->Form->text('AccessRightCategory.from_date', array('placeholder' => __('From Date', true),'value'=>isset($from_date)?$from_date:'', 'class' => ' form-control input-sm')) . '&nbsp;';
                                echo $this->Form->text('AccessRightCategory.to_date', array('placeholder' => __('To Date', true),'value'=>isset($to_date)?$to_date:'', 'class' => ' form-control input-sm')) . '&nbsp;';
							   ?>
                                <?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false,'name' => 'button','value' => 'Search')); ?>
                                &nbsp;&nbsp;<a class="btn btn-green add-row" href="<?php echo $this->Html->url(array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'index')); ?>">Reset</a>

								<?php echo $this->Form->end(); ?>
                            </div>                       
            </div>
			
		    </div>
                    
		    <div class="clear"></div>
		   
		    <table class="table table-striped table-bordered table-hover table-full-width" id="<?php echo (!empty($result)) ? 'id="sample_1"' : '' ?>">
			<thead>
			    <tr style="height:30px;">
				<th class="hidden-xs">S.No</th>
				<th class="hidden-xs">User Name</th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('AccessRightCategory.name', __('Category Name', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo $this->Paginator->sort('AccessRightCategory.created', __('Created', true), array('char' => true)); ?></th>
				<th class="hidden-xs"><?php echo __('Action'); ?></th>
			    </tr>
			</thead>
			<tbody >
			    <?php
			    if (!empty($result)) {
				$i = 1;
				foreach ($result as $records) {
				    ?>
				    <tr style="height:30px;" class="gallerytr">
					<td><?php echo $i; ?></td>
					<td>&nbsp;</td>
					<td><?php echo $records['AccessRightCategory']['name']; ?></td>
					<td>
						<?php  echo date(DATE_FORMAT,$records[$model]['created']); 
						      					  	
						?>
					</td>
					<?php /* ?>
					<td>
					<?php
							if($records[$model]['status'] == 1){
								echo $this->Html->link('Create User & Permission' . __('', true), array('plugin' => 'access_right_user', 'controller' => 'access_right_users', 'action' => 'index', $records[$model]['id']), array('class' => '', 'escape' => false));
							}else{ 
								echo 'Please activate this catefory first to create users & assign permissions';
							}
					    ?>
					</td>
					<?php */ ?>
					
					<td>
													<div class="dropdown" style='float:left'>
														<a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
																<?php echo __('Action'); ?> <span class="caret"></span>
														</a>
														<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="left:-82px;">                                                                                                    
															<li>
																<?php
																echo $this->Html->link('View User Rights' . __('', true), array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'access_category', $records[$model]['id']), array('class' => '', 'escape' => false));
																?>
															</li>
															
															<li>
																<?php
																echo $this->Html->link('Edit User Rights' . __('', true), array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'access_category', $records[$model]['id']), array('class' => '', 'escape' => false));
																?>
															</li>
															
															
															<li>
																<?php
																	if($records[$model]['status'] == 1){
																		echo $this->Html->link('Create User & Permission' . __('', true), array('plugin' => 'access_right_user', 'controller' => 'access_right_users', 'action' => 'index', $records[$model]['id']), array('class' => '', 'escape' => false));
																	}else{ 
																		echo 'Please activate this catefory first to create users & assign permissions';
																	}
																?>
															</li>
															<li>
																<?php
																	if ($records[$model]['status'] == 1) {
																	?>	
																		<a href='javascript:void(0)' onclick='return inactive("Are you sure you want to inactivate this Category?", this);' id='inactive_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to inactivate.">Inactivate User</a>
																	<?php } else { ?> 
																		<a href='javascript:void(0)' onclick='return active("Are you sure you want to activate this Category?", this);' id='active_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to activate.">Activate User</a>	
																<?php } ?>
																
																

															</li>
															
															<li>
																  <a href='javascript:void(0)' onclick='return deletediv("Are you sure you want to delete this Category?", this);' id='delete_<?php echo $records[$model]['id']; ?>' class='' data-toggle="tooltip" data-placement="top" title="Click here to delete.">Delete User</a>
					
					
					
					
															</li>
														</ul>
													</div>
					
					</td>
					
				    </tr>
				    <?php
				    $i++;
				}
				?>

    			    <tr>
    				<td colspan="20">
					<?php 
					echo $this->element('pagination'); 										
					?>
					
					</td>
    			    </tr>
				<?php
			    } else {
				?>
    			    <tr>
    				<td align="center" style="text-align:center;" colspan="20" class="">
					<?php echo __('No Result Found'); ?>

					</td>
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
		};
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
