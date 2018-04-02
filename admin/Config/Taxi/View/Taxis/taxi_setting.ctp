<?php 
	echo $this->Html->css(array('jquery.fancybox.css?v=2.1.5'));
	echo $this->Html->script(array('jquery.fancybox.js?v=2.1.5'));
	//echo $this->Html->css(array('jqueryui/jquery-ui.css'));
	//echo $this->Html->script(array('jqueryui/jquery-ui.js'));
	//echo $this->Html->script(array('jquery/external/jquery/jquery.js'));
 ?>
<div id="divForm" style="display:none">
    <div id="eventCal"></div>
</div>
 <style>
 	.yesitisbook {background: red !important; color: #fff !important;}
	.yesitisbook a { font-weight:bold; color: #fff !important; }
  	.noitisnotbook {background: green !important; color: #fff !important;}
	.noitisnotbook a { font-weight:bold; color: #fff !important; }
    
 </style>
<div id='delete_user_div'></div>
<div id='check_user_div'></div>
<div id='active_user_div'></div>
<div id='inactive_user_div'></div>


<table class="table table-bordered table-striped">
 		 <thead>
    		<tr>
      		<th  style="background-color: #EEEEEE;">
                <div class="row-fluid">
                    <h1><?php echo __($pageHeading,true); ?><div class="pull-right"></h1>
                </div>
            
              </th>
    		</tr>
			<tr>
		<td>
      
			  <div class="row-fluid">
                   <div class="span5" style="width:16.171%" >
                <a href="<?php echo $this->Html->url(array('plugin' => 'taxi_color','controller' => 'taxi_colors')); ?>" >   <img src="<?php echo WEBSITE_URL."img/taxi_color.jpg" ?>" /><br />
                   <h4 style="margin-top:10px;">	Taxi Color</h4></a>
                   
                   </div>
                   <div class="span5" style="width:16.171%">
                 <a href="<?php echo $this->Html->url(array('plugin' => 'taxi_fuel','controller' => 'taxi_fuels')); ?>" >   <img src="<?php echo WEBSITE_URL."img/taxi_fuel.jpg" ?>" /><br />
                   <h4>Taxi Fuel</h4></a>
                   
                   </div>
                   
                </div>
                

      </td>
    </tr>
	</thead> 
</table>


<script src="js/lightbox.js"></script>

