     <div class="infos">
        <h1>Cycle 4 : Site web programmé</h1>

        <h4>Présentation du cycle/projet</h4>
        <p class="content">
          Etudiant à la Design Tech Académie, formation labelisée Grande Ecole du Numérique, nous développons un nouveau projet toutes les deux semaines. Lors du précédent cycle au Fablab nous avons utilisé le service <a href="https://thingspeak.com/" target="_blank">Thingspeak</a>, lequel permet d'afficher sur une interface web les données recueillis et envoyés par des capteurs.
          Durant ces 2 semaines, notre "mission" consistait alors à réaliser un projet sur le thème suivant : re-développer Thingspeak par groupes avec récupération des données d'un <a href="https://en.wikipedia.org/wiki/NodeMCU" target="_blank">nodeCMU</a>, enregistrées dans un fichier au format CSV ; et restitution sous forme de tableaux et graphiques, avec choix du style.<br>
          En plus de cela, il nous a été demandé de produire un tutoriel vidéo sur la Programmation Orientée Objet en PHP.
        </p>

        <h4>Appropriation du sujet</h4>
        <p class="content">
          Pour mener à bien ce projet, nous avions pour consignes d'une part d'utiliser <a href="http://php.net/manual/fr/book.image.php" target="_blank">GD</a> pour l'affichage de données sous forme graphique ; d'autre part de le développer en POO. La prise en main de GD étant particulièrement délicate, nous nous sommes mis à la recherche d'une alternative plus agréable à manipuler. <a href="http://dygraphs.com/" target="_blank">Dygraph</a> s'est démarqué par sa simplicité tout en proposant des fonctionnalités intéressantes.
          Concernant les classes, nous avons découpé notre projet suivant différents modules : l'écriture/lecture de fichiers, l'affichage sous forme de tableaux, l'affichage sous forme de graphiques et la manipulation de données pour en faire des statistiques.
          Côté interface, le design se compose d'un header reprenant les informations de la page, un menu (librement adapté de <a href="http://www.w3schools.com/howto/howto_css_dropdown.asp" target="blank">celui-ci</a>), une liste de thèmes et un champ de saisie pour filtrer des valeurs ; tandis que le corps principal du site sert (évidemment !) à afficher les données suivant la sélection du menu et des options proposées.<br>
          Le code source du projet est disponible sur <a href="https://github.com/chrislo42/projet_4" target="_blank">Github</a>, le résultat est visible à <a href="http://164.132.194.239/Projets/projet_4/menu.php" target="_blank">cette adresse</a>.
        </p>


        <h4>Répartition des tâches</h4>
        <p class="content">
          PHP : Christian et Yacine<br>
          User Interface : Julien<br>
          Scénario, production, réalisation et montage du tutoriel POO : Thomas  
        </p>
        <iframe width="560" height="315" src="https://www.youtube.com/embed/BtfQwlfl-rk" frameborder="0" allowfullscreen></iframe>


        <h4>Améliorations</h4>
        <p class="content">
          Conscients que ce travail n'est pas parfait, il y aurait beaucoup de modifications à apporter à ce projet : une refonte de l'interface graphique avec un framework type <a href="http://getbootstrap.com/" target="_blank">Bootstrap</a>, une bibliothèque d'image/graphiques autre que GD, des graphiques plus dynamiques et attrayants grâce à <a href="http://www.chartjs.org/" target="_blank">Chartjs</a> par exemple, une meilleure compatibilité entre les navigateurs, une structuration du projet suivant l'architecture MVC, etc...
        </p>

      </div>
