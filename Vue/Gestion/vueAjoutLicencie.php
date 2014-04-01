<?php
require_once 'Config/fonction.php';
?>
<p><h3>Ajout d'un licenci&eacute;</h3></p>
<form action="index.php?action=ajoutLicencie" method="post" id="ajouterLicencie">
	<table id="csstable" align="center">
		<tr>
			<td>Pr&eacute;nom</td>
			<td><input type='text' id='prenom' name='prenom' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>Nom</td>
			<td><input type='text' id='nom' name='nom' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>Club</td>
			<td>
				<select id="club" name="club" >
				<?php foreach ($clubs as $club) {
					echo "<option value='".$club['idclub']."' >".$club['2']."</option>";
				} ?>
				</select>
			</td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionLicencie")' /></p>
