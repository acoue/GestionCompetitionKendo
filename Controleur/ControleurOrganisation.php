<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Organisation.php';
require_once 'Modele/Gestion.php';
require_once 'Modele/Resultat.php';
require_once 'Classes/PHPExcel.php';
require_once 'Config/fonction.php';

class ControleurOrganisation {

	private $organisation;
	private $gestion;
	private $resultat;
	
   	public function __construct() {
    	$this->organisation = new Organisation();
    	$this->gestion = new Gestion();
    	$this->resultat = new Resultat();
    }


    public function afficherRepartition($id) { 
    	$competition = $this->gestion->getIdCompetitionSelected();
    	if($id > 0) {
    		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($id,$competition);
    		$licencies = $this->organisation->getLicenciesNotInCategorie($id,$competition);
    	}
	    else {
	    	$licenciesCategorie = null;
	    	$licencies = $this->organisation->getLicenciesClub();
	    }
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $id;
        $vue = new Vue("Organisation","Repartition");
        $vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
    }

	public function ajouterRepartition($categorie,$licencie) {
		$erreur = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
		foreach($licencie as $elt){
			$result = $this->organisation->addLicencieInCategorie($categorie,$elt,$competition);
			if(! empty($result)) {
				$erreur[] = "R&eacute;partition pour la cat&eacute;gorie $categorie : ajout de $elt";
				Log::loggerInformation("Repartition pour la categorie $categorie : ajout de $elt");
			} else {
				$erreur[] = "Erreur dans la r&eacute;partition pour la cat&eacute;gorie $categorie pour ajout de $elt";
				Log::loggerInformation("Erreur dans la repartition pour la categorie $categorie pour ajout de $elt");
			}
		}
		
		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		$licencies = $this->organisation->getLicenciesNotInCategorie($categorie,$competition);
		$categories = $this->gestion->getCategories();
		$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Repartition");
		$vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), $erreur);
	}

	public function supprimerRepartition($id,$categorie) {
		$erreur = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
		$result = $this->organisation->deleteLicencieInCategorie($id);
		if(! empty($result)) {
			$erreur[] = "R&eacute;partition supprim&eacute;e";
			Log::loggerInformation("Repartition supprimee");
		} else {
			$erreur[] = "Erreur dans la suppression de la r&eacute;partition";
			Log::loggerInformation("Erreur dans la suppression de la repartition ");
		}
		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		$licencies = $this->organisation->getLicenciesNotInCategorie($categorie,$competition);
		$categories = $this->gestion->getCategories();
		$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Repartition");
		$vue->generer(array('licencies'=>$licencies,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), $erreur);
	
	}
