<?php

//La plaque dans laquel se trouve le marqueur n'étant pas indiqué dans la table il faudra mettre a jour la table "base"
ini_set('max_execution_time', 10000000);
// $nouveau = $_POST['nouveau']; //tableau recuperé par l'ajax, ce tableau ne contient pas l'adressse, la ville le codepostale, le site client, le secteur, le technicien, le type de site et la description.
// $nouveau = [[["zz","ACCUEIL COURS DE VINCENNES (75120301)",2],12,13],[["zz","ACCUEIL ALIGRE (75152501)",3],21,31]];


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=info','root','');
	$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
	echo "une erreur est survenue";
	die('Erreur : '.$e->getMessage());

}

					 $reqI = "UPDATE`activiteplaque3` natural join `base` SET `NOM_AGENCE_NIV2`='SANS_ZONE' where activiteplaque3.CODESITE=base.SITE_CLIENT AND base.SECTEUR=50";
						
						$bdd->query($reqI);
						 
						 // $stat -> bindParam(1,$zone);
					     // $stat -> bindParam(2,$site);
						 
						 // $zone = $nouveau[$a][3];//recup le nom de la zone genre 75 Alleray
						 // $site = $nouveau[$a][0][1];
						 
						 // $stat -> execute();
						 echo($reqI);
						 
						 // echo($a);

	
	// echo JSON_encode($nouveau);
	

	// UPDATE activiteplaque3 natural join base SET NOM_AGENCE_NIV2='' WHERE SECTEUR=50
	// UPDATE`activiteplaque3` natural join `base` SET `NOM_AGENCE_NIV2`='SANS_ZONE' where activiteplaque3.CODESITE=base.SITE_CLIENT AND base.SECTEUR=50 
	// SELECT * FROM `activiteplaque3` WHERE `CODESITE`='ETAMPES CENTRE TELEPHONIQUE (91948501)' 
	
?>