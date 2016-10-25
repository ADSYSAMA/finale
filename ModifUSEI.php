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
		if($("#usei :selected").text()=="Sélectionner un USEI"){
			$("#usei_verif").html("Sélectionner un USEI est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}

		}
		else{
			$("#usei_verif").empty();
		}

		if($("#NewValeur").val()==""){
			$("#NewValeur_verif").html("Entrer le nouveau nom d'un USEI est obligatoire.").css({color:"red"});
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
    $sql="SELECT USEI FROM usei;";
    $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $a=0;
    echo('<form id="MonFormulaire" method="post" action="ModifUSEI.php" onsubmit="valider(event);"><br />
        <p>
        <center><h1><strong style="color:white;">Modifier un UOPT</strong></h1></center></br></br>
        <label for="usei">Sélectionnez l\'USEI à modifier</label><br /><br />
        <select name="usei" id="usei"><option>Sélectionner un USEI</option>');
    while($data = mysqli_fetch_assoc($req)){
        $type[$a]=$data['USEI'];
        echo('<option value='.$data["USEI"].'>'.$data["USEI"].'</option>');
        $a++;
    }
    echo'</select>
    <br/>
    <div id="usei_verif"></div>
    <br/><br/>';
    ?>
    Entrez le nouveau nom de l'USEI : <input name="NewValeur" id="NewValeur"></input>
    <br/><br/>
    <div id="NewValeur_verif"></div>
    <br/><br/>
    <input type="submit" value="Envoyer">
    </form>
    
    <?php
        if((isset($_POST['usei'])) &&(isset($_POST['NewValeur']))) {
            $usei=$_POST['usei'];
            $USEI=str_replace(' ','_',$usei);
            $USEI_techn=substr($usei, 5);
            $NewNom=strtoupper($_POST['NewValeur']);
            $sql1="UPDATE usei SET USEI='USEI_$NewNom' WHERE USEI='$usei';"; //Modification dans la table usei du nom de l'USEI
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
            $sql2="UPDATE technicien SET USEI='$NewNom' WHERE USEI='$USEI_techn';"; //Modification dans la table usei du nom de l'USEI
            $req2=mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
            if($req1==true && $req2==true){ //Si la requète s'effectue, on en informe l'utilisateur...
                echo '<script type="text/javascript"> alert("Modification effectuée"); 
				 document.location.replace("ModifUSEI.php");</script>';

            }
            else {// ... également dans le cas contraire
                echo '<script type="text/javascript> alert("Il y a eu une erreur"); </script>"';
            }
        }
        else{
            echo '<script type="text/javascript> alert("Veuillez remplir le champs pour modifier le nom"); </script>"';
        }
    ?> 