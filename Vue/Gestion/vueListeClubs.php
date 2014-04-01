<?php
require_once 'Config/fonction.php';
?>
<p><h3>Liste des clubs</h3></p>
<p align="center"><input type='button' name='Ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutClubFormulaire")' /></p>
<br />
<table id='csstable' align="center" width="90%">
	<thead>
    	<tr>
			<th width="10%"></th>
			<th width="10%"></th>
			<th width="50%">Libell&eacute;</th> 
			<th width="30%">R&eacute;gion</th>  
		<tr>
	</thead>
	<tbody>		
	<?php foreach ($clubs as $club) {
	   echo "<tr align='left'>";
	   echo "<td align='center'><a href='index.php?action=suppressionClub&id=".$club["idclub"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a></td>";
	   echo "<td align='center'><a href='index.php?action=afficheClub&id=".$club["idclub"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
	   echo "<td>".$club[2]."</td>";
	   echo "<td>".$club[4]."</td>";
	   echo "</tr>";
	}
	?>
	</tbody>
</table>