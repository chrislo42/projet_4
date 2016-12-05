<?php
class Tableau{
	private $_donnees;

	public function __construct($donnees){
		$this->_donnees = $donnees;
	}

	public function tabhtml() {
		$tabl = "<table><tr><th>Date</th><th>Température</th><th>Humidité</th></tr>";

		foreach ( $this->_donnees as $ligne ){
			$tabl .= "<tr>";						// balise de ligne de tableau
			$list = explode( ";", $ligne );			// séparation des données de la ligne
			foreach ( $list as $cellule ){			// inclusion dans les cellules
				$tabl .= "<td>$cellule</td>";
			}
			$tabl .= "</tr>";						// fin de ligne
		}
		$tabl .= "</table>";						// fin de table
		echo $tabl;
	}
}
?>
