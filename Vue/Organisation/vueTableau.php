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
</select></p>


<?php
if(!empty($licenciesTableau)) {
	
	echo "<p align='center'><input type='submit' name='valider' value='G&eacute;n&eacute;rer le tableau' /></p>";
	if(file_exists("Ressources/".$libCategorieSelected[0]."_tableau.xls")) {
		echo "<p align='center' ><a href='Ressources/".$libCategorieSelected['libelle']."_tableau.xls'><img src='img/site/fichier.png' border='0'></a></p>";
	}
	echo "<p>Comp&eacute;titeurs dans le tableau</p>";
?>
<table id='csstable' align="center" width="70%">
	<thead>
    	<tr>
			<th width="60%">Licenci&eacute;</th> 
			<th width="20%">Poule</th>  
			<th width="20%">Classement</th>  
		<tr>
	</thead>
	<tbody>		
<?php
	foreach ($licenciesTableau as $licTab) {
		$licencie = Securite::decrypteData($licTab[1])." ".Securite::decrypteData($licTab[2]);
		echo "<tr align='center'>";
		echo "<td>".$licencie."</td>";
		echo "<td>".$licTab[3]."</td>";
		echo "<td>".$licTab[4]."</td>";
		echo "</tr>";
	}
} 
?>
	</tbody>
</table>
</form>
