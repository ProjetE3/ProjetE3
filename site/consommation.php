<!DOCTYPE html>
<html>
	<header>
	<!-- en-t�te de la page -->
	<meta charset="utf-8" />
	<link rel="stylesheet" href="css/style_nav.css"/>
  <link rel="stylesheet" href="css/style_consommation.css"/>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <script src="scripts/nav.js"> </script>
	<title> HESTIA </title>
	</header>

  <!-- NAVIGATION -->
  <div id="sideNavigation" class="menu-ouvert">
  	<a href="javascript:void(0)" class="bouton-croix" onclick="closeNav()">&times;</a>

  	<li><a href="Consommation.php">CONSOMMATION</a>
  	<ul >
  		<li><a href="Consommation.html#Chauffage">CHAUFFAGE</a></li>
  		<li><a href="Consommation.html#Lumi�re">LUMI�RE</a></li>
  	</ul>
  	</li>

  	<li><a href="Domotique.html">DOMOTIQUE</a></li>
  </div>

  <!-- BOUTONS DU MENU -->
  <div class="boutons">
  	<div class="menu">
    		<a href="#" onclick="openNav()">
  			<img class="bouton-menu" src="images/menu.png" alt="Menu"/>

  		</a>
  	</div>

  	<div class="bouton">
  		<a id="info" href="information.html">
  			<img class="bouton-info" src="images/info.png" alt="Information"/>
  		</a>
  		<a id="temperature" href="temperature.php">
  			<img class="bouton-temperature" src="images/thermometre.png" alt="Thermom�tre"/>
  		</a>
  		<a id="lumiere" href="lumiere.php">
  			<img class="bouton-lumiere" src="images/ampoule.png" alt="Ampoule"/>
  		</a>

  	</div>
  </div>

  <a href="index.html" class="logo" ><img src="images/hestia2.png"></a>

  <!-- main -->
  	<div id="main">
  		<div class="titre">
  			<br><h1>CONSOMMATION DU CHAUFFAGE</h1><br>
      </div>
      <div class="graph">
        <?php
          echo "<img src='graph1.php'/>";
        ?>
  		</div>
    </div>


</html>
