<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//																													 //
//               Ancienne version avec la recherche des coordonnées à partir d'une Adresse postale                   //
//																													 //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



ob_start(); 
session_start();

$timestart=microtime(true);

	require('connexion.php');
	
	
	// $req1 = "select `label ilot` from distancier";
	// $reponse1 = $db->query($req1);
	// $champs = count($reponse1);
	
	// $t= array();

		
	// 	while ($resultat=$reponse1->fetch(PDO::FETCH_ASSOC))
	// 	{
		
	// 		//echo '<p>'.$reponse1['Adresse'].'</br>'.$reponse1['Code_postale'].' '.$reponse1['Ville'].'</p>';
	// 		array_push($t,$resultat['label ilot']);
	// 		  var_dump($t);
			
			
	// 		//get_coordonees_from_Adresse($resultat['Adresse'].' '.$resultat['Code_postale'].' '.$resultat['Ville']);
			
		
	// 	}

	
	
	$req1 = "SELECT Adresse,Code_postale,Ville FROM distancier";
	 //echo $req1."\n";
	$reponse1 = $db->query($req1);
	$champs = count($reponse1);
	
	$tableau= array();

		
		while ($resultat=$reponse1->fetch(PDO::FETCH_ASSOC))
		{
		
			//echo '<p>'.$resultat['Adresse'].'</br>'.$resultat['Code_postale'].' '.$resultat['Ville'].'</p>';
			array_push($tableau,$resultat['Adresse'].' '.$resultat['Code_postale'].' '.$resultat['Ville']);
			 var_dump($tableau);
			
			
			//get_coordonees_from_Adresse($resultat['Adresse'].' '.$resultat['Code_postale'].' '.$resultat['Ville']);
			
		
	}
	
	$champs = count($tableau);
	
	
	
	
function get_coordonees_from_Adresse($Adresse)
{
  $Adresse = urlencode($Adresse);
  // echo $Adresse;
 
  $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$Adresse.'';
  $page = file_get_contents($url);
  // echo $page ;
  $parsed_json = json_decode($page);
  
  
  $location = $parsed_json->{'results'}[0]->{'geometry'}->{'location'};
    $lattitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
	$longitude = $parsed_json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
		
	 // echo $lattitude.','.$longitude ;

   var_dump($location);

// echo $page;

return ($lattitude.','.$longitude);
}

      function getDistance($Adresse1,$Adresse2) {

    	$url='http://maps.google.com/maps/api/directions/xml?language=fr&origin='.$Adresse1.'&destination='.$Adresse2.'&sensor=false';
    	$xml=file_get_contents($url);
		//echo $xml ;
    	$root = simplexml_load_string($xml);
		
		$duree='';
    	$duree=$root->route->leg->duration->value; 
		date_default_timezone_set('UTC');
		//echo date('H:i:s',intval($duree));
		return date('H',intval($duree)).":".arrondi(date('i',intval($duree)),5);
		
}




		  // $a=get_coordonees_from_Adresse($tableau[0]);
		// $b=get_coordonees_from_Adresse($tableau[1]);
	  // getDistance($a,$b);
	 // $res=getDistance(get_coordonees_from_Adresse($tableau[0]),get_coordonees_from_Adresse($tableau[2]));
	 // echo $res ;




include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel5.php';

					$workbook = new PHPExcel;

					$sheet =
					$workbook->getActiveSheet();
		
				
/*
$lastColumn = $sheet->getHighestColumn();
$lastRow = $sheet->getHighestRow();
$sheet->setCellValue('D1',$lastColumn);
$sheet->setCellValue('D2',$lastRow);
*/


/*
$row = 1;
$lastColumn = $sheet->getHighestColumn();
$lastColumn++;


$limit = 100;
*/


$column = 'A';		
$sheet->getColumnDimension($column)->setWidth(25);

for ($j = 1; $j <= $champs+1; $j++) {
	for ($l = 1; $l <= 1; $l++) {
		$sheet->getStyle($column.$l)->getAlignment()->setTextRotation(60);
		$column++;
	}
}



$column = 'A';

for ($l = 2; $l <= $champs+1; $l++) {

	$sheet->setCellValue($column.$l,$t[$l-2]);
	$sheet->getStyle($column.$l)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}

