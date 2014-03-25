<?php
require_once 'Config/fonction.php';
?>
<p><h3>Import d'un fichier REPARTITION</h3></p>
<form action="index.php?action=importFichierRepartition" method="post" enctype="multipart/form-data">  
	<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
	<select name="categorie" id="categorie" >
<?php 
if(!empty($categories)) {
	foreach ($categories as $categorie) {
		if($categorieSelected == $categorie["idcategorie"]) echo "<option value='".$categorie["idcategorie"]."' selected >".$categorie["libelle"]."</option>";
		else echo "<option value='".$categorie["idcategorie"]."' >".$categorie["libelle"]."</option>";
	}
}
?>
	</select>
<br />
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152">     
<label for="fichier">S&eacute;lectionner un fichier</label>
	<input type="file" name="fichier" id="fichier" >    
	<input type="submit" value="Envoyer">    
</form>
