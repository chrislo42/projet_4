<?php 
	$mesdatas = "Date,Temperature\n".
		"2008-05-06,75\n".
  		"2008-05-07,72\n".
  		"2008-05-08,70\n".
  		"2008-05-09,80\n";
	echo ($mesdatas);
?>
<script>
  var chaine = '<?php echo ($mesdatas);?>';
  var chaine = "Date,Temperature\n" +
  "2008-05-06,75\n" +
  "2008-05-07,72\n" +  
  "2008-05-08,70\n" +
  "2008-05-09,80\n";
  new Dygraph(dygraph, 
		  chaine,
		  {
    title: 'Température et Humidité',
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
