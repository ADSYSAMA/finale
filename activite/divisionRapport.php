<?php

	//$val = $_GET["repere"];
	
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e)
	{
		echo "une erreur est survenue";
		die('Erreur : '.$e->getMessage());
	}	
	
	$reqRapport = "SELECT * from nombretechnicien";//NOM.AGENCE.NIV3
	$reponseRapport = $bdd -> query($reqRapport);
	//... 
	//A completer demain
	
	$tuple = $reponseRapport -> fetchAll(PDO::FETCH_ASSOC);
	print_r($tuple);
	//echo JSON_encode($tuple);

	
?>