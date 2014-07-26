<?php
require_once 'Config/fonction.php';
?>
<p><h3>G&eacute;n&eacute;ration des fichiers Excel pour les poules</h3></p>
<form action="index.php?action=genererPoule" method="post" id="genererPoule">
<p align="center" >
<label for="categorie">S&eacute;lectionner la cat&eacute;gorie</label>
<select name="categorie" id="categorie" onchange="window.location = 'index.php?action=affichePoule&id='+this.options[this.selectedIndex].value;" >
<option value='-1' >--</option>
<?php 
if(!empty($categories)) {
	foreach ($categories as $categorie) {
		if($categorieSelected == $categorie["idcategorie"]) echo "<option value='".$categorie["idcategorie"]."' selected >".$categorie["libelle"]."</option>";
		else echo "<option value='".$categorie["idcategorie"]."' >".$categorie["libelle"]."</option>";
	}
}
?>
</select></p>

<?php 
if($categorieSelected >-1) {
	if(!empty($licenciesTirage)) {
		echo "<p align='center'><input type='submit' name='valider' value='G&eacute;n&eacute;rer les poules' /></p><br />";
		echo "<table border='1' style='width: 40%;text-align: center;'>";
		$pouletmp = "";
		$cpt = 1;
		foreach ($licenciesTirage as $tirage) {
			
			$club = $tirage[0];
			$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
			$poule = $tirage['numero_poule'];
			$position = $tirage['position_poule'];
	
			if($pouletmp == "") echo "<tr><th>Poule $poule</th></tr>";
	
			if($pouletmp != "" && $poule != $pouletmp) {
				
				if(file_exists("Ressources/".$libCategorieSelected['libelle']."_poule_".$pouletmp.".xls")) {
					echo "<tr><td align='center' ><a href='Ressources/".$libCategorieSelected['libelle']."_poule_".$pouletmp.".xls'><img src='img/site/fichier.png' border='0'></a></td></tr>";
				}
				echo "</table><br /><table border='1' style='width: 40%;text-align: center;'>";
				echo "<tr><th>Poule $poule</th></tr>";
				$cpt=1;
			} 
	
			echo "<tr><td>$licencie <br /><span class='libClub'>$club</span></td></tr>";
			$cpt++;
			$pouletmp = $poule;
		}
		if(file_exists("Ressources/".$libCategorieSelected['libelle']."_poule_".$pouletmp.".xls")) {
			echo "<tr><td align='center' ><a href='Ressources/".$libCategorieSelected['libelle']."_poule_".$pouletmp.".xls'><img src='img/site/fichier.png' border='0'></a></td></tr>";
		}
		echo "</table>";
	} else {
		echo "<p>Pas de tirage au sort effectu&eacute; pour cette cat&eacute;gorie</p>";
	}
}
?>
</form>
