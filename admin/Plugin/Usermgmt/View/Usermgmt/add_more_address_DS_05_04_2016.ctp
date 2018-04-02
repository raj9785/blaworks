<div id="AD_<?php echo $count ?>" class="col-sm-12"  style="margin-bottom: 13px;"> 
    <div class="clear"></div>
    <div class="clear"></div>
    
    <div class="col-sm-12"> 
	<div class="col-sm-12">  
	    <div class="col-sm-3">
		<?php echo $this->Form->select('OperationCity.state_id.' . $count, $state, array('value' => $state_id, 'class' => "form-control input-sm validate[required]", 'empty' => "Select State")); ?>						
	    </div>
	    <div class="col-sm-3">
		<?php echo $this->Form->select('OperationCity.city_id.' . $count, $city, array('class' => "form-control input-sm validate[required]", 'empty' => "Select City", "value" => $city_id)); ?>					
	    </div>
	    <div class="col-sm-4">
		<input type="text" id="OperationCityGarageAddress<?php echo $count ?>" value="<?php echo $address; ?>" placeholder="Garage Address" class="gmap_garag_address form-control input-sm" name="data[OperationCity][garage_address][<?php echo $count ?>]" autocomplete="off">
		<input name="data[OperationCity][id][<?php echo $count ?>]" class="textbox" type="hidden" value="<?php echo $address_id; ?>" id="OperationCityId<?php echo $count; ?>"/> 
		<?php echo $this->Form->input('OperationCity.lat.' . $count, array('class' => "textbox validate[required]", "type" => "hidden", "value" => $lat)); ?>
		<?php echo $this->Form->input('OperationCity.lng.' . $count, array('class' => "textbox validate[required]", "type" => "hidden", "value" => $lng)); ?>
	    </div>
	    <?php //if ($count != 0) { ?>
    	    <div class="col-sm-2">
    		<a id="RM_<?php echo $count ?>" onclick="return remove_addrs(<?php echo $count ?>,<?php echo $address_id?$address_id:0; ?>)" class="remove_add btn btn-sm btn-warning" href="javascript:void(0)" ><strong>X</strong></a>
    	    </div>
	    <?php //} ?>
	</div>
	<div class="col-sm-10"> 
	    <div class="col-sm-12">  
		<div id="map_canvas<?php echo $count ?>" style="height: 200px;"></div>
	    </div>
	</div>
    </div>   
    <script>
	$(document).ready(function() {
	    $("#OperationCityStateId<?php echo $count ?>").on('change', function() {
		cat_id = $(this).val();
		//alert(cat_id);
		$.ajax({
		    url: "<?php echo $this->Html->url(array('plugin' => 'city', 'controller' => 'city', 'action' => 'get_city')); ?>",
		    data: {'cat_id': cat_id},
		    type: 'post',
		    dataType: 'json',
		    success: function(subcat_data) {
			options = "<option value=''><?php echo __('Select City'); ?></option>";
			$.each(subcat_data, function(index, value) {
			    options += "<option value='" + index + "'>" + value + "</option>";
			});
			$("#OperationCityCityId<?php echo $count ?>").empty().html(options);
		    }
		});
	    });
	});
    </script>
    <?php //if($count!=0){ ?>
    <script>
	var map<?php echo $count ?> = null;
	var marker<?php echo $count ?> = [];
	var autocomplete<?php echo $count ?> = [];
	var autocompleteout<?php echo $count ?> = [];
	var geocoder = new google.maps.Geocoder();
	var infowindow1 = new google.maps.InfoWindow();
	var autocompleteOptions = {
	    componentRestrictions: {
		country: "in"
	    }
	};
	var componentForm = {
	    street_number: 'short_name',
	    route: 'long_name',
	    locality: 'long_name',
	    administrative_area_level_1: 'long_name',
	    country: 'long_name',
	    postal_code: 'short_name',
	};
	function initialize<?php echo $count ?>()
	{
	    var mapOptions<?php echo $count ?> =
		    {
			center: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
			zoom: 14,
			zoomControl: true,
			zoomControlOptions: {
			    style: google.maps.ZoomControlStyle.SMALL
			},
			mapTypeControl: true,
			mapTypeControlOptions: {
			    style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			}
		    };

	    map<?php echo $count ?> = new google.maps.Map(document.getElementById('map_canvas<?php echo $count ?>'), mapOptions<?php echo $count ?>);
	    var types = document.getElementById('type-selector');
	    map<?php echo $count ?>.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
	    var marker<?php echo $count ?> = new google.maps.Marker({
		position: new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),
		map: map<?php echo $count ?>,
		draggable: true,
	    });
	    google.maps.event.addListener(marker<?php echo $count ?>, 'dragend', function() {
		geocoder.geocode({'latLng': marker<?php echo $count ?>.getPosition()}, function(results, status) {
		    if (status == google.maps.GeocoderStatus.OK) {
			if (results[0]) {
			    $('#OperationCityGarageAddress<?php echo $count ?>').val(results[0].formatted_address);
			    $('#OperationCityLat<?php echo $count ?>').val(marker<?php echo $count ?>.getPosition().lat());
			    $('#OperationCityLng<?php echo $count ?>').val(marker<?php echo $count ?>.getPosition().lng());
			    //infowindow.setContent(results[0].formatted_address);
			    //infowindow.open(map<?php echo $count ?>, marker<?php echo $count ?>);
			}
		    }
		});
	    });
	    var pick_local<?php echo $count ?> = document.getElementById('OperationCityGarageAddress<?php echo $count ?>');
	    autocomplete_loc<?php echo $count ?> = new google.maps.places.Autocomplete(pick_local<?php echo $count ?>, mapOptions<?php echo $count ?>);
	    google.maps.event.addListener(autocomplete_loc<?php echo $count ?>, 'place_changed', function() {
		var place_loc<?php echo $count ?> = autocomplete_loc<?php echo $count ?>.getPlace();
		var latitude2 = place_loc<?php echo $count ?>.geometry.location.lat();
		var longitude2 = place_loc<?php echo $count ?>.geometry.location.lng();
		$('#OperationCityLat<?php echo $count ?>').val(latitude2);
		$('#OperationCityLng<?php echo $count ?>').val(longitude2);
		map<?php echo $count ?>.setCenter(place_loc<?php echo $count ?>.geometry.location);
		marker<?php echo $count ?>.setPosition(place_loc<?php echo $count ?>.geometry.location);
	    });


	}
	$(document).ready(function() {
	    initialize<?php echo $count ?>();
	});

    </script>

    <?php //}  ?>

</div>


