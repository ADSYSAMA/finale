<?php require('menuRecup.php'); ?>

<body>

	<div id="conteneur" style="display:block;background-color:#F0F0F0; position:relative; top:200px; left:5%; margin-right:5%; height:50px; width:90%;border:2px solid #EEEEEE;">
		<div id="barre" style="display:block; height:100%;color:#000000;border:2px solid #EEEEEE;">
			<div id="pourcentage" style="text-align:center; height:100%; font-size:1.8em;background-color:#7FFF00;">
				&nbsp;
			</div>
		</div>

	</div>
</body>
</html>
	<?php
	if (session_status() == null) {
	session_start();
}
// VOIR PHP_XLSXWriter
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//                      					Récupération de l'ID de l'URL                                            //
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	if (isset ($_GET['id']) and trim($_GET['id'])!="")
	{
		$id=$_GET['id'];   
	}

	echo "<script>";
	echo "document.getElementById('conteneur').style.display = \"block\";";
	echo "</script>";


// Timer permettant de connaître le temps d'exécution d'une page web
// Début timer
	$timestart=microtime(true);
	ini_set('max_execution_time',99999999);
	ini_set('memory_limit', '-1');

	

	require_once('connexion.php');

	//Met à jour l'indice dans l'HTML
	function progression($indice)
	{	
		echo "<script>";
		echo "document.getElementById('pourcentage').innerHTML='$indice%';";
		echo "document.getElementById('barre').style.width='$indice%';";
		echo "</script>";
		
		forceFlush();
	}
	
	function dummyErrorHandler ($errno, $errstr, $errfile, $errline) {
	} 
	
	//Fonction permettant de forcer la page web à actualiser l'aaffichage en temps réel.
	function forceFlush() {   
		ob_start();
		ob_end_clean();
		flush();
		set_error_handler("dummyErrorHandler");
		ob_end_flush();
		restore_error_handler();
	} 
	date_default_timezone_set('Europe/Paris');

	$condition="";

	//Récupération des éléments nécessaires dans la BDD pour le calcul du distancier.
//$req1 = "select ID,Longitude,Latitude,Adresse, CODE_POSTAL from distancier where CODE_POSTAL :condition";
	$req1bis = "select ID,Longitude,Latitude,Adresse,CODE_POSTAL from base where CODE_POSTAL REGEXP :condition";
	$req1 = "select ID,Longitude,Latitude,Adresse, CODE_POSTAL from base where CODE_POSTAL LIKE :condition";
	$req2 = "select base.ID,Longitude,Latitude,Adresse,Zone from base inner join zone on zone.ID = base.SECTEUR where zone = :condition";
	//$req2bis = ""select ID,Longitude,Latitude,Adresse, ZONE from distancier where ZONE IN ($condition)"";
	$req3 = "select base.ID,Longitude,Latitude,Adresse,usei.USEI from base inner join zone on base.SECTEUR=zone.ID inner join usei on zone.USEI=usei.ID where usei.USEI = :condition";

	$cond="";
	$req2bis="";


 

	switch ($_POST['modele']) {
		case "zone":
		$requete=$req2;
		$condition=$_POST['zone'];
		break;
		case "entreZone":
		
		$array = array();

		$i=0;
		while($i!=$_POST['nombrePlaque']){
			if (isset($_POST['liste'.$i]))
			{
				$valeur="'".$_POST['liste'.$i]."'";
				$array[]=$valeur;
				$cond.=$_POST['liste'.$i];
				if($i!=$_POST['nombrePlaque']-1)
				$cond.='_';
			}
			$i++;
		}
		
		for($i=0;$i<$_POST['nombrePlaque'];$i++){
		$placeholders ="".implode(',', $array);
		}

		$condition=$placeholders;
		//Selectionner toutes les zones choisis dans le formulaire pour le calcul du distancier.
		$req2bis = "select base.ID,Longitude,Latitude,Adresse,Zone from base inner join zone on zone.ID = base.SECTEUR where zone IN ($condition)";
		$requete= $req2bis;	
		break;

		//Changer la requete et la condition en fonction du modèle choisis (zone, entre-zone, paris , uopt, france)
		case "paris":
		$requete=$req1;
		$condition="75%";
		break;
		case "uopt":
		$requete=$req3;
		$condition=$_POST['uopt'];
		break;
		case "france":
		$requete=$req1bis;
		$condition="([01-95]{5})";
		break;
	}

	$reponse1 = $db->prepare($requete);
	$reponse1->bindParam(':condition',$condition);
	$champs = count($reponse1);
	$reponse1->execute();
	//echo $champs;

	$longitude = array();
	$latitude = array();
	$id = array();
	$adresse = array();


	while ($resultat=$reponse1->fetch(PDO::FETCH_ASSOC))
	{

		array_push($id,$resultat['ID']);
		array_push($adresse,$resultat['Adresse']);
		array_push($latitude,(String)$resultat['Latitude']);
		array_push($longitude,(String)$resultat['Longitude']);	

			//get_coordonees_from_adresse($resultat['ADRESSE'].' '.$resultat['CODE_POSTAL'].' '.$resultat['VILLE']);


	}
	

	$lieux = array();

	//Récupération des éléments nécessaires dans la BDD pour le calcul du distancier.
	for($i=0;$i<count($id);$i++){

		$req2 = "select SITE_CLIENT from base where ID=".$id[$i]."";
		$reponse2 = $db->query($req2);
		$champs = count($reponse2);
		//echo $champs;


		while ($resultat=$reponse2->fetch(PDO::FETCH_ASSOC))
		{
			array_push($lieux,$resultat['SITE_CLIENT']);


				//get_coordonees_from_adresse($resultat['ADRESSE'].' '.$resultat['CODE_POSTAL'].' '.$resultat['VILLE']);


		}	

		//print_r($lieux);
	}
	//var_dump($lieux);

