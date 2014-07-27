<?php
require_once 'Config/fonction.php';
?>
<p><h3>R&eacute;sultats des poules</h3></p>
<form>
<p align='center'>
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=resultatPouleSimple&id='+this.options[this.selectedIndex].value;" >
<option value='-1' >--</option>
<?php 
if(!empty($categories)) {
	foreach ($categories as $categorie) {
		if($categorieSelected == $categorie["idcategorie"]) echo "<option value='".$categorie["idcategorie"]."' selected >".$categorie["libelle"]."</option>";
		else echo "<option value='".$categorie["idcategorie"]."' >".$categorie["libelle"]."</option>";
	}
}
?>
</select>
</p>
<?php
if(!empty($licenciesTirage)) {
	echo "<p align='center'>Tirage au sort - R&eacute;partition des Comp&eacute;titeurs</p>";
	echo "<p align='center'><table border='1' style='width: 90%;text-align: center;'>";
	$pouletmp = "";
	foreach ($licenciesTirage as $tirage) {
		
		$club = $tirage[0];
		$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
		$poule = $tirage['numero_poule'];
		$position = $tirage['position_poule'];
		if($pouletmp == "") {
			echo "<tr><td colspan='2' style='background-color: #f18a30; color: white;'>Poule $poule <a href='index.php?action=afficheCombatPouleSimple&poule=".$poule."&categorie=$categorieSelected' target='_self'><img src='img/site/editer.png' border='0'></a></td></tr>";
			echo "<tr><td>$licencie ($club)</td><td>".$tirage["classement"]."</td></tr>";		
		} else {
			if( $poule == $pouletmp ) echo "<tr><td>$licencie ($club)</td><td>".$tirage['classement']."</td></tr>";
			else {
				echo "<tr><td colspan='2' style='background-color: #f18a30; color: white;'>Poule $poule <a href='index.php?action=afficheCombatPouleSimple&poule=".$poule."&categorie=$categorieSelected' target='_self'><img src='img/site/editer.png' border='0'></a></td></tr>";
				echo "<tr><td>$licencie ($club)</td><td>".$tirage["classement"]."</td></tr>";
			}
		}
		$pouletmp = $poule;
		
	}
	echo "</table></p>";
} else {
	echo "<p>Pas de tirage au sort effectu&eacute; pour cette cat&eacute;gorie</p>";
}
?>

</form>
