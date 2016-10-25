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

	function valider(e){
		if(($("#site :selected").text()=="Selectionner un site") || ($("#site :selected").text()=="")){
			$("#siteverif").html("Selectionner un site est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#siteverif").empty();
		}

		if(($("#tech select :selected").text()=="Selectionner un technicien") || ($("#tech select :selected").text()=="")){
			$("#techverif").html("Selectionner un technicien est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#techverif").empty();
		}		
	}

</script>

<form id="MonFormulaire" method="post" onsubmit=valider(event); action="#">
 <?php
        require "db.class.php";
            $DB = new DB();
        $sites = $DB->query('SELECT * FROM base where TECHNICIEN !=""');
        $techs = $DB->query('SELECT * FROM technicien');
        $techBySite= array();

        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $sql = "SELECT base.ID as site_id, technicien.ID as tech_id, technicien.Technicien FROM base, technicien WHERE base.SITE_CLIENT=technicien.Site";
        $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        while($data = mysqli_fetch_array($req)){
            $techBySite[$data['site_id']][$data['tech_id']] = $data['Technicien'];
        }

        $site_id = 0;
            if(isset($_POST['site_id'])){
                $site_id = $_POST['site_id'];
            }
    ?>
	
	</br>

	<p><center><h1><strong style="color:white;">Supprimer un technicien</strong></h1></center></br></br>
		<label for="site"> Site : </label>

		<br/>

		<select name="site" id="site">
			<option value="0">Selectionner un site</option>
				<?php foreach ($sites as $site): ?>
					<option value="<?php echo $site->ID; ?>" <?php echo $site_id == $site->ID ? ' selected' : ''; ?>>
							<?php echo $site->SITE_CLIENT; ?>
					</option>
				<?php endforeach ?>
		</select>
		<div id="siteverif"></div>

	</p>

	<div class="step2">
		<label for="tech"> Technicien : </label>

		</br>

		<div id="tech">
			<?php foreach($techBySite as $site_id => $techs): ?>
				
				<select name="tech" id="site-<?php echo$site_id;?>">
					<option value="0">Selectionner un technicien</option>
					<?php foreach ($techs as $ID => $Tech): ?>
						<option value="<?php echo $ID; ?>"><?php echo $Tech ; ?></option>
					<?php endforeach ?>
				</select>
			<?php endforeach ?>
		</div>
		<br/>
		<div id="techverif"></div>
	</div>

	<br/>
	<br/>
	
	<input type="submit" value="Envoyer"/>

</form>

<script type="text/javascript">
	(function($){
		var techs = {};

		$('.step2').hide();
		
		$('.step2 select').each(function(){
			var select=$(this);
			techs[select.attr('id')] = select;
			select.remove();
		});

		$('#site').change(function(event){
			var site_id=$(this).val();
			if(site_id==0){
				$('.step2').hide();
			}
			else{
				$('.step2').show();
				$('#tech').empty().append(techs['site-'+site_id]);
			}
		}).trigger('change');
	})(jQuery);
</script>


<?php 
    if ((isset($_POST['site'])) && (isset($_POST['tech']))){
        $tech = $_POST['tech'];
        $Site = $_POST['site'];
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", ""))or die ("ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $sql="SELECT SITE_CLIENT FROM base WHERE ID='$Site';"; // Selectionne les techniciens où le site est $site
        $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);
        $data=mysqli_fetch_assoc($req);
        $nom=$data['SITE_CLIENT'];
        $sqle = "DELETE FROM technicien WHERE ID = '$tech' AND Site = '".$nom."'";
        $requete = mysqli_query($GLOBALS["___mysqli_ston"], $sqle);
        if($requete){
            $sql1="SELECT Technicien FROM technicien WHERE ID='$tech';"; // Selectionne les techniciens où le site est $site
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
            $data1=mysqli_fetch_assoc($req1);
            $nom1=$data1['SITE_CLIENT'];
            $nom_tech=str_replace('_',' ',$nom1);
            echo "<script type='text/javascript'> alert('Le technicien ".$nom_tech." a ete supprime avec succes');
            document.location.replace( 'Supprimertech.php');
			</script>";
        }
    }
?> 
