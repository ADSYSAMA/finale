function hide_precharge() {
fenFille.document.getElementById('imagechargement').style.display='none';
}
if (window.attachEvent) { 
eval("window.attachEvent('onload',hide_precharge);"); 
}
else { 
eval("window.addEventListener('load',hide_precharge,false);"); 
}

		function nextElementSibling(el) {
			do { el = el.nextSibling } while ( el && el.nodeType !== 1 );
			return el;
		}

/*
	Cette fonction permet en cas de click sur l'une des case correspondant aux USEI (menu de droite) de faire apparaître toutes les icones de l'USEI en question
	De plus elle permet aussi une "bidirectionnalité en effet, cela permet à l'utilisateur de coché soit en premier les cases correspondantes au USEI puis après 
	les cases correspondantes aux indicateurs (menu de gauche) ou l'inverse l'effet sera le même. Un ordre d'action n'est pas recquis.
	On verifie également si dans le menu indicateur (gauche) il n'y a pas plusieurs cases de coché (si c'est le cas on doit faire apparaitre les deux indicateurs)
*/	

		function checkThreeFille(li){
			for(var i = 0 ; i < tabMarker.length; i++)
			{
				tabMarker[i].setMap(null);
			}
			var OT = fenFille.document.getElementById("ot");
			var INC = fenFille.document.getElementById("inc");
			var WO = fenFille.document.getElementById("wo");
			var cases=nextElementSibling(li.nextSibling).children;
			if(li.checked == true && OT.checked == false && INC.checked == false && WO.checked == false ){
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = true;
					}
					Envoimap(cases[i].firstChild);
		  		} 
			}
			///////////////////////////////////////////
			else if(li.checked == true && OT.checked ==true){
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = true;
					}
					Envoimap(cases[i].firstChild);
		  		} 
			}
			////////////////////////////////////////////
			else if(li.checked == true && WO.checked ==true){
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = true;
					}
					Envoimap(cases[i].firstChild);
		  		} 
			}
			///////////////////////////////////////////
			else if(li.checked == true && INC.checked ==true){
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = true;
					}
					Envoimap(cases[i].firstChild);
		  		} 
			}

			else {
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = false;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = false;
					}
					Envoimap(cases[i].firstChild);
		  		} 
			}
		}
		
		




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		

