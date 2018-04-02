
<script type="text/javascript">

    var m34 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'bar-chart-2',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            <?php echo $data; ?>,
            
        ],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Facebook', 'Google+','Linkedin'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true,
	padding: 30,
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
	    m34.redraw();
	}, 200);
    }).trigger('resize');

</script>
 <div id="bar-chart-2" class="body-chart"></div>