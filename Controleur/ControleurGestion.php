<?php
require_once 'Vue/Vue.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';
require_once 'Modele/Gestion.php';

class ControleurGestion {

	private $gestion;

	public function __construct() {
    	$this->gestion = new Gestion();
    }
	
////////////////////////////
// Gestion des Competitions
////////////////////////////
    public function afficherListeCompetitions() {
    	$competitions = $this->gestion->getCompetitions();
        $vue = new Vue("Gestion","ListeCompetitions");
        $vue->generer(array('competitions' => $competitions), null);
    }
	
    public function afficherCompetition($idCompetition) {
    	$competition = $this->gestion->getCompetition($idCompetition);
        $vue = new Vue("Gestion","DetailCompetition");
        $vue->generer(array('competition' => $competition), null);
    }
    
    public function modifierCompetition($idCompetition,$libelle,$datecompetition,$lieux,$description,$selected,$type) {    
    	if($selected == 1) {
    		$resultRaz = $this->gestion->razSelectedCompetition();
    	}	
    	$result = $this->gestion->setCompetition($idCompetition,$libelle,$datecompetition,$lieux,$description,$selected,$type);						
		if(! empty($result)) {
			$erreur[] = "Comp&eacute;tition mise &agrave; jour"; 
			Log::loggerInformation("Competition ".$idCompetition." mise a jour");
		} else { 
			$erreur[] = "Erreur dans la mise &agrave; jour de la comp&eacute;tition";
			Log::loggerInformation("Erreur dans la mise a jour de la competition ".$idCompetition);
		}
    	
    	$competitions = $this->gestion->getCompetitions();
        $vue = new Vue("Gestion","ListeCompetitions");
        $vue->generer(array('competitions' => $competitions), $erreur);
    }
	
	public function supprimerCompetition($idCompetition) {		
    	$result = $this->gestion->deleteCompetition($idCompetition);
    	if(! empty($result)) {
			$erreur[] = "Comp&eacute;tition supprim&eacute;e"; 
			Log::loggerInformation("Competition ".$idCompetition." supprimee");
		} else { 
			$erreur[] = "Erreur dans la suppression de la comp&eacute;tition";
			Log::loggerInformation("Erreur dans la suppression de la competition ".$idCompetition);
		}
		$competitions = $this->gestion->getCompetitions();
        $vue = new Vue("Gestion","ListeCompetitions");
        $vue->generer(array('competitions' => $competitions), $erreur);
    }    
    
    public function ajouterCompetitionFormulaire() {
        $vue = new Vue("Gestion","AjoutCompetition");
        $vue->generer("", null);
    }
    
    public function ajouterCompetition($libelle,$datecompetition,$lieux,$description,$selected,$type) {
    	
    	if($selected == 1) {
    		$resultRaz = $this->gestion->razSelectedCompetition();
    	}
    	if(! empty($resultRaz)) {
    		$erreur[] = "Comp&eacute;tition raz selected";
    		Log::loggerInformation("Competition ".$datecompetition."-".$libelle." ajoutee");
    	} 
    	
    	$result = $this->gestion->addCompetition($libelle,$datecompetition,$lieux,$description,$selected,$type);
    	if(! empty($result)) {
    		$erreur[] = "Comp&eacute;tition ajout&eacute;e";
    		Log::loggerInformation("Competition ".$datecompetition."-".$libelle." ajoutee");
    	} else {
   			$erreur[] = "Erreur dans l'ajout de la comp&eacute;tition";
   			Log::loggerInformation("Erreur dans l'ajout de la competition ".$datecompetition."-".$libelle);
   		}
    	$competitions = $this->gestion->getCompetitions();
    	$vue = new Vue("Gestion","ListeCompetitions");
   		$vue->generer(array('competitions' => $competitions), $erreur);
    }

////////////////////////////
// Gestion des Categories
////////////////////////////
    public function afficherListeCategories() {
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Gestion","ListeCategories");
    	$vue->generer(array('categories' => $categories), null);
    }
    
    public function afficherCategorie($idCategorie) {
    	$categorie = $this->gestion->getCategorie($idCategorie);
    	$vue = new Vue("Gestion","DetailCategorie");
    	$vue->generer(array('categorie' => $categorie), null);
    }
    
    public function modifierCategorie($idCategorie,$libelle,$type) {
    	$result = $this->gestion->setCategorie($idCategorie,$libelle,$type);
    	if(! empty($result)) {
    		$erreur[] = "Cat&eacute;gorie mise &agrave; jour";
    		Log::loggerInformation("Categorie ".$idCategorie." mise a jour");
    	} else {
    		$erreur[] = "Erreur dans la mise &agrave; jour de la cat&eacute;gorie";
    		Log::loggerInformation("Erreur dans la mise a jour de la categorie ".$idCategorie);
    	}
    	 
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Gestion","ListeCategories");
    	$vue->generer(array('categories' => $categories), $erreur);
    }
    
