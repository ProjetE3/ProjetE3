<?php 
			
	$base = mysqli_connect("localhost", "root","","hestiadb");
	if ($base) { 
		$sql="SELECT `TempPièce` FROM `pièce` WHERE `pièce`.`IdPièce` = 1";
		$resultat = mysqli_query($base,$sql);
		if ($resultat == FALSE) { 
			echo "Echec de l exécution de la requête.<br />"; 
		} 
		else { 
			while ($ligne = mysqli_fetch_assoc($resultat)) { 
				echo "".$ligne['TempPièce']." &#176 C";
			} 
		}
	} 
	mysql_close ();
	
	?>