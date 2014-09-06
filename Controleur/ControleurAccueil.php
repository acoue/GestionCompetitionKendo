<?php
require_once 'Vue/Vue.php';
require_once 'Config/Log.php';
require_once 'Modele/Connexion.php';

class ControleurAccueil {

	private $gestion;
	private $connexion;
    
   	public function __construct() {
    	$this->gestion = new Gestion();
    	$this->connexion = new Connexion();
    }

// Affiche le message d'accueuil
    public function accueil() { 
    	$competition = $this->gestion->getCompetitionSelected();
    	
    	//Nom competition en session
    	if(!empty($competition)) {
    		$_SESSION['competition'] = $competition["libelle"]." ".dateFR($competition["datecompetition"]);
			$_SESSION['idcompetition'] = $competition['idcompetition'];
    	}
        $vue = new Vue("Accueil","Accueil");
        $vue->generer(array('competition' => $competition), null);
    }

// Affiche le message d'accueuil
    public function afficheContact() {        
        $vue = new Vue("Accueil","Contact");
        $vue->generer("", null);
    }
  
//Affiche le formulaire de connexion
    public function afficheFormulaire() {
    	$vue = new Vue("Accueil","FormulaireConnexion");
    	$vue->generer();
    }

    public function logOutUser() {
    	$_SESSION = array();
    	session_destroy();
    	$erreur[] = "Vous êtes désormais déconnecté";
    	$vue = new Vue("Accueil","FormulaireConnexion");
    	$vue->generer(null,$erreur);
    }
    
    public function logInUser($mot_de_passe) {

    	$erreur = array();
  		if ($mot_de_passe !== '') {
    		//Log::loggerInformationInFile("LogInUser -> crypt data : ".Securite::crypteData("a"));
    		$utilisateurConnected = $this->connexion->connectUtilisateur(Securite::crypteData($mot_de_passe));
    		if(! empty($utilisateurConnected)) {
    			$_SESSION['connected']  = '1';
		    	$competition = $this->gestion->getCompetitionSelected();
		    	
		    	//Nom competition ne session
		    	if(!empty($competition)) {
		    		$_SESSION['competition'] = $competition["libelle"]." ".dateFR($competition["datecompetition"]);
					$_SESSION['idcompetition'] = $competition['idcompetition'];
		    	}
		        $vue = new Vue("Accueil","Accueil");
		        $vue->generer(array('competition' => $competition), null);
		        
    		} else {
    			$erreur[] = "Le mot de passe est incorrect.";
    			$vue = new Vue("Accueil","FormulaireConnexion");
    			$vue->generer(null,$erreur);
    		}
    	} else  {
    		$erreur[] = "Merci de renseigner le mot de passe.";
    		$vue = new Vue("Accueil","FormulaireConnexion");
    		$vue->generer(null,$erreur);
    	}    	
    }
    
//Affiche les logs de l'application
/*     public function journal() {        
    	$journaux = $this->gestion->getJournaux();
        $vue = new Vue("Journal","Journal");
        $vue->generer(array('journaux' => $journaux), null);
    } */


}

