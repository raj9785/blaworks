<script type="text/javascript">
<?php

if ($monthly == 1) {
    ?>
        var m7 = new Morris.Line({
    	// ID of the element in which to draw the chart.
    	element: 'line-chart-visitors',
    	// Chart data records -- each entry in this array corresponds to a point on
    	// the chart.
    	data: [
    <?php echo $data; ?>
    	],
    	xkey: 'y',
    	ykeys: ['a'],
    	labels: ['Total Visitors'],
    	lineColors: ['#428BCA'],
    	lineWidth: '2px',
    	hideHover: true,
    	onlyIntegers: false,
    	padding: 30,
    	xLabelAngle: 50,
    	xLabelFormat: function(x) {
    	    var IndexToMonth = ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    	    var month = IndexToMonth[ x.getMonth() ];
    	    var year = x.getFullYear();
    	    return year + ' ' + month;
    	},
    	dateFormat: function(x) {
    	    var IndexToMonth = ["Jan", "Feb", "Mar", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    	    var month = IndexToMonth[ new Date(x).getMonth() ];
    	    var year = new Date(x).getFullYear();
    	    return year + ' ' + month;
    	},
        });

<?php } else if($monthly == 2){
    ?>
      var m7 = new Morris.Line({
    	// ID of the element in which to draw the chart.
    	element: 'line-chart-visitors',
    	// Chart data records -- each entry in this array corresponds to a point on
    	// the chart.
    	data: [
          <?php echo $data; ?>
    	],
    	xkey: 'y',
    	ykeys: ['a'],
    	labels: ['Total Visitors'],
    	lineColors: ['#428BCA'],
    	lineWidth: '2px',
    	hideHover: true,
    	onlyIntegers: false,
    	padding: 30,
    	xLabelAngle: 50,
        
    	});  
        
    
    <?php
} else { ?>
        var m7 = new Morris.Line({
    	// ID of the element in which to draw the chart.
    	element: 'line-chart-visitors',
    	// Chart data records -- each entry in this array corresponds to a point on
    	// the chart.
    	data: [
    <?php echo $data; ?>
    	],
    	xkey: 'y',
    	ykeys: ['a'],
    	labels: ['Total Visitors'],
    	lineColors: ['#428BCA'],
    	lineWidth: '2px',
    	hideHover: true,
    	onlyIntegers: false,
    	padding: 30,
    	xLabelAngle: 50,
    	xLabelFormat: function(d) {
    	    return d.getDate() + ' ' + ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'][d.getMonth()]
    	}


        });
<?php } ?>

    var delay = (function() {
	var timer = 0;
	return function(callback, ms) {
	    clearTimeout(timer);
	    timer = setTimeout(callback, ms);
	};
    })();

    jQuery(window).resize(function() {
	delay(function() {
	    m7.redraw();
	}, 200);
    }).trigger('resize');

</script>
<h4 class="subtitle">Daily Visitors Trend</h4>
<div id="line-chart-visitors" class="body-chart"></div>