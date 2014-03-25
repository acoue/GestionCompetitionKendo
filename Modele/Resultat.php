<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Resultat extends Modele {

	////////////////////////////
	// Gestion des combats et resultats
	////////////////////////////
	public function getParticipantsInPoule($poule,$categorie) {
		try {
			$sql = "select licencie.idlicencie, nom , prenom, position_poule
					from licencie_categorie,licencie
					where licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? and numero_poule = ? order by position_poule";
			$result	= $this->executerRequeteToArray($sql, array($categorie,$poule));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getParticipantInPoule() : ".$e->getMessage());
			log::loggerErreur("getParticipantInPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getParticipantsInPouleWithResultat($poule,$categorie) {
		try {
			$sql = "select idlicencie, prenom, nom , classement, B.idcategorie
					from licencie A, licencie_categorie B left outer join resultat_poule C on (B.idlicencie = C.idlicencie and B.numero_poule = C.numero_poule and B.idcategorie = C.idcategorie)
					where A.idlicencie = B.idlicencie
					and B.idcategorie = ? and B.numero_poule = ?
					order by B.numero_poule, B.position_poule ";
			$result	= $this->executerRequeteToArray($sql, array($categorie,$poule));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getParticipantInPoule() : ".$e->getMessage());
			log::loggerErreur("getParticipantInPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getCombatsPoule($idCategorie) {
		try {
			$sql = "select A.idlicencie,A.prenom, A.nom, B.idlicencie,B.prenom, B.nom, poule, ordre, idcombat_poule, resultat_rouge, resultat_blanc
					from combat_poule,licencie A,licencie B
					where combat_poule.idlicencie1 = A.idlicencie 
					and combat_poule.idlicencie2 = B.idlicencie
					and combat_poule.idcategorie = ? order by poule, ordre";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getCombatsPoule() : ".$e->getMessage());
			log::loggerErreur("getCombatsPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getCombatPoule($id) {
		try {
			$sql = "Select A.idlicencie,A.prenom, A.nom, B.idlicencie,B.prenom, B.nom, poule, ordre, idcategorie, resultat_rouge, resultat_blanc,idcombat_poule
					from combat_poule,licencie A,licencie B
					where combat_poule.idlicencie1 = A.idlicencie 
					and combat_poule.idlicencie2 = B.idlicencie
					and idcombat_poule = ? ";
			$result	= $this->executerRequete($sql, array($id));			
			return $result->fetch();
		} catch (Exception $e) {
	    	Log::afficherErreur("getCombatPoule() : ".$e->getMessage());
	    	log::loggerErreur("getCombatPoule() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function setResultatCombatPoule($idCombat,$pointR,$pointB,$vainqueur) {
		try {
			$sql  = "UPDATE combat_poule SET resultat_rouge = ?, resultat_blanc = ? , idvainqueur = ? WHERE idcombat_poule = ? ";
			$stmt = $this->executerRequete($sql, array($pointR,$pointB, $vainqueur, $idCombat));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setResultatCombatPoule() : ".$e->getMessage());
			log::loggerErreur("setResultatCombatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function razResultatCombatPoule($categorie,$poule) {
		try {
			$sql  = "UPDATE combat_poule SET resultat_rouge = null, resultat_blanc = null , idvainqueur = null 
					 WHERE idcategorie = ? and poule = ? ";
			$stmt = $this->executerRequete($sql, array($categorie,$poule));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("razResultatCombatPoule() : ".$e->getMessage());
			log::loggerErreur("razResultatCombatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getResultatPoule($poule,$categorie,$licencie) {
		try {
			$sql = "Select 'X' from resultat_poule
					where numero_poule = ? and idcategorie = ? and idlicencie = ?";
			$result	= $this->executerRequete($sql, array($poule,$categorie, $licencie));			
			return $result->fetch();
		} catch (Exception $e) {
	    	Log::afficherErreur("getResultatPoule() : ".$e->getMessage());
	    	log::loggerErreur("getResultatPoule() : ".$e->getMessage());
	    	return null;
		}	
		
	}
	
	public function setResultatPoule($idPoule, $idLicencie, $classement, $categorie) {
		try {
			$sql  = "UPDATE resultat_poule SET idlicencie = ? ,classement = ? WHERE numero_poule = ? and idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($idLicencie,$classement, $idPoule, $categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setResultatPoule() : ".$e->getMessage());
			log::loggerErreur("setResultatPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function addResultatPoule($idPoule, $idLicencie, $classement, $categorie) {
		try {
			$sql  = "insert into resultat_poule (idlicencie,classement,numero_poule,idcategorie) values ( ? , ? , ? , ? )";
			$stmt = $this->executerRequete($sql, array($idLicencie,$classement, $idPoule, $categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("addResultatPoule() : ".$e->getMessage());
			log::loggerErreur("addResultatPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function updateResultatPoule($idPoule, $idLicencie, $classement, $categorie) {
		try {
			$sql  = "UPDATE resultat_poule SET classement = ? WHERE numero_poule = ? and idcategorie = ? and idlicencie = ? ";
			$stmt = $this->executerRequete($sql, array($classement, $idPoule, $categorie, $idLicencie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("updateResultatPoule() : ".$e->getMessage());
			log::loggerErreur("updateResultatPoule() : ".$e->getMessage());
			return null;
		}
	}
	public function existResultatPoule($idPoule, $idLicencie, $categorie) {
		try {
			$sql  = "select 'X' from resultat_poule where idlicencie = ?
					 and numero_poule = ? and idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($idLicencie, $idPoule, $categorie));
			return $stmt->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("existResultatPoule() : ".$e->getMessage());
			log::loggerErreur("existResultatPoule() : ".$e->getMessage());
			return null;
		}
	}
	public function deleteResultatPouleByPoule( $categorie,$poule) {
		try {
			$sql  = "delete from resultat_poule where idcategorie = ? and numero_poule = ?";
			$stmt = $this->executerRequete($sql, array($categorie, $poule));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("deleteResultatPoule() : ".$e->getMessage());
			log::loggerErreur("deleteResultatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteResultatPoule( $categorie) {
		try {
			$sql  = "delete from resultat_poule where idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("deleteResultatPoule() : ".$e->getMessage());
			log::loggerErreur("deleteResultatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicencieByCombat($idCombat) {
		try {
			$sql  = "select poule, idlicencie1,idlicencie2, idvainqueur from combat_poule where idcombat_poule = ? ";
			$stmt = $this->executerRequete($sql, array($idCombat));
			return $stmt->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieByCombat() : ".$e->getMessage());
			log::loggerErreur("getLicencieByCombat() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getResultatCombatInTirage($idPoule, $idLicencie, $categorie) {
		try {
			$sql  = "select resultat_combat , point_combat from licencie_categorie
					 where idlicencie = ? and numero_poule = ? and idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($idLicencie, $idPoule, $categorie));		
			return $stmt->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getResultatCombatInTirage() : ".$e->getMessage());
			log::loggerErreur("getResultatCombatInTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function setResultatCombatInTirage($idPoule, $idLicencie, $categorie, $valeur, $point) {
		try {
			$sql  = "update licencie_categorie set resultat_combat = ? , point_combat = ? 
					 where idlicencie = ? and numero_poule = ? and idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($valeur, $point, $idLicencie, $idPoule, $categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setResultatCombatInTirage() : ".$e->getMessage());
			log::loggerErreur("setResultatCombatInTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function razResultatCombatInTirage($idPoule, $categorie) {
		try {
			$sql  = "update licencie_categorie set resultat_combat = 0 , point_combat = 0
					 where numero_poule = ? and idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($idPoule, $categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("razResultatCombatInTirage() : ".$e->getMessage());
			log::loggerErreur("razResultatCombatInTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getClassementInTirage($idPoule,$categorie) {
		try {
			$sql  = "select idlicencie from licencie_categorie where numero_poule = ? and idcategorie = ? order by resultat_combat desc,  point_combat asc";
			$stmt = $this->executerRequete($sql, array($idPoule, $categorie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("getClassementInTirage() : ".$e->getMessage());
			log::loggerErreur("getClassementInTirage() : ".$e->getMessage());
			return null;
		}
	}
}
