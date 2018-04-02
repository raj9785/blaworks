<?php echo $this->Html->css(array('sweet-alert.css', 'ie9.css', 'toastr.min.css', 'DT_bootstrap.css'), null, array('inline' => false)); ?>
<?php echo $this->Html->script(array('select2.min.js', 'jquery.dataTables.min.js', 'table-data.js', 'sweet-alert.min.js', 'ui-notifications.js'), array('inline' => false)); ?>
<script type="text/javascript">
    jQuery(document).ready(function() {
        UINotifications.init();
        //TableData.init();
        jQuery("#add_new_user").click(function() {
            window.location.href = '<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'index')); ?>';
        });
	$("#check_all").on("click",function(){
	   var push_val = [];
	   if($(this).prop("checked") == true){
	   	$("input[id^=check_superdest_]").prop("checked",true);
	        $("input[id^=check_superdest_]").each(function(){
		   push_val.push($(this).val());
	        });	
	   }else{
		$("input[id^=check_superdest_]").prop("checked",false);
		$("input[id^=check_superdest_]").each(function(){
		   push_val.pop($(this).val());
	        });
		
	   }
	   $("#hiddenids").val(jQuery.unique(push_val));
	});
	$("input[id^=check_superdest_]").on("click",function(){
	   if ($(this).prop('checked') == true) {
		var push_val = [];
		$("input[id^=check_superdest_]:checked").each(function(){
		   push_val.push($(this).val());
	        });
	   }else{
		var push_val = [];
		$("input[id^=check_superdest_]:checked").each(function(){
		   push_val.pop($(this).val());
	        });
	   }	
           $("#hiddenids").val(jQuery.unique(push_val));
	});
	$("#make_super_destination").on("click",function(){
	  var checked_length = 	$("input[id^=check_superdest_]:checked").length;
	  if(checked_length == 0){
		alert("Please select super destination");
		return false;
	  }
	  if(checked_length < 16){
		alert("Please select atleast 16 records to make super destinations");
		return false;
	  }
	  if(checked_length > 16){
		alert("You can make only 16 super destinations for each origin city");
		return false;
	  }
	  $("#load_progressbar").html('<img src="<?php echo WEBSITE_URL.'img/progress_bar.gif'; ?>" />');
	  $.ajax({
	     type : 'POST',
	     url : '<?php echo $this->Html->url(array('plugin' => 'city','controller' => 'city','action' => 'make_super_destination'));  ?>',
	     data:'ids='+$("#hiddenids").val()+'&city=<?php echo $city_id; ?>',
	     success:function(data){
		if($.trim(data) == '1'){
		   window.location.reload();		
		}
	     }
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
                            <h1 class="mainTitle">Featured Destinations for <?php echo $city_name; ?></h1>                            
                        </div>

						<div class="col-md-4 text-align-right">
								<button class="btn btn-green add-row" id='add_new_user'>
									Back to cities list
								</button> 
								<!--
								<button class="btn btn-green add-row" id='make_super_destination'>
                                Make Top 16
                               </button> -->
							<div id="load_progressbar"></div>
                        </div>
                        
                    </div>
                </section>
                <?php echo $this->Session->flash(); ?>
                <div class="container-fluid container-fullw bg-white">
                   <!-- <div class="row">
                        
                    </div>-->
		    <div class="clear"></div>
                    <div class="row">
                        <div class="col-md-12">  
                           <?php echo $this->Form->create('SuperDestination'); ?>   
                            <?php echo $this->Form->input('hiddenids',array('type' => 'hidden','id' => 'hiddenids')); ?>                      
                            <table class="table table-striped table-bordered  table-full-width" id="<?php echo (!empty($users_list)) ? 'id="sample_1"' : '' ?>">
                                <thead>
                                    <tr>
									<!--	<th class="hidden-xs">
					
										<input type="checkbox" id="check_all" /></th>-->
                                        <th class="hidden-xs" width="2%">S.No.</th>
										 <th class="hidden-xs">Image </th>
                                        <th class="hidden-xs">Name </th>
                                        <th class="hidden-xs" width="25%">Description </th>
										<!---<th class="hidden-xs" width="25%">Front show </th>-->
                                        <th class="hidden-xs">Created On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($users_list)) { ?>
									 <?php $counter = 1; ?>
                                        <?php foreach ($users_list as $user) { ?>  
                                            <tr>
											<?php /* ?>
						<td width="5%"><input type="checkbox" name="check_id[]" id="check_superdest_<?php echo $user['SuperDestinationCity']['id']; ?>" value="<?php echo $user['SuperDestinationCity']['id']; ?>" /></td>
						  <?php */ ?>
												<td width="2%"><?php echo $counter; ?></td>
                                                <td width="10%">
                                                    <?php if (isset($user['SuperDestination']['image']) && file_exists(WEBSITE_APP_WEBROOT_ROOT_PATH . '/uploads/super_destinations/index/' . $user['SuperDestination']['image'])) { ?>
                                                        <?php echo $this->Html->image(WEBSITE_URL . '/uploads/super_destinations/index/' . $user['SuperDestination']['image'], array('border' => 0, 'width' => '100')); ?>
                                                    <?php } else { ?>
                                                        <?php echo $this->Html->image(WEBSITE_URL . '/img/no_image.jpg', array('border' => 0, 'width' => '100')); ?>
                                                    <?php } ?>
                                                </td>
                                            
                                                <td><?php echo $user['SuperDestination']['name']; ?></td>
                                                <td><?php echo ((strlen($user['SuperDestination']['description']) > 150) ? substr($user['SuperDestination']['description'], 0, 150) . '...' : $user['SuperDestination']['description']); ?></td>
											<!---	<td><?php echo (($user['SuperDestinationCity']['is_show_in_front'] == 'N') ? 'No' : 'Yes'); ?></td> -->
                                                
                                                <td><?php echo $this->Time->format("d-M-Y H:i:s A", $user['SuperDestination']['created']); ?></td>
                                            </tr>
                                            <?php
											 $counter++;
                                        }  ?>
										<tr>
											<td colspan="20"><?php echo $this->element('pagination'); ?></td>
												</tr>
                                    <?php } else {
                                        ?>
                                        <tr>
                                            <td colspan="10">No Records Found</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
			    <?php echo $this->Form->end(); ?>
                            
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
