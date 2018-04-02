<?php
//bootstrap.min.js
echo $this->Html->script(array('jquery.min.js', 'main.js'));

echo $this->Html->css(array('morris'));
?>



<div id="app">
    <!-- sidebar -->
    <?php echo $this->element('sidebar'); ?>
    <!-- / sidebar -->
    <div class="app-content">
        <!-- start: TOP NAVBAR -->
	<?php echo $this->element('header'); ?>
        <!-- end: TOP NAVBAR -->
	<?php
	if (!isset($permissions) || (isset($permissions) && isset($permissions['dashboard']) && $permissions['dashboard'] == 1)) {
	    ?>	
    	<div class="main-content" >
    	    <div class="wrap-content container" id="container">  
		    <?php echo $this->Session->flash(); ?>				
    		<div class="container-fluid container-fullw bg-white">

    		    <div class="row">
			
			
			
			<div class="contentpanel">

    			    <div class="panel panel-default">
    				<div class="panel-body">
					<?php echo $this->Form->create('Graph', array('method' => 'post', 'class' => 'form', 'role' => 'form')); ?>
    				    <div class="row">
<!--					<div class="col-sm-12 col-md-12">
					    <div class="col-md-8 col-sm-8">
						<h4 class="subtitle">Search Bar</h4>
					    </div>
					
					 <div class="col-md-4 mb30 col-sm-4 pull-right"></div>
					</div>-->
    					<div class="col-sm-12 col-md-12">
						<?php echo $this->Form->input('Graph.sort_type', array('type' => 'hidden', 'value' => 'current_month')); ?>

    					    <div class="col-md-2">
						    <?php
						    echo $this->Form->select('state_id', $states, array('value' => isset($state_id) ? $state_id : '', 'class' => 'value_change textbox form-control', 'empty' => __('Select State', true)));
						    ?>
    					    </div>
    					    <div class="col-md-2">
						    <?php
						    echo $this->Form->select('city_id', array(), array('class' => 'textbox form-control value_change', 'empty' => __('Select City', true)));
						    ?>

    					    </div>
    					    <div class="col-md-2"><?php
						    echo $this->Form->text('from_date', array('placeholder' => __('From Date', true), 'value' => isset($from_date) ? $from_date : '', 'class' => ' form-control value_change_date'));
						    ?></div>
    					    <div class="col-md-2">
						    <?php
						    echo $this->Form->text('to_date', array('placeholder' => __('To Date', true), 'value' => isset($to_date) ? $to_date : '', 'class' => ' form-control value_change_date'));
						    ?>
    					    </div>
					    <div class="col-md-2"></div>
					    <div class="col-md-2"><a class="sort_graph pull-right btn btn-green" href="javascript:void(0)" id="current_month">Refresh Graph</a></div>
					    
					    
    					</div>
<!--    					<div class="col-sm-12 col-md-12">
    					    <div class="col-md-3">
    						<a href="javascript:void(0)" style="width: 225px ! important;" id="yesterday" class="sort_graph btn btn-primary btn-wide">Yesterday</a>

    					    </div>
    					    <div class="col-md-3">
    						<a href="javascript:void(0)" style="width: 225px ! important;" id="today" class="sort_graph btn btn-primary btn-wide">Today</a>
    					    </div>
    					    <div class="col-md-3">
    						<a href="javascript:void(0)" style="width: 225px ! important;" id="last_week" class="sort_graph btn btn-primary btn-wide">Last Week</a>
    					    </div>
    					    <div class="col-md-3">
    						<a href="javascript:void(0)" style="width: 225px ! important;" id="last_month" class="sort_graph btn btn-primary btn-wide">Last Month</a>
    					    </div>
    					</div>-->

    				    </div>
					<?php echo $this->Form->end(); ?>
    				</div>
    			    </div>
    			</div>
			<div class='clear'></div>
			
			
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">CITIES</h2>
				    <span class="links cl-effect-1"><?php echo $count_city; ?></span>
    				    <p class="links cl-effect-1">
					    <?php echo $this->Html->link('view more', array('controller' => 'city', 'action' => 'index'), array('escape' => false)); ?>
    				    </p>
    				</div>
    			    </div>
    			</div>
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">VENDORS</h2>
				     <span class="links cl-effect-1"><?php echo $count_vendors; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'individual', 'action' => 'index')); ?>">view more</a>
    				    </p>
    				</div>
    			    </div>
    			</div>
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">VEHICLES</h2>
				      <span class="links cl-effect-1"><?php echo $vehicles_list; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => "taxi", 'controller' => 'taxis', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

    				    </p>
    				</div>
    			    </div>
    			</div>     
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">DRIVERS</h2>
				     <span class="links cl-effect-1"><?php echo $drivers_list; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'driver', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

    				    </p>
    				</div>
    			    </div>
    			</div> 
    			<div class='clear'></div>
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">CUSTOMER INVOICES</h2>
				    <span class="links cl-effect-1">&#8377; <?php echo $customer_invoices_count; ?></span>
    				    <p class="links cl-effect-1">
					    <?php echo $this->Html->link('view more', array('controller' => 'invoice', 'action' => 'index'), array('escape' => false)); ?>
    				    </p>
    				</div>
    			    </div>
    			</div>
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">CUSTOMER RECEIPTS</h2>
				     <span class="links cl-effect-1">&#8377; <?php echo $customer_recipts_count; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => 'transaction', 'controller' => 'transactions', 'action' => 'index')); ?>">view more</a>
    				    </p>
    				</div>
    			    </div>
    			</div>
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">CUSTOMER REFUNDS</h2>
				    <span class="links cl-effect-1">&#8377; <?php echo $count_refunds; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'cancelled_bookings', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

    				    </p>
    				</div>
    			    </div>
    			</div>     
    			<div class="col-sm-3">
    			    <div class="panel panel-white no-radius text-center">
    				<div class="panel-body">
    				    
    				    <h2 class="StepTitle">VENDOR RECEIPTS</h2>
				    <span class="links cl-effect-1">&#8377; <?php echo $vendoe_invoice_count; ?></span>
    				    <p class="links cl-effect-1">
    					<a href="<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'vendor_invoices', 'action' => 'index')); ?>"><span class="title"> view more</span></a>

    				    </p>
    				</div>
    			    </div>
    			</div> 
    			<div class='clear'></div>



    			<div class="contentpanel">

    			    <div class="panel panel-default">

    				<div class="panel-body">
    				    
    				    <div class="row">

    					<div class="col-md-6 mb30">
    					    <div id="divLoading1" class="divLoading"></div>
    					    <div  id="line_chart_count_booking"></div>
    					</div>
    					<div class="col-md-6 mb30">
    					    <div id="divLoading2" class="divLoading"></div>
    					    <div id="bar_chart_city_wise_booking"></div>
    					</div>
    				    </div>
    				    <div class="row">
    					<div class="col-md-5 mb30">
    					    <div id="divLoading3" class="divLoading"></div>
    					    <div id="piechart_bookings"></div>
    					</div>
    					<div class="col-md-3 mb30">
    					    <div id="divLoading4" class="divLoading"></div>
    					    <div id="booking_status"></div>
    					</div>
    					<div class="col-md-4 mb30">
    					    <div id="divLoading5" class="divLoading"></div>
    					    <div id="booking_feedback"></div>
    					</div>
    				    </div>

    				    <div class="row">

    					<div class="col-md-6 mb30">
    					    <h4 class="subtitle">User Pattern</h4>
    					    <div class="col-md-4 mb30">
    						<div id="divLoading6" class="divLoading"></div>
    						<div id="bar_chart_user_repuser"></div>
    					    </div>
    					    <div class="col-md-4 mb30">
    						<div id="divLoading7" class="divLoading"></div>
    						<div  id="bar_chart_guest_registered"></div>
    					    </div>
    					    <div class="col-md-4 mb30">
    						<div id="divLoading8" class="divLoading"></div>
    						<div id="bar_chart_user_pattern"></div>
    					    </div>
    					</div>
    					<div class="col-md-6 mb30">
    					    <div id="divLoading9" class="divLoading"></div>
    					    <h4 class="subtitle">Panic Button:</h4>
    					    <div id="panic_button"></div>

    					</div>
    				    </div>

    				    <div class="row">
    					<div class="col-md-6">
    					    <div id="divLoading10" class="divLoading"></div>
    					    <h4 class="subtitle">Website Visitor</h4>
    					    <div id="visiters"></div>

    					</div>


    				    </div><!-- row -->




    				</div>

    			    </div>

    			</div>

    			
    			





    		    </div>
    		</div> 
    		<!-- end: FOURTH SECTION -->
    	    </div>
    	</div>
        </div>
	<?php
    }
    ?> 


    <!-- start: FOOTER -->
    <?php echo $this->element('footer'); ?>
    <!-- end: FOOTER -->    
