<?php
require_once 'Config/Configuration.php';
require_once 'Config/fonction.php';
?>
<p><h3>Liste des journaux de l'application</h3></p>
<?php 
if(!empty($journaux)) { ?>
<table id='csstable' align="center" width="90%">
<tr>
<th width="20%">Type</th>
<th width="20%">date</th>
<th>texte</th>
<tr>
<?php foreach ($journaux as $journal) {
	if($journal['typelog'] == "Erreur") $bgcolor="red";
	else $bgcolor = "white";
	echo "<tr>";
	echo "<td align='center' bgcolor='$bgcolor'>".$journal['typelog']."</td>";
	echo "<td align='center'>".$journal['datelog']."</td>";
	echo "<td align='left'>".traitementAccent(Securite::decrypteData($journal['texte']))."</td>";
	echo "</tr>";
}
?>
</table>	
<?php
} else echo "<p>Aucune ligne de journalisation de l'application</p>";
?>