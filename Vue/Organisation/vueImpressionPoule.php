<?php
require_once 'Config/fonction.php';
?>
<div id='impressionNull'>
<p><h3>Impression des feuilles de poules</h3></p>
<p align='center'>
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=impressionPoule&id='+this.options[this.selectedIndex].value;" >
<option value='-1' >--</option>
<?php 
if(!empty($categories)) {
	foreach ($categories as $cat) {
		if($categorieSelected == $cat["idcategorie"]) echo "<option value='".$cat["idcategorie"]."' selected >".$cat["libelle"]."</option>";
		else echo "<option value='".$cat["idcategorie"]."' >".$cat["libelle"]."</option>";
	}
}
?>
</select>
A FAIRE LISTING POULE
</p>

<?php
if($categorieSelected >-1) {
	if(!empty($participant)) {
		echo "<p align='center'><input type='button' name='imprimer' value='Imprimer les poules' onClick='window.print()'/></p></div><br />";
		
		$pouletmp = "";
		$cpt = 1;
		foreach ($participant as $tirage) {
		
			$club = $tirage[0];
			$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
			$poule = $tirage['numero_poule'];
			$position = $tirage['position_poule'];
			$nbPoule = $nbByPoule[$poule-1][1];
			
	
			if($pouletmp == "") {
				echo "<p><table style='width: 100%;text-align: left;'>
				<tr><td width='30%'><b>Comit&eacute; National de Kendo F.F.J.D.A.</b></td><td width='30%'></td><td width='10%'><b>Date : </b></td><td width='20%'>".aff_date_court($competDate)."</td></tr>
				<tr><td><b>Commission sportive</b></td><td></td><td></td><td></td></tr>
				<tr><td><b>Nom et visa du commissaire de table : </b></td><td></td><td><b>Cat&eacute;gorie : </b></td><td>$categorieLibelle</td></tr>
				<tr height='100px'><td colspan='4' align='center'><h2>$competLibelle</h2></td></tr>
				<tr height='100px'><td colspan='4' align='center'><h1>Poule $poule</h1></td></tr>
				<tr><td colspan='4'>";
				
				if($nbPoule == 3) echo "<b>Poule de 3</b> : 1x2 - 1x3 - 2x3";
				else if($nbPoule == 4) echo "<b>Poule de 4</b> : 1x2 - 3x4 - 1x4 - 1x3 - 2x3 - 2x4";
				else if($nbPoule == 5) echo "<b>Poule de 5</b> : 1x2 - 3x4 - 1x5 - 2x3 - 4x5 - 1x3 - 2x5 - 1x4 - 3x5 - 2x4";
				
				echo "</td></tr></table></p>";
				echo "<p><table border='1' style='width: 80%;text-align: center;'>";
				echo "<tr><td width='30%'>NOM/CLUB</td><td width='3%'></td>";
				for($i=1;$i<=$nbPoule; $i++) echo "<td>$i</td>";
				echo "<td width='12%'></td><td width='6%'></td><td width='12%'>Classement</td></tr>";
			} else if($poule != $pouletmp) {
				echo "</table></p></div><div class='breakafter'></div>";
				echo "<p><table style='width: 100%;text-align: left;'>
				<tr><td width='30%'><b>Comit&eacute; National de Kendo F.F.J.D.A.</b></td><td width='30%'></td><td width='10%'><b>Date : </b></td><td width='20%'>".aff_date_court($competDate)."</td></tr>
				<tr><td><b>Commission sportive</b></td><td></td><td></td><td></td></tr>
				<tr><td><b>Nom et visa du commissaire de table : </b></td><td></td><td><b>Cat&eacute;gorie : </b></td><td>$categorieLibelle</td></tr>
				<tr height='100px'><td colspan='4' align='center'><h2>$competLibelle</h2></td></tr>
				<tr height='100px'><td colspan='4' align='center'><h1>Poule $poule</h1></td></tr>
				<tr><td colspan='4'>";
				
				if($nbPoule == 3) echo "<b>Poule de 3</b> : 1x2 - 1x3 - 2x3";
				else if($nbPoule == 4) echo "<b>Poule de 4</b> : 1x2 - 3x4 - 1x4 - 1x3 - 2x3 - 2x4";
				else if($nbPoule == 5) echo "<b>Poule de 5</b> : 1x2 - 3x4 - 1x5 - 2x3 - 4x5 - 1x3 - 2x5 - 1x4 - 3x5 - 2x4";
				
				echo "</td></tr></table></p>";
				echo "<p><table border='1' style='width: 80%;text-align: center;'>";
				echo "<tr><td width='30%'>NOM/CLUB</td><td width='3%'></td>";
				for($i=1;$i<=$nbPoule; $i++) echo "<td>$i</td>";
				echo "<td width='12%'></td><td width='6%'></td><td width='12%'>Classement</td></tr>";
				$cpt=1;
			}
			echo "<tr>";
			echo "<td rowspan='3'>$licencie <br /><span class='libClub'>$club</span></td>";
			echo "<td rowspan='3'>$cpt</td>";
			for($i=1;$i<=$nbPoule; $i++) {
				if($i == $cpt) echo "<td rowspan='3' style='background-color:#999999;'></td>";
				else echo "<td rowspan='3'></td>";
			}
			echo "<td>IPPON</td>";
			echo "<td></td>";
			echo "<td rowspan='3'></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Nb de victoires</td>";
			echo "<td></td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td>Points</td>";
			echo "<td></td>";
			echo "</tr>";
			$cpt++;
			$pouletmp = $poule;
		}
		echo "</table></p>";
	} else {
		echo "<p>Pas de poule &agrave; afficher pour cette cat&eacute;gorie</p>";
	}	
}
?>
</div>