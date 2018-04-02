<?php /* ?>
  <script type="text/javascript">

  var m102 = new Morris.Bar({
  // ID of the element in which to draw the chart.
  element: 'booking-btf',
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
  padding: 20,
  xLabelAngle: 20,
  //xLabelFormat: function(x) { return ''; }
  //axes: 'x',
  //        xLabelFormat: function(x) {
  //            console.log(x);
  //    	   if(x.label=="Total Booking"){
  //               return "TB";
  //           }
  //    	},

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
  m102.redraw();
  }, 200);
  }).trigger('resize');

  </script>
  <h4 class="subtitle">Booking Time Graph</h4>
  <div id="booking-btf" class="body-chart"></div>
  <?php */ ?> 


<script type="text/javascript">

    var piedata1 = [
<?php echo $data; ?>
    ];

    jQuery.plot('#piechart1', piedata1, {
        series: {
            pie: {
                show: true,
                radius: 1,
                label: {
                    show: true,
                    radius: 2 / 3,
                    formatter: labelFormatter,
                    //threshold: 0.1
                },
            }
        },
        grid: {
            hoverable: true,
            clickable: true
        }
    });



    function labelFormatter(label, series) {
        return "<div class='pls_hover' style='font-size:8pt; text-align:center; padding:0px; color:white;'>" + "" + "<br/><span class='span_set'>" + Math.round(series.percent) + "%</span></div>";
    }

</script>



<h4 class="subtitle mb5">Time Gap - Received v/s Pickup</h4>
<div id="piechart1" style="width: 100%; height: 300px;margin-top: 50px;"></div>
