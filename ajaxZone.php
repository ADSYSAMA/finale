<?php

	require('config.php');
	require('connexion.php');

	// $tab = array(); 

 $sql2 = "SELECT DISTINCT ID, Zone FROM zone"; 
        $reponse2 = $db->query($sql2);
    
    $tuple2 = $reponse2 -> fetchAll(PDO::FETCH_NUM);
	// while($res3 = $reponse2 -> fetch(PDO::FETCH_ASSOC)){ 
 //             array_push($tab, $res3['Zone']);
            	 
 //    }	
    //print_r($tab);
    	
 	echo json_encode($tuple2);
 	
 ?>