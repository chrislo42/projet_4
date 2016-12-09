<style>
table{
	border: 2px solid black;
	float: right;
}
td{
	text-align: center;
}
</style>

<?php
//
//	PHP d'essai des différentes classes
//
require('Fichier.class.php');
require('Donnees.class.php');
require('Graphique.class.php');
require('Date.class.php');
require('Tableau.class.php');

$date1 = new Date("29-11-2016_09:46.46");
echo("conversion : ".$date1->convert()." ----- ");

$date2 = new Date("29-11-2016_10:51.59");
echo("conversion : ".$date2->convert()." ----- ");

echo("diff : ".($date2->convert()-$date1->convert())."<br />");

$monfichier = new Fichier("","data",".csv");
$mesdatas = $monfichier->lire_array();
echo ("1ere data : ".$mesdatas[0]."<br />");
echo ("<br />");

$mesdonnees = new Donnees($mesdatas);

// conversion du fichier csv pour le graphique dygraph
$data_dyg = "";
foreach ($mesdonnees->getValeurs() as $value) { // chaque ligne
$list = explode(";",$value);					// en tableau
$date_o = new Date($list[0]);					// objet date
$date_n = $date_o->trans();						// transformation du format
$newdata = $date_n.",".$list[1].",".substr($list[2],0,2); // réassemblage de la ligne en excluant le retour à la ligne
$data_dyg .= $newdata.";";						// construction de la chaine avec des ; à la place du /n
}
echo (" donnees converties : <br />".$data_dyg."<br />");
echo ("<br />");



echo ("nombre d'enregistrement : ".$mesdonnees->total_lignes()."<br />");
echo ("<br />");

$montab = new Tableau($mesdonnees->getValeurs());
$montab->tabhtml ();

$variable = $mesdonnees->tri(1);
foreach ($variable as $value) {
  echo ("température : ".$value."<br />");
}

echo ("minimum de température : ".$mesdonnees->min(1)."<br />");
echo ("maximum de température : ".$mesdonnees->max(1)."<br />");
echo ("moyenne de température : ".$mesdonnees->moy(1)."<br />");
echo ("<br />");

echo ("minimum de humidité : ".$mesdonnees->min(2)."<br />");
echo ("maximum de humidité : ".$mesdonnees->max(2)."<br />");
echo ("moyenne de humidité : ".$mesdonnees->moy(2)."<br />");
echo ("<br />");

$troncate = $mesdonnees->last(10);
foreach ($troncate as $value) {
  echo ("ligne : ".$value."<br />");
}

echo(time());
$time = filemtime("graph_Humidité.png");
echo ("file time : ".$time."<br />");

$graphe = new Graphique($mesdonnees,1);
$graphe->afficher(560,300);

$graphe2 = new Graphique($mesdonnees,2);
$graphe2->afficher(560,300);


 ?>
