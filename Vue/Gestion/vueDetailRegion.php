<?php
require_once 'Config/fonction.php';
?>
<p><h3>D&eacute;tails d'une R&eacute;gion</h3></p>
<form action="index.php?action=modificationRegion" method="post" id="modifierRegion">
<input type='hidden' id='idRegion' name='idRegion' value='<?php echo $region['idregion'] ?>'>
	<table id="csstable" align="center">
		<tr>
			<td width="30%">Libell&eacute;</td>
			<td><input type='text' id='libelle' name='libelle' value='<?php echo $region['libelle'] ?>' size='100px' /></td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionRegion")' /></p>
