<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="FR"> 
	<head>
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
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCkIKomOEtofGb7ZaTJqXpNafzndS1h8Zs&sensor=false"></script> <!-- Google Map API -->
		<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script> <!-- Marker -->
		<link rel="shortcut icon" href="image/img/mini_orange.jpg">
		
		


<script type="text/javascript">

function open_infos()
{
width = 300;
height = 200;
if(window.innerWidth)
{
var left = (window.innerWidth-width)/2;
var top = (window.innerHeight-height)/2;
}
else
{
var left = (document.body.clientWidth-width)/2;
var top = (document.body.clientHeight-height)/2;
}
window.open('index.php','nom_de_ma_popup','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
}

function charge()
{
 window.opener.chargeOk = "true";
}

</script>


	</head>
	<body onload="charge()">
	
		<?php 
				if (!empty($_SESSION['login']))
				echo '<li><a href="deco.php">Déconnexion</a></li>';
				else 
				echo '<li><a href="login.php">Connexion</a></li>';
			?>
				
		
<center> <div id="Chargement" > </div> </center>
<div class="contentBox" style="" id="content_8">
<script type="text/javascript"> //Chargement de la page
function hide_precharge() {
document.getElementById('imagechargement').style.display='none';
}
if (window.attachEvent) { 
eval("window.attachEvent('onload',hide_precharge);"); 
}
else { 
eval("window.addEventListener('load',hide_precharge,false);"); 
}
</script>
<div id="imagechargement" style="position: absolute; top: 200px; left: 50%;">
<img src="image/img/load.gif" />
</div>
    
    
    

	<style>
	
	body {
	/* Anciens navigateurs */
	background: black url("body-bg.png") repeat-y left;
	-o-background-size: 100% 100%;
	-moz-background-size: 100% 100%;
	-webkit-background-size: 100% 100%;
	background-size: 100% 100%;
	/* Navigateurs récents */
	background: -webkit-gradient(
		linear,
		left bottom, right top,
		from(darkgray),
		to(black)
	);
	background: -webkit-linear-gradient(
		left bottom,
		darkgray,
		black
	);
	background: -moz-linear-gradient(
		left bottom,
		darkgray,
		black
	);
	background: -o-linear-gradient(
		left bottom,
		darkgray,
		black
	);
	background: linear-gradient(
		left bottom,
		darkgray,
		black
	);
}
	

		#map_index {
			height: 1000px;
			margin: 0 auto;
			width: 100%;
		}
		
		
		#EmplacementDeMaCarte {
			height: 100%;
			width: 100%
			margin: 0px;
			padding: 0px
		}

		#panel {
			float: right;
			left: 50%;
			margin: 0 auto;
			padding: 0 5px 0 5px;
			
			border: 1px solid #999;
			height: 100%;
		}	
			

.contextmenu{
    visibility:hidden;
    background:white;
    border:1px solid #8888FF;
    z-index: 10;  
    position: relative;
    width: 140px;
	color:rgb(255,102,0);
}
.contextmenu div{
    padding-left: 5px
    }
	
	.label {font-size:15px; text-align:center; color:black; text-shadow:0 0 5px #fff; font-family:Helvetica, Arial, sans-serif;}

	</style>
<div class="formDiv" id="map_canvas"></div>		
		

	</style>

<!--********************************************************************************************
*																							   *
*  							CREATION DU MENU GEOGRAPHIQUE (DROITE) 							   *				 	
*																							   *
*********************************************************************************************-->
		
	<body onload="initialize();">

		<br/>
		<br/>
		
		<div id="EmplacementDeMaCarte"></div>

		<div id="map_index" >


			<div id="panel">
				<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
				
				<br />

			
	
				<ul class="navigation">
					<?php
						if(file_exists('data.xml')){
							unlink('data.xml');
						}
						try{
							// Connexion à MySQL
							$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
							$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
						}
						catch(Exception $e){
							// En cas d'erreur, on affiche un message et on arrête tout
							echo "une erreur est survenue";
							die('Erreur : '.$e->getMessage());

						}
						$req = "SELECT ID, USEI FROM usei";
						$reponse = $bdd->query($req);		
						$categories = array();
						while ($donnees = $reponse->fetch()){
							$idUsei = $donnees['ID'];
							$usei = $donnees['USEI'];
							echo "<input type=\"checkbox\" name=\"map\" id=\"$usei-ch\" value=\"$usei\" onclick=\"checkThree(this)\"/>";
							echo "<ul style=\"display:block; \" class=\"subMenu\">\n";
							$reponse2 = $bdd->query("SELECT * FROM zone WHERE USEI = '$idUsei'");
							while ($donnees2 = $reponse2->fetch()){
								$idZone = $donnees2['ID'];
								$zone =  $donnees2['Zone'];
								echo "<li style=\"position: static; left: 5%; \" class=\"toggleSubMenu2 open\"><input type=\"checkbox\" name=\"map\" class=\"five\" id=\"$zone-ch\" value=\"$zone\" onclick=\"checkTwo(this)\"/><span> $zone  </span>\n";
								echo "<ul style=\"display: block; \" class=\"subMenu2\">\n";
								$reponse3 = $bdd->query("SELECT ID, SECTEUR, SITE_CLIENT FROM base WHERE SECTEUR = '$idZone'");
								while ($donnees3 = $reponse3->fetch()){
									$idSite = $donnees3['ID'];
									$site = $donnees3['SITE_CLIENT'];
									echo "<li><input style=\"left: 10%;\" type=\"checkbox\" name=\"map\"  value=\"$site\" onclick=\"Envoimap(this)\"/><a href=\"site.php?site=$site\" target=_blank>$site</a></li>\n";
								}//
								echo "</ul>\n</li>\n";
							}
							echo "</ul>\n</li>\n";
						}
					?>
				</ul>
			</div>
	</body>
</html>


