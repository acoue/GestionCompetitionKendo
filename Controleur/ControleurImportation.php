<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Gestion.php';

class ControleurImportation {

	private $gestion;
	private $organisation;
	
   	public function __construct() {
    	$this->gestion = new Gestion();
    	$this->organisation = new Organisation();
    }
////////////////////////////
// Importation CLUB
////////////////////////////
    public function importerClub($fichier) { 
    	if ($fichier['error']) {
    		switch ($fichier['error']){
    			case 1: // UPLOAD_ERR_INI_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe par le serveur (fichier php.ini) !";
    				break;
    			case 2: // UPLOAD_ERR_FORM_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe dans le formulaire HTML !";
    				break;
    			case 3: // UPLOAD_ERR_PARTIAL
    				$erreur[] = "L'envoi du fichier a ŽtŽ interrompu pendant le transfert !";
    				break;
    			case 4: // UPLOAD_ERR_NO_FILE
    				$erreur[] = "Le fichier que vous avez envoyŽ a une taille nulle !";
    				break;
    		}
    	}
    	else {
    		
			$destination = 'tmp/'.$fichier['name']; 
			move_uploaded_file($fichier['tmp_name'], $destination);     

    		$fp = fopen($destination,"r"); //lecture du fichier
			while (!feof($fp)) { 
  				$ligne = fgets($fp, 4096); 
  				$contenu = explode(";", $ligne);
  				$libelleClub = $contenu[0];
  				$libelleRegion = $contenu[1];
  				
				//Test existence club
  				$clubExist = $this->gestion->existClubByLibelle($libelleClub);
  				if(empty($clubExist)) {
  					$region = $this->gestion->getRegionByLibelle($libelleRegion);
  					if(!empty($region)) {
  						$idRegion = $region['idregion'];
  						$resultAjout = $this->gestion->addClub($libelleClub,$idRegion);
  						if(! empty($resultAjout)) {
  							$erreur[] = "Club $libelleClub ($libelleRegion) ajout&eacute;";
  							Log::loggerInformation("Club ".$libelleClub." ajoute");
  						} else {
  							$erreur[] = "Erreur dans l'ajout du club $libelleClub";
  							Log::loggerInformation("Erreur dans l'ajout du club $libelleClub");
  						}
  						
  						
  					} else {
						$erreur[] = "La r&eacute;gion $libelleRegion n'existe pas en base";
						Log::loggerInformation("La region $libelleRegion n'existe pas en base");
  					}
  				} else {
					$erreur[] = "Le club $libelleClub existe en base";
					Log::loggerInformation("Le club $libelleClub existe en base");
  				}
			}
			fclose($fp);
    	}
    	
        $vue = new Vue("Importation","ImportClub");
        $vue->generer("", $erreur);
    }
    
    public function importerClubFormulaire() { 
        $vue = new Vue("Importation","ImportClub");
        $vue->generer("", null);
    }
    
////////////////////////////
// Importation LICENCIE
////////////////////////////
    public function importerLicencie($fichier) {
    	if ($fichier['error']) {
    		switch ($fichier['error']){
    			case 1: // UPLOAD_ERR_INI_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe par le serveur (fichier php.ini) !";
    				break;
    			case 2: // UPLOAD_ERR_FORM_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe dans le formulaire HTML !";
    				break;
    			case 3: // UPLOAD_ERR_PARTIAL
    				$erreur[] = "L'envoi du fichier a ŽtŽ interrompu pendant le transfert !";
    				break;
    			case 4: // UPLOAD_ERR_NO_FILE
    				$erreur[] = "Le fichier que vous avez envoyŽ a une taille nulle !";
    				break;
    		}
    	}
    	else {
    
    		$destination = 'tmp/'.$fichier['name'];
    		move_uploaded_file($fichier['tmp_name'], $destination);
    
    		$fp = fopen($destination,"r"); //lecture du fichier
    		while (!feof($fp)) {
    			$ligne = fgets($fp, 4096);
    			$contenu = explode(";", $ligne);
    			$prenom = $contenu[0];
    			$nom = $contenu[1];
    			$libelleClub = $contenu[2];
    
    			// On retrouve l'ID du club
    			$club = $this->gestion->getClubByLibelle($libelleClub);
    			if(!empty($club)) {
    				$idClub = $club['idclub'];
    				//Test existence licencie
    				$licencieExist = $this->gestion->existLicencieByNomPrenomClub($nom, $prenom, $idClub);
	    			if(empty($licencieExist)) {
	    				$resultAjout = $this->gestion->addLicencie($prenom, $nom, $idClub);
	    				if(! empty($resultAjout)) {
	    					$erreur[] = "Licenci&eacute; ".$prenom." ".$nom." ajout&eacute;";
	    					Log::loggerInformation("Licencie ".$prenom." ".$nom." ajoute");
	    				} else {
	    					$erreur[] = "Erreur dans l'ajout du licenci&eacute; ".$prenom." ".$nom;
	    					Log::loggerInformation("Erreur dans l'ajout du licencie ".$prenom." ".$nom);
	    				}
	    			} else {
	    				$erreur[] = "Le licenci&eacute; ".$prenom." ".$nom." existe en base";
	    				Log::loggerInformation("Le licencie ".$prenom." ".$nom." existe en base");
	    			}
    			} else {
    				$erreur[] = "Le club $libelleClub n'existe pas en base";
    				Log::loggerInformation("Le club $libelleClub  n'existe pas en base");
    			}
    		}
    		fclose($fp);
    	}
    	 
    	$vue = new Vue("Importation","ImportLicencie");
    	$vue->generer("", $erreur);
    }   
    
