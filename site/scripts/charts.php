<?php
try{
  $bdd= new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8','root','');}catch(Exception $e){echo "pas bien";}
  $chaine='[';
  $maxVValue=0;
  $total=0;
  $i=0;
  $totLum1=0;
  $totLum2=0;
  $totLum3=0;
  $rep=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%e %b, %y') AS Jour, EnerCons AS Energie_consomme FROM (SELECT * FROM energie WHERE IdLumière IS NOT NULL ORDER BY IdEner DESC LIMIT 90) sub ORDER BY DateHeureMinute ASC;");
  if($rep!=FALSE){
    while($data=$rep->fetch()){
      if($i==0){
        $chaine .= '"'.$data['Jour'].'",'.$data['Energie_consomme'].',';
        $total=$total+$data['Energie_consomme'];
        $totLum1=$totLum1+$data['Energie_consomme'];
        $i++;
      }
      else if($i<=2){
        $chaine.=$data['Energie_consomme'].',';
        $total=$total+$data['Energie_consomme'];
        $i++;
        if($i==3){
          $chaine.=$total.'],[';
          if($total>$maxVValue){$maxVValue=$total;}
          $totLum3=$totLum3+$data['Energie_consomme'];
          $total=0;
          $i=0;
        }else{$totLum2=$totLum2+$data['Energie_consomme'];}
      }
    }
    $rep->closeCursor();
  }

  $chaine= substr($chaine,0,strlen($chaine)-2);
  if($chaine==NULL){$chaine='[0,0,1,2,3],[31,1,2,3,6]';}
  $maxVValue=$maxVValue+$maxVValue/4;
  ?>

  <script type="text/javascript">
  google.charts.load('current', {'packages':['line']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Jour', 'Lumière Salon','Lumière Chambre','Lumière Cuisine', 'Total Lumières'],<?php echo $chaine;?>
    ]);

    var options = {
      //theme : 'material',
      chart: {title: 'Consommation de la lumière par jour', subtitle:'en W/h'},
      //curveType:'function',
      width: 1500,
      height: 375,

      hAxis: {textPosition:'out',format:'dd MMM, y'},
      legend : {position: 'right'},
      axes:{
        y: {0:{label:'W/h'}},
      },

      selectionMode:'single',
      tooltip: {trigger:'focus'},
      agregationTarget:'series',
    };


    var chart = new google.charts.Line(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }

  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawPie);

  function drawPie(){

    var data2 = google.visualization.arrayToDataTable([
      ['Pièce', 'Consommation'],
      ['Salon',<?php echo $totLum1;?>],
      ['Chambre',<?php echo $totLum2;?>],
      ['Cuisine',<?php echo $totLum3;?>],
    ]);

    var options2 = {
      title: 'Répartition des consommations des lumières',
      pieHole: 0.4,
      height:375,
      width:750
    };

    var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
    chart2.draw(data2, options2);

  }
  </script>
