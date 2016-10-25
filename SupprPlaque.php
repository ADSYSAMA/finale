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
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
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
		if($("#first :selected").text()=="Selectionner un USEI"){
			$("#firstverif").html("Selectionner un USEI est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#firstverif").empty();
		}

		if($("#zone select :selected").text()=="Selectionner une plaque"){
			$("#secverif").html("Selectionner un USEI est obligatoire pour continuer.").css({color:"red"});
			if (ie){
				event.returnValue = false;
			}
			else{
				e.preventDefault();
			}
		}
		else{
			$("#secverif").empty();
		}
	}
</script>
</br><center><h1><strong style="color:white;">Supprimer une plaque</strong></h1></center></br>
<form id="MonFormulaire" method="post" onsubmit="valider(event);" action="SupprPlaque.php">
	<?php
		require "db.class.php";
	    	$DB = new DB();
	    	$useis = $DB->query('SELECT * FROM usei');
		$zones = $DB->query('SELECT * FROM zone');
		$zoneByUsei = array();
		foreach($zones as $zone){
			$zoneByUsei[$zone->USEI][$zone->ID] = $zone->Zone;
		}
	    	$usei_id = 0;
	    	if(isset($_POST['usei_id'])){
	    		$usei_id = $_POST['usei_id'];
	    	}
    	?>
	
	</br>
	<p>
		<label for="tech"> USEI : </label>

		<br/>

		<select name="first" id="first">
			<option value="0">Selectionner un USEI</option>
				<?php foreach ( $useis as $usei ): ?>
					<option value="<?php echo $usei->ID; ?>" <?php echo $usei_id == $usei->ID ? ' selected' : ''; ?>>
							<?php echo $usei->USEI; ?>
					</option>
				<?php endforeach ?>
		</select>
		<div id="firstverif"></div>

	</p>

	</br>

	<div class="step2">
		<label for="adresse"> Plaque : </label>

		</br>

		<div id="zone">
			<?php foreach($zoneByUsei as $usei_id => $zones): ?>
				<select name="sec" id="usei-<?php echo $usei_id;?>">
				<option value=0>Selectionner une plaque</option>
					<?php foreach ($zones as $ID => $Zone): ?>
						<option value="<?php echo $ID; ?>"><?php echo $Zone ; ?></option>
					<?php endforeach ?>
				</select>
			<?php endforeach ?>
		</div>
		<br/>
		<div id="secverif"></div>
	</div>

	</br>

	<input type="submit" value="Envoyer"/>
</form>	

 <?php 
    if((isset($_POST['first'])) && (isset($_POST['sec']))){
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $plaque=$_POST['sec'];
        $sql1="SELECT SITE_CLIENT FROM base WHERE SECTEUR ='$plaque'"; //Selectionne les sites ou la plaque est $plaque
        $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
        $num_rows = mysqli_num_rows($req1);
        if(($num_rows==0)){ //Si la requete renvoit 0 lignes, on peut supprimer la plaque
            $sql2="DELETE FROM zone WHERE ID='$plaque'";
            $req2=mysqli_query($GLOBALS["___mysqli_ston"], $sql2);
            if($req2==true){
                echo "<script type='text/javascript'>alert('Suppression reussie');</script>";
             //   header("Refresh: 1;url=SupprPlaque.php");
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Vous ne pouvez pas supprimer cette zone car il reste encore des sites attribues a cette zone');</script>";
        }    
    }
?> 

<script type="text/javascript">
	(function($){
		var zones = {};

		$('.step2').hide();
		
		$('.step2 select').each(function(){
			var select=$(this);
			zones[select.attr('id')] = select;
			select.remove();
		})

		$('#first').change(function(event){
			var usei_id=$(this).val();
			if(usei_id==0){
				$('.step2').hide();
			}
			else{
				$('.step2').show();
				$('#zone').empty().append(zones['usei-'+usei_id]);
			}
		}).trigger('change');
	})(jQuery);
</script>
