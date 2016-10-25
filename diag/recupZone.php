<?php

	//ob_start(); 
	session_start();

	//$timestart=microtime(true);

	require('identifiants.php');
	
	// Récupération des informations nécessaires pour le diagramme.
	$req1 = "select Zone, NOM_AGENCE_NIV2 from zone";
	$reponse1 = $db->query($req1);
	
	$zone = array();
	$zone[0] = array();
	$zone[1] = array();
		
	while ($resultat=$reponse1->fetch(PDO::FETCH_ASSOC))
	{
		if($resultat['Zone']!='SANS_ZONE' && $resultat['Zone']!='USEI_OUEST' && $resultat['Zone']!='USEI_EST'){
			array_push($zone[0],$resultat['Zone']);
			array_push($zone[1],$resultat['NOM_AGENCE_NIV2']);
		}
	}
	
	$taille=count($zone);
	$taille2=count($zone[0]);
	
	
	for($i=0;$i<$taille;$i++){
		for($j=0;$j<$taille2;$j++){
			if($j==$taille2-1){
				echo $zone[$i][$j];
			}
			else{
				echo $zone[$i][$j].",";
			}
		}
		if($i!=$taille-1){
			echo ",";
		}
	}
	//var_dump($zone);
	//echo JSON_encode($zone);

	//$timeend=microtime(true);
	//$time=$timeend-$timestart;
	 
	//Afficher le temps d'éxecution
	//$page_load_time = number_format($time, 3);
	//echo "Debut du script: ".date("H:i:s", $timestart);
	//echo "<br>Fin du script: ".date("H:i:s", $timeend);
	//echo "<br>Script execute en " . $page_load_time . " sec";

?>
