<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			document.location.replace('login.php');
			</script>";
		//header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
		die();
	}
?>

	<script type="text/javascript">

		var ie = (function(){
			var undef, v = 3, div = document.createElement('div');
			while (
				div.innerHTML = '<!--[if gt IE '+(++v)+']><i></i><![endif]-->',
				div.getElementsByTagName('i')[0]
		    	);
			return v> 4 ? v : undef;
		}());

		function valider(e) {
			if($("#tecn :selected").text()=="Sélectionner un technicien"){
				$("#first").html("Sélectionner un technicien est obligatoire pour continuer.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				$("#first").empty();
			}

			if($("#Sites :selected").text()=="Sélectionner un site"){
				$("#sec").html("Sélectionner un site est obligatoire pour continuer.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				$("#sec").empty();
			}
		}
	</script>

</head>
<body>
	</br>
	 <?php
        if(empty($_POST['tecn'])){
            $a=0;
            ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
            $sqlt = 'SELECT ID, Technicien, Tel, Mail, Site FROM technicien';
            $reqt = mysqli_query($GLOBALS["___mysqli_ston"], $sqlt);
            echo('<form id="MonFormulaire" method="post" action="Ajoutertech.php" onsubmit="valider(event);">
                   <p>
        <label for="tecn">Choisir technicien</label><br />
        <select name="tecn" id="tecn"><option>Sélectionner un technicien</option>');
while($datat = mysqli_fetch_assoc($reqt)) 
    {
        $Technicien=$datat['Technicien'];
        $Technicien2=str_replace('_',' ',$Technicien);
        echo('<option value='.$Technicien.'>'.$Technicien2.'</option>');
    }
echo('</select><br/><div id="first"></div>
</br>');
($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
$sqls = 'SELECT ID, SITE_CLIENT, SECTEUR FROM base ORDER BY SITE_CLIENT'; 
$reqs = mysqli_query($GLOBALS["___mysqli_ston"], $sqls);
echo('
   <p>
        <label for="Sites">Assigner au Site</label><br />
        <select name="Sites" id="Sites"><option>Sélectionner un site</option>');
while($datas = mysqli_fetch_assoc($reqs)) 
    {
        $type=$datas['SECTEUR'];
        $Nom=$datas['SITE_CLIENT'];
        $Nom=str_replace(' ','_',$Nom);
        echo('<option value='.$Nom.'>'.$datas['SITE_CLIENT'].'</option>');
        $a++;
    }
echo('</select><br/><div id="sec"></div>
</br></br>
<input type="submit" value="Envoyer" />
</form>
');
}

if(isset($_POST['tecn']))
{
    $a = 0;
    $Tech=$_POST['tecn'];
    $tech=str_replace('_', ' ', $Tech);
    $Sites=str_replace('_', ' ', $_POST['Sites']);
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
    $techniciensql = "UPDATE technicien SET Site = '$Sites' WHERE Technicien = '$Tech'";
    $technicienreq = mysqli_query($GLOBALS["___mysqli_ston"], $techniciensql);

    $sql = "SELECT TECHNICIEN FROM base WHERE SITE_CLIENT = '$Sites'";
    $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    while($data = mysqli_fetch_assoc($req))
    {
        $techn[$a] = $data['TECHNICIEN'];
        $a++;
    }
    if ($techn[0] != '')
    {
        $Techn = implode(' ', $techn);
        $Techn .= $Tech;
    }
    else
    {
        $Techn = implode(' ', $techn);
        $Techn = $Tech;
    }
    $techniciensql = "UPDATE base SET TECHNICIEN = '$Techn' WHERE SITE_CLIENT = '$Sites'";
    //print_r($techniciensql);
    $technicienreq = mysqli_query($GLOBALS["___mysqli_ston"], $techniciensql);
    if ($technicienreq == true)
    {
        echo "<script type='text/javascript'>
        alert('Le technicien $tech a bien été ajouté au site $Sites');
        document.location.replace('Ajoutertech.php');
        </script>";
    }
}

?> 
</body>
</html>
