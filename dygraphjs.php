<script>
   new Dygraph(dygraph, "data_dy.csv",
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
