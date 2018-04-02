
<script type="text/javascript">
    formatY = function (y) {
            return y;
        };
      formatX = function (x) {
            return x;
        };
    var m77 = new Morris.Line({
        // ID of the element in which to draw the chart.
        element: 'line-chart-hour-booking',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
<?php echo $data; ?>
        ],
        xkey: 'y',
        ykeys: ['a', 'b','c'],
        labels: ['Booking Received', 'Pickup','Trip End'],
        lineColors: ['#428BCA', '#1CAF9A','#F0AD4E'],
        lineWidth: '2px',
        hideHover: true,
        onlyIntegers: false,
        padding: 30,
        xLabelAngle: 70,
        parseTime:false,
        axes:false,
        xLabelFormat: function(x) { return timeArr[x.label]+" - "+timeArr[parseInt(parseInt(x.label)+1)]; },
      


    });
    
    


    var delay = (function () {
        var timer = 0;
        return function (callback, ms) {
            clearTimeout(timer);
            timer = setTimeout(callback, ms);
        };
    })();

    jQuery(window).resize(function () {
        delay(function () {
            m77.redraw();
        }, 200);
    }).trigger('resize');

</script>
<h4 class="subtitle">Hourly Booking Trend</h4>
<div id="line-chart-hour-booking" class="body-chart"></div>