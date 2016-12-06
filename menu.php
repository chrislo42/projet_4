<?php
	session_start();
	
	require ('Fichier.class.php');
	require ('Donnees.class.php');
	require ('Date.class.php');
	require ('Tableau.class.php');
	require ('Graphique.class.php');

	if (!isset($_SESSION['page'])) { $_SESSION['page'] = "dashboard.php"; }
	if (isset( $_GET['page'] )) { $_SESSION['page'] = $_GET['page']; }
	$choix = substr ( $_SESSION['page'], 0, strpos ( $_SESSION['page'], "." ) );

	$monfichier = new Fichier ( "", "data", ".csv" );
	$mesdatas = $monfichier->lire_array ();
	$entire = new Donnees ( $mesdatas );
	
	if (!isset($_SESSION['nombre'])) { $_SESSION['nombre'] = $entire->total_lignes(); }
	if (isset( $_GET ['nombre']) && $_GET['nombre']!="") { $_SESSION['nombre'] = $_GET ['nombre']; }
	
	$troncate = $entire->last ( $_SESSION['nombre'] );
	$mesdonnees = new Donnees ( $troncate );
	
	if (!isset($_SESSION['list'])) { $_SESSION['list'] = "style1.css"; }
	if (isset( $_GET ['list'] )) { $_SESSION['list'] = $_GET ['list']; }

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Thingspeak by DTA</title>
		<link rel="stylesheet" href="<?php echo $_SESSION['list'];?>"> 
	</head>
	<body>
		<div class="header">
			<div class="title">
				<img src="lib/DTA-small.png" alt="Logo DTA small" />
				<h2><a href="#">Thingspeak by DTA - <?php echo ($choix);?></a></h2>
			</div>
			<div class="form"> 
				<form method="get" action="menu.php" name="mon formulaire">
					<select name="list">
         			   <option value="style1.css" <?php if ($_SESSION['list']=="style1.css"){ echo "selected";}?>>style snow</option>
          			   <option value="style2.css" <?php if ($_SESSION['list']=="style2.css"){ echo "selected";}?>>style sun</option>
        			</select>
					<input name="nombre" type="text" id="nombre" placeholder="nombre d'entrées" value="<?php echo $_SESSION['nombre'];?>"/>
					<input type="submit" value="Appliquer" />
				</form>
			</div>
			<div class="menu">
				<button id="boutonmenu">Menu</button>
				<div class="sousmenu">
					<a href="menu.php?page=dashboard.php">Dashboard</a>
					<a href="menu.php?page=graphiques.php">Graphiques</a>
					<a href="menu.php?page=dygraph.php">Dygraph</a>
					<a href="menu.php?page=infos.php">Informations</a>
				</div>
			</div>
		</div>
		<div class="main">
			<?php 
				include ($_SESSION['page']);
			?>
		</div>
		<div class="footer">
			<p>© 2016 - Design Tech Académie</p>
		</div>
	</body>
</html>

