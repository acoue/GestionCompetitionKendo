<?php
require_once 'Config/Log.php';

class Vue {

    // Nom du fichier associe a la vue
    private $fichier;
    
    // Titre de la vue (defini dans le fichier vue)
    private $titre;

    public function __construct($dossier,$action) {
        // Determination du nom du fichier vue a partir de l'action
        
        $this->fichier = "Vue/" . $dossier . "/vue" . $action . ".php";
    }

    // Genere et affiche la vue
    public function generer($donnees = null, $erreur = null) {
        // Generation de la partie specifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees, $erreur);
        // Generation du gabarit commun utilisant la partie specifique
        $vue = $this->genererFichier('Vue/gabarit.php', array('titre' => $this->titre,'contenu' => $contenu),$erreur);
        // Renvoi de la vue au navigateur
        echo $vue;
    }

    // Genere un fichier vue et renvoie le resultat produit
    private function genererFichier($fichier, $donnees, $err) {
        if (file_exists($fichier)) {
        	
            // Rend les elements du tableau $donnees accessibles dans la vue
            if(! empty($donnees)) {            	
            	//foreach($donnees as $valeur) Log::loggerInformationInFile("genererFichier -> donnee : ".$valeur);
            	extract($donnees);
            }
            // Demarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son resultat est place dans le tampon de sortie
            $erreur = $err;
            require $fichier;
            // Arret de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }

}