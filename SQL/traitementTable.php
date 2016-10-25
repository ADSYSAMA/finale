<!DOCTYPE html> 
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="author" content="Namarcil" />
	<!--<script src="http://code.jquery.com/jquery-latest.js"></script>-->
	
	<script type="text/javascript" language="javascript" src="formulaire.js"></script> 
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>

</head>

<body>

<?php

	require('connexion.php');
	
	$name=null;
	$type=null;
	$null=null;
	$taille=0;
	$index=null;
	$nomT=null;
	
	$tableau= array();
	
	
	// Récupération des informations du formulaire de création de table
	
	if (isset ($_POST['nomT']) and trim($_POST['nomT'])!="")
	{
		$nomT=$_POST['nomT'];   
		}
	
	if (isset ($_POST['name']) and !empty($_POST['name']))
	{
		$name=$_POST['name'];
		array_push($tableau, $name);    
		}
		
	if (isset ($_POST['type']) and !empty($_POST['type']))
	{
		$type=$_POST['type'];
		array_push($tableau, $type);
		
		}
		
	if (isset ($_POST['taille']) and !empty($_POST['taille']))
	{
		$taille=$_POST['taille'];
		array_push($tableau, $taille);
		
		}
		
	if (isset($_POST['Null']) and !empty($_POST['Null']))
	{ 
		$null=$_POST['Null'];
		array_push($tableau, $null);
	
	}
		
		
	if (isset ($_POST['index']) and !empty($_POST['index']))
	{
		$index=$_POST['index'];
		array_push($tableau, $index);
		
		}
		
		//print_r($tableau);
	
	/*$sql =	"CREATE TABLE IF NOT EXISTS `".$nom."` (
	  `activite_id` int(11) NOT NULL AUTO_INCREMENT,
	  `TYPETICKET` varchar(5) DEFAULT NULL,
	  `CODESITE` varchar(255) DEFAULT NULL,
	  PRIMARY KEY (`activite_id`),
	  KEY `CODESITE_index` (`CODESITE`)
	) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50001 ;" ;*/
		
		// Création/Préparation de la requête pour la création d'une table		
		$sql =	"CREATE TABLE IF NOT EXISTS `".$nomT."` </br>( " ;
		
		$champs = array();
		
		$length=count($tableau[0]);		//nombre de ligne
		$length2=count($tableau);		//nombre de champs
		$nomImportance="";
		
		for ($i=0;$i<$length;$i++){
			$indice=0;
			$struct = "";
			for ($j=0;$j<$length2;$j++){
				$inter = $tableau[$indice][$i];
				if($indice == 0){
					$struct=$struct."`".$inter."` ";
					//echo $struct;
				}
				else if($indice == 1){
					$struct=$struct.$inter;
				}
				else if($indice == 2){
					$struct=$struct."(".$inter.") ";
				}
				else if($indice == 3){
					$struct=$struct.$inter;
				}
				else{
					if($inter == "PRIMARY"){
						$nomImportance="`".$tableau[0][$i]."`";
					}
				}
				$indice++;
			}
			$struct=$struct.",";
			array_push($champs,$struct);
		}
		/*
		echo "<pre>";
		print_r($champs);
		echo "</pre>";
		
		echo $nomImportance."\r\n";
		*/
		for ($i=0;$i<$length;$i++){
			$sql=$sql." ".$champs[$i];
		}
		
		$sql = $sql." </br> PRIMARY KEY (".$nomImportance.")) </br>ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50001 ;";
		
		echo $sql;
		
		// Exécution de la requête
		$reponse2 = $db->query($sql);
		//echo "<script>alert(\"table creer\")</script>";
		// echo "<script type='text/javascript'>document.location.replace('bigdump.php');</script>";
		
?>


	
</body>
</html>