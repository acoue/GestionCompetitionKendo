<?php

function createListeFinale($nb) {
	$listeFinale = array();
	for($i=0;$i<$nb;$i++) array_push($listeFinale,"#");
	return $listeFinale;
}

function getClub($competiteur) {
	$retour = "";
	if(! empty($competiteur)) {
		if($competiteur > -1) $retour = substr($competiteur,strpos($competiteur, "_")+1);
		else $retour = -1;
	} else $retour = -1;
	return $retour;
}

function repartitionTete($tabTete,$listeFinale,$nbInPoule,$nbCompetiteur) {
	//1er => poule 1
	if($tabTete[0] > -1 ) $listeFinale[0] = $tabTete[0];
	
	//2eme => derniere poule
	$place2 = $nbCompetiteur - $nbInPoule;
	if($tabTete[1] > -1 ) $listeFinale[$place2] = $tabTete[1];
	
	//3eme => 2eme poule
	$place3 = $nbInPoule;
	if($tabTete[2] > -1 ) $listeFinale[$place3] = $tabTete[2];
	
	//3eme ex-aequo => avant derni�re poule
	$place3Bis = $place2-$nbInPoule;
	if($tabTete[3] > -1 ) $listeFinale[$place3Bis] = $tabTete[3];
	
	return $listeFinale;
}

function repartitionTeteTableau($tabTete,$listeFinale) {
	//1er => poule 1 - 1er
	if($tabTete[0] > -1 ) $listeFinale[0] = $tabTete[0];

	//2eme => poule 2 - 1er
	if($tabTete[1] > -1 ) $listeFinale[2] = $tabTete[1];

	//3eme => poule 3 - 1er
	if($tabTete[2] > -1 ) $listeFinale[4] = $tabTete[2];

	//3eme => poule 4 - 1er
	if($tabTete[3] > -1 ) $listeFinale[6] = $tabTete[3];

	return $listeFinale;
}

function repartitionSimple($listeCompetiteur,$listeFinale) {
	//Shuffle
	shuffle($listeCompetiteur);
	foreach ($listeCompetiteur as $Competiteur) {
		$posFinale = 0;
		// On se positionne sur un emplacement libre
		while($listeFinale[$posFinale] !== "#") $posFinale++;
		//On place dans la listeFinale
		$listeFinale[$posFinale] = $Competiteur;
	}
	return $listeFinale;
}

function repartitionClub($listeCompetiteur,$listeFinale,$nbInPoule) {
	$nbCompetiteur = count($listeCompetiteur);
	foreach ($listeCompetiteur as $competiteur) {
		$bOkPlacement = false;
		$posFinale = 0;
		//$posFinale = rand(0,$nbCompetiteur-$nbInPoule);
	
		while(! $bOkPlacement) {
			// On se positionne sur un emplacement libre
			while($listeFinale[$posFinale] !== "#") $posFinale++;
	
			//Position debut et fin de poule pour la comparaison des clubs
			$debutPoule = ((int)($posFinale/$nbInPoule))*$nbInPoule;
			$finPoule = $debutPoule + $nbInPoule - 1;
	
			//Verification si meme club dans la poule
			for($j = $debutPoule;$j <= $finPoule;$j++) {
				if($j != $posFinale) {
					if($listeFinale[$j] == "#"){
						$bOkPlacement = true;
					} else {
						if(getClub($competiteur) != getClub($listeFinale[$j])) {
							$bOkPlacement = true;
						} else {
							$posFinale = $finPoule+1;
							if($posFinale >= $nbCompetiteur){
								$posFinale = 0;
								while($listeFinale[$posFinale] !== "#") $posFinale++;
								$bOkPlacement = true;
								break;
							} else {
								$bOkPlacement = false;
								break;
							}
						}
					}
				}
			}
			//Si $bOkPlacement = true => pas de club identique on place dans la listeFinale
			if($bOkPlacement) $listeFinale[$posFinale] = $competiteur;
		}
	}
	return $listeFinale;
}

function repartitionClubTest($listeCompetiteur,$listeFinale,$nbInPoule) {
	$nbCompetiteur = count($listeCompetiteur);
	foreach ($listeCompetiteur as $competiteur) {
		$bOkPlacement = false;
		//$posFinale = 0;
		$posFinale = rand(0,$nbCompetiteur-1);
		$nbTour = 0;

		while(! $bOkPlacement) {
			$nbTour++;
			// On se positionne sur un emplacement libre
			while($listeFinale[$posFinale] !== "#") {
				if ($posFinale > ($nbCompetiteur-1)) $posFinale = 0;
				else $posFinale++;
			}
				
			//Position debut et fin de poule pour la comparaison des clubs
			$debutPoule = ((int)($posFinale/$nbInPoule))*$nbInPoule;
			$finPoule = $debutPoule + $nbInPoule - 1;

			//Verification si meme club dans la poule
			for($j=$debutPoule;$j<=$finPoule;$j++) {
				if($j <= $posFinale) {
					if($listeFinale[$j] == "#"){
						$bOkPlacement = true;
					} else {
						if(getClub($competiteur) != getClub($listeFinale[$j])) {
							$bOkPlacement = true;
						} else {
							$posFinale = $finPoule+1;
							if($posFinale >= $nbCompetiteur-1){
								$posFinale = 0;
								if ($nbTour == 2){
									while($listeFinale[$posFinale] !== "#") {
										if ($posFinale > ($nbCompetiteur-1)) $posFinale = 0;
										else $posFinale++;
									}
									$bOkPlacement = true;
									break;
								}
							} else {
								$bOkPlacement = false;
								break;
							}
						}
					}
				} else {
					$posFinale = 0;
					$bOkPlacement = false;
				}
			}
			//Si $bOkPlacement = true => pas de club identique on place dans la listeFinale
			if($bOkPlacement) $listeFinale[$posFinale] = $competiteur;
		}
	}
	return $listeFinale;
}