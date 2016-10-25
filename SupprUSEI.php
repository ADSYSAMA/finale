<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			alert('Vous n\'êtes pas autorisé à acceder à cette page, vous allez être redirigé après avoir validé cette boite de dialogue');
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
		if($("#USEI :selected").text()=="Sélectionner un USEI"){
			$("#USEI_verif").html("Sélectionner un USEI est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#USEI_verif").empty();
		}
	}
</script>

 <?php
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
    $sql = 'SELECT USEI FROM usei'; 
    $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $a=0;
    echo('<form id="MonFormulaire" name="form" method="post" onsubmit="valider(event);" action="SupprUSEI.php"">
        </br>  
        <p>

        <center><h1><strong style="color:white;">Supprimer un UOPT</strong></h1></center></br></br>
            <label for="USEI">Selectionnez l\'USEI</label><br />
            <select name="USEI" id="USEI">');
                echo('<option value="Selectionnez">Sélectionner un USEI</option>');
                while($data = mysqli_fetch_assoc($req)){
                    $USEI[$a]=$data['USEI'];
                    echo('<option value='.$data['USEI'].'>'.str_replace('_', ' ', $data['USEI']).'</option>');
                    $a++;
                }
            echo'</select><br/><div id="USEI_verif"></div>';
        echo '<br/><input type="submit" value="Envoyer" />
    </form>';
    ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);

    if((isset($_POST['USEI']))&&(!empty($_POST['USEI']))&&($_POST['USEI']!="Selectionnez")){
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $usei=str_replace(" ","_",$_POST['USEI']);
        echo"<script type='text/javascript'>alert($usei);</script>";
        $sql0="SELECT zone.USEI FROM usei, zone WHERE usei.ID = zone.USEI AND usei.USEI ='$usei'";    //Selection des USEI correspondant à l'USEI que l'utilisateur veut supprimer
        $req0=mysqli_query($GLOBALS["___mysqli_ston"], $sql0);
        $num_rows = mysqli_num_rows($req0); //permet de récupérer le nombre de lignes obtenus par la requète précèdente
        if($num_rows==0){//S'il n'y a aucun ligne de retour de la requète précèdente, on peut supprimer dans les tables menu et usei
            $sql="DELETE FROM usei WHERE USEI='$usei'"; //Suppression dans la table usei de l'USEI '$usei'
            $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
            if($req==true){
                echo "<script type='text/javascript'>alert('Suppression effectuée');
				document.location.replace('SupprUSEI.php');
				</script>";
               
            }        
        }
        else{ // S'il n'y en a pas, on informe l'utilisateur qu'il reste des plaques affectées à cet USEI
            echo "<script type='text/javascript'>alert('Vous ne pouvez pas supprimer l\'USEI car des plaques lui sont liées.');</script>";
        }    
        ((is_null($___mysqli_res = mysqli_close($GLOBALS["___mysqli_ston"]))) ? false : $___mysqli_res);
    }
?>
