<?php
/**
 *
 */
class Date {
	
	private $_year;
	private $_month;
	private $_day;
	private $_hour;
	private $_minutes;
	private $_seconds;
	
	function __construct($date) {
		$table = date_parse ( $date );
		$this->_year = $table ['year'];
		$this->_month = $table ['month'];
		$this->_day = $table ['day'];
		$this->_hour = $table ['hour'];
		$this->_minutes = $table ['minute'];
		$this->_seconds = $table ['second'];
	}
	
	function trans(){				// pour changer de format d'affichage de la date
		$date = $this->_year."/".$this->_month."/".$this->_day." ".$this->_hour.":".$this->_minutes.":".$this->_seconds;
		return ($date);
	}
	
	function convert() {			// conversion de la date en seconde à partir de début 2016
		$time = $this->_seconds + ($this->_minutes * 60) + ($this->_hour * 3600) + ($this->_day * 3600 * 24);
		switch ($this->_month) {
			case '1' :
				$jours = 0;
				break;
			case '2' :
				$jours = 31;
				break;
			case '3' :
				$jours = 31+28;
				break;
			case '4' :
				$jours = 31+28+31;
				break;
			case '5' :
				$jours = 31+28+31+30;
				break;
			case '6' :
				$jours = 31+28+31+30+31;
				break;
			case '7' :
				$jours = 31+28+31+30+31+30;
				break;
			case '8' :
				$jours = 31+28+31+30+31+30+31;
				break;
			case '9' :
				$jours = 31+28+31+30+31+30+31+31;
				break;
			case '10' :
				$jours = 31+28+31+30+31+30+31+31+30;
				break;
			case '11' :
				$jours = 31+28+31+30+31+30+31+31+30+31;
				break;
			case '12' :
				$jours = 31+28+31+30+31+30+31+31+30+31+30;
				break;
			default :
				$jours = 31;
				break;
		}
		$time = $time + ($jours * 3600 * 24);	// ajout des mois écoulés
		$annees = $this->_year - 2016;
		if ($annees != 0){						// pour les générations futures ;P
			for ($i = 1 ;$i <= $annees; $i++) {
				$time = $time + (3600 * 24 * 365);
			}
		}
		return ($time);
	}
}

?>
