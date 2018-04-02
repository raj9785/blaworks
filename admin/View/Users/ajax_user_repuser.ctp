
<script type="text/javascript">

    var m3 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'bar-chart',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
            {y: '', a: <?php echo $new_user ?>, b: <?php echo $repeat_user ?>},
            
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['New User', 'Repeat User'],
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
	    m3.redraw();
	}, 200);
    }).trigger('resize');

</script>
 <div id="bar-chart" class="body-chart"></div>