<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
	UINotifications.init();
	//TableData.init();
	jQuery("#add_new_user").click(function() {
	    window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'add')); ?>';
	});
	jQuery('a[id ^= delete_customer_]').click(function() {
	    var thisID = $(this).attr('id');
	    var breakID = thisID.split('_');
	    var record_id = breakID[2];
	    swal({
		title: "Are you sure?",
		text: "Term will be deleted permanently",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#DD6B55',
		confirmButtonText: 'Yes, delete it!',
		closeOnConfirm: false,
	    },
		    function() {
			$.ajax({
			    type: 'get',
			    url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'term_uses', 'action' => 'delete')) ?>',
			    data: 'id=' + record_id,
			    dataType: 'json',
			    success: function(data) {
				if (data.succ == '1') {
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
	});
    });
</script>
<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>

    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
	<?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Terms of Use List</h1>                            
                        </div>      
			<div class="col-sm-4 text-align-right">		
			    <button class="btn btn-green add-row" id='add_new_user'>
                                <i class="fa fa-plus"></i> Add New Terms of Use 
                            </button>
			</div>

                    </div>
                </section>
		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <!--<div class="row">
                        <div class="col-md-12 space20">
			    
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
					<th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs">Title </th>
                                        <th class="hidden-xs" width="35%">Content </th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Created On</th>
					<th class="hidden-xs">Last Modified By</th>
					<th class="hidden-xs">Last Modified On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
				    <?php
				    if (!empty($users_list)) {
					$i = 1;
					?>
					<?php foreach ($users_list as $user) { ?>  
					    <tr>
						<td><?php echo $i; ?></td>
						<td><?php echo $user['TermUse']['title']; ?></td>
						<td><?php echo ((strlen($user['TermUse']['content']) > 150) ? substr($user['TermUse']['content'], 0, 150) . '...' : $user['TermUse']['content']); ?></td>
						<td> <?php
                                                    if ($user['TermUse']['status'] == 'A') {
                                                        echo $this->Html->image('/img/active.png', array('border' => 0,'width'=>'20', 'alt' => 'Active', 'title' => 'Active'));
                                                    } else {
                                                        echo $this->Html->image('/img/inactive.png', array('border' => 0,'width'=>'20', 'alt' => 'Inactive', 'title' => 'Inactive'));
                                                    }
                                                    ?>
						</td>
						<td> <?php echo date(DATE_FORMAT, strtotime($user['TermUse']['created'])); ?></td>


						<td><?php echo $user["TermUse"]['modified_by'] ? $user["TermUse"]['modified_by'] : "---"; ?></td>

						<td> <?php echo date(DATE_FORMAT, strtotime($user['TermUse']['modified'])); ?></td>


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
								echo $this->Html->link('Edit', array('plugin' => false, 'controller' => 'term_uses', 'action' => 'edit', '?' => array('id' => $user['TermUse']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
								?>							
							    </li>
							    <li>
								<?php
								if ($user['TermUse']['status'] == 'A') {
								    echo $this->Html->link('Inactivate', array('controller' => 'term_uses', 'action' => 'status', 'id' => $user['TermUse']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
								} else {
								    echo $this->Html->link('Activate', array('controller' => 'term_uses', 'action' => 'status', 'id' => $user['TermUse']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
								}
								?>
							    </li>
							    <li>
								<?php
								echo $this->Html->link('Delete', 'javascript:void(0)', array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['TermUse']['id'], 'escape' => false));
								?>
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
    					<td colspan="20"><?php echo $this->element('pagination'); ?></td>
    				    </tr>
				    <?php } else {
					?>
    				    <tr>
    					<td colspan="9">No term of use here.</td>
    				    </tr>
				    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>
