
<?php
	session_start();
	require('identifiants.php');
	
	// Récupération du nom de la zone mi en paramètre
	if (isset ($_GET['zone']) and trim($_GET['zone'])!="")
	{
		$zone=$_GET['zone'];   
	}
	
	// Récupération de l'ID à partir du nom de la zone dans la BDD
	$sql ="SELECT ID FROM zone WHERE Zone='".$zone."';";
	
	//echo $sql;
		
	$reponse = $db->query($sql);
		
	while($inter = $reponse->fetch(PDO::FETCH_ASSOC)){
		echo "<a href=\"testExcel/Classes/recup.php?id=".$inter["ID"]."\" target=_self id='lienModif'>Calculer le distancier de la plaque ".$zone."</a> <br>";
	}
	
	
	
	
?>
