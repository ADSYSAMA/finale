 <?php
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
    $site=$_GET['site'];
    $sql = "SELECT * FROM `base` WHERE `SITE_CLIENT` LIKE '".$site."'"; 
    $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    
    $data = mysqli_fetch_assoc($req);
    $ID=$data['ID'];
    $ville=$data['VILLE'];
    $codepostal=$data['CODE_POSTAL']; 
    $adresse=$data['ADRESSE'];
    $nom=$data['SITE_CLIENT'];
    $type=$data['SECTEUR']; 
    $lng=$data['LONGITUDE']; 
    $lat=$data['LATITUDE'];
    $type=$data['TYPE_DE_SITE'];
    $secteur=$data['SECTEUR'];
    $techniciens=$data['TECHNICIEN'];
    $techniciens=str_replace(' ',"\n",$techniciens);
    $techniciens=str_replace('_',' ',$techniciens);
    $texte=str_replace(' / ','/',$nom);
    $autreadresse=str_replace('+',' ',$adresse);
    $autreville=str_replace('+',' ',$ville);
    $autreadresse=$autreadresse."+".$codepostal."+".$autreville;

    $minisql = "SELECT DISTINCT zone.Zone FROM base, zone WHERE zone.ID=base.SECTEUR AND zone.ID = $secteur";
    $minireq = mysqli_query($GLOBALS["___mysqli_ston"], $minisql);
    $minidata = mysqli_fetch_assoc($minireq);
    $usei = $minidata['Zone'];
    $usei=str_replace('_',' ',$usei);
    echo'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <!-- TemplateBeginEditable name="doctitle" -->
        <title>'.$texte.'</title>
        <!-- TemplateEndEditable -->
        <!-- TemplateBeginEditable name="head" -->
        <!-- TemplateEndEditable -->
        <link rel="shortcut icon" href="../../img/mini_orange.jpg">
        </head>
        <body>
        <table><tr><th id="info" width="200" height="200"><pre>Nom : '.$nom.'</br></br>Adresse : '.$adresse.'</br>'.$codepostal.' '.$ville.'</br></br>USEI : '.$usei.'</br></br>Type de site: '.$type.'</br></br>Technicien(s):</br>'.$techniciens.'</pre></th>
        <th id="carte"width="1100" height="600" style="position:relative;"><iframe width="100%" height="560" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q='.$autreadresse.'&amp;aq=&amp;sll=46.75984,1.738281&amp;sspn=12.029122,19.753418&amp;ie=UTF8&amp;hq=&amp;hnear='.$autreadresse.'&amp;t=h&amp;z=14&amp;ll='.$lat.','.$lng.'&amp;output=embed"></iframe><br /><a href="http://maps.google.fr/maps?f=q&amp;source=embed&amp;hl=fr&amp;geocode=&amp;q='.$autreadresse.'&amp;aq=&amp;sll=46.75984,1.738281&amp;sspn=12.029122,19.753418&amp;ie=UTF8&amp;hq=&amp;hnear='.$autreadresse.'&amp;t=h&amp;z=14&amp;ll='.$lat.','.$lng.'" style="color:#0000FF;text-align:left">Plus d\'informations</a></th></tr></table></body>';
?> 
