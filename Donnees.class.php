<?php
/**
 * manipulation des données sauvegardées par le capteur DHT11 relié au NodeMCU
 * au format date, température, humidité séparées par ";"
 */
class Donnees{

  private $_valeurs;

  function __construct($donnees){
      if (is_array($donnees)) {
        $this->_valeurs = $donnees;
      }else{
        echo ("mauvais paramètre< br />");
      }

  }
  
  function getValeurs(){
  	return $this->_valeurs;
  }

  function total_lignes(){
      return count($this->_valeurs);
  }

  function tri($col){						// renvoie la colonne température ou humidité
      if (is_int($col) && $col >= 0 && $col <3){
        $colonnes = array();
        foreach ($this->_valeurs as $value) {
          $list = explode(";",$value);
          $colonnes[] = $list[$col];
        }
        return $colonnes;
      }else{
        echo("mauvais paramètres<br />");
      }
  }

  function moy($col){
    $champ = $this->tri($col);
    $total = 0;
    foreach ($champ as $value) {
      $total += $value;
    }
    $moy = $total / $this->total_lignes();
    $moy = round($moy,1);					// une seule décimale
    return $moy;
  }

  function min($col){
    $champ = $this->tri($col);
//    $min = $champ[0];
//    foreach ($champ as $value) {
//      if ($value < $min){ $min = $value;}
//    }
    return min($champ);
  }

  function max($col){
    $champ = $this->tri($col);
//    $max = 0;
//    foreach ($champ as $value) {
//      if ($value > $max){ $max = $value;}
//    }
    return max($champ);
  }

  function last($numb){
    return array_slice($this->_valeurs,"-".$numb); // prends les $numb dernieres valeurs
  }

}


?>
