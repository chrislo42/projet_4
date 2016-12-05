     <div class="main" id="dygraph-area">
     	<script src="lib/dygraph-combined.js"></script>
        <table id="dygraph-table">
          <tr>
            <td>
              <div id="legend"></div>
              <div id="donnees">
                <?php
                  echo ("<br>");
                  echo ("nombre d'enregistrements : ".$entire->total_lignes()."<br />");
                  echo ("<br>");
                  echo ("<p>température minimale: ".$entire->min(1)."</p>");
                  echo ("<p>température maximale: ".$entire->max(1)."</p>");
                  echo ("<p>température moyenne: ".$entire->moy(1)."</p>");
                  echo ("<br>");
                  echo ("<p>taux minimum d'humidité : ".$entire->min(2)."</p>");
                  echo ("<p>taux maximum d'humidité : ".$entire->max(2)."</p>");
                  echo ("<p>taux d'humidité moyen: ".$entire->moy(2)."</p>");
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
 