<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Organisation.php';
require_once 'Modele/Gestion.php';
require_once 'Modele/Resultat.php';
require_once 'Classes/PHPExcel.php';
require_once 'Config/fonction.php';
require_once 'Config/fonctionTirage.php';

class ControleurOrganisation {

	private $organisation;
	private $gestion;
	private $resultat;
	
   	public function __construct() {
    	$this->organisation = new Organisation();
    	$this->gestion = new Gestion();
    	$this->resultat = new Resultat();
    }

    public function afficherRepartition($id) { 
    	$competition = $this->gestion->getIdCompetitionSelected();
    	if($id > 0) {
    		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($id,$competition);
    		$licencies = $this->organisation->getLicenciesNotInCategorie($id,$competition);
    	}
	    else {
	    	$licenciesCategorie = null;
	    	$licencies = $this->organisation->getLicenciesClub();
	    }
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $id;
        $vue = new Vue("Organisation","Repartition");
        $vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
    }

	public function ajouterRepartition($categorie,$licencie) {
		$erreur = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
		foreach($licencie as $elt){
			$result = $this->organisation->addLicencieInCategorie($categorie,$elt,$competition);
			if(! empty($result)) {
				$erreur[] = "R&eacute;partition pour la cat&eacute;gorie $categorie : ajout de $elt";
				Log::loggerInformation("Repartition pour la categorie $categorie : ajout de $elt");
			} else {
				$erreur[] = "Erreur dans la r&eacute;partition pour la cat&eacute;gorie $categorie pour ajout de $elt";
				Log::loggerInformation("Erreur dans la repartition pour la categorie $categorie pour ajout de $elt");
			}
		}
		
		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		$licencies = $this->organisation->getLicenciesNotInCategorie($categorie,$competition);
		$categories = $this->gestion->getCategories();
		$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Repartition");
		$vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), $erreur);
	}

	public function supprimerRepartition($id,$categorie) {
		$erreur = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
		$result = $this->organisation->deleteLicencieInCategorie($id);
		if(! empty($result)) {
			$erreur[] = "R&eacute;partition supprim&eacute;e";
			Log::loggerInformation("Repartition supprimee");
		} else {
			$erreur[] = "Erreur dans la suppression de la r&eacute;partition";
			Log::loggerInformation("Erreur dans la suppression de la repartition ");
		}
		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		$licencies = $this->organisation->getLicenciesNotInCategorie($categorie,$competition);
		$categories = $this->gestion->getCategories();
		$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Repartition");
		$vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), $erreur);
	
	}
