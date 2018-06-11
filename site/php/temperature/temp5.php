<?php 

try
{
	$bdd = new PDO('mysql:host=localhost;dbname=hestiadb;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

if(isset($_POST['submit'])){
	echo $_POST['degres'];
	$temp=$_POST['degres'];
	$req=$bdd->query('UPDATE chauffage SET TempChauff = '.$temp);
	
}


;
?>