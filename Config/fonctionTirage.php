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
	foreach ($listeCompetiteur as $competiteur) {
		$bOkPlacement = false;
		$posFinale = 0;
	
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
							$bOkPlacement = false;
							break;
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