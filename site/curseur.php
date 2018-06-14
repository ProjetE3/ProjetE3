<!DOCTYPE html>
<html>
	
	<header> 	
	<!-- en-tête de la page -->
			

	<link rel="stylesheet" href="css/style_curseur.css"/>
	
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet"/>	
	<title> Hestia </title>	
	</header>
	
	
	<input type='range' disabled='disabled' min='0' max='100' step='1' value=
	<?php
		$base = mysqli_connect("localhost", "root","","hestiadb");
			if ($base) { 
				$sql="SELECT `Etat` FROM `lumière` WHERE `lumière`.`IdLumière` = 2";
				$resultat = mysqli_query($base,$sql);
				if ($resultat == TRUE) { 
					while ($ligne = mysqli_fetch_assoc($resultat)) { 
						echo "".$ligne['TempPièce']."";
					} 
				}
		   } 
		?>
/>
 <div class="threshold">
	<div class="threshold-rouge"></div>
	<div class="threshold-orange"></div>
    <div class="threshold-vert"> </div>
</div>
	
	</html>