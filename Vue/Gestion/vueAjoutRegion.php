<?php
require_once 'Config/fonction.php';
?>
<p><h3>Ajout d'une r&eacute;gion</h3></p>
<form action="index.php?action=ajoutRegion" method="post" id="ajouterRegion">
	<table id="csstable" align="center">
		<tr>
			<td>Libell&eacute;</td>
			<td><input type='text' id='libelle' name='libelle' value='' size='100px' /></td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionRegions")' /></p>
