<?php 
	
	$data_dy = "";
	foreach ($mesdonnees->getValeurs() as $value) { // chaque ligne
		$list = explode(";",$value);				// en tableau
		$date_o = new Date($list[0]);				// objet date
		$date_n = $date_o->trans();					// transformation du format de la date
		$newdata = $date_n.",".$list[1].",".substr($list[2],0,2); // réassemblage de la ligne en excluant le retour à la ligne
		$data_dy .= $newdata.";";					// construction de la chaine avec des ; à la place du \n
	}
?>

<script type="text/javascript">
var chaine="<?php echo ($data_dy);?>";				// passage de la variable en JS
chaine = chaine.replace(/;/g,"\n");					// remplacement du caractere ; par \n

  new Dygraph(dygraph, 								// le retour à la ligne fait comprendre que le paramètre n'est pas un fichier
		  chaine,
		  {
    title: 'Température et Humidité',				// diverses options
    labelsDiv: document.getElementById('legend'),
    labels : [ "Date", "Température", "Humidité" ],
    labelsDivStyles: { 'textAlign': 'right' },
    labelsDivWidth: 150,
    labelsSeparateLines: true,
    legend: 'always',
    ylabel: 'Température (°C) - Humidité (%)',
    showRoller: false,
    showRangeSelector: true,
    width: 800,
    height: 480
  });
</script>