/*
	Cette fonction permet en cas de click sur l'une des case correspondant aux USEI (menu de droite) de faire apparaître toutes les icones DES PLAQUES en question
	Cette fonction marche de pair avec la fonction checkFour (plus bas dans le code) qui elle permet de gerer la bidirectionnalité entre les deux menu
*/	
		function checkTwoFille(li){
			var cases=(nextElementSibling(li.nextSibling)).children;;
			if(li.checked == true){
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
			  	} 
			}
			
			else {
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = false;
				}
			}

			Envoimap(li);
		}


		(function($){
			$(":checkbox").change(function(){
				$m=0; // initialisation du nombre de cases cochées
				$temp = $(this).parent().parent().children().length;
				$(this).parent().parent().children().each(function(){
					if ($(this).find(':first-child').prop('checked')){ // si la checkbox courante est cochée, on comptabilise
						$m++;
					}
				})
	
				if ($m == $temp){
					$(this).parent().parent().prev().prev().prop('checked', true).trigger('change');
				}
				else{
					$(this).parent().parent().prev().prev().prop('checked', false).trigger('change');
				}
			});

		})(jQuery);

					
					$(fenFille.document).ready( function () {
					
				

						// On cache tous les sous-menus sauf celui qui porte la classe "open_at_load"

						$("ul.subMenu:not('.open_at_load')").hide();
						$("ul.subMenu2:not('.open_at_load')").hide();

						// On sélectionne tous les items de la liste portant la classe "toggleSubMenu" et on remplace l'element span qu'ils contiennent par un lien
						$("li.toggleSubMenu span").each( function () {

							// On stocke le contenu du span

							var TexteSpan = $(this).text();
							$(this).replaceWith('<a href="" title="Afficher le sous-menu">' + TexteSpan + '</a>') ;
						} ) ;
	
						// On modifie l'événement "click" sur les liens dans les items de liste qui portent la classe "toggleSubMenu"

						$("li.toggleSubMenu > a").click( function () {

							// Si le sous-menu était déjà ouvert, on le referme

							if ($(this).next("ul.subMenu:visible").length != 0) {
								$(this).next("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
							}

							// Si le sous-menu est caché, on ferme les autres et on l'affiche

							else {
								$("ul.subMenu").slideUp("normal", function () { $(this).parent().removeClass("open") } );
								$("ul.subMenu2").slideUp("normal", function () { $(this).parent().removeClass("open") } );
								$(this).next("ul.subMenu").slideDown("normal", function () { $(this).parent().addClass("open") } );
							}

							// On empêche le navigateur de suivre le lien

							return false;
						});
						 $("li.toggleSubMenu2 > a").click( function () {

							// Si le sous-menu était déjà ouvert, on le referme

							if ($(this).next("ul.subMenu2:visible").length != 0) {
								$(this).next("ul.subMenu2").slideUp("normal", function () { $(this).parent().removeClass("open") } );
							}

							// Si le sous-menu est caché, on ferme les autres et on l'affiche

							else {
								$("ul.subMenu2").slideUp("normal", function () { $(this).parent().removeClass("open") } );
								$(this).next("ul.subMenu2").slideDown("normal", function () { $(this).parent().addClass("open") } );
							}

							// On empêche le navigateur de suivre le lien

							return false;
						});
					 } ) ;
					 
					 
					 
				
				var chargeOk = "false";

				function ouvrirFenFille()
				{
				setTimeout(function(){fenFille = window.open('apimaps2.php','nom_de_ma_popup','menubar=yes, scrollbars=yes, top=100, left=100, width=1000, height=200')},"500");
				
				if (chargeOk=="true")
				  {
					var data = prompt("Entrez une valeur");
					fenFille.dataF = data;
					fenFille.chaine = "ceci est un test";
					fenFille.affiche();
				  }
				 else
					console.log("fermer");
				
				}

        fenFille.document.getElementById("RangeTIJ").style.display="none";
        fenFille.document.getElementById("selRange").style.display="none";
       function ShowRangeValue(RangeValue)
        {
            fenFille.document.getElementById("selRange").innerHTML = RangeValue;
            
        }   
		
		woVal = fenFille.document.getElementById('wo');
		if(woVal.checked == true)
		{
			woVal = prompt("entrer une valeur repère pour les wo");
		}
	

	
		function checkFourFille(li)
		{
			var idf = fenFille.document.getElementById("USEI_IDF-ch");
			var ouest = fenFille.document.getElementById("USEI_OUEST-ch");
			var est = fenFille.document.getElementById("USEI_EST-ch");
		
			var cases;
			if(idf.checked == true)
			{
				cases=nextElementSibling(idf.nextSibling).children;
			}
			else if (ouest.checked == true)
			{
				cases=nextElementSibling(ouest.nextSibling).children;
			}
			else if(est.checked == true)
			{
				cases=nextElementSibling(est.nextSibling).children;					
			}
			if((li.checked == true && idf.checked == true) || (li.checked == true && ouest.checked == true) || (li.checked == true && est.checked == true))
			{
				for(i = 0; i < cases.length; i++) {
					cases[i].firstChild.checked = true;
					var souscases=(nextElementSibling(nextElementSibling(cases[i].firstChild))).children;
					for(j = 0; j < souscases.length; j++) {
						souscases[j].firstChild.checked = true;
					}
					Envoimap(cases[i].firstChild);
				} 
			}
			
		
		}
		
		
/*
	Cette fonction récursive (donc à faire en  permet de gerer la bidirectionnalité des actions de l'utilisateur, entre le les cases faisant apparaitre les sites (menu de droite) et le menu indicateur (gauche)
*/
				
					
	
		function checkFiveFille(li)//Le paramètre pris est la balise input correspondant a la case du site sur lequel on a cliqué
		{
		

			var tab = fenFille.document.getElementsByName("act[]");
			var sousTab = fenFille.document.querySelectorAll('.five');        
			
			
			
			for(var i = 0; i< sousTab.length ; i++)
			{
				var eponge = sousTab[i];
				var cases=(nextElementSibling(eponge.nextSibling)).children;
				if(sousTab[i].checked == true)
				{
					
					
				
					for(var j = 0; j < cases.length; j++) //Si on a coché une case tout les cases contenue dans le sous menu sont coché aussi
					{
							cases[i].firstChild.checked = true;
					}
						
					Envoimap(eponge);

				}
					
				else 
				{
					for(i = 0; i < cases.length; i++) 
					{
						cases[i].firstChild.checked = true;
					}


				}
				
				for(var lex = 0; lex <tabMarker.length; lex++)       //Si le clique sert à décoché on efface tous les markers correspondant à la case (et donc toutes les sous cases), présent sur la carte
				{
					tabMarker[lex].setMap(null);

				}
				
				
			}
			
			
			if(li.checked == false)
			{
				
				for(var lex = 0; lex <tabMarker.length; lex++)
				{
					if(tabMarker[lex].icon.scaledSize.height != 20 || tabMarker[lex].icon.scaledSize.width != 15)
					{
						tabMarker[lex].setMap(null);

					}
				}
				for(var a = 0; a < tab.length; a++)//Au cas ou on decoche une case dans le menu indicateur, on verifie si il n'y a pas une autre case coché dans quel cas l'indicateur décoché devra 
												   //disparaitre sur la carte mais l'autre devra rester	
				{
					if(tab[a].checked == true && tab[a]!=li) 					
					{
						checkFive(tab[a]);//Cette fonction s'appel elle même tant qu'il y a d'autre case encore coché dans le menu indicateur
					}
				}

			}
			
		}
			
			
		
			$("#fleche").click(function(){
			
				$('html,body').animate({scrollTop:0},'slow');
			
			});
		
		
			var inputElem = fenFille.document.getElementsByTagName("input");
			for(i=0;i<inputElem.length;i++){
				if(inputElem[i].getAttribute("type")=="checkbox"){
					inputElem[i].checked = false;
				}
				if(inputElem[i].checked){
					inputElem[i+1].checked=true;
				}
			}
			
		
			 
			
			 fenFille.document.write("<table>");
			 
fenFille.document.write("");
fenFille.document.write("<tr>");

var tr=0
for (var i =0; i<zone.length;i++){
	if(i!=8 && i!=9){
		if( tr%3==0 ){

			fenFille.document.write("</tr>");}
		fenFille.document.write('<td><label><img src='+zone[i][7]+'> : Plaque '+zone[i][0]);
		fenFille.document.write('<input type=\"checkbox" name="plaque[]" id='+zone[i][0]+'  onclick="afficherPlaque(this);"></label></td>');
		fenFille.document.write("");
		tr++;
		if(tr%3==0 ){fenFille.document.write("<tr>");}
	}
}	

function EnvoimapFille(val){	

	var j = 0;
	if(val == null){
		return;
	} 
	var mapselec = val.value; 

}	