    public function supprimerCategorie($idCategorie) {
    	$result = $this->gestion->deleteCategorie($idCategorie);
    	if(! empty($result)) {
    		$erreur[] = "Cat&eacute;gorie supprim&eacute;e";
    		Log::loggerInformation("Categorie ".$idCategorie." supprimee");
    	} else {
    		$erreur[] = "Erreur dans la suppression de la cat&eacute;gorie";
    		Log::loggerInformation("Erreur dans la suppression de la categorie ".$idCategorie);
    	}
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Gestion","ListeCategories");
    	$vue->generer(array('categories' => $categories), $erreur);
    }
    
    public function ajouterCategorieFormulaire() {
    	$vue = new Vue("Gestion","AjoutCategorie");
    	$vue->generer("", null);
    }
    
    public function ajouterCategorie($libelle,$type) {
    	$result = $this->gestion->addCategorie($libelle,$type);
    	if(! empty($result)) {
    		$erreur[] = "Cat&eacute;gorie ajout&eacute;e";
    		Log::loggerInformation("Categorie ".$libelle." ajoutee");
    	} else {
    		$erreur[] = "Erreur dans l'ajout de la cat&eacute;gorie";
    		Log::loggerInformation("Erreur dans l'ajout de la categorie ".$libelle);
    	}
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Gestion","ListeCategories");
    	$vue->generer(array('categories' => $categories), $erreur);
    }

////////////////////////////
// Gestion des Regions
////////////////////////////
    public function afficherListeRegions() {
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","ListeRegions");
    	$vue->generer(array('regions' => $regions), null);
    }
    
    public function afficherRegion($idRegion) {
    	$region = $this->gestion->getRegion($idRegion);
    	$vue = new Vue("Gestion","DetailRegion");
    	$vue->generer(array('region' => $region), null);
    }
    
    public function modifierRegion($idRegion,$libelle) {
    	$result = $this->gestion->setRegion($idRegion,$libelle);
    	if(! empty($result)) {
    		$erreur[] = "R&eacute;gion mise &agrave; jour";
    		Log::loggerInformation("Region ".$idRegion." mise a jour");
    	} else {
    		$erreur[] = "Erreur dans la mise &agrave; jour de la R&eacute;gion";
    		Log::loggerInformation("Erreur dans la mise a jour de la region ".$idRegion);
    	}
    
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","ListeRegions");
    	$vue->generer(array('regions' => $regions), $erreur);
    }
    
    public function supprimerRegion($idRegion) {
    	$result = $this->gestion->deleteRegion($idRegion);
    	if(! empty($result)) {
    		$erreur[] = "R&eacute;gion supprim&eacute;e";
    		Log::loggerInformation("Region ".$idRegion." supprimee");
    	} else {
    		$erreur[] = "Erreur dans la suppression de la R&eacute;gion";
    		Log::loggerInformation("Erreur dans la suppression de la region ".$idRegion);
    	}
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","ListeRegions");
    	$vue->generer(array('regions' => $regions), $erreur);
    }
    
    public function ajouterRegionFormulaire() {
    	$vue = new Vue("Gestion","AjoutRegion");
    	$vue->generer("", null);
    }
    
    public function ajouterRegion($libelle) {
    	$result = $this->gestion->addRegion($libelle);
    	if(! empty($result)) {
    		$erreur[] = "R&eacute;gion ajout&eacute;e";
    		Log::loggerInformation("Region ".$libelle." ajoutee");
    	} else {
    		$erreur[] = "Erreur dans l'ajout de la R&eacute;gion";
    		Log::loggerInformation("Erreur dans l'ajout de la region ".$libelle);
    	}
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","ListeRegions");
    	$vue->generer(array('regions' => $regions), $erreur);
    }
    
////////////////////////////
// Gestion des Clubs
////////////////////////////
    public function afficherListeClubs() {
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","ListeClubs");
    	$vue->generer(array('clubs' => $clubs), null);
    }
    
    public function afficherClub($idClub) {
    	$club = $this->gestion->getClub($idClub);
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","DetailClub");
    	$vue->generer(array('club' => $club,'regions' => $regions), null);
    }
    
