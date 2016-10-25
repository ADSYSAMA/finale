
	<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			alert('Vous n\'êtes pas autorisé à acceder à cette page, vous allez être redirigé après avoir validé cette boite de dialogue');
			document.location.replace('login.php');
			</script>";
		// redirection vers "login.html" dans 1 seconde
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

	function validergeo() {
		alert("validergeo");
		if(($("#Adresse").val()!="") && ($("#Code").val()!="") && ($("#Ville").val()!="")){
			$("#geoverif").empty();
			Gmaps.SearchLatLng(($("#Adresse").val())+""+($("#Code").val())+""+($("#Ville").val()));
		}
		else{
			$("#geoverif").html("Le remplissage des champs: Adresse, Code et Ville est obligatoire pour lancer la géolocalisation").css({color:"red"});
		}
	}

	// Initialisation de variables
	var Geocodeur;
	var Gmaps = {		
		// Lance une recherche de latitude et longitude d'une adresse
		SearchLatLng : function(adresse) {
			alert("geoloc");
			Geocodeur = new google.maps.Geocoder();
			alert("1");
			Geocodeur.geocode({address: adresse}, Gmaps.GeocodeResult);
			alert("2");
		},	
	
	
		// Analyse la réponse d'une recherche de latitude et longitude
		GeocodeResult : function(response, status) {
			alert("geocoderesult");
			var nbre_adresses = response.length;
			alert(nbre_adresses);
			//if ((status == google.maps.GeocoderStatus.OK) && (nbre_adresses)) {
					Geocodeur.Item = response[0];				
					var lat = Geocodeur.Item.geometry.location.lat();
					var lng = Geocodeur.Item.geometry.location.lng();
					alert("3");
					if(lat && lng) {
						alert("rempli");
						document.forms['form'].elements['lat'].value=lat;
						document.forms['form'].elements['lng'].value=lng;
					}					
			//}
		}
	};

	function valider(e) {
		if($("#Nom").val()==""){
			$("#Nomverif").html("Entrer le nom du nouveau site est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#Nomverif").empty();
		}

		if($("#Adresse").val()==""){
			$("#Adresseverif").html("Entrer l'adresse du nouveau site est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#Adresseverif").empty();
		}

		if($("#Code").val()==""){
			$("#Codeverif").html("Entrer le code postal du nouveau site est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#Codeverif").empty();
		}

		if($("#Ville").val()==""){
			$("#Villeverif").html("Entrer la ville est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#Villeverif").empty();
		}

		if($("#lat").val()=="" || $("#lng").val()==""){
			$("#geoverif").html("Entrer manuellement les données de géolocalisation ou cliquer sur le bouton \"Geolocaliser le site\".").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#geoverif").empty();
		}
		
		
		
		
		
	}



	
</script>

<?php
    ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
    ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
    $site_id=$_GET['OldName'];
    $plaque_id=$_GET['sec'];
    //$site_id= "ORANGE STADIUM (93400101)";
    //$plaque_id="IDF_75NE_93O";
    
    
    $minisql="SELECT * FROM base WHERE ID='$site_id';";
    $minireq=mysqli_query($GLOBALS["___mysqli_ston"], $minisql);
    $miniresult=mysqli_fetch_assoc($minireq);
    $nom_site=$miniresult['SITE_CLIENT'];
    echo '<br/><br/><p style="color : white; text-align:center;">Vous travaillez sur le bâtiment  '.$site_id.' , qui se situe sur la plaque:  '.$plaque_id.'  </p>';

    $sql="SELECT * FROM base WHERE SITE_CLIENT=\"$site_id\";";
    $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
    $result=mysqli_fetch_assoc($req);
    ?> 
	<form id="MonFormulaire" name="form" method="GET" action="ModifSiteBis2.php" onsubmit="valider(event);">
	<p> Changer de plaque : </p>
