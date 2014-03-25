<?php
require_once 'Config/fonction.php';
?>
<p><h3>Import d'un fichier LICENCIES</h3></p>
<form action="index.php?action=importFichierLicencie" method="post" enctype="multipart/form-data">     
	<input type="hidden" name="MAX_FILE_SIZE" value="2097152">     
<label for="fichier">S&eacute;lectionner un fichier</label>
	<input type="file" name="fichier" id="fichier" >    
	<input type="submit" value="Envoyer">    
</form>
