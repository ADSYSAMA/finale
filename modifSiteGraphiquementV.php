<?php

//La plaque dans laquel se trouve le marqueur n'étant pas indiqué dans la table il faudra mettre a jour la table "base"
ini_set('max_execution_time', 3600);
$nouveau = $_POST['nouveau']; //tableau recuperé par l'ajax, ce tableau ne contient pas l'adressse, la ville le codepostale, le site client, le secteur, le technicien, le type de site et la description.
//$nouveau = [[["zz","ACCUEIL COURS DE VINCENNES (75120301)",21],12,13],[["zz","ACCUEIL ALIGRE (75152501)",21],21,31]];


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



$color = 'red';
?>
<b style='color: <?php echo $color; ?>;'> <h1> ALERTE  </h1> </b>

<?php 
//echo '<h3> BONJOUR </h3>'


	// $reqB = "SELECT * FROM base";
	// $reponseB = $bdd -> query($reqB);
	// $tuple = $reponseB -> fetchAll(PDO::FETCH_ASSOC);	

	// print_r($tuple);

	// foreach($tuple as $cle => $val)//si le marqueur, a la meme latitude et longitude, mais qu'il n'est pas dans la meme plaque, il faut updater la plaque dans la table.
	// {
		// foreach($val as $cle2 => $val2)
		// {
			//if($cle2 == "SITE_CLIENT")//on verifie toute les clé "SITE_CLIENT" et pas les autres comme ADRESSE par ex..
		
				for($a = 0 ; $a < COUNT($nouveau); $a++) 
				{
					
					// if($val["SITE_CLIENT"]== $nouveau[$a][0][1] AND $val["SECTEUR"] != $nouveau[$a][0][2])
					// {		
								//if($val2 == $nouveau[$a])
								//{
									// $flag = true; //chercher a voir si le marqueur est contenu dans la plaque, sinon on update le marqueur (a revoir)
								 //$reqI = "UPDATE base SET ZONE = '$nouveau[a][0]' WHERE LONGITUDE = '$nouveau[a][1]' AND LATITUDE = '$nouveau[a][2]';"//si la plaque a ete modifié on update la plaque du marqueur dedans.
					
						//echo ($site);
						$reqI = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
						$stat = $bdd->prepare($reqI); 
						$stat -> bindParam(1,$secteur);
						$stat -> bindParam(2,$site);
						$secteur = $nouveau[$a][0][2];
						$site = $nouveau[$a][0][1];
						$stat -> execute();
						
						/*$resultats=$bdd->query("SELECT SITE_CLIENT, VILLE,SECTEUR FROM base WHERE SECTEUR= $secteur");
						$resultats->fetchAll(PDO::FETCH_ASSOC);
						foreach($resultats as $cle => $val){
							foreach($val as $cle2=>$val2){
							echo($val2); }
								
						//echo($a);
							foreach  ($bdd->query($resultats) as $row) {
								echo $row['SITE_CLIENT'] . "\t";
								echo  $row['VILLE'] . "\t";
								echo $row['SECTEUR'] . "\n";}
						}*/
					// }
				}
				
					
			//	if ($secteur==21){
							//echo("reussi2 \n");//}}
						// $bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = '$secteur' ");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					//}
					
				/*if ($secteur==20){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 20");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
					
				if ($secteur==19){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 19");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
				if ($secteur==18){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 18");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}

				if ($secteur==17){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 17");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
				if ($secteur==16){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 16");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
					
				if ($secteur==15){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 15");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
				
				if ($secteur==14){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 14");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
					
				if ($secteur==13){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 13");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
					
				if ($secteur==12){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 12");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
				if ($secteur==11){
							echo("reussi2 \n");//}}
						$bdd->exec("UPDATE base SET SECTEUR = 50 WHERE SECTEUR = 11");
						for($b = 0 ; $b < COUNT($nouveau); $b++) 
						{
							$reqII = "UPDATE base SET SECTEUR = ? WHERE SITE_CLIENT = ?";
							$stat1 = $bdd->prepare($reqII); 
						
							$stat1 -> bindParam(1,$secteur1);
							$stat1 -> bindParam(2,$site1);
							$secteur1 = $nouveau[$b][0][2];
							$site1 = $nouveau[$b][0][1];
							$stat1 -> execute();
						}
					}
			//}
		// }
	
	// } 
	*/
	
	$reqB2 = "SELECT * FROM activite";
	//$bdd->exec("UPDATE base SET SECTEUR = 21 WHERE SECTEUR = 1");
	
	
	//echo("reussi");
	//echo JSON_encode($nouveau);
	
	
	
	
	
	
	
	// if($flag == false)
	// {
	// 	$reqI = "UPDATE base SET SITE_CLIENT='$site', ADRESSE='$adr', CODE_POSTAL='$code', VILLE='$ville', LONGITUDE='$lng', LATITUDE='$lat', SECTEUR='$plaque', TYPE_DE_SITE='$type', DESCRIPTION='$descr' WHERE SITE_CLIENT='$exNom';"//si la plaque a ete modifié on update la plaque du marqueur dedans.
	// }
	
	//Ne pas oublié de faire le meme boulot dans les tables activite1-2
	

	
?>