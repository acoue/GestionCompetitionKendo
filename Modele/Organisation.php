<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Organisation extends Modele {

////////////////////////////
// Gestion des repartitions
////////////////////////////

	public function getLicenciesNotInCategorie($idCategorie) {
		try {
			$sql = "select club.libelle, idlicencie, nom , prenom 
					from licencie,club 
					where club.idclub = licencie.idclub 
					and idlicencie not in (select idlicencie from licencie_categorie where idcategorie = ?)
					order by 1,2,3 ";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesNotInCategorie() : ".$e->getMessage());
			log::loggerErreur("getLicenciesNotInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesClub() {
		try {
			$sql = "select club.libelle, idlicencie, nom , prenom
					from licencie,club
					where club.idclub = licencie.idclub order by 1,2,3 ";
			$result	= $this->executerRequete($sql);	
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesClub() : ".$e->getMessage());
			log::loggerErreur("getLicenciesClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesInCategorieSansClub($idCategorie) {
		try {		
			$sql = "select licencie.idlicencie, nom , prenom, idlicencie_categorie, idcategorie
					from licencie_categorie,licencie 
					where licencie_categorie.idlicencie = licencie.idlicencie 
					and idcategorie = ? order by prenom, nom "; 
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));			
			return $result;			
		} catch (Exception $e) {
	    	Log::afficherErreur("getLicenciesInCategorieSansClub() : ".$e->getMessage());
	    	log::loggerErreur("getLicenciesInCategorieSansClub() : ".$e->getMessage());
	    	return null;
		}	
	}

	public function getLicenciesInCategorie($idCategorie) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, idlicencie_categorie, idcategorie
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and idcategorie = ? order by 1,2,3";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesInCategorie() : ".$e->getMessage());
			log::loggerErreur("getLicenciesInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function existLicenciesInCategorie($categorie,$licencie) {
		try {
			$sql = "select 'X' from licencie_categorie where idcategorie = $categorie and idlicencie = $licencie ";
			$result	= $this->executerRequete($sql);
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("existLicenciesInCategorie() : ".$e->getMessage());
			log::loggerErreur("existLicenciesInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteLicencieInCategorie($id){
		try {
			$sql  = "delete from licencie_categorie where idlicencie_categorie = ? ";
			$result	= $this->executerRequete($sql, array($id));			
			return $result;
			
		} catch (Exception $e) {
			Log::afficherErreur("deleteLicencieInCategorie() : ".$e->getMessage());
			log::loggerErreur("deleteLicencieInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function addLicencieInCategorie($categorie,$licencie) {
		try {
			$sql  = "INSERT INTO licencie_categorie (idlicencie, idcategorie) VALUES ( ? , ? ) ";
			$stmt = $this->executerRequete($sql, array($licencie,$categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("addLicencieInCategorie() : ".$e->getMessage());
			log::loggerErreur("addLicencieInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
////////////////////////////
// Gestion des tirages
////////////////////////////
	
	public function deleteHistoriqueTirage($categorie){
		try {
			$sql  = "delete from historique_tirage where idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($categorie));			
			return $result;
			
		} catch (Exception $e) {
			Log::afficherErreur("deleteHistoriqueTirage() : ".$e->getMessage());
			log::loggerErreur("deleteHistoriqueTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteTirage($categorie) {
		try {
			$sql  = "update licencie_categorie set numero_poule = 0, position_poule = 0,
					 resultat_combat = 0, point_combat = 0 where idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($categorie));
			return $result;
				
		} catch (Exception $e) {
			Log::afficherErreur("deleteTirage() : ".$e->getMessage());
			log::loggerErreur("deleteTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertTirage($licencie, $categorie, $poule, $position) {
		try {
			$sql  = "update licencie_categorie set numero_poule = ?, position_poule = ?
					 where idlicencie = ? and idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($poule, $position, $licencie, $categorie));
			return $result;
				
		} catch (Exception $e) {
			Log::afficherErreur("insertTirage() : ".$e->getMessage());
			log::loggerErreur("insertTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertHistoriqueTirage($categorie) {
		try {
			$sql  = "INSERT INTO HISTORIQUE_TIRAGE (idcategorie,date_tirage) values ( ? , now()) ";
			$result	= $this->executerRequete($sql, array($categorie));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("insertHistoriqueTirage() : ".$e->getMessage());
			log::loggerErreur("insertHistoriqueTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function getDateTirage($idCategorie) {
		try {
			$sql = "select date_tirage from HISTORIQUE_TIRAGE where idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie));
			return $result->fetch(); 
		} catch (Exception $e) {
			Log::afficherErreur("getDateTirage() : ".$e->getMessage());
			log::loggerErreur("getDateTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function getCompetiteurInPoule($idCategorie, $numPoule) {
		try {
			$sql = "select nom , prenom, club.libelle
					from licencie_categorie,licencie,club
					where licencie_categorie.idlicencie = licencie.idlicencie and club.idclub = licencie.idclub 
					and licencie_categorie.idcategorie = ? and numero_poule = ?
					order by position_poule";
			$result	= $this->executerRequete($sql, array($idCategorie,$numPoule));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getCompetiteurInPoule() : ".$e->getMessage());
			log::loggerErreur("getCompetiteurInPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getNombreCompetiteurInPoule($idCategorie, $numPoule) {
		try {
			$sql = "select count(1) from licencie_categorie where idcategorie = ? and numero_poule = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie,$numPoule));
			$res = $result->fetch();
			return $res[0];
		} catch (Exception $e) {
			Log::afficherErreur("getNombreCompetiteurInPoule() : ".$e->getMessage());
			log::loggerErreur("getNombreCompetiteurInPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getNombrePoule($idCategorie) {
		try {
			$sql = "select count(distinct numero_poule)
					from licencie_categorie
					where idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie));
			$res = $result->fetch();
			return $res[0];
		} catch (Exception $e) {
			Log::afficherErreur("getNombrePoule() : ".$e->getMessage());
			log::loggerErreur("getNombrePoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getTirageCategorie($idCategorie) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, numero_poule,position_poule
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? order by 1,2,3";
			$result	= $this->executerRequete($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorie() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getTirageCategorieOrdonne($idCategorie) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, numero_poule,position_poule
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? order by numero_poule,position_poule";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorieOrdonne() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorieOrdonne() : ".$e->getMessage());
			return null;
		}
	}

	public function getTirageCategorieOrdonneWithClassement($idCategorie) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, licencie_categorie.numero_poule,licencie_categorie.position_poule, classement
					from club,licencie, licencie_categorie left outer join resultat_poule C on (licencie_categorie.idlicencie = C.idlicencie and licencie_categorie.numero_poule = C.numero_poule and licencie_categorie.idcategorie = C.idcategorie)
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? order by licencie_categorie.numero_poule, licencie_categorie.position_poule";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			return null;
		}
	}
	public function deleteCombatPoule($categorie) {
		try {
			$sql  = "delete from combat_poule where idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($categorie));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("deleteCombatPoule() : ".$e->getMessage());
			log::loggerErreur("deleteCombatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertCombatPoule($categorie,$licencie1,$licencie2,$ordre,$poule) {
		try {
			$sql  = "INSERT INTO combat_poule (idcategorie,idlicencie1,idlicencie2,ordre, poule) values ( ? , ? , ? , ?, ?) ";
			$result	= $this->executerRequete($sql, array($categorie,$licencie1,$licencie2,$ordre,$poule));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("insertCombatPoule() : ".$e->getMessage());
			log::loggerErreur("insertCombatPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getLicencieInTableau($categorie) {
		try {
			$sql = "select A.idlicencie, A.nom , A.prenom, B.numero_poule, B.classement
					from licencie A, resultat_poule B
					where A.idlicencie = B.idlicencie
					and B.classement < 3
					and B.idcategorie = ?
					order by B.numero_poule, B.classement";
			$result	= $this->executerRequeteToArray($sql, array($categorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieInTableau() : ".$e->getMessage());
			log::loggerErreur("getLicencieInTableau() : ".$e->getMessage());
			return null;
		}
	}
	public function getLicencieByClassementPoule($categorie,$poule,$position) {
		try {
			$sql = "select nom , prenom
					from licencie A, resultat_poule B
					where A.idlicencie = B.idlicencie
					and B.numero_poule = ? and B.classement = ? and B.idcategorie = ? ";
			$result	= $this->executerRequete($sql, array($poule,$position,$categorie));	
			return $result->fetch();
			
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieByClassementPoule() : ".$e->getMessage());
			log::loggerErreur("getLicencieByClassementPoule() : ".$e->getMessage());
			return null;
		}
	}
}