//Tirage au sort
	public function afficherTirage($id) {
		$result = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
    	if($id > 0) {
    		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($id,$competition);
			// Recuperation des competiteurs
			$dateTirage = $this->organisation->getDateTirage($id,$competition);
			$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($id,$competition);
    	}
	    else {
	    	$licenciesCategorie = null;
	    	$result = null;
	    	$dateTirage = "-";
	    	$licenciesTirage = null;
	    }
    	$categories = $this->gestion->getCategoriesIndividuel();
    	$categorieSelected = $id;
		$vue = new Vue("Organisation","Tirage");
	 	$vue->generer(array('licenciesTirage'=>$licenciesTirage,'dateTirage'=>$dateTirage,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
   	}
   	
   	public function afficherTirageEquipe($id) {
   		$result = array();
   		$competition = $this->gestion->getIdCompetitionSelected();
   		if($id > 0) {
   			$licenciesCategorie = $this->organisation->getLicenciesInCategorie($id,$competition);
   			// Recuperation des competiteurs
   			$dateTirage = $this->organisation->getDateTirage($id,$competition);
   			$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($id,$competition);
   		}
   		else {
   			$licenciesCategorie = null;
   			$result = null;
   			$dateTirage = "-";
   			$licenciesTirage = null;
   		}
   		$categories = $this->gestion->getCategoriesEquipes();
   		$categorieSelected = $id;
   		$vue = new Vue("Organisation","TirageEquipe");
   		$vue->generer(array('licenciesTirage'=>$licenciesTirage,'dateTirage'=>$dateTirage,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
   	}
   	
	public function effectuerTirage($categorie,$nbInPoule,$ecartClub,$ecartTete,$tabTete) {

		$competition = $this->gestion->getIdCompetitionSelected();	
		// Supression table historique tirage 
		$this->organisation->deleteHistoriqueTirage($categorie,$competition);
		// Suppression table tirage
		$this->organisation->deleteTirage($categorie,$competition);
		// Recuperation des competiteurs
		$dateTirage = $this->organisation->getDateTirage($categorie,$competition);
		//suppression combats
		$this->organisation->deleteCombatPoule($categorie,$competition);
		//Suppression resultat poule
		$this->resultat->deleteResultatPoule($categorie,$competition);
		//Suppression des fichiers poule et tableau
		$dirname = 'Ressources/';
		$dir = opendir($dirname);
		$libCategorieSelected = $this->gestion->getCategorie($categorie);
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
				if (strrpos($file, $competition.'_'.$libCategorieSelected['libelle'])!==false) unlink($dirname.$file);
			}
		}
		closedir($dir);

		//Variables
		$typeTirage = "Type de tirage : ";
    	if ($nbInPoule > -1 ) { //Tirage par poule
    		$tiragePoule4 = false;
	    	// Recuperation des competiteurs
	    	$Nblicencies = $this->organisation->getNombreLicenciesInCategorie($categorie,$competition);

	    	if($Nblicencies > 9 && $nbInPoule = 3) { //On travaille que sur les tirage des poules de 3
		    	// Nouveau test éventiel :
		    	// - 10 participants : 2 poules de 3 et 1 poule de 4
		    	// - 11 participants : 3 poules de 3 et 1 poule de 2
		    	// - 17 participants : 3 poules de 3 et 2 poules de 4
		    	// Pour ça si 11 ajout d'un pseudo participants "-" pour avoir une poule de 2
		    	$retrait = 0;
		    	$nbCompetiteur = $Nblicencies;
		    	while($nbCompetiteur % $nbInPoule !=  0) {
		    		$retrait++;
		    		$nbCompetiteur--;
		    	}
		    	if($retrait > 1) {
		    		$nbPoule = (int)($Nblicencies / $nbInPoule);
		    		if($nbPoule % 2==0) {
		    			//2 poules de 4
	    				$tiragePoule4 = true;
		    		} else {
		    			//1 poule de 2
		    	    	$this->organisation->addLicencieInCategorie($categorie,1,$competition); //ajout du licencié -
	    				$tiragePoule4 = false;
		    		}
		    	} 
// 		    	else {
// 		    		//2 poule de 2 : cas 10 participants => 2 poules de 3 et 2 poules de 2 au lieu de 2 poules de 3 et d'une poule de 4
// 		    	    $this->organisation->addLicencieInCategorie($categorie,1,$competition); //ajout du licencié -
// 		    	    $this->organisation->addLicencieInCategorie($categorie,2,$competition); //ajout du licencié --
// 	    			$tiragePoule4 = false;
// 		    	}
	    	}
    		
    		//Tirage au sort
    		if($ecartClub == 0 && $ecartTete == 0) { // 1. Pas d'ecartement
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			shuffle($licenciesCategorie);
    			$typeTirage .= "Pas d'ecart des clubs et des tetes de series";
    		}
    		else if($ecartClub == 0 && $ecartTete == 1) { // 2. Ecartement des tetes de series
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirage($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			//Recuperation des information pour les tete de serie
    			$teteForTirage = $this->constructListeCompetiteurTirageTete($categorie,$competition,$tabTete);
    			$licenciesCategorie = $this->makeTirageTeteSansClub($licenciesCategorie,$teteForTirage,$nbInPoule);
    			$typeTirage .= "Pas d'ecart des clubs, mais ecart des tetes de series";
    		}
    		else if($ecartClub == 1 && $ecartTete == 0) { // 3. Ecartement des clubs
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirageClub($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			$licenciesCategorie = $this->makeTirageClubSansTete($licenciesCategorie,$nbInPoule,$tiragePoule4);
    			$typeTirage .= "Ecart des clubs et mais pas d'ecart des tetes de series";
    		}
    		else if($ecartClub == 1 && $ecartTete == 1) { // 4. Ecartement des clubs et des tetes de series
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirageClub($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			//Recuperation des information pour les tete de serie
    			$teteForTirage = $this->constructListeCompetiteurTirageTete($categorie,$competition,$tabTete);
    			$licenciesCategorie = $this->makeTirageClubAndTete($licenciesCategorie,$teteForTirage,$nbInPoule,$tiragePoule4);
    			$typeTirage .= "Ecart des clubs et des tetes de series";
    		}
    		//Répartition dans la table licencie_categorie -> tirage
	    	$iNumero = 1;
	    	$iBoucle=1;
	    	if( $nbParticipantInCategorie % $nbInPoule == 0){
	    		for($i=0;$i<$nbParticipantInCategorie;$i++) {
	    			if ($iNumero <= $nbInPoule) {
	    				$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    				$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    				$iNumero++;
	    			} else {
	    				$iBoucle++;
	    				$iNumero = 1;
	    				$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    				$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    				$iNumero++;
	    			}
	    		}
	    	} else {
	    		$quotient = (int) ($nbParticipantInCategorie / $nbInPoule); // on prend la partie entiere du resultat de la division
	    		//$reste = $nbParticipant - ($quotient * $nbInPoule);
	    		$reste = $nbParticipantInCategorie % $nbInPoule;
	
	    		$iBoucle = 1;
	    		$iNumero = 1;
	    		for($i=0;$i<$nbParticipantInCategorie;$i++) {
	    			if ($iBoucle <= ($quotient-$reste)){
	    				if ($iNumero <= $nbInPoule) {
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				} else {
	    					$iBoucle++;
	    					$iNumero = 1;
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				}
	    			} else {
	    				if ($iNumero <= $nbInPoule +1) {
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				} else {
	    					$iBoucle++;
	    					$iNumero = 1;
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				}
	    			}
	    		}
	    	}
	    	
	    	//Suppression des ligne poule = 0
	    	//$this->organisation->deleteTiragePouleNull($categorie,$competition);
	    	
	    	//Creation combats
	    	$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$competition);
	    	$tabCombat = array();
	    	$tmpPoule="";
	    	$iCpt = 1;
	    	foreach ($licenciesTirage as $tirage) {
	    		$tmpPoule1 = $tirage['numero_poule'];
	    		$lic = $tirage[1];
	    		if($tmpPoule!="" && $tmpPoule != $tmpPoule1) {
	    			// Insertion
	    			$this->createCombat($tabCombat,$categorie,$tmpPoule,$competition);
	    			//vide tableau
	    			unset($tabCombat);
	    			$tabCombat = array();
	    		}
	    		array_push($tabCombat, $lic);
	    		$tmpPoule = $tmpPoule1;
	    	}
	    	
	    	//Generation des combat dans la table combat
	    	$this->createCombat($tabCombat,$categorie,$tmpPoule,$competition);
    	} else {
    		//tableau direct
    		//Tirage au sort
    		if($ecartClub == 0 && $ecartTete == 0) { // 1. Pas d'ecartement
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			shuffle($licenciesCategorie);
    			$typeTirage .= "Pas d'ecart des clubs et des tetes de series";
    		}
    		else if($ecartClub == 0 && $ecartTete == 1) { // 2. Ecartement des tetes de series
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirage($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			//Recuperation des information pour les tete de serie
    			$teteForTirage = $this->constructListeCompetiteurTirageTete($categorie,$competition,$tabTete);
    			$licenciesCategorie = $this->makeTirageTeteSansClubTableau($licenciesCategorie,$teteForTirage);
    			$typeTirage .= "Pas d'ecart des clubs, mais ecart des tetes de series";
    		}
    		else if($ecartClub == 1 && $ecartTete == 0) { // 3. Ecartement des clubs
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirageClub($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			$licenciesCategorie = $this->makeTirageClubSansTete($licenciesCategorie,2);
    			$typeTirage .= "Ecart des clubs et mais pas d'ecart des tetes de series";
    		}
    		else if($ecartClub == 1 && $ecartTete == 1) { // 4. Ecartement des clubs et des tetes de series
    			// Recuperation des competiteurs
    			$licenciesCategorie = $this->constructListeCompetiteurTirageClub($categorie,$competition);
    			$nbParticipantInCategorie = count($licenciesCategorie);
    			//Recuperation des information pour les tete de serie
    			$teteForTirage = $this->constructListeCompetiteurTirageTete($categorie,$competition,$tabTete);
    			$licenciesCategorie = $this->makeTirageClubAndTeteTableau($licenciesCategorie,$teteForTirage);
    			$typeTirage .= "Ecart des clubs et des tetes de series";
    		}
    		
    		//On parcours la poule -> insertion dans resultat_poule
    		//1er = 1er poule 1
    		//2eme = 2eme poule 1
    		//....
    		$iBoucle = 1;
    		$iNumero = 0;
    		for($i=0;$i<$nbParticipantInCategorie;$i++) {
    			
    			//Insertion du tirage
    			if($iNumero == 2){
    				$iBoucle++;
    				$iNumero = 1;
    			} else $iNumero++;
    			$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero,$competition);
    			//Insertion dans resultat_poule
    			$this->organisation->insertResultatTableau($iBoucle, $licenciesCategorie[$i]['idlicencie'], $iNumero, $categorie,$competition);
    		}
    		
    		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$competition);
    		$result[] = "Tirage en tableau effectué";
    	}
    	//Insertion dans la table historique
    	$this->organisation->insertHistoriqueTirage($categorie,$competition);

    	
		$result = array();
    	$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		// Recuperation des competiteurs
		$dateTirage = $this->organisation->getDateTirage($categorie,$competition);
		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$competition);
    	
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Tirage");
	 	$vue->generer(array('typeTirage'=>$typeTirage, 'licenciesTirage'=>$licenciesTirage,'dateTirage'=>$dateTirage,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
    }

    private function constructListeCompetiteurTirage($categorie,$competition) {
    	$listeFinaleCompetiteur = array();
    	$listeTravail = $this->organisation->getLicenciesInCategorieForTirage($categorie,$competition);
    	foreach ($listeTravail as $tmpTravail) {
    		array_push($listeFinaleCompetiteur,$tmpTravail['licencie']);
    	}
    	
    	return $listeFinaleCompetiteur;
    }
    
    private function constructListeCompetiteurTirageClub($categorie,$competition) {
    	$licenciesTirage = $this->organisation->getTriClubForTirage($categorie,$competition);
    	$listeFinaleCompetiteur = array();
    	$listeTravail = array();
    	foreach ($licenciesTirage as $tmpLicencie) {
    		$listeTravail = $this->organisation->getLicenciesInCategorieForTirageClub($categorie,$competition,$tmpLicencie['club']);
    		shuffle($listeTravail);
    		foreach ($listeTravail as $tmpTravail) {
    			array_push($listeFinaleCompetiteur,$tmpTravail['licencie']);
    		}
    		$listeTravail = array();
    	}
    	return $listeFinaleCompetiteur;
    }

    private function constructListeCompetiteurTirageTete($categorie,$competition,$tabTete) {
    	$listeFinaleCompetiteur = array();
    	$listeTravail = array();
    	foreach ($tabTete as $tete) {
    		if($tete > -1) {
    			$listeTravail = $this->organisation->getLicenciesForTirageTete($categorie,$competition,$tete);
    			array_push($listeFinaleCompetiteur,$listeTravail['licencie']);
    		} else array_push($listeFinaleCompetiteur,-1);
    	}
    	return $listeFinaleCompetiteur;
    }
    
 
   	private function makeTirageClubAndTete($listeCompetiteur,$tabTete,$nbInPoule,$bool) {
   		$nbCompetiteur = count($listeCompetiteur);
   		if(! $bool){
	   		$listeFinale = createListeFinale($nbCompetiteur);
	   		//repartition tete
	   		$listeFinale = repartitionTete($tabTete, $listeFinale,$nbInPoule,$nbCompetiteur);
	   		//Retirer tete de la liste
	   		$resteCompetiteur = array_values(array_diff($listeCompetiteur, $listeFinale));
	   		//Tirage suivant l'algo club
	   		$listeFinale = repartitionClub($resteCompetiteur,$listeFinale,$nbInPoule);
   		} else {// Si 2 poules de 4 quand tirage de 3
   			$retrait = 2;
   			$nbCompetiteur = $nbCompetiteur - $retrait;
   			//creation liste finale
   			$listeFinale = createListeFinale($nbCompetiteur);
	   		//repartition tete
	   		$listeFinale = repartitionTete($tabTete, $listeFinale,$nbInPoule,$nbCompetiteur);
	   		//Retirer tete de la liste
	   		$resteCompetiteur = array_values(array_diff($listeCompetiteur, $listeFinale));
	   		
   			//On retire les $retrait competiteurs
   			$complementAjout = array();
   			for($i=0;$i<$retrait;$i++){
   				$emplDernier=count($resteCompetiteur)-1;
   				array_push($complementAjout,$resteCompetiteur[$emplDernier]);
   				array_pop($resteCompetiteur);
   			}
   			//Tirage suivant l'algo club
   			$listeFinale = repartitionClub($resteCompetiteur,$listeFinale,$nbInPoule);
   			//On remet les $retrait competiteurs => normalement 2
   			flush($complementAjout);
   			$listeFinale = $this->insertElement($listeFinale,$complementAjout[0],$nbCompetiteur-$nbInPoule); //insertion dans la premier poule de 4
   			array_push($listeFinale, $complementAjout[1]); // inserton dans la deuxieme poule de 4
   			
   		}
   		//on retrouve les information pour la suite : constitution poule, ....
   		$listeTravail = $this->getInformationLicencie($listeFinale);
   
   		return $listeTravail;
   	}

   	private function makeTirageClubSansTete($listeCompetiteur,$nbInPoule,$bool) {
   		$nbCompetiteur = count($listeCompetiteur);
		
   		if(! $bool){
			//creation liste finale
			$listeFinale = createListeFinale($nbCompetiteur);
			//Tirage suivant l'algo club
			$listeFinale = repartitionClub($listeCompetiteur,$listeFinale,$nbInPoule);
   		} else { // Si 2 poules de 4 quand tirage de 3
   			$retrait = 2;
   			$nbCompetiteur = $nbCompetiteur - $retrait;
   			//creation liste finale
   			$listeFinale = createListeFinale($nbCompetiteur);
   			//On retire les $retrait competiteurs
   			$complementAjout = array();
   			for($i=0;$i<$retrait;$i++){
   				$emplDernier=count($listeCompetiteur)-1;
   				array_push($complementAjout,$listeCompetiteur[$emplDernier]);
   				array_pop($listeCompetiteur);
   			}
   			//Tirage suivant l'algo club
   			$listeFinale = repartitionClub($listeCompetiteur,$listeFinale,$nbInPoule);
   			//On remet les $retrait competiteurs => normalement 2
   			flush($complementAjout);
   			$listeFinale = $this->insertElement($listeFinale,$complementAjout[0],$nbCompetiteur-$nbInPoule); //insertion dans la premier poule de 4
   			array_push($listeFinale, $complementAjout[1]); // inserton dans la deuxieme poule de 4
   		}
   		
   		//on retrouve les information pour la suite : constitution poule, .... -> NE PAS COMMENTER
   		$listeTravail = $this->getInformationLicencie($listeFinale);
   
   		return $listeTravail;
   	}

   	private function insertElement($tab,$valeurInsert,$indice) { //Atention debut de l'indice = 0
   		$nouveauTab = array();
   		for($i=0;$i<count($tab);$i++) {
   			if ($i == $indice) array_push($nouveauTab,$valeurInsert);
   			array_push($nouveauTab,$tab[$i]);
   		}
   		return $nouveauTab;
   	}
   	
   	private function makeTirageClubAndTeteTableau($listeCompetiteur,$tabTete) {
   		$nbCompetiteur = count($listeCompetiteur);
   		//creation liste finale
   		$listeFinale = createListeFinale($nbCompetiteur);
   	
   		//repartition tete
   		$listeFinale = repartitionTeteTableau($tabTete, $listeFinale);
   	
   		//Retirer tete de la liste
   		$resteCompetiteur = array_values(array_diff($listeCompetiteur, $listeFinale));
   		//Shuffle
   		//shuffle($resteCompetiteur);
   	
   		//Tirage suivant l'algo club
   		$listeFinale = repartitionClub($resteCompetiteur,$listeFinale,2);
   		 
   		//on retrouve les information pour la suite : constitution poule, ....
   		$listeTravail = $this->getInformationLicencie($listeFinale);
   		 
   		return $listeTravail;
   	}

   	private function makeTirageTeteSansClub($listeCompetiteur,$tabTete,$nbInPoule) {
   		$nbCompetiteur = count($listeCompetiteur);
   		//creation liste finale
   		$listeFinale = createListeFinale($nbCompetiteur);
   		
   		//repartition tete
   		$listeFinale = repartitionTete($tabTete, $listeFinale,$nbInPoule,$nbCompetiteur);
   		
   		//Retirer tete de la liste
   		$resteCompetiteur = array_values(array_diff($listeCompetiteur, $listeFinale));
   		
   		//Tirage simple
   		$listeFinale = repartitionSimple($resteCompetiteur,$listeFinale);

   		//on retrouve les information pour la suite : constitution poule, ....
   		$listeTravail = $this->getInformationLicencie($listeFinale);
   
   		return $listeTravail;
   	}

   	private function makeTirageTeteSansClubTableau($listeCompetiteur,$tabTete) { //A FAIRE
   		$nbCompetiteur = count($listeCompetiteur);
   		//creation liste finale
   		$listeFinale = createListeFinale($nbCompetiteur);
   		 
   		//repartition tete
   		$listeFinale = repartitionTeteTableau($tabTete, $listeFinale);
   		 
   		//Retirer tete de la liste
   		$resteCompetiteur = array_values(array_diff($listeCompetiteur, $listeFinale));
   		 
   		//Tirage simple
   		$listeFinale = repartitionSimple($resteCompetiteur,$listeFinale);
   	
   		//on retrouve les information pour la suite : constitution poule, ....
   		$listeTravail = $this->getInformationLicencie($listeFinale);
   		 
   		return $listeTravail;
   	}
   	
   	private function getInformationLicencie($listeUtilisateur) {
   		//on retrouve les information pour la suite : constitution poule, ....
   		$listeTravail = array();
   		foreach ($listeUtilisateur as $utilisateur) {
   			$idLicencie = substr($utilisateur,0,strpos($utilisateur, "_"));
   			//$idLicencie = $utilisateur['idlicencie'];
   			$licencie = $this->organisation->getInformationByLicencies($idLicencie);
   			array_push($listeTravail, $licencie);
   		}
   		return $listeTravail;
   	}
   	
	private function createCombat($tabCombat,$categorie,$tmpPoule1,$competition) {

		$competition = $this->gestion->getIdCompetitionSelected();
		//Insertion
		if(count($tabCombat) == 3){ // 1x2 - 1x3 - 2x3
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],3,$tmpPoule1,$competition);
		} else if(count($tabCombat) == 4){ // 1x2 - 3x4 - 1x4 - 1x3 - 2x3 - 2x4
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[3],3,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],4,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],5,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],6,$tmpPoule1,$competition);
		} else if(count($tabCombat) == 5){ // 1x2 - 3x4 - 1x5 - 2x3 - 4x5 - 1x3 - 2x5 - 1x4 - 3x5 - 2x4
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[4],3,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],4,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[3],$tabCombat[4],5,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],6,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[4],7,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[3],8,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[4],9,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[3],10,$tmpPoule1,$competition);
		}
	}
	
	public function afficherPoule($id) {

	   	if($id > 0) {
	   		$competition = $this->gestion->getIdCompetitionSelected();
	   		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($id,$competition);
	   	} else {
	   		$licenciesTirage = null;
	   	}
	   	$categories = $this->gestion->getCategories();
	   	$categorieSelected = $id;
	   	$libCategorieSelected = $this->gestion->getCategorie($id);
	   	$vue = new Vue("Organisation","Poule");
	   	$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	 
   	}
   	
   	public function genererExcelPoule($categorie) {
   		
   		//Recuperation date de la competition
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		$competition = $compet["idcompetition"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		$nbPoule = $this->organisation->getNombrePoule($categorie,$competition);
   		
   		for($i=1;$i<=$nbPoule;$i++) {
   			$competiteurInPoule = $this->organisation->getCompetiteurInPoule($categorie, $i, $competition);
   			$nbCompetiteur = $this->organisation->getNombreCompetiteurInPoule($categorie, $i, $competition);
 	
   			$objet = PHPExcel_IOFactory::createReader('Excel5');
   			$excel = $objet->load('Data/poule'.$nbCompetiteur.'.xls');
   			$sheet = $excel->getSheet(0);
   			$sheet->setCellValue("H1", aff_date_court($competDate));
   			$sheet->setCellValue("H3", $categorieLibelle);
   			$sheet->setCellValue("C6", $competLibelle);
   			
   			$row = 18;
   			foreach ($competiteurInPoule as $tirage) {
   				$club = $tirage[2];
   				$licencie = trim(rtrim(Securite::decrypteData($tirage["prenom"])))." ".trim(rtrim(Securite::decrypteData($tirage["nom"])));
   				$sheet->setCellValue("B".$row, $licencie);
   				$row = $row + 2;
   				$sheet->setCellValue("B".$row, $club);
   				$row++;
   			}
   			
   			$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
   			$writer->save('Ressources/'.$competition.'_'.$categorieLibelle.'_poule_'.$i.'.xls');
   			
   		}
   		
   		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$competition);
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
	   	$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		$vue = new Vue("Organisation","Poule");
   		$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	}
   	
   	public function afficherTableau($categorie) {

   		$competition = $this->gestion->getIdCompetitionSelected();
   		if($categorie > 0) {
   			$licenciesTableau = $this->organisation->getLicencieInTableau($categorie,$competition);
   			$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		} else {
   			$licenciesTableau = null;
   			$libCategorieSelected = "";
   		}
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
   		$vue = new Vue("Organisation","Tableau");
   		$vue->generer(array('licenciesTableau'=>$licenciesTableau,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   		 
   	}
   	
   	public function imprimerTableau($categorie) {
   		 
   		//Recuperation date de la competition
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		$competition = $compet["idcompetition"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		
   		$licenciesTableau = $this->organisation->getLicencieInTableau($categorie,$competition);
   		$nb = count($licenciesTableau);
   		$nbCompetiteur = 0;
   		$tabTableau = array(4,8,12,16,24,32,36,48,64,96);

   		for ($i=0; $i<count($tabTableau); $i++) {
   			if($nb <= $tabTableau[$i]) {
   				$nbCompetiteur = $tabTableau[$i];
   				break;
   			}
   		}
   		
   		$objet = PHPExcel_IOFactory::createReader('Excel5');
   		$excel = $objet->load('Data/tableau'.$nbCompetiteur.'.xls');
   		$sheet = $excel->getSheet(0);
   		$sheet->setCellValue("H2", aff_date_court($competDate));
   		$sheet->setCellValue("H4", $categorieLibelle);
   		$sheet->setCellValue("D9", $competLibelle);
   	
   		for ($row=10; $row<81; $row++) { //nombre de ligne max tableau de 96
   			$valeur = $sheet->getCell("B".$row)->getValue();
   			if(!empty($valeur)) {
   				if(strrpos($valeur, '.')!==false){
   					$resClassement = explode(".", $valeur);
   					$poule = $resClassement[0]; 
   					$position = $resClassement[1];
   					$tirage = $this->organisation->getLicencieByClassementPoule($categorie, $poule, $position,$competition);
   					if(!empty($tirage)) {
   						$licencie = trim(rtrim(Securite::decrypteData($tirage['prenom'])))." ".trim(rtrim(Securite::decrypteData($tirage['nom'])));
   						$sheet->setCellValue("C".$row, $licencie);
   					} 
   				}
   			}
   		}
   		$row = 0;
   		if($nbCompetiteur > 30) { //Tableau sur 2 colonnes
   			for ($row=10; $row<81; $row++) { //nombre de lignes max tableau de 96
   				$valeur = $sheet->getCell("O".$row)->getValue();
   				if(!empty($valeur)) {
   					if(strrpos($valeur, '.')!==false){
   						$resClassement = explode(".", $valeur);
   						$poule = $resClassement[0];
   						$position = $resClassement[1];
   						$tirage = $this->organisation->getLicencieByClassementPoule($categorie, $poule, $position,$competition);
   						if(!empty($tirage)) {
   							$licencie = trim(rtrim(Securite::decrypteData($tirage['prenom'])))." ".trim(rtrim(Securite::decrypteData($tirage['nom'])));
   							$sheet->setCellValue("N".$row, $licencie);
   						}
   					}
   				}
   			}
   		}
   		
   		$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
   		$writer->save('Ressources/'.$competition.'_'.$categorieLibelle.'_tableau.xls');
   		
   		
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
   		$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		$vue = new Vue("Organisation","Tableau");
   		$vue->generer(array('licenciesTableau'=>$licenciesTableau,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	}
   	
   	public function afficherListePouleImpression($categorie) {
   		$competition = $this->gestion->getIdCompetitionSelected();
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		
   		$nbPoule = $this->organisation->getNombrePoule($categorie,$competition);
   		if($categorie > 0) {
   			$participant = $this->organisation->getTirageCategorie($categorie,$competition);
   			$nbByPoule = $this->organisation->getNombreParticipantByPoule($categorie,$competition);
   			//print_r($nbByPoule);
   		} else {
   			$participant = null;
   			$nbByPoule = null;
   		}
   		$categories = $this->gestion->getCategories();
   		 
   		$categorieSelected = $categorie;
   		$vue = new Vue("Organisation","ImpressionPoule");
   		$vue->generer(array('categories'=>$categories,'participant'=>$participant,'categorieSelected'=>$categorieSelected,'nbByPoule'=>$nbByPoule,'competDate'=>$competDate,'competLibelle'=>$competLibelle,'categorieLibelle'=>$categorieLibelle), null);
   	}
}

