<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery("#AccessRightUserAddForm").validationEngine();

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
        <div class="main-content">
            <div class="wrap-content container" id="container">
                <section id="page-title">
                    <div class="row">
                        <div class="col-sm-10">
                            <h1 class="mainTitle">Add New User</h1>
                        </div>
                        <div class="col-md-2">
                            <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index", $cate_id), array("class" => "btn btn-green add-row", "escape" => false)); ?>
                        </div>
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                    <?php
                    echo $this->Form->create($model, array('url' => array('plugin' => 'access_right_user', 'controller' => 'access_right_users', 'action' => 'add'), 'enctype' => 'multipart/form-data'));
                    echo $this->Form->hidden($model . '.access_right_category_id', array('value' => $cate_id));
                    ?>
                    <div class="row">
                        <div class="col-md-12">
                         <div class="row" style="">
                                <div class="row" style="">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.access_right_category_id', __('Access Right Category', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('access_right_category_id')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->select($model . '.access_right_category_id', array($access_right_category), array('type' => 'select', "class" => "form-control  validate[required]", 'empty' => 'Select Categories', 'label' => false)); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.access_right_category_id', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>





                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.firstname', __('Employee Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('firstname')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.firstname', array("class" => "form-control textbox validate[required]")); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.firstname', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.email', __('Email', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('email')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.email', array("class" => "form-control textbox validate[custom[email],required]")); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.email', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.customer_refund', __('Customer Refunds Access', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('customer_refund')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.customer_refund', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.customer_refund', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.update_customer_invoice', __('Edit Invoice', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('update_customer_invoice')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.update_customer_invoice', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.update_customer_invoice', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.driver_verification', __('Driver Verification', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('driver_verification')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.driver_verification', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.driver_verification', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.offline_payment_add', __('Add Vendor Offline Payment', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('offline_payment_add')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.offline_payment_add', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.offline_payment_add', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_trip_advance', __('Add Customer Trip Advance', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_trip_advance')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_trip_advance', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_trip_advance', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_trip_advance_vendor', __('Pay Vendor Trip Advance', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_trip_advance_vendor')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_trip_advance_vendor', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_trip_advance_vendor', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.edit_cust_fare', __('Edit Rate', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('edit_cust_fare')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.edit_cust_fare', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.edit_cust_fare', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>





                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.post_booking_comments', __('Company Cancelled Booking Comments', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('post_booking_comments')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.post_booking_comments', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.post_booking_comments', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.blog_content_approval', __('Blog Content Writer Approval', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('blog_content_approval')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.blog_content_approval', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.blog_content_approval', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.move_cs', __('Move to Customer Cancel', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('move_cs')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.move_cs', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.move_cs', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_vendor', __('Add Vendor', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_vendor')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_vendor', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_vendor', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.edit_vendor', __('Edit Vendor', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('edit_vendor')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.edit_vendor', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.edit_vendor', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.edit_vehicle', __('Edit Vehicle', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('edit_vehicle')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.edit_vehicle', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.edit_vehicle', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_driver', __('Add Driver', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_driver')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_driver', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_driver', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.pair_booking_status', __('Vendor/DCO Pair Booking Selection', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('pair_booking_status')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.pair_booking_status', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.pair_booking_status', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


										<div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.forced_release', __('Forced Release', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('forced_release')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.forced_release', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.forced_release', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>





                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.employee_id', __('Employee ID', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('employee_id')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.employee_id', array("class" => "form-control textbox validate[required]")); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.employee_id', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.username', __('Username', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('username')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->text($model . '.username', array("class" => "form-control textbox validate[required]")); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.username', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.mobile', __('Mobile', true) . ' :<span class="symbol required"></span>', array('style' => ""));
                                            ?>

                                            <div class="input" style="" >
                                                <?php echo $this->Form->text($model . '.mobile', array("class" => "form-control textbox validate[required]", "maxlength" => '10')); ?>
                                                <span class="help-inline" style="color: #B94A48;">

                                                    <?php echo $this->Form->error($model . '.mobile', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.vendor_receipts', __('Vendor Payment Access', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('vendor_receipts')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.vendor_receipts', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.vendor_receipts', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.vehicle_verification', __('Vehicle Verification', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('vehicle_verification')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.vehicle_verification', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.vehicle_verification', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.assign_booking', __('Assign Booking', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('assign_booking')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.assign_booking', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.assign_booking', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.offlinepayment_verification', __('Vendor Offline Payment Verification', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('offlinepayment_verification')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.offlinepayment_verification', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.offlinepayment_verification', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.trip_advance_verification', __('Customer Trip Advance Verification', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('trip_advance_verification')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.trip_advance_verification', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.trip_advance_verification', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_cust_fare', __('Add Rate', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_cust_fare')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_cust_fare', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_cust_fare', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.status_cust_fare', __('Vehicle Unavailable & Available,Stop & Start One Way Return', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('status_cust_fare')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.status_cust_fare', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.status_cust_fare', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <!--                                    <div class="form-group">
                                        <?php
                                        //echo $this->Form->label($model . '.status_vend_fare', __('Change Status of Vendor Fare', true) . ' :', array('style' => ""));
                                        ?>
                                                                                
                                                                                <div class="input <?php //echo ($this->Form->error('status_vend_fare')) ? 'error' : '';      ?>" style="" >
                                        <?php //echo $this->Form->checkbox($model . '.status_vend_fare', array('value'=>1,"class" => "textbox"));  ?>
                                                                                    <span class="help-inline" style="color: #B94A48;">
                                        <?php //echo $this->Form->error($model . '.status_vend_fare', array('wrap' => false,'hiddenField' => false));  ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>-->


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.edit_booking', __('Reschedule Booking', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('edit_booking')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.edit_booking', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.edit_booking', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.blog_seo_approval', __('Blog SEO Approval', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('blog_seo_approval')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.blog_seo_approval', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.blog_seo_approval', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.web_enquiry_access', __('Web Enquiry Access', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('web_enquiry_access')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.web_enquiry_access', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.web_enquiry_access', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.ex_payment', __('Excess Payment In Vendor Invoice', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('ex_payment')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.ex_payment', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.ex_payment', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.edit_driver', __('Edit Driver', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('edit_driver')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.edit_driver', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.edit_driver', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>



                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.add_vehicle', __('Add Vehicle', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('add_vehicle')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.add_vehicle', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.add_vehicle', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.pair_booking', __('Make Pair Booking', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('pair_booking')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.pair_booking', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.pair_booking', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <?php
                                            echo $this->Form->label($model . '.can_hold_payment', __('Can Hold Vendor Payment', true) . ' :', array('style' => ""));
                                            ?>

                                            <div class="input <?php echo ($this->Form->error('can_hold_payment')) ? 'error' : ''; ?>" style="" >
                                                <?php echo $this->Form->checkbox($model . '.can_hold_payment', array('value' => 1, "class" => "textbox")); ?>
                                                <span class="help-inline" style="color: #B94A48;">
                                                    <?php echo $this->Form->error($model . '.can_hold_payment', array('wrap' => false, 'hiddenField' => false)); ?>
                                                </span>
                                            </div>
                                        </div>




                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div>
                                        <span class="symbol required"></span>Required Fields
                                        <hr>
                                    </div>
                                </div>
                            </div>




                            <div class="row">
                                <div class="col-md-8">
                                </div>
                                <div class="col-md-4">
                                    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
                                    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index", $cate_id), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false, 'hiddenField' => false)); ?>
                                </div>
                            </div>



                        </div>
                    </div>

                    <?php echo $this->Form->end(); ?>

                </div>
            </div>

        </div>
    </div>
    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->
</div>

