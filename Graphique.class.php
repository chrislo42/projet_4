<?php
/**
 *Création de graphiques avec la librairie GD
 */
class Graphique {
	private $_donnees_x;
	private $_donnees_y;
	private $_name_y;
	private $_max_y;
	private $_min_y;
	private $_moy_y;

	function __construct($instan, $col) {
		if ($col == 1 || $col == 2) {
			$this->_donnees_x = $instan->tri ( 0 );
			$this->_donnees_y = $instan->tri ( $col );
			$this->_max_y = $instan->max ( $col );
			$this->_min_y = $instan->min ( $col );
			$this->_moy_y = $instan->moy ( $col );
			if ($col == 1) {
				$this->_name_y = "Température";
			} else {
				$this->_name_y = "Humidité";
			}
		}
	}
	function afficher($l, $h) {
		$file = "graph_" . $this->_name_y . ".png"; 			// nom  du fichier
		//$time_file = filemtime($file);				// date du fichier
		//if (time()-$time_file > 3600){$this->construire($l,$h);} // si fichier vieux de plus d'heure, un autre est construit
		$this->construire($l,$h);
		echo ("<img src=".$file." />"); 			// retour
	}
	function construire($l, $h) {
		$data_ord = $this->_donnees_y;
		$data_abs = $this->_donnees_x;
		$max_y = $this->_max_y;
		$moy = $this->_moy_y;
		// header ("Content-type: image/png");
		$largeur = $l;
		$hauteur = $h;
		$im = @ImageCreate ( $largeur, $hauteur ) or die ( "Erreur lors de la création de l'image" ); // création image
		$blanc = ImageColorAllocate ( $im, 255, 255, 255 );
		$noir = ImageColorAllocate ( $im, 0, 0, 0 );
		$bleu_fonce = ImageColorAllocate ( $im, 75, 130, 195 );
		$bleu_clair = ImageColorAllocate ( $im, 95, 160, 240 );

		$debut_y = $hauteur - 50; // le bas du graphique
		$plage_y = $debut_y - 30; // la hauteur du graphe
		$debut_x = 40;
		$sum = 0;
		$ind = 0;
		if ($moy * 2 >= $max_y) { $max_ord = $moy * 2; } // echelle des y de 0 à max_ord = soit le max soit 2 fois la moyenne
		else {$max_ord = $max_y;}

		for($i = 0; $i <= $max_ord; $i = $i + ($max_ord / 5)) { // construction de l'axe des ordonnées
			Imagestring ( $im, 2, 7, ($debut_y - $ind - 5), floor ( $i ), $noir ); // valeurs ordonnées
			ImageLine ( $im, 30, ($debut_y - $ind), $largeur - 15, ($debut_y - $ind), $noir ); // lignes des valeurs ordonnées
			$ind = $ind + ($plage_y / 5);
		}
		ImageLine ( $im, 30, $debut_y, 30, $debut_y - $plage_y, $noir ); // ligne des ordonnées

		if ($this->_name_y == "Température"){ // unité des ordonnées
			imagettftext ( $im, 12, 0, 10, 20, $noir, "fonts/verdana.ttf", "°C" );
		}else{
			imagettftext ( $im, 12, 0, 10, 20, $noir, "fonts/verdana.ttf", " %" );
		}
		imagettftext ( $im, 16, 0, 150, 20, $noir, "fonts/verdana.ttf", $this->_name_y . "s enregistrées" ); // titre du graphe

		$prex = 0;								// coordonnées du point précédant
		$prey = 0;
		$posx = 0;								// pour détecter le rapprochement des valeurs
		$date_prev = "";						// pour afficher la date une seule fois
		$index = 0;
		$epais = 2;								// epaisseur du trait de liaison
		$date_deb = new Date ( $data_abs [0] );
		$date_fin = new Date ( $data_abs [(count ( $data_abs ) - 1)] );
		$start = $date_deb->convert ();				 // conversion en seconde
		$echelle = ($date_fin->convert () - $start); // echelle des abscisses
		foreach ( $data_abs as $value ) {
			$date_cur = new Date ( $value );
			$delta_y = ceil ( ((($data_ord [$index]) * $plage_y) / $max_ord) ); 				  // calcul de la valeur y
			$curx = ((($date_cur->convert () - $start) / $echelle) * ($largeur - 65)) + $debut_x; // calcul de la valeur x
			$cury = $debut_y - $delta_y;
			if ($index != 0) {						// pas de liaison sur le premier point
				// ImageLine($im,$prex,$prey,$curx,$cury,$noir); // liaison trait fin entre le point courant et le point précédent
				$coord = array (
						$prex,
						$prey + $epais,
						$curx,
						$cury + $epais,
						$curx,
						$cury - $epais,
						$prex,
						$prey - $epais
				);
				imagefilledpolygon ( $im, $coord, 4, $bleu_fonce ); // liaison trait épais entre le point courant et le point précédent
			}
			imagefilledellipse ( $im, $curx, $cury, 7, 7, $bleu_fonce ); // affichage d'un point

			$cut = strpos ( $data_abs [$index], "_" );					// séparation entre date et heure
			$date = substr ( $data_abs [$index], 0, $cut );				// tri de la date
			$heure = substr ( $data_abs [$index], $cut + 1, 5 );		// tri de l'heure
			if ($curx - $posx > 15) {									// si position trop rapprochée, pas d'affichage
				if ($date_prev != $date) {								// affichage de la date si elle change
					ImageString ( $im, 2, $curx, $hauteur - 15, $date, $noir ); // affichage de la date à l'horizontal
				}
				imagettftext ( $im, 8, 0, $curx, $cury - 10, $noir, "fonts/verdana.ttf", $data_ord [$index] ); // affichage de la valeur du point
				ImageStringup ( $im, 2, $curx, $hauteur - 20, $heure, $noir ); // affichage de l'heure en verticale sans les secondes
				$posx = $curx;											// position du dernier affichage
			}
			$prex = $curx;												// coordonnées du denier point
			$prey = $cury;
			$date_prev = $date;											// actualisation de la variable
			$index ++;
		}
		Imagepng ( $im, "graph_" . $this->_name_y .".png" );			// création de l'image
	}
}

?>
