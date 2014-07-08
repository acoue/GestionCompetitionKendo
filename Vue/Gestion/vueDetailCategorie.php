<?php
require_once 'Config/fonction.php';
?>
<p><h3>D&eacute;tails d'une cat&eacute;gorie</h3></p>
<form action="index.php?action=modificationCategorie" method="post" id="modifierCategorie">
<input type='hidden' id='idCategorie' name='idCategorie' value='<?php echo $categorie['idcategorie'] ?>'>
	<table id="csstable" align="center">
		<tr>
			<td width="30%">Libell&eacute;</td>
			<td><input type='text' id='libelle' name='libelle' value='<?php echo $categorie['libelle'] ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><SELECT name='type' size='1'><?php
				if ($categorie['type'] == 1) {
					echo "<option value='1' selected >EQUIPE</OPTION> ";
					echo "<option value='0' >INDIVIDUEL</option>";
				} else {
					echo "<option value='0' selected >INDIVIDUEL</option>";
					echo "<option value='1' >EQUIPE</option> ";
				}
?>
				</SELECT></td>
		</tr>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionCategorie")' /></p>
