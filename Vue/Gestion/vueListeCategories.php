<?php
require_once 'Config/fonction.php';
?>
<p><h3>Liste des cat&eacute;gories</h3></p>
<p align="center"><input type='button' name='Ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutCategorieFormulaire")' /></p>
<br />
<table id='csstable' align="center" width="90%">
	<thead>
    	<tr>
			<th width="10%"></th>
			<th width="10%"></th>
			<th width="50%">Libell&eacute;</th>  
			<th width="30%">type</th>  
		<tr>
	</thead>
	<tbody>		
	<?php foreach ($categories as $categorie) {
	   echo "<tr align='left'>";
	   echo "<td align='center'><a href='index.php?action=suppressionCategorie&id=".$categorie["idcategorie"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a></td>";
	   echo "<td align='center'><a href='index.php?action=afficheCategorie&id=".$categorie["idcategorie"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
	   echo "<td>".$categorie["libelle"]."</td>";
	   if($categorie["type"] === '0') echo "<td>INDIVIDUEL</td>";
	   else echo "<td>EQUIPE</td>";
	   echo "</tr>";
	}
	?>
	</tbody>
</table>