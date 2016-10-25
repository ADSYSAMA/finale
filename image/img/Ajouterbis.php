<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="FR"> 
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <script src="http://maps.google.com/maps?file=api&v=2.x&key=AIzaSyA_bjrrep3wp0QJ7R4qKMetVUGOIFOSiiE&sensor=false"type="text/javascript"></script> 
  <meta name="author" content="Namarcil" />
  <script type="text/javascript" language="javascript" src="function.js"></script> 
  <link rel="stylesheet" type="text/css" href="style2.css" media="screen,projection" />
  <!-- TITRE DANS BARRE DE TITRE fenetre du navigateur -->
  <title>USEI IDF</title>
<link rel="shortcut icon" href="img/mini_orange.jpg">
</head>
<?php
session_start();

/* 
si la variable de session login n'existe pas cela siginifie que le visiteur 
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
if($_SESSION['login'] != "admin") {
	echo "<script type='text/javascript'>
		alert('Vous n\'êtes pas autorisé à acceder a cette page, vous allez être redirigé après avoir validé cette boite de dialogue');
		</script>";
	header("Refresh:1;url=login.html"); // redirection vers "login.html" dans 1 seconde
	die();
}
?>
<head>
<body>
  <a href='index.php'><img id="logo" src='img/france-telecom-orange.jpg' title="Cliquez pour revenir a l'acceuil" /></a>
	<div align="center">
	<!-- La carte nomme "MaCarte", va venir s'afficher  l' int?rieur de --> 
	<!-- la balise <div> ayant pour identifiant id="EmplacementDeMaCarte". --> 
	<!-- Elle fera donc 740 pixels de large et 400 pixels de haut / D?finir Taille. --> 
	<h1 class="Style1"><a href='index.php'></a>	France Télécom USEI </h1> <br />
<ul id="horizontal">
	<li>
		<a href="Ajouter.php">Ajouter</a>
			<ul>
				<li><a href="AjouterUSEI.php">Ajouter un USEI</a></li>
				<li><a href="AjouterZone.php">Ajouter une zone</a></li>
				<li><a href="Ajouter.php">Ajouter un batiment</a></li>
				<li><a href="AjouterTec.php">Ajouter un technicien</a></li>
				<li><a href="Ajoutertech.php">Assigner un technicien a un site</a></li>
			</ul>
	</li>
	<li>
		<a href="Modifier.php">Modifier</a>
	</li>
	<li>
		<a href="Supprimer.php">Supprimer</a>
			<ul>
				<li><a href="Supprimertech.php">Supprimer un technicien</a></li>
				<li><a href="TechSuppr.php">Supprimer un technicien en fonction du site</a></li>
			</ul>
	</li>
	<li>
		<a href="Itineraire/distancier.php"> Distancier</a>
	</li>
	<li>
		<a href="Itineraire/iti.php"> Itin&eacute;raire</a>
	</li>
	
	<?php if (!empty($_SESSION['login']))
		echo '<li><a href="deco.php"> Déconnexion</a></li>';
	else 
		echo '<li><a href="login.html"> Connexion</a></li>';
	?>
</ul>
	</div>
	</br>
<?php 
$Adresse=$_POST['Adresse'];
$Code=$_POST['Code'];
$Ville=$_POST['Ville'];
$Nom=$_POST['Nom'];
$Type=$_POST['zone'];
$Describe=$_POST['Describe'];
$usei=$_POST['USEI'];
$boutique=$_POST['boutique'];
$AdresseComplet=$Adresse." ".$Code." ".$Ville;
if(file_exists('Describe.txt')){unlink('Describe.txt');}
$monfichier=fopen('Describe.txt','a+');
fputs($monfichier,$Describe);
fclose($monfichier);
if(file_exists('Boutique.txt')){unlink('Boutique.txt');}
$monfichier=fopen('Boutique.txt','a+');
fputs($monfichier,$boutique);
fclose($monfichier);
if(file_exists('USEI.txt')){unlink('USEI.txt');}
$monfichier=fopen('USEI.txt','a+');
fputs($monfichier,$usei);
fclose($monfichier);
if(file_exists('Adresse.txt')){unlink('Adresse.txt');}
$monfichier=fopen('Adresse.txt','a+');
fputs($monfichier,$Adresse);
fclose($monfichier);
if(file_exists('Code.txt')){unlink('Code.txt');}
$monfichier=fopen('Code.txt','a+');
fputs($monfichier,$Code);
fclose($monfichier);
if(file_exists('Ville.txt')){unlink('Ville.txt');}
$monfichier=fopen('Ville.txt','a+')
;fputs($monfichier,$Ville);
fclose($monfichier);
if(file_exists('Nom.txt')){unlink('Nom.txt');}
$monfichier=fopen('Nom.txt','a+');
fputs($monfichier,$Nom);
fclose($monfichier);
if(file_exists('Type.txt')){unlink('Type.txt');}
$monfichier=fopen('Type.txt','a+');
fputs($monfichier,$Type);
fclose($monfichier);
if(file_exists('AdresseComplet.txt')){unlink('AdresseComplet.txt');}
$monfichier=fopen('AdresseComplet.txt','a+');
fputs($monfichier,$AdresseComplet);
fclose($monfichier);
?>

<!-- TITRE DANS BARRE DE TITRE fenetre du navigateur -->
		<title>USEI IDF</title> 
		<div align="center">
	<!--a La carte nomme "MaCarte", va venir s'afficher  l' int�rieur de --> 
	<!-- la balise <div> ayant pour identifiant id="EmplacementDeMaCarte". --> 
	<!-- Elle fera donc 740 pixels de large et 400 pixels de haut / D�finir Taille. --> 
	</div>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false">
</script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/
jquery.min.js"></script>


<br />
<form id="MonFormulaire" method="post" action="Ajouter.php" name="form" onsubmit="return valider()">
<input type="text" id="adresse" value="<?php echo $AdresseComplet ?>" name="adresse" size="30"/>
<input type="button" onclick="geolocalise()" value="geolocaliser" /><br /><br />
Latitude : <input type="text" name="lat" id="lat" placeholder="geolocaliser" />
Longitude : <input type="text" name="lng" id="lng" placeholder="geolocaliser" /><br /><br />
<input type="submit" value="Envoyer" />
</form>



<div id="answer"></div>



<?php
// SCRIPT DE L'APPLICATION
?>
<script type="text/javascript">
 /* Déclaration des variables globales */ 
 var geocoder = new google.maps.Geocoder();
 var addr, latitude, longitude,test;
 test = document.getElementById('lat');
 
 /* Fonction chargée de géolocaliser l'adresse */ 
 function geolocalise()
 {
  /* Récupération du champ "adresse" */ 
  addr = document.getElementById('adresse').value;
  /* Tentative de géocodage */ 
  geocoder.geocode( { 'address': addr}, function(results, status) 
  {
   /* Si géolocalisation réussie */ 
   if (status == google.maps.GeocoderStatus.OK) {
    /* Récupération des coordonnées */ 
    latitude = results[0].geometry.location.lat();
    longitude = results[0].geometry.location.lng();
    /* Insertion des coordonnées dans les input text */ 
    document.getElementById('lat').value = latitude;
    document.getElementById('lng').value = longitude;
    /* Appel AJAX pour insertion en BDD */ 
    var sendAjax = $.ajax({
     type: "POST",
     url: 'insert-in-bdd.php',
     data: 'lat='+latitude+'&lng='+longitude+'&adr='+addr,
     success: handleResponse
    });
   }
   function handleResponse()
   {
    $('#answer').get(0).innerHTML = sendAjax.responseText;
   }
  }
  );
 }
 function valider(){
 frm=document.forms['form'];
  if((frm.elements['lat'].value > 0)  && (frm.elements['lng'].value > 0)){
    return true;
  }
  else {
    alert("Veuillez verifier les coordonnées, si celles ci sont négatives, verifiez que l'adresse est corecte et existe.");
    return false;
  }
}
</script>