function nouveauPolygon()
{
	plaquePos=[];//Tableau qui contiendra les positions [latitude, longitude] de chaque site contenu dans une plaque donnée
	plaqueMark=[];//Tableau qui contiendra les données de chaque marqueur symbolisant les differents sites  d'une plaque donnée
	//Ces deux tableau representes les données concernant les marqueur contenu dans une plaque après modification.
	kTabNew=[];
	jTabNew=[];
	plaqueIntermediaire = [];// Ce tableau contiendra tout les nouveau marqueur (uniquement) ajouté dans une plaque, on l'obtiens en faisant "la soustraction" de la plaque modifié et de la plaque de départ
	j5=0;
	jo=0;
	n=0;
	
	for(var i = 0; i< tabPolyline.length; i++) //On cherche le chiffre désignant la plaque, par ex : IDF_75_SUD_EST est la 3e ligne dans la bdd donc i = 2 pour passer
	{	
		if(tabPolyline[i].getEditable())//Si on a cliqué sur la plaque 
		{	
			for(var Z =0; Z<zone.length;Z++) //et qu'on la modifié....
			{		
				if(tabPolyline[i].html==zone[Z][0]&&Z!=8&&Z!=9)// car 8 et 9 representent les plaques ouest et est, dont les positions sont dans tabEstOuest créé dans function.js
				{
					for(var j = 0; j<tabZone2.length; j++) // tableau de marker de chaque plaque
					{
							
						if(google.maps.geometry.poly.containsLocation(tabMarker[j].position, tabPolyline[i]))//Si un marqueur est contenu dans la plaque courante 
						{//Si on ne fait pas apparaitre les marqueur sur la carte on ne rentre pas dans la conditions donc il faut les faire apparaitre pour entrer dans le IF							
							
							for(k = 0; k < tabIDF.length; k ++)
							
							{
								if(tabIDF[k].lng()==tabMarker[j].position.B && tabIDF[k].lat()==tabMarker[j].position.k)
								{
	//
									kTab.push(k);								// on stock les variable k et j car elles se repetent dans la boucle donnant lieu a des doublons 
									jTab.push(j);								 //qui gene ma condition qui verifie la taille de plaqueMark et de plaquePos, on elimine les doublons 				
								}
							}
							for (var k1 = 0; k1 < tabIDF.length; k1++)
							{
								plaquePos[j5] = tabIDF[k1];
								//parseFloat(plaquePos);
							}	//On remplit le tableau de position avec la position de chaque marqueur de la plaque en cours
									
							for ( var j11=0;  j11 < tabMarker.length; j11++)
							{	
								plaqueMark[j5] = tabMarker[j11];
								//parseFloat(plaqueMark);
							}	//pareil mais avec les données des marqueurs
						}
					}
					
					for(var V=0; V<zone.length;V++) //boucle pour trouver la plaque manipulé
					{
						if(tabPolyline[i].html == zone[V][0]) //Si on trouve la plaque manipulé on entre dans la condition
						{

							for (var m=0; m <  plaqueMark.length; m++)
							{
								
								if(plaqueMark.length != tabTab2[V].length)//Si l'un des marqueur de la nouvelle plaque (plaqueMark) n'est pas contenu dans la plaque de base (tab_IDF_75NE_93O)
								{
									//On recupere toutes les données concernant les nouveau marqueur contenue
									plaqueIntermediaire1 = [5];
									plaqueMark[m].html[2] = zone[V][1];
									plaqueIntermediaire1[0] = plaqueMark[m].html;
									plaqueIntermediaire1[1] = plaqueMark[m].position.B;
									plaqueIntermediaire1[2] = plaqueMark[m].position.k;
									plaqueIntermediaire1[3] = zone[V][8]; //convert(zone[V][0]);
									plaqueIntermediaire1[4] = plaqueMark[m].html[3];
									plaqueIntermediaire[jo] = plaqueIntermediaire1;//ce tableau contiendra autant de case qu'il y a de marqueur, pour chaque marqueur on a un tableau a quadruple dimension
									jo++;
								}
							}

						if(plaqueMark.length < tabTab2[V].length)//Si on rétréci une plaque
						{
							$.ajax({
							
							type: 'post',
							url: 'modifSiteGraphiquementV.php',//pour retrecir une plaque
							data:{'nouveau': plaqueIntermediaire},//on envoie le tableau au PHP afin de mettre à jour les bases			
							success: function(reponse)
							{ 
								// window.setTimeout("window.location.href = window.location.href", 500);
								$.post('modifTIJ.php',
							{
								
							},
							function(){
							alert("ok retreci");
							
							} );
	
							}});
						}
					
						if(plaqueMark.length > tabTab2[V].length)//Si on agrandi une plaque
						{  
						
							$.ajax({
							
							type: 'post',
							url: 'modifSiteGraphiquement.php',//pour agrandir une plaque
							data:{'nouveau': plaqueIntermediaire},//on envoie le tableau au PHP afin de mettre à jour les bases			
							success: function(reponse)
							{ 
								
								window.setTimeout("window.location.href = window.location.href", 500);
							}});
							

						if(plaqueMark.length > tabTab2[V].length)//Si on agrandi une plaque
						{  
							
							$.ajax(
						{
							type: 'post',
							
							url: 'modifActiviteGraphiquement.php',
							data:{'nouveau': plaqueIntermediaire},		
							success: function(reponse)
							{ 
								// 
								alert("ok agrandi");
							
							}
						});
							
						}
						}
	
						//Redefini ensuite les plaques par rapport aux nouveaux marqueurs qui ont été mis à jour dans la bdd
						calculateConvexHull(plaquePos,zone[V][2],zone[V][0]);

						//history.go(0);
						}
					}
			
			
				}
				else if(tabPolyline[i].html==zone[Z][0]&&(Z==8||Z==9))//pour  zone ouest et est
				{
					
					for(var j = 0; j<tabMarker.length; j++)
					{

						if(google.maps.geometry.poly.containsLocation(tabMarker[j].position, tabPolyline[i]))//Si un marqueur est contenu dans la plaque courante
						{
							
							for(var k = 0; k < tabEstOuest.length; k ++)
							{
								
								if(tabEstOuest[k].lng()==tabMarker[j].position.D && tabEstOuest[k].lat()==tabMarker[j].position.k)
								{	kTabOE.push(k);								// on stock les variable k et j car elles se repetent dans la boucle donnant lieu a des doublons 
									jTabOE.push(j);								 //qui gene ma condition qui verifie la taille de plaqueMark et de plaquePos, on elimine les doublons 				
									var kTabOENew=cleanArray(kTabOE); 					//avec cleanArray()
									var jTabOENew=cleanArray(jTabOE);
									
								}
							}
							for (var k1 = 0; k1 < kTabOENew.length; k1++){ //
							plaquePos[j5] = tabEstOuest[kTabOENew[k1]];
							}//On remplie le tableau de position avec la position de chaque marqueur de la plaque en cours
							

							for ( var j11=0;  j11 < jTabOENew.length; j11++){//
							plaqueMark[j5] = tabMarker[jTabOENew[j11]];}//pareil mais avec les données des marqueurs
							j5++;
							
						}
					}
				
				
					for(  var V=0; V<zone.length;V++)
					{
						if(tabPolyline[i].html == zone[V][0])
						{
							
						if (plaqueMark.length==tabTab2[V].length){
							
						// window.setTimeout("window.location.href = window.location.href", 500);
					}
			
						for (var m=0; m <  plaqueMark.length; m++) 
							{	
			
								if(plaqueMark.length != tabTab2[V].length)//Si l'un des marqueur de la nouvelle plaque (plaqueMark) n'est pas contenu dans la plaque de base (tab_IDF_75NE_93O)
								{
								
									//On recupere toutes les données concernant les nouveau marqueur contenue
									plaqueIntermediaire1 = [5];
									plaqueMark[m].html[2] = zone[V][1];
									plaqueIntermediaire1[0] = plaqueMark[m].html;
									plaqueIntermediaire1[1] = plaqueMark[m].position.B;
									plaqueIntermediaire1[2] = plaqueMark[m].position.k;
									plaqueIntermediaire1[3] = zone[V][8]; //convert(zone[V][0]);
									plaqueIntermediaire1[4] = plaqueMark[m].html[3];
									plaqueIntermediaire[jo] = plaqueIntermediaire1;//ce tableau contiendra autant de case qu'il y a de marqueur, pour chaque marqueur on a un tableau a quadruple dimension
									jo++;
								}
							}
							
//_______________________________________________________________________________________________________________________________
                            
							if(plaqueMark.length < tabTab2[V].length)
							{
                                
								alert("Rétrécissement SUD OUEST...");
                                // document.getElementById("Chargement").innerHTML="<img src='image/img/load.gif' />";
								$.ajax(
								{
									type: 'post',
									url: 'modifSiteGraphiquementV.php',
									data:{'nouveau': plaqueIntermediaire},//on envoie le tableau au PHP afin de mettre à jour les bases			
									success: function(reponse)
									{
									
									window.setTimeout("window.location.href = window.location.href", 500);
									//alert(reponse);
							
									}
								});
							}
							
//_______________________________________________________________________________________________________________________________
                            
                            
							if(plaqueMark.length > tabTab2[V].length)
							{
								
								alert("Agrandissement  SUD OUEST...");
                                // document.getElementById("Chargement").innerHTML="<img src='image/img/load.gif' />";
								$.ajax(
								{
									type: 'post',
									url: 'modifSiteGraphiquement.php',
									data:{'nouveau': plaqueIntermediaire},//on envoie le tableau au PHP afin de mettre à jour les bases			
									success: function(reponse)
									{ 
										
										// window.setTimeout("window.location.href = window.location.href", 500);
										//alert(reponse);
									}
								});
							}
							
							
							//Meme procédé sauf que la c'est pour mettre à jour les bases des indicateurs
							$.ajax(
							{
								type: 'post',
								url: 'modifActiviteGraphiquement.php',
								data:{'nouveau': plaqueIntermediaire},		
								success: function(reponse)
								{ 
									
									alert("bien envoyé Veuillez attendre l'actualisation automatiqueAAAA...");
									//alert(reponse);
								}
								
							});
							
							tabPolyline[i].setMap(null);
							tabPolyline[i].setMap(null);
							
							//Redefini ensuite les plaques par rapport aux nouveaux marqueurs qui ont été mis à jour dans la bdd
							calculateConvexHull(plaquePos,zone[V][2],zone[V][0]);
							//history.go(0);	}
							
						}
					}
				}
			}
		}
    }
}
