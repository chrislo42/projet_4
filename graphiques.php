       <div class="temp-h">
          <?php
            $graphe = new Graphique($mesdonnees,1);
            $graphe->afficher(500,275);
          ?>
        </div>
        <div class="hum-h">
          <?php
            $graphe2 = new Graphique($mesdonnees,2);
            $graphe2->afficher(500,275);
          ?>
        </div>
 