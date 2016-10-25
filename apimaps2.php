<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no"/>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="author" content="Namarcil" />
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry"></script> <!-- Google Map API -->
		<script src="elabel.js" type="text/javascript"></script>
		<script type="text/javascript" language="javascript" src="function.js"></script> 
		<script type="text/javascript" language="javascript" src="function2.js"></script> 
		<script type="text/javascript" src="bootstrap.js"></script>  		<!--BootStrap -->
		<link href="bootstrap.css" rel="stylesheet"> 

		<script src="jquery-ui.js"></script> <!-- Pour la barre de chargement -->
		<script src="gmaps.js"></script> <!-- librairie pour menu contextuel, ne fonctionne pas 31/10/2014 -->
		
		<script src="respond.js"></script>  <!-- MediaQueries sous IE8, permet de faire fonctionner la barre de menu: -->
  		<link rel="stylesheet" type="text/css" href="style2.css" media="screen,projection" />
		<link rel="stylesheet" type="text/css" href="style3.css" media="screen,projection" />
		<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> <!-- Pour la barre de chargement -->

  		<!-- TITRE DANS BARRE DE TITRE fenetre du navigateur -->
  		<title>USEI IDF</title>
		<link rel="shortcut icon" href="image/img/mini_orange.jpg">
		<title>Titre de votre page</title>
		<style type="text/css">
			html {
				height: 100%
			}
			body {
				height: 100%;
				margin: 0;
				padding: 0
			}
			#EmplacementDeMaCarte {
				height: 100%
			}
		</style>
		<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script> <!-- Marker -->
		<script type="text/javascript">
			function initialisation(){
				var optionsCarte = {
					zoom: 12,
					center: new google.maps.LatLng(48.856666, 2.350987),
					scaleControl: true,
					overviewMapControl: true,
					overviewMapControlOptions:{opened:true},
					mapTypeId: google.maps.MapTypeId.ROADMAP,
					disableDoubleClickZoom: true,
					streetViewControl: false
				}
				var maCarte = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), optionsCarte);
				
			}
			google.maps.event.addDomListener(window, 'load', initialisation);
			
			var dataF;
			var chaine;

			function affiche()
			{
			 //document.getElementById("idDiv").innerHTML = dataF+" "+chaine;
			 console.log(dataF+" "+chaine);
			}
			function charge()
			{
			 window.opener.chargeOk = "true";
			}
			function decharge()
			{
			 window.opener.chargeOk = "false";
			}
		</script>
	</head>
	<body onload="charge()" onunload="decharge()">
		<div id="EmplacementDeMaCarte"></div>
		<noscript>
			<p>Attention : </p>
			<p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p>
			<p>Or, il semble que JavaScript est désactivé ou qu'il ne soit pas supporté par votre navigateur.</p>
			<p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p>
		</noscript>
	</body>
</html>