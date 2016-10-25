<?php

	session_start();
	require('identifiants.php');
	
	
	$html='';
	$choix='';
	$userfile='';
	$classe='';
	$table='';
	//echo $choix;
	if(isset($_POST['choix']) and isset($_POST['userfile'])){
		$choix=$_POST['choix'];
		$userfile=$_POST['userfile'];
		$chemin=realpath($_POST['chemin']);
		//echo "Choix: ".$choix;
	}
	else{
		echo 'NON';
	}
	
	if(isset($_POST['table']) and isset($_POST['classe'])){
		$table=$_POST['table'];
		$classe=$_POST['classe'];
		/*echo "Table: ".$table;
		echo "Classe: ".$classe;*/
	}
	
	//echo "Table: ".$table;
	//echo $choix;


//=======================================================================================================
// Traitement des donnees avec des tests (if/else if) pour dissocier les différentes tâches à effectuer.
//=======================================================================================================


if(isset($_POST['envoyer'])){

	//echo "Envoyer";

	// Nom du fichier
	$fichier=$_FILES["userfile"]["name"];

	// Test de l'extension du fichier
	$extensions_valides = array( 'csv' );
	$extension_upload = strtolower(  substr(  strrchr($_FILES["userfile"]["name"], '.')  ,1)  );
	if ( !(in_array($extension_upload,$extensions_valides)) ) 
	{
		// Redirection auto vers bigdump.php si l'extension est incorrecte
		echo "<script>alert(\"L'extention du fichier est incorrecte. Veuillez entrer un fichier .csv\")</script>";
		echo "<script type='text/javascript'>document.location.replace('bigdump.php');</script>";
	} 


	$nomTab = explode(".",$fichier);
	$nomTab = array_map('strval', $nomTab);
	$nom = $nomTab[0];	
	echo $nom;	



	// ouverture du fichier et traitement pour insérer dans la BDD
	if ($fichier)
	{
		
		$req1 = "LOAD DATA LOCAL INFILE 'http://localhost/SQL/".$fichier."' 
				INTO TABLE `".$nom."` 
				FIELDS TERMINATED BY ';'
				LINES TERMINATED BY '\r\n'
				IGNORE 1 LINES ;" ;
		
		$reponse1 = $db->query($req1);
		// echo $_FILES["userfile"]["name"];
		// print_r($_SERVER);
		
	
	}

}


elseif($choix=='Voir noms des colonnes'){
	$fichier=$userfile;
	if ($fichier)
	{
		$matrice = array();

		$ligne = 0; // compteur de ligne
		$taille=0;
		$champs=0;
		// chemin du fichier
		$a=realpath($userfile);
		// ouvre le fichier en lecture
		$fic = fopen ($chemin, "r");
		
		// Récupère la première ligne du fichier
		$tab=fgetcsv($fic,1024,';');
		$champs = count($tab);//nombre de champ dans la ligne en question
		
		// Création d'autant de tableau que de champs dans la ligne.
		for($j=0; $j<$champs; $j++){
			$matrice[$j] = array();
		}

		$indice=0;
		$indice2=0;
		$a=realpath($userfile);
		$fic = fopen ($chemin, "r");
		
		
		/*print_r($tab);
		$tab=fgetcsv($fic,1024,';');
		print_r($tab);*/
		
		// Récupère les deux première lignes puis il y a insertion dans les tableaux.
		for($i=0;$i<2;$i++){
			$tab=fgetcsv($fic,1024,';');
			for($l=0; $l<$champs; $l++){
				array_push($matrice[$l],$tab[$l]);
			}
		}
		
		
		// Préparation/Mise en forme pour l'insertion dans le tableau HTML pour l'affichage sur la page bigdump.php
		$html= array();
		
		for($i=0;$i<2;$i++){
			for($l=0; $l<$champs; $l++){
				/*echo $matrice[$l][0] */;
				array_push($html,$matrice[$l][$i]);
			}
		}
		
		foreach ($html as $value) {
			echo $value."|";
		}

	}
}

elseif($choix=='Vider/Supprimer Table'){
	
	// Récupération des tables de la BDD info
	$html= array();
	
	$req1 = "SHOW TABLES FROM info;" ;
			
	$reponse1 = $db->prepare($req1);
	$html=$reponse1->execute();
	
	while($inter = $reponse1->fetch(PDO::FETCH_ASSOC)){
		echo $inter['Tables_in_info']."|";
	}
	
	
}

if($classe=='supprimer'){
	
	// Suppression d'une table
	$req1 = "DROP TABLE ".$table.";" ;
	
	//echo $req1;
			
	$reponse1 = $db->prepare($req1);
	$reponse1->execute();
	
	
}

elseif($classe=='vider'){
	
	// Vidage d'une table
	$req1 = "TRUNCATE ".$table.";" ;
	
	//echo $req1;
			
	$reponse1 = $db->query($req1);
}

// Redirection auto vers bigdump.php
echo "<script type='text/javascript'>document.location.replace('bigdump.php');</script>";

//session_destroy();

?>