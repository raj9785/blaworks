
<script type="text/javascript">

    var m88 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'city-wise-booking-single',
        // Chart data records -- each entry in this array corresponds to a point on
        // the chart.
        data: [
<?php echo $data; ?>
        ],
        xkey: 'y',
        ykeys: ['a'],
        labels: ['Total Booking'],
        lineWidth: '1px',
        fillOpacity: 0.8,
        smooth: false,
        hideHover: true,
        xLabelAngle: 50,
        padding: 35,
        barColors: function (row, series, type) {
            if (row.x <= 13) {
                return ColorArr[row.x];
            } else {
                var r1 = Math.ceil(200 * row.y / this.ymax);
                var r2 = Math.ceil(10 * row.y / this.ymax);
                return 'rgb(0,' + r2 + ',' + r1 + ')';
            }
        },
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
            m88.redraw();
        }, 200);
    }).trigger('resize');

</script>

<div id="city-wise-booking-single" class="body-chart"></div>