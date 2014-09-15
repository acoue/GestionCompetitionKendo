<?php
require_once 'Config/fonction.php';
?>
<p><h3>Import d'un fichier LICENCIES</h3></p>
<p>Le fichier doit contenir 3 colonnes : 
<ul>
	<li> - 1&egrave;re colonne : prénom </li>
	<li> - 2&egrave;me colonne : nom </li>
	<li> - 3&egrave;me colonne : libell&eacute; </li>
</ul>
Ces 3 colones doivent &ecirc;tre s&eacute;par&eacute;es par un point-virgule (;)
</p>
<form action="index.php?action=importFichierLicencie" method="post" enctype="multipart/form-data">     
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152">     
<label for="fichier">S&eacute;lectionner un fichier</label>
	<input type="file" name="fichier" id="fichier" >    
	<input type="submit" value="Envoyer">    
</form>
