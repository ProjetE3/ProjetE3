<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



if (isset($_POST['moins'])) {
	$rep=$bdd->query('UPDATE `chauffage` SET `TempChauff` = `TempChauff` - 1 WHERE `chauffage`.`IdPiece` = 1');

}
elseif ( isset($_POST['plus'])) {
	$rep=$bdd->query('UPDATE `chauffage` SET `TempChauff` = `TempChauff` + 1 WHERE `chauffage`.`IdPiece` = 1');

}

header('Location: ../../temperature.php#salon');
?>
