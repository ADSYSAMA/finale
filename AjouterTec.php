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
	<script type="text/javascript">
		function VerifierAdresseMail($adresse){ //permet de vérifier qu'une adresse mail est bien valide 	
			var syntaxe = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
			return syntaxe.test($adresse);
		}

		function VerifierNumTel($num){ //permet de vérifier que le numéro de téléphone est bien valide
			var syntaxe = /^0+[1-9]+[0-9]{8}$/;
			return syntaxe.test($num);
		}

	</script>

	 <?php
        if((isset($_POST['first'])) && (isset($_POST['nom'])) && (isset($_POST['prenom'])) && (isset($_POST['tel'])) && (isset($_POST['code'])) && (isset($_POST['mail']))){ //Vérifie que le nom et prénom existent et qu'ils ne sont pas vides
            $tel=$_POST['tel'];
            $nom=strtoupper($_POST['nom']);
            $prenom=ucwords($_POST['prenom']);
            $mail=$_POST['mail'];
            $type=$_POST['first']; 
            $code=strtoupper($_POST['code']);

            try{
                $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }

            $reponse1 = $bdd->query("SELECT SECTEUR FROM base WHERE SITE_CLIENT = '$type'");
            $donnees1 = $reponse1->fetch();
            $numsecteur = $donnees1['SECTEUR'];
            
            $reponse2 = $bdd->query("SELECT USEI FROM zone WHERE ID = '$numsecteur'");
            $donnees2 = $reponse2->fetch();
            $idusei = $donnees2['USEI'];
            $reponse3 = $bdd->query("SELECT USEI FROM usei WHERE ID = '$idusei'");
            $donnees3 = $reponse3->fetch();
            $nomusei = $donnees3['USEI'];
            $nomusei=substr($nomusei, 5);
            
            ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");

            $sql="SELECT NOM, PRENOM, Tel, Mail FROM technicien WHERE CODE='$code';";
            $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);    
            if(mysqli_num_rows($req)==0){
                $tec=$nom.'_'.$prenom;
                $sql1="INSERT INTO technicien (ID, USEI, Nom_AGENCE_NIV1, NOM_AGENCE_NIV2, CODE, Technicien, NOM, PRENOM, POINT_EMBAUCHE, Tel, Mail, Site) VALUES ('', '$nomusei', '', '', '$code', '$tec', '$nom', '$prenom', '', '$tel', '$mail', '$type');";
                $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
                if($req1==true){
                    echo '<script type="text/javascript">alert("Ajout du technicien effectué");</script>';
                }
                else{
                    echo "<script type=text/javascript>alert('Ajout du technicien raté');
                        document.location.replace('AjouterTec.php');</script>";
                }
            }
            else{
                echo"<script type=text/javascript>alert('Le technicien existe déjà et n\'a donc pas été ajouté.');
                    document.location.replace('AjouterTec.php');</script>";
            }
        }    
    ?> 


	<form id="MonFormulaire" method="post" action="AjouterTec.php" onsubmit="valider(event);">
		 <?php
            $c=1;
            $first = null;
            $first = (isset($_POST['first']))?$_POST['first']:null;
            ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
            ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD 8");
            $first_sqle = 'SELECT ID, SITE_CLIENT FROM base ORDER BY SITE_CLIENT';
            $first_reqe = mysqli_query($GLOBALS["___mysqli_ston"], $first_sqle);
        ?> 
		<td align="center" rowspan="3" width="40" valign="middle"></td>
		<center><h1><strong style="color:white;">Ajouter un Technicien</strong></h1></center></br></br>
		<label for="tech"> Site : </label>

		</br>
					
		<select name="first" id="first">
			<option value="Sélectionner">Selectionner un site</option>
			 <?php
                while($data = mysqli_fetch_assoc($first_reqe)){
                    $tech=$data['SITE_CLIENT'];
                    $selected = $first == $tech ? " selected=\"selected\"" : null;
                    echo "<option value=\"". $tech ."\"". $selected .">". $data['SITE_CLIENT'] ."</option>\n";
                    $c++;
                }
            ?> 
		</select>

		</br>
		</br>

		<div id="first_verif"></div>

		</br>
		</br>

		<p>
			<label for="nom">Entrez le Nom du nouveau Technicien :</label>
			<input type="text" name="nom" id="nom" placeholder="Ex : Super" />
			<div id="nom_verif"></div>

		</p>

		<br />

		<p>
			<label for="prenom">Entrez le Prénom du nouveau Technicien :</label>
			<input type="text" name="prenom" id="prenom" placeholder="Ex : Didier" />
			<div id="prenom_verif"></div>
		</p>

		<br />

		<p>
			<label for="tel">Entrez le N° de Téléphone du nouveau Technicien :</label>
			<input type="text" name="tel" id="tel" placeholder="Ex :  0642691664" />
			<div id="tel_verif"></div>
		</p>

		<br />

		<p>
			<label for="code">Entrez le Code du nouveau Technicien :</label>
			<input type="text" name="code" id="code" placeholder="Ex : ASJ3251" />
			<div id="code_verif"></div>
		</p>

		<br />

		<p>
			<label for="mail">Entrez le Mail du nouveau Technicien :</label>
			<input type="text" name="mail" id="mail" placeholder="Ex : Didier.Super@toto.fr" />
			<div id="mail_verif"></div>
		</p>

		<br />

			<input type="submit" value="Ajouter">
		<br/>

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

		function valider(e){
			if(($("#first :selected").text()=="Selectionner un site") || ($("#first :selected").text()=="")){
				$("#first_verif").html("Sélectionner un site est obligatoire pour continuer.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				$("#first_verif").empty();
			}

			if($("#nom").val()==""){
				$("#nom_verif").html("Entrer le nom du nouveau technicien est obligatoire.").css({color:"red"});
				if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
			}
			else{
				$("#nom_verif").empty();
			}

			if($("#prenom").val()==""){
				$("#prenom_verif").html("Entrer le prénom du nouveau technicien est obligatoire.").css({color:"red"});
				if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
			}
			else{
				$("#prenom_verif").empty();
			}

			if($("#tel").val()==""){
				$("#tel_verif").html("Entrer le numéro de téléphone du nouveau technicien est obligatoire.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				if (VerifierNumTel($("#tel").val())){
					$("#tel_verif").empty();
				}
				else {
					$("#tel_verif").html("Le numéro de téléphone entré n'est pas valide. Ressaisissez-en un de nouveau").css({color:"red"});
					if (ie){
						event.returnValue = false;
					}
					else{
						e.preventDefault();
					}
				}
			}

			if($("#code").val()==""){
				$("#code_verif").html("Entrer le code du nouveau technicien est obligatoire.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				$("#code_verif").empty();
			}

			if($("#mail").val()==""){
				$("#mail_verif").html("Entrer le mail du nouveau technicien est obligatoire.").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
			else{
				if (VerifierAdresseMail($("#mail").val())){
					$("#mail_verif").empty();
				}
				else {
					$("#mail_verif").html("Le mail entré n'est pas valide. Ressaisissez-en un de nouveau").css({color:"red"});
					if (ie){
						event.returnValue = false;
					}
					else{
						e.preventDefault();
					}
				}
			}
		}
	</script>
</body>
</html>
