
<script type="text/javascript">

    var m10 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'booking-feedback',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            <?php echo $data; ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total Feedback'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true,
	padding: 30,
	xLabelAngle: 50,
        
        
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
	    m10.redraw();
	}, 200);
    }).trigger('resize');

</script>
<h4 class="subtitle mb5">Trip Feedback</h4>
<div id="booking-feedback" style="width: 100%; height: 344px"></div>