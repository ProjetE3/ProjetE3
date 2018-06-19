<!DOCTYPE html>
<html>
	<header>
	<!-- en-tête de la page -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link rel="stylesheet" href="css/style_nav.css"/>
	<link rel="stylesheet" href="css/style_chauffage.css"/>
	<link rel="stylesheet" href="css/style_maison_chauffage.css"/>
	<script src="scripts/nav.js"> </script>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<title> HESTIA </title>
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
			<img class="bouton-info" src="images/info.png" alt="Information"/>
		</a>
		<a id="temperature" href="Temperature">
			<img class="bouton-temperature" src="images/thermometre-vert.png" alt="Thermometre"/>
		</a>
		<a id="lumiere" href="Lumiere">
			<img class="bouton-lumiere" src="images/ampoule.png" alt="Ampoule"/>
		</a>

	</div>
</div>

<a href="index.html" class="logo" ><img src="images/hestia2.png"></a>

	<div id="main">
		<div class="titre">
			<br><h1>CHAUFFAGE</h1><br>
		</div>



<div id="salon" class="overlay">
	<div class="popup">
		<br><h2>CHAUFFAGE DU SALON</h2>
		<a class="close" href="temperature.php">&times;</a>
		<div class="content">

			<div class="content_haut">

			<div class="allumer_eteindre">
			<h5><?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 1";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==0){
									echo "Eteint";
								}
								else{
									echo "Allumé";
								}

							}
						}
					}
					?></h5> <br>

			<form action="php/temperature/temp.php" method="post">
			<label  class="switch"><input type="submit" >
			<input  type="checkbox" id="check1"
				<?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 1";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==1){
									echo "checked";
									$test=1;
								}
								else{
									echo "";
									$test=0;
								}
							}
						}
					}
					?>
				> </input>
			</input>

  			<span class="slider round"></span>
			</label>
			</form>
			</div>


			<div class="temperature_piece" >
				<h5> Température du salon </h5><br>
				<h4>
				<?php

				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 1";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempPiece']." &#176 C";
						}
					}
				}

				?>
				</h4>

			</div>

			</div>


			<div id="nouvelle_temperature" <?php if($test==0){echo 'style="visibility:hidden"';}?>>
				<h5> Température de consigne  </h5><br>
			<form action="php/temperature/temp_1.php" method="post">
			<h4>

			<input type="submit" class="fleche" name="moins" class="previous rond" value="&#8249;" />

				<?php


				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempChauff` FROM `chauffage` WHERE `chauffage`.`IdPiece` = 1";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempChauff']." &#176 C ";
						}
					}
				}
				?>

			<input type="submit" class="fleche" name="plus" class="next rond" value="&#8250;" />
			</h4>
			</form>
			</div>


		</div>
	</div>
</div>

<div id="chambre" class="overlay">
	<div class="popup">
		<br><h2>CHAUFFAGE DE LA CHAMBRE</h2>
		<a class="close" href="temperature.php">&times;</a>
		<div class="content">

			<div class="content_haut">

			<div class="allumer_eteindre">
			<h5><?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 2";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==0){
									echo "Eteint";
								}
								else{
									echo "Allumé";
								}

							}
						}
					}
					?></h5> <br>
			<label class="switch"><form action="php/temperature/temp2.php" method="post">
			<input type="submit">
			<input type="checkbox"
				<?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 2";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==1){
									echo "checked";
									$test=1;
								}
								else{
									echo "";
									$test=0;
								}

							}
						}
					}
					?>
				> </input></input>

  			<span class="slider round"></span>

			</label>
			</form>
			</div>


			<div class="temperature_piece" >
				<h5> Température de la chambre</h5><br>
				<h4>
				<?php

				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 2";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempPiece']." &#176 C";
						}
					}
				}

				?>
				</h4>

			</div>

			</div>

			<div id="nouvelle_temperature" <?php if($test==0){echo 'style="visibility:hidden"';}?>>
				<h5> Température de consigne </h5><br>

			<form action="php/temperature/temp_2.php" method="post">
			<h4>
			<input type="submit" class="fleche" name="moins2" class="previous rond" value="&#8249;" />

				<?php


				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempChauff` FROM `chauffage` WHERE `chauffage`.`IdPiece` = 2";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempChauff']." &#176 C ";
						}
					}
				}
				?>
			<input type="submit" class="fleche" name="plus2" class="next rond" value="&#8250;" />
			</h4>
			</form>
			</div>

		</div>
	</div>
</div>

<div id="cuisine" class="overlay">
	<div class="popup">
		<br><h2>CHAUFFAGE DE LA CUISINE</h2>
		<a class="close" href="temperature.php">&times;</a>
		<div class="content">

			<div class="content_haut">

			<div class="allumer_eteindre">
			<h5><?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 3";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==0){
									echo "Eteint";
								}
								else{
									echo "Allumé";
								}

							}
						}
					}
					?></h5> <br>
			<label class="switch"><form action="php/temperature/temp3.php" method="post">
			<input type="submit">
			<input type="checkbox"
				<?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage` WHERE `chauffage`.`IdChauffage` = 3";
						$resultat = mysqli_query($base,$sql);
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if( $ligne['Etat']==1){
									echo "checked";
									$test=1;
								}
								else{
									echo "";
									$test=0;
								}

							}
						}
					}
					?>
				> </input></input>

  			<span class="slider round"></span>

			</label>
			</form>
			</div>


			<div class="temperature_piece" >
				<h5> Température de la cuisine</h5><br>
				<h4>
				<?php

				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 2";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempPiece']." &#176 C";
						}
					}
				}

				?>
				</h4>

			</div>

			</div>

			<div id="nouvelle_temperature" <?php if($test==0){echo 'style="visibility:hidden"';}?>>
				<h5> Température de consigne  </h5><br>

			<form action="php/temperature/temp_3.php" method="post">

			<h4>
			<input type="submit" class="fleche" name="moins3" class="previous rond" value="&#8249;" />

				<?php


				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempChauff` FROM `chauffage` WHERE `chauffage`.`IdPiece` = 3";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempChauff']." &#176 C ";
						}
					}
				}
				?>

			<input type="submit" class="fleche" name="plus3" class="next rond" value="&#8250;" />
			</h4>
			</form>
			</div>

		</div>
	</div>
</div>

<div class="milieu">
		<div class="map_image">


<svg
     version="1.1"
     baseProfile="full"
     xmlns="http://www.w3.org/2000/svg"
     xmlns:xlink="http://www.w3.org/1999/xlink"
     xmlns:ev="http://www.w3.org/2001/xml-events"
     x="0px"
     y="0px"
     width=217%
     height=217%
     viewBox="0 0 1059 753"
     >

<g style="stroke-linejoin:miter;stroke-dashoffset:0;stroke-dasharray:none;stroke-width:1;stroke-miterlimit:10;stroke-linecap:square;">
<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="fill-opacity:1;fill-rule:nonzero;stroke:none;fill:#808080;">
  <path d="M 519.8021850585938 2.1009974479675293 L 519.8019409179688 737.6012573242188 L 2.302337646484375 737.6012573242188 L 2.302337646484375 2.3511195182800293 L 2.302337646484375 2.1009974479675293 z"/>

	<foreignobject x=20% y=40% width=50% height=150%>
	<a class="button" href="#salon">SALON</a>
	<h6><br>
	<?php

		$base = mysqli_connect("localhost", "root","","hestiadb");
		if ($base) {
			$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 1";
			$resultat = mysqli_query($base,$sql);
			if ($resultat == TRUE) {
				while ($ligne = mysqli_fetch_assoc($resultat)) {
					echo "".$ligne['TempPiece']." &#176 C ";
				}
			}
		}
		?>
	</h6>
	</foreignobject>

  </g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="stroke-width:1.5;fill:none;stroke-opacity:1;stroke:#000000;">
  <path d="M 519.8021850585938 2.1009974479675293 L 519.8019409179688 737.6012573242188 L 2.302337646484375 737.6012573242188 L 2.302337646484375 2.3511195182800293 L 2.302337646484375 2.1009974479675293 z"/>
</g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="fill-opacity:1;fill-rule:nonzero;stroke:none;fill:#808080;">
  <path d="M 1044.8023681640625 2.10101318359375 L 1044.8023681640625 369.60101318359375 L 527.3023681640625 369.60101318359375 L 527.3023681640625 2.10101318359375 z"/>

	<foreignobject x=67% y=15% width=147% height=150%>
	<a class="button" href="#chambre">CHAMBRE</a>
	<h6><br>
	<?php
		$base = mysqli_connect("localhost", "root","","hestiadb");
		if ($base) {
			$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 2";
			$resultat = mysqli_query($base,$sql);
			if ($resultat == TRUE) {
				while ($ligne = mysqli_fetch_assoc($resultat)) {
					echo "".$ligne['TempPiece']." &#176 C ";
				}
			}
		}
		?>
	</h6>
	</foreignobject>

