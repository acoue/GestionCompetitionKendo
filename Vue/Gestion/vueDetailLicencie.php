<?php
require_once 'Config/fonction.php';
?>
<p><h3>D&eacute;tails d'un Licenci&eacute;</h3></p>
<form action="index.php?action=modificationLicencie" method="post" id="modifierLicencie">
<input type='hidden' id='idLicencie' name='idLicencie' value='<?php echo $licencie['idlicencie'] ?>'>
	<table id="csstable" align="center">
		<tr>
			<td>Pr&eacute;nom</td>
			<td><input type='text' id='prenom' name='prenom' value='<?php echo trim($licencie['prenom']) ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>Nom</td>
			<td><input type='text' id='nom' name='nom' value='<?php echo trim($licencie['nom']) ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>Club</td>
			<td>
				<select id="club" name="club" >
				<?php foreach ($clubs as $club) {
					if($club['idclub'] == $licencie['idclub']) echo "<option value='".$club['idclub']."' selected >".$club['2']."</option>";
					else echo "<option value='".$club['idclub']."' >".$club['2']."</option>";
				} ?>
				</select>
			</td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionLicencie")' /></p>
