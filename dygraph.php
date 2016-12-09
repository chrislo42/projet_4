     <div class="main" id="dygraph-area">
     	<script src="lib/dygraph-combined.js"></script>
        <table id="dygraph-table">
          <tr>
            <td>
              <div id="legend"></div>
              <div id="donnees">
                <?php
                  echo ("<br>");
                  echo ("nombre d'enregistrements : ".$mesdonnees->total_lignes()."<br />");
                  echo ("<br>");
                  echo ("<p>température minimale: ".$mesdonnees->min(1)."</p>");
                  echo ("<p>température maximale: ".$mesdonnees->max(1)."</p>");
                  echo ("<p>température moyenne: ".$mesdonnees->moy(1)."</p>");
                  echo ("<br>");
                  echo ("<p>taux minimum d'humidité : ".$mesdonnees->min(2)."</p>");
                  echo ("<p>taux maximum d'humidité : ".$mesdonnees->max(2)."</p>");
                  echo ("<p>taux d'humidité moyen: ".$mesdonnees->moy(2)."</p>");
                ?>
              </div>
            </td>
            <td><div id="dygraph"></div></td>
          </tr>
        </table>
        <?php 
        	include('dygraphjs.php');
        ?>
      </div>
 