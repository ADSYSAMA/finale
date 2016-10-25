<?php
	require_once("menu.php");
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

	function VerifierAdresseMail($adresse){ //permet de vérifier qu'une adresse mail est bien valide 	
		var syntaxe = /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z]{2,6}$/;
		return syntaxe.test($adresse);
	}

	function VerifierNumTel($num){ //permet de vérifier que le numéro de téléphone est bien valide
		var syntaxe = /^0+[1-9]+[0-9]{8}$/;
		return syntaxe.test($num);
	}

	function valider(e) {
		if($("#code").val()==""){
			$("#codeverif").html("Entrer le nouveau code du technicien est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#codeverif").empty();
		}

		if($("#nom").val()==""){
			$("#nomverif").html("Entrer le nouveau nom du technicien est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#nomverif").empty();
		}

		if($("#prenom").val()==""){
			$("#prenomverif").html("Entrer le nouveau prénom du technicien est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#prenomverif").empty();
		}

		if($("#tel").val()==""){
			$("#telverif").html("Entrer le nouveau numéro de téléphone du technicien est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			if (VerifierNumTel($("#tel").val())){
				$("#telverif").empty();
			}
			else {
				$("#telverif").html("Le numéro de téléphone entré n'est pas valide. Ressaisissez-en un de nouveau").css({color:"red"});
				if (ie){
					event.returnValue = false;
				}
				else{
					e.preventDefault();
				}
			}
		}

		if($("#mail").val()==""){
			$("#mailverif").html("Entrer le nouveau mail du technicien est obligatoire.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			if (VerifierAdresseMail($("#mail").val())){
				$("#mailverif").empty();
			}
			else {
				$("#mailverif").html("Le mail entré n'est pas valide. Ressaisissez-en un de nouveau").css({color:"red"});
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

 <?php
    $tech=$_POST['tech'];
    $tech_id=$_POST['tech'];
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
    $sql="SELECT * FROM technicien WHERE ID='$tech';";
    $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $result=mysqli_fetch_assoc($req);
    $nom_tech=str_replace('_', ' ',$result['Technicien']);
    echo '<br/><br/><p style="color : white; text-align:center;">Vous travaillez sur le technicien  '.$nom_tech.'</p>';
?> 

<form id="MonFormulaire" name="form" method="POST" onsubmit="valider(event);" action="ModifTecBis.php">
	<p>Modification du code du technicien :
		<input type="text" name="CODE" id="code" size =60 value="<?php echo $result['CODE']; ?>" />
		<div id="codeverif"></div>
	</p>
	
	<br/>
	
	<p>Modification du nom du technicien :
		<input type="text" name="NOM" id="nom" size=60 value="<?php echo $result['NOM']; ?>"/>
		<div id="nomverif"></div>
	</p>
	
	<br/>
	
	<p>Modification du prénom du technicien :
		<input type="text" name="PRENOM" id="prenom" value="<?php echo $result['PRENOM']; ?>"/>
		<div id="prenomverif"></div>
	</p>
	
	<br/>
	
	<p>Modification du n° de téléphone du technicien :
		<input type="text" name="Tel" id="tel" value="<?php echo $result['Tel']; ?>"/>
		<div id="telverif"></div>
	</p>
	
	<br/>
	
	<p>Modification du mail du technicien :
		<input type="text" name="Mail" id="mail" size =60 value="<?php echo $result['Mail']; ?>"/>
		<div id="mailverif"></div>
	</p>
	
	<br/>
	
	<input type="hidden" name="tech" value="<?php echo $tech; ?>">
	
	<input type="submit" value="Modifier">
</form>

<?php
    // Vérification que toutes les variables précédentes existent bien et ne sont pas vides
    if((isset($_POST['CODE'])) && (isset($_POST['NOM'])) && (isset($_POST['PRENOM'])) && (isset($_POST['Tel'])) && (isset($_POST['Mail']))){
        $code=strtoupper($_POST['CODE']);
        $nom=strtoupper($_POST['NOM']);
        $prenom=ucwords($_POST['PRENOM']);
        $tech=$nom.'_'.$prenom;
        $tel=$_POST['Tel'];
        $mail=$_POST['Mail'];
        
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $minisql="SELECT CODE FROM technicien WHERE ID='$tech_id';";
        $minireq=mysqli_query($GLOBALS["___mysqli_ston"], $minisql);
        $minidata=mysqli_fetch_assoc($minireq);
        $excode=$minidata['CODE'];
        
        $sql="SELECT NOM, PRENOM, Tel, Mail FROM technicien WHERE CODE='$code';";
        $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);    
        if(mysqli_num_rows($req)==0 || $excode==$code){
            $sql1="UPDATE technicien SET CODE='$code', NOM='$nom', PRENOM='$prenom', Tel='$tel', Mail='$mail', Technicien='$tech' WHERE ID='$tech_id';";
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
            if($req1==true){
                echo '<script type="text/javascript"> alert("Modification effectuée"); 
                document.location.replace("ModifTec.php");
				</script>';
            }
        }
        else{
            echo '<script type="text/javascript"> alert("Un technicien ayant ce même code existe déjà. La modification n\'est pas autorisée."); </script>';
        }
    }
?> 