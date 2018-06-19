<!DOCTYPE html>
<html>

<head>

	<!-- en-t�te de la page -->
	<meta charset="utf-8" />
	<title> HESTIA </title>

	<!-- Importation des styles de la page-->
	<link rel="stylesheet" href="css/style_nav.css"/>
	<link rel="stylesheet" href="css/style_consommation.css"/>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<script src="scripts/nav.js"> </script>

	<!-- Création des graphiques-->

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php
	try{
		$bdd= new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8','root','');}catch(Exception $e){echo "Unable to connect to the database :'('";}

		$chaine='[';$maxVValue=0;$Lum=0;$Cha=0;$Ele=0;$i=0;$totLum=0;$totCha=0;$totEle=0;

		$rep=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdLumiere IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdLumiere ASC ORDER BY DateHeureMinute ASC;");
		$rep2=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdChauffage IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdChauffage ASC ORDER BY DateHeureMinute ASC;");
		$rep3=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdElectro IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdElectro ASC ORDER BY DateHeureMinute ASC;");

		if($rep!=FALSE && $rep2!=FALSE && $rep3!=FALSE){
			while($data=$rep->fetch()){
				if($data2=$rep2->fetch()){
					if($data3=$rep3->fetch()){
						if($i==0){
							$chaine .= '"'.$data['Jour'].'",';
							$Lum=$Lum+$data['Energie_consomme'];
							$Cha=$Cha+$data2['Energie_consomme'];
							$Ele=$Ele+$data3['Energie_consomme'];
							$i++;
						}
						else if($i<=2){
							$i++;

							if($i==3){
								$Lum=$Lum+$data['Energie_consomme'];
								$Cha=$Cha+$data2['Energie_consomme'];
								$Ele=$Ele+$data3['Energie_consomme'];
								$chaine.=$Lum.",".$Cha.",".$Ele.",".($Lum+$Cha+$Ele).'],[';
								$totLum=$totLum+$Lum;
								$totCha=$totCha+$Cha;
								$totEle=$totEle+$Ele;
								$Lum=0;
								$Cha=0;
								$Ele=0;
								$i=0;
							}else{
								$Lum=$Lum+$data['Energie_consomme'];
								$Cha=$Cha+$data2['Energie_consomme'];
								$Ele=$Ele+$data3['Energie_consomme'];
							}
						}
					}
				}
			}
			$rep->closeCursor();
		}

		$chaine= substr($chaine,0,strlen($chaine)-2);
		if($chaine==NULL){$chaine='[0,1,2,3,6],[31,2,3,5,10]';}
		?>

		<script type="text/javascript">
		google.charts.load('current', {'packages':['line']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Temps', 'Lumiere','Chauffage','Electroménager','Total'],<?php echo $chaine;?>
			]);

			var options = {
				//theme : 'material',
				chart: {title: 'Consommation des systemes', subtitle:'en W/h'},
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
				['Systeme', 'Consommation'],
				['Lumiere',<?php echo $totLum;?>],
				['Chauffage et climatisation',<?php echo $totCha;?>],
				['Electroménager',<?php echo $totEle;?>],
			]);

			var options2 = {
				title: 'Répartition des consommations des systemes :',
				fontName:'Oswald',fontSize:18,
				legend : {textStyle: {fontSize:13}},
				pieSliceTextStyle:{fontSize:15,},
				tooltip:{textStyle:{fontSize:15}},
				pieHole: 0.4,
				height:375,
				width:750
			};

			var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart2.draw(data2, options2);

		}
		</script>

	</head>



	<!-- NAVIGATION -->

	<div id="sideNavigation" class="menu-ouvert">
		<a href="javascript:void(0)" class="bouton-croix" onclick="closeNav()">&times;</a>

		<li><a href="Consommation">CONSOMMATION</a>
			<ul >
				<li><a href="Consommation_chau&clim">CHAUFFAGE</a></li>
				<li><a href="Consommation_lum">LUMIERE</a></li>
			</ul>
		</li>

		<li><a href="Domotique">DOMOTIQUE</a></li>
	</div>


	<!-- BOUTONS DU MENU -->

	<div class="boutons">
		<div class="menu">
			<a href="#" onclick="openNav()">
				<img class="bouton-menu" src="images/menu.png" alt="Menu"/>

			</a>
		</div>

		<div class="bouton">
			<a id="info" href="Information">
				<img class="bouton-info" src="images/info.png" alt="Information"/>
			</a>
			<a id="temperature" href="Temperature">
				<img class="bouton-temperature" src="images/thermometre.png" alt="Thermometre"/>
			</a>
			<a id="lumiere" href="Lumiere">
				<img class="bouton-lumiere" src="images/ampoule.png" alt="Ampoule"/>
			</a>

		</div>
	</div>

	<a href="index.html" class="logo" ><img src="images/hestia2.png"></a>


	<!-- main -->

	<div id="main">
		<div class="titre">
			<br><h1>CONSOMMATION ENERGETIQUE</h1><br>
		</div>

		<div class="refresh">
			<a id="refresh" href="Consommation">
				<img class="refresh-button" src="images/refresh.png" />
			</a>
		</div>

		<div class="graph">
			<div class="LineChart">
				<div id="curve_chart"></div>
			</div>

			<div class="PiePrice">
				<div class="PieChart">
					<div id="donutchart" ></div>
				</div>
				<div class="Price">

					<h1>Coût total de la consommation sur 30 jours :</h1>
					<br /><br /><br />
					<p><?php echo "~".number_format((($totLum*6*30)+($totCha*48*30)+$totEle*36*30)*0.14, 3)." €";?></p>
					<br /><hr /><br />
					<h2>soit 0,14 € par kW/h</h2>
				</div>
			</div>

		</div>
	</div>
	</html>
