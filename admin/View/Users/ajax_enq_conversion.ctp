
<script type="text/javascript">

     var m103 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'booking-ecr',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
             <?php echo $data; ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total Enquiry'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true,
	padding: 20,
        xLabelAngle: 20,
//        xLabelFormat: function(x) {
//            console.log(x);
//    	   if(x.label=="Total Booking"){
//               return "TB";
//           }
//    	},
        
    });

    var delay = (function() {
	var timer = 0;
	return function(callback, ms) {
	    clearTimeout(timer);
	    timer = setTimeout(callback, ms);
	};
    })();

    jQuery(window).resize(function() {
	delay(function() {
	    m103.redraw();
	}, 200);
    }).trigger('resize');

</script>
<h4 class="subtitle">Enquiry Conversion Report</h4>
<div id="booking-ecr" class="body-chart"></div>