    public function modifierClub($idClub,$libelle,$region) {
    	$result = $this->gestion->setClub($idClub,$libelle,$region);
    	if(! empty($result)) {
    		$erreur[] = "Club $libelle mis &agrave; jour";
    		Log::loggerInformation("Club ".$idClub." mis a jour");
    	} else {
    		$erreur[] = "Erreur dans la mise &agrave; jour du club $libelle";
    		Log::loggerInformation("Erreur dans la mise a jour du club ".$idClub);
    	}
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","ListeClubs");
    	$vue->generer(array('clubs' => $clubs), $erreur);
    }
    
    public function supprimerClub($idClub) {
    	$result = $this->gestion->deleteClub($idClub);
    	if(! empty($result)) {
    		$erreur[] = "Club supprim&eacute;";
    		Log::loggerInformation("Club ".$idClub." supprime");
    	} else {
    		$erreur[] = "Erreur dans la suppression du club";
    		Log::loggerInformation("Erreur dans la suppression du club ".$idClub);
    	}
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","ListeClubs");
    	$vue->generer(array('clubs' => $clubs), $erreur);
    }
    
    public function ajouterClubFormulaire() {
    	$regions = $this->gestion->getRegions();
    	$vue = new Vue("Gestion","AjoutClub");
    	$vue->generer(array('regions' =>$regions), null);
    }
    
    public function ajouterClub($libelle, $region) {
    	$result = $this->gestion->addClub($libelle, $region);
    	if(! empty($result)) {
    		$erreur[] = "Club $libelle ($region) ajout&eacute;";
    		Log::loggerInformation("Club ".$libelle." ajoute");
    	} else {
    		$erreur[] = "Erreur dans l'ajout du club";
    		Log::loggerInformation("Erreur dans l'ajout du club ".$libelle);
    	}
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","ListeClubs");
    	$vue->generer(array('clubs' => $clubs), $erreur);
    }

////////////////////////////
// Gestion des Licencies
////////////////////////////
    public function afficherListeLicencies() {
    	$Licencies = $this->gestion->getLicencies();
    	$vue = new Vue("Gestion","ListeLicencies");
    	$vue->generer(array('licencies' => $Licencies), null);
    }
    
    public function afficherLicencie($idLicencie) {
    	$Licencie = $this->gestion->getLicencie($idLicencie);
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","DetailLicencie");
    	$vue->generer(array('licencie' => $Licencie,'clubs' => $clubs), null);
    }
    
    public function modifierLicencie($idLicencie,$prenom,$nom,$club) {
    	$result = $this->gestion->setLicencie($idLicencie,$prenom,$nom,$club);
    	if(! empty($result)) {
    		$erreur[] = "Licenci&eacute; $prenom $nom mis &agrave; jour";
    		Log::loggerInformation("Licencie $prenom $nom mis a jour");
    	} else {
    		$erreur[] = "Erreur dans la mise &agrave; jour du Licenci&acute;";
    		Log::loggerInformation("Erreur dans la mise a jour du Licencie ".$prenom." ".$nom);
    	}
    	$Licencies = $this->gestion->getLicencies();
    	$vue = new Vue("Gestion","ListeLicencies");
    	$vue->generer(array('licencies' => $Licencies), $erreur);
    }    
    
    public function supprimerLicencie($idLicencie) {
    	$result = $this->gestion->deleteLicencie($idLicencie);
    	if(! empty($result)) {
    		$erreur[] = "Licenci&eacute; supprim&eacute;";
    		Log::loggerInformation("Licencie ".$idLicencie." supprime");
    	} else {
    		$erreur[] = "Erreur dans la suppression du Licenci&eacute;";
    		Log::loggerInformation("Erreur dans la suppression du Licencie ".$idLicencie);
    	}
    	$Licencies = $this->gestion->getLicencies();
    	$vue = new Vue("Gestion","ListeLicencies");
    	$vue->generer(array('licencies' => $Licencies), $erreur);
    }

    public function ajouterLicencieFormulaire() {
    	$clubs = $this->gestion->getClubs();
    	$vue = new Vue("Gestion","AjoutLicencie");
    	$vue->generer(array('clubs' => $clubs), null);
    }
    
    public function ajouterLicencie($prenom,$nom,$club) {
    	$result = $this->gestion->addLicencie($prenom,$nom,$club);
    	if(! empty($result)) {
    		$erreur[] = "Licenci&eacute; ajout&eacute;";
    		Log::loggerInformation("Licencie $prenom $nom ajoute");
    	} else {
    		$erreur[] = "Erreur dans l'ajout du Licenci&eacute;";
    		Log::loggerInformation("Erreur dans l'ajout du Licencie $prenom $nom");
    	}
    	$Licencies = $this->gestion->getLicencies();
    	$vue = new Vue("Gestion","ListeLicencies");
    	$vue->generer(array('licencies' => $Licencies), $erreur);
    }
}