</div>

<script type="text/javascript">
    $(document).ready(function() {
	
	$('#GraphFromDate').datepicker({
	    // dateFormat: "yy-mm-dd",
	    dateFormat: "dd-mm-yy",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#GraphToDate").datepicker("option", "minDate", selectedDate);
	    }
	});
	$('#GraphToDate').datepicker({
	    //dateFormat: "yy-mm-dd",
	    dateFormat: "dd-mm-yy",
	    changeMonth: true,
	    changeYear: true,
	    onClose: function(selectedDate) {
		$("#GraphFromDate").datepicker("option", "maxDate", selectedDate);
	    }

	});
	
	$("#GraphStateId").on('change', function() {
	    $("#GraphCityId").attr('disabled', 'disabled');
	    $("#GraphCityId").empty();
	    $.ajax({
		type: 'POST',
		url: '<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'getCitiesByState')) ?>',
		data: 'state_id=' + $("#GraphStateId").val(),
		success: function(data) {
		    $("#GraphCityId").removeAttr('disabled');
		    $("#GraphCityId").html(data);
		}
	    });
	});
	
	$(".value_change_date").on("change", function() {
	   if($("#GraphFromDate").val()!='' && $("#GraphToDate").val()!=''){
	      $("#GraphSortType").val('');
	      load_graph();   
	   }
	 
	});

	$(".value_change").on("change", function() {
	   load_graph();
	});

	$(".sort_graph").on("click", function() {
	    var id_div = $(this).attr("id");
	    $("#GraphSortType").val(id_div);
	    $("#GraphFromDate").val('');
	    $("#GraphToDate").val('');
	    
	    $(".sort_graph").removeClass("btn-green");
	    $("#current_month").addClass("btn-green");
	    $("#"+id_div).addClass("btn-green");
	    
	    load_graph();
	});

	load_graph();

	$(".ti-align-justify").on("click", function() {
	    if ($("#app").hasClass("app-slide-off")) {
		$("#app").removeClass('app-slide-off');
	    } else {
		$("#app").addClass('app-slide-off');
	    }
	});
	$(".slide_class").on("click", function() {
	    var chks = $(this).hasClass("open");
	    $(".slide_class").each(function() {
		if ($(this).hasClass("active")) {

		} else {
		    $(this).removeClass('open');
		    $(this).children(".sub-menu").slideUp();
		}
	    });

	    if (chks) {
		$(this).removeClass('open');
		$(this).children(".sub-menu").slideUp();
	    } else {
		// alert("d2");
		$(this).addClass('open');
		$(this).children(".sub-menu").slideDown();
	    }
	});
    });
    
    function load_graph(){
        line_chart_count_booking();
	bar_chart_city_wise_booking();
	piechart_bookings();
	booking_status();
	booking_feedback();
	bar_chart_user_repuser();
	bar_chart_guest_registered();
	bar_chart_user_pattern();
	panic_button();
	visiters();
    }
    function visiters() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_visiters')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading10").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#visiters").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading10").removeClass('show');

	    }
	});
    }
    function panic_button() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_panic_button')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading9").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#panic_button").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading9").removeClass('show');

	    }
	});
    }
    function bar_chart_user_pattern() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_user_pattern')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading8").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#bar_chart_user_pattern").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading8").removeClass('show');

	    }
	});
    }

    function bar_chart_guest_registered() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_guest_registered')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading7").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#bar_chart_guest_registered").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}

		$("#divLoading7").removeClass('show');

	    }
	});
    }

    function bar_chart_user_repuser() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_user_repuser')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading6").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#bar_chart_user_repuser").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading6").removeClass('show');

	    }
	});
    }

    function booking_feedback() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_booking_feedback')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading5").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#booking_feedback").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading5").removeClass('show');

	    }
	});
    }

    function booking_status() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_booking_status')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading4").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#booking_status").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading4").removeClass('show');

	    }
	});
    }

    function piechart_bookings() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_piechart_bookings')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading3").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#piechart_bookings").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading3").removeClass('show');

	    }
	});
    }

    function bar_chart_city_wise_booking() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_bc_city_wise')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading2").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#bar_chart_city_wise_booking").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading2").removeClass('show');

	    }
	});
    }

    function line_chart_count_booking() {
	$.ajax({
	    url: "<?php echo $this->Html->url(array('plugin' => false, 'controller' => 'users', 'action' => 'ajax_lc_count')); ?>",
	    data: $("#GraphDashboardForm").serialize(),
	    type: 'post',
	    beforeSend: function() {
		$("#divLoading1").addClass('show');
	    },
	    success: function(r) {
		if (r == 'error') {

		}
		else {
		    $("#line_chart_count_booking").empty().html(r);
		    //$("#loadingWap_local").fadeOut();
		}
		$("#divLoading1").removeClass('show');

	    }
	});
    }

//jQuery.noConflict();
</script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-1.11.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery-migrate-1.2.1.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/bootstrap.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/modernizr.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.sparkline.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/toggles.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/retina.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.cookies.js"></script>


<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.symbol.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.crosshair.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.categories.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/morris.min.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/raphael-2.1.0.min.js"></script>

<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/custom.js"></script>
<script src="<?php echo WEBSITE_ADMIN_URL ?>js/flot/charts.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<?php 
//echo $this->Html->script(array('jquery-ui.min'));
?>