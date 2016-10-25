
<?php
				
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
	}
	catch(Exception $e)
	{
		echo "une erreur est survenue";
		die('Erreur : '.$e->getMessage());
	}
	
	$reqRapport = "SELECT COUNT(TYPETICKET) AS COMPTAGE_TYPETICKET, nombretechnicien.COMPTAGE_NOM,
nombretechnicien.NOM_AGENCE_NIV2
FROM activiteplaque3, nombretechnicien
WHERE nombretechnicien.NOM_AGENCE_NIV2 = activiteplaque3.NOM_AGENCE_NIV2
GROUP BY nombretechnicien.NOM_AGENCE_NIV2";

	$reponseRapport = $bdd -> query($reqRapport);
	$tuple = $reponseRapport -> fetchAll(PDO::FETCH_ASSOC);	
	//print_r($tuple);
	echo JSON_encode($tuple);
	
?>

