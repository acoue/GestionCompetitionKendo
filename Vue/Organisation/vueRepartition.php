<?php
require_once 'Config/fonction.php';
?>
<p><h3>Repartition licenci&eacute; par cat&eacute;gorie</h3></p>
<form action="index.php?action=ajoutRepartition" method="post" id="ajouterRepartition">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=afficheRepartition&id='+this.options[this.selectedIndex].value;" >
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
<?php 
if($categorieSelected >-1) echo "<p align='center' ><input type='submit' name='valider' /></p>";
?>
<p align='center' >
<table id='csstable' align="center" width="90%">
	<tr>
			<th width='50%' align='center'>Liste des comp&eacute;titeurs</th>
			<th width='50%' align='center'>D&eacute;j&agrave; dans la categorie</th>
	</tr>
	<tr>
		<td>
<?php 
if(!empty($licencies)) 
foreach ($licencies as $licencie)  
	echo "<input type='checkbox' name='licencie[]' value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".trim(Securite::decrypteData($licencie['prenom']))." ".trim(Securite::decrypteData($licencie['nom']))."<br />";
?>
		</td>
		<td valign="top">
<?php		
		echo "<p align='center' style='color:red; font-weight:bold;'>".count($licenciesCategorie)." participants</p>";
		echo"<ul>";
 
if(!empty($licenciesCategorie)) 
foreach ($licenciesCategorie as $licencieCategorie) {
	echo "<li><a href='index.php?action=suppressionRepartition&id=".$licencieCategorie["idlicencie_categorie"]."&categorie=".$licencieCategorie["idcategorie"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a>";
	echo $licencieCategorie[0]." - ".Securite::decrypteData($licencieCategorie["prenom"])." ".Securite::decrypteData($licencieCategorie["nom"])."</li>";
} else echo "<li>Aucune r&eacute;partition</li>"
?>				
		</ul></td>
	</tr>
</table>
</p>
</form>