    public function importerLicencieFormulaire() {
    	$vue = new Vue("Importation","ImportLicencie");
    	$vue->generer("", null);
    }
    
////////////////////////////
// Importation REPARTITION
////////////////////////////
    public function importerRepartition($fichier,$categorie) {
    	if ($fichier['error']) {
    		switch ($fichier['error']){
    			case 1: // UPLOAD_ERR_INI_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe par le serveur (fichier php.ini) !";
    				break;
    			case 2: // UPLOAD_ERR_FORM_SIZE
    				$erreur[] = "Le fichier dŽpasse la limite autorisŽe dans le formulaire HTML !";
    				break;
    			case 3: // UPLOAD_ERR_PARTIAL
    				$erreur[] = "L'envoi du fichier a ŽtŽ interrompu pendant le transfert !";
    				break;
    			case 4: // UPLOAD_ERR_NO_FILE
    				$erreur[] = "Le fichier que vous avez envoyŽ a une taille nulle !";
    				break;
    		}
    	}
    	else {
    
    		$destination = 'tmp/'.$fichier['name'];
    		move_uploaded_file($fichier['tmp_name'], $destination);
    
    		$fp = fopen($destination,"r"); //lecture du fichier
    		while (!feof($fp)) {
    			$ligne = fgets($fp, 4096);
    			$contenu = explode(";", $ligne);
    			$prenom = $contenu[0];
    			$nom = $contenu[1];
    	
    			// On retrouve l'ID  licencie
    			$licencie = $this->gestion->getLicencieByNomPrenom(trim($nom), trim($prenom));
    			if(!empty($licencie)) {
    				$idlicencie = $licencie['idlicencie'];
    				$repartitionExist = $this->organisation->existLicenciesInCategorie($categorie, $idlicencie);
    				if(empty($repartitionExist)) {
	    				$resultAjout = $this->organisation->addLicencieInCategorie($categorie, $idlicencie);
	    				if(! empty($resultAjout)) {
	    					$erreur[] = "Licenci&eacute; ".$prenom." ".$nom." r&eacute;partis dans la cat&eacutegorie $categorie";
	    					Log::loggerInformation("Licencie ".$prenom." ".$nom." repartis dans la cat&eacute;gorie $categorie");
	   					} else {
	   						$erreur[] = "Erreur dans l'ajout de la repartition de ".$prenom." ".$nom." dans la cat&eacute;gorie $categorie";
	   						Log::loggerInformation("Erreur dans l'ajout de la repartition ".$prenom." ".$nom." dans la catŽgorie $categorie");
	   					}
    				} else {
	    				$erreur[] = "La repartition licenci&eacute; ".$prenom." ".$nom." / cat&eacute;gorie $categorie existe en base";
	    				Log::loggerInformation("La repartition licencie ".$prenom." ".$nom." / categorie $categorie existe en base");
	    			}
    			} else {
    				$erreur[] = "Le licenci&eacute; ".$prenom." ".$nom." n'existe pas en base";
    				Log::loggerInformation("Le licencie ".$prenom." ".$nom." n'existe pas en base");
    			}
    		}
    		fclose($fp);
    	}
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Importation","ImportRepartition");
    	$vue->generer(array('categories'=>$categories), $erreur);
    }
    
    public function importerRepartitionFormulaire() {
    	$categories = $this->gestion->getCategories();
    	$vue = new Vue("Importation","ImportRepartition");
    	$vue->generer(array('categories'=>$categories), null);
    }
        
    
    
    
    

    
}