</g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="stroke-width:1.5;fill:none;stroke-opacity:1;stroke:#000000;">
  <path d="M 1044.8023681640625 2.10101318359375 L 1044.8023681640625 369.60101318359375 L 527.3023681640625 369.60101318359375 L 527.3023681640625 2.10101318359375 z"/>
</g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="fill-opacity:1;fill-rule:nonzero;stroke:none;fill:#808080;">
  <path d="M 1044.8023681640625 377.10101318359375 L 1044.8023681640625 737.6010131835938 L 527.3023071289062 737.60107421875 L 527.3023071289062 377.10101318359375 z"/>
	<foreignobject x=68% y=63% width=147% height=150%>
	<a class="button" href="#cuisine">CUISINE</a>
	<h6><br>
	<?php
		$base = mysqli_connect("localhost", "root","","hestiadb");
		if ($base) {
			$sql="SELECT `TempPiece` FROM `piece` WHERE `piece`.`IdPiece` = 3";
			$resultat = mysqli_query($base,$sql);
			if ($resultat == TRUE) {
				while ($ligne = mysqli_fetch_assoc($resultat)) {
					echo "".$ligne['TempPiece']." &#176 C ";
				}
			}
		}
		?>
	</h6>
	</foreignobject>

</g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="stroke-width:1.5;fill:none;stroke-opacity:1;stroke:#000000;">
  <path d="M 1044.8023681640625 377.10101318359375 L 1044.8023681640625 737.6010131835938 L 527.3023071289062 737.60107421875 L 527.3023071289062 377.10101318359375 z"/>
</g> <!-- drawing style -->
</g> <!-- transform -->

<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<clipPath id="clip1">
  <path d="M 1044.8023681640625 2.10101318359375 L 1044.8023681640625 369.60101318359375 L 527.3023681640625 369.60101318359375 L 527.3023681640625 2.10101318359375 z M 1044.8023681640625 377.10101318359375 L 1044.8023681640625 737.6010131835938 L 527.3023082963191 737.6010737796552 L 527.3023077508577 737.6010737796552 L 527.302367542101 377.10101318359375 z M 519.8023681640625 2.10101318359375 L 519.8023681640625 373.35101318359375 L 519.8023077508576 737.6010746578588 L 519.8023085008633 737.6010746578588 L 2.3023529052734375 737.6011352539062 L 2.3023529052734375 2.35113525390625 L 2.3023529052734375 2.10101318359375 z M -5.1976470947265625 -5.64886474609375 L -5.1976470947265625 2.35113525390625 L -5.1976470947265625 745.1011352539062 L 523.5523681640625 745.10107421875 L 1052.3023681640625 745.1010131835938 L 1052.3023681640625 373.35101318359375 L 1052.3023681640625 -5.39898681640625 L 2.3023529052734375 -5.39898681640625 L 2.3023529052734375 -5.64886474609375 z"/>
