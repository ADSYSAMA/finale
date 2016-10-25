<?php
    include_once("entete.html");
?>


<?php
set_time_limit(0);
function getDistance($adresse1,$adresse2) {
$url='http://maps.google.com/maps/api/directions/xml?language=fr&origin='.$adresse1.'&destination='.$adresse2.'&sensor=false';
// préparation CURL
$ch = curl_init();
// assignation des valeurs personnalisées
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 secondes de timeout
// lancer la bufferisation
ob_start();
// lancer l'execution
curl_exec($ch);
// obtenir les données du buffer
$file_content = ob_get_contents();
// fermer CURL
curl_close($ch);
// fermer le buffer
ob_end_clean();
$root = simplexml_load_string($file_content);
$duree=$root->route->leg->duration->value;
return $duree;
}
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

require('/Classes/PHPExcel.php');
$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Lin")
             ->setLastModifiedBy("Lin")
             ->setTitle("Distancier")
             ->setSubject("Distancier")
             ->setDescription("Distancier USEI")
             ->setKeywords("Distancier")
             ->setCategory("Distancier");
$Zone=$_POST['Zone'];
($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
$sql = "SELECT base.ID, SITE_CLIENT, base.SECTEUR, zone.Zone as ZONE FROM base, zone WHERE ZONE='$Zone' and secteur = zone.ID ORDER BY SITE_CLIENT"; 
$req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
$i = 2;
$j = 'B';
while($data = mysqli_fetch_assoc($req)) 
    {
        $Nom=$data['SITE_CLIENT'];
        $Nom=str_replace('_',' ',$Nom);
        $cel = 'A'.$i;
        $cel2 = $j.'1';
        $cel3 = $j.$i;
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue($cel2, $Nom) 
                ->setCellValue($cel, $Nom)
                ->setCellValue($cel3, '0');
        $i++;
        $j++;
    }
$sql2 = "SELECT base.ID, SITE_CLIENT, VILLE, CODE_POSTAL, ADRESSE, base.SECTEUR, zone.Zone as ZONE FROM base, zone WHERE ZONE='$Zone' AND secteur = zone.ID ORDER BY SITE_CLIENT"; 
$req2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
$i2 = 2;
$j2 = 'B';
$savej2 = $j2;
$save2j2 = $j2;
while($data2 = mysqli_fetch_assoc($req2)) 
    {
        $Adresse = $data2['ADRESSE'];
        $Adresse = str_replace(' ', '+', $Adresse);
        $Address1=$Adresse .'+'. $data2['CODE_POSTAL'];
        $sql3 = "SELECT base.ID, SITE_CLIENT, VILLE, CODE_POSTAL, ADRESSE, base.SECTEUR, zone.Zone as ZONE FROM base, zone WHERE ZONE='$Zone' AND secteur = zone.ID ORDER BY SITE_CLIENT"; 
        $req3 = mysqli_query($GLOBALS["___mysqli_ston"], $sql3);
        while($data3 = mysqli_fetch_assoc($req3)) 
        {
            $Adresse2 = $data3['ADRESSE'];
            $Adresse2 = str_replace(' ', '+', $Adresse2);
            $Address2=$Adresse2 .'+'. $data3['CODE_POSTAL'];
            if ($j2 >= $save2j2)
            {
                $info = getDistance($Address1, $Address2);
                $minutes=round(($info % 3600) / 60).":00";
                
                $cel4=$j2.$i2;
                $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue($cel4, $minutes);
                usleep(400000);
            }
            $j2++;
            }
        $i2++;
        $j2 = $savej2;
        $save2j2++;
    }

$objPHPExcel->getActiveSheet()->setTitle('Distancier');

$objPHPExcel->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=' . $Zone . '');
header('Cache-Control: max-age=0');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
$objWriter->save('php://output');

header("Refresh: 1;url=distancier.php");
?> 