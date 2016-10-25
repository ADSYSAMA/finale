<?php

require('config.php');
require('connexion.php');
	
 $reqVar = "SELECT Zone,ID,Couleur,UrlImageA,UrlImageBo,UrlImageS,UrlImageBi,UrlImageLegende,NOM_AGENCE_NIV2,UrlImagePdl,UrlImagePdp,UrlImagePde from zone";
 $reponse = $db -> query($reqVar);
 $tuple = $reponse -> fetchAll(PDO::FETCH_NUM);
//print_r($tuple);
 echo json_encode($tuple);
 
 ?>
