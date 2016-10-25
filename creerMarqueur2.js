function CreationDuMarqueur2(point, nom, adresse, codepostal, ville, type, nomtec, Image, i, mapselec, boutique){

	
	if(boutique == "Service"){
		icone = "img/icone/service.png";
	}
	if(boutique == "Binome"){
		icone = "img/icone/binome.png";
	}
	if(boutique == "Boutique"){
		icone = "img/icone/boutique.png";
	}
	if(boutique == "Autre"){
		icone = "img/icone/autre.png";
	}
	if(type=="IDF_75NE_93O" && boutique =="Autre"){
		icone = iconeIDF75NE93O;
	}
	if(type=="IDF_75NE_93O" && boutique =="Boutique"){
		icone = "img/icone/2-bis.png";
	}
	if(type=="IDF_75NE_93O" && boutique =="Service"){
		icone = "img/icone/2-ter.png";
	}
	if(type=="IDF_75NE_93O" && boutique =="Binome"){
		icone = "img/icone/2-quar.png";
	}
	if(type=="IDF_75NO_92N" && boutique =="Autre"){
		icone = iconeIDF75NO92N;
	}
	if(type=="IDF_75NO_92N" && boutique =="Boutique"){
		icone = "img/icone/3-bis.png";
	}
	if(type=="IDF_75NO_92N" && boutique =="Service"){
		icone = "img/icone/3-ter.png";
	}
	if(type=="IDF_75NO_92N" && boutique =="Binome"){
		icone = "img/icone/3-quar.png";
	}
	if(type=="IDF_75_SUD_EST" && boutique =="Autre"){
		icone = iconeIDF75SUDEST;}
	if(type=="IDF_75_SUD_EST" && boutique =="Boutique"){
		icone = "img/icone/4-bis.png";
	}
	if(type=="IDF_75_SUD_EST" && boutique =="Service"){
		icone = "img/icone/4-ter.png";
	}
	if(type=="IDF_75_SUD_EST" && boutique =="Binome"){
		icone = "img/icone/4-quar.png";
	}
	if(type=="IDF_75_SUD_OUEST" && boutique =="Autre"){
		icone = iconeIDF75SUDOUEST;}
	if(type=="IDF_75_SUD_OUEST" && boutique =="Boutique"){
		icone = "img/icone/5-bis.png";
	}
	if(type=="IDF_75_SUD_OUEST" && boutique =="Service"){
		icone = "img/icone/5-ter.png";
	}
	if(type=="IDF_75_SUD_OUEST" && boutique =="Binome"){
		icone = "img/icone/5-quar.png";
	}
	if(type=="IDF_77_93" && boutique =="Autre"){
		icone = iconeIDF7793;
	}
	if(type=="IDF_77_93" && boutique =="Boutique"){
		icone = "img/icone/6-bis.png";
	}
	if(type=="IDF_77_93" && boutique =="Service"){
		icone = "img/icone/6-ter.png";
	}
	if(type=="IDF_77_93" && boutique =="Binome"){
		icone = "img/icone/6-quar.png";
	}
	if(type=="IDF_78_95_92O" && boutique =="Autre"){
		icone = iconeIDF789592O;
	}
	if(type=="IDF_78_95_92O" && boutique =="Boutique"){
		icone = "img/icone/7-bis.png";
	}
	if(type=="IDF_78_95_92O" && boutique =="Service"){
		icone = "img/icone/7-ter.png";
	}
	if(type=="IDF_78_95_92O" && boutique =="Binome"){
		icone = "img/icone/7-quar.png";
	}
	if(type=="IDF_91_94" && boutique =="Autre"){
		icone = iconeIDF9194;
	}
	if(type=="IDF_91_94" && boutique =="Boutique"){
		icone = "img/icone/8-bis.png";
	}
	if(type=="IDF_91_94" && boutique =="Service"){
		icone = "img/icone/8-ter.png";
	}
	if(type=="IDF_91_94" && boutique =="Binome"){
		icone = "img/icone/8-quar.png";
	}
	if(type=="IDF_92_SUD" && boutique =="Autre"){
		icone = iconeIDF92SUD;
	}
	if(type=="IDF_92_SUD" && boutique =="Boutique"){
		icone = "img/icone/9-bis.png";
	}
	if(type=="IDF_92_SUD" && boutique =="Service"){
		icone = "img/icone/9-ter.png";
	}
	if(type=="IDF_92_SUD" && boutique =="Binome"){
		icone = "img/icone/9-quar.png";
	}
	if(type=="IDF_Les_Portes_dArcueil" && boutique =="Autre"){
		icone = iconeIDFLesPortesdArcueil;
	}
	if(type=="IDF_Les_Portes_dArcueil" && boutique =="Boutique"){
		icone = "img/icone/10-bis.png";
	}
	if(type=="IDF_Les_Portes_dArcueil" && boutique =="Service"){
		icone = "img/icone/10-ter.png";
	}
	if(type=="IDF_Les_Portes_dArcueil" && boutique =="Binome"){
		icone = "img/icone/10-quar.png";
	}
	/*if(type=="USEI_EST" && boutique =="Autre"){
		icone = iconeUSEIEST;
	}
	if(type=="USEI_EST" && boutique =="Boutique"){
		icone = "img/icone/11-bis.png";
	}
	if(type=="USEI_EST" && boutique =="Service"){
		icone = "img/icone/11-ter.png";
	}
	if(type=="USEI_EST" && boutique =="Binome"){
		icone = "img/icone/11-quar.png";
	}
	if(type=="USEI_OUEST" && boutique =="Autre"){
		icone = iconeUSEIOUEST;
	}
	if(type=="USEI_OUEST" && boutique =="Boutique"){
		icone = "img/icone/12-bis.png";
	}
	if(type=="USEI_OUEST" && boutique =="Service"){
		icone = "img/icone/12-ter.png";
	}
	if(type=="USEI_OUEST" && boutique =="Binome"){
		icone = "img/icone/12-quar.png";
	}*/
	
	var image = {
					url: icone,
					scaledSize: new google.maps.Size(15,20)
				};


/***********************************************************************************************
*																							   *
*  Aggrandisement d'un markeur en fonction de l'activite (nombre d'incident dans chaque zone)  *				 	
*																							   *
************************************************************************************************/

//Fonction Ajax servant à aller chercher dans le script PHP ActiviteINC un array avec comme clé TYPETICKET, CODESITE et COMPTAGE.
//Cet Array est fourni en interrogeant une base de données (la table activite plus précisement).
//Cet Array contient le nombres (COMPTAGE) d'incident (TYPETICKET == INC) qu'il y a eu dans toute les zones (CODESITE).
 
	$.ajax({
		url: "ActiviteOT.php",
		type:"GET",
		success:function(reponse)
		{
		
			var res = JSON.parse(reponse);
			 //a completer demain...
			 //alert(res.length);//Affiche 351, la boite de dialogue est afficher autant de fois qu'il y a d'icone qui s'affichent OK !
			 //console.log(res[0].CODESITE);// Affiche 1
			 //console.log(nom);
			for(var i =0; i<res.length; i++)
			{
					//Si il y a eu plus de 200 incident dans une certaine zone, la taille de l'icône sera plus grande.
					if(nom == res[i].CODESITE && res[i].COMPTAGE > 500) 
					{
						// console.log(res[i].CODESITE);
						// console.log(res[i].COMPTAGE);
						image.scaledSize.height=30; 
						image.scaledSize.width=40;
					}
			}	
					 
		},
		//J'ai annulé le paradigme asynchrone du AJAX car le script ne se faisant pas séquentiellement, l'affichage de l'icone se 
		//fera toujours selon la definition de la variable image (à la ligne 350). Cela implique un lourd ralentissement lors du 
		//chargement des icônes, une solution devra donc être trouvé.
		
		async: false
	 
			
		
	

  });


	var shadow = "img/icone/mm_20_shadow.png";
	var marker = new google.maps.Marker({
		map: map,
		position: point,
		icon: image
	}); 
	marker.mycategory=nom;
	google.maps.event.addListener(marker, 'click', function(latlng){
		var info="<b><u><a href=\"site.php?site="+nom+"\" target=_blank>"+nom+"</a></u></b><br/>"  + adresse + "<br/>" + codepostal + " " + ville + "<br/>" + "Technicien sur site : " + nomtec + "<br/><div id='streetView' style='width: 500px; height: 250px; text-align:center'>Street View en cours de chargement ...</div>";
		infoWindow.setContent(info);
		infoWindow.open(map, marker);
		setTimeout("displayStreetView('"+point.lat()+"','"+point.lng()+"');",2500);
	});

	overlays.push(marker);
	if (mapselec != type){
		Markers[j] = marker;
		j++;
	}
	return marker;
}



