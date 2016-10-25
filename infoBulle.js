console.log("Ce programme JS vient d'être chargé");
$(document).ready(function()
{	
	function distancier(){
			
		$.get('testExcel/Classes/recupID.php',
		{
			zone: PlaqueActuelle,
					
		},
		function(reponse)
		{	
			//console.log(reponse);
			//tabInfoBulle.push(reponse);
			//console.log(tabInfoBulle.join());
			//return tabInfoBulle;
			//var html="<a href=\"testExcel/Classes/recup.php?id="+reponse+"\" target=_self id='lienModif'>Calculer le distancier de la plaque "+PlaqueActuelle+"</a> <br>"
			//$('#distance').append(html);
			//return JSON.parse(reponse);
			//var lienDistance = "<a href=\"testExcel/Classes/recup.php?id="+idCherche+"\" target=_self id='lienModif'>Calculer le distancier de la plaque "+PlaqueActuelle+"</a> <br>";
			//infoWindow.setContent(lienDistance);
			$('#recupid').html(reponse);
		});
	}
	
var polyline;

google.maps.event.addListener(polyline, 'click', function() 
{  

			var PlaqueActuelle = this.html;
			console.log("plaque: "+PlaqueActuelle);
			var ce = "" + polygonCenter(this);
			console.log("Centre: "+ce);
			var ceParametre = ce.replace("(","").replace(")","");	//suppression des parenthèses du contenu de la variable ce	
			var coordo = ceParametre.split(',');					//séparation/récupération de la longitude et de la lattitude dans un tableau
			var lattitude = parseFloat(coordo[0]);					//cast des variable en float
			var longitude = parseFloat(coordo[1]);
			
			var myLatlng = new google.maps.LatLng(lattitude,longitude);
			
			var polyline = new google.maps.Marker({
				position: myLatlng,
				map: map,
				title: 'TEST'
			});
			
			polyline.setVisible(false);


	// Si une infobulle (d'un marqueur avec iconne flamme) est déjà ouverte, alors on la ferme
			if (typeof( window.infoOpened ) != 'undefined')
			{
				infoOpened.close();
			}
			// Si une infobulle (d'un marqueur sans iconne flamme) est déjà ouverte, alors on la ferme
			else if (typeof( window.infoOpened2) != 'undefined')
			{
				infoOpened2.close();
			}
		
			//var info="<b><u><a href=\"site.php?site="+nom+"\" target=_blank>"+nom+"</a></u></b><br/>"  + adresse + "<br/>" + codepostal + " " + ville + "<br/>" + "Techniciens sur le site  : " + nomtec + "<br/><div id='streetView' style='width: 500px; height: 250px; text-align:center'>Street View en cours de chargement ...</div>"; 
			
			//var lien = "<a href=\"ModifSiteBis2.php?OldName="+nom+"&sec="+type+"\" target=_blank id='lienModif'> Modifier Marqueur</a>";
			
		
			//var info= info + lien
			
			
			distancier();
		//	sleep(5);
			console.log("TABLEAU: "+tabInfoBulle.join());
			console.log("REPONSE: "+idCherche[0]);
			var lienDistance="<div id=distance></div>";
			console.log("REP: "+lienDistance);
			console.log("REP2: "+lienDistance);
			//console.log("ID ID: "+JSON.parse(idCherche));
			//var lienDistance = "<a href=\"testExcel/Classes/recup.php?id="+idCherche+"\" target=_self id='lienModif'>Calculer le distancier de la plaque "+PlaqueActuelle+"</a> <br>";
			//var info = "<p> TEST TEST TEST ! </p>";
			//infoWindow.setContent(lienDistance);
			// Affiche l'infobulle 
			//polyline=PlaqueActuelle;
			//var lienTIJ="<a href=\"efficienceTIJ()\">Afficher l'efficience(TIJ)</a> <br>";
			//infoWindow.setContent(lienTIJ);
			infoWindow.open(map, polyline);			
			//setTimeout("displayStreetView('"+point.lat()+"','"+point.lng()+"');",2500);
			
			// On stock ces nouvelles infobulle dans les variables infoOpened et infoOpened2 afin de pouvoir les fermer par la suite
			//infoOpened = infowindow;
			//infoOpened2 = infoWindow;
			
			
		});

});