<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}



if (isset($_POST['moins3'])) {
	$rep=$bdd->query('UPDATE `chauffage` SET `TempChauff` = `TempChauff` - 1 WHERE `chauffage`.`IdPiece` = 3');

}
elseif ( isset($_POST['plus3'])) {
	$rep=$bdd->query('UPDATE `chauffage` SET `TempChauff` = `TempChauff` + 1 WHERE `chauffage`.`IdPiece` = 3');

}

header('Location: ../../temperature.php#cuisine');
?>
