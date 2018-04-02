<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Testimonial will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'testimonials', 'action' => 'delete')) ?>',
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
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Testimonials List</h1>                            
                        </div>       

                        <div class="col-sm-4 text-align-right">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                <i class="fa fa-plus"></i> Add New Testimonial 
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
                                        <th class="hidden-xs">Image</th>
                                        <th class="hidden-xs">Name </th>
                                        <th class="hidden-xs" width="25%">Testimonial </th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Created On</th>
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
                                                <td width="10%">
                                                    <?php if (isset($user['Testimonial']['icon_image']) && file_exists(WEBSITE_ADMIN_WEBROOT_ROOT_PATH . '/webroot/uploads/testimonials/icon_image/' . $user['Testimonial']['icon_image'])) { ?>
                                                        <?php echo $this->Html->image(WEBSITE_URL . '/admin/webroot/uploads/testimonials/icon_image/' . $user['Testimonial']['icon_image'], array('border' => 0)); ?>
                                                    <?php } else { ?>
                                                        <?php echo $this->Html->image(WEBSITE_URL . '/admin/webroot/img/no_image.jpg', array('border' => 0, 'width' => '75')); ?>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $user['Testimonial']['name']; ?></td>
                                                <td><?php echo ((strlen($user['Testimonial']['testimonial']) > 150) ? substr($user['Testimonial']['testimonial'], 0, 150) . '...' : $user['Testimonial']['testimonial']); ?></td>
                                                <td> 
                                                    
                                                    <?php
                                                    if ($user['Testimonial']['status'] == 'A') {
                                                        echo $this->Html->image('/img/active.png', array('border' => 0,'width'=>'20', 'alt' => 'Active', 'title' => 'Active'));
                                                    } else {
                                                        echo $this->Html->image('/img/inactive.png', array('border' => 0,'width'=>'20', 'alt' => 'Inactive', 'title' => 'Inactive'));
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                <td><?php echo date(DATE_FORMAT, strtotime($user['Testimonial']['created'])); ?></td>
                                                <td>
                                                    <div class="dropdown" style='float:left'>
                                                        <a class="btn btn-info dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="javascript:void(0)" style='text-decoration:none'>
                                                            <?php echo __('Action'); ?> <span class="caret"></span>
                                                        </a>
                                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel" style="left:-82px;">                                                          
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Edit', array('plugin' => false, 'controller' => 'testimonials', 'action' => 'edit', '?' => array('id' => $user['Testimonial']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                ?>
                                                            </li>

                                                            <li>
                                                                <?php
                                                                if ($user['Testimonial']['status'] == 'A') {
                                                                    echo $this->Html->link('Inactivate', array('controller' => 'testimonials', 'action' => 'status', 'id' => $user['Testimonial']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                                } else {
                                                                    echo $this->Html->link('Activate', array('controller' => 'testimonials', 'action' => 'status', 'id' => $user['Testimonial']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                                }
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Delete', 'javascript:void(0)', array('class' => 'tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Testimonial']['id'], 'escape' => false));
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
                                            <td  colspan="10"><?php echo $this->element('pagination'); ?></td>
                                        </tr> 
                                    <?php } else {
                                        ?>
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
