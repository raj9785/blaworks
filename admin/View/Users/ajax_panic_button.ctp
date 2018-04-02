<script type="text/javascript">
    var m11 = new Morris.Line({
	// ID of the element in which to draw the chart.
	element: 'panic-button',
	// Chart data records -- each entry in this array corresponds to a point on
	// the chart.
	data: [
            <?php echo $data; ?>
	],
	xkey: 'y',
	ykeys: ['a','b'],
	labels: ['Customers Alert','Drivers Alert'],
	lineColors: ['#D9534F', '#428BCA'],
	lineWidth: '2px',
	hideHover: true,
	padding: 30,
	xLabelAngle: 50,
	xLabelFormat: function(d) {
    	    return d.getDate() + ' ' + ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][d.getMonth()]
    	}
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
	    m11.redraw();
	}, 200);
    }).trigger('resize');

</script>
<h4 class="subtitle">Don’t Panic Alerts</h4>
<div id="panic-button" class="body-chart"></div>