<div class="tableau">
	<div class="data">
            <?php
				echo ("<p><b>nombre de valeurs : " . $mesdonnees->total_lignes () . "</b></p>");
				echo ("<p></p>");
				echo ("<p></p>");
				echo ("<p>température minimale : " . $mesdonnees->min ( 1 ) . "</p>");
				echo ("<p>température maximale: " . $mesdonnees->max ( 1 ) . "</p>");
				echo ("<p>température moyenne : " . $mesdonnees->moy ( 1 ) . "</p>");
				echo ("<p></p>");
				echo ("<p>taux minimum d'humidité : " . $mesdonnees->min ( 2 ) . "</p>");
				echo ("<p>taux maximum d'humidité : " . $mesdonnees->max ( 2 ) . "</p>");
				echo ("<p>taux d'humidité moyen: " . $mesdonnees->moy ( 2 ) . "</p>");
			?>
    </div>
            <?php
				$montab = new Tableau ( $mesdonnees->getValeurs () );
				$montab->tabhtml ();
			?>
    </div>
<div class="graph">
	<div class="temp-v">
          <?php
				$graphe = new Graphique ( $mesdonnees, 1 );
				$graphe->afficher ( 500, 275 );
			?>
    </div>
	<div class="hum-v">
          <?php
				$graphe2 = new Graphique ( $mesdonnees, 2 );
				$graphe2->afficher ( 500, 275 );
   			?>
    </div>
</div>
