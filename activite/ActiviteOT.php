
<?php
				
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
	}
	catch(Exception $e){
	echo "une erreur est survenue";
	die('Erreur : '.$e->getMessage());

	}
	//Cette requete va chercher dans la table activite tout les incidents, leurs localisations 
	//ainsi que le nombre d'incidents qu'il y a eu dans chaque zone. J'ai utilisé un Alias car en JavaScript la clé "COUNT( * )"
	//n'est pas reconnu à cause des parenthese j'ai donc defini un alias afin d'avoir un nouveau nom pour la clé.
	
	$reqINC = "SELECT TYPETICKET, CODESITE, COUNT( * ) AS COMPTAGE FROM activite WHERE TYPETICKET = \"OT\" GROUP BY CODESITE";
	$reponseINC = $bdd -> query($reqINC);
	$tuple = $reponseINC -> fetchAll(PDO::FETCH_ASSOC);	
	//print_r($tuple);
	echo JSON_encode($tuple);
	
?>