//Tirage au sort
	public function afficherTirage($id) {
		$result = array();
    	$competition = $this->gestion->getIdCompetitionSelected();
    	if($id > 0) {
    		$licenciesCategorie = $this->organisation->getLicenciesInCategorieSansClub($id,$competition);
			// Recuperation des competiteurs
			$dateTirage = $this->organisation->getDateTirage($id,$competition);
			$resultTmp = $this->organisation->getTirageCategorieOrdonne($id,$competition);
			
			foreach ($resultTmp as $res) $result[] = $res[0]." - ".Securite::decrypteData($res["prenom"])." ".Securite::decrypteData($res["nom"])." -> Poule ".$res['numero_poule']." / n&deg; ".$res['position_poule'];
    	}
	    else {
	    	$licenciesCategorie = null;
	    	$result = null;
	    	$dateTirage = "-";
	    }
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $id;
		$vue = new Vue("Organisation","Tirage");
	 	$vue->generer(array('licenciesTirage'=>$result,'dateTirage'=>$dateTirage,'licenciesCategorie'=>$licenciesCategorie,'categories'=>$categories,'categorieSelected'=>$categorieSelected), null);
   	}
   	
	public function effectuerTirage($categorie,$nbInPoule,$ecartClub,$ecartTete) {

		$competition = $this->gestion->getIdCompetitionSelected();
		// Supression table historique tirage 
		$this->organisation->deleteHistoriqueTirage($categorie,$competition);
		// Suppression table tirage
		$this->organisation->deleteTirage($categorie,$competition);
		// Recuperation des competiteurs
		$licenciesCategorie = $this->organisation->getLicenciesInCategorie($categorie,$competition);
		// Recuperation des competiteurs
		$dateTirage = $this->organisation->getDateTirage($categorie,$competition);
		//suppression combats
		$this->organisation->deleteCombatPoule($categorie,$competition);
		//Suppression resultat poule
		$this->resultat->deleteResultatPoule($categorie,$competition);
		//Suppression des fichiers poule et tableau
		$dirname = 'Ressources/';
		$dir = opendir($dirname);
		$libCategorieSelected = $this->gestion->getCategorie($categorie);
		while($file = readdir($dir)) {
			if($file != '.' && $file != '..' && !is_dir($dirname.$file)) {
				if (strrpos($file, $libCategorieSelected['libelle'])!==false) unlink($dirname.$file);
			}
		}
		closedir($dir);
		
		//Tirage au sort
		if($ecartClub == 0 && $ecartTete == 0) { // 1. Pas d'ecartement
			shuffle($licenciesCategorie);
		} 
		else if($ecartClub == 0 && $ecartTete == 1) { // 2. Ecartement des tetes de series
		}
		else if($ecartClub == 1 && $ecartTete == 0) { // 3. Ecartement des clubs
		}
		else if($ecartClub == 1 && $ecartTete == 1) { // 4. Ecartement des clubs et des tetes de series
		}

    	$nbParticipant = count($licenciesCategorie);
    	if ($nbInPoule > -1) {
	    	if( $nbParticipant % $nbInPoule == 0){
	    		for($i=0;$i<$nbParticipant;$i++) {
	    			if ($iNumero <= $nbInPoule) {
	    				$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    				$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    				$iNumero++;
	    			} else {
	    				$iBoucle++;
	    				$iNumero = 1;
	    				$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    				$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    				$iNumero++;
	    			}
	    		}
	    	} else {
	    		$quotient = (int) ($nbParticipant / $nbInPoule); // on prend la partie entière du résultat de la division
	    		//$reste = $nbParticipant - ($quotient * $nbInPoule);
	    		$reste = $nbParticipant % $nbInPoule;
	
	    		$iBoucle = 1;
	    		$iNumero = 1;
	    		for($i=0;$i<$nbParticipant;$i++) {
	    			if ($iBoucle <= ($quotient-$reste)){
	    				if ($iNumero <= $nbInPoule) {
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				} else {
	    					$iBoucle++;
	    					$iNumero = 1;
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				}
	    			} else {
	    				if ($iNumero <= $nbInPoule +1) {
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				} else {
	    					$iBoucle++;
	    					$iNumero = 1;
	    					$this->organisation->insertTirage($licenciesCategorie[$i]['idlicencie'], $categorie, $iBoucle, $iNumero);
	    					$result[] = $licenciesCategorie[$i][0]." - ".Securite::decrypteData($licenciesCategorie[$i]["prenom"])." ".Securite::decrypteData($licenciesCategorie[$i]["nom"])." -> Poule ".$iBoucle." / n&deg; ".$iNumero;
	    					$iNumero++;
	    				}
	    			}
	    		}
	    	}
	    	
	    	//Suppression des ligne poule = 0
	    	$this->organisation->deleteTiragePouleNull($categorie,$competition);
	    	
	    	//Creation combats
	    	$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$competition);
	    	$tabCombat = array();
	    	$tmpPoule="";
	    	$iCpt = 1;
	    	foreach ($licenciesTirage as $tirage) {
	    		$tmpPoule1 = $tirage['numero_poule'];
	    		$lic = $tirage[1];
	    		if($tmpPoule!="" && $tmpPoule != $tmpPoule1) {
	    			// Insertion
	    			$this->createCombat($tabCombat,$categorie,$tmpPoule);
	    			//vide tableau
	    			unset($tabCombat);
	    			$tabCombat = array();
	    		}
	    		array_push($tabCombat, $lic);
	    		$tmpPoule = $tmpPoule1;
	    	}
	    	$this->createCombat($tabCombat,$categorie,$tmpPoule,$competition);
    	} else {
    		//tableau direct
    	}
    	//Insertion dans la table historique
    	$this->organisation->insertHistoriqueTirage($categorie);
    	
    	$categories = $this->gestion->getCategories();
    	$categorieSelected = $categorie;
		$vue = new Vue("Organisation","Tirage");
	 	$vue->generer(array('dateTirage'=>$dateTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'licenciesTirage'=>$result,'licenciesCategorie'=>$licenciesCategorie), null);
   }
   
	private function createCombat($tabCombat,$categorie,$tmpPoule1,$competition) {

		$competition = $this->gestion->getIdCompetitionSelected();
		//Insertion
		if(count($tabCombat) == 3){ // 1x2 - 1x3 - 2x3
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],3,$tmpPoule1,$competition);
		} else if(count($tabCombat) == 4){ // 1x2 - 3x4 - 1x4 - 1x3 - 2x3 - 2x4
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[3],3,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],4,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],5,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],6,$tmpPoule1,$competition);
		} else if(count($tabCombat) == 5){ // 1x2 - 3x4 - 1x5 - 2x3 - 4x5 - 1x3 - 2x5 - 1x4 - 3x5 - 2x4
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[1],1,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[3],2,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[4],3,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[2],4,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[3],$tabCombat[4],5,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[2],6,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[4],7,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[0],$tabCombat[3],8,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[2],$tabCombat[4],9,$tmpPoule1,$competition);
			$this->organisation->insertCombatPoule($categorie,$tabCombat[1],$tabCombat[3],10,$tmpPoule1,$competition);
		}
	}
	
	public function afficherPoule($id) {

	   	if($id > 0) {
	   		$competition = $this->gestion->getIdCompetitionSelected();
	   		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($id,$competition);
	   	} else {
	   		$licenciesTirage = null;
	   	}
	   	$categories = $this->gestion->getCategories();
	   	$categorieSelected = $id;
	   	$libCategorieSelected = $this->gestion->getCategorie($id);
	   	$vue = new Vue("Organisation","Poule");
	   	$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	 
   	}
   	
   	public function imprimerPoule($categorie) {
   		
   		//Recuperation date de la competition
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		$competition = $compet["idcompetition"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		$nbPoule = $this->organisation->getNombrePoule($categorie,$competition);
   		
   		for($i=1;$i<=$nbPoule;$i++) {
   			$competiteurInPoule = $this->organisation->getCompetiteurInPoule($categorie, $i, $competition);
   			$nbCompetiteur = $this->organisation->getNombreCompetiteurInPoule($categorie, $i, $competition);
 	
   			$objet = PHPExcel_IOFactory::createReader('Excel5');
   			$excel = $objet->load('Data/poule'.$nbCompetiteur.'.xls');
   			$sheet = $excel->getSheet(0);
   			$sheet->setCellValue("H1", aff_date_court($competDate));
   			$sheet->setCellValue("H3", $categorieLibelle);
   			$sheet->setCellValue("C6", $competLibelle);
   			
   			$row = 18;
   			foreach ($competiteurInPoule as $tirage) {
   				$club = $tirage[2];
   				$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
   				$sheet->setCellValue("B".$row, $licencie);
   				$row = $row + 2;
   				$sheet->setCellValue("B".$row, $club);
   				$row++;
   			}
   			
   			$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
   			$writer->save('Ressources/'.$categorieLibelle.'_poule_'.$i.'.xls');
   			
   		}
   		
   		$licenciesTirage = $this->organisation->getTirageCategorieOrdonne($categorie,$compet);
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
	   	$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		$vue = new Vue("Organisation","Poule");
   		$vue->generer(array('licenciesTirage'=>$licenciesTirage,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	}
   	
   	public function afficherTableau($categorie) {

   		$competition = $this->gestion->getIdCompetitionSelected();
   		if($categorie > 0) {
   			$licenciesTableau = $this->organisation->getLicencieInTableau($categorie,$competition);
   			$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		} else {
   			$licenciesTableau = null;
   			$libCategorieSelected = "";
   		}
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
   		$vue = new Vue("Organisation","Tableau");
   		$vue->generer(array('licenciesTableau'=>$licenciesTableau,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   		 
   	}
   	

   	public function imprimerTableau($categorie) {
   		 
   		//Recuperation date de la competition
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		$competition = $compet["idcompetition"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		
   		$licenciesTableau = $this->organisation->getLicencieInTableau($categorie,$competition);
   		$nb = count($licenciesTableau);
   		$nbCompetiteur = 0;
   		$tabTableau = array(4,8,12,16,24,32,36,48,64,96);

   		for ($i=0; $i<count($tabTableau); $i++) {
   			if($nb < $tabTableau[$i]) {
   				$nbCompetiteur = $tabTableau[$i];
   				break;
   			}
   		}
   		
   		$objet = PHPExcel_IOFactory::createReader('Excel5');
   		$excel = $objet->load('Data/tableau'.$nbCompetiteur.'.xls');
   		$sheet = $excel->getSheet(0);
   		$sheet->setCellValue("H2", aff_date_court($competDate));
   		$sheet->setCellValue("H4", $categorieLibelle);
   		$sheet->setCellValue("D9", $competLibelle);
   	
   		for ($row=10; $row<81; $row++) { //nombre de ligne max tableau de 96
   			$valeur = $sheet->getCell("B".$row)->getValue();
   			if(!empty($valeur)) {
   				if(strrpos($valeur, '.')!==false){
   					$resClassement = explode(".", $valeur);
   					$poule = $resClassement[0]; 
   					$position = $resClassement[1];
   					$tirage = $this->organisation->getLicencieByClassementPoule($categorie, $poule, $position,$compet);
   					if(!empty($tirage)) {
   						$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
   						$sheet->setCellValue("C".$row, $licencie);
   					} 
   				}
   			}
   		}
   	
   		if($nbCompetiteur > 30) { //Tableau sur 2 colonnes
   			for ($row=10; $row<81; $row++) { //nombre de ligne max tableau de 96
   				$valeur = $sheet->getCell("O".$row)->getValue();
   				if(!empty($valeur)) {
   					if(strrpos($valeur, '.')!==false){
   						$resClassement = explode(".", $valeur);
   						$poule = $resClassement[0];
   						$position = $resClassement[1];
   						$tirage = $this->organisation->getLicencieByClassementPoule($categorie, $poule, $position,$compet);
   						if(!empty($tirage)) {
   							$licencie = Securite::decrypteData($tirage["prenom"])." ".Securite::decrypteData($tirage["nom"]);
   							$sheet->setCellValue("N".$row, $licencie);
   						}
   					}
   				}
   			}
   		}
   		
   		$writer = PHPExcel_IOFactory::createWriter($excel, "Excel5");
   		$writer->save('Ressources/'.$categorieLibelle.'_tableau.xls');
   		
   		
   		$categories = $this->gestion->getCategories();
   		$categorieSelected = $categorie;
   		$libCategorieSelected = $this->gestion->getCategorie($categorie);
   		$vue = new Vue("Organisation","Tableau");
   		$vue->generer(array('licenciesTableau'=>$licenciesTableau,'categories'=>$categories,'categorieSelected'=>$categorieSelected,'libCategorieSelected'=>$libCategorieSelected), null);
   	}
   	


   	public function afficherListePouleImpression($categorie) {
   		$competition = $this->gestion->getIdCompetitionSelected();
   		$compet = $this->gestion->getCompetitionSelected();
   		$competDate = $compet["datecompetition"];
   		$competLibelle = $compet["libelle"];
   		//Recuperation categorie
   		$cat = $this->gestion->getCategorie($categorie);
   		$categorieLibelle = $cat["libelle"];
   		
   		$nbPoule = $this->organisation->getNombrePoule($categorie,$competition);
   		if($categorie > 0) {
   			$participant = $this->organisation->getTirageCategorie($categorie,$competition);
   			$nbByPoule = $this->organisation->getNombreParticipantByPoule($categorie,$competition);
   			//print_r($nbByPoule);
   		} else {
   			$participant = null;
   			$nbByPoule = null;
   		}
   		$categories = $this->gestion->getCategories();
   		 
   		$categorieSelected = $categorie;
   		$vue = new Vue("Organisation","ImpressionPoule");
   		$vue->generer(array('categories'=>$categories,'participant'=>$participant,'categorieSelected'=>$categorieSelected,'nbByPoule'=>$nbByPoule,'competDate'=>$competDate,'competLibelle'=>$competLibelle,'categorieLibelle'=>$categorieLibelle), null);
   	}
}

