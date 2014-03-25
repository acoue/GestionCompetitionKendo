<?php
require_once 'Config/fonction.php';
?>
<p><h3>Liste des R&eacute;gions</h3></p>
<p align="center"><input type='button' name='Ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutRegionFormulaire")' /></p>
<br />
<table id='csstable' align="center" width="90%">
	<thead>
    	<tr>
			<th width="10%"></th>
			<th width="10%"></th>
			<th>Libell&eacute;</th>  
		<tr>
	</thead>
	<tbody>		
	<?php foreach ($regions as $region) {
	   echo "<tr align='left'>";
	   echo "<td align='center'><a href='index.php?action=suppressionRegion&id=".$region["idregion"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a></td>";
	   echo "<td align='center'><a href='index.php?action=afficheRegion&id=".$region["idregion"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
	   echo "<td>".$region["libelle"]."</td>";
	   echo "</tr>";
	}
	?>
	</tbody>
</table>