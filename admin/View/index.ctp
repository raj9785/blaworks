<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css','jquery.datetimepicker'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js','jquery.datetimepicker'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function() {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'coupons', 'action' => 'add')); ?>';
        });
        $('#from_date').datetimepicker({
            maxDate: 0,
            format: 'dd-mm-yy',
            showOn: 'button',
            buttonImage: '<?php echo $this->Html->url('/img/calendar.gif', array('fullBase' => true)); ?>',
            timepicker: false
            
        });
        $('#to_date').datetimepicker({
            showOn: 'button',
            minDate: 0,
            format: 'dd-mm-yy',
            buttonImage: '<?php echo $this->Html->url('/img/calendar.gif', array('fullBase' => true)); ?>',
            timepicker: false,
            onClose: function(selectedDate) {
                $('#from_date').datetimepicker('option', 'minDate', selectedDate);
            }
        });
        jQuery('a[id ^= delete_customer_]').click(function() {
            var thisID = $(this).attr('id');
            var breakID = thisID.split('_');
            var record_id = breakID[2];
            swal({
                title: "Are you sure?",
                text: "Coupon will be deleted permanently",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes, delete it!',
                closeOnConfirm: false,
            },
                    function() {
                        $.ajax({
                            type: 'get',
                            url: '<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'coupons', 'action' => 'delete')) ?>',
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
                            <h1 class="mainTitle">Promo Codes List</h1>                            
                        </div>                        
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <div class="row">
                        <div class="col-md-12 space20">
                            <button class="btn btn-green add-row" id='add_new_user'>
                                Add Promo Code <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 space20">
                            <div class="pull-left1 driver_index1">
                                <?php
                                echo $this->Form->create('Coupon', array('class' => 'form-inline filterform', 'inputDefaults' => array('label' => false, 'div' => false)));
                                echo $this->Form->text('Coupon.coupon_code', array('placeholder' => __('Promo Code', true), 'class' => ' form-control input-sm')) . '&nbsp;';
                                echo $this->Form->select('Coupon.fare_category_id',$fare_category_list, array('class' => ' form-control input-sm','empty' => 'Select Fare Category')) . '&nbsp;';
                                ?>
                                <?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary', 'escape' => false,'name' => 'button','value' => 'Search')); ?>
                                <?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Reset", true), array('class' => 'btn btn-primary', 'escape' => false,'name' => 'button','value' => 'Reset')); ?>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">Fare Category</th>
                                        <th class="hidden-xs">Cab Type </th>
                                        <th class="hidden-xs">Coupon Code </th>
                                        <th class="hidden-xs">Country</th>
                                        <th class="hidden-xs">State</th>
                                        <th class="hidden-xs">City</th>
                                        <th class="hidden-xs">Discount</th>
                                        <th class="hidden-xs">No of Uses</th>
                                        <th class="hidden-xs">Status</th>
                                        <th class="hidden-xs">Created On</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users_list)) { ?>
                                        <?php foreach ($users_list as $user) { ?>  
                                            <tr>
                                                <td width="10%"><?php echo $user['Farecategory']['name']; ?></td>
                                                <td><?php echo $user['MotorType']['name']; ?></td>
                                                <td><?php echo $user['Coupon']['coupon_code']; ?></td>
                                                <td><?php echo $user['Country']['name']; ?></td>
                                                <td><?php echo $user['State']['name']; ?></td>
                                                <td><?php echo $user['City']['name']; ?></td>
						
						  <td  ><?php 
				    if($user['Coupon']['type']==1){
				       echo $user['Coupon']['discount']."%";
				    }else{
					echo '<i class="fa fa-rupee"></i>'.$user['Coupon']['discount'];
				    }
				    ?></td>
                                               
                                                <td><?php echo $user['Coupon']['total_uses']; ?></td>
                                                <td> <?php
                                                    if ($user['Coupon']['status'] == 'A') {
                                                        echo $this->Html->image('/img/test-pass-icon.png', array('border' => 0, 'alt' => 'activated', 'title' => 'activated'));
                                                    } else {
                                                        echo $this->Html->image('/img/cross.png', array('border' => 0, 'alt' => 'activated', 'title' => 'deactivated'));
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo date("d-m-Y h:i A",strtotime($user['Coupon']['created'])); ?></td>
                                                <td>
                                                    <?php
                                                    if ($user['Coupon']['status'] == 'A') {
                                                        echo $this->Html->link('Inactivate', array('controller' => 'coupons', 'action' => 'status', 'id' => $user['Coupon']['id'], 'status' => 'D'), array('title' => 'Click here to inactivate.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to inactivate.'));
                                                    } else {
                                                        echo $this->Html->link('Activate', array('controller' => 'coupons', 'action' => 'status', 'id' => $user['Coupon']['id'], 'status' => 'A'), array('title' => 'Click here to activate.', 'escape' => false, 'class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Click here to activate.'));
                                                    }

                                                    echo $this->Html->link('<i class="fa fa-pencil"></i>', array('plugin' => false, 'controller' => 'coupons', 'action' => 'edit', '?' => array('id' => $user['Coupon']['id'])), array('class' => 'btn btn-transparent btn-xs', 'tooltip-placement' => 'top', 'tooltip' => 'Edit', 'escape' => false));
                                                    echo $this->Html->link('<i class="fa fa-times fa fa-white"></i>', 'javascript:void(0)', array('class' => 'btn btn-transparent btn-xs tooltips', 'tooltip-placement' => 'top', 'tooltip' => 'Remove', 'id' => 'delete_customer_' . $user['Coupon']['id'], 'escape' => false));
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="11">No promo code exists.</td>
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
