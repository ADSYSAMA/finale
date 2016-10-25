<?php
	require('menuItineraire.php');//menu pour la page itineraire permetant d'afficher la carte correctement et sans perturber l'affichage de la carte dans index.php
	?>

	<style>
		.adp, .adp table, .adp-list {
			color:#FFF;
		}
		
		
		select{
			display: block;
			text-align: center;
			width:300px;
			float: center;}
			#km{
				display: block;
				width:300px;
				text-align: center;
				float: center;
			}
			#tps{
				display: block;
				width:300px;
				text-align: center;
				float: center;
				font-style: bold;
			}

		</style>
		


		<body onLoad="initialize2();" >
<body>
			<br/>

			<div id="container" align="center" style="width:1400px;" >
				<div id="destinationForm">
					<form id="monFormulaire" method="post" action="#" onSubmit="setDirections(this.from.value, this.to.value, 'fr'); return false">
						<div id="info" style="display:inline-table;">
						<div style="display:table-cell;padding-right:100px;">
							<?php
							$a=1;
							$b=1;
							$c=1;
							$first_zone=null;
							$first_zone = (isset($_POST['first_zone']))?$_POST['first_zone']:null;
							$connection = ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
							((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD 8");
							$first_sqle = 'SELECT Zone FROM zone ORDER BY Zone'; 
							$first_reqe = mysqli_query($GLOBALS["___mysqli_ston"], $first_sqle);
							?> 
							<td align="center" rowspan="3" width="40" valign="middle"></td>

							<br><br>
							<label for="adresse" style=""> Zone de départ : </label>
							<select name="first_zone" id="first_zone" onchange="javascript:Select_Zone()" >
								<option value="Selectionner" style="display: block;">Selectionner une zone  </option>
								<?php
								while($data = mysqli_fetch_assoc($first_reqe)){
									$Zone=$data['Zone'];
									$data['Zone']=str_replace('_',' ',$Zone);
									$Zone=str_replace(' ','_',$Zone);
									$selected = $first_zone == $Zone ? " selected=\"selected\"" : null;
									echo "<option value=\"". $Zone ."\"". $selected .">". $data['Zone'] ."</option>\n";
									$c++;
								}
								?>

							</select>

							<?php
							$last_zone = (isset($_POST['last_zone']))?$_POST['last_zone']:null;
							$connection = ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
							((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD 8");
							$last_sqle = 'SELECT Zone FROM zone ORDER BY Zone'; 
							$last_reqe = mysqli_query($GLOBALS["___mysqli_ston"], $last_sqle);
							?> 

							<td  align="center" rowspan="3" width="40" valign="middle"></td>
							<br>
							<label for="adresse"> Zone de destination : </label>
							<select name="last_zone" id="last_zone" onChange="javascript:Select_Zone()" style="width:300px;">
								<option value="Selectionner">Selectionner une zone  </option>
								<?php
								while($data = mysqli_fetch_assoc($last_reqe)){
									$Zone=$data['Zone'];
									$data['Zone']=str_replace('_',' ',$Zone);
									$Zone=str_replace(' ','_',$Zone);
									$selected = $last_zone == $Zone ? " selected = \"selected\"" : null;
									echo "<option value=\"". $Zone ."\"". $selected .">". $data['Zone'] ."</option>\n";
									$c++;
								}
								?> 
							</select>

							<td align="center" rowspan="3" width="40" valign="middle"></td>

							<?php
							$first_from = (isset($_POST['from']))?$_POST['from']:null;
							($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
							((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
							$first_sql = "SELECT SITE_CLIENT, ADRESSE, CODE_POSTAL FROM base, zone WHERE  zone.Zone ='$first_zone' AND zone.ID = SECTEUR ORDER BY SITE_CLIENT";
							$first_req = mysqli_query($GLOBALS["___mysqli_ston"], $first_sql);
							?> 
							<br>
							<label for="adresse"> Point de départ : </label>
							<select name="from" id="fromAddress">
								<option value="Selectionner">Selectionner un point de départ  </option>
								<?php
								while($data = mysqli_fetch_assoc($first_req)){
									$from=$data['ADRESSE'].' '.$data['CODE_POSTAL'];
									$from=str_replace(' ', '_', $from);
									$selected = $first_from == $from ? " selected = \"selected\"" : null;
									echo "<option value=\"". $from ."\"". $selected .">". $data['SITE_CLIENT'] ."</option>\n";
									$a++;
								}
								?> 
							</select>

							<br/>

							<label for="adresse">Point d'arrivée:</label>
							<select name="to" id="toAddress">
								<option value="Selectionner">Selectionner une destination</option>
								<?php
								$last_to = (isset($_POST['to']))?$_POST['to']:null;
								($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
								((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
								$sql = "SELECT SITE_CLIENT, ADRESSE, CODE_POSTAL FROM base, zone  WHERE   zone.Zone ='$last_zone' AND zone.ID = SECTEUR ORDER BY SITE_CLIENT";
								$req = mysqli_query($GLOBALS["___mysqli_ston"], $sql);
								while($data = mysqli_fetch_assoc($req)){
									$to=$data['ADRESSE'].' '.$data['CODE_POSTAL'];
									$to=str_replace(' ','_',$to);
									$selected = $last_to == $to ? " selected = \"selected\"" : null;
									echo "<option value=\"". $to ."\"". $selected .">". $data['SITE_CLIENT'] ."</option>\n";
									$b++;
								}
								?> 
							</select>

							<td align="center" rowspan="3" width="40" valign="middle"><input name="gogogo" type="submit" value="Itinéraire" /><br></td>
							<label >Distance : </label>
							<input type="text" id="km" value="" size="9" disabled> km

							<br/>

							<label>Temps de parcours estimé : </label>
							<input type="text" id="tps" value="" size="9" > minutes
							</div>
							<div style="display:table-cell;width:1000px;">
							<table  border="1px solide white;" class="directions" cellspacing="1" cellpadding="0" style="margin:auto;">
								<tr>
									<th>Itinéraire détaillé</th><th width="600" class="print">Carte</th>
								</tr>
								<tr>
									<td><div id="directions" style="color:white;width:95%;"></td>
									<td><div id="map_canvas" class="print" style="width:100%;"></div></td>
								</tr>
							</table>
							</div>
						</div>


					</form>
				</div>

				<div id="panel"></div>
			</div>

			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyBcqB2UFZMlycFszNQ-UQ_D2h6ioNE338g"></script>
			<script type="text/javascript">



				var directionsService = new google.maps.DirectionsService();
				var directionsDisplay = new google.maps.DirectionsRenderer();
				var map;

				var addressMarker;
				function Select_Zone(){
					document.forms["monFormulaire"].submit();
				}

				function initialize2(){
					console.log("yuhouuu");
					var centre=new google.maps.LatLng(48.856666, 2.350987);
					map = new google.maps.Map(document.getElementById('map_canvas'), {
						center: centre,
						zoom: 12,
						mapTypeId: google.maps.MapTypeId.ROADMAP
					});
					directionsDisplay.setMap(map);
					directionsDisplay.setPanel(document.getElementById("directions"));
				}

				function setDirections(fromAddress, toAddress){
					var request={
						origin: fromAddress, 
						destination: toAddress,
						travelMode: google.maps.DirectionsTravelMode.DRIVING,
						durationInTraffic: true

					};
					directionsService.route(request, function(response, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							document.getElementById('km').value =(response.routes[0].legs[0].distance.value)/1000;
						document.getElementById('tps').value =Math.round(response.routes[0].legs[0].duration/*_in_traffic*/.value/60); // pour utiliser le paramètre duration_in_traffic, il faut avoir accès à Google Maps for business, donc Orange doit posséder une clé pour y accéder
						directionsDisplay.setDirections(response);
					}
				});
				}


			</script>
		</body>
		</html>
