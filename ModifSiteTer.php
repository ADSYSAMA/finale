<?php
	if(isset($_POST['first_selec']) && isset($_POST['Nom']) && isset($_POST['Adresse']) && isset($_POST['Code']) && isset($_POST['Ville'])){
		try{
			$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		}
		catch(Exception $e){
			die('Erreur : '.$e->getMessage());
		}
//////////////////////////////////////////////////////////////////////COMPLETER A PARTIR D'ICI///////////////////////////////////////////////////////////////////////
		$zone = $_POST['first_selec'];
		if ($zone=="0"){
			$zone=$nom_plaque;
		}
		
		$reponse = $bdd->query("SELECT ID FROM zone WHERE Zone = '$zone'");
		while ($donnees = $reponse->fetch()) {
			$zoneId = $donnees['ID'];
		}
		$site=$_POST['Nom'];
		$exNom=$nom_site;
		$adr=$_POST['Adresse'];
		$code=$_POST['Code'];
		$ville=$_POST['Ville'];
		$plaque= $zoneId;
		$type=$_POST['boutique'];
		$descr=$_POST['Describe'];
		if((isset($_POST['lat'])) && (isset($_POST['lng']))){
			$lat=$_POST['lat'];
			echo"<script type='text/javascript'>alert(\"$lat\");</script>";
			$lng=$_POST['lng'];
			echo"<script type='text/javascript'>alert(\"$lng\");</script>";
			mysql_connect("localhost","root","") or die ("ERREUR CONNEXION BDD");
			mysql_select_db("info") or die ("ERREUR CHOIX BDD");
			$sql="UPDATE base SET SITE_CLIENT='$site', ADRESSE='$adr', CODE_POSTAL='$code', VILLE='$ville', LONGITUDE='$lng', LATITUDE='$lat', SECTEUR='$plaque', TYPE_DE_SITE='$type', DESCRIPTION='$descr' WHERE SITE_CLIENT='$exNom';";
			$req=mysql_query($sql);
			if($req==true){
				echo "<script>alert('Modif effectuée'); </script>";
			}
		}
	}
?>
