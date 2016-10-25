		﻿<?php
			require_once("menu.php");
			if (empty($_SESSION['login'])) {
				echo "<script type='text/javascript'>
					 document.location.replace('login.php');
					 </script>";
				//header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
				die();
			}
		?>
		</br><center><h1><strong>Ajouter un UOPT</strong></h1></center></br></br>
		<form id="MonFormulaire" method="post" action="AjouterUSEI.php" onsubmit="valider(event)">
	
			<div>
				<label for="Nom" style="color:white;">Entrez le Nom du nouvel UOPT :</label></br>
				<input type="text" name="Nom" id="Nom" placeholder="Ex : USEI Nord-Est" />
				<p></p>
			</div>

			<input type="submit" value="Envoyer" />
		</form>

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
				if($("#Nom").val()==""){
					$("#Nom").next('p').html('Le nom de l\'USEI est obligatoire pour valider sa création. Réessayez.').css({color:"red"});
					if (ie){
						e.returnValue = false;
					}
					else{
						e.preventDefault();
					}
				}
				else{
					$("#Nom").next('p').empty();
				}
			}
		</script>
		
	    <?php
            if(isset($_POST['Nom'])){
                if (!empty($_POST['Nom'])){
                    $usei=$_POST['Nom'];
                    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
                    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
                    $usei=strtoupper(str_replace(' ','_',$usei));        
                    $sql1="SELECT USEI FROM usei WHERE USEI='USEI_$usei';";
                    $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
                    if(mysqli_num_rows($req1)==0){
                        $sql = "INSERT  INTO usei (ID, USEI) VALUES ( '', 'USEI_$usei')" ;
                        $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
                        if($req==true){
                            echo '<script type=text/javascript> alert("L\'USEI a bien été ajoutée.") </script>';
                        }
                    }
                    else{
                        echo '<script type=text/javascript> alert(\'Cette USEI existe déjà.\') </script>';
                    }
                }
            }
        ?>

		</br>

	</body>
</html>
