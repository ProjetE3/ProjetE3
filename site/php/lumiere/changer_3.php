<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
$rep=$bdd->query('SELECT Etat FROM lumiere WHERE IdPiece=3');
while($i=$rep->fetch()){
	if ($i['Etat']==0){$bdd->exec('UPDATE lumiere SET Etat = 1 WHERE IdPiece=3');}
	else{$bdd->exec('UPDATE lumiere SET Etat = 0 WHERE IdPiece=3');}
}
$rep->closeCursor();

header('Location: ../../lumiere.php');
?>
