
<script type="text/javascript">
    $(document).ready(function () {
        $(".load_graph_selected").on("click", function () {
            var this_value = $(this).val();
            $("#oneway_city_gf").val(this_value);
            load_graph_selected_2($("#dashboard_type").val(), "");
        });
    });


    var m104 = new Morris.Bar({
        // ID of the element in which to draw the chart.
        element: 'tp_routes',
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
        //xLabelAngle: 1,
        padding: 30,
        //axes:false,
        axes: 'x',
        barColors: function (row, series, type) {
            if (row.x <= 40) {
                return ColorArr_Ct[row.x];
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
            m104.redraw();
        }, 200);
    }).trigger('resize');

</script>
<?php
$initial = 0;
$pickup_time = "";
$created = "";
$trip_end_date_time = "";
$cancelled_date = "";
if ($oneway_city_gf == "pickup_time") {
    $pickup_time = 'checked="checked"';
    $initial = 1;
}
if ($oneway_city_gf == "created") {
    $created = 'checked="checked"';
    $initial = 1;
}
if ($oneway_city_gf == "trip_end_date_time") {
    $trip_end_date_time = 'checked="checked"';
    $initial = 1;
}

if ($oneway_city_gf == "cancelled_date") {
    $cancelled_date = 'checked="checked"';
    $initial = 1;
}
if($initial==0){
    $pickup_time = 'checked="checked"';
}

?>
<h4 class="subtitle mb5">Top Routes : One Way (Fixed)
    &nbsp;&nbsp;
    <input type="radio" class="load_graph_selected" name="data[Graph][pickup_time]" <?php echo $pickup_time; ?> id="pickup_time" value="pickup_time"> Pickup
    &nbsp;<input type="radio" class="load_graph_selected" name="data[Graph][pickup_time]" <?php echo $created; ?> id="created" value="created"> Booking Received
    &nbsp;<input type="radio" class="load_graph_selected" name="data[Graph][pickup_time]" <?php echo $trip_end_date_time; ?> id="trip_end_date_time" value="trip_end_date_time"> Completed
    &nbsp;<input type="radio" class="load_graph_selected" name="data[Graph][pickup_time]" <?php echo $cancelled_date; ?> id="trip_end_date_time" value="cancelled_date"> Cancelled
</h4>

<div id="tp_routes" class="body-chart"></div>
