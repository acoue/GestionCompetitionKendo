<?php
require_once 'Config/Configuration.php';
require_once 'Config/fonction.php';
require_once 'Config/Securite.php';
?>
<p>Comp&eacute;tition s&eacute;lectionn&eacute;e pour la gestion : </p>
<?php 
if(!empty($competition)) {
	echo "<p><h1>".$competition["libelle"]."</h1></p>";
	echo "<p>Date : ".dateFR($competition["datecompetition"])."</p>";
	echo "<p>Lieux : ".$competition["lieux"]."</p>";
	echo "<p>".$competition["description"]."</p>";
} else echo "<p>Aucune comp&eacute;tition s&eacute;lectionn&eacute;e</p>";
?>