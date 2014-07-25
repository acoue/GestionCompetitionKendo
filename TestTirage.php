
<!doctype html>
<head>
<meta charset="UTF-8">
</head>
<body>
<?php

echo "===>DEBUT <br />";
$listeCompetiteur = array("1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18");
$tabTete = array("1","12","3","6");
$nbInPoule = 3;
$ecartClub = 1;
$ecartTete = 1;


$listeCompetiteurTmp = $listeCompetiteur;
$nbCompetiteur = count($listeCompetiteur);
$tabTete2 = $tabTete;
$tirageFinal = array();

echo "<br />===>listeCompetiteur : <br />";
foreach ($listeCompetiteur as $value) echo $value." ";
echo "<br />===>tabTete : <br />";
foreach ($tabTete2 as $value) echo $value." ";
echo "<br />";

if($ecartClub == 0 && $ecartTete == 0) { // 1. Pas d'ecartement
	echo "<br />----------------------------------<br />";
	shuffle($listeCompetiteur);
	$typeTirage .= "Pas d'ecart des clubs et pas d'ecart des tetes de series";
	echo $typeTirage."<br />";
	foreach ($listeCompetiteur as $value) echo $value." - ";
}
else if($ecartClub == 0 && $ecartTete == 1) { // 2. Ecartement des tetes de series
	echo "<br />----------------------------------<br />";
	for($i=0;$i<$nbCompetiteur;$i++) array_push($tirageFinal,"#");
	if(empty($tabTete)) {
		$tirageFinal = $listeCompetiteur;
	} else {
		//Placement des tetes
		$pos4 = (int) ($nbCompetiteur / 2);
		$pos3 = $pos4 - $nbInPoule;
		$pos2 = $nbCompetiteur - $nbInPoule;
		//1er
		if($tabTete[0] > -1) $tirageFinal[0] = $tabTete[0];
		unset($tabTete[0]);

		//2eme
		if($tabTete[1] > -1) $tirageFinal[$pos2] = $tabTete[1];
		unset($tabTete[1]);

		//Le tableau des tete ne contient plus que les 3eme
		//On melange et on place
		shuffle($tabTete);
		if($tabTete[0] > -1) $tirageFinal[$pos3] = $tabTete[0];
		if($tabTete[1] > -1) $tirageFinal[$pos4] = $tabTete[1];

		//On retire les tetes du tableau des competiteurs
		$listeCompetiteur = array();
		for($i=0;$i<$nbCompetiteur;$i++) {
			if( ! in_array($listeCompetiteurTmp[$i],$tabTete2)) array_push($listeCompetiteur, $listeCompetiteurTmp[$i]);
		}
		//Remplissage avec le reste
		shuffle($listeCompetiteur);
		$nbCompetiteur = count($listeCompetiteur);
		for($i=0;$i<$nbCompetiteur;$i++) {

			for($j=0;$j<count($tirageFinal);$j++) {
				if($tirageFinal[$j] === "#") {
					$tirageFinal[$j] = $listeCompetiteur[$i];
					break;
				}
			}
		}
	}
	$typeTirage .= "Pas d'ecart des clubs et ecart des tetes de series";
	echo $typeTirage."<br />";
	foreach ($tirageFinal as $value) echo $value." ";
}
else if($ecartClub == 1 && $ecartTete == 0) { // 3. Ecartement des clubs
	echo "<br />----------------------------------<br />";

	$club1 = array("1","2","3","4"); // 1 Club avec 4 Licencies
	$club2 = array("5","6","7","8"); // 1 Club avec 4 Licencies
	$club3 = array("9","10"); // 1 Club avec 2 Licencies
	$club4 = array("11","12");  // 1 Club avec 2 Licencies
	$club5 = array("13","14","15","16","17","18");  // les Clubs avec 1 Licencies
	shuffle($club1);
	shuffle($club2);
	shuffle($club3);
	shuffle($club4);
	shuffle($club5);
	$tabGroupementClub = array(
			$club1,
			$club2,
			$club3,
			$club4,
			$club5
	);

	$nbSousTab = ((int) $nbCompetiteur/4);
	//Quart de tableau
	$tirageFinalQuart1 = array();
	$tirageFinalQuart2 = array();
	$tirageFinalQuart3 = array();
	$tirageFinalQuart4 = array();
	$tabUn = array(1,5,9,13,17,21);
	$tabDeux = array(3,7,11,15,19,23);
	$tabTrois = array(2,6,10,14,18,22);
	$tabQuatre = array(4,8,12,16,20,24);

	foreach ($tabGroupementClub as $club) {
		for($i=0;$i<count($club);$i++) {
			if(in_array($i+1,$tabUn)) {
				if(count($tirageFinalQuart1) <= $nbSousTab ) array_push($tirageFinalQuart1,$club[$i]);
				else if(count($tirageFinalQuart2) <= $nbSousTab ) array_push($tirageFinalQuart2,$club[$i]);
				else if(count($tirageFinalQuart3) <= $nbSousTab ) array_push($tirageFinalQuart3,$club[$i]);
				else array_push($tirageFinalQuart4,$club[$i]);
			}
			if(in_array($i+1,$tabDeux)) {
				if(count($tirageFinalQuart2) <= $nbSousTab ) array_push($tirageFinalQuart2,$club[$i]);
				else if(count($tirageFinalQuart3) <= $nbSousTab ) array_push($tirageFinalQuart3,$club[$i]);
				else array_push($tirageFinalQuart4,$club[$i]);
			}
			if(in_array($i+1,$tabTrois)) {
				if(count($tirageFinalQuart3) <= $nbSousTab ) array_push($tirageFinalQuart3,$club[$i]);
				else array_push($tirageFinalQuart4,$club[$i]);
			}
			if(in_array($i+1,$tabQuatre)) {
				if(count($tirageFinalQuart4) <= $nbSousTab ) array_push($tirageFinalQuart4,$club[$i]);
			}
		}
	}

	echo $typeTirage."<br />quart 1<br />";
	foreach ($tirageFinalQuart1 as $value) echo $value." ";
	echo $typeTirage."<br />quart 2<br />";
	foreach ($tirageFinalQuart2 as $value) echo $value." ";
	echo $typeTirage."<br />quart 3<br />";
	foreach ($tirageFinalQuart3 as $value) echo $value." ";
	echo $typeTirage."<br />quart 4<br />";
	foreach ($tirageFinalQuart4 as $value) echo $value." ";

	//Merge des 2 sous quart de tableaux -> 2 demi tableaux
	$demiTab1 = array_merge($tirageFinalQuart1, $tirageFinalQuart2);
	$demiTab2 = array_merge($tirageFinalQuart3, $tirageFinalQuart4);
	$reste = count($demiTab1) % $nbInPoule;
	$quotient = count($demiTab1) / $nbInPoule;
	$nbTour = (int)$quotient * $nbInPoule;


	echo $typeTirage."<br />demi 1<br />";
	foreach ($demiTab1 as $value) echo $value." ";
	echo $typeTirage."<br />demi2<br />";
	foreach ($demiTab2 as $value) echo $value." ";


	//si la taille de demitab1 / nbInPoule = 0 => on merge les 2demi tab
	if( $reste = 0) {
		$tirageFinal = array_merge($tirageFinal, $demiTab1);
		$tirageFinal = array_merge($tirageFinal, $demiTab2);
	} else {
		for($i=0; $i<$nbTour;$i++) array_push($tirageFinal,$demiTab1[$i]);
		for($i=$nbTour; $i<count($demiTab1);$i++) array_push($demiTab2,$demiTab1[$i]);

		$tirageFinal = array_merge($tirageFinal, $demiTab2);
	}

	$typeTirage .= "<br />Ecart des clubs et mais pas d'ecart des tetes de series";
	echo $typeTirage."<br />";
	foreach ($tirageFinal as $value) echo $value." ";
}
else if($ecartClub == 1 && $ecartTete == 1) { // 4. Ecartement des clubs et des tetes de series
	$club1 = array("1","2","3","4"); // 1 Club avec 4 Licencies
	$club2 = array("5","6","7","8"); // 1 Club avec 4 Licencies
	$club3 = array("9","10"); // 1 Club avec 2 Licencies
	$club4 = array("11","12");  // 1 Club avec 2 Licencies
	$club5 = array("13","14","15","16","17","18");  // les Clubs avec 1 Licencies
	// 	shuffle($club1);
	// 	shuffle($club2);
	// 	shuffle($club3);
	// 	shuffle($club4);
	// 	shuffle($club5);
	$tabGroupementClub = array(
			$club1,
			$club2,
			$club3,
			$club4,
			$club5
	);

	//Quart de tableau 1
	$nbSousTab = ((int) $nbCompetiteur/4);
	$tirageFinalQuart1 = array();
	$tirageFinalQuart2 = array();
	$tirageFinalQuart3 = array();
	$tirageFinalQuart4 = array();
	for($i=0;$i<$nbSousTab;$i++) {
		array_push($tirageFinalQuart1,"#");
		array_push($tirageFinalQuart2,"#");
		array_push($tirageFinalQuart3,"#");
		array_push($tirageFinalQuart4,"#");
	}
	$tabUn = array(1,5,9,13,17,21);
	$tabDeux = array(3,7,11,15,19,23);
	$tabTrois = array(2,6,10,14,18,22);
	$tabQuatre = array(4,8,12,16,20,24);

	foreach ($tabGroupementClub as $club) {
		for($i=0;$i<count($club);$i++) {
			if(in_array($i+1,$tabUn)) {
				if(in_array($club[$i],$tabTete)) { //Si tete de serie
					if($club[$i]==$tabTete[0]) $tirageFinalQuart1[0] = $club[$i]; //1er
					if($club[$i]==$tabTete[1]) $tirageFinalQuart4[$nbSousTab-$nbInPoule+1] = $club[$i]; //2eme
					if($club[$i]==$tabTete[2]) $tirageFinalQuart3[0] = $club[$i]; //3eme
					if($club[$i]==$tabTete[3]) $tirageFinalQuart2[$nbSousTab-$nbInPoule+1] = $club[$i]; //3eme
				} else {
					$bInsert = false;
					for($j=1; $j< count($tirageFinalQuart1); $j++) {
						if($tirageFinalQuart1[$j] != "#") {
							$tirageFinalQuart1[$j] = $club[$i];
							$bInsert = true;
							break;
						}
					}
					if(! $binsert) {
						for($j=0; $j< count($tirageFinalQuart2); $j++) {
							if($tirageFinalQuart2[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
								$tirageFinalQuart2[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
					if(! $binsert) {
						for($j=1; $j< count($tirageFinalQuart3); $j++) {
							if($tirageFinalQuart3[$j] != "#") {
								$tirageFinalQuart3[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
					if(! $binsert) {
						for($j=0; $j< count($tirageFinalQuart4); $j++) {
							if($tirageFinalQuart4[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
								$tirageFinalQuart4[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
				}
			}
			if(in_array($i+1,$tabDeux)) {
				if(in_array($club[$i],$tabTete)) { //Si tete de serie
					if($club[$i]==$tabTete[0]) $tirageFinalQuart1[0] = $club[$i]; //1er
					if($club[$i]==$tabTete[1]) $tirageFinalQuart4[$nbSousTab-$nbInPoule+1] = $club[$i]; //2eme
					if($club[$i]==$tabTete[2]) $tirageFinalQuart3[0] = $club[$i]; //3eme
					if($club[$i]==$tabTete[3]) $tirageFinalQuart2[$nbSousTab-$nbInPoule+1] = $club[$i]; //3eme
				} else {
					$bInsert = false;
					for($j=0; $j< count($tirageFinalQuart2); $j++) {
						if($tirageFinalQuart2[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
							$tirageFinalQuart2[$j] = $club[$i];
							$bInsert = true;
							break;
						}
					}
					if(! $binsert) {
						for($j=1; $j< count($tirageFinalQuart3); $j++) {
							if($tirageFinalQuart3[$j] != "#") {
								$tirageFinalQuart3[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
					if(! $binsert) {
						for($j=0; $j< count($tirageFinalQuart4); $j++) {
							if($tirageFinalQuart4[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
								$tirageFinalQuart4[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
				}
			}
			if(in_array($i+1,$tabTrois)) {
				if(in_array($club[$i],$tabTete)) { //Si tete de serie
					if($club[$i]==$tabTete[0]) $tirageFinalQuart1[0] = $club[$i]; //1er
					if($club[$i]==$tabTete[1]) $tirageFinalQuart4[$nbSousTab-$nbInPoule+1] = $club[$i]; //2eme
					if($club[$i]==$tabTete[2]) $tirageFinalQuart3[0] = $club[$i]; //3eme
					if($club[$i]==$tabTete[3]) $tirageFinalQuart2[$nbSousTab-$nbInPoule+1] = $club[$i]; //3eme
				} else {
					$bInsert = false;
					for($j=1; $j< count($tirageFinalQuart3); $j++) {
						if($tirageFinalQuart3[$j] != "#") {
							$tirageFinalQuart3[$j] = $club[$i];
							$bInsert = true;
							break;
						}
					}
					if(! $binsert) {
						for($j=0; $j< count($tirageFinalQuart4); $j++) {
							if($tirageFinalQuart4[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
								$tirageFinalQuart4[$j] = $club[$i];
								$bInsert = true;
								break;
							}
						}

					}
				}
			}
			if(in_array($i+1,$tabQuatre)) {
				if(in_array($club[$i],$tabTete)) { //Si tete de serie
					if($club[$i]==$tabTete[0]) $tirageFinalQuart1[0] = $club[$i]; //1er
					if($club[$i]==$tabTete[1]) $tirageFinalQuart4[$nbSousTab-$nbInPoule+1] = $club[$i]; //2eme
					if($club[$i]==$tabTete[2]) $tirageFinalQuart3[0] = $club[$i]; //3eme
					if($club[$i]==$tabTete[3]) $tirageFinalQuart2[$nbSousTab-$nbInPoule+1] = $club[$i]; //3eme
				} else {
					$bInsert = false;
					for($j=0; $j< count($tirageFinalQuart4); $j++) {
						if($tirageFinalQuart4[$j] != "#" && $j != ($nbSousTab-$nbInPoule+1)) {
							$tirageFinalQuart4[$j] = $club[$i];
							$bInsert = true;
							break;
						}
					}
				}
			}
		}
	}


	echo $typeTirage."<br />quart 1<br />";
	foreach ($tirageFinalQuart1 as $value) echo $value." ";
	echo $typeTirage."<br />quart 2<br />";
	foreach ($tirageFinalQuart2 as $value) echo $value." ";
	echo $typeTirage."<br />quart 3<br />";
	foreach ($tirageFinalQuart3 as $value) echo $value." ";
	echo $typeTirage."<br />quart 4<br />";
	foreach ($tirageFinalQuart4 as $value) echo $value." ";

	//Merge des 2 sous quart de tableaux -> 2 demi tableaux
	$demiTab1 = array_merge($tirageFinalQuart1, $tirageFinalQuart2);
	$demiTab2 = array_merge($tirageFinalQuart3, $tirageFinalQuart4);
	$reste = count($demiTab1) % $nbInPoule;
	$quotient = count($demiTab1) / $nbInPoule;
	$nbTour = (int)$quotient * $nbInPoule;


	echo $typeTirage."<br />demi 1<br />";
	foreach ($demiTab1 as $value) echo $value." ";
	echo $typeTirage."<br />demi2<br />";
	foreach ($demiTab2 as $value) echo $value." ";


	//si la taille de demitab1 / nbInPoule = 0 => on merge les 2demi tab
	if( $reste = 0) {
		$tirageFinal = array_merge($tirageFinal, $demiTab1);
		$tirageFinal = array_merge($tirageFinal, $demiTab2);
	} else {
		for($i=0; $i<$nbTour;$i++) array_push($tirageFinal,$demiTab1[$i]);
		for($i=$nbTour; $i<count($demiTab1);$i++) array_push($demiTab2,$demiTab1[$i]);

		$tirageFinal = array_merge($tirageFinal, $demiTab2);
	}
	$typeTirage .= "<br />Ecart des clubs et des tetes de series<br />";
	echo $typeTirage."<br />";
	foreach ($tirageFinal as $value) echo $value." ";
}


//echo "<br />===>tirageFinal : <br />";
//foreach ($tirageFinal as $value) echo $value." - ";
echo "<br />===>FIN";
?>
</body>
</html>