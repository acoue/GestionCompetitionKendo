<?php
require_once 'Config/Configuration.php';
require_once 'Config/Log.php';

/**
 * Classe de function pour gerer la securite : 
 *  - cryptage de donnees (BLOWFISH) + MDP (Hash MD5)
 *  - Methode pour eviter l'injection SQL
 *  - Methode pour eviter le XSS 
**/
class Securite {
	
	private static $cipher  = MCRYPT_RIJNDAEL_128;                 // Algorithme utilis� pour le cryptage des blocs
    private static $key     = 'miG742NCWwi5d3h5Wzn3VWBw2Q66Vs';    // Cle de cryptage
    private static $mode    = 'cbc';                               // Mode op�ratoire (traitement des blocs)
 
    public static function crypteData($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
        return base64_encode($data);
    }
 
    public static function decrypteData($data){
        $keyHash = md5(self::$key);
        $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
        $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
 
        $data = base64_decode($data);
        return mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
    }

	public static function securiseSQL($string) {
		// On regarde si le type de string est un nombre entier (int)
		if(ctype_digit($string)) {
			$string = intval($string);
		} else { // Pour tous les autres types
			$string = mysql_real_escape_string($string);
			$string = addcslashes($string, '%_');
		}
		return $string;
	}
	
	// Donnees sortantes
	public static function securiseHtml($string) {
		return htmlentities($string);
	}
	
	public static function utilisateurConnected() {
		if(empty($_SESSION['connected'])) return $retour = "-1";
		else return $_SESSION['connected'];
	}
}