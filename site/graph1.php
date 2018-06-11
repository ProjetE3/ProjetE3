<?php // content="text/plain; charset=utf-8"
require_once ('jpgraph/src/jpgraph.php');
require_once ('jpgraph/src/jpgraph_line.php');


// Constantes (connection mysql)
define('MYSQL_HOST', 'localhost');
define('MYSQL_USER', 'root');
define('MYSQL_PASS', '');
define('MYSQL_DATABASE', 'hestiadb');

//donnée sur la ligne
$dataMois = array();
$dataEnergie = array();
$jours = array='1', '2','3','4','5','6','7','8','9','10','11','12','13','14','15','16',
 '17','18','19','20','21','22','23','24','25','26','27','28','29','30','31');

// ********************************************************************
// PARTIE : Production des données avec Mysql
// ********************************************************************

$sql = <<<EOF
	SELECT
		DAY(`DateHeureMinute`) AS Jour,
		SUM(EnerCons) AS Energie_consomme
	FROM `energie`
  WHERE IdLumière IS NOT NULL
	GROUP BY DAY(`DateHeureMinute`)
EOF;

// Connexion à la BDD
$mysqlCnx = @mysql_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS) or die('Pb de connxion mysql');

// Sélection de la base de données
@mysql_select_db(MYSQL_DATABASE) or die('Pb de sélection de la base');

//Initialiser le tableau à 0 pour chaques jours
$dataJours = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);

// Requête
$mysqlQuery = @mysql_query($sql, $mysqlCnx) or die('Pb de requête');

// Fetch sur chaque enregistrement
while ($row = mysql_fetch_array($mysqlQuery,  MYSQL_ASSOC)) {
	// Alimentation des tableaux de données
	$dataJours[$rows['Jour']-1]=$rows['Energie_consomme'];
}


// Taille du graphe
$graph = new Graph(1000,250);
// Fixer les marges
$graph->img->SetMargin(40,30,50,40);


// Lissage sur fond blanc (évite la pixellisation)
$graph->img->SetAntiAliasing("white");

// A détailler
$graph->SetScale("textlin");

// Ajouter une ombre
$graph->SetShadow();

// Ajouter le titre du graphique
$graph->title->Set("Graphique 'courbes' : volume des ventes 2006");

// Afficher la grille de l'axe des ordonnées
$graph->ygrid->Show();
// Fixer la couleur de l'axe (bleu avec transparence : @0.7)
$graph->ygrid->SetColor('blue@0.7');
// Des tirets pour les lignes
$graph->ygrid->SetLineStyle('dashed');

// Afficher la grille de l'axe des abscisses
$graph->xgrid->Show();
// Fixer la couleur de l'axe (rouge avec transparence : @0.7)
$graph->xgrid->SetColor('red@0.7');
// Des tirets pour les lignes
$graph->xgrid->SetLineStyle('dashed');

// Apparence de la police
$graph->title->SetFont(FF_ARIAL,FS_BOLD,11);

// Créer une courbes
$courbe = new LinePlot($dataJours);

// Afficher les valeurs pour chaque point
$courbe->value->Show();

// Valeurs: Apparence de la police
$courbe->value->SetFont(FF_ARIAL,FS_NORMAL,9);
$courbe->value->SetFormat('%d');
$courbe->value->SetColor("red");

// Chaque point de la courbe ****
// Type de point
$courbe->mark->SetType(MARK_FILLEDCIRCLE);
// Couleur de remplissage
$courbe->mark->SetFillColor("green");
// Taille
$courbe->mark->SetWidth(5);

// Couleur de la courbe
$courbe->SetColor("blue");
$courbe->SetCenter();

// Paramétrage des axes
$graph->xaxis->title->Set("jours");
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->SetTickLabels($jours);

// Ajouter la courbe au conteneur
$graph->Add($courbe);
$graph->legend->SetFrameWeight(1);
$graph->Stroke();
?>
