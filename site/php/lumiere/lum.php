<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}


if(isset($_POST['tout-eteindre'])){
	$rep=$bdd->query('UPDATE `lumiere` SET `Etat` = 0');
}

elseif (isset($_POST['tout-allumer'])) {
	$rep=$bdd->query('UPDATE `lumiere` SET `Etat` = 1');
}

header('Location: ../../lumiere.php');
?>
