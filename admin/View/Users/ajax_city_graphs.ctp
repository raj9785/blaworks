
<script type="text/javascript">

    var m8 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'city-wise-booking-<?php echo $city_id; ?>',
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
            m8.redraw();
        }, 200);
    }).trigger('resize');

</script>
<div class="col-sm-12">
<div class='col-sm-4'><h4 class="subtitle"><?php echo $city_name; ?></h4></div>
<div class='col-sm-4'>Total Bookings : <?php echo $total_bokings; ?></div>
<div class='col-sm-4'><a title="View all routes" type="button" data-toggle="modal" data-target="#graphOpen" id="supgraph_<?php echo $city_id; ?>" class="super-pop pull-right" href="javascript:void(0)">View all routes</a></div>

</div>
<div class="col-sm-12">
    <div id="city-wise-booking-<?php echo $city_id; ?>" class="body-chart"></div></div>
