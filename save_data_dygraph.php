<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>save data php</title>
<link rel="stylesheet" href="" />
</head>
<body>
      <?php				// data est transmis par le NodeMCU
						$donnees = $_GET ['data'] . "\n";
						echo ("Données transmises : " . $donnees);
						
						$date_gd = date ( 'd-m-Y_H:i.s' );
						$date_dy = date ( 'Y/m/d H:i:s' );	// ajout pour utiliser la librairie dy_graph
						echo ("<br />" . $date_gd);
						
						
						if ($donnees == "") {
							echo "<br />pas de données";
						} else {
							require ('Fichier.php');
							$donnees_gd = $date_gd . ";" . $donnees;	// concaténation des données
							$donnees = str_replace(";", ",", $donnees); // séparateur virgule pour ce fichier
							$donnees_dy = $date_dy . "," . $donnees;
							$nom = "data";								// nom générique du fichier
							$fichier = new Fichier ( "", $nom, ".csv" );		// création des instances
							$fichier_dy = new Fichier ( "", $nom, "_dy.csv" );
							
							$fichier->ecrire ( $donnees_gd );					// écriture
							$fichier_dy->ecrire ( $donnees_dy );
							
							echo ("<br />Données du fichier : "); 				// lecture d'un fichier
							$tableau = $fichier->lire_array ();
							foreach ( $tableau as $value ) {
								echo ($value . "<br />");
							}
							
							// header("Location: index.php?page=$nom_fichier");
						}
						?>
   </body>
</html>
