<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			document.location.replace('login.php');</script>";
		//header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
		die();
	}
?>


<script type="text/javascript">

    
	var ok = false;
	var ok1 = false;
	var ok2 = false;
	var ok3 = false;
	var ok4 = false;


	$(document).ready(function(){


    var	$usei = $('#first'),

    	$zone = $('#zone'),

    	$site = $('#Nom'),

        $adresse = $('#Adresse'),

        $codepostal = $('#Code'),

        $ville = $('#Ville'),

        $envoi = $('#envoi'),

        $reset = $('#rafraichir'),

        $erreur = $('#erreur'),

        $champ = $('.champ');


	var ie = (function(){
			var undef, v = 3, div = document.createElement('div');
			while (
				div.innerHTML = '<!--[if gt IE '+(++v)+']><i></i><![endif]-->',
				div.getElementsByTagName('i')[0]
		    	);
			return v> 4 ? v : undef;
		}());



    $champ.keydown(function(){


    		if($(this).is('#Code'))
    			var s= /^[0-9]{4,6}$/;
    		
	        else 
	        	var s= /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'-\s]{3,}$/;


	        	if(!$(this).val().match(s)){ // si la chaîne de caractères est differente de celles attendues

            $(this).css({ // on rend le champ rouge 

                borderColor : 'red',

          	  	color : 'red'

            });
       		
         }

         else{

             $(this).css({ // si tout est bon, on le rend vert

             borderColor : 'green',

             color : 'green'

         });

         }

    });

    $champ.change(function(){

			if($(this).is('#Code'))
    			var s= /^[0-9]{4,6}$/;
    	
	        else  
	        	var s= /^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ'-\s]{3,}$/;


       		 if(!$(this).val().match(s)){

            $(this).css({ // on rend le champ rouge 

                borderColor : 'red',

            color : 'red'

            });



                 if($(this).is('#Nom'))
            	  ok1=false;
            	 else if($(this).is('#Adresse'))
            		ok2=false;
           		 else if($(this).is('#Code'))
            		ok3=false;
            	 else if($(this).is('#Ville'))
            		ok4=false;
         }

         else{

             $(this).css({ // si tout est bon, on le rend vert

             borderColor : 'green',

             color : 'green'

         });
             console.info(ok4);
          

        	 if($(this).is('#Nom'))
            	  ok1=true;
            	else if($(this).is('#Adresse'))
            		ok2=true;
            		else if($(this).is('#Code'))
            			ok3=true;
            			else if($(this).is('#Ville'))
            				ok4=true;

             if($(this).is('#Ville')){
        	validergeo();
        	}
         }

    });




    $reset.click(function(){

        $champ.css({ // on remet le style des champs comme on l'avait défini dans le style CSS

            borderColor : '#ccc',

            color : '#555'

        });

        $erreur.css('display', 'none'); // on prend soin de cacher le message d'erreur

    });

    function verifier(champ){
console.info(ok);
        if(champ.val() == "" || ok==false){ 

            $erreur.css('display', 'block'); // on affiche le message d'erreur

        }
        else
        	 $erreur.css('display', 'none');
       }

 $envoi.click(function(e){

		if($("#first :selected").val()==0){
			$("#firstverif").html("Sélectionner un USEI est obligatoire pour continuer.").css({color:"red"});
			e.preventDefault();
		}
		else
			$("#firstverif").html("");

		if($("#zone select :selected").val()==0){
			$("#secverif").html("Sélectionner un USEI est obligatoire pour continuer.").css({color:"red"});
			e.preventDefault();
		}
		else
			$("#secverif").html("");

		validergeo();


 		if(ok==false)
		e.preventDefault();
	
 	

 		if( (ok1&&ok2&&ok3&&ok4) && ($('#useii').val()!=0) && ($('#first').val()!=0) )
 			ok=true;

        verifier($site);

        verifier($adresse);

        verifier($codepostal);

        verifier($ville);

        

        });


 });



	function validergeo() {
		if ( (ok2&&ok3&&ok4) && ($('#usei').val()!=0) && ($('#first').val()!=0)){
			$("#geoverif").empty();
			Gmaps.SearchLatLng(($("#Adresse").val())+""+($("#Code").val())+""+($("#Ville").val()));
		}
		else{

			s="";
			if(!ok1)
			 s="Nom,";
			if(!ok2)
			 s+=" Adresse, ";
			if(!ok3) 
			 s+=" Code postal, ";
			if(!ok4) 
			 s+=" Ville";

			if(!ok1 || !ok2 || !ok3 ||!ok4)
			$("#geoverif").html("Verifier le (s)  champ (s) : "+s).css({color:"red"});

			else if (ok1&&ok2&&ok3&&ok4)
			$("#geoverif").html("Verifier que les valeurs saisies sont correctes !").css({color:"red"});
			

			ok=false;
		}
	};
