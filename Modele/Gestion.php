<?php
require_once 'Modele/Modele.php';
require_once 'Config/Securite.php';
require_once 'Config/Log.php';

class Gestion extends Modele {
	
////////////////////////////
// Gestion des Competitions
////////////////////////////
	public function getCompetitions() {
		try {		
			$sql = "select * from competition order by 3 asc"; 
			$result	= $this->executerRequete($sql);			
			return $result;			
		} catch (Exception $e) {
	    	Log::afficherErreur("getCompetitions() : ".$e->getMessage());
	    	log::loggerErreur("getCompetitions() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function getCompetitionSelected() {
		try {
			$sql = "SELECT * FROM competition WHERE selected = 1 ";
			$result	= $this->executerRequete($sql, null);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getCompetitionSelected() : ".$e->getMessage());
	    	log::loggerErreur("getCompetitionSelected() : ".$e->getMessage());
			return null;
		}
	}
		
	public function getCompetition($idCompetition) {
		try {		
			$sql = "SELECT * FROM competition WHERE idcompetition = ? "; 
			$result	= $this->executerRequete($sql, array($idCompetition));			
			return $result->fetch();
		} catch (Exception $e) {
	    	Log::afficherErreur("getCompetition() : ".$e->getMessage());
	    	log::loggerErreur("getCompetition() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function setCompetition($idCompetition,$libelle,$datecompetition,$lieux,$description,$selected) {
		try {
			$sql  = "UPDATE competition SET libelle = ?, datecompetition = ? , lieux = ? ,description = ? , selected = ? WHERE idcompetition = ? ";
			$stmt = $this->executerRequete($sql, array($libelle,$datecompetition,$lieux, $description,$selected, $idCompetition));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("setCompetition() : ".$e->getMessage());
	    	log::loggerErreur("setCompetition() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function deleteCompetition($id) {
		try {
			$sql  = "delete from competition where idcompetition = ? ";
			$stmt = $this->executerRequete($sql, array($id));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("deleteCompetition() : ".$e->getMessage());
	    	log::loggerErreur("deleteCompetition() : ".$e->getMessage());
	    	return null;
		}	
	}	
	
	public function addCompetition($libelle,$datecompetition,$lieux,$description,$selected) {
		try {
			$sql  = "INSERT INTO competition (libelle,datecompetition,lieux,description,selected) VALUES (? , ? , ? , ? , ? ) ";
			$stmt = $this->executerRequete($sql, array($libelle,$datecompetition,$lieux,$description,$selected));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("addCompetition() : ".$e->getMessage());
	    	log::loggerErreur("addCompetition() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function razSelectedCompetition() {
		try {
			$sql  = "UPDATE competition SET selected = 0 ";
			$stmt = $this->executerRequete($sql, null);
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("razSelectedCompetition() : ".$e->getMessage());
	    	log::loggerErreur("razSelectedCompetition() : ".$e->getMessage());
			return null;
		}
	}
////////////////////////////
// Gestion des Categories
////////////////////////////
	public function getCategories() {
		try {		
			$sql = "select * from categorie order by libelle asc"; 
			$result	= $this->executerRequete($sql);			
			return $result;			
		} catch (Exception $e) {
	    	Log::afficherErreur("getCategories() : ".$e->getMessage());
	    	log::loggerErreur("getCategories() : ".$e->getMessage());
	    	return null;
		}	
	}
		
	public function getCategorie($idCategorie) {
		try {		
			$sql = "SELECT * FROM categorie WHERE idcategorie = ? "; 
			$result	= $this->executerRequete($sql, array($idCategorie));			
			return $result->fetch();
		} catch (Exception $e) {
	    	Log::afficherErreur("getCategorie() : ".$e->getMessage());
	    	log::loggerErreur("getCategorie() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function setCategorie($idCategorie,$libelle) {
		try {
			$sql  = "UPDATE categorie SET libelle = UPPER( ? ) WHERE idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($libelle, $idCategorie));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("setCategorie() : ".$e->getMessage());
	    	log::loggerErreur("setCategorie() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function deleteCategorie($idCategorie){
		try {
			$sql  = "delete from categorie where idcategorie = ? ";
			$stmt = $this->executerRequete($sql, array($idCategorie));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("deleteCategorie() : ".$e->getMessage());
	    	log::loggerErreur("deleteCategorie() : ".$e->getMessage());
	    	return null;
		}	
	}
	
	public function addCategorie($libelle) {
		try {
			$sql  = "INSERT INTO categorie (libelle) VALUES (UPPER( ? )) ";
			$stmt = $this->executerRequete($sql, array($libelle));		
			return $stmt;
		} catch (Exception $e) {
	    	Log::afficherErreur("addCategorie() : ".$e->getMessage());
	    	log::loggerErreur("addCategorie() : ".$e->getMessage());
	    	return null;
		}	
	}

////////////////////////////
// Gestion des Clubs
////////////////////////////
	public function getClubs() {
		try {
			$sql = "select * from club, region where club.idregion = region.idregion order by club.libelle asc";
			$result	= $this->executerRequete($sql);
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getClubs() : ".$e->getMessage());
			log::loggerErreur("getClubs() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getClub($idClub) {
		try {
			$sql = "SELECT * FROM club WHERE idclub = ? ";
			$result	= $this->executerRequete($sql, array($idClub));
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getClub() : ".$e->getMessage());
			log::loggerErreur("getClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function setClub($idClub,$libelle,$region) {
		try {
			$sql  = "UPDATE club SET libelle = UPPER( ? ), idregion = ? WHERE idclub = ? ";
			$stmt = $this->executerRequete($sql, array($libelle, $region, $idClub));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setClub() : ".$e->getMessage());
			log::loggerErreur("setClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteClub($idClub){
		try {
			$sql  = "delete from club where idclub = ? ";
			$stmt = $this->executerRequete($sql, array($idClub));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("deleteClub() : ".$e->getMessage());
			log::loggerErreur("deleteClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function addClub($libelle, $region) {
		try {
			$sql  = "INSERT INTO club (libelle, idregion) VALUES (UPPER( ? ) , ?) ";
			$stmt = $this->executerRequete($sql, array($libelle,$region));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("addClub() : ".$e->getMessage());
			log::loggerErreur("addClub() : ".$e->getMessage());
			return null;
		}
	}

	public function existClubByLibelle($libelle) {
		try {
			$sql = "select 'X' from club where upper(libelle) = upper('$libelle') ";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("existClubByLibelle() : ".$e->getMessage());
			log::loggerErreur("existClubByLibelle() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getClubByLibelle($libelle) {
		try {
			$sql = "select * from club where upper(libelle) like upper('%".trim($libelle)."%') ";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getClubByLibelle() : ".$e->getMessage());
			log::loggerErreur("getClubByLibelle() : ".$e->getMessage());
			return null;
		}
	}
	
////////////////////////////
// Gestion des Region
////////////////////////////
	public function getRegions() {
		try {
			$sql = "select * from region order by libelle asc";
			$result	= $this->executerRequete($sql);
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getRegions() : ".$e->getMessage());
			log::loggerErreur("getRegions() : ".$e->getMessage());
			return null;
		}
	}

	public function getRegion($idRegion) {
		try {
			$sql = "SELECT * FROM region WHERE idregion = ? ";
			$result	= $this->executerRequete($sql, array($idRegion));
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getRegion() : ".$e->getMessage());
			log::loggerErreur("getRegion() : ".$e->getMessage());
			return null;
		}
	}
	
	public function setRegion($idRegion,$libelle) {
		try {
			$sql  = "UPDATE region SET libelle = UPPER( ? ) WHERE idregion = ? ";
			$stmt = $this->executerRequete($sql, array($libelle, $idRegion));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setRegion() : ".$e->getMessage());
			log::loggerErreur("setRegion() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteRegion($idRegion){
		try {
			$sql  = "delete from region where idregion = ? ";
			$stmt = $this->executerRequete($sql, array($idRegion));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("deleteRegion() : ".$e->getMessage());
			log::loggerErreur("deleteRegion() : ".$e->getMessage());
			return null;
		}
	}
	
	public function addRegion($libelle) {
		try {
			$sql  = "INSERT INTO region (libelle) VALUES (UPPER( ? )) ";
			$stmt = $this->executerRequete($sql, array($libelle));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("addRegion() : ".$e->getMessage());
			log::loggerErreur("addRegion() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getRegionByLibelle($libelle) {
		try {
			$sql = "select * from region where upper(libelle) like upper('%".trim($libelle)."%') ";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getRegionByLibelle() : ".$e->getMessage());
			log::loggerErreur("getRegionByLibelle() : ".$e->getMessage());
			return null;
		}
	}
	
////////////////////////////
// Gestion des Licencies
////////////////////////////
	public function getLicencies() {
		try {
			$sql = "select * from licencie,club,region where club.idclub = licencie.idclub and club.idregion = region.idregion order by licencie.prenom asc";
			$result	= $this->executerRequete($sql);
			return $result;
		} catch (Exception $e) {
			Log::afficherErreur("getLicencies() : ".$e->getMessage());
			log::loggerErreur("getLicencies() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicencie($idClub) {
		try {
			$sql = "SELECT * FROM licencie WHERE idlicencie = ? ";
			$result	= $this->executerRequete($sql, array($idClub));
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getLicencie() : ".$e->getMessage());
			log::loggerErreur("getLicencie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function setLicencie($idLicencie,$prenom, $nom, $club) {
		try {
			$sql  = "UPDATE licencie SET prenom = ? , nom = ? , idclub = ? WHERE idlicencie = ? ";
			$stmt = $this->executerRequete($sql, array(Securite::crypteData(mb_strtoupper($prenom, 'UTF-8')), Securite::crypteData(mb_strtoupper($nom, 'UTF-8')), $club, $idLicencie));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("setLicencie() : ".$e->getMessage());
			log::loggerErreur("setLicencie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function deleteLicencie($idClub){
		try {
			$sql  = "delete from licencie where idlicencie = ? ";
			$stmt = $this->executerRequete($sql, array($idClub));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("deleteLicencie() : ".$e->getMessage());
			log::loggerErreur("deleteLicencie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function addLicencie($prenom, $nom, $club) {
		try {
			$sql  = "INSERT INTO licencie (prenom,nom,idclub) VALUES ( ? , ? , ?) ";
			$stmt = $this->executerRequete($sql, array(Securite::crypteData(mb_strtoupper ($prenom, 'UTF-8')), Securite::crypteData(mb_strtoupper ($nom, 'UTF-8')), $club));
			return $stmt;
		} catch (Exception $e) {
			Log::afficherErreur("addLicencie() : ".$e->getMessage());
			log::loggerErreur("addLicencie() : ".$e->getMessage());
			return null;
		}
	}
	
	public function existLicencieByNomPrenomClub($nom,$prenom,$club) {
		try {
			$sql = "select 'X' from licencie where upper(nom) = '".Securite::crypteData(mb_strtoupper ($nom, 'UTF-8'))."' and upper(prenom) = '".Securite::crypteData(mb_strtoupper($prenom, 'UTF-8'))."' and idclub = $club";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("existLicencieByNomPrenomClub() : ".$e->getMessage());
			log::loggerErreur("existLicencieByNomPrenomClub() : ".$e->getMessage());
			return null;
		}
	}
	
	public function getLicencieByNomPrenom($nom,$prenom) {
		try {
			$sql = "select * from licencie where upper(nom) = '".Securite::crypteData(mb_strtoupper ($nom, 'UTF-8'))."' and upper(prenom) = '".Securite::crypteData(mb_strtoupper ($prenom, 'UTF-8'))."' ";
			$result	= $this->executerRequete($sql);
			return $result->fetch();
		} catch (Exception $e) {
			Log::afficherErreur("getLicencieByNomPrenom() : ".$e->getMessage());
			log::loggerErreur("getLicencieByNomPrenom() : ".$e->getMessage());
			return null;
		}
	}
}
