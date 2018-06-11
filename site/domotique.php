<!DOCTYPE html>
<html>
	<header> 	
	<!-- en-tête de la page -->
	<meta charset="utf-8" />		
	<link rel="stylesheet" href="css/style_nav.css"/>
	<link rel="stylesheet" href="css/style_domotique.css"/>	
	<script src="scripts/nav.js"> </script>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">	
	<title> HESTIA </title>	
	</header>


<!-- NAVIGATION -->
<div id="sideNavigation" class="menu-ouvert">
	<a href="javascript:void(0)" class="bouton-croix" onclick="closeNav()">&times;</a>

	<li><a href="Consommation.php">CONSOMMATION</a>
	<ul >
		<li><a href="Consommation.php#Chauffage">CHAUFFAGE</a></li>
		<li><a href="Consommation.php#Lumière">LUMIÈRE</a></li>
	</ul>
	</li>

	<li><a href="Domotique.php">DOMOTIQUE</a></li>
</div>

<!-- BOUTONS DU MENU -->
<div class="boutons">
	<div class="menu">
  		<a href="#" onclick="openNav()"> 
			<img class="bouton-menu" src="images/menu.png" alt="Menu"/> 

		</a>
	</div>

	<div class="bouton">
		<a id="info" href="informations.php"> 
			<img class="bouton-info" src="images/info.png" alt="Information"/>  
		</a>
		<a id="temperature" href="temperature.php"> 
			<img class="bouton-temperature" src="images/thermometre.png" alt="Thermomètre"/>  
		</a>
		<a id="lumiere" href="lumiere.php"> 
			<img class="bouton-lumiere" src="images/ampoule.png" alt="Ampoule"/> 
		</a>

	</div>
</div>

<a href="index.html" class="logo" ><img src="images/hestia2.png"></a>

<div id="main">
		<div class="titre">
			<br><h1>DOMOTIQUE</h1><br>
		</div>	
		<div class="lumiere">
			<h1> LUMIÈRE <h1>
		</div>
		<div class="chauffage">
			<h1> CHAUFFAGE <h1>
		</div>
	
</div>

</html>