<?php
        $minisql2="SELECT * FROM zone WHERE ID='$plaque_id';";
        $minireq2=mysqli_query($GLOBALS["___mysqli_ston"], $minisql2);
        $miniresult2=mysqli_fetch_assoc($minireq2);
        $nom_plaque=$miniresult2['Zone'];

        $sql1="Select Zone FROM zone;";
        $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
        echo "<select name='first_selec' id='first_selec' >
            <option value=\"0\">$plaque_id</option>";

        while($data=mysqli_fetch_assoc($req1)){
            if($data['Zone']!=$nom_plaque){
                echo "<option value=\"".$data['Zone']."\">". $data['Zone'] ."</option>\n";
            }
        }
    ?>						
	</select>
	<br/><br/>	

	<input type="hidden" name="sec" value="<?php echo /*$_GET['sec']*/ $plaque_id  ?> "/>
	<input type="hidden" name="OldName" value="<?php echo /*$_GET['OldName']*/ $site_id ?> "/>
	<p>Nouveau nom du bâtiment : <input type="text" name="Nom" size =60 id="Nom" value="<?php echo $result['SITE_CLIENT']; ?>" /><div id="Nomverif"></div></p><br/>
	<p>Nouvelle adresse du bâtiment : <input type="text" name="Adresse" size=60 id="Adresse" value="<?php echo $result['ADRESSE']; ?>"/><div id="Adresseverif"></div></p><br /> <p>Nouveau code postal : <input type="text" name="Code" id="Code" value="<?php echo $result['CODE_POSTAL']; ?>"/><div id="Codeverif"></div></p><br/>
	
	<p>Nouvelle ville : <input type="text" name="Ville" id="Ville" value="<?php echo $result['VILLE']; ?>"/><div id="Villeverif"></div></p><br/>
	<input type="button" value="Geolocaliser le site" id="geo" onclick="validergeo();">
	<p> Latitude : <input type="text" name="lat" id="lat" value="<?php echo $result['LATITUDE']; ?>" placeholder="geolocaliser"/></p>
	<p> Longitude : <input type="text" name="lng" id="lng" value="<?php echo $result['LONGITUDE']; ?>" placeholder="geolocaliser"/></p>
	<div id="geoverif"></div>
	</br>
	<p>
	<label for="Describe">Modifiez le commentaire : </label></br>
	<textarea name="Describe" id="Describe" value="<?php echo $result['DESCRIPTION'] ?>" rows="4" cols="30"></textarea>
	</p>
	<p>Type de bâtiment : 
		<select name="boutique" id="boutique">
			<option value="CHOISIR EN DESSOUS" disabled selected="selected">CHOISIR EN DESSOUS</option>
			<option value="Boutique">Boutique</option>
			<option value="Service">Prise de Service</option>
			<option value="Binome">Binome</option>
			<option value="Autre">Autre</option>
		</select>
	</p>	
		
	<input type="submit" id="submit" value="Modifier"/>
	</form>

 <?php
    if(isset($_GET['first_selec']) && isset($_GET['Nom']) && isset($_GET['Adresse']) && isset($_GET['Code']) && isset($_GET['Ville'])){
        try{
            $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
        $zone = $_GET['first_selec'];
        if ($zone=="0"){
            $zone=$nom_plaque;
        }
        
        $reponse = $bdd->query("SELECT ID, NOM_AGENCE_NIV2 FROM zone WHERE Zone = '$zone'");
        while ($donnees = $reponse->fetch()) {
            $zoneId = $donnees['ID'];
            $AGENCE_NIV2 = $donnees['NOM_AGENCE_NIV2'];
        }
        $site=strtoupper($_GET['Nom']);
        $exNom=$site_id;
        $adr=$_GET['Adresse'];
        $code=$_GET['Code'];
        $ville=$_GET['Ville'];
        $plaque= $zoneId;
        $type=$_GET['boutique'];
        $descr=$_GET['Describe'];
        $lat=$_GET['lat'];
        $lng=$_GET['lng'];
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $sql="UPDATE base SET SITE_CLIENT='$site', ADRESSE='$adr', CODE_POSTAL='$code', VILLE='$ville', LONGITUDE='$lng', LATITUDE='$lat', SECTEUR='$plaque', TYPE_DE_SITE='$type', DESCRIPTION='$descr' WHERE SITE_CLIENT='$exNom';";
        $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $sql2="UPDATE activiteplaque3 SET NOM_AGENCE_NIV2='$AGENCE_NIV2' WHERE CODESITE='$site'";
        $req2=mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
        if($req==true){
            echo "<script>alert('Modification effectuée'); 
            document.location.replace('index.php');</script>";
        }
    }
?> 
