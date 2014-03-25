<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Resultat.php';
require_once 'Modele/Gestion.php';

class ControleurResultat {

	private $resultat;
	private $gestion;
	private $organisation;
	
   	public function __construct() {
    	$this->resultat = new Resultat();
    	$this->gestion = new Gestion();
    	$this->organisation = new Organisation();
    }

    public function afficherResultatPoule($id) {

    	if($id > 0) $combats = $this->resultat->getCombatsPoule($id);
    	else $combats = null;
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $id;
    	$vue = new Vue("Resultat","CombatPoule");
    	$vue->generer(array('categories'=>$categories,'categorieSelected'=>$categorieSelected,'combat'=>$combats), null);
    }

    public function afficherResultatPouleSimple($id) {

    	if($id > 0) {
    		$licenciesTirage = $this->organisation->getTirageCategorieOrdonneWithClassement($id);
    	} else {
    		$licenciesTirage = null;
    	}
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $id;
    	$vue = new Vue("Resultat","CombatPouleSimple");
    	$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
    	 
    } 

    public function afficherCombatPoule($id) {
    	$combat = $this->resultat->getCombatPoule($id);
    	$vue = new Vue("Resultat","ResultatPoule");
    	$vue->generer(array('combat'=>$combat), null);
    }
    
    public function afficherCombatPouleSimple ($poule,$categorie) {
    	$participant = $this->resultat->getParticipantsInPoule($poule, $categorie);
    	$categorieSelected = $categorie;
    	$pouleSelected = $poule;
    	$vue = new Vue("Resultat","ResultatPouleSimple");
    	$vue->generer(array('participant'=>$participant,'categorieSelected'=>$categorieSelected,'pouleSelected'=>$pouleSelected), null);
    }
    
    public function razResultatPoule($poule,$categorie){

    	$this->resultat->razResultatCombatInTirage($poule,$categorie);
    	$this->resultat->razResultatCombatPoule($categorie,$poule);
    	
    	$combats = $this->resultat->getCombatsPoule($categorie);
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $categorie;
    	$vue = new Vue("Resultat","CombatPoule");
    	$vue->generer(array('categories'=>$categories,'categorieSelected'=>$categorieSelected,'combat'=>$combats), null);
    }
    
    
    public function envoyerResultat($idCombat,$vainqueur,$point1,$point2,$point3,$categorie){
    	$pointR = "";
    	$pointB = "";
    	$erreur = array();
    	//Mise a jour table combat poule
    	if(! empty($point1)) {
    		if (substr($point1,0,1) === 'B') $pointB .= substr($point1,1,1);
    		else $pointR .= substr($point1,1,1);
    	}
    	if(! empty($point2)) {
    		if (substr($point2,0,1) === 'B') $pointB .= substr($point2,1,1);
    		else $pointR .= substr($point2,1,1);    	
    	}
    	if(! empty($point3)) {
    		if (substr($point3,0,1) === 'B') $pointB .= substr($point3,1,1);
    		else $pointR .= substr($point3,1,1);
    	}
    	$pointR = str_replace("-", "", $pointR);
    	$pointB = str_replace("-", "", $pointB);
		
    	$nbPointR = 0;
    	$nbPointB = 0;
    	if(strlen($pointR) == 0) $pointR="-";
    	else $nbPointR = strlen($pointR);
    	
    	if(strlen($pointB) == 0) $pointB="-";
    	else $nbPointB = strlen($pointB);
    	
    	$result = $this->resultat->setResultatCombatPoule($idCombat,$pointR,$pointB,$vainqueur);
    	if(! empty($result)) {
    		$erreur[] = "R&eacutesultat renseign&eacute;s pour le combat $idCombat";
    		Log::loggerInformation("Resultat renseigne pour le combat $idCombat");
    	} else {
    		$erreur[] = "Erreur dans le renseignement du r&eacute;sultat pour le combat $idCombat";
    		Log::loggerInformation("Erreur dans le renseignement du resultat pour le combat $idCombat");
    	}
    	
    	// Renseignement par calcul de la table resultat_poule
    	$combattant = $this->resultat->getLicencieByCombat($idCombat);
    	$idPoule=$combattant['poule'];
    	$idCbt1=$combattant['idlicencie1'];
    	$idCbt2=$combattant['idlicencie2'];
    	$idCbtVainqueur=$combattant['idvainqueur'];
    	
    	$resCbt1 = $this->resultat->getResultatCombatInTirage($idPoule, $idCbt1, $categorie);
    	$resCombattant1 = $resCbt1[0];
    	$nbPointR += $resCbt1[1];
    	
    	$resCbt2 = $this->resultat->getResultatCombatInTirage($idPoule, $idCbt2, $categorie);
    	$resCombattant2 = $resCbt2[0];
    	$nbPointB += $resCbt2[1];
    	
    	if($vainqueur > -1){
    		if($vainqueur==$idCbt1) {
    			$resCombattant1 += 1;
    			$resCombattant2 -= 1;
    		} else {
    			$resCombattant2 += 1;
    			$resCombattant1 -= 1;
    		}

    		$this->resultat->setResultatCombatInTirage($idPoule, $idCbt1, $categorie, $resCombattant1, $nbPointR);
    		$this->resultat->setResultatCombatInTirage($idPoule, $idCbt2, $categorie, $resCombattant2, $nbPointB);
    	} 

    	//Mise a jour resultat_poule
    	$resultatTirage = $this->resultat->getClassementInTirage($idPoule, $categorie);
    	$res = 0;
    	foreach ($resultatTirage as $resTirage) {
    		$res++;
    		$idLicencie = $resTirage['idlicencie'];
    		
    		$updateInsert = $this->resultat->existResultatPoule($idPoule, $idLicencie, $categorie);
    		if($updateInsert[0] != 'X') {
    		 	$result = $this->resultat->addResultatPoule($idPoule, $idLicencie, $res, $categorie);
    		} else {
    			 $result = $this->resultat->updateResultatPoule($idPoule, $idLicencie, $res, $categorie);
    		}
    	}
    	$combats = $this->resultat->getCombatsPoule($categorie);
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $categorie;
    	$vue = new Vue("Resultat","CombatPoule");
    	$vue->generer(array('categories'=>$categories,'categorieSelected'=>$categorieSelected,'combat'=>$combats), $erreur);
    }

