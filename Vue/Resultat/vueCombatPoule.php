<?php
require_once 'Config/fonction.php';
?>
<p><h3>R&eacute;sultats des poules</h3></p>
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=resultatPoule&id='+this.options[this.selectedIndex].value;" >
<option value='-1' >--</option>
<?php 
if(!empty($categories)) {
	foreach ($categories as $categorie) {
		if($categorieSelected == $categorie["idcategorie"]) echo "<option value='".$categorie["idcategorie"]."' selected >".$categorie["libelle"]."</option>";
		else echo "<option value='".$categorie["idcategorie"]."' >".$categorie["libelle"]."</option>";
	}
}
?>
</select>
</p>
<?php 
if(!empty($combat)) { ?>
<p align="center">
	<table border="1" style="width: 100%; text-align:center;">
		<thead>
			<tr>
				<td colspan='2' style='width: 46%; text-align: center; background-color: red; color: white;'>Comp&eacute;titeur</td>
				<td style='width: 8%;  text-align: center;' ></td>
				<td colspan='2' style='width: 46%; text-align: center;' >Comp&eacute;titeur</td>
			</tr>
		</thead>
		<tbody>	
<?php 
		$pouletmp="";
		foreach ($combat as $cbt) {
			$licencie1 = $cbt[1]." ".$cbt[2];
			$licencie2 = $cbt[4]." ".$cbt[5];
			$poule = $cbt['poule'];
			$resRouge = $cbt['resultat_rouge'];
			$resBlanc = $cbt['resultat_blanc'];
			
			if ($pouletmp == "" || $poule != $pouletmp) echo "<tr><td colspan='5' style='text-align: center;background-color: #999999;'> Poule n&deg;".$poule."<br /><input type='button' name='raz' value='RAZ Resultat' onclick='window.location.replace(\"index.php?action=razResultat&poule=$poule&categorie=$categorieSelected\")' /></td></tr>"; 
			echo "<tr><td style='width: 34%;'>".$licencie1."</td>";
			echo "<td style='width: 12%;'>".$resRouge."</td>";
			echo "<td><a href='index.php?action=afficheCombatPoule&id=".$cbt["idcombat_poule"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
			echo" <td style='width: 12%;'>".$resBlanc."</td>";
			echo "<td  style='width: 34%;'>".$licencie2."</td></tr>";
			$pouletmp = $poule;
			
			
		}
?>				
		</tbody>
	</table>
</p>
<?php } else echo "<p>Pas de combat g&eacute;n&eacute;r&eacute; pour cette cat&eacute;gorie</p>";?>