</script>

	</br></br><center><h1><strong style="color:white;">Ajouter un site</strong></h1></center>
<form id="MonFormulaire" name="form" method="POST" action="Ajouter.php" style="position: relative;top:-50px">  

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
	<div id="erreur" style="display:none" >
    <h2 style="color:red; ">Veuillez remplir correctement les champs du formulaire !</h2></div><br><br>

</div>

	<table style="position:relative;top:-20px;display:inline;border-collapse: separate;margin-left: auto; margin-right: auto;border-spacing: 20px; margin-top: 0"><tr><td>
	<p>
		<label for="tech"> USEI : </label>

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

<br>
	<div class="step2">
		<label for="adresse"> Plaque : </label>

		</br>

		<div id="zone">
			<?php foreach($zoneByUsei as $usei_id => $zones): ?>
				<select name="sec" id="usei-<?php echo $usei_id;?>">
				<option value=0>Sélectionner une plaque</option>
					<?php foreach ($zones as $ID => $Zone): ?>
						<option value="<?php echo $ID; ?>"><?php echo $Zone ; ?></option>
					<?php endforeach ?>
				</select>
			<?php endforeach ?>
		</div>
		<br/>
		<div id="secverif"></div>
	</div>

	<br/>
				
	<p>
		<label for="Nom">Entrez le Nom du Batiment :</label>
		<input type="text" name="Nom" id="Nom" class="champ" placeholder="Ex : Stadium (93424242)" />
		<div id="Nomverif"></div>
	</p>

	</br>

	<p>
		<label for="Adresse">Entrez l'Adresse :</label>
		<input type="text" name="Adresse" id="Adresse" class="champ" placeholder="Ex : 42 rue Haute" />
		<div id="Adresseverif"></div>
	</p>

	</br>

	<p>
		<label for="Code">Entrez le Code Postal :</label>
		<input type="text" name="Code" id="Code" class="champ" placeholder="Ex : 95350"/>
		<div id="Codeverif"></div>
	</p>

	</br>

	<p>
		<label for="Ville">Entrez la Ville du Batiment :</label>
		<input type="text" name="Ville" id="Ville" class="champ" placeholder="Ex : Paris" />
		<div id="Villeverif"></div>
	</p>
<div id="geoverif"></div>
	</td><td>


	<!-- <input type="button" value="Geolocaliser le site" onclick="validergeo();">
	<br>
	<br> -->
	<p> Latitude : <input type="text" name="lat" id="lat" value="" placeholder="geolocaliser" /> </p>
	<p> Longitude : <input type="text" name="lng" id="lng" value="" placeholder="geolocaliser" /></p>
	
	</br>

	<p>
		<label for="boutique">Type de bâtiment :</label>
		<select name="boutique" id="boutique">
			<option value="Boutique">Boutique</option>
			<option value="Service">Prise de Service</option>
			<option value="Binome">Binome</option>
			<option value="Pdl">Point de livraison</option>
			<option value="Pdp">Point de production</option>
			<option value="Pdp">Point d'embauche</option>
			<option value="Autre">Autre</option>
		</select>
		<div id="boutiqueverif"></div>
	</p>

	</br>

	<p>
		<label for="Describe">Un commentaire &agrave; ajouter? (Facultatif)</label></br>
		<textarea name="Describe" id="Describe" rows="4" cols="30"></textarea>
	</p></td></tr></table>

	</br>
	<!-- id="send" -->
	<input type="submit"  id="envoi" name="envoi" value="Envoyer"/> <input type="reset" id="rafraichir" value="Rafraîchir" />
</form>		


<script type="text/javascript"> 
	// Initialisation de variables
	var Geocodeur;
	var Gmaps = {		
		// Lance une recherche de latitude et longitude d'une adresse
		SearchLatLng : function(adresse) {
			Geocodeur = new google.maps.Geocoder(); 
			Geocodeur.geocode({address: adresse}, Gmaps.GeocodeResult);
		},	
	
	
		// Analyse la réponse d'une recherche de latitude et longitude
		GeocodeResult : function(response, status) {
			var nbre_adresses = response.length;		
			if ((status == google.maps.GeocoderStatus.OK) && (nbre_adresses)) {
					Geocodeur.Item = response[0];				
					var lat = Geocodeur.Item.geometry.location.lat();
					var lng = Geocodeur.Item.geometry.location.lng();
					if(lat && lng) {
						document.forms['form'].elements['lat'].value=lat;
						document.forms['form'].elements['lng'].value=lng;
						if(lat!="" && lng!="")
						ok=true;
						else
						ok=false;


					}	
					

			}
					

		}
	};
</script>


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
<?php
		$ok = "<script>ok</script>";
		if(isset($_POST['envoi']) && ($ok==true))
		
		require('traitementForm.php'); 
	print_r($_POST);
?>