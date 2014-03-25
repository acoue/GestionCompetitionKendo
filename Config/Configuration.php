<?php

/**
 * Classe de gestion des parametres de configuration
 * 
 * Inspiree du SimpleFramework de Frederic Guillot
 * (https://github.com/fguillot/simpleFramework)
 *
 * @version 1.0
 * @author Anthony COUE
 */
class Configuration {

    /** Tableau des parametres de configuration */
    private static $parametres;

    /**
     * Renvoie la valeur d'un parametre de configuration
     * 
     * @param string $nom Nom du parametre
     * @param string $valeurParDefaut Valeur a renvoyer par defaut
     * @return string Valeur du parametre
     */
    public static function get($nom, $valeurParDefaut = null) {
    	
    	$valRetour = self::getParametres($nom);
    	
        if (isset($valRetour)) {
            $valeur = $valRetour;
        } else {
            $valeur = $valeurParDefaut;
        }
        return $valeur;
    }

    /**
     * Renvoie le tableau des parametres en le chargeant au besoin depuis un fichier de configuration.
     * Les fichiers de configuration recherches sont Config/dev.ini et Config/prod.ini (dans cet ordre)
     * 
     * @return array Tableau des paramÃ¨tres
     * @throws Exception Si aucun fichier de configuration n'est trouve
     */
    private static function getParametres($param) {
        if (self::$parametres == null) {
            $cheminFichier = "Config/config.ini";            
            if (!file_exists($cheminFichier)) {
                throw new Exception("Aucun fichier de configuration trouve");
            }
            else {
                self::$parametres = parse_ini_file($cheminFichier);
            }
        }
        return self::$parametres[$param];
    }

}

