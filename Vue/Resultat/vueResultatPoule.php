<?php
require_once 'Config/fonction.php';
?>
<p><h3>R&eacute;sultats des poules / Saisie Compl&egrave;te</h3></p>
<form action="index.php?action=envoiResultat" method="post" id="envoyerResultat">
<input type='hidden' id='idCombat' name='idCombat' value='<?php echo $combat['idcombat_poule'] ?>'>
<input type='hidden' id='categorie' name='categorie' value='<?php echo $combat['idcategorie'] ?>'>
<p align="center" >
<table border='1' style='width: 80%; text-align: center;'>
	<thead>
		<tr>
			<td style='width: 20%;' ></td>
<?php 
echo "<td style='width: 40%; text-align: center; background-color: red; color: white;'>".Securite::decrypteData($combat[1])." ".Securite::decrypteData($combat[2])."</td>";
echo "<td style='width: 40%; text-align: center;'>".Securite::decrypteData($combat[4])." ".Securite::decrypteData($combat[5])."</td>";
?>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>1er point</td>
			<td>
				<input type='radio' name='point1' value='R-' checked>Aucun
				<input type='radio' name='point1' value='RM' >Men
				<input type='radio' name='point1' value='RK' >Kote
				<input type='radio' name='point1' value='RD' >Do
				<input type='radio' name='point1' value='RT' >Tsuki
				<input type='radio' name='point1' value='RH' >Hansuku
			</td>
			<td>
				<input type='radio' name='point1' value='B-' >Aucun
				<input type='radio' name='point1' value='BM' >Men
				<input type='radio' name='point1' value='BK' >Kote
				<input type='radio' name='point1' value='BD' >Do
				<input type='radio' name='point1' value='BT' >Tsuki
				<input type='radio' name='point1' value='BH' >Hansuku
			</td>
		</tr>
		<tr>
			<td>2eme point</td>
			<td>
				<input type='radio' name='point2' value='R-' checked >Aucun
				<input type='radio' name='point2' value='RM' >Men
				<input type='radio' name='point2' value='RK' >Kote
				<input type='radio' name='point2' value='RD' >Do
				<input type='radio' name='point2' value='RT' >Tsuki
				<input type='radio' name='point2' value='RH' >Hansuku
			</td>
			<td>
				<input type='radio' name='point2' value='B-' >Aucun
				<input type='radio' name='point2' value='BM' >Men
				<input type='radio' name='point2' value='BK' >Kote
				<input type='radio' name='point2' value='BD' >Do
				<input type='radio' name='point2' value='BT' >Tsuki
				<input type='radio' name='point2' value='BH' >Hansuku
			</td>
		</tr>
		<tr>
		<td>3eme point</td>
			<td>
				<input type='radio' name='point3' value='R-' checked >Aucun
				<input type='radio' name='point3' value='RM' >Men
				<input type='radio' name='point3' value='RK' >Kote
				<input type='radio' name='point3' value='RD' >Do
				<input type='radio' name='point3' value='RT' >Tsuki
				<input type='radio' name='point3' value='RH' >Hansuku
			</td>
			<td>
				<input type='radio' name='point3' value='B-' >Aucun
				<input type='radio' name='point3' value='BM' >Men
				<input type='radio' name='point3' value='BK' >Kote
				<input type='radio' name='point3' value='BD' >Do
				<input type='radio' name='point3' value='BT' >Tsuki
				<input type='radio' name='point3' value='BH' >Hansuku
			</td>
		</tr>
		<tr>
			<td colspan='3'> 
				<input type='radio' name='vainqueur' value='<?php echo $combat[0];?>' >Vainqueur Rouge
				<input type='radio' name='vainqueur' value='-1' checked >Uki Wake
				<input type='radio' name='vainqueur' value='<?php echo $combat[3];?>' >Vainqueur Blanc</td>
		</tr>
	</tbody>
</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</p>
</form>
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=resultatPoule&id=<?php echo $combat[8];?>")' /></p>
