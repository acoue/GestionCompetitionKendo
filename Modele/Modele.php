<?php
require_once 'Config/Configuration.php';
require_once 'Config/Log.php';

/**
 * Classe abstraite Modele.
 * Centralise les services d'acces a une base de donnees.
 * Utilise l'API PDO
 *
 * @author Baptiste Pesquet
 */
abstract class Modele {

    /** Objet PDO d'acces a la BD */
    private $bdd;

    /**
     * Execute une requete SQL eventuellement parametree
     * 
     * @param string $sql La requete SQL
     * @param array $valeurs Les valeurs associees a la requete
     * @return PDOStatement Le resultat renvoye par la requete
     */
    protected function executerRequete($sql, $params = null) {
        if ($params == null) {        	        	
            $stmt = $this->getBdd()->query($sql); // execution directe
        }
        else {
            $stmt = $this->getBdd()->prepare($sql);  // requete preparee
            $stmt->execute($params);
        }
        return $stmt;
    }
    
    protected function executerRequeteToArray($sql, $params = null) {
    	if ($params == null) {
    		$stmt = $this->getBdd()->query($sql); // execution directe
    		$result = $stmt->fetchAll();
    	}
    	else {
    		$stmt = $this->getBdd()->prepare($sql);  // requete preparee
    		$stmt->execute($params);
    		$result = $stmt->fetchAll();
    	}
    	return $result;
    }
    
    protected function executerRequeteFirstValue($sql, $params = null) {
    	if ($params == null) {
    		$stmt = $this->getBdd()->query($sql);
    		$result = $stmt->fetch();
    	}
    	else {
            $stmt = $this->getBdd()->prepare($sql);
            $stmt->execute($params);
    		$result = $stmt->fetch();
    	}
    	return $result;
    }

    /**
     * Renvoie un objet de connexion a la BD en initialisant la connexion au besoin
     * 
     * @return PDO L'objet PDO de connexion a la BDD
     */
    private function getBdd() {
        if ($this->bdd == null) {
        	//Recuperation des parametre de connexion
        	$dsn = Configuration::get("dsn");
            $login = Configuration::get("login");
            $mdp = Configuration::get("mdp");
            
            try {
				// Creation de la connexion
            	$this->bdd = new PDO($dsn, $login, $mdp, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));		
			} catch(PDOException $e) {  		
  				afficherErreur("getBdd()".$e->getMessage());
			}  
        }
        return $this->bdd;
    }

}