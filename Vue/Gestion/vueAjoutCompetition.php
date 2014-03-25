<?php
require_once 'Config/fonction.php';
?>
<script>
	$(function() {
		var pickerOpts = {
			closeText: 'Fermer',
			prevText: '&#x3c;Pr&eacute;c',
			nextText: 'Suiv&#x3e;',
			currentText: 'Courant',
			monthNames: ['Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','D&eacute;cembre'],
 			monthNamesShort: ['Jan','F&eacute;v','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','D&eacute;c'],
 			dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
 			dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
 			dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
 			weekHeader: 'Sm',
 			firstDay: 1,
			isRTL: false,
			showMonthAfterYear: false,
			yearSuffix: '',
			dateFormat: $.datepicker.ATOM
	    }; 
		$( "#datecompetition" ).datepicker(pickerOpts);
	});
</script>	
<p><h3>Ajout d'une comp&eacute;tition</h3></p>
<form action="index.php?action=ajoutCompetition" method="post" id="ajoutCompetition">
<input type='hidden' id='idCompetition' name='idCompetition' value=''>
	<table id="csstable" >
		<tr>
			<td width="40%">Libell&eacute;</td>
			<td width='60%'><input type='text' id='libelle' name='libelle' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>Date</td>
			<td><input type='text' id='datecompetition' name='datecompetition' size='70px' value='' /></td>
		</tr>
		<tr>
			<td>Lieux</td>
			<td><input type='text' id='lieux' name='lieux' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><input type='text' id='description' name='description' value='' size='100px' /></td>
		</tr>
		<tr>
			<td>S&eacute;lectionn&eacute;e</td>
			<td><SELECT name='selected' size='1'>
					<option value='1' selected >Oui</OPTION>
					<option value='0' >Non</option>
				</SELECT>
			</td>
		</tr>	
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionCompetition")' /></p>