</clipPath>
<g clip-path="url(#clip1)">
<g transform="matrix(1, 0, 0, 1, -5, -5)">
<image x="0" y="0" width="1059" height="752" xlink:href="data:image/PNG;base64,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
3RmMUQEAp2GhGQCAqhmyuzMYowIATsLC6DUAUDVDGncGXzkAgFZYGL0GAIbZ0PtpT2EBAOyqIkav
AYBGMzhGAABXwiJGrwGARjM4RgAAV8IiRq8BgEYzjI4RMUYFACxhEaPXAECjGco7gzEqAOBjW2gG
AGAbDFnvDMaoAIBpWGgGAKBqhjzdGYxRAQCTsNAMAEDVDHm7MxijAgBOw0IzAABVM2R3ZzBGBQCc
hIXRawCgaoY07gy+cgAArbAweg0ADLOh99OewgIA2FVFjF4DAI1mcIwAAK6ERYxeAwCNZnCMAACu
hEWMXgMAjWYYHSNijAoAWMIiRq8BgEYzlHcGY1QAwMe20AwAwDYYst4ZjFEBANOw0AwAQNUMeboz
GKMCACZhoRkAgKoZ8nZnMEYFAJyGhWYAAKpmyO7OYIwKADgJC6PXAEDVDGncGXzlAABaYWH0GgAY
ZkPvpz2FBQCwq4oYvQYAGs1wfIzY/asV3nnnnXfeeeedd95555133nnnnXcn77oXC38477zzzjvv
vPPOO++8884777zz7ta7/THCH84777zzzjvvvPPOO++8884777y7+W57jPCH884777zzzjvvvPPO
O++88847726/a41R+cN555133nnnnXfeeeedd9555513t949HiP84bzzzjvvvPPOO++8884777zz
zrufevfXMcIfzjvvvPPOO++8884777zzzjvvvPvJd38cI/xBvPPOO++867zzq9kAAAAAAAD87/wD
LzyYeY+l+YMAAAAASUVORK5CYII="/>
</g> <!-- transform -->
</g> <!-- clip1 -->
</g> <!-- transform -->
<g transform="matrix(1, 0, 0, 1, 5.9476470947265625, 6.39886474609375)">
<g style="stroke-width:1.5;fill:none;stroke-opacity:1;stroke:#000000;">
  <path d="M 1044.8023681640625 2.10101318359375 L 1044.8023681640625 369.60101318359375 L 527.3023681640625 369.60101318359375 L 527.3023681640625 2.10101318359375 z M 1044.8023681640625 377.10101318359375 L 1044.8023681640625 737.6010131835938 L 527.3023082963191 737.6010737796552 L 527.3023077508577 737.6010737796552 L 527.302367542101 377.10101318359375 z M 519.8023681640625 2.10101318359375 L 519.8023681640625 373.35101318359375 L 519.8023077508576 737.6010746578588 L 519.8023085008633 737.6010746578588 L 2.3023529052734375 737.6011352539062 L 2.3023529052734375 2.35113525390625 L 2.3023529052734375 2.10101318359375 z M -5.1976470947265625 -5.64886474609375 L -5.1976470947265625 2.35113525390625 L -5.1976470947265625 745.1011352539062 L 523.5523681640625 745.10107421875 L 1052.3023681640625 745.1010131835938 L 1052.3023681640625 373.35101318359375 L 1052.3023681640625 -5.39898681640625 L 2.3023529052734375 -5.39898681640625 L 2.3023529052734375 -5.64886474609375 z"/>
</g> <!-- drawing style -->
</g> <!-- transform -->
</g> <!-- default stroke -->
</svg> <!-- bounding box -->
		</div>
	</div>

	<div class="droite">

		<div class="tout">
			<h4>   Contrôle </h4><br>
			 <form action="php/temperature/temp4.php" method="post">
				<br>
				<button type="submit" class="bouton-tout" id="tout-eteindre" name="tout-eteindre"  value=""
				<?php
					$base = mysqli_connect("localhost", "root","","hestiadb");
					if ($base) {
						$sql="SELECT `Etat` FROM `chauffage`";
						$resultat = mysqli_query($base,$sql);
						$i=0;
						if ($resultat == TRUE) {
							while ($ligne = mysqli_fetch_assoc($resultat)) {
								if($i==0){
									$i1=$ligne['Etat'];
									$i++;
								}else if($i==1){
									$i2=$ligne['Etat'];
								$i++;}
							else{$i3=$ligne['Etat'];}
							}
						}
					}
						if($i1==0 && $i1==$i2 && $i2==$i3){
							$i=0;
							echo "disabled";
						}else if($i1==1 && $i1==$i2 && $i2==$i3){
							$i=1;
						}else{
							$i=2;
						}
					?>
				/></button><h3 id="texte-tout">Tout éteindre</h3>
				<br>
				<button type="submit" id="tout-allumer" class="bouton-tout" name="tout-allumer"  value=""
				<?php
					if($i==1){echo "disabled";}
					?>
			    /> </button><h3 id="texte-tout">Tout allumer </h3> <br><br>

				<div class="tout-allumer-disclosure">

				<div class="col-3 input-effect">
					<input class="effect-20" type="number" name="degres" min="0" max="30" placeholder="">
					<label>Température de consigne </label>
					<span class="focus-border"> <i></i> </span>
				</div> <h3 id="texte-degre">  &#176 C<h3>
					<br>
					<input type="submit" name="submit" class="btn" value="Modifier"><br> <br>
				</div>
			</form>

		</div>
	</div>
	</div>
	</div>


<div id="footer">
	<div id="footer_gauche">
		<br><br>
		<h3> Température extérieure </h3><br>
		<h4>
			<?php
				$base = mysqli_connect("localhost", "root","","hestiadb");
				if ($base) {
					$sql="SELECT `TempExt` FROM `maison`";
					$resultat = mysqli_query($base,$sql);
					if ($resultat == TRUE) {
						while ($ligne = mysqli_fetch_assoc($resultat)) {
							echo "".$ligne['TempExt']." &#176 C ";
						}
					}
				}
			?>
		</h4>
	</div>
</div>


</html>
