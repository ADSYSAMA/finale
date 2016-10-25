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
//______________________________________________________________________________
	function valider(e) 
    {
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

	}

//______________________________________________________________________________
    
function CocheTout(ref, name) //fonction pour cocher tout les checkbox
    {
	var form = ref;
 
	while (form.parentNode && form.nodeName.toLowerCase() != 'form'){ 
		form = form.parentNode; 
	}
 
	var elements = form.getElementsByTagName('input');
 
	for (var i = 0; i < elements.length; i++) {
		if (elements[i].type == 'checkbox' && elements[i].name == name) {
			elements[i].checked = ref.checked;
		}
	}
}
    
</script>


 <?php

    try
    {
        // Connexion à MySQL
        $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e)
    {
        // En cas d'erreur, on affiche un message et on arrête tout
        echo "une erreur est survenue";
        die('Erreur : '.$e->getMessage());
    }
    $req = "SELECT * FROM base WHERE SECTEUR='50'";
    $reponse = $bdd->query($req);		
    $a=0;
    $res = $reponse -> fetchAll();
    
    if(count($res) == 0)
    {
        echo "<h4><center><font color='white'>Aucun site sans zone";
    }
    else
    {
        $req = "SELECT * FROM zone";
        $reponse  = $bdd->query($req);
        echo('<form id="MonFormulaire" method="post" action="ModifSansZone.php" onsubmit="valider(event);"><br />
        <p>
        <label for="plaque">Sélectionnez la plaque de destination</label><br />
        <select name="plaque" id="plaque"><option>Sélectionner une plaque</option>');
        while($data = $reponse ->fetch())
        {
            echo('<option value='.$data["ID"].'>'.$data["Zone"].'</option>');
            $tabNom_Agence_Niv2[$a] = $data["NOM_AGENCE_NIV2"];
            $tabZoneID[$a] = $data["ID"];
            $a++;
        }
        echo "</select>
        <br/>
        <div id='plaque_verif'></div>
        <br/>";
        
        
        $req = "SELECT * FROM base WHERE SECTEUR='50'";
        $reponse = $bdd->query($req);		
        $a=0;

        echo("<h4><input type='checkbox' onclick=CocheTout(this,'CheckboxBase[]') id='CheckboxCocheTout'>Bases </h4><br>");
        while ($data = $reponse -> fetch())
        {
            echo('<input type=checkbox value='.str_replace(' ','_',$data["SITE_CLIENT"]).' name="CheckboxBase[]"
            id='.$a.'>'.$data["SITE_CLIENT"].'<br>');
            $a++;
        }
        
        
    $req2 = "SELECT Zone,UrlImageLegende FROM zone";
    $reponse = $bdd->query($req2);
    $saut=-1;
    echo"<table> <tr> <td></td> <td></td> <td> <h4> <font color=white><u>LEGENDE :</u></h4></td> </td> <td></td> <td> </td> <td> </tr>  <tr>";
    while($zone = $reponse ->fetch())
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
    echo"</tr></table>";
    echo"<br>";
        
        
        echo("<input type='submit' name='ok' value='Modifier'>");
    }
    


//    $sql="SELECT * FROM base WHERE SECTEUR='50';";
   // $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);


    

    
?>





</form>



 <?php
    // Connexion à la base de données
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
    }
    catch(Exception $e){
        die('Erreur : '.$e->getMessage());
    }

    if(isset($_POST['ok']))//Lorsqu'on clique sur le bouton SUBMIT
    {
        if(isset($_POST['CheckboxBase']))
        {
          foreach($_POST['CheckboxBase'] as $valeur) //Pour chaque checkbox cochée
            {
               $site_client = str_replace('_',' ',$valeur); //On remplace les _ par des espaces car dans la BDD c'est des espaces
               $secteur = $_POST['plaque']; //Récupération de l'ID de la plaque

              // $sql1="UPDATE base SET SECTEUR='$secteur' WHERE SITE_CLIENT='$site_client'";
              //  $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
                $a = 0;
                foreach($tabZoneID as $element)
                {
                    if($secteur == $tabZoneID[$a])
                    {
                        $sql2 = "UPDATE activiteplaque3 SET NOM_AGENCE_NIV2 ='$tabNom_Agence_Niv2[$a]' WHERE CODESITE='$site_client'";
                        $bdd -> exec($sql2);
                        $sql = "UPDATE base SET SECTEUR='$secteur' WHERE SITE_CLIENT='$site_client'";
                        $bdd -> exec($sql);

                    }
                    $a++;
                }

                echo ("<script type=\"text/javascript\"> alert(\"Les sites on été assignés\");
                document.location.replace('index.php');
                </script>");
            }
        }
        else
        {
            echo ("<script type=\"text/javascript\"> alert(\"Il n'y a pas de site sans zone\");
			document.location.replace('index.php');
            </script>");
        }
    }

 
?> 
