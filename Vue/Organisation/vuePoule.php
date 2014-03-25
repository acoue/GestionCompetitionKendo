<?php
require_once 'Config/fonction.php';
?>
<p><h3>G&eacute;n&eacute;ration des poules / Impression</h3></p>
<form action="index.php?action=impressionPoule" method="post" id="imprimerPoule">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=affichePoule&id='+this.options[this.selectedIndex].value;" >
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
<p>
<p align="center"><input type='submit' name='valider' value='G&eacute;n&eacute;rer les poules' /></p>
<p>Liste des fichiers poule g&eacute;n&eacute;r&eacute;s :
<?php
if(!empty($categorieSelected)) {
	$dirname = 'Ressources/';
	$dir = opendir($dirname);
	$cpt = 0;
	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
			if (strrpos($file, $libCategorieSelected['libelle']."_poule")!==false) {
				echo "<p align='center'><a href='".$dirname.$file."'>".$file."</a></p>";
				$cpt++;
			}
		}
	}
	if($cpt<1) echo "Pas de fichier g&eacute;n&eacute;r&eacute;s";
	closedir($dir);
}


echo "</p>";
if(!empty($licenciesTirage)) {
	echo "<p>Liste des poules</p>";
	echo "<p align='center'><table border='1' style='width: 25%;text-align: center;'>";
	$pouletmp = "";
	$cpt = 1;
	foreach ($licenciesTirage as $tirage) {
		
		$club = $tirage[0];
		$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
		$poule = $tirage['numero_poule'];
		$position = $tirage['position_poule'];

		if($pouletmp == "") echo "<tr><th>Poule $poule</th></tr>";

		if($pouletmp != "" && $poule != $pouletmp) {	
			echo "</table><br /><table border='1' style='width: 25%;text-align: center;'>";
			echo "<tr><th>Poule $poule</th></tr>";
		} 

		echo "<tr><td>$licencie <br /><span class='libClub'>$club</span></td></tr>";	
		$pouletmp = $poule;
	}
	echo "</table></p>";
} else {
	echo "<p>Pas de tirage au sort effectu&eacute; pour cette cat&eacute;gorie</p>";
}
?>
</form>
