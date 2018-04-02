<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js','sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function() {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'country', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function() {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "If you delete country, than associated states,cities, airports,bookings,fares,transactions etc will also be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function() {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => 'country', 'controller' => 'country', 'action' => 'delete')) ?>',
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
                            <h1 class="mainTitle">Countries List</h1>
                        </div>  
						<div class="col-sm-4 text-align-right">
							<button class="btn btn-green add-row" id='add_new_user'>
                              <i class="fa fa-plus"></i>&nbsp;Add New Country
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
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($country_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs" width="25%">Name</th>
                                        <th class="hidden-xs">Code </th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Created On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($country_list)) { ?>
                                    <?php $counter = 1; ?>
                                        <?php foreach ($country_list as $user) { ?>
                                            <tr>
                                                <td width="10%"><?php echo $counter; ?></td>
                                                <td width="10%"><?php echo $user['Country']['name']; ?></td>
                                                <td><?php echo $user['Country']['iso3166_1']; ?></td>
                                                <td> 
                                                    <?php
                                                    if ($user['Country']['status'] == 'A') {
                                                        echo $this->Html->image('/img/active.png', array('border' => 0,'width'=>'20', 'alt' => 'Active', 'title' => 'Active'));
                                                    } else {
                                                        echo $this->Html->image('/img/inactive.png', array('border' => 0,'width'=>'20', 'alt' => 'Inactive', 'title' => 'Inactive'));
                                                    }
                                                    ?>
                                                    
                                                    
                                                </td>
                                                <td> <?php echo date(DATE_FORMAT,strtotime($user[$model]['created'])); ?></td>
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
								 echo $this->Html->link('Edit', array('plugin' => false, 'controller' => 'country', 'action' => 'edit', '?' => array('id' => $user['Country']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
							?>							
						    </li>
							<li>
							 <?php
								 if ($user['Country']['status'] == 'A') {
                                                            echo $this->Html->link('Inactivate', array('plugin' => 'country','controller' => 'country', 'action' => 'status', 'id' => $user['Country']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                        } else {
                                                            echo $this->Html->link('Activate', array('plugin' => 'country','controller' => 'country', 'action' => 'status', 'id' => $user['Country']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                        }
								?>
							</li>
							 <li>
							       <?php
                                                       
                                                       
                                                        echo $this->Html->link('Delete', 'javascript:void(0)', array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Country']['id'], 'escape' => false));
                                                        ?>
							 </li>
						   
						</ul>
				   </div>
													
													
                                                </td>
                                            </tr>
                                            <?php  $counter++; } ?>
											<tr>
												<td colspan="20"><?php echo $this->element('pagination'); ?></td>
											</tr>
										<?php    } else {   ?>
                                        <tr>
                                            <td colspan="9">No Record Found</td>
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
