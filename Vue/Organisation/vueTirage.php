<?php
require_once 'Config/fonction.php';
?>
<p><h3>Tirage au sort</h3></p>
<form action="index.php?action=effectuerTirage" method="post" id="effectuerTirage">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=afficheTirage&id='+this.options[this.selectedIndex].value;" >
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
<?php 
if(!empty($dateTirage)) echo "<p>Date/Heure du tirage pour cette cat&eacute;gorie : ".aff_date_court($dateTirage[0])."</p>";
else echo "<p>Aucun tirage pour cette cat&eacute;gorie</p>";

if(!empty($licenciesCategorie)) { ?>

<table id='csstable' align="center" width="90%" >
	<tbody>
		<tr>
			<td>Nombre de comp&eacute;titeurs dans la poule :</td>
			<td colspan='2'>
				<INPUT type= "radio" name="nombre" value="3" checked> 3<br />
				<INPUT type= "radio" name="nombre" value="4"> 4<br />
				<INPUT type= "radio" name="nombre" value="5"> 5<br />
				<INPUT type= "radio" name="nombre" value="-1" >Taleau direct
			</td>
		</tr>
		<tr>
			<td width='30%' >Eloignement des t&ecirc;tes de s&eacute;rie :</td>
			<td width='30%' >
				<INPUT type= "radio" name="tete" value="oui"> Oui<br />
				<INPUT type= "radio" name="tete" value="non" checked> Non
			</td>
			<td width='40%' >
<label for="premier">1er</label>
<select name="premier" id="premier">
<?php 
foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
?>
</select>
<br />
<label for="deuxieme">2&egrave;me</label>
<select name="deuxieme" id="deuxieme">
<?php 
foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
?>
</select>
<br />
<label for="troisieme">3&egrave;me</label>
<select name="troisieme" id="troisieme">
<?php 
foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
?>
</select>
<br />
<label for="troisieme">3&egrave;me</label>
<select name="troisiemebis" id="troisiemebis">
<?php 
foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
?>
</select>
			</td>
		</tr>
	<!-- 	<tr>
			<td>Eloignement des r&eacute;gions :</td>
			<td>
				<INPUT type= "radio" name="region" value="oui"> Oui<br />
				<INPUT type= "radio" name="region" value="non" checked> Non
			</td>
		</tr> -->
		<tr>
			<td>Eloignement des clubs :</td>
			<td colspan='2'>
				<INPUT type= "radio" name="club" value="oui"> Oui<br />
				<INPUT type= "radio" name="club" value="non" checked> Non
			</td>
		</tr>
		<tr align='center'>
			<td colspan='3' ><input type='submit' name='valider' value='Lancer le tirage' /></td>
		</tr>
	</tbody>
</table>
<?php
	if(!empty($licenciesTirage)) {
		echo "<p>Tirage au sort - R&eacute;partition des Comp&eacute;titeurs : </p>";
		echo "<p><ul>";
		foreach ($licenciesTirage as $tirage) echo "<li>".$tirage."</li>";
		echo "</ul></p>";
	}
}  else {
	echo "<p>Aucune r&eacute;partition pour cette cat&eacute;gorie</p>";
}
?>
</form>