/*
	
}*/
function foo($seconds) {

	$t = round($seconds);
	return sprintf('%02d:%02d', ($t/3600),($t/60%60));
}
	//Fonction retournant le temps de parcours entre deux points.
function getDistance($adresse1,$adresse2,$db,$condition) {

	$pointA="Select Latitude,Longitude,Secteur from base where Adresse= :adresse";
	$req = $db->prepare($pointA);
	$req->bindValue(':adresse',$adresse1);
	$req->execute();

	$arr= $req->fetch(PDO::FETCH_ASSOC);

	$pointB="Select Latitude,Longitude,Secteur from base where Adresse= :adresse2";
	$req2 = $db->prepare($pointB);
	$req2->bindValue(':adresse2',$adresse2);
	$req2->execute();

	$arr2= $req2->fetch(PDO::FETCH_ASSOC);

		

	$distance=acos(sin(deg2rad($arr['Latitude']))*sin(deg2rad($arr2['Latitude']))+cos(deg2rad($arr['Latitude']))*cos(deg2rad($arr2['Latitude']))*cos(deg2rad($arr2['Longitude']-$arr['Longitude'])))*6378137;


		// $vitesse=$_POST['vitesse'];



		// $nb=$distance/100;	//distance de 100km
		// if($nb>0.34 and $nb<2){ // si le nombre de distance de 100km est compris entre 0,34 et 2 (nombre déterminé pour avoir des valeurs rationelle), on traite la vitesse de manière à avoir des distances sensiblement les mêmes que ceux de Google Map
		// $vitesse*($nb*3);
		// }

		$distance=$distance/1000;//(arrondis +3km car la route n'est pas en ligne droite)
	
	if($_POST['modele']=="entreZone"){
		
		$zoneIdf=[15,18,17,21];
		$zoneParis=[13,11,12,14,16];
		$zoneHorsParis=[19,20,50,55];

		foreach($zoneIdf as $k => $v){

			if ($v==$arr['Secteur']) 
    			$z="idf";		
    		if ($v==$arr2['Secteur']) 
    			$z2="idf";
    	}

    	foreach($zoneParis as $k => $v){

			if ($v==$arr['Secteur']) 
    			$z="paris";		
    		if ($v==$arr2['Secteur']) 
    			$z2="paris";
    	}

    	foreach($zoneHorsParis as $k => $v){

			if ($v==$arr['Secteur']) 
    			$z="horsParis";		
    		if ($v==$arr2['Secteur']) 
    			$z2="horsParis";
    	}	
		
		switch($z){

			case "idf": switch($z2){

							case "idf": $vitesse=30;
										break;

							case "paris": $vitesse= 20;
										break;

							case "horsParis": $vitesse= 70;
										break;

							default: $vitesse=$_POST['vitesse'];
						}

			default: $vitesse=$_POST['vitesse'];

			case "paris": switch($z2){

							case "idf": $vitesse= 30;
										break;

							case "paris": $vitesse=16;
										break;

							case "horsParis": $vitesse=50;
										break;

							default: $vitesse=$_POST['vitesse'];
						}

			default: $vitesse=$_POST['vitesse'];

			case "horsParis": switch($z2){

							case "idf": $vitesse=70;
										break;

							case "paris": $vitesse=50;
										break;

							case "horsParis": $vitesse=80;
										break;

							default: $vitesse=$_POST['vitesse'];
						}


			default: $vitesse=$_POST['vitesse'];
		}
		
		}

		
		$duree=($distance/$vitesse)*3600; // la duree est en seconde
	
		if($duree<900){
		return "00:15";

	}else{

		//$duree= foo($duree);
		$duree1= arrondi(($duree/60),5);
		$duree2=foo($duree1*60);
		
		return $duree2;
	}


}
// Initialisation du fichier Excel (création + graphisme)

	include 'PHPExcel.php';
	include 'PHPExcel/Writer/Excel2007.php';

	
	// $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_phpTemp;
	// $cacheSettings = array( ' memoryCacheSize '  => '2048MB'
 //                      );
	// PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

	$workbook = new PHPExcel; 

	$sheet = $workbook->getActiveSheet();

	

	$column = 'A';		
	$sheet->getColumnDimension($column)->setWidth(50);

	for ($j = 1; $j <= count($id)+1; $j++) {
		for ($l = 1; $l <= 1; $l++) {
			$sheet->getStyle($column.$l)->getAlignment()->setTextRotation(60);
			$column++;
		}
	}



	$column = 'A';

	for ($l = 2; $l < count($id)+2; $l++) {

		$sheet->setCellValue($column.$l,$lieux[$l-2]);
		$sheet->getStyle($column.$l)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	}

	$column = 'B';
	for ($j = 2; $j < count($id)+2; $j++) {
		for ($l = 1; $l <= 1; $l++) {
			$sheet->setCellValue($column.$l,$lieux[$j-2]);
			$sheet->getStyle($column.$l)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$column++;
		}
	}
	
	//Création de deux tableaux (1er: Contenir les valeurs des cases , 2ème: Contient les chiffres 1/2/3/4/... pour servir à remplir que
	//la partie diagonale suppérieure du tableau Excel)
	
	$tab=array();
	
	for ($i=0;$i<count($id);$i++){
		$tab[$i]=array();
	}
	$instanciation=0;
	$tabInstanciation = array();
	for ($j=0;$j<count($id);$j++){
		array_push($tabInstanciation,$instanciation);
		$instanciation++;
	}
	
	for ($i=0;$i<count($id);$i++){
		for ($j=0;$j< count($id);$j++){
			array_push($tab[$i],null);
		}
			//echo '<pre>';
			//var_dump($tab[$i]);
			//echo '</pre>';
	}
	
	
	echo "<script>";
	echo "function vide() {";
	echo "	}";
	echo "</script>";
	
	
	//Boucle générale réunnissant les fonctions principales (calcul distancier + remplissage cases)	
	for ($i=0;$i<count($id);$i++){
		$interRemplissage=0;
		//$indice = round((($i+1)*100) / count($id));
		//progression($indice);
		//echo $i." ";
		for ($j=0;$j<count($id);$j++){
			if($i==(count($id)-1)){
				$indice = round((($i+1)*100) / count($id));
			}
			else{
				$indice = (round((($i+1)*100) / count($id))+round(((($j+1)*100)/count($id))/count($id)))-1;
			}
			progression($indice);
			if(in_array($interRemplissage,$tabInstanciation)){

				$res=getDistance($adresse[$i],$adresse[$j],$db,$condition);



				$tab[$i][$j]=$res;

			}
			$interRemplissage++;
		}
			//echo "Inter: ".$i;
		unset($tabInstanciation[$i]);
			//echo'<pre>';
			//var_dump($tab[$i]);
			//echo'</pre>';			
	}
	
	
	$indice=0;
	
	//Contient les lettres B/C/D/E/... pour servir à remplir seulement la diagonale du tableau Excel
	$colonneDep = 'B';
	$tabDep = array();
	for ($j=0;$j<count($id);$j++){
		array_push($tabDep,$colonneDep);
		$colonneDep++;
	}
	//var_dump($tabDep);
	//echo $colonneDep;
	
	for ($i=2;$i<count($id)+2;$i++){
		$column = 'B';
		for ($j=2;$j<count($id)+2;$j++){
			if(in_array($column,$tabDep)){
				if($column==$tabDep[$i-2]){
					$sheet->setCellValue($column.$i,'00:00');
				}
				else{
					$sheet->setCellValue($column.$i, $tab[$i-2][$j-2]);
				}
			}
			$sheet->getStyle($column.$i)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$column++;	
		}
		//echo "I:".($i-2)." Valeur: ".$tabDep[$i-2]."</br>";
		unset($tabDep[$i-2]);
	}
	
	$indice=0;
	
	//Suite initialisation graphisme du tableau Excel
	for ($i=2;$i<count($id)+2;$i++){
		$column = 'A';
		for ($j=2;$j<count($id)+3;$j++){

			if ($indice % 2 == 0){
				//echo $indice;
				$sheet->getStyle($column.$i)->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('F2F2F2');
				
			}
			$column++;
		}
		$indice++;		
		
		

	}


