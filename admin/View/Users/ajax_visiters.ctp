
<script type="text/javascript">

    var m5 = new Morris.Donut({
        element: 'donut-chart',
        data: [
            {label: "Unique Visitors", value: <?php echo $unique_user; ?>},
            {label: "Repeat Visitors", value: <?php echo $repeat_user; ?>},
            
        ]
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
	    m5.redraw();
	}, 200);
    }).trigger('resize');

</script>
<div id="donut-chart" class="body-chart"></div>