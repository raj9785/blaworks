<?php
echo $this->Html->css(array('validationEngine.jquery'));
echo $this->Html->script(array('jquery.validationEngine-en', 'jquery.validationEngine'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery("#AccessRightCategoryEditForm").validationEngine();

        jQuery('.pcheckbox').on('click', function() {
            var gettitleval = jQuery(this).attr('title');
            //alert(gettitleval);
            if ($(this).is(':checked')) {
                $('.' + gettitleval).prop('checked', true)
            } else {
                $('.' + gettitleval).prop('checked', false)

            }
        })

        jQuery('.desccheckbox').on('click', function() {
            var checkedclass = $(this).attr('class').replace('desccheckbox', '');
            if ($(this).is(':checked')) {
                $('.check' + checkedclass).prop('checked', true)
            } else {
                var count = 0;
                $('.' + checkedclass).each(function() {
                    if ($(this).is(':checked')) {
                        count++;
                    }

                });
                if (count) {
                    $('.check' + checkedclass).prop('checked', true);
                } else {

                    $('.check' + checkedclass).prop('checked', false);
                }


            }
        })

        jQuery('.desccheckbox').each(function() {
            var checkedclass = $(this).attr('class').replace('desccheckbox', '');
            if ($(this).is(':checked')) {
                $('.check' + checkedclass).prop('checked', true)
            } else {
                var count = 0;
                $('.' + checkedclass).each(function() {
                    if ($(this).is(':checked')) {
                        count++;
                    }

                });
                if (count) {
                    $('.check' + checkedclass).prop('checked', true);
                } else {

                    $('.check' + checkedclass).prop('checked', false);
                }
            }
        })

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
			    <h1 class="mainTitle">Edit Category</h1>
			</div>
			<div class="col-md-2">
			    <?php echo $this->Html->link("<i class=\"icon-arrow-left icon-white\"></i>" . __('Back to List', true) . "", array("action" => "index"), array("class" => "btn btn-green add-row", "escape" => false)); ?>
			</div>
		    </div>
		</section>
		<?php echo $this->Session->flash(); ?>
		<div class="container-fluid container-fullw bg-white">
		    <?php
		    echo $this->Form->create($model, array('url' => array('plugin' => 'access_right_category', 'controller' => 'access_right_categories', 'action' => 'edit',$id), 'enctype' => 'multipart/form-data'));
		    ?>
		    <div class="row">
			<div class="col-md-12">

			    <div class="row" style="">
				<div class="col-md-6">


				    <div class="form-group <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>">
					<?php
					echo $this->Form->label($model . '.name', __('Category Name', true) . ' :<span class="symbol required"></span>', array('style' => ""));
					?>
					<div class="input <?php echo ($this->Form->error('name')) ? 'error' : ''; ?>" style="" >
					    <?php echo $this->Form->text($model.'.name', array("class" => "form-control textbox validate[required]")); ?>
					    <span class="help-inline" style="color: #B94A48;">
						<?php echo $this->Form->error($model . '.name', array('wrap' => false)); ?>
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
                                <div class="col-md-12">
                                    <div>
                                        <span class='access_title'><u>Access Permission</u></span><br/><br/>

                                    </div>
                                </div>
                            </div>
                            <table class="table">
                                <tr>
                                    <td style='width:20%'>
                                        <table class="table">
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink' title='booking'>Bookings</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkbooking', array('class' => 'checkbooking pcheckbox', 'title' => 'booking', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                    </span>
                                                </td>
                                            </tr>	 	
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='finance'>Finance</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkfinance', array('class' => 'checkfinance pcheckbox', 'title' => 'finance', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>

                                                    </span>

                                                </td>
                                            </tr>	
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink' title='customer'>Customers</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkcustomer', array('class' => 'checkcustomer pcheckbox', 'title' => 'customer', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                    </span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='partner'>Partners</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkpartner', array('class' => 'checkpartner pcheckbox', 'title' => 'partner', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>

                                                    </span>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);"  class='clicklink'  title='vehicle'>Vehicles</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkvehicle', array('class' => 'checkvehicle pcheckbox', 'title' => 'vehicle', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>


                                                    </span>

                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='location'>Locations</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checklocation', array('class' => 'checklocation pcheckbox', 'title' => 'location', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);"  class='clicklink'  title='destination'>Destinations</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkdestination', array('class' => 'checkdestination pcheckbox', 'title' => 'destination', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);"  class='clicklink'  title='rate'>Rates</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkrate', array('class' => 'checkrate pcheckbox', 'title' => 'rate', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>


                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='promotioncode'>Promotional Codes</a>
                                                    <span style='float:right'>
                                                        <?php echo $this->Form->checkbox($model . '.checkpromotioncode', array('class' => 'checkpromotioncode pcheckbox', 'title' => 'promotioncode', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>


                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink' title='feedbackrating'>Feedback & Ratings</a>
                                                    <span style='float:right'>

                                                        <?php echo $this->Form->checkbox($model . '.checkfeedbackrating', array('class' => 'checkfeedbackrating pcheckbox', 'title' => 'feedbackrating', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>


                                                    </span>
                                                </td>
                                            </tr>
                                            
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='testimonial'>Testimonials</a>
                                                    <span style='float:right'>

                                                        <?php echo $this->Form->checkbox($model . '.checkfield', array('class' => 'checktestimonial pcheckbox', 'title' => 'testimonial', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>


                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><a href="javascript:void(0);" class='clicklink'  title='webcontent'>Website Content</a>
                                                    <span style='float:right'>

                                                        <?php echo $this->Form->checkbox($model . '.checkwebcontent', array('class' => 'checkwebcontent pcheckbox', 'title' => 'webcontent', 'legend' => false, 'label' => false, 'hiddenField' => false)); ?>

                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>	
                                    <td style='vertical-align:top'>
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.booking', array('value' => 1, 'class' => 'booking desccheckbox', 'hiddenField' => false)) . ' <b>Bookings</b>' . '&nbsp;';
                                                    //echo $this->Form->checkbox($model . '.cancelled_booking', array('value' => 1, 'class' => 'booking desccheckbox', 'hiddenField' => false)) . ' <b> Cancelled Bookings</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.customer_invoice', array('value' => 1, 'class' => 'finance desccheckbox', 'hiddenField' => false)) . ' <b>Customer Invoices</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.receipts', array('value' => 1, 'class' => 'finance desccheckbox', 'hiddenField' => false)) . ' <b>Receipts</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.refund_management', array('value' => 1, 'class' => 'finance desccheckbox', 'hiddenField' => false)) . ' <b>Refunds</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.vendor_invoice', array('value' => 1, 'class' => 'finance desccheckbox', 'hiddenField' => false)) . ' <b>Vendor Invoices</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.vendor_payment', array('value' => 1, 'class' => 'finance desccheckbox', 'hiddenField' => false)) . ' <b>Vendor Payments</b>' . '&nbsp;';
													
													
                                                    ?>
                                                </td>
                                            </tr>	 	

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.customer', array('value' => 1, 'class' => 'customer desccheckbox', 'hiddenField' => false)) . ' <b>Customers</b>';
                                                    ?>
                                                </td>
                                            </tr>	 	
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.corporatebusiness', array('value' => 1, 'class' => 'partner desccheckbox', 'hiddenField' => false)) . ' <b>Vendor Partners</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.driver', array('value' => 1, 'class' => 'partner desccheckbox', 'hiddenField' => false)) . ' <b>Driver Partners</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	 	

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.vehicle_category', array('value' => 1, 'class' => 'vehicle desccheckbox', 'hiddenField' => false)) . ' <b>Vehicle Category</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.vehicle_manufacturer', array('value' => 1, 'class' => 'vehicle desccheckbox', 'hiddenField' => false)) . ' <b>Vehicle Manufacturer</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.vehicle_model', array('value' => 1, 'class' => 'vehicle desccheckbox', 'hiddenField' => false)) . ' <b>Vehicle Model</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.taxi_management', array('value' => 1, 'class' => 'vehicle desccheckbox', 'hiddenField' => false)) . ' <b>Taxi Management</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.permit', array('value' => 1, 'class' => 'vehicle desccheckbox','hiddenField' => false)) . ' <b>Taxi Permit Management</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	

<!--                                            <tr>
                                                <td>
                                                    <?php
                                                    //echo $this->Form->checkbox($model . '.team', array('value' => 1, 'class' => 'team desccheckbox', 'hiddenField' => false)) . ' <b>HR</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	-->
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.country', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>Countries</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.state', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>States</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.city', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>Cities</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.airport', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>Airports</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.railway', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>Railway Stations</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.bus_stand', array('value' => 1, 'class' => 'location desccheckbox', 'hiddenField' => false)) . ' <b>Bus Stands</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.superdestination', array('value' => 1, 'class' => 'destination desccheckbox', 'hiddenField' => false)) . ' <b>Super Destinations</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.moredestination', array('value' => 1, 'class' => 'destination desccheckbox', 'hiddenField' => false)) . ' <b>More Destinations</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>	

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.fare_category', array('value' => 1, 'class' => 'rate desccheckbox', 'hiddenField' => false)) . ' <b>Fare Categories</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.fare_time_management', array('value' => 1, 'class' => 'rate desccheckbox', 'hiddenField' => false)) . ' <b>Fare Time management</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.customer_fare', array('value' => 1, 'class' => 'rate desccheckbox', 'hiddenField' => false)) . ' <b>Customer Fares</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.vendor_fare', array('value' => 1, 'class' => 'rate desccheckbox', 'hiddenField' => false)) . ' <b>Vendor Rates</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.charges_management', array('value' => 1, 'class' => 'rate desccheckbox', 'hiddenField' => false)) . ' <b>Charges Management</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.promotion_code', array('value' => 1, 'class' => 'promotioncode desccheckbox', 'hiddenField' => false)) . ' <b>Promotional Codes</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.feedback_rating', array('value' => 1, 'class' => 'feedbackrating desccheckbox', 'hiddenField' => false)) . ' <b>Feedback & Ratings</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>

<!--                                            <tr>
                                                <td>
                                                    <?php
                                                   // echo $this->Form->checkbox($model . '.transaction', array('value' => 1, 'class' => 'transaction desccheckbox', 'hiddenField' => false)) . ' <b>Transaction</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>-->

                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.testimonial', array('value' => 1, 'class' => 'testimonial desccheckbox', 'hiddenField' => false)) . ' <b>Testimonials</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <?php
                                                    echo $this->Form->checkbox($model . '.pages', array('value' => 1, 'class' => 'webcontent desccheckbox', 'hiddenField' => false)) . ' <b>Pages</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.faqs', array('value' => 1, 'class' => 'webcontent desccheckbox', 'hiddenField' => false)) . ' <b>Faqs</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.terms', array('value' => 1, 'class' => 'webcontent desccheckbox', 'hiddenField' => false)) . ' <b>Terms of use</b>' . '&nbsp;';
                                                    echo $this->Form->checkbox($model . '.specials', array('value' => 1, 'class' => 'webcontent desccheckbox', 'hiddenField' => false)) . ' <b>Super Specials</b>' . '&nbsp;';
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>	
                                </tr> 	
                            </table>
		    <div class="row">
			<div class="col-md-8">
			</div>
			<div class="col-md-4">
			    <?php echo $this->Form->button('Save', array('class' => 'btn btn-primary btn-wide pull-left_form', 'type' => 'submit', 'id' => 'submit_button', 'style' => 'margin-left:46px')) ?>
			    <?php echo $this->Html->link(__('Cancel', true), array("action" => "index"), array("class" => "btn btn-primary btn-wide pull-right", "escape" => false)); ?>
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

