<!DOCTYPE html>
<html>
<header>
	<!-- en-t�te de la page -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

	<!-- page css -->
	<link rel="stylesheet" href="css/style_nav.css"/>
	<link rel="stylesheet" href="css/style_informations.css"/>

	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title> Hestia </title>


	<!-- page javascript -->
	<script src="scripts/nav.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<?php
	try{
		$bdd= new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8','root','');}catch(Exception $e){echo "Unable to connect to the database :'('";}

		$chaine='[';$chaine2='[';
		$maxVValue=0;
		$Lum=0;$Cha=0;$Ele=0;
		$totConsMin=0;$totCons=0;
		$i=0;$j=0;
		$totMoySc=0;
		$totConfMin=0;$totConf=0;
		$totLum=0;$totCha=0;$totEle=0;

		$rep=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdLumiere IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdLumiere ASC ORDER BY DateHeureMinute ASC;");
		$rep2=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdChauffage IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdChauffage ASC ORDER BY DateHeureMinute ASC;");
		$rep3=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(EnerCons) AS Energie_consomme FROM (SELECT * FROM energie WHERE IdElectro IS NOT NULL ORDER BY IdEner DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdElectro ASC ORDER BY DateHeureMinute ASC;");
		$rep4=$bdd->query("SELECT DATE_FORMAT(`DateHeureMinute`,'%H:%i') AS Jour, SUM(Score)/60 AS Score_minute, IdPiece FROM (SELECT * FROM scores WHERE IdUtil='admin' ORDER BY IdScore DESC LIMIT 5400) sub GROUP BY MINUTE(DateHeureMinute) ASC, IdPiece ASC ORDER BY DateHeureMinute ASC,IdPiece ASC;");

		if($rep!=FALSE && $rep2!=FALSE && $rep3!=FALSE && $rep4!=FALSE){
			while($data=$rep->fetch()){
				if($data2=$rep2->fetch()){
					if($data3=$rep3->fetch()){
						if($data4=$rep4->fetch()){
						if($i==0){
							$chaine .= '"'.$data['Jour'].'",';
							$chaine2 .= '"'.$data4['Jour'].'",';

							$Lum=$Lum+$data['Energie_consomme'];
							$Cha=$Cha+$data2['Energie_consomme'];
							$Ele=$Ele+$data3['Energie_consomme'];


							$totConsMin=$totConsMin+(($data['Energie_consomme']*6*30)+($data2['Energie_consomme']*48*30)+($data3['Energie_consomme']*36*30));
						  $totConfMin=$totConfMin+($data4['Score_minute']*0.5);


							$i++;
							$j++;
						}
						else if($i<=2){
							$Lum=$Lum+$data['Energie_consomme'];
							$Cha=$Cha+$data2['Energie_consomme'];
							$Ele=$Ele+$data3['Energie_consomme'];

							$totConsMin=$totConsMin+(($data['Energie_consomme']*6*30)+($data2['Energie_consomme']*48*30)+($data3['Energie_consomme']*36*30));
							$totConfMin=$totConfMin+($data4['Score_minute']*0.25);

							$i++;
							if($i==3){

								$totCons=$totCons+$totConsMin;
								$totConsMin=-(100/8500)*12*$totConsMin*30*0.9+((100/8500)*9500)+100;
								$totConf=$totConf+$totConfMin;

								if($totConsMin>100){$totConsMin=100;}
								else if($totConsMin<0){$totConsMin=0;}

								$chaine.=($Lum+$Cha+$Ele).'],[';
								$chaine2.=(0.7*$totConsMin+0.3*$totConfMin).','.$totConsMin.','.$totConfMin.'],[';

								$totLum=$totLum+$Lum;
								$totCha=$totCha+$Cha;
								$totEle=$totEle+$Ele;

								$Lum=0;
								$Cha=0;
								$Ele=0;

								$totConsMin=0;
								$totConfMin=0;

								$i=0;
							}else{

							}
						}
					}
				}
			}
		}
			$rep->closeCursor();$rep2->closeCursor();;$rep3->closeCursor();$rep4->closeCursor();
		}

		$chaine= substr($chaine,0,strlen($chaine)-2);
		$chaine2= substr($chaine2,0,strlen($chaine2)-2);
		if($chaine==NULL){$chaine='[0,1],[31,2]';}



		$totCons=12*$totCons*0.9;
		$sccons=-(100/8500)*$totCons+((100/8500)*9500)+100;
		if($sccons>100){$sccons=100;}
		else if($sccons<0){$sccons=0;}
		$totConf=$totConf/$j;
		?>

		<script type="text/javascript">
		google.charts.load('current', {'packages':['line']});
		google.charts.setOnLoadCallback(drawChart);

		function drawChart() {
			var data = google.visualization.arrayToDataTable([
				['Temps', 'Energie consommée'],<?php echo $chaine;?>
			]);

			var options = {
				//theme : 'material',
				chart: {title: 'Consommation des systemes', subtitle:'en W/h'},
				//curveType:'function',
				width: 1064.42,
				height: 367.5,

				hAxis: {textPosition:'out',format:'dd MMM, y'},
				legend : {position: 'right'},
				vAxis: {minValue:0},
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
				fontName:'Oswald',fontSize:19,
				legend : {textStyle: {fontSize:13}},
				pieSliceTextStyle:{fontSize:15,},
				tooltip:{textStyle:{fontSize:15}},
				pieHole: 0.4,
				height:367.5,
				width:529.516
			};

			var chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
			chart2.draw(data2, options2);

		}

		google.charts.load('current', {'packages':['line']});
		google.charts.setOnLoadCallback(drawChart2);

		function drawChart2() {
			var data3 = google.visualization.arrayToDataTable([
				['Temps', 'Score','Score Consommation','Score Confort'],<?php echo $chaine2;?>
			]);

			var options3 = {
				//theme : 'material',
				chart: {title: 'Evolution des scores'},
				//curveType:'function',
				width: 445,
				height: 280,

				hAxis: {textPosition:'out',format:'dd MMM, y'},
				legend : {position: 'right'},
				vAxis: {minValue:0},
				axes:{
					y: {0:{label:'Score'}},
				},

				selectionMode:'single',
				tooltip: {trigger:'focus'},
				agregationTarget:'series',
			};


			var chart = new google.charts.Line(document.getElementById('curve_chart2'));

			chart.draw(data3, options3);
		}
		</script>

</header>



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
			<img class="bouton-info" src="images/info-vert.png" alt="Information" />
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


<!-- MAIN -->

<div id="main">
	<div class="titre"><br><h1>INFORMATION</h1><br></div>
	<div class="refresh">
		<a id="refresh" href="Information">
			<img class="refresh-button" src="images/refresh.png" />
		</a>
	</div>
	<div class="global">
		<div class="BlockScoreAppareil">
			<div class="Scores">
				<div class="BlockScore">
					<div class="textScore">Score</div>
					<div class="score">
						<?php
									$score=intval($sccons*0.7+$totConf*0.3);
									if($score<=33){echo '<font color="#FF4848">'.$score."</font>";}
									else if($score<=66){echo '<font color="#F4A460">'.$score."</font>";}
									else{echo '<font color="#7BD272">'.$score."</font>";}
						?>
					</div>
				</div>
				<div class="scoreBarBlock">
					<div class="CursorCon">
						<div class="scoreBarText">
							Consommation
						</div>
						<div class="scoreBar">
							<br><br>
							<div class="threshold">
								<div class="threshold-rouge"></div>
								<div class="threshold-orange"></div>
								<div class="threshold-vert"> </div>
							</div>
						 <input type='range' disabled='disabled' min='0' max='100' step='1' value=<?php echo '"'.$sccons.'"';?>
							/>
							<br><br>
						</div>
					</div>
					<br><br>
					<div class="CursorCon">
						<div class="scoreBarText">
							Confort
						</div>
						<div class="scoreBar">
							<br><br>
							<div class="threshold">
								<div class="threshold-rouge"></div>
								<div class="threshold-orange"></div>
								<div class="threshold-vert"> </div>
							</div>
							<input type='range' disabled='disabled' min='0' max='100' step='1' value=<?php echo '"'.$totConf.'"';?>
							/>

							<br><br>
						</div>
					</div>

				</div>

			</div>
			<div class="Scores">
				<div class="textAppareil">Evolution</div>
				<div class="graphScores"><div id="curve_chart2" ></div></div>

			</div>

		</div>


		<div class="graphsCourbes">
			<div class="chart_div_conso"><div id="curve_chart" ></div></div>
			<div class="piechart"><div id="donutchart" ></div></div>
			<div class="Price">
				<h1>Coût total de la consommation sur 30 jours :</h1>
			<br /><br /><br />
			<p><?php echo "~".number_format((($totLum*6*30)+($totCha*48*30)+($totEle*36*30))*0.14, 3)." €";?></p>
			<br /><hr /><br />
			<h2>soit 0,14 € par kW/h</h2>
		</div>
		</div>


	</div>
</div>

</html>
