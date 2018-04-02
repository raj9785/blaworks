<?php

echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'), null, array('inline' => false));
echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'), array('inline' => false));
?>
<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php
echo $this->Html->script(array('jquery.dataTables.min.js', 'sweet-alert.min.js'), array('inline' => false));
echo $this->Html->script(array('jquery-ui.min'));
?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        $(".super-raj-pop").fancybox({
	    type: 'ajax',
	    helpers: {
		overlay: {closeClick: false}
	    },
	});
	//UINotifications.init();
	//TableData.init();
	/* $('#SentMessageFromDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#SentMessageToDate").datepicker("option", "minDate", selectedDate);
	    }
	});
	$('#SentMessageToDate').datepicker({
	    dateFormat: "yy-mm-dd",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#SentMessageFromDate").datepicker("option", "maxDate", selectedDate);
	    }

	}); */
	
	
	$('#SentMessageFromDate').datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
		changeYear: true,            
		maxDate: '<?php echo MAX_DATE_RANGE; ?>',
		onSelect: function (selectedDate) {
			var nyd = new Date(selectedDate);
			nyd.setDate(nyd.getDate() + <?php echo MAX_TO_DATE_RANGE; ?>);
			$('#SentMessageToDate').datepicker("option", {
				minDate: new Date(selectedDate),
				maxDate: nyd
			});
		  
			//$("#SentMessageToDate").datepicker("option", "minDate", selectedDate);
		},
	});
	$('#SentMessageToDate').datepicker({
		dateFormat: "yy-mm-dd",
		//dateFormat: "dd-mm-yy",
		changeMonth: true,
		changeYear: true,
		minDate: '<?php echo MIN_TO_DATE_RANGE; ?>',
		onClose: function (selectedDate) {
			$("#SentMessageFromDate").datepicker("option", "maxDate", selectedDate);
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
                        <div class="col-sm-9">
                            <h1 class="mainTitle">Messages</h1>
                        </div>
                        <div class="col-sm-3 text-align-right">
			 <?php echo $this->Html->link(__('Send New Message', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "send_message_vendors"), array("class" => "btn btn-green super-raj-pop", "escape" => false)); ?>
                        </div>

                    </div>
                </section>


		<?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
		    <?php
		    echo $this->Form->create('SentMessage', array('type' => 'get', 'class' => 'form-inline', 'inputDefaults' => array('label' => false, 'div' => false)));
		    ?>
                    <div class="row">
			<div class="col-md-12 space20">
			    <div class="pull-left1 driver_index1">

				<?php
				
				echo $this->Form->select('city_id', $city, array('empty' => __('Select City', true),'value' => isset($city_id) ? $city_id : '', 'class' => 'form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->select('SentMessage.firstname',$user_dttls, array('value' => isset($firstname) ? $firstname : '','class' => 'textbox form-control input-sm', 'empty' => "Sent By", 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('SentMessage.from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
                                echo $this->Form->text('SentMessage.to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control input-sm')) . '&nbsp;&nbsp;';
				echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Search", true), array('class' => 'btn btn-primary new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Search')). '&nbsp;&nbsp;';;
                                echo $this->Form->button("<i class='icon-search icon-white'></i> " . __("Reset", true), array('class' => 'btn btn-green add-row new-style', 'escape' => false, 'type' => 'submit', 'name' => 'submit_button', 'value' => 'Reset')); ?>

				<?php
				//$val_url = json_encode($this->params->query);
				//$search_val_url = base64_encode(base64_encode($val_url));
				///echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as PDF", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getpdf_guest', $search_val_url, 'page' => $page,'type_download' => "pdf", '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getpdfval', 'class' => 'btn btn-success getvalfromurl new-style2', 'escape' => false));
				?>

				<?php
				//echo $this->Html->link("<i class='icon-search icon-white'></i>" . __("Export as CSV", true), array('plugin' => false, 'controller' => 'users', 'action' => 'getpdf_guest', $search_val_url, 'page' => $page,'type_download' => "csv", '?' => array('firstname' => @$firstname, 'register_from' => @$register_from, 'mobile' => @$mobile, 'email' => @$email, 'status' => @$status, 'is_verified' => @$is_verified, 'from_date' => @$from_date, 'to_date' => @$to_date,)), array('id' => 'getcsvval', 'class' => 'btn btn-success getvalfromurl new-style', 'escape' => false));
				?>
			    </div>
			</div>
		    </div>
		    <?php echo $this->Form->end(); ?>
		    <div class="clear"></div>

                    <div class="row">
                        <div class="col-md-12">                           
                            <table class="table table-striped table-bordered  table-full-width">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs">S.No.</th>
					<th class="hidden-xs" style="width: 50%;">Message</th>
                                        <th class="hidden-xs">Sent To</th>
                                        <th class="hidden-xs">Delivered To</th>
                                        <th class="hidden-xs">Sent By</th>
                                        <th class="hidden-xs">Sent On</th>


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
						
						
						<td><?php echo $user['SentMessage']['message']; ?></td>
						
                                                <td><?php echo $this->Html->link(__('View', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "message_users",$user['SentMessage']['id'],'sent_to'), array("class" => "super-raj-pop", "escape" => false)); ?></td>
                                                <td><?php echo $this->Html->link(__('View', true) . "", array('plugin' => 'usermgmt', 'controller' => 'usermgmt', "action" => "message_users",$user['SentMessage']['id'],'delivered_to'), array("class" => "super-raj-pop", "escape" => false)); ?></td>
                                                <td><?php echo $user['SentMessage']['user_name']; ?></td>
						<td> <?php echo date("d-m-Y h:i:s A", strtotime($user['SentMessage']['created'])); ?></td>

						
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
    					<td allign="center" colspan="9" style="text-align: center;">No Record Found.</td>
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
