<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Organisation extends Modele {

////////////////////////////
// Gestion des repartitions
////////////////////////////

	public function getLicenciesNotInCategorie($idCategorie,$competition) {
		try {
			$sql = "select club.libelle, idlicencie, nom , prenom 
					from licencie,club 
					where club.idclub = licencie.idclub 
					and idlicencie not in (select idlicencie from licencie_categorie where idcategorie = ? and idcompetition = ?) and idlicencie > 2 
					order by 1,2,3 ";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesNotInCategorie() : ".$e->getMessage());
			log::loggerErreur("getLicenciesNotInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesNotInCategorieRecherche($idCategorie,$competition,$texte) {
		try {
			$texteCrypt = mb_strtoupper($texte, 'UTF-8');
			$sql = "select club.libelle, idlicencie, nom , prenom 
					from licencie,club 
					where club.idclub = licencie.idclub 
					and idlicencie not in (select idlicencie from licencie_categorie where idcategorie = ? and idcompetition = ?) and idlicencie > 2 
					and (nom like '%".$texteCrypt."%' or prenom like '%".$texteCrypt."%' )
					order by 1,2,3 ";
			
		//Log::afficherErreur($sql);
					
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
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
					where club.idclub = licencie.idclub  and idlicencie > 2 order by 1,2,3 ";
			$result	= $this->executerRequete($sql);	
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesClub() : ".$e->getMessage());
			log::loggerErreur("getLicenciesClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesInCategorieSansClub($idCategorie,$competition) {
		try {		
			$sql = "select licencie.idlicencie licencie, nom , prenom, idlicencie_categorie, idcategorie
					from licencie_categorie,licencie 
					where licencie_categorie.idlicencie = licencie.idlicencie 
					and idcategorie = ? and idcompetition = ? order by 1 "; 
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));			
			return $result;			
		} catch (Exception $e) {
	    	Log::afficherErreur("getLicenciesInCategorieSansClub() : ".$e->getMessage());
	    	log::loggerErreur("getLicenciesInCategorieSansClub() : ".$e->getMessage());
	    	return null;
		}	
	}

	public function getTriClubForTirage($idCategorie,$competition) {
		try {
			$sql = "select licencie.idclub club, count(idlicencie_categorie) nbCompetiteur
					 from licencie_categorie,licencie
					 where licencie_categorie.idlicencie = licencie.idlicencie
					 and idcategorie = ? and idcompetition = ? 
					 group by licencie.idclub 
					 order by nbCompetiteur desc";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTriClubForTirage() : ".$e->getMessage());
			log::loggerErreur("getTriClubForTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesForTirageTete($idCategorie,$competition,$tete) {
		try {
			$sql = "select concat(idlicencie_categorie,'_',licencie.idclub) licencie
					from licencie_categorie,licencie
					where licencie_categorie.idlicencie = licencie.idlicencie
					and idcategorie = ? and idcompetition = ? and licencie.idlicencie = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition,$tete));
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesInCategorieForTirage() : ".$e->getMessage());
			log::loggerErreur("getLicenciesInCategorieForTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesInCategorieForTirageClub($idCategorie,$competition,$club) {
		try {
			$sql = "select concat(idlicencie_categorie,'_',licencie.idclub) licencie
					from licencie_categorie,licencie
					where licencie_categorie.idlicencie = licencie.idlicencie
					and idcategorie = ? and idcompetition = ? and licencie.idclub = ? ";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition,$club));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesInCategorieForTirageClub() : ".$e->getMessage());
			log::loggerErreur("getLicenciesInCategorieForTirageClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesInCategorieForTirage($idCategorie,$competition) {
		try {
			$sql = "select concat(idlicencie_categorie,'_',licencie.idclub) licencie
					from licencie_categorie,licencie
					where licencie_categorie.idlicencie = licencie.idlicencie
					and idcategorie = ? and idcompetition = ?";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesInCategorieForTirage() : ".$e->getMessage());
			log::loggerErreur("getLicenciesInCategorieForTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getInformationByLicencies($id) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, idlicencie_categorie, idcategorie
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					AND licencie_categorie.idlicencie_categorie = ? ";
			$result	= $this->executerRequete($sql, array($id));
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getInformationByLicencies() : ".$e->getMessage());
			log::loggerErreur("getInformationByLicencies() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicenciesInCategorie($idCategorie,$competition) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, idlicencie_categorie, idcategorie
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and idcategorie = ? and idcompetition = ?  and licencie.idlicencie > 2 order by 1,2,3";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicenciesInCategorie() : ".$e->getMessage());
			log::loggerErreur("getLicenciesInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	

	public function getNombreLicenciesInCategorie($idCategorie,$competition){
		try {
			$sql = "SELECT count(1) from licencie_categorie where idcategorie = ? and idcompetition = ?  ";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition));
			$info = $result->fetch();
			return $info[0];
		} catch (Exception $e) {
			Log::afficherErreur("getNombreLicenciesInCategorie() : ".$e->getMessage());
			log::loggerErreur("getNombreLicenciesInCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	
	public function existLicenciesInCategorie($categorie,$licencie,$competition) {
		try {
			$sql = "select 'X' from licencie_categorie where idcategorie = $categorie and idlicencie = $licencie and idcompetition = $competition";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
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
	
	public function addLicencieInCategorie($categorie,$licencie,$competition) {
		try {
			$sql  = "INSERT INTO licencie_categorie (idlicencie, idcategorie,idcompetition) VALUES ( ? , ? , ?) ";
			$stmt = $this->executerRequete($sql, array($licencie,$categorie,$competition));
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
	
	public function deleteHistoriqueTirage($categorie,$competition){
		try {
			$sql  = "delete from historique_tirage where idcategorie = ? and idcompetition = ?";
			$result	= $this->executerRequete($sql, array($categorie,$competition));			
			return $result;
			
		} catch (Exception $e) {
			Log::afficherErreur("deleteHistoriqueTirage() : ".$e->getMessage());
			log::loggerErreur("deleteHistoriqueTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteTirage($categorie,$competition) {
		try {
			$sql  = "update licencie_categorie set numero_poule = 0, position_poule = 0,
					 resultat_combat = 0, point_combat = 0 where idcategorie = ? and idcompetition = ?";
			$result	= $this->executerRequete($sql, array($categorie,$competition));
			return $result;
				
		} catch (Exception $e) {
			Log::afficherErreur("deleteTirage() : ".$e->getMessage());
			log::loggerErreur("deleteTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteTiragePouleNull($categorie,$competition) {
		try {
			$sql  = "delete from licencie_categorie where numero_poule = 0 and idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($categorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("deleteTiragePouleNull() : ".$e->getMessage());
			log::loggerErreur("deleteTiragePouleNull() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertTirage($licencie, $categorie, $poule, $position, $competition) {
		try {
			$sql  = "update licencie_categorie set numero_poule = ?, position_poule = ?
					 where idlicencie = ? and idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($poule, $position, $licencie, $categorie,$competition));
			return $result;
				
		} catch (Exception $e) {
			Log::afficherErreur("insertTirage() : ".$e->getMessage());
			log::loggerErreur("insertTirage() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertResultatTableau($idPoule, $idLicencie, $classement, $categorie,$competition) {
		try {
			$sql  = "insert into resultat_poule (idlicencie,classement,numero_poule,idcategorie,idcompetition) values ( ? , ? , ? , ? , ? )";
			$stmt = $this->executerRequete($sql, array($idLicencie,$classement, $idPoule, $categorie,$competition));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("insertResultatTableau() : ".$e->getMessage());
			log::loggerErreur("insertResultatTableau() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertHistoriqueTirage($categorie,$competition,$type) {
		try {
			$sql  = "INSERT INTO historique_tirage (idcategorie,idcompetition,date_tirage,type) values ( ? , ? , now() , ?) ";
			$result	= $this->executerRequete($sql, array($categorie,$competition,$type));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("insertHistoriqueTirage() : ".$e->getMessage());
			log::loggerErreur("insertHistoriqueTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function getDateTirage($idCategorie,$competition) {
		try {
			$sql = "select date_tirage,type from historique_tirage where idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition));
			return $result->fetch(); 
		} catch (Exception $e) {
			Log::afficherErreur("getDateTirage() : ".$e->getMessage());
			log::loggerErreur("getDateTirage() : ".$e->getMessage());
			return null;
		}
	}

	public function getCompetiteurInPoule($idCategorie, $numPoule,$competition) {
		try {
			$sql = "select nom , prenom, club.libelle
					from licencie_categorie,licencie,club
					where licencie_categorie.idlicencie = licencie.idlicencie and club.idclub = licencie.idclub 
					and licencie_categorie.idcategorie = ? and numero_poule = ? and idcompetition = ?
					order by position_poule";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$numPoule,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getCompetiteurInPoule() : ".$e->getMessage());
			log::loggerErreur("getCompetiteurInPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getNombreCompetiteurInPoule($idCategorie, $numPoule, $competition) {
		try {
			$sql = "select count(1) from licencie_categorie where idcategorie = ? and numero_poule = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie,$numPoule,$competition));
			$res = $result->fetch();
			return $res[0];
		} catch (Exception $e) {
			Log::afficherErreur("getNombreCompetiteurInPoule() : ".$e->getMessage());
			log::loggerErreur("getNombreCompetiteurInPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getNombrePoule($idCategorie,$competition) {
		try {
			$sql = "select count(distinct numero_poule)
					from licencie_categorie
					where idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition));
			$res = $result->fetch();
			return $res[0];
		} catch (Exception $e) {
			Log::afficherErreur("getNombrePoule() : ".$e->getMessage());
			log::loggerErreur("getNombrePoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getNombreParticipantByPoule($idCategorie,$competition) {
		try {
			$sql = "select numero_poule,max(position_poule)
					from licencie_categorie
					where idcategorie = ?
					and idcompetition = ?
					group by numero_poule
					order by numero_poule asc";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition));
			return $result->fetchAll();
			
			
		} catch (Exception $e) {
			Log::afficherErreur("getNombreParticipantByPoule() : ".$e->getMessage());
			log::loggerErreur("getNombreParticipantByPoule() : ".$e->getMessage());
			return null;
		}
	}
	public function getTirageCategorie($idCategorie,$competition) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, numero_poule,position_poule
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub 
					and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? 
					and licencie_categorie.idcompetition = ? 
					order by numero_poule,position_poule";
			$result	= $this->executerRequete($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorie() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getTirageCategorieOrdonne($idCategorie,$competition) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, numero_poule,position_poule
					from licencie_categorie,licencie,club
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? and licencie_categorie.idcompetition = ? order by numero_poule,position_poule";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorieOrdonne() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorieOrdonne() : ".$e->getMessage());
			return null;
		}
	}

	public function getTirageCategorieOrdonneWithResultat($idCategorie,$competition) {
		try {
			$sql = "select A.libelle, B.idlicencie, nom , prenom, C.numero_poule,C.position_poule,
					 (select classement from resultat_poule D where C.idlicencie = D.idlicencie and C.numero_poule = D.numero_poule and D.idcategorie = $idCategorie and D.idcompetition = $competition) res,
					 (select resultat_rouge from combat_poule E where (E.idlicencie1 = C.idlicencie or E.idlicencie2 = C.idlicencie) and E.poule = C.numero_poule and E.idcategorie = $idCategorie and E.idcompetition = $competition and ordre = 1) cbt1,
					(select resultat_rouge from combat_poule E where (E.idlicencie1 = C.idlicencie or E.idlicencie2 = C.idlicencie) and E.poule = C.numero_poule and E.idcategorie = $idCategorie and E.idcompetition = $competition and ordre = 2) cbt2,
					(select resultat_rouge from combat_poule E where (E.idlicencie1 = C.idlicencie or E.idlicencie2 = C.idlicencie) and E.poule = C.numero_poule and E.idcategorie = $idCategorie and E.idcompetition = $competition and ordre = 3) cbt3
					from club A,licencie B, licencie_categorie C
					where A.idclub = B.idclub 
					and C.idlicencie = B.idlicencie
					and C.idcategorie = ? 
					and C.idcompetition = ?
					order by C.numero_poule, C.position_poule";

			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			return null;
		}
	}

	public function getTirageCategorieOrdonneWithClassement($idCategorie,$competition) {
		try {
			$sql = "select club.libelle, licencie.idlicencie, nom , prenom, licencie_categorie.numero_poule,licencie_categorie.position_poule, classement
					from club,licencie, licencie_categorie left outer join resultat_poule C on (licencie_categorie.idlicencie = C.idlicencie and licencie_categorie.numero_poule = C.numero_poule and licencie_categorie.idcategorie = C.idcategorie)
					where club.idclub = licencie.idclub and licencie_categorie.idlicencie = licencie.idlicencie
					and licencie_categorie.idcategorie = ? and licencie_categorie.idcompetition = ?
					order by licencie_categorie.numero_poule, licencie_categorie.position_poule";
			$result	= $this->executerRequeteToArray($sql, array($idCategorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			log::loggerErreur("getTirageCategorieOrdonneWithClassement() : ".$e->getMessage());
			return null;
		}
	}
	public function deleteCombatPoule($categorie,$competition) {
		try {
			$sql  = "delete from combat_poule where idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($categorie, $competition));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("deleteCombatPoule() : ".$e->getMessage());
			log::loggerErreur("deleteCombatPoule() : ".$e->getMessage());
			return null;
		}
	}
	
	public function insertCombatPoule($categorie,$licencie1,$licencie2,$ordre,$poule,$competition) {
		try {
			$sql  = "INSERT INTO combat_poule (idcategorie,idlicencie1,idlicencie2,ordre, poule,idcompetition) values ( ? , ? , ? , ?, ?, ?) ";
			$result	= $this->executerRequete($sql, array($categorie,$licencie1,$licencie2,$ordre,$poule,$competition));
			return $result;
	
		} catch (Exception $e) {
			Log::afficherErreur("insertCombatPoule() : ".$e->getMessage());
			log::loggerErreur("insertCombatPoule() : ".$e->getMessage());
			return null;
		}
	}

	public function getLicencieInTableau($categorie,$competition) {
		try {
			$sql = "select A.idlicencie, A.nom , A.prenom, B.numero_poule, B.classement
					from licencie A, resultat_poule B
					where A.idlicencie = B.idlicencie
					and B.classement < 3
					and B.idcategorie = ?
					and idcompetition = ? 
					order by B.numero_poule, B.classement";
			$result	= $this->executerRequeteToArray($sql, array($categorie,$competition));
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieInTableau() : ".$e->getMessage());
			log::loggerErreur("getLicencieInTableau() : ".$e->getMessage());
			return null;
		}
	}
	public function getLicencieByClassementPoule($categorie,$poule,$position,$competition) {
		try {
			$sql = "select nom , prenom
					from licencie A, resultat_poule B
					where A.idlicencie = B.idlicencie
					and B.numero_poule = ? and B.classement = ? and B.idcategorie = ? and idcompetition = ? ";
			$result	= $this->executerRequete($sql, array($poule,$position,$categorie,$competition));	
			return $result->fetch();
			
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieByClassementPoule() : ".$e->getMessage());
			log::loggerErreur("getLicencieByClassementPoule() : ".$e->getMessage());
			return null;
		}
	}
}
