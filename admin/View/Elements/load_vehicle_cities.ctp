<style type="text/css">
table.load_vehicle_cities{font-size:13px;}
table.load_vehicle_cities h1{font-size:16px;}
table.load_vehicle_cities td{padding:2px; height:25px; border:1px solid #ccc;}
</style>
<table border="0" cellpadding="0" cellspacing="0" width="100%" class="load_vehicle_cities">
   <?php if(isset($output) && !empty($output)){ ?>
    <tr><td colspan="3"><h1>Vehicle operates in following cities:-</h1></td></tr>
    <tr>
	   <td align="center"><strong>City</strong></td>
	   <td align="center"><strong>State</strong></td>
	   <td align="center"><strong>Country</strong></td>
	</tr>
   <?php foreach($output as $key){ ?>
	<tr>
	   <td align="center"><?php echo $key['city_name']; ?></td>
	   <td align="center"><?php echo $key['state_name']; ?></td>
	   <td align="center"><?php echo $key['country_name']; ?></td>
	</tr>
   <?php }?>
   <?php }else{?>
	<div align="center"><strong>Vehicle does not operate in any city.</strong></div>
   <?php }?>
</table>
