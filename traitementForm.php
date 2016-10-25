<?php

	

		$adresse=$_POST["Adresse"].' '.$_POST["Ville"].' '.$_POST["Code"];
		$secteur = strtoupper($_POST["sec"]);
		$connect= mysqli_connect("localhost","root","") or die ("'ERREUR CONNEXION BDD");
		mysqli_select_db($connect,"info") or die ("ERREUR CHOIX BDD");
		$Nom=$_POST['Nom'];
		$sql="SELECT SITE_CLIENT FROM base WHERE SITE_CLIENT='$Nom';";
		$req=mysqli_query($connect,$sql);
		if(mysqli_num_rows($req)==0){
			$lat=$_POST['lat'];
			$lng=$_POST['lng'];
			$ville = strtoupper($_POST["Ville"]);
			$Nom = strtoupper($_POST["Nom"]);
			$adresse = strtoupper($_POST["Adresse"]);
			$code = strtoupper($_POST["Code"]);
			$site = $secteur;
			$boutique = $_POST["boutique"];
			$description = strtoupper($_POST["Describe"]);
			$sqll = "INSERT INTO base (SITE_CLIENT, ADRESSE, CODE_POSTAL, VILLE, LONGITUDE, LATITUDE, SECTEUR, TECHNICIEN, TYPE_DE_SITE, DESCRIPTION) VALUES ('$Nom', '$adresse', '$code', '$ville', '$lng', '$lat', '$site', '', '$boutique', '$description')";
			$reqq = mysqli_query($connect,$sqll);
			if ($reqq == true){
				echo "<script type='text/javascript'>
				alert('Nouveau site ajouté');
				document.location.replace('Ajouter.php');
				</script>";
			}
		}

		else{
			echo'<script type=text/javascript>alert("Le site n\'a pas pu être ajouté car il existe déjà.");</script>';
		}
	

	?>