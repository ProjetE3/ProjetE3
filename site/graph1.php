<html>
<head>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="scripts/jquery.js"></script>



    <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Day', 'Lumiere Salon','Lumiere Chambre','Lumiere Cuisine', 'Total Lumieres'],<?php echo $chaine;?>
      ]);

      var options = {
        title: 'Consommation de la lumiere en MW/h',
        legend: { position: 'bottom' },
        vAxis: {minValue:0, maxValue:<?php echo $maxVValue;?>},
      };


      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

      chart.draw(data, options);
    }
    </script>

  </head>
  <body>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
  </html>