    public function envoyerResultatSimple($poule,$categorie,$licencie1,$licencie2,$licencie3,$licencie4,$licencie5,$res1,$res2,$res3,$res4,$res5){
    	$erreur = array();
    	
    	$this->resultat-> deleteResultatPouleByPoule($categorie, $poule);
    	
    	if($licencie1 != "-1" ) {
    		$result = $this->resultat->addResultatPoule($poule, $licencie1, $res1, $categorie);
			if(! empty($result)) {
    			$erreur[] = "Classement renseign&eacute;s pour la poule $poule";
    			Log::loggerInformation("Classement renseigne pour la poule $poule");
    		} else {
    			$erreur[] = "Erreur dans le renseignement du classement pour la poule $poule";
   				Log::loggerInformation("Erreur dans le renseignement du classement pour la poule $poule");
   			}
    	} //else $erreur[] = "licencie 1 = -1";
    	if($licencie2 != "-1" ) {
    		$result = $this->resultat->addResultatPoule($poule, $licencie2, $res2, $categorie);
			if(! empty($result)) {
    			$erreur[] = "Classement renseign&eacute;s pour la poule $poule";
    			Log::loggerInformation("Classement renseigne pour la poule $poule");
    		} else {
    			$erreur[] = "Erreur dans le renseignement du classement pour la poule $poule";
   				Log::loggerInformation("Erreur dans le renseignement du classement pour la poule $poule");
   			}
    	} //else $erreur[] = "licencie 2 = -1";
    	if($licencie3 != "-1" ) {
    		$result = $this->resultat->addResultatPoule($poule, $licencie3, $res3, $categorie);
			if(! empty($result)) {
    			$erreur[] = "Classement renseign&eacute;s pour la poule $poule";
    			Log::loggerInformation("Classement renseigne pour la poule $poule");
    		} else {
    			$erreur[] = "Erreur dans le renseignement du classement pour la poule $poule";
   				Log::loggerInformation("Erreur dans le renseignement du classement pour la poule $poule");
   			}
    	} //else $erreur[] = "licencie 3 = -1";
    	if($licencie4 != "-1" ) {
    		$result = $this->resultat->addResultatPoule($poule, $licencie4, $res4, $categorie);
			if(! empty($result)) {
    			$erreur[] = "Classement renseign&eacute;s pour la poule $poule";
    			Log::loggerInformation("Classement renseigne pour la poule $poule");
    		} else {
    			$erreur[] = "Erreur dans le renseignement du classement pour la poule $poule";
   				Log::loggerInformation("Erreur dans le renseignement du classement pour la poule $poule");
   			}
    	} //else $erreur[] = "licencie 4 = -1";
    	if($licencie5 != "-1" ) {
    		$result = $this->resultat->addResultatPoule($poule, $licencie5, $res5, $categorie);
			if(! empty($result)) {
    			$erreur[] = "Classement renseign&eacute;s pour la poule $poule";
    			Log::loggerInformation("Classement renseigne pour la poule $poule");
    		} else {
    			$erreur[] = "Erreur dans le renseignement du classement pour la poule $poule";
   				Log::loggerInformation("Erreur dans le renseignement du classement pour la poule $poule");
   			}
    	} //else $erreur[] = "licencie 5 = -1";
    	
    	$licenciesTirage = $this->organisation->getTirageCategorieOrdonneWithClassement($categorie);
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $categorie;
    	$vue = new Vue("Resultat","CombatPouleSimple");
    	$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected), $erreur);
    }
}

