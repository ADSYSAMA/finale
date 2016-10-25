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
	
<form id="MonFormulaire" name="form" method="post" action="ModifSiteBis.php" onsubmit="valider(event);" >
	<?php
		require "db.class.php";
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
		}
	    	$usei_id = 0;
	    	if(isset($_POST['usei_id'])){
	    		$usei_id = $_POST['usei_id'];
	    	}
		$zone_id = 0;
	    	if(isset($_POST['zone_id'])){
	    		$zone_id = $_POST['zone_id'];
	    	}
    	?>
	
	</br>
	<p>
	</br><center><h1><strong style="color:white;">Modifier un site</strong></h1></center></br></br>
		<label for="usei"> USEI : </label>

		<br/>

		<select name="first" id="first">
			<option value="0">Sélectionner un USEI</option>
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
		<label for="plaque"> Plaque : </label>

		</br>

		<div id="zone">
			<?php foreach($zoneByUsei as $usei_id => $zones): ?>
				<select name="sec" id="usei-<?php echo $usei_id;?>">
				<option value="0">Sélectionner une plaque</option>
					<?php foreach ($zones as $ID => $Zone): ?>
						<option value="<?php echo $ID; ?>" <?php echo $zone_id == $zone->ID ? ' selected' : ''; ?>>
								<?php echo $Zone ; ?></option>
					<?php endforeach ?>
				</select>
			<?php endforeach ?>
		</div>
		<br/>
		<div id="secverif"></div>
	</div>

	<br/>

	<div class="step3">
		<label for="site"> Site : </label>

		</br>

		<div id="site">
			<?php foreach($siteByZone as $zone_id => $sites): ?>
				<select name="OldName" id="zone-<?php echo$zone_id;?>">
					<option value="0">Sélectionner un site</option>
					<?php foreach ($sites as $ID => $Site): ?>
						<option value="<?php echo $ID; ?>"><?php echo $Site ; ?></option>
					<?php endforeach ?>
				</select>
			<?php endforeach ?>
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

		$('.step2').hide();
		$('.step3').hide();
		
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
			if(usei_id==0){
				$('.step2').hide();
			}
			else{
				$('.step2').show();
				$('#zone').empty().append(zones['usei-'+usei_id])
					.change(function(event){
						var zone_id=$("#zone select option:selected").val();
						if(zone_id==0){
							$('.step3').hide();
						}
						else{
							$('.step3').show();
							$('#site').empty().append(sites['zone-'+zone_id]);
						}
					}).trigger('change');
			}
		}).trigger('change');
	})(jQuery);
</script>

<script type="text/javascript">
	function valider(e) {
		if($("#first :selected").text()=="Sélectionner un USEI"){
			$("#firstverif").html("Sélectionner un USEI est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#firstverif").empty();
		}

		if($("#zone select :selected").text()=="Sélectionner une plaque"){
			$("#secverif").html("Sélectionner une plaque est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#secverif").empty();
		}

		if($("#site select :selected").text()=="Sélectionner un site"){
			$("#terverif").html("Sélectionner un site est obligatoire.").css({color:"red"});
			e.preventDefault();
		}
		else{
			$("#terverif").empty();
		}
}

</script>
