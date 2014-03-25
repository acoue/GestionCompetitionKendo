<?php
require_once 'Config/fonction.php';
?>
<p><h3>Liste des comp&eacute;titions</h3></p>
<p align="center"><input type='button' name='Ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutCompetitionFormulaire")' /></p>
<br />
<table id="csstable" align="center" width="90%">   
	<thead>
    	<tr>
         	<th width="10%"></th>
         	<th width="10%"></th>
         	<th width="35%">Libell&eacute;</th>
         	<th width="35%">Date</th>
         	<th width="10%">S&eacute;lectionn&eacute;e</th>
      	</tr>
	</thead>
	<tbody>
<?php foreach ($competitions as $competition) {
	   echo "<tr>";
	   echo "<td align='center'><a href='index.php?action=suppressionCompetition&id=".$competition["idcompetition"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a></td>";
	   echo "<td align='center'><a href='index.php?action=afficheCompetition&id=".$competition["idcompetition"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
	   echo "<td>".$competition["libelle"]."</td>";
	   echo "<td align='center'>".dateCompleteFR($competition["datecompetition"])."</td>";
	   if($competition["selected"] === "1") echo "<td align='center'>Oui</td>";
	   else echo "<td align='center'>Non</td>";
	   echo "</tr>";
	}
?>
	</tbody>
</table>