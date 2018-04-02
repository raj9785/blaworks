<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function () {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'city', 'action' => 'add')); ?>';
        });
        jQuery('a[id ^= delete_customer_]').click(function () {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "If you delete city, than associated airports, bookings, fares,transactions etc will also be deleted",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function () {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'delete')) ?>',
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
<?php
$status_change = 1;
if ($loggedin_user['user_role_id'] != 1) {
    $status_change = 0;
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
        <div class="main-content" >
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 class="mainTitle">Cities List</h1>
                        </div>  

                        <div class="col-sm-4 text-align-right">	
                            <button class="btn btn-green add-row" id='add_new_user'>
                                <i class="fa fa-plus"></i> Add New City 
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
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($city_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs" width="5%">S.No.</th>
                                        <th class="hidden-xs">State </th>
                                        <th class="hidden-xs" width="25%">City</th>
                                        <th class="hidden-xs">Code</th>                         
                                        <th class="hidden-xs">MMT City Code</th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Created On</th>
                                        <th class="hidden-xs">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($city_list)) {
                                        $count_new_bookings = $this->Paginator->counter(array('format' => '%count%'));
                                        if ($page == 0 || $page == 1) {
                                            $i = $count_new_bookings;
                                        } else {
                                            $i = $count_new_bookings - $limit * ($page - 1);
                                        }
                                        ?>
                                        <?php foreach ($city_list as $user) { ?>
                                            <tr>
                                                <td width="10%"><?php echo $i; ?></td>
                                                <td><?php echo $user['State']['name']; ?></td>
                                                <td><?php echo $user['City']['name']; ?></td>
                                                <td><?php echo $user['City']['city_code']; ?></td>
                                                <td><?php echo $user['City']['mmt_ct_code'] ? $user['City']['mmt_ct_code'] : 'N.A'; ?></td>

                                                <td> 
                                                    <?php
                                                    if ($user['City']['status'] == 'A') {
                                                        echo $this->Html->image('/img/active.png', array('border' => 0, 'width' => '20', 'alt' => 'Active', 'title' => 'Active'));
                                                    } else {
                                                        echo $this->Html->image('/img/inactive.png', array('border' => 0, 'width' => '20', 'alt' => 'Inactive', 'title' => 'Inactive'));
                                                    }
                                                    ?>


                                                </td>
                                                <td> <?php echo date(DATE_FORMAT, strtotime($user[$model]['created'])); ?></td>
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
                                                                echo $this->Html->link('Featured Destinations', array('plugin' => 'city', 'controller' => 'city', 'action' => 'super_destinations', 'id' => $user[$model]['id']), array('title' => 'Destinations List.', 'escape' => false, 'class' => ''));
                                                                ?>							
                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Advance Payment Required', array('plugin' => false, 'controller' => 'city', 'action' => 'advance_payment', '?' => array('id' => $user['City']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Advance Payment Required', 'escape' => false));
                                                                ?>

                                                            </li>
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Edit', array('plugin' => false, 'controller' => 'city', 'action' => 'edit', '?' => array('id' => $user['City']['id'])), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                                ?>
                                                            </li>
                                                            <?php
                                                            if ($status_change == 1) {
                                                                ?>
                                                                <li>
                                                                    <?php
                                                                    if ($user['City']['status'] == 'A') {
                                                                        echo $this->Html->link('Inactivate', array('plugin' => 'city', 'controller' => 'city', 'action' => 'status', 'id' => $user['City']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                                    } else {
                                                                        echo $this->Html->link('Activate', array('plugin' => 'city', 'controller' => 'city', 'action' => 'status', 'id' => $user['City']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                                    }
                                                                    ?>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <?php
                                                                echo $this->Html->link('Garage', array('plugin' => false, 'controller' => 'garages', 'action' => 'index', 'id' => $user['City']['id']), array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Add Garage', 'escape' => false));
                                                                ?>
                                                            </li>
                                                            <!--                                                    <li>
                                                            <?php
                                                            //echo $this->Html->link('Delete', 'javascript:void(0)', array('class' => '', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['City']['id'], 'escape' => false));
                                                            ?>
                                                                                                                </li>-->


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
                                    <?php } else {
                                        ?>
                                        <tr>
                                            <td colspan="9">No city exists.</td>
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
