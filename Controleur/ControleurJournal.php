<?php
require_once 'Vue/Vue.php';

class ControleurJournal {

	private $journal;
    
   	public function __construct() {
    	$this->journal = new Journal();
    }

//Affiche les logs de l'application
    public function afficheJournaux() {        
    	$journaux = $this->journal->getJournaux();
        $vue = new Vue("Journal","Journal");
        $vue->generer(array('journaux' => $journaux), null);
    }


}

