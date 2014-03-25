<?php
require_once 'Config/fonction.php';
?>
<p><h3>R&eacute;sultat des combats de la  poule - Saisie simplifi&eacute;e</h3></p>
<form action="index.php?action=envoiResultatSimple" method="post" id="envoyerResultatSimple">
<input type='hidden' id='poule' name='poule' value='<?php echo $pouleSelected ?>'>
<input type='hidden' id='categorie' name='categorie' value='<?php echo $categorieSelected ?>'>
<p align="center" >
	<table border='1' style='width: 80%; text-align: center;'>
		<thead>
			<tr>
				<th colspan='2' style='background-color: #f18a30;'>Poule n&deg; <?php echo $pouleSelected ?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td style='width: 60%; text-align: center;'>Nom Pr&eacute;nom</td>
				<td style='width: 40%; text-align: center;'>Classement</td>
			</tr>
	<?php 
	$nb = count($participant);
	foreach ($participant as $part) { 
		echo "<tr>";
		echo "	<td><input type='hidden' id='licencie".$part['position_poule']."' name='licencie".$part['position_poule']."' value='".$part[0]."'>".Securite::decrypteData($part['prenom'])." ".Securite::decrypteData($part['nom'])."</td>";
		echo "	<td><select id='res".$part['position_poule']."' name='res".$part['position_poule']."' >
					<option value='1' >1er</option>
					<option value='2' >2&egrave;me</option>
					<option value='3' >3&egrave;me</option>";
		if($nb>3) echo "<option value='4' >4&egrave;me</option>";
		if($nb>4) echo "<option value='5' >5&egrave;me</option>";
		echo "</select></td>";
		echo "</tr>";
	}
	?>
		</tbody>
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</p>
</form>
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=resultatPouleSimple&id=<?php echo $categorieSelected ?>")' /></p>
