<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function() {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'super_specials', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function() {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Super Special will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function() {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'super_specials', 'action' => 'delete')) ?>',
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
                            <h1 class="mainTitle">Super Specials List</h1>                            
                        </div>                        
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <!--<button class="btn btn-green add-row" id='add_new_user'>
                                Add Super Special <i class="fa fa-plus"></i>
                            </button>-->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
										<th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs">Title </th>
                                        <th class="hidden-xs" width="35%">Content </th>
                                        <th class="hidden-xs">Created On</th>
										<th class="hidden-xs">Last Modified By</th>
										<th class="hidden-xs">Last Modifed On</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users_list)) { $i=1; ?>
                                        <?php foreach ($users_list as $user) { ?>  
                                            <tr>
												<td><?php echo $i; ?></td>
                                                <td><?php echo $user['SuperSpecial']['title']; ?></td>
                                                <td><?php echo ((strlen($user['SuperSpecial']['content']) > 150) ? substr($user['SuperSpecial']['content'], 0, 150) . '...' : $user['SuperSpecial']['content']); ?></td>
                                                <td><?php echo date(DATE_FORMAT,strtotime($user['SuperSpecial']['created'])); ?></td>
												
												  <td> --- </td>
												
												  <td> <?php echo date(DATE_FORMAT,strtotime($user['SuperSpecial']['modified'])); ?></td>
												
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
											  echo $this->Html->link('Edit', array('plugin' => false, 'controller' => 'super_specials', 'action' => 'edit', '?' => array('id' => $user['SuperSpecial']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));       
									?>							
									</li>
									
						   
						  </ul>
				    </div>
                                                        <?php
                                                      
                                                        //echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)', array('class' => 'btn btn-transparent btn-xs tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['SuperSpecial']['id'], 'escape' => false));
                                                        ?>
                                                   
                                                </td>
                                            </tr>
                                            <?php   $i++;
                                        }  ?>
											<tr>
												<td colspan="20"><?php echo $this->element('pagination'); ?></td>
											</tr>
										
                                    <?php } else {
                                        ?>
                                        <tr>
                                            <td colspan="9">No super specials here.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <ul class="pagination" style="float: right;">
                                <li><?php echo $this->Paginator->prev('&laquo;', array('escape' => false), null, array('class' => 'previous disabled prv previous', 'escape' => false)); ?></li>
                                <li><?php echo $this->Paginator->numbers(array('separator' => '', 'currentClass' => 'active', 'currentTag' => 'a', 'escape' => false)); ?></li>
                                <li><?php echo $this->Paginator->next('&raquo;', array('escape' => false), null, array('class' => 'number-end disabled nxt number-end', 'escape' => false)); ?></li>
                            </ul>
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