function Envoimap2(val){
	var j = 0;
	if(val == null){
		return;
	} 
	var mapselec = val.value; 

	

	if(val.checked == true){
		downloadUrl(urlXml+"?"+Math.random(), function(data){
			var xml = xmlParse(data);
			var markers = xml.getElementsByTagName("marker");
			for (var i = 0; i < markers.length; i++){ 
				var type = markers[i].getAttribute("Zone"); 
				var nom = markers[i].getAttribute("Nom"); 
				var USEI = markers[i].getAttribute("USEI");
				


				if(type == mapselec || nom == mapselec || USEI == mapselec){ 
					var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")));
					var lat = parseFloat(markers[i].getAttribute("lat"));
					var lng = parseFloat(markers[i].getAttribute("lng"));
					var nom = markers[i].getAttribute("Nom"); 
					var adresse = markers[i].getAttribute("adresse"); 
					var codepostal = markers[i].getAttribute("codepostal"); 
					var ville = markers[i].getAttribute("ville"); 
					var type = markers[i].getAttribute("Zone"); 
					var nomtec = markers[i].getAttribute("nomtec");
					var Image = markers[i].getAttribute("Image");
					var boutique = markers[i].getAttribute("type");
					if ((markers[i].getAttribute("lat") != 0) || (markers[i].getAttribute("lng") != 0)){
						var marker = CreationDuMarqueur2(point, nom , adresse, codepostal, ville, type, nomtec, Image, i, mapselec, boutique);
						marker.setMap(map);
					} 
				} 
			}	
		}); 
	} 
