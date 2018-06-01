<?php 
function valeur() {
		$base = mysqli_connect("localhost", "root","","hestiadb");
			if ($base) { 
				$sql="SELECT `Etat` FROM `lumière` WHERE `lumière`.`IdLumière` = 1";
				$resultat = mysqli_query($base,$sql);
				if ($resultat == TRUE) { 
					while ($ligne = mysqli_fetch_assoc($resultat)) { 
						if( $ligne['Etat']==0){
							echo "Allumer";
						}
						else {
							echo "Eteindre";
						}
					} 
				}
		   } 
}
		?>	