$column = 'B';
for ($j = 2; $j <= $champs+1; $j++) {
	for ($l = 1; $l <= 1; $l++) {
		$sheet->setCellValue($column.$l,$t[$j-2]);
		$sheet->getStyle($column.$l)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		$column++;
	}
}



/*
for($i=1,$j='A';$i<$limit;$i++,$j++) {
   $sheet->setCellValue($j.$i, $value);
}
*/









//$lastColumn = $worksheet->getHighestColumn();
//$lastRow = $worksheet->getHighestRow()	

$tab=array();
	
	for ($i=0;$i<$champs;$i++){
		$tab[$i]=array();
	}
	$instanciation=0;
	$tabInstanciation = array();
	for ($j=0;$j<$champs;$j++){
		array_push($tabInstanciation,$instanciation);
		$instanciation++;
	}
	
	for ($i=0;$i<$champs;$i++){
			for ($j=0;$j<$champs;$j++){
				array_push($tab[$i],null);
			}
			var_dump($tab[$i]);
	}
	
	for ($i=0;$i<$champs;$i++){
		$interRemplissage=0;
			for ($j=0;$j<$champs;$j++){
				if(in_array($interRemplissage,$tabInstanciation)){
					usleep(13000);

					$res=getDistance(get_coordonees_from_Adresse($tableau[$i]),get_coordonees_from_Adresse($tableau[$j]));
					
					usleep(13000);

					array_push($tab[$i],$res);
					
					$tab[$i][$j]=$res;
					
				}
				$interRemplissage++;
				//else{
					//array_push($tab[$i],$j);
				//}
			}
			echo "Inter: ".$i;
			unset($tabInstanciation[$i]);
			var_dump($tab[$i]);
			
			
			
	}
	
	$indice=0;
	
	$colonneDep = 'B';
	$tabDep = array();
	for ($j=0;$j<$champs;$j++){
		array_push($tabDep,$colonneDep);
		$colonneDep++;
	}
	var_dump($tabDep);
	echo $colonneDep;
	
	for ($i=2;$i<$champs+2;$i++){
		$column = 'B';
		for ($j=2;$j<$champs+2;$j++){
			/*if($column=='B'){
				$sheet->setCellValue($column.$i,'00:00:00');
			}*/
			if(in_array($column,$tabDep)){
				if($column==$tabDep[$i-2]){
					$sheet->setCellValue($column.$i,'00:00');
				}
				else{
					$sheet->setCellValue($column.$i, $tab[$i-2][$j-2]);
				}
			}
			else{
				//$sheet->setCellValue($column.$i, $tab[$j-2][$i-2]);
			}
			$sheet->getStyle($column.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$column++;	
		}
		echo "I:".($i-2)." Valeur: ".$tabDep[$i-2]."</br>";
		unset($tabDep[$i-2]);
	}
	
	$indice=0;
	
	for ($i=2;$i<$champs+2;$i++){
		$column = 'A';
		for ($j=2;$j<$champs+3;$j++){

			  if ($indice % 2 == 0){
				//echo $indice;
				$sheet->getStyle($column.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
				
			 }
			 $column++;
		}
		$indice++;		
		
		

	}

$writer = new PHPExcel_Writer_Excel5($workbook);

$records = 'Test.xls';

$writer->save($records);

$timeend=microtime(true);
$time=$timeend-$timestart;
 
//Afficher le temps d'éxecution
$page_load_time = number_format($time, 3);
echo "Debut du script: ".date("H:i:s", $timestart);
echo "<br>Fin du script: ".date("H:i:s", $timeend);
echo "<br>Script execute en " . $page_load_time . " sec";


////////////////////////////////fonction d'arrondissement//////////////////////////////////////////////////////////////////////////////
////////////////////////////////***********************//////////////////////////*************************************************////////////////
function arrondi($minute,$round){
	$ajust=ceil($minute);
	$res=$ajust%$round;
	if($res!=0){
		$moins=5-$res;
		$resultat=$ajust+$moins;
		echo "RESULTAT: ".$resultat."</br>";
		if($resultat==5){
			return 05;
		}
		return $resultat;
	}
	else{
		if($minute==5){
			return 05;
		}
		return $minute;
	}
}
?>

