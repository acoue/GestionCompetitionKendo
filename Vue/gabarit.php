<!doctype html>
<!--[if lte IE 7]> <html class="no-js ie67 ie678" lang="fr"> <![endif]-->
<!--[if IE 8]> <html class="no-js ie8 ie678" lang="fr"> <![endif]-->
<!--[if IE 9]> <html class="no-js ie9" lang="fr"> <![endif]-->
<!--[if gt IE 9]> <!--><html class="no-js" lang="fr"> <!--<![endif]-->
<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
		<title><?php echo Configuration::getParametreInBdd("titreSite") ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!--[if lt IE 9]>
		<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link rel="stylesheet" href="css/knacss.css" media="all">
		<link rel="stylesheet" href="css/styles.css" media="all">
		<link rel="stylesheet" type="text/css" href="css/printPoule.css" media="print" />
		<link rel="stylesheet" href="js/jquery/css/smoothness/jquery-ui-1.10.4.custom.css" />
		<script src="js/jquery-2.1.0.js"></script>
		<script src="js/menu_jquery.js"></script>
		<script src="js/jquery/js/jquery-1.10.2.js"></script>
  <script src="js/jquery/js/jquery-ui-1.10.4.custom.js"></script>
<script>		
	$('#cssmenu > ul > li > a').click(function() {
  	$('#cssmenu li').removeClass('active');
  	$(this).closest('li').addClass('active');	
  	var checkElement = $(this).next();
  	if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    	$(this).closest('li').removeClass('active');
    	checkElement.slideUp('normal');
  	}
  	if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    	$('#cssmenu ul ul:visible').slideUp('normal');
    	checkElement.slideDown('normal');
  	}
  	if($(this).closest('li').find('ul').children().length == 0) {
    	return true;
  	} else {
    	return false;	
  	}		
	});
</script>
</head>
<body>
	<header id="header" role="banner" class="line pam">
		<img src="img/site/header.png" border="0" alt="Retour &agrave; l'accueil" align="left" /><img src='img/site/logo_gc4k_mini.png' border='0'/><?php echo Configuration::getParametreInBdd("titreSite") ?>
		<p class="titreHeader"><?php  if(isset($_SESSION['competition']))echo $_SESSION['competition']; else echo "";?></p>
	</header>
	<aside id="letf-side" class="mod left mrs pam w20 aside">
<?php 
	//Log::loggerInformationInFile("LogInUser -> crypt data : ".Securite::crypteData("cnk2014"));
	if (Securite::utilisateurConnected() === '1') {
		require_once 'Config/fonction.php';
		require_once Configuration::get("chemin_vue").'menu.php';
	} 
?>	
		</aside>
		<div id="main" role="main" class="mod pam">
	<!--		<div id="erreur">TO DO : <br />
			 - Remontée des résultats des combats dans l'impression des poules<br />
			 - Dessiner tableau<br />
			 - Résultats des combats du tableau<br />		
			</div>
		-->
		<?php 			
			//Bloc Erreur / info
			if (!empty($erreur)) { 
			    echo '<div id="erreur">';     
			    foreach($erreur as $e) {
			        echo traitementAccent($e).'<br/>';
			    }     
			    echo '</div>';
			}
			//Bloc contenu
			echo $contenu ;
			
		?>	
		</div> 

	<footer id="footer" role="contentinfo" class="line pam txtcenter">
	<table>
		<tr>
			<td width='10%' align='center'><img alt="Licence Creative Commons" src="img/site/by-nc-nd.eu.png" /></td>
			<td><?php echo Configuration::getParametreInBdd("piedSite") ?></td>
			<td width='20%' align='right'><a href='index.php?action=deconnexion'>
			<?php 
			if (Securite::utilisateurConnected() === '1') echo "<span><img src='img/site/logout.png' border='0' /></span></a>";
			?>
			</td>
		</tr>
	</table>
	
	
	</footer>

</body>
</html>