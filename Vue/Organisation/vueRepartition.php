<?php
require_once 'Config/fonction.php';
?>
<p><h3>Repartition licenci&eacute; par cat&eacute;gorie</h3></p>

<script type="text/javascript">
	function rechercheLicencie(categorie,valTexte) {
	//alert(categorie + '-' +valTexte.value);
	window.location.href="index.php?action=afficheRepartitionRecherche&id=" + categorie + "&rech=" + valTexte.value;
	}
</script>
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
if($categorieSelected >-1) {
	echo "<p align='center' ><input type='submit' name='valider' /></p>";
	echo "<label for='recherche'>Chercher un licenci&eacute; :  </label>&nbsp;&nbsp;";
	echo "<input type='text' id='recherche' onChange='rechercheLicencie(\"".$categorieSelected."\",this);'\">&nbsp;(Pressez la touche tabulation pour lancer la recherche)";
	echo "<br /><input type='button' id='afficheAll' value='Afficher tout' onClick=\"window.location='index.php?action=afficheRepartition&id=".$categorieSelected."'\" >";
}
?>
<p align='center' >
<table id='csstable' align="center" width="90%">
	<tr>
			<th width='50%' align='center'>Liste des comp&eacute;titeurs</th>
			<th width='50%' align='center'>D&eacute;j&agrave; dans la categorie</th>
	</tr>
	<tr>
		<td valign="top">
<?php 
if(!empty($licencies)) 
foreach ($licencies as $licencie)  
	echo "<input type='checkbox' name='licencie[]' value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".trim($licencie['prenom'])." ".trim($licencie['nom'])."<br />";
?>
		</td>
		<td valign="top">
<?php		
		echo "<p align='center' style='color:red; font-weight:bold;'>".count($licenciesCategorie)." participants</p>";
		echo"<ul>";
 
if(!empty($licenciesCategorie)) 
foreach ($licenciesCategorie as $licencieCategorie) {
	echo "<li><a href='index.php?action=suppressionRepartition&id=".$licencieCategorie["idlicencie_categorie"]."&categorie=".$licencieCategorie["idcategorie"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a>";
	echo $licencieCategorie[0]." - ".$licencieCategorie["prenom"]." ".$licencieCategorie["nom"]."</li>";
} else echo "<li>Aucune r&eacute;partition</li>"
?>				
		</ul></td>
	</tr>
</table>
</p>
</form>
