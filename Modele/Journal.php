<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Journal extends Modele {
	
	public function getJournaux() {
		try {
			$sql = "select * from log order by datelog desc";
			$result	= $this->executerRequete($sql);
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getJournaux()".$e->getMessage());
			log::loggerErreur("getJournaux()".$e->getMessage());
			return null;
		}
	}	
	
	public function insertJournaux($type,$msgInfo) {
		try {
			$sql = "INSERT INTO log(typelog,texte,datelog) VALUES ( ? , ? ,now())";
			$stmt = $this->executerRequete($sql, array($type,$msgInfo));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("insertJournaux()".$e->getMessage());
	    	log::loggerErreur("insertJournaux()".$e->getMessage());
	    	return null;
		}	
	}
}
