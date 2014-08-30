<?php
require_once 'Config/fonction.php';
?>
<p><h3>D&eacute;tails d'un club</h3></p>
<form action="index.php?action=modificationClub" method="post" id="modifierClub">
<input type='hidden' id='idClub' name='idClub' value='<?php echo $club['idclub'] ?>'>
	<table id="csstable" align="center">
		<tr>
			<td>Libell&eacute;</td>
			<td><input type='text' id='libelle' name='libelle' value='<?php echo $club['libelle'] ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>R&eacute;gion</td>
			<td>
				<select id="region" name="region" >
				<?php foreach ($regions as $region) {
					if($club['idregion'] == $region['idregion']) echo "<option value='".$region['idregion']."' selected >".$region['libelle']."</option>";
					else echo "<option value='".$region['idregion']."' >".$region['libelle']."</option>";
				} ?>
				</select>
			</td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionClub")' /></p>
