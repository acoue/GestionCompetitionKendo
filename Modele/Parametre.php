<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Parametre extends Modele {
	
    public function getParamBdd($code) {
    	try {
    		$sql = "select valeur from parametre where code = ? ";
    		$result	= $this->executerRequete($sql, array($code));
    		if(! empty($result)) {
    			$param = $result->fetch();
    			return $param[0];
    		}
    		else return "";
    		
    	} catch (Exception $e) {
    		Log::afficherErreur("getParamBdd() : ".$e->getMessage());
    		log::loggerErreur("getParamBdd() : ".$e->getMessage());
    		return null;
    	}
    }
}
