<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
	//UINotifications.init();
	//TableData.init();
	/* $('#GuestCustomerFromDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#GuestCustomerToDate").datepicker("option", "minDate", selectedDate);
	    }
	});
	$('#GuestCustomerToDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#GuestCustomerFromDate").datepicker("option", "maxDate", selectedDate);
	    }

	}); */
	
	
	$('#GuestCustomerFromDate').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,            
		maxDate: '<?php echo MAX_DATE_RANGE; ?>',
		onSelect: function (selectedDate) {
			var nyd = new Date(selectedDate);
			nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
			$('#GuestCustomerToDate').datepicker("option", {
				minDate: new Date(selectedDate),
				maxDate: nyd
			});
		  
			//$("#GuestCustomerToDate").datepicker("option", "minDate", selectedDate);
		},
	});
	$('#GuestCustomerToDate').datepicker({
		dateFormat: "yy-mm-dd",
		//dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
		onClose: function (selectedDate) {
			$("#GuestCustomerFromDate").datepicker("option", "maxDate", selectedDate);
		}

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
                        <div class="col-sm-10">
                            <h1 class="mainTitle"><?php echo $title_for_layout; ?></h1>
                        </div>

                    </div>
                </section>


		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
		    <?php
		    echo $this->Form->create('GuestCustomer', array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
		    ?>
                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left1 driver_index1">

				<?php
				echo $this->Form->text('GuestCustomer.firstname', array('placeholder' => 'Name', 'value' => isset($firstname) ? $firstname : '', 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
				echo $this->Form->text('GuestCustomer.mobile', array('placeholder' => 'Mobile Number', 'value' => isset($mobile) ? $mobile : '', 'class' => 'form-control input-sm')) . "&nbsp;&nbsp;";
				echo $this->Form->text('GuestCustomer.email', array('placeholder' => 'Email ID', 'value' => isset($email) ? $email : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
				?>

				<?php
				echo $this->Form->text('GuestCustomer.from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';

				echo $this->Form->text('GuestCustomer.to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;';
				?>
				&nbsp;&nbsp;<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search')); ?>

				<?php echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Reset", true), array('class' => 'btn btn-green add-row new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Reset')); ?>

				<?php
				$val_url = json_encode($this->params->query);
				$search_val_url = base64_encode(base64_encode($val_url));
				echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getpdf_guest', $search_val_url, 'page' => $page,'type_download' => "pdf", '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style2', 'escape' => false));
				?>

				<?php
				echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getpdf_guest', $search_val_url, 'page' => $page,'type_download' => "csv", '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
				?>
			    </div>
			</div>
		    </div>
		    <?php echo $this->Form->end(); ?>
		    <div class="clear"></div>

                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">S.No.</th>
					<th class="hidden-xs">Registered On</th>
                                        <th class="hidden-xs">Name</th>
<!--                                        <th class="hidden-xs">Mobile Number</th>
                                        <th class="hidden-xs">Email ID </th>-->
                                        <th class="hidden-xs">Total Calls</th>
                                        <th class="hidden-xs">Enquiries</th>
                                        <th class="hidden-xs">Bookings</th>
                                        <th class="hidden-xs">Completed</th>
                                        <th class="hidden-xs">Cancelled</th>
                                        <th class="hidden-xs">Co. Cancelled</th>
                                        
                                        <th class="hidden-xs">Revenue</th>
                                       
                                        <th class="hidden-xs">Amount Due</th>
                                        <th class="hidden-xs">Conversion</th>
                                        <th class="hidden-xs">Happiness Index</th>


                                    </tr>
                                </thead>
                                <tbody>
				    <?php
				    if (!empty($users_list)) {
                                        $count_new_bookings=$this->Paginator->counter(array('format' => '%count%'));
					if ($page == 0 || $page == 1) {
					    $i = $count_new_bookings;
					} else {
					    //echo $count_new_bookings;
					    $i = $count_new_bookings - $limit * ($page - 1);
					}
					?>

					<?php foreach ($users_list as $user) { ?>  
					    <tr>
						<td> <?php echo $i; ?></td>
						<td> <?php echo date("d-m-y", strtotime($user['GuestCustomer']['created'])); ?></td>
						
						<td width="10%">
                                                     <a data-toggle="tooltip" data-html="true"  data-placement="top"  title="" class="" data-original-title="<?php 
                                                    echo "Mobile No : ".$user['GuestCustomer']['mobile']." </br>";
                                                    echo "Email ID : ".$user['GuestCustomer']['email'];
                                                    
                                                    ?>">
                                                        
                                                        <?php echo $user['GuestCustomer']['firstname'] . ' ' . $user['GuestCustomer']['lastname']; ?>
                                                    </a>
                                                    
                                                    
                                                 </td>

                                                 <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                 <td></td>

						
					    </tr>
					    <?php
					    $i--;
					}
					?>
    				    <tr>
    					<td  colspan="10"><?php echo $this->element('pagination'); ?></td>
    				    </tr> 
					<?php
				    } else {
					?>
    				    <tr>
    					<td colspan="9">No user exists.</td>
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
