<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			alert('Vous n\'etes pas autorise a acceder a cette page, vous allez etre redirige apres avoir valide cette boite de dialogue');
			</script>";
		header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
		die();
	}

				
				$zone_id=$_GET['zone'];
				$site_id=$_GET['oldname'];
?>

<script type="text/javascript">
	function valider(e) {
		if($("#first :selected").text()=="Selectionner un USEI"){
			$("#firstverif").html("Selectionner un USEI est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#firstverif").empty();
		}

		if($("#zone select :selected").text()=="Selectionner une plaque"){
			$("#secverif").html("Selectionner une plaque est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#secverif").empty();
		}

		if($("#site select :selected").text()=="Selectionner un site"){
			$("#terverif").html("Selectionner un site est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#terverif").empty();
		}
}

</script>
	
<form id="MonFormulaire" name="form" method="get" action="supprSiteMarkeur.php" onsubmit="valider(event);" >
	<?php
		/*require "db.class.php";
	    	$DB = new DB();
	    	$useis = $DB->query('SELECT * FROM usei');
		$zones = $DB->query('SELECT * FROM zone');
		$sites = $DB->query('SELECT * FROM base');
		$zoneByUsei = array();
		$siteByZone= array();
		foreach($zones as $zone){
			$zoneByUsei[$zone->USEI][$zone->ID] = $zone->Zone;
		}
		foreach($sites as $site){
			$siteByZone[$site->SECTEUR][$site->ID] = $site->SITE_CLIENT;
			
		}*/
	    		
	
    	?>
	
	<!--</br>
	<p>
		<label for="usei"> USEI : </label>

		<br/>

		<select name="usei" id="first">
			<option value=<?php echo $usei_id; ?>><?php echo $usei_id; ?></option>
				<!--<?php// foreach ( $useis as $usei ): ?>
					<option value="<?php //echo $usei->ID; ?>" <?php// echo $usei_id == $usei->ID ? ' selected' : ''; ?>>
							<?php //echo $usei->USEI; ?>
					</option>
				<?php// endforeach ?>
		</select>
		<div id="firstverif"></div>

	</p>-->

	</br>

	<div class="step2">
		<label for="plaque"> Plaque : </label>
			
		</br>

		<div id="zone">
			<select name="zone" id="sec">
			<option value=<?php echo $zone_id; ?>><?php echo $zone_id; ?></option>
			</select>
			
		</div>
		<br/>
		<div id="secverif"></div>
	</div>

	<br/>

	<div class="step3">
		<label for="site"> Site : </label>

		</br>

		<div id="site">
			<select name="oldname" id="thr">
			<?php echo '<option value="'.$site_id.'"> '.$site_id.'</option>'; ?>
			</select>
		</div>
		<br/>
		<div id="terverif"></div>
	</div>
	<br/>
	<br/>				
	<input type="submit" value="Envoyer"/>
</form>

<script type="text/javascript">
	(function($){
		var zones = {};
		var sites = {};

		//$('.step2').hide();
		//$('.step3').hide();
		
		$('.step2 select').each(function(){
			var select=$(this);
			zones[select.attr('id')] = select;
			select.remove();
		})

		$('.step3 select').each(function(){
			var select=$(this);
			sites[select.attr('id')] = select;
			select.remove();
		})

		$('#first').change(function(event){
			var usei_id=$(this).val();
			//if(usei_id==0){
				//$('.step2').hide();
			//}
			else{
				$('.step2').show();
				$('#zone').empty().append(zones['usei-'+usei_id])
					.change(function(event){
						var zone_id=$("#zone select option:selected").val();
						//if(zone_id==0){
							//$('.step3').hide();
						//}
						else{
							$('.step3').show();
							$('#site').empty().append(sites['zone-'+zone_id]);
						}
					}).trigger('change');
			}
		}).trigger('change');
	})(jQuery);
</script>


