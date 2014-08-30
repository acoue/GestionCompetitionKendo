<?php
require_once 'Config/Configuration.php';
require_once 'Config/Logging.php';
require_once 'Modele/Journal.php';
/**
 * Classe de gestion des sortie de messages
 * 
 * @version 1.0
 * @author Anthony COUE 
 */
 
class Log {

	private static $logger;
	private static $journal;

    /**
     * Affiche une erreur
     * 
     * @param string $msgErreur message a afficher sur la page d'erreur
     * 
     */
	public static function afficherErreur($msgErreur) {
		self::loggerErreurInFile($msgErreur);
		$routeur = new Routeur();
		$routeur->erreur($msgErreur,null);
	}
	
	/**
	 * Ecris une information en log dans un fichier
	 * 
	 * @Param $msgInfo message a logger en fichier 
	 *  
	 */
	
	public static function loggerInformationInFile($msgInfo) {
		self::$logger = new Logger(Configuration::get("chemin_log"));
		self::$logger->log('Information', 'infos', $msgInfo, Logger::GRAN_MONTH);
	}
	
	/**
	 * Ecris une erreur en log dans un fichier
	 * 
	 * @Param $msgErreur message a logger en fichier 
	 *  
	 */

	public static function loggerErreurInFile($msgErreur) {
		self::$logger = new Logger(Configuration::get("chemin_log"));
	    self::$logger->log('Erreur', 'erreurs', $msgErreur, Logger::GRAN_MONTH);
	}
	
	
	// Ecrire une information en log en base + fichier
	public static function loggerInformation($msgInfo) {
		//fichier
		self::$logger = new Logger(Configuration::get("chemin_log"));
	    self::$logger->log('Information', 'infos', $msgInfo, Logger::GRAN_MONTH);
	    
	    //base
	    self::$journal = new Journal();
		self::$journal->insertJournaux('Information',$msgInfo);
	}
	
	// Ecrire une information en log en base + fichier
	public static function loggerInformationInBdd($msgInfo) {
		//base
	    self::$journal = new Journal();
		self::$journal->insertJournaux('Information',$msgInfo);
	}
	
	// Ecrire une erreur en log en base + fichier
	public static function loggerErreur($msgInfo) {
		self::$logger = new Logger(Configuration::get("chemin_log"));
	    self::$logger->log('Erreur', 'erreurs', $msgInfo, Logger::GRAN_MONTH);
	    //base
	    self::$journal = new Journal();
		self::$journal->insertJournaux('Erreur',$msgInfo);
	}
	
	// Ecrire une erreur en log en base + fichier
	public static function loggerErreurInBdd($msgInfo) {
		//base
	    self::$journal = new Journal();
		self::$journal->insertJournaux('Erreur',$msgInfo);
	}
}