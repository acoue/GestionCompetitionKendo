<?php
require_once 'Modele/Modele.php';
require_once 'Config/Log.php';

/**
 * Fournit les services pour la connexion à l'application 
 * @author Anthony COUE
 */
class Connexion extends Modele {
    
    public function connectUtilisateur($mdp) {
    	try {
    		//Log::loggerInformationInFile("connectUtilisateur - password : ".$mdp);
    		$sql = "SELECT 'X' FROM parametre WHERE code = 'password' and valeur = ? ";
    		$result	= $this->executerRequete($sql, array($mdp));
    		return $result->fetch();
    
    	} catch (Exception $e) {
    		afficherErreur($e->getMessage());
    		return null;
    	}
    }
}
