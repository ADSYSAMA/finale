<?php

	require('identifiants.php');
	
	
	


//=========================
// Traitement des donnees
//=========================

//recupère le nom du fichier indiqué par l'user
$fichier=$_FILES["userfile"]["name"];

$nomTab = explode(".",$fichier);
$nomTab = array_map('strval', $nomTab);
$nom = $nomTab[0];		


// ouverture du fichier en lecture
if ($fichier)
{
//ouverture du fichier temporaire
	/*$fp = fopen ($_FILES["userfile"]["tmp_name"], "r");


	$ligne = fgets($fp);
	 
	$premiereLigne = explode(";",$ligne);
	$premiereLigne = array_map('strval', $premiereLigne);
	$nbr_champ=count($premiereLigne);
	$departement=$premiereLigne[0];*/

	$matrice = array();
	/*for($j=0; $j<3; $j++){
		$matrice[$j] = array();
	}*/

	$ligne = 0; // compteur de ligne
	$taille=0;
	$champs=0;
	//$fic = fopen($nom.".csv", "a+");
	$fic = fopen ($_FILES["userfile"]["tmp_name"], "a+");
	while($tab=fgetcsv($fic,1024,';'))
	{
		$champs = count($tab);//nombre de champ dans la ligne en question
		$taille = $taille + $champs;
		$ligne ++;
		echo gettype($tab[0]);
		//echo $tab;
	}
	
		/*for($k=0; $k<$ligne; $k++){
			$matrice[$k] = array();
			//echo $k;
		}*/
		echo $champs;
		for($j=0; $j<$champs; $j++){
			$matrice[$j] = array();
		}

		$indice=0;
		$indice2=0;
		$fic = fopen ($_FILES["userfile"]["tmp_name"], "a+");
		
		/*for($i=0; $i<$ligne; $i++){
			//echo 'I: '.$i.' ';
			while($tab=fgetcsv($fic,1024,','))
			{
				if($i==$indice2){
					for($l=0; $l<$champs; $l++){
						array_push($matrice[$indice],$tab[$l]);
					}
				}
				$indice++;
			}
			$indice2++;
			echo $indice2.'ok';
		}*/

		while($tab=fgetcsv($fic,1024,';'))
		{
			for($l=0; $l<$champs; $l++){
				array_push($matrice[$l],$tab[$l]);
			}
		}

	echo "<pre>";
	print_r($matrice);
	echo "</pre>";

	//echo $matrice[0][0];
	//echo $matrice[3][3];


}


else{


$extensions_valides = array( 'csv' );

$extension_upload = strtolower(  substr(  strrchr($_FILES["userfile"]["tmp_name"], '.')  ,1)  );
if ( !(in_array($extension_upload,$extensions_valides)) ) 
{
echo "<script>alert(\"L'extention du fichier est incorrecte. Veuillez entrer un fichier .csv\")</script>";
} 

?>
<p align="center" >- Importation échouée -</p>
<p align="center" ><B>Désolé, mais vous n'avez pas spécifié de chemin valide ...</B></p>
<?php
exit();
}
// declaration de la variable "cpt" qui permettra de conpter le nombre d'enregistrement réalisé
$cpt=0;
?>
<p align="center">- Importation Réussie -</p>


<?php
//echo $premiereLigne[0];
//while (!feof($fic))
//{

//$liste = fgetcsv($fic, 4096, ";");


$sql = "CREATE TABLE IF NOT EXISTS `".$nom."` (
  `".$matrice[0][0]."` int(11) NOT NULL ,
  `".$matrice[1][0]."` varchar(5) DEFAULT NULL,
  `".$matrice[2][0]."` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`".$matrice[0][0]."`),
  KEY `nomcom_index` (`".$matrice[2][0]."`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40184 ;";

	
	
	
/*$sql =	"CREATE TABLE IF NOT EXISTS `".$nom."` (
  `activite_id` int(11) NOT NULL AUTO_INCREMENT,
  `TYPETICKET` varchar(5) DEFAULT NULL,
  `CODESITE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`activite_id`),
  KEY `CODESITE_index` (`CODESITE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50001 ;" ;


$reponse = $db->query($sql);*/

/*for ($a=0;$a<$nbr_champ;$a++){

$liste[$a]=( isset($liste[$a]) ) ? $liste[$a] : Null;

}*/

//echo $liste[4];



/*$champs1=$liste[0];
$champs2=$liste[1];
$champs3=$liste[2];*/


// pour eviter qu un champs "nom" du fichier soit vide
//if ($champs1!='')
//{
	
$attribut = "";
$indice1=0;
for($l=0; $l<$champs-1; $l++){
	$attribut = $attribut.$matrice[$l][0].",";
	$indice1++;
}
$attribut = $attribut.$matrice[$indice1][0];
echo $attribut."\n";

for($j=1; $j<$ligne; $j++){
	/*echo $matrice[$j][0];
	echo $matrice[$j][1];
	echo gettype($matrice[$j][1]);
	echo gettype($matrice[$j][0]);*/
	//$valeur = "'".$matrice[0][$j]."','".$matrice[1][$j]."','".$matrice[2][$j]."'";
	$valeur = "'";
	$indice=0;
	for($l=0; $l<$champs-1; $l++){
		$valeur = $valeur.$matrice[$l][$j]."','";
		$indice++;
	}
	$valeur = $valeur.$matrice[$indice][$j]."'";
	
	echo $valeur."\n";
	echo $attribut."\n";
	$req1 = "INSERT INTO ".$nom."(".$attribut.") VALUES($valeur)";
	echo $req1."\n";
	$reponse1 = $db->query($req1);
}

	
/*
$dep="dep";

$req2 = "DELETE FROM ".$nom." WHERE (dep='$dep')";
	$reponse2 = $db->query($req2);

*/





fclose($fic);

?>