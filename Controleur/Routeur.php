<?php
require_once 'Controleur/ControleurAccueil.php';
require_once 'Controleur/ControleurGestion.php';
require_once 'Controleur/ControleurJournal.php';
require_once 'Controleur/ControleurOrganisation.php';
require_once 'Controleur/ControleurImportation.php';
require_once 'Controleur/ControleurResultat.php';
require_once 'Vue/Vue.php';
require_once 'Config/Log.php';

class Routeur {

    private $ctrlAccueil;
    private $ctrlJournal;
    private $ctrlGestion;
    private $ctrlOrganisation;
    private $ctrlImportation;
    private $ctrlResultat;
	
    public function __construct() {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlJournal = new ControleurJournal();
        $this->ctrlGestion = new ControleurGestion();
        $this->ctrlOrganisation = new ControleurOrganisation();
        $this->ctrlImportation = new ControleurImportation();
        $this->ctrlResultat = new ControleurResultat();
    }

    // Affiche une erreur
    public function erreur($msgErreur) {
        $vue = new Vue("Erreur","Erreur");
        $vue->generer(array('msgErreur' => $msgErreur), null);
    }

    // Recherche un parametre dans un tableau
    private function getParametre($tableau, $nom) {
        if (isset($tableau[$nom])) {
            return $tableau[$nom];
        }
        else
            throw new Exception("Parametre '$nom' absent");
    }
    
    // Route une requete entrante : execution l'action associee
    public function routerRequete() {
    	try {
        	if (isset($_GET['action'])) {
            	if ($_GET['action'] == 'accueil') {
                    $this->ctrlAccueil->accueil();
                } 
                else if ($_GET['action'] == 'contact') {
                    $this->ctrlAccueil->afficheContact();
                } 
                else if ($_GET['action'] == 'afficheJournal') {
                    $this->ctrlJournal->afficheJournaux();
                }  
//Partie Menu Gestion -> Competitions 
                else if ($_GET['action'] == 'gestionCompetition') {
                	$this->ctrlGestion->afficherListeCompetitions();
                }
                else if ($_GET['action'] == 'afficheCompetition') {
                	$idCompetition = $this->getParametre($_GET, 'id');
                	$this->ctrlGestion->afficherCompetition($idCompetition);
                }
                else if ($_GET['action'] == 'suppressionCompetition') {
                	$idCompetition = $this->getParametre($_GET, 'id');
                	$this->ctrlGestion->supprimerCompetition($idCompetition);
                }
                else if ($_GET['action'] == 'ajoutCompetitionFormulaire') {
                	$this->ctrlGestion->ajouterCompetitionFormulaire();
                }
                else if($_GET['action'] == 'ajoutCompetition') { 
            	    $libelle = $this->getParametre($_POST, 'libelle');
            	    $datecompetition = $this->getParametre($_POST, 'datecompetition');
            	    $lieux = $this->getParametre($_POST, 'lieux');
            	    $description = $this->getParametre($_POST, 'description');
            	    $selected = $this->getParametre($_POST, 'selected');
            		$this->ctrlGestion->ajouterCompetition($libelle, $datecompetition, $lieux, $description, $selected);            		
            	}
                else if($_GET['action'] == 'modificationCompetition') { 
                	$idCompetition = $this->getParametre($_POST, 'idCompetition');
            	    $libelle = $this->getParametre($_POST, 'libelle');
            	    $datecompetition = $this->getParametre($_POST, 'datecompetition');
            	    $lieux = $this->getParametre($_POST, 'lieux');
            	    $description = $this->getParametre($_POST, 'description');
            	    $selected = $this->getParametre($_POST, 'selected');
            		$this->ctrlGestion->modifierCompetition($idCompetition,$libelle, $datecompetition, $lieux, $description, $selected);            		
            	}
//Partie Menu Gestion -> Categorie
            	else if ($_GET['action'] == 'gestionCategorie') {
            		$this->ctrlGestion->afficherListeCategories();
            	}
            	else if ($_GET['action'] == 'afficheCategorie') {
            		$idCategorie = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->afficherCategorie($idCategorie);
            	}
            	else if ($_GET['action'] == 'suppressionCategorie') {
            		$idCategorie = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->supprimerCategorie($idCategorie);
            	}
            	else if ($_GET['action'] == 'ajoutCategorieFormulaire') {
            		$this->ctrlGestion->ajouterCategorieFormulaire();
            	}
            	else if($_GET['action'] == 'ajoutCategorie') {
            		$libelle = $this->getParametre($_POST, 'libelle');
            		$this->ctrlGestion->ajouterCategorie($libelle);
            	}
            	else if($_GET['action'] == 'modificationCategorie') {
            		$idCategorie = $this->getParametre($_POST, 'idCategorie');
            		$libelle = $this->getParametre($_POST, 'libelle');
            		$this->ctrlGestion->modifierCategorie($idCategorie,$libelle);
            	} 
//Partie Menu Gestion -> Regions 
                else if ($_GET['action'] == 'gestionRegion') {
                	$this->ctrlGestion->afficherListeRegions();
                }
                else if ($_GET['action'] == 'afficheRegion') {
                	$idRegion = $this->getParametre($_GET, 'id');
                	$this->ctrlGestion->afficherRegion($idRegion);
                }
                else if ($_GET['action'] == 'suppressionRegion') {
                	$idCompetition = $this->getParametre($_GET, 'id');
                	$this->ctrlGestion->supprimerRegion($idRegion);
                }
                else if ($_GET['action'] == 'ajoutRegionFormulaire') {
                	$this->ctrlGestion->ajouterRegionFormulaire();
                }
                else if($_GET['action'] == 'ajoutRegion') { 
            	    $libelle = $this->getParametre($_POST, 'libelle');
            		$this->ctrlGestion->ajouterRegion($libelle);            		
            	}
                else if($_GET['action'] == 'modificationRegion') { 
                	$idRegion = $this->getParametre($_POST, 'idRegion');
            	    $libelle = $this->getParametre($_POST, 'libelle');
            		$this->ctrlGestion->modifierRegion($idRegion,$libelle);            		
            	}
//Partie Menu Gestion -> Club
            	else if ($_GET['action'] == 'gestionClub') {
            		$this->ctrlGestion->afficherListeClubs();
            	}
            	else if ($_GET['action'] == 'afficheClub') {
            		$idClub = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->afficherClub($idClub);
            	}
            	else if ($_GET['action'] == 'suppressionClub') {
            		$idClub = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->supprimerClub($idClub);
            	}
            	else if ($_GET['action'] == 'ajoutClubFormulaire') {
            		$this->ctrlGestion->ajouterClubFormulaire();
            	}
            	else if($_GET['action'] == 'ajoutClub') {
            		$libelle = $this->getParametre($_POST, 'libelle');
            		$region = $this->getParametre($_POST, 'region');
            		$this->ctrlGestion->ajouterClub($libelle,$region);
            	}
            	else if($_GET['action'] == 'modificationClub') {
            		$idClub = $this->getParametre($_POST, 'idClub');
            		$region = $this->getParametre($_POST, 'region');
            		$libelle = $this->getParametre($_POST, 'libelle');
            		$this->ctrlGestion->modifierClub($idClub,$libelle,$region);
            	}

//Partie Menu Gestion -> Licencies
            	else if ($_GET['action'] == 'gestionLicencie') {
            		$this->ctrlGestion->afficherListeLicencies();
            	}
            	else if ($_GET['action'] == 'afficheLicencie') {
            		$idLicencie = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->afficherLicencie($idLicencie);
            	}
            	else if ($_GET['action'] == 'suppressionLicencie') {
            		$idLicencie = $this->getParametre($_GET, 'id');
            		$this->ctrlGestion->supprimerLicencie($idLicencie);
            	}
            	else if ($_GET['action'] == 'ajoutLicencieFormulaire') {
            		$this->ctrlGestion->ajouterLicencieFormulaire();
            	}
            	else if($_GET['action'] == 'ajoutLicencie') {
            		$nom = $this->getParametre($_POST, 'nom');
            		$prenom = $this->getParametre($_POST, 'prenom');
            		$club = $this->getParametre($_POST, 'club');
            		$this->ctrlGestion->ajouterLicencie($prenom,$nom,$club);
            	}
            	else if($_GET['action'] == 'modificationLicencie') {
            		$idLicencie = $this->getParametre($_POST, 'idLicencie');
            		$nom = $this->getParametre($_POST, 'nom');
            		$prenom = $this->getParametre($_POST, 'prenom');
            		$club = $this->getParametre($_POST, 'club');
            		$this->ctrlGestion->modifierLicencie($idLicencie,$prenom,$nom,$club);
            	}
            	
//Partie Menu Organisation -> Repartition
            	else if ($_GET['action'] == 'afficheRepartition') {
            		if(isset($_GET['id'])) $id = $this->getParametre($_GET, 'id');
            		else $id = -1;
            		$this->ctrlOrganisation->afficherRepartition($id);
            	} 
            	else if ($_GET['action'] == 'ajoutRepartition') {
            		$categorie = $this->getParametre($_POST, 'categorie');
            		$licencie = $this->getParametre($_POST, 'licencie');
            		$this->ctrlOrganisation->ajouterRepartition($categorie,$licencie);
            	}
            	else if ($_GET['action'] == 'suppressionRepartition') {
            		$categorie = $this->getParametre($_GET, 'categorie');
            		$id = $this->getParametre($_GET, 'id');
            		$this->ctrlOrganisation->supprimerRepartition($id,$categorie);
            	}

//Partie Menu Organisation -> Tirage au sort
            	else if ($_GET['action'] == 'afficheTirage') {
            		if(isset($_GET['id'])) $id = $this->getParametre($_GET, 'id');
            		else $id = -1;
            		$this->ctrlOrganisation->afficherTirage($id);
            	} else if ($_GET['action'] == 'effectuerTirage') {
            		$categorie = $this->getParametre($_POST, 'categorie');
            		$nbInPoule = $this->getParametre($_POST, 'nombre');
            		$ecartClub = $this->getParametre($_POST, 'club'); 
            		$ecartTete = $this->getParametre($_POST, 'tete');
            		
            		$tabTete = array($this->getParametre($_POST, 'premier'),
            						$this->getParametre($_POST, 'deuxieme'),
            						$this->getParametre($_POST, 'troisieme'),
            						$this->getParametre($_POST, 'troisiemebis'));
            		
            		$this->ctrlOrganisation->effectuerTirage($categorie,$nbInPoule,$ecartClub,$ecartTete,$tabTete);
            	}

//Partie Menu Organisation -> Generation des poules
            	else if ($_GET['action'] == 'affichePoule') {
            		if(isset($_GET['id'])) $categorie = $this->getParametre($_GET, 'id');
            		else $categorie = -1;
            		$this->ctrlOrganisation->afficherPoule($categorie);
            	} 
//             	else if ($_GET['action'] == 'impressionPoule') {
//             		$categorie = $this->getParametre($_POST, 'categorie');
//             		$this->ctrlOrganisation->imprimerPoule($categorie);
//             	}
//Partie Menu Organisation -> Imprimer poule
            	else if ($_GET['action'] == 'impressionPoule'){
            		if(isset($_GET['id'])) $categorie = $this->getParametre($_GET, 'id');
            		else $categorie = -1;
            		$this->ctrlOrganisation->afficherListePouleImpression($categorie);
            	}
//Partie Menu Organisation -> Generation des tableaux
            	else if ($_GET['action'] == 'afficheTableau') {
            		if(isset($_GET['id'])) $categorie = $this->getParametre($_GET, 'id');
            		else $categorie = -1;
            		$this->ctrlOrganisation->afficherTableau($categorie);
            	} else if ($_GET['action'] == 'impressionTableau') {
            		$categorie = $this->getParametre($_POST, 'categorie');
            		$this->ctrlOrganisation->imprimerTableau($categorie);
            	}
            	
//Partie Menu Resultat -> poules
            	else if ($_GET['action'] == 'resultatPoule') {
            		if(isset($_GET['id'])) $id = $this->getParametre($_GET, 'id');
            		else $id = -1;
            		$this->ctrlResultat->afficherResultatPoule($id);
            	} else if ($_GET['action'] == 'afficheCombatPoule') {
            		if(isset($_GET['id'])) $id = $this->getParametre($_GET, 'id');
            		$this->ctrlResultat->afficherCombatPoule($id);
            	} else if ($_GET['action'] == 'envoiResultat') {
            		$point1 = $this->getParametre($_POST, 'point1');
            		$point2 = $this->getParametre($_POST, 'point2');
            		$point3 = $this->getParametre($_POST, 'point3');
            		$idCombat = $this->getParametre($_POST, 'idCombat');
            		$vainqueur = $this->getParametre($_POST, 'vainqueur');
            		$categorie = $this->getParametre($_POST, 'categorie');
            		$this->ctrlResultat->envoyerResultat($idCombat,$vainqueur,$point1,$point2,$point3,$categorie);
            	} else if ($_GET['action'] == 'resultatPouleSimple') {
            		if(isset($_GET['id'])) $id = $this->getParametre($_GET, 'id');
            		else $id = -1;
            		$this->ctrlResultat->afficherResultatPouleSimple($id);
            	} else if ($_GET['action'] == 'afficheCombatPouleSimple') {
            		if(isset($_GET['poule'])) $poule = $this->getParametre($_GET, 'poule');
            		if(isset($_GET['categorie'])) $categorie = $this->getParametre($_GET, 'categorie');
            		$this->ctrlResultat->afficherCombatPouleSimple($poule,$categorie);
            	} else if ($_GET['action'] == 'envoiResultatSimple') {
            		$categorie = $this->getParametre($_POST, 'categorie'); 
            		$poule = $this->getParametre($_POST, 'poule');
            		
            		if(isset($_POST['licencie1'])) $licencie1 = $this->getParametre($_POST, 'licencie1');
            		else $licencie1 = -1;
            		if(isset($_POST['licencie2'])) $licencie2 = $this->getParametre($_POST, 'licencie2');
            		else $licencie2 = -1;
            		if(isset($_POST['licencie3'])) $licencie3 = $this->getParametre($_POST, 'licencie3');
            		else $licencie3 = -1;
            		if(isset($_POST['licencie4'])) $licencie4 = $this->getParametre($_POST, 'licencie4');
            		else $licencie4 = -1;
            		if(isset($_POST['licencie5'])) $licencie5 = $this->getParametre($_POST, 'licencie5');
            		else $licencie5 = -1;
            		
            		if(isset($_POST['res1'])) $res1 = $this->getParametre($_POST, 'res1');
            		else $res1 = "";
            		if(isset($_POST['res2'])) $res2 = $this->getParametre($_POST, 'res2');
            		else $res2 = "";
            		if(isset($_POST['res3'])) $res3 = $this->getParametre($_POST, 'res3');
            		else $res3 = "";
            		if(isset($_POST['res4'])) $res4 = $this->getParametre($_POST, 'res4');
            		else $res4 = "";
            		if(isset($_POST['res5'])) $res5 = $this->getParametre($_POST, 'res5');
            		else $res5 = "";
            		
            		$this->ctrlResultat->envoyerResultatSimple($poule,$categorie,$licencie1,$licencie2,$licencie3,$licencie4,$licencie5,$res1,$res2,$res3,$res4,$res5);
            	} else if ($_GET['action'] == 'razResultat') {
            		$categorie = $this->getParametre($_GET, 'categorie'); 
            		$poule = $this->getParametre($_GET, 'poule');
            		$this->ctrlResultat->razResultatPoule($poule,$categorie);
            	}
            	
//Partie Menu Importation -> Club
            	else if ($_GET['action'] == 'importClub') {
            		$this->ctrlImportation->importerClubFormulaire();
            	} 	
            	else if ($_GET['action'] == 'importFichierClub') {
            		$fichier = $this->getParametre($_FILES, 'fichier');
            		$this->ctrlImportation->importerClub($fichier);
            	}
//Partie Menu Importation -> Licencie
            	else if ($_GET['action'] == 'importLicencie') {
            		$this->ctrlImportation->importerLicencieFormulaire();
            	}
            	else if ($_GET['action'] == 'importFichierLicencie') {
            		$fichier = $this->getParametre($_FILES, 'fichier');
            		$this->ctrlImportation->importerLicencie($fichier);
            	} 
//Partie Menu Importation -> Repartition
            	else if ($_GET['action'] == 'importRepartition') {
            		$this->ctrlImportation->importerRepartitionFormulaire();
            	}
            	else if ($_GET['action'] == 'importFichierRepartition') {
            		$categorie = $this->getParametre($_POST, 'categorie');
            		$fichier = $this->getParametre($_FILES, 'fichier');
            		$this->ctrlImportation->importerRepartition($fichier, $categorie);
            	}             	
            	
//Erreur : parametre action non valide          
                else throw new Exception("Action non valide");
            } else {        		
              	$this->ctrlAccueil->accueil();
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
    }
}
