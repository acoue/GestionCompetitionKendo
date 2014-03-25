<?php
require_once 'Vue/Vue.php';

class ControleurAccueil {

	private $gestion;
    
   	public function __construct() {
    	$this->gestion = new Gestion();
    }

// Affiche le message d'accueuil
    public function accueil() {        
    	$competition = $this->gestion->getCompetitionSelected();
        $vue = new Vue("Accueil","Accueil");
        $vue->generer(array('competition' => $competition), null);
    }

// Affiche le message d'accueuil
    public function afficheContact() {        
        $vue = new Vue("Accueil","Contact");
        $vue->generer("", null);
    }
//Affiche les logs de l'application
/*     public function journal() {        
    	$journaux = $this->gestion->getJournaux();
        $vue = new Vue("Journal","Journal");
        $vue->generer(array('journaux' => $journaux), null);
    } */


}

