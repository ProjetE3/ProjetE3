<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

$rep=$bdd->query('SELECT Etat FROM chauffage WHERE IdPiece=1');
while($i=$rep->fetch()){
	if ($i['Etat']==0){$bdd->exec('UPDATE chauffage SET Etat = 1 WHERE IdPiece=1');}
	else{$bdd->exec('UPDATE chauffage SET Etat = 0 WHERE IdPiece=1');}
}
$rep->closeCursor();

header('Location: ../../temperature.php#salon');
?>
