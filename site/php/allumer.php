<?php
function changernom() {
	$base = mysqli_connect("localhost", "root", "", "hestiadb"); 
	
	//Salon
	$sql_salon="SELECT `Etat` FROM `lumière` WHERE `lumière`.`IdLumière` = 1";
	$resultat_salon = mysqli_query($base,$sql_salon);
	if ($resultat_salon == TRUE) { 
		while ($ligne_salon = mysqli_fetch_assoc($resultat_salon)) { 
			if( $ligne_salon['Etat']==0){	
				$sql_salon_allumer = "UPDATE `lumière` SET `Etat` = '1' WHERE `lumière`.`IdLumière` = 1";
				$resultat_salon_allumer = mysqli_query($base,$sql_salon_allumer);
				echo '<script type=\"text/javascript\">document.getElementById("nom").value="Eteindre" </script>' ; 					
			} 
			else {
				$sql_salon_eteindre= "UPDATE `lumière` SET `Etat` = '0' WHERE `lumière`.`IdLumière` = 1";
				$resultat_salon_eteindre= mysqli_query($base,$sql_salon_eteindre);
				echo '<script type=\"text/javascript\">document.getElementById("nom").value="Allumer" </script>'  ; 
			}
		}
	}
}	
?>