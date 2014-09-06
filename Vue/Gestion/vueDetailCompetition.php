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
<p><h3>D&eacute;tails d'une comp&eacute;tition</h3></p>
<form action="index.php?action=modificationCompetition" method="post" id="modifierCompetition">
<input type='hidden' id='idCompetition' name='idCompetition' value='<?php echo $competition['idcompetition'] ?>'>
	<table id="csstable" align="center">
		<tr>
			<td width="40%">Libell&eacute;</td>
			<td width='60%'><input type='text' id='libelle' name='libelle' value='<?php echo $competition['libelle'] ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>Date</td>
			<td><input type='text' id='datecompetition' name='datecompetition' size='70px' value='<?php echo $competition['datecompetition'] ?>' /></td>
		</tr>
		<tr>
			<td>Lieux</td>
			<td><input type='text' id='lieux' name='lieux' value='<?php echo $competition['lieux'] ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>Type</td>
			<td><SELECT name='type' size='1'><?php
				if ($competition['type'] == 1) {
					echo "<option value='1' selected >EQUIPE</OPTION> ";
					echo "<option value='0' >INDIVIDUEL</option>";
				} else {
					echo "<option value='0' selected >INDIVIDUEL</option>";
					echo "<option value='1' >EQUIPE</option> ";
				}
?>
				</SELECT></td>
		</tr>
		<tr>
			<td>Description</td>
			<td><input type='text' id='description' name='description' value='<?php echo $competition['description'] ?>' size='100px' /></td>
		</tr>
		<tr>
			<td>S&eacute;lectionn&eacute;e</td>
			<td><SELECT name='selected' size='1'>
			<?php
				if ($competition['selected'] == 1) {
					echo "<option value='1' selected >Oui</OPTION> ";
					echo "<option value='0' >Non</option>";
				} else {
					echo "<option value='0' selected >Non</option>";
					echo "<option value='1' >Oui</option> ";
				}
?>
				</SELECT></td>
		</tr>	
	</table>
	<p align='center' ><input type="submit" name="valider" /></p>
</form>	
<p align='center' ><input type='button' name='retour' value='retour' onclick='window.location.replace("index.php?action=gestionCompetition")' /></p>
