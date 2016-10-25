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

<body>

	</br>

	<form id="MonFormulaire" method="post" action="AjouterZone.php" onsubmit="valider(event)">
	  <?php
            ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
            $sql = 'SELECT ID, USEI FROM usei';
            $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
            $a=0;
            echo(' <center><h1><strong style="color:white;">Ajouter une plaque</strong></h1></center></br></br>
            	<table  style="display:inline;border-collapse: separate;margin-left: auto; margin-right: auto;border-spacing: 20px; margin-top: 0"><tr><td>
                   <p>

       
                    <label for="USEI">Selectionner un USEI</label>

                    <br />

                    <select name="USEI" id="USEI">
            ');
            echo('<option value="Selectionner">Sélectionnez</option>');
            while($data = mysqli_fetch_assoc($req)){
                $USEI[$a]=$data['USEI'];
                echo('<option value='.$data['USEI'].'>'.str_replace('_', ' ', $data['USEI']).'</option>');
                $a++;
            }
            echo('</select>');

            echo('<br/>');

            echo('<div id="select"></div>');
        ?>

		<br/>

		<label for="zone">Entrez le nom de la nouvelle plaque :</label><br/>
		<input type="text" name="zone" id="zone" placeholder="Ex : Paris Nord Ouest" />
		
        <br/>
        <br/>
        <label for="zone">Entrez le nom de l'agence :</label><br/>
		<input type="text" name="agence" id="agence" placeholder="Ex : 75 ALLERAY" />
	
		<div id="text"></div>
		</td>
		<td>
		<br/><br/><br/>
		 <label for="zone">Choisissez la couleur :</label>

		
		<table><tr>
		
		<?php
	

     try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e)
	{
		echo "une erreur est survenue";
		die('Erreur : '.$e->getMessage());
	}
			$reqC=' SELECT UrlImageLegende, UrlImageA,CouleurInfo from couleurs';
			$reqC1 = $bdd -> query($reqC);
			$data=$reqC1->fetchAll(PDO::FETCH_NUM);
			//print_r($data);
			//echo(Count($data));
			$tr=0;
			for($i = 0 ; $i < COUNT($data); $i++) 
				{ 
				if( $tr%4==0 && $tr!=1 ){
					echo("</tr>");}
				echo (' <td style="padding: 5px;"><label><img src='.$data[$i][0].'><label><img src='.$data[$i][1].'> <input type="radio" name= couleur value='.$data[$i][2].' id='.$data[$i][2].' ></label></td>' );
				$tr++;
				if($tr%4==0&&$tr!=1 ){echo("<tr>");}	
			}
			echo("</table></tr></table>");
			
	?>

		<br><br><input type="submit" value="Envoyer" />
	</form>

	<script type="text/javascript">
		function valider(e) {
			if($("#USEI :selected").text()=="Sélectionnez"){
				$("#select").html("Sélectionner un USEI est obligatoire pour continuer.").css({color:"red"});
				e.preventDefault();
			}
			else{
				$("#select").empty();
			}

			if($("#zone").val()==""){
				$("#text").html("Entrer le nom de la nouvelle plaque est obligatoire.").css({color:"red"});
				e.preventDefault();}
				
			else{
				$("#text").empty();
			}
			var compte=0	
			var x= document.getElementsByName('couleur')
			for(var i in x){
				if(x[i].checked==false){
							compte++;}}
					
				if(compte==x.length){
					alert("Vous n'avez pas choisi de couleur");
					e.preventDefault();
			}
			
		}
	</script>

  <?php
        if((isset($_POST['zone'])) && (isset($_POST['USEI']))&&(isset($_POST['couleur']))){
            $usei=$_POST['USEI'];
            $zone=$_POST['zone'];
            $agence=$_POST['agence'];
			$couleurI = $_POST['couleur'];
			//print_r($couleur);
			$req3=" select * from couleurs where CouleurInfo = '$couleurI'";
			$req31 = $bdd -> query($req3);
			$data3=$req31->fetchAll(PDO::FETCH_NUM);
			$Couleur=$data3[0][1];
			$UrlA=$data3[0][2];
			$UrlBo=$data3[0][3];
			$UrlS=$data3[0][4];
			$UrlBi=$data3[0][5];
			$UrlLegende=$data3[0][6];
			
			

            try{
                $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }

            $req = $bdd->prepare('INSERT INTO zone (Zone, USEI) VALUES (?,?)');
            $zone=strtoupper(str_replace(' ','_',$zone));
            $usei=str_replace(' ','_',$usei);
            $reponse = $bdd->query("SELECT ID FROM usei WHERE USEI = '$usei'");
            while ($donnees = $reponse->fetch()) {
                $useiId = $donnees['ID'];
            }


            ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
            $sql1="SELECT Zone FROM zone WHERE Zone='$zone'";
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
            if(mysqli_num_rows($req1)==0){      
				$sql32="INSERT  INTO zone (ID, Zone, USEI,Couleur,UrlImageA,UrlImageBo,UrlImageS,URlImageBI,URlImageLegende,NOM_AGENCE_NIV2)VALUES('','$zone','$useiId','$Couleur','$UrlA','$UrlBo','$UrlS','$UrlBi','$UrlLegende','$agence')";
				 $req33 = mysqli_query($GLOBALS["___mysqli_ston"], $sql32);
        
                echo "<script type='text/javascript'> alert(\"Nouvelle plaque $zone ajoutée.\"); </script>";    
            }
            else{
                echo "<script type='text/javascript'> alert('Cette Zone existe déjà.'); </script>";
            }    
        }
    ?>
