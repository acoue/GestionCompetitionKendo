<?php
require_once 'Config/fonction.php';
?>
<p><h3>G&eacute;n&eacute;ration du tableau / Impression</h3></p>
<form action="index.php?action=impressionTableau" method="post" id="imprimerTableau">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=afficheTableau&id='+this.options[this.selectedIndex].value;" >
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
<p align="center"><input type='submit' name='valider' value='G&eacute;n&eacute;rer le tableau' /></p>
<p>Liste des fichiers tableaux g&eacute;n&eacute;r&eacute;s :
<?php
if(!empty($categorieSelected)) {
	$dirname = 'Ressources/';
	$dir = opendir($dirname);
	$cpt = 0;
	while($file = readdir($dir)) {
		if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
			if (strrpos($file, $libCategorieSelected['libelle']."_tableau")!==false) {
				echo "<p align='center'><a href='".$dirname.$file."'>".$file."</a></p>";
				$cpt++;
			}
		}
	}
	if($cpt<1) echo "Pas de fichier g&eacute;n&eacute;r&eacute;s";
	closedir($dir);
}



if(!empty($licenciesTableau)) {
echo "</p><p>Comp&eacute;titeurs dans le tableau</p>";
	foreach ($licenciesTableau as $licTab) {
		$licencie = Securite::decrypteData($licTab[1])." ".Securite::decrypteData($licTab[2]);
		echo "$licencie (Poule : $licTab[3] -> $licTab[4]) <br />";

	}
} 
?>
</form>
