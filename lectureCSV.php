<?php


$matrice = array();
/*for($j=0; $j<3; $j++){
	$matrice[$j] = array();
}*/

$ligne = 1; // compteur de ligne
$taille=0;
$fic = fopen("new.csv", "a+");
while($tab=fgetcsv($fic,1024,','))
{
	$champs = count($tab);//nombre de champ dans la ligne en question
	$taille = $taille + $champs;
	$ligne ++;
	echo $champs;
}

	/*for($k=0; $k<$ligne-1; $k++){
		$matrice[$k] = array();
		//echo $k;
	}*/

	for($j=0; $j<$champs; $j++){
		$matrice[$j] = array();
	}

	$indice=0;
	$indice2=0;
	$fic = fopen("new.csv", "a+");
	
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

	while($tab=fgetcsv($fic,1024,','))
	{
		for($l=0; $l<$champs; $l++){
			array_push($matrice[$l],$tab[$l]);
		}
	}

echo "<pre>";
print_r($matrice);
echo "</pre>";

echo $matrice[0][0];
echo $matrice[3][3];


?> 