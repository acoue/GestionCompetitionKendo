<?php
require_once 'Config/fonction.php';
?>
<p><h3>Tirage au sort</h3></p>
<form action="index.php?action=effectuerTirageEquipe" method="post" id="effectuerTirageEquipe">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=afficheTirageEquipe&id='+this.options[this.selectedIndex].value;" >
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
if(!empty($licenciesCategorie)) {
	if($categorieSelected >-1) {

		if(!empty($dateTirage)) echo "<p align='center' style='color:orange; font-weight:bold;'>Date/Heure du tirage pour cette cat&eacute;gorie : ".aff_date_court($dateTirage[0])."</p>";
		else echo "<p>Aucun tirage pour cette cat&eacute;gorie</p>";
	
?>
		<p>
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
					<td width='30%' >Eloignement :</td>
					<td width='20%' >
						<INPUT type= "radio" name="tete" value="1"> Oui<br />
						<INPUT type= "radio" name="tete" value="0" checked> Non
					</td>
					<td width='50%' >
		<label for="premier">1er</label>
		<select name="premier" id="premier"><option value='-1' selected>--</option>
		<?php 
		foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
		?>
		</select>
		<br />
		<label for="deuxieme">2&egrave;me</label>
		<select name="deuxieme" id="deuxieme"><option value='-1' selected>--</option>
		<?php 
		foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
		?>
		</select>
		<br />
		<label for="troisieme">3&egrave;me</label>
		<select name="troisieme" id="troisieme"><option value='-1' selected>--</option>
		<?php 
		foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
		?>
		</select>
		<br />
		<label for="troisiemebis">3&egrave;me</label>
		<select name="troisiemebis" id="troisiemebis"><option value='-1' selected>--</option>
		<?php 
		foreach ($licenciesCategorie as $licencie) echo "<option value='".$licencie["idlicencie"]."' >".$licencie[0]." - ".Securite::decrypteData($licencie["prenom"])." ".Securite::decrypteData($licencie["nom"])."</option>";
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
						<INPUT type= "radio" name="club" value="1"> Oui<br />
						<INPUT type= "radio" name="club" value="0" checked> Non
					</td>
				</tr>
				<tr align='center'>
					<td colspan='3' ><input type='submit' name='valider' value='Lancer le tirage' /></td>
				</tr>
			</tbody>
		</table></p>
		<?php
			if(!empty($licenciesTirage)) {
				if(!empty( $typeTirage)) echo "<p align='center' style='color:red; font-weight:bold;'>".$typeTirage."</p>";
				echo "<p><table id='csstable' align='center' width='50%'><caption style='caption-side:top; font-weight:bold; text-decoration:underline;'>R&eacute;sultat du tirage</caption> ";
				echo "<thead><tr><th width='60%'>Licenci&eacute;</th><th width='20%'>Poule</th><th width='20%'>Position</th><tr></thead>";
				echo "<tbody>";
				foreach ($licenciesTirage as $licTab) {
					$licencie = $licTab[0]." - ".Securite::decrypteData($licTab["prenom"])." ".Securite::decrypteData($licTab["nom"]);
					echo "<tr align='center'>";
					echo "<td>".$licencie."</td>";
					echo "<td>".$licTab['numero_poule']."</td>";
					echo "<td>".$licTab['position_poule']."</td>";
					echo "</tr>";
				}
				echo "</tbody></table></p>";
			}
		}

	}  else {
		echo "<p>Aucune r&eacute;partition pour cette cat&eacute;gorie</p>";
	}
?>
</form>
