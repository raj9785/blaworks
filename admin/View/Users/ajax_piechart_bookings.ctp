 
<script type="text/javascript">

     var piedata = [
        <?php echo $data; ?>
    ];

    jQuery.plot('#piechart', piedata, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    threshold: 0.1
                }
            }
        },
        grid: {
            hoverable: true,
            clickable: true
        }
    });

    function labelFormatter(label, series) {
        return "<div style='font-size:8pt; text-align:center; padding:0px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
    }

</script>



<h4 class="subtitle mb5">Booking Types (Pickup)</h4>
<div id="piechart" style="width: 100%; height: 300px;margin-top: 50px;"></div>