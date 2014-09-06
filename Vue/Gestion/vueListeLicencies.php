<?php
require_once 'Config/fonction.php';
?>
<p><h3>Liste des licenci&eacute;s</h3></p>
<script type="text/javascript">
	function rechercheLicencie(valTexte) {
		window.location.href="index.php?action=gestionLicencie&rech=" + valTexte.value;
	}
</script>
<p align="center"><input type='button' name='Ajouter' value='Ajouter' onclick='window.location.replace("index.php?action=ajoutLicencieFormulaire")' /></p>
<br />
<p align='center' ><label for='recherche'>Chercher un licenci&eacute; :  </label>&nbsp;&nbsp;
<input type='text' id='recherche' size='40px' onChange='rechercheLicencie(this);'>&nbsp;&nbsp;
<input type='button' id='recherche' value='Rechercher' onClick='rechercheLicencie(this);' >&nbsp; Ou pressez la touche tabulation pour lancer la recherche</p>
<p align='center' ><input type='button' id='afficheAll' value='Afficher tout' onClick='window.location="index.php?action=gestionLicencie"' ></p>
<table id='csstable' align="center" width="90%">
	<thead>
    	<tr>
			<th width="10%"></th>
			<th width="10%"></th>
			<th width="15%">Pr&eacute;nom</th> 
			<th width="20%">Nom</th>
			<th width="30%">Club</th> 
			<th width="15%">R&eacute;gion</th>  
		<tr>
	</thead>
	<tbody>		
	<?php foreach ($licencies as $licencie) {
	   echo "<tr align='left'>";
	   echo "<td align='center'><a href='index.php?action=suppressionLicencie&id=".$licencie["idlicencie"]."' target='_self'><img src='img/site/supprimer.png' border='0'></a></td>";
	   echo "<td align='center'><a href='index.php?action=afficheLicencie&id=".$licencie["idlicencie"]."' target='_self'><img src='img/site/modifier.png' border='0'></a></td>";
	   echo "<td>".$licencie["prenom"]."</td>";
	   echo "<td>".$licencie["nom"]."</td>";
	   echo "<td>".$licencie[6]."</td>";
	   echo "<td>".$licencie[8]."</td>";
	   echo "</tr>";
	}
	?>
	</tbody>
</table>