//Écriture/Sauvegarde dans le fichier "Distancier.xls"
	$writer = new PHPExcel_Writer_Excel2007($workbook);
	$writer->setPreCalculateFormulas(false);

	$date = date("d-m-Y");
	$heure = date("H-i");

	$datexls = date('['.$date.'('.$heure.')]');

	if($requete=$req2bis)
	$nomxls3 = 'Distancier'.$datexls.'{'.$cond.'}.xlsx';
	else
	$nomxls3 = 'Distancier'.$datexls.'{'.$condition.'}.xlsx';

	$records = $nomxls3;

	$writer->save($records);
?>
	<script>
	alert("Votre fichier vient d'être chargé appuyer sur le bouton download");
	var src='<?php echo $records; ?>';	
	$('#pourcentage').append('<br><br><a href='+src+' download="distancier" style="position:relative;color:black;"><img src="download.png" alt="download" height="100" width="200"/></a>');
	</script>
<?php
// Fin Timer
	$timeend=microtime(true);
	$time=$timeend-$timestart;

//Afficher le temps d'éxecution
	$page_load_time = number_format($time, 3);
//echo "Debut du script: ".date("H:i:s", $timestart);
//echo "<br>Fin du script: ".date("H:i:s", $timeend);
//echo "<br>Script execute en " . $page_load_time . " sec";

// Fonction qui permet d'arrondir le résultat du distancier au 5 supérieur.
	function arrondi($minute,$round){
		$ajust=ceil($minute);
		$res=$ajust%$round;
	if($res!=0 || $res==0){

			$moins=5-$res;
			$resultat=$ajust+$moins;

		if($resultat==5 ){

				return "05";
			}
			else{
				return $resultat;
			}
		}
		else if($res <0){
			return "00:15";
		}
		else{
			return $minute;
		}
	}

// Redirection automatique vers index.php (page principale) à la fin du script
//echo "<script type='text/javascript'>document.location.replace('../../index.php');</script>";

	?>
