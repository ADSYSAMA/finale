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
		if($("#plaque :selected").text()=="Sélectionner une plaque"){
			$("#plaque_verif").html("Sélectionner une plaque est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#plaque_verif").empty();
		}

		if($("#NewValeur").val()==""){
			$("#NewValeur_verif").html("Entrer le nouveau nom d'une plaque est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#NewValeur_verif").empty();
		}
	}
</script>


 <?php
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");    
    $sql="SELECT Zone FROM zone;";
    $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $a=0;
    echo('</br></br></br></br><center><h1><strong style="color:white;">Modifier une plaque</strong></h1></center>
        <form id="MonFormulaire" method="post" action="ModifPlaque.php" onsubmit="valider(event);">
        <table style="position:relative;top:-50px;display:inline;border-collapse: separate;margin-left: auto; margin-right: auto;border-spacing: 20px; margin-top: 0"><tr><td>
        <p>
        <label for="plaque">Sélectionnez la plaque à modifier</label><br /><br />
        <select name="plaque" id="plaque"><option>Sélectionner une plaque</option>');
    while($data = mysqli_fetch_assoc($req)){
        echo('<option value='.$data["Zone"].'>'.$data["Zone"].'</option>');
        $a++;
    }
    echo "</select>
    <br/>
    <div id='plaque_verif'></div>
    <br/>";
?>

<p>Entrez le nouveau nom de la plaque : <input name="NewValeur" placeholder="Ex : Paris Nord Est" id="NewValeur"/>
<br/>
<div id="NewValeur_verif"></div>
<br/>
</p>

<p>Modifier l'USEI dans lequel la plaque apparaît (si vous le souhaitez): </p>
 <?php
    $sql1="SELECT USEI FROM usei;";
    $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);    
    echo "<select name='usei' id='usei'> <option value='Selectionner'>Sélectionner l'USEI</option>";
    while($usei=mysqli_fetch_assoc($req1)){
        echo('<option value='.$usei["USEI"].'>'.$usei["USEI"].'</option>');
        $a++;
    }
    echo "</select>
    </td>
    <td>";

    $sql2 = "SELECT Zone,UrlImageLegende FROM zone;";
    $req2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
    $saut=-1;
    echo"<table style=' border-collapse: separate;margin-left: auto; margin-right: auto;border-spacing: 20px; margin-top: 0'><h4> <font color=white>";
    while($zone = mysqli_fetch_assoc($req2))
    {
        $saut++;
        if($zone['Zone'] != "USEI_EST" && $zone['Zone'] != "USEI_OUEST" && $zone['Zone'] != "SANS_ZONE")
        {
            if($saut % 3 == 0)
            {
                echo"</tr><tr>";
            }
        echo ('<td>  '.$zone['Zone'].' : <td><img src='.$zone['UrlImageLegende'].'> </td>');
        }
        
    }
    echo"</tr></table></td></tr></table>";

?> 
<center><input type="submit" value="Modifier"></center>
</form>

 <?php
    // Connexion à la base de données
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }
    if(isset($_POST['plaque']) && isset($_POST['NewValeur'])){ // Si les champs plaque et NewValeur existe ...
        $plaque = $_POST['plaque'];
        $usei1 = $_POST['usei'];

        $reponse = $bdd->query("SELECT ID FROM usei WHERE USEI = '$usei1'");
        while ($donnees = $reponse->fetch()) {
            $useiID = $donnees['ID'];
        }

        if($usei1!='Selectionner'){ // Si la selection est différent de la valeur "Selectionner"....
            $sql1="UPDATE zone SET USEI='$useiID' WHERE Zone='$plaque';"; //Modif dans la table "Zone"...
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
        }

        if(!empty($_POST['NewValeur'])){ // Si le champs "NewValeur" n'est pas vide ...
            $NewNom=strtoupper(str_replace(' ','_',$_POST['NewValeur']));
            $sql2="UPDATE zone SET Zone='$NewNom' WHERE Zone='$plaque';"; // Modification de la "Zone" dans la table "zone"...
            $req2 = mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
        }
            
        // on vérifie quelle requête à été effectué
        if(isset($req2) && isset($req1)){ 
            echo "<script type=\"text/javascript\"> alert(\"Le nom de la plaque et son USEI ont été modifiés\");
            document.location.replace('ModifPlaque.php');
			</script>";
        }
        else if(isset($req2)){ 
            echo "<script type=\"text/javascript\"> alert(\"Le nom de la plaque à été modifié\");
			document.location.replace('ModifPlaque.php');
			</script>";
        }
        else if(isset($req1)){
            echo "<script type=\"text/javascript\"> alert(\"L'USEI de la plaque à été modifiée\");
           document.location.replace('ModifPlaque.php');
			</script>";;
        }
        else{
            echo "<script type=\"text/javascript\"> alert(\"Une erreur est survenue\");</script>";
        }
    }
    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
        
?> 
