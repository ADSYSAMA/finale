var map;
var iconeESSAI1;
var iconeIDF75NE93O;
var iconeIDF75NO92N;
var iconeIDF75SUDEST;
var iconeIDF75SUDOUEST;
var iconeIDF7793;
var iconeIDF789592O;
var iconeIDF9194;
var iconeIDF92SUD;
var iconeIDFLesPortesdArcueil;

var infoWindow;     // variable pour créer les infobulles   
var infoOpened;    // variable pour gérer l'ouverture/fermeture des infobulles                                                              
var infoOpened2;  // variable pour gérer l'ouverture/fermeture des infobulles                                                               

var tab_mark=[];
var Markers = [];   
var j = 0;
var h = 0;
var tabPolyline = [];
var tabZonePoly = [];
var tabMarker = [];
var j2 = 0;
var j3 = 0;
var j6 = 0;
var a = 0;

var urlXml = "data.xml";
var ToutesLesBalisesInput = [];
var overlays =  []; // Global array to store marker
var points = [];
var hullPoints = [];
var tabMarkerIndicateur = [];
var polyline;

var IDF_75_SUD_EST = [] ;
var IDF_77_93 = [] ;
var IDF_75NE_93O = [] ;
var IDF_LES_PORTES_D_ARCUEIL = [] ;
var IDF_75NO_92N = [] ;
var IDF_75_SUD_OUEST = [] ;
var IDF_91_94 = [] ;
var IDF_78_95_92O = [] ;
var IDF_92_SUD = [] ;
var tabIDF;
var useiEst = [];
var useiOuest = [];
var sansZone = [];




var valeurWO;
var valeurOT;
var valeurINC;
var valeurJrOuvre;
var attenteWO = 0;
var attenteOT = 0;
var attenteINC = 0;
var nbrJour = 0;
var indiceMarker=0;


var tab_IDF_75NE_93O = [];
var tab_IDF_75NO_92N = [];  
var tab_IDF_75_SUD_OUEST = [];
var tab_IDF_91_94 = [];
var tab_IDF_78_95_92O = [];
var tab_IDF_92_SUD = []; 
var tab_IDF_75_SUD_EST = [];
var tab_IDF_77_93 = [];
var tab_IDF_LES_PORTES_D_ARCUEIL = [];
var tab_SANS_ZONE = [] ;


var zone=[];// zone[0][0]="nom de la plaque"; zone[0][1]="id"; zone[0][2]="couleur plaque".... verifier CreerVar.php pour mieux comprendre
var tabZone={};// objet creer pour pouvoir creer des tableaux dynamiquement et d'eviter  les var IDF_75_SUD_EST = [] ;var IDF_75_SUD_OUEST = [] ;...
var tabTab={};// objet creer pour pouvoir creer des tableaux dynamiquement et d'eviter  les var tab_IDF_75NE_93O = []; var tab_IDF_75NO_92N = []; ...
var tabZone2=[];// tableaux qui va recueillir les tableaux provenant des objet plus haut, pour une manipulation plus facile.
var tabTab2=[];


var fonctionTIJ;








    $.ajax({
                
                url:"creerVar.php",
                
                type:"GET",

                async: false,               
                                
                success: function(reponse){//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
                
                     var json = jQuery.parseJSONres= JSON.parse(reponse);
                    for (var i=0; i<json.length; i++){
                        zone.push(json[i]);
                        tabZone[zone[i][0]]=[];
                        tabTab[zone[i][0]]=[];
                    }
            },

                        

                        });                 
                        
                        
// remplissage des tableaux avec des tabelaux provenant des objet tabZone et tabTab
for( var i = 0; i<zone.length; i++){
    tabZone2.push((tabZone[zone[i][0]]));}
    
for( var i = 0; i<zone.length; i++){
    tabTab2.push((tabTab[zone[i][0]]));}
                

function depart ()
{
        //alert("Toutes les plaques et tous les marqueurs sans zones sont affichés ");
        cocherToutesPlaques2();
        cocherPlaque();
        
        for (var i=0;i<zone.length;i++)
        {
            if(zone[i][0]!='USEI_OUEST' && zone[i][0]!='USEI_EST' && zone[i][0] != 'SANS_ZONE')
            {
                if(tabZone2[i].length==0)
                {i++}
                
                // console.log("val: "+tabZone2[i])
                calculateConvexHull(tabZone2[i],zone[i][2] , zone[i][0]); //evite erreur si on a un plaque vide comme sans_zone par exemple
            }
}
        document.getElementById("SANS_ZONE-ch").checked=true
        Envoimap(document.getElementById( "SANS_ZONE-ch"))// affiche les marqueurs sans zones
        checkTwo(document.getElementById( "SANS_ZONE-ch"))// coches les sites de SANS_ZONE
        
    
        }



function cocherToutesPlaques2 ()
{
    var plaques = document.getElementsByName("plaque[]");
    for( var ip = 0; ip<plaques.length; ip++)
    {
        if(plaques[ip].id != 'SANS_ZONE')
        {
            plaques[ip].checked=true;
        }
    }
}
                                
function cocherPlaque () {
     document.getElementById('Plaque').checked=true;}
                


$(function icone(){                                                         
    $("input[name='icone[]']").click(function(){
        checkFive(this);
    });
});


$(function changerValeurWO(){  
    $("#wo").click(function(){
        if(attenteWO/2 == Math.round(attenteWO/2))
        {   
            var nb = prompt("Entrer la valeur repère pour les WO");
            if(isNaN(nb))
            {
                alert("Vous devez rentrer un nombre pour afficher les marqueurs en fonction des WO");
            }
            else
            {
                valeurWO = nb;  
            }
        $("#wo").next().text(" : "+valeurWO);

        }
        else
        {
            $("#wo").next().text('('+wo.value+')');
        }
        
        attenteWO = attenteWO + 1;
        
        if(valeurWO===undefined || valeurWO===null || valeurWO==="" )
        {
            $("#wo").next().text(" : Valeur incorrect");
        }
        else
        {
            checkFive(this);
        }
    });
});



$(function changerValeurOT(){
    $("#OT").click(function(){
        if(attenteOT/2 == Math.round(attenteOT/2))
        {
            var nb = prompt("Entrer la valeur repère pour les OT");
            if(isNaN(nb))
            {
                alert("Vous devez rentrer un nombre pour affiché les marqueurs en fonction des OT");
            }
            else
            {
                valeurOT = nb;  
            }
        $("#OT").next().text(" : "+valeurOT);

        }
        else
        {
            $("#OT").next().text("("+ot.value+")");
        }
        attenteOT = attenteOT + 1;
        if(valeurOT===undefined || valeurOT===null || valeurOT==="")
        {
            $("#OT").next().text(" : Valeur incorrect");
        }
        else
        {
            checkFive(this); 
        } 
    });
});

$(function changerValeurINC(){
    $("#inc").click(function(){
        if(attenteINC/2 == Math.round(attenteINC/2))
        {   
            var nb = prompt("Entrer la valeur repère pour les INC");
            if(isNaN(nb))
            {
                alert("Vous devez rentrer un nombre pour affiché les marqueurs en fonction des INC");
            }
            else
            {
                valeurINC = nb; 
            }
        
        $("#inc").next().text(" : "+valeurINC);

        }
        else{
            $("#inc").next().text("("+inc.value+")");
        }
        attenteINC = attenteINC + 1;
        
        if(valeurINC===undefined || valeurINC===null || valeurINC==="" )
        {
            $("#inc").next().text(" : Valeur incorrect");
        }
        else
        {
            checkFive(this); 
        }
        
    });
});



$(function nbrJourOuvres2(){ //POUR LE CLIQUE SUR UNE PLAQUE QUI AFFICHE TON TIJ
    
    $("#jrOuvre2").click(function(){
        
        if ($("input[id='jrOuvre2']").is(':checked'))   
        {
            var nb = prompt("Entrer le nombre de jours ouvrés");
            if(isNaN(nb))
            {
                alert("Vous devez rentrer un nombre de jours ouvrés");
                document.getElementById("jrOuvre2").checked = false;  // on décoche la case  
                valeurJrOuvre = "";
                document.getElementById("tij").style.display ="none";
            }
            else
            {
                var nombreDeCaseCoche = 0;
                var cases = document.getElementsByName('plaque[]'); 
                for(var i=0; i<cases.length; i++)
                {
                    if(cases[i].checked == true)   
                    {
                        valeurJrOuvre = nb;  
                        nombreDeCaseCoche = nombreDeCaseCoche + 1;  //on compte le nombre plaque affiché
                        $.ajax({

                        url:"activite/activiteRapport.php",

                        type:"GET", 
                        success: function(reponse)//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
                        {
                            var res = JSON.parse(reponse);
                            for(var i=0 ; i<res.length ; i++)
                            {
                                var TIJ = res[i].COMPTAGE_TYPETICKET / res[i].COMPTAGE_NOM / parseInt(valeurJrOuvre);
                            }
                        }});
                    }
                }
                if(nombreDeCaseCoche == 0) // si aucune plaque n'est affiché alors on exécute la suite
                {
                    alert('Veuillez selectionner au moins une plaque');
                    document.getElementById("jrOuvre").checked = false;  // on décoche la case   
                    valeurJrOuvre = "";
                    document.getElementById("tij").style.display ="none";
                }
                

                if(valeurJrOuvre===undefined || valeurJrOuvre===null || valeurJrOuvre==="" )     
                {
                    document.getElementById("jrOuvre2").checked = false;  
                    $("#jrOuvre2").next().text("");
                    document.getElementById("tij").style.display ="none";
                }
                        
            }
            $("#jrOuvre2").next().text(valeurJrOuvre);
        }
        
        else
        {
            $("#jrOuvre2").next().text("");
            document.getElementById("tij").style.display ="none";
            for(var p = 0; p<tabPeriode.length ; p++)//
            {
                    //clearInterval(periode);
                    clearInterval(tabPeriode[p]); //Arret de la repetition de la fonction clignote
                    tabPolyline[p].setVisible(true);
            }
        }
})
});

//_____________________________________________________________________________________________

$(function nbrJourOuvres3(){ //Pour la balise INPUT RANGE
    
    $("#jrOuvre3").click(function(){
        
        if ($("input[id='jrOuvre3']").is(':checked'))   
        {
            var nb = prompt("Entrer le nombre de jours ouvrés");
            if(isNaN(nb))
            {
                alert("Vous devez rentrer un nombre de jours ouvrés");
                document.getElementById("jrOuvre3").checked = false;  // on décoche la case  
                valeurJrOuvre = "";
                document.getElementById("RangeTIJ").style.display="none";
                document.getElementById("selRange").style.display="none";
                document.getElementById("RangePlaqueClignotante").innerHTML="";
            }
            else
            {
                var nombreDeCaseCoche = 0;
                var cases = document.getElementsByName('plaque[]'); 
                for(var i=0; i<cases.length; i++)
                {
                    if(cases[i].checked == true)
                    {
                        valeurJrOuvre = nb;  
                        nombreDeCaseCoche = nombreDeCaseCoche + 1;  //on compte le nombre plaque affiché
                        $.ajax({

                        url:"activite/activiteRapport.php",

                        type:"GET", 
                        success: function(reponse)//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
                        {
                            var res = JSON.parse(reponse);
                            var TIJmin = res[0].COMPTAGE_TYPETICKET / res[0].COMPTAGE_NOM / parseInt(valeurJrOuvre);
                            var TIJmax = res[0].COMPTAGE_TYPETICKET / res[0].COMPTAGE_NOM / parseInt(valeurJrOuvre);
                            for(var i=0 ; i<res.length ; i++)
                            {
                                var TIJ = res[i].COMPTAGE_TYPETICKET / res[i].COMPTAGE_NOM / parseInt(valeurJrOuvre);
                                if(TIJ <= TIJmin)
                                {
                                    TIJmin = TIJ;
                                }
                                if(TIJ >= TIJmax)
                                {
                                    TIJmax = TIJ;
                                }
                            }
                            document.getElementById("RangeTIJ").setAttribute("min",TIJmin.toFixed(2));
                            document.getElementById("RangeTIJ").setAttribute("max",TIJmax.toFixed(2));
                            document.getElementById("RangeTIJ").style.display="block";
                            document.getElementById("selRange").style.display="block";
                        }});
                    }
                }
                if(nombreDeCaseCoche == 0) // si aucune plaque n'est affiché alors on exécute la suite
                {
                    alert('Veuillez selectionner au moins une plaque');
                    document.getElementById("jrOuvre2").checked = false;  // on décoche la case   
                    valeurJrOuvre = "";
                    document.getElementById("RangeTIJ").style.display="none";
                    document.getElementById("selRange").style.display="none";
                    document.getElementById("RangePlaqueClignotante").innerHTML="";
                }
                

                if(valeurJrOuvre===undefined || valeurJrOuvre===null || valeurJrOuvre==="" )     
                {
                    document.getElementById("jrOuvre2").checked = false;  
                    $("#jrOuvre2").next().text("");
                    document.getElementById("RangeTIJ").style.display="none";
                    document.getElementById("selRange").style.display="none";
                    document.getElementById("RangePlaqueClignotante").innerHTML="";
                }
                        
            }
            $("#jrOuvre3").next().text(valeurJrOuvre);
        }
        
        else
        {
            $("#jrOuvre3").next().text("");
            for(var p = 0; p<tabPeriode.length ; p++)//
            {
                    //clearInterval(periode);
                    clearInterval(tabPeriode[p]); //Arret de la repetition de la fonction clignote
                    tabPolyline[p].setVisible(true);
            }
            document.getElementById("RangeTIJ").style.display="none";
            document.getElementById("selRange").style.display="none";
            document.getElementById("RangePlaqueClignotante").innerHTML="";
        }
})
});

//______________________________________________________________________________________________________
$(function  nbrJourOuvres(){ //POUR LE SELECT
    $("#jrOuvre").click(function(){
        
        if ($("input[id='jrOuvre']").is(':checked'))   
        {
            var nb = prompt("Entrer le nombre de jours ouvrés");
            if(isNaN(nb) || nb===undefined || nb===null || nb==="" )
            {
                alert("Vous devez rentrer un nombre de jours ouvrés");
                document.getElementById("jrOuvre").checked = false;  // on décoche la case  
                valeurJrOuvre = "";   $("#S1").hide();
                document.getElementById("Afficheplaque2").innerHTML="";
            }
            else
            {
                var nombreDeCaseCoche = 0;
                var cases = document.getElementsByName('plaque[]'); 
                for(var i=0; i<cases.length; i++)
                {
                    if(cases[i].checked == true)   
                    {
                        nombreDeCaseCoche = nombreDeCaseCoche + 1;  //on compte le nombre plaque affiché
                        valeurJrOuvre = nb;
                        $.ajax({
                
                        url:"activite/activiteRapport.php",

                        type:"GET", 
                        success: function(reponse)//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
                        {
                            var res = JSON.parse(reponse);
                            for(var p = 0; p<tabPeriode.length ; p++)//
                            {
                                    clearInterval(tabPeriode[p]); //Arret de la repetition de la fonction clignote
                                    tabPolyline[p].setVisible(true);
                            }

                            for(var i=0 ; i<res.length ; i++)
                            {
                                var TIJ = res[i].COMPTAGE_TYPETICKET / res[i].COMPTAGE_NOM / parseInt(valeurJrOuvre);
                                document.getElementById("S1").options[i+1].text = TIJ.toFixed(2);
                            }
                            document.getElementById("S1").style.display="block";
                        }

                        });
                    }
                }
                if(nombreDeCaseCoche == 0) // si aucune plaque n'est affiché alors on exécute la suite
                {
                    alert('Veuillez selectionner au moins une plaque');
                    document.getElementById("jrOuvre").checked = false;  // on décoche la case   
                    valeurJrOuvre = "";  $("#S1").hide();       
                }
                
                        
            }
            $("#jrOuvre").next().text(valeurJrOuvre);
        }
        
        else
        {
            $("#jrOuvre").next().text("");
            $("#S1").hide(); document.getElementById("AffichePlaque2").innerHTML="";
            for(var p = 0; p<tabPeriode.length ; p++)//
            {
                    //clearInterval(periode);
                    clearInterval(tabPeriode[p]); //Arret de la repetition de la fonction clignote
                    tabPolyline[p].setVisible(true);
            }
        }


    });
});



function creationTableauMarkerTotal()
{
    tabIDF = [];

    var j4 = 0;
    
    for (var i=0; i<tabZone2.length;i++){
        for(var j=0; j<tabZone2[i].length;j++){
            if(i!=8&&i!=9){
            tabIDF[j4]=tabZone2[i][j];  // on rempli le tableau tabIDF avec toutes les positions des marqueurs de l'ile de france
            j4++;}
        }}
        
        
        
    tabEstOuest =[]
    var j10=0;
    for (var i=0; i<tabZone2.length;i++){
        for(var j=0; j<tabZone2[i].length;j++){ // on rempli le tableau tabEstOuest avec toutes les positions des marqueurs de l'est et de l'ouest
            if(i==8||i==9){
            tabEstOuest[j10]=tabZone2[i][j];
            j10++;}
        }}
            
    

    
}



var selectedShape;

function initialize(){ 

    ToutesLesBalisesInput = document.querySelectorAll(".subMenu.toggleSubMenu"); 


    iconeIDF75NE93O = "image/img/icone/1.png";

    iconeIDFLesPortesdArcueil = "image/img/icone/2.png";

    iconeIDF75NO92N = "image/img/icone/3.png";

    iconeIDF75SUDEST = "image/img/icone/4.png";

    iconeIDF75SUDOUEST = "image/img/icone/5.png";

    iconeIDF7793 = "image/img/icone/6.png";

    iconeIDF789592O = "image/img/icone/7.png";

    iconeIDF9194 = "image/img/icone/8.png";

    iconeIDF92SUD = "image/img/icone/9.png";

    iconeUSEIOUEST = "image/img/icone/autre.png";

    iconeUSEIEST = "image/img/icone/autre.png";
    
     


    



var mapOptions = {
            zoom: 12,
            center: new google.maps.LatLng(48.856666, 2.350987),
            scaleControl: true,
            overviewMapControl: true,
            overviewMapControlOptions:{opened:true},
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDoubleClickZoom: true,
            streetViewControl: false
    };
    map = new google.maps.Map(document.getElementById("EmplacementDeMaCarte"), mapOptions);

  
  
    infoWindow = new google.maps.InfoWindow();
    google.maps.event.addListener(map, 'click', clearSelection);


                    // CONTEXT MENU 
google.maps.event.addListener(map, "dblclick",function(event){showContextMenu(event.latLng);});

 function showContextMenu(caurrentLatLng) {
         var projection;
         var contextmenuDir;
         var titre= " <b><p>Création de Site</p></b>" ;
         //projection = map.getProjection() ;
         $('.contextmenu').remove();
          contextmenuDir = document.createElement("div");
           contextmenuDir.className  = 'contextmenu';
           contextmenuDir.innerHTML = titre + '<a href = "Ajouter.php" id="menu2"><div class="context"> Ajouter Site <\/div><\/a>'

         $(map.getDiv()).append(contextmenuDir);
      
         setMenuXY(caurrentLatLng);

         contextmenuDir.style.visibility = "visible";
        }
        
 function getCanvasXY(caurrentLatLng){
       var scale = Math.pow(2, map.getZoom());
      var nw = new google.maps.LatLng(
          map.getBounds().getNorthEast().lat(),
          map.getBounds().getSouthWest().lng()
      );
      var worldCoordinateNW = map.getProjection().fromLatLngToPoint(nw);
      var worldCoordinate = map.getProjection().fromLatLngToPoint(caurrentLatLng);
      var caurrentLatLngOffset = new google.maps.Point(
          Math.floor((worldCoordinate.x - worldCoordinateNW.x) * scale),
          Math.floor((worldCoordinate.y - worldCoordinateNW.y) * scale)
      );
      return caurrentLatLngOffset;
   
        }
        
 function setMenuXY(caurrentLatLng){
     var mapWidth = $('#map_canvas').width();
     var mapHeight = $('#map_canvas').height();
     var menuWidth = $('.contextmenu').width();
     var menuHeight = $('.contextmenu').height();
     var clickedPosition = getCanvasXY(caurrentLatLng);
     var x = clickedPosition.x ;
     var y = clickedPosition.y ;

      if((mapWidth - x ) < menuWidth)//if to close to the map border, decrease x position
          x = x - menuWidth;
     if((mapHeight - y ) < menuHeight)//if to close to the map border, decrease y position
         y = y - menuHeight;

     $('.contextmenu').css('left',x  );
     $('.contextmenu').css('top',y );
     };
     //fin context menu

google.maps.event.addListener(map, "click",function(event){// fermer menu 
    var c= document.getElementsByClassName('contextmenu');
        for (var i=0; i<c.length;i++){
            c[i].style.display='none';} 
            })




    if(ToutesLesBalisesInput != null){ 
        for(var i = 0; i < ToutesLesBalisesInput.length; i++){ 
            if(ToutesLesBalisesInput[i].type == "checkbox"){ 
                ToutesLesBalisesInput[i].onclick=function(){Envoimap(this);} /* SI checked AU LIEU DE onclick, LES CASES SONT COCHEES */
            } 
        } 
    }
    
    
        
creationPolygons();
creationPolyzone();
setTimeout("depart()",500);


//menuMarker();
//ContextMenu(map,mapOptions);



document.getElementById("Plaque").checked=true;


//document.getElementById( "SANS_ZONE-ch").checked=true;// coche zans zone 
//Envoimap(document.getElementById( "SANS_ZONE-ch"))// affiche les marqueurs sans zones
//checkTwo(document.getElementById( "SANS_ZONE-ch"))// coches les sites de SANS_ZONE

}
            


$(function afficheCacheMenu()                                                    
{
    $('.afficheCacheMenu').click(function(){
        
        $("#EmplacementDeMaCarte div").css("margin-right","0");

        if($('#menuChoix').is(':visible') && $('#panel').is(':visible'))
        {
            $('#menuChoix').hide();
            $('#panel').hide();
        }
        else if($('#menuChoix').is(':hidden') && $('#panel').is(':hidden'))
        {
            $('#menuChoix').show();
            $('#panel').show();
        }
        else if($('#menuChoix').is(':visible') && $('#panel').is(':hidden'))
        {
            $('#menuChoix').show();
            $('#panel').show();
        }
        else if($('#menuChoix').is(':hidden') && $('#panel').is(':visible'))
        {
            $('#menuChoix').show();
            $('#panel').show();
        }
        
        setTimeout(function()
        { 
            google.maps.event.trigger(map, "resize");       // Permet de réactualiser la taille de la carte
            map.setCenter(new google.maps.LatLng(48.856666,2.350987));  // Permet de recentrer la carte sur Paris
        }, 500);
        
    });

});


$(function afficheCacheMenu1()        // Menu géographique                                           
{

    $('.afficheCacheMenu1').click(function(){
    
        $("#EmplacementDeMaCarte div").css("margin-right","0");
        
        $('#panel').slideToggle();
    if(document.getElementById("button1").textContent == "<"){
    document.getElementById("button1").textContent = "V";}
    else{document.getElementById("button2").textContent = "<";}
        setTimeout(function()
        { 
            google.maps.event.trigger(map, "resize");
            map.setCenter(new google.maps.LatLng(48.856666,2.350987));
        }, 500);
        
    });

});                                                                              


$(function afficheCacheMenu2()      // Menu des interventions                                                    
{

    $('.afficheCacheMenu2').click(function(){
    
        $("#EmplacementDeMaCarte div").css("margin-right","0");

        $('#menuChoix').slideToggle();
        if(document.getElementById("button2").textContent == ">"){
    document.getElementById("button2").textContent = "V";}
    else{document.getElementById("button2").textContent = ">";}
        
        setTimeout(function()
        { 
            google.maps.event.trigger(map, "resize");
            map.setCenter(new google.maps.LatLng(48.856666,2.350987));
        }, 500);
        
    });

});                                                                              
                                                                                 

$(function afficheCacheLegende()                                                 
{

    $('.afficheCacheLegende').click(function(){
    
        setTimeout('self.scrollTo(0, 2200);',350);
        $('.plaque').show();
        $('.icone').show();
        
    });

});     

function creationPolyzone()
{
    downloadUrl(urlXml+"?"+Math.random(), function(data){
        var xml = xmlParse(data);
        var markers = xml.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++){ 
            var type = markers[i].getAttribute("Zone");
            var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")));
            
            if (type=="USEI_OUEST"){
            
                useiOuest.push(point);
            
            }
            else if (type=="USEI_EST"){
            
                useiEst.push(point);
            }
        }
        });
}


function creationPolygons(){
    downloadUrl(urlXml+"?"+Math.random(), function(data){
        var xml = xmlParse(data);
        var markers = xml.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++){ 
            var type = markers[i].getAttribute("Zone");
            var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")), parseFloat(markers[i].getAttribute("lng")));
            for (var j=0;j<zone.length;j++){
                if(type==zone[j][0]){
        
                tabZone2[j].push(point); // on rempli le tableau de positions de chaques plaques avec les positions des marqueurs apartenant a ces plaques

                
                    }}
            
        
    };
})  
}
function Envoimap(val){ 

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

                        var marker = CreationDuMarqueur(point, nom , adresse, codepostal, ville, type, nomtec, Image, i, mapselec, boutique);
                        // console.log("MAAAAAAAAAAAAAAAAAAARKER"+ marker);
                        // console.log(tabMarker);
                        tabMarker[a] = marker;
                        a++;
                          // console.log(tabMarker);

                        for(var k =0; k<zone.length;k++){
                            if(type==zone[k][0]){
                                tabTab2[k].push(marker);    }} // on rempli le tableau de marqueurs de chaque plaque avec les marqueur appartenant ces plaques
                        
                            
                            
                    } 
                }  
            }   
        }); 
    } 



    if(val.checked == false){

        downloadUrl(urlXml+"?"+Math.random(), function(data){ 
            var xml = xmlParse(data);
            var markers = xml.documentElement.getElementsByTagName("marker"); 
            for (var i = 0; i < markers.length; i++){
                var type = markers[i].getAttribute("Zone");
                var nom = markers[i].getAttribute("Nom"); 
                var USEI = markers[i].getAttribute("USEI"); 
        


                if(type == mapselec || nom == mapselec || USEI == mapselec){
                        hide(nom);
                }
            }
        });
    }
}






function CreationDuMarqueur(point, nom, adresse, codepostal, ville, type, nomtec, Image, i, mapselec, boutique, affichageWO, affichageOT, affichageINC)
{

    switch(boutique){

        case "Boutique":
        icone = "image/img/icone/boutique.png";

        case "Binome":
        icone = "image/img/icone/binome.png";

        case "PDL":
        icone = "image/img/icone/pdl.png";

        case "PDP":
        icone = "image/img/icone/pdl.png";

        case "PDE":
        icone = "image/img/icone/pde.png";

        case "Autre":
        icone = "image/img/icone/autre.png";     
     
    } 

    for(var i=0; i<zone.length;i++){

        if(type==zone[i][0] && boutique =="Autre"){
            icone = zone[i][3]; // on ajoute les url des images correspondantes
        }   
        
        if(type==zone[i][0] && boutique =="Boutique"){
            icone = zone[i][4];
        }
        
        if(type==zone[i][0] && boutique =="Service"){
            icone = zone[i][5];
        }
        
        if(type==zone[i][0] && boutique =="Binome"){
            icone = zone[i][6];
        }

        if(type==zone[i][0] && boutique =="PDL"){
            icone = zone[i][9];
        }

        if(type==zone[i][0] && boutique =="PDP"){
            icone = zone[i][10];
        }

        if(type==zone[i][0] && boutique =="PDE"){
            icone = zone[i][11];
        }
        
    }
    
    
    var image = {
        url: icone,
        scaledSize: new google.maps.Size(15,20)
    };

                    
    var OT = document.getElementById("OT");
    var INC = document.getElementById("INC");
    var WO = document.getElementById("WO");
    var iconeFlamme = "image/img/icone/boutonR.gif";                                        
    var iconePlage = "image/img/icone/boutonV.gif";                                     
        
    var imageFlamme="<image/img src='image/img/icone/boutonR.gif' alt='boutonR'>";      
    var imagePlage="<image/img src='image/img/icone/boutonV.gif' alt='boutonV'>";       

    var affichageOT;        // contient "OT : "+ sa valeur                                    

    var affichageINC;       // contient "INC : "+ sa valeur

    var affichageWO;        // contient "WO : "+ sa valeur

    var indicateurWO;
    var indicateurOT;
    var indicateurINC;      


    
    
/***********************************************************************************************************************************************************
*                                                                                                                                                          *
*                           FONCTIONNALITER PERMETTANT DE FAIRE TRANSFORMER L'ICONE EN FLAMME EN FONCTION DES INDICATEUR                                   *                    
*                                                                                                                                                          *
************************************************************************************************************************************************************/

//Fonction Ajax servant à aller chercher dans le script PHP ActiviteOT un array avec comme clé TYPETICKET, CODESITE et COMPTAGE.
//Cet Array est fourni en interrogeant une base de données (la table activite plus précisement).
//Cet Array contient le nombres (COMPTAGE) d'incident (TYPETICKET == OT) qu'il y a eu dans toute les zones (CODESITE).



    if(OT.checked == true)
    {
        document.getElementById("Chargement").style.display="block";
        $.ajax({
            url: "activite/ActiviteOT.php",
            type:"GET",
            success:function(reponse)
            {
            
                var res = JSON.parse(reponse);
                for(var i =0; i<res.length; i++)
                {
                        if(nom.replace(/ /g,"") == res[i].CODESITE.replace(/ /g,"") && res[i].COMPTAGE > parseInt(valeurOT)) 
                        {
                            image.scaledSize.height=10; //Taille de l'image sur la carte pour les OT
                            image.scaledSize.width=10;
                            image.url=iconeFlamme;          
                            affichageOT = 'OT : '+res[i].COMPTAGE;              
                            indicateurOT = affichageOT + imageFlamme;                   
                        }
                            if(nom == res[i].CODESITE && res[i].COMPTAGE < parseInt(valeurOT))      
                            {
                                affichageOT = 'OT : '+res[i].COMPTAGE;
                                indicateurOT = affichageOT + imagePlage;
                            }
                }                                                                       
                         
            },
            //J'ai annulé le paradigme asynchrone du AJAX car le script ne se faisant pas séquentiellement, l'affichage de l'icone se 
            //fera toujours selon la definition de la variable image (à la ligne 350). Cela implique un lourd ralentissement lors du 
            //chargement des icônes, une solution devra donc être trouvé.
            
            async: false
         
                
            
        

        });
        document.getElementById("Chargement").style.display="none";

    }

/***********************************************************************************************
*                                                                                              *
*  Aggrandisement d'un markeur en fonction de l'activite (nombre d'incident dans chaque zone)  *                    
*                                                                                              *
************************************************************************************************/

//Fonction Ajax servant à aller chercher dans le script PHP ActiviteINC un array avec comme clé TYPETICKET, CODESITE et COMPTAGE.
//Cet Array est fourni en interrogeant une base de données (la table activite plus précisement).
//Cet Array contient le nombres (COMPTAGE) d'incident (TYPETICKET == INC) qu'il y a eu dans toute les zones (CODESITE).
 
    if(INC.checked == true)
    {
        document.getElementById("Chargement").style.display="block"; //Affichage du gif de chargement
        $.ajax({
            url: "activite/ActiviteINC.php",
            type:"GET",
            success:function(reponse)
            {
            
                var res = JSON.parse(reponse);
                for(var i =0; i<res.length; i++)
                {
                        if(nom.replace(/ /g,"") == res[i].CODESITE.replace(/ /g,"") && res[i].COMPTAGE > parseInt(valeurINC)) 
                        {

                            image.scaledSize.height=10; //Taille de l'image sur la carte pour les INC
                            image.scaledSize.width=10;
                            image.url=iconeFlamme;          
                            affichageINC = 'INC : '+res[i].COMPTAGE;            
                            indicateurINC = affichageINC + imageFlamme;                                         
                            }
                            if(nom == res[i].CODESITE && res[i].COMPTAGE < parseInt(valeurINC))  
                            {
                                affichageINC = 'INC : '+res[i].COMPTAGE;
                                indicateurINC = affichageINC + imagePlage;
                            }   
                }                                                                            
                         
            },
            //J'ai annulé le paradigme asynchrone du AJAX car le script ne se faisant pas séquentiellement, l'affichage de l'icone se 
            //fera toujours selon la definition de la variable image (à la ligne 350). Cela implique un lourd ralentissement lors du 
            //chargement des icônes, une solution devra donc être trouvé.
            
            async: false
         
                
            
        

      });
        document.getElementById("Chargement").style.display="none";//Masquer le gif de chargement
    }
    
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    if(WO.checked == true)
    {
        document.getElementById("Chargement").style.display="block";


        $.ajax({
                url: "activite/ActiviteWO.php",
                type:"GET",
                success:function(reponse)
                {
                
                    var res = JSON.parse(reponse);
                    for(var i =0; i<res.length; i++)
                    {
                            if(nom.replace(/ /g,"") == res[i].CODESITE.replace(/ /g,"") && res[i].COMPTAGE > parseInt(valeurWO)) 
                            {
                                image.scaledSize.height=10; //Taille de l'image sur la carte pour les WO
                                image.scaledSize.width=10;
                                image.url=iconeFlamme;          
                                nomWO = res[i].CODESITE;
                                affichageWO = 'WO : '+res[i].COMPTAGE;
                                indicateurWO = affichageWO + imageFlamme;                   
                            }
                            if(nom == res[i].CODESITE && res[i].COMPTAGE < parseInt(valeurWO))  
                            {
                                affichageWO = 'WO : '+res[i].COMPTAGE;
                                indicateurWO = affichageWO + imagePlage;
                            }                                                                

                    }   
                             
                },
                //J'ai annulé le paradigme asynchrone du AJAX car le script ne se faisant pas séquentiellement, l'affichage de l'icone se 
                //fera toujours selon la definition de la variable image (à la ligne 350). Cela implique un lourd ralentissement lors du 
                //chargement des icônes, une solution devra donc être trouvé.
                
                async: false
             
                    
                
            

          });
        document.getElementById("Chargement").style.display="none";
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    
var typage;
for(var i =0; i<zone.length; i++)
{
    if(type==zone[i][0]) // on ajoute a chaque marqueur son "id" car zone[i][1] représente l'ID
    {
        typage=zone[i][1]
    }
}
        


var tabTec = []
var count = 0

tabTec[count] = nomtec
count++;

var marker = new google.maps.Marker({
    html: [type,nom,typage,tabTec],
    'zIndex' : 2,   
    map: map,
    position: point,    
    icon: image,
    draggable : false,  
    optimized : false                                
});


/*var marker1 = new google.maps.Marker({
    html: [type,nom,typage,tabTec],
    'zIndex' : 2,   
    map: map,
    position: point,    
    icon: image,
    draggable : false,  
    optimized : false                                
});*/
    

    

    var shadow = "image/img/icone/mm_20_shadow.png";
    marker.mycategory=nom;
    
    
    if(image.url==iconeFlamme){ 
        // Uniquement pour les marqueurs qui possède l'icone de flamme
        
        marker.setZIndex(100); // on met un index afin que les iconnes de flamme se trouve en premier plan par rapport aux autres icones

        var info="<b><u><a href=\"site.php?site="+nom+"\" target=_self>"+nom+"</a></u></b><br/>"  + adresse + "<br/>" + codepostal + " " + ville + "<br/><br/>";
        
        // Si la checkbox WO n'est pas coché alors la valeur des WO et l'icone correspondante ne seront pas présent dans l'infobulle
        if(affichageWO===undefined)
        {   
            indicateurWO='';
        }

        // Si la checkbox OT n'est pas coché alors la valeur des OT et l'icone correspondante ne seront pas présent dans l'infobulle
        if(affichageOT===undefined)
        {
            indicateurOT='';
        } 

        // Si la checkbox INC n'est pas coché alors la valeur des INC et l'icone correspondante ne seront pas présent dans l'infobulle
        if(affichageINC===undefined)
        {
            indicateurINC='';
        } 

        var contenu = info + indicateurWO + indicateurOT + indicateurINC ;

        // On définit l'infobulle pour les marqueurs qui auront une icone de flammes
        var infowindow = new google.maps.InfoWindow({
            content: contenu
        });
        
        
        google.maps.event.addListener(marker, 'mouseover', function(latlng){   
            // La suite s'éxécute seulement si le curseur reste 0.7 seconde sur un marqueur
            timer = setTimeout(function()
            {
            
                // Si une infobulle (marqueur avec icone de flamme) est déjà ouverte, alors on la ferme
                if (typeof( window.infoOpened ) != 'undefined')
                {
                    infoOpened.close();
                }
                
                // Si une infobulle (marqueur sans icone de flamme) est déjà ouverte, alors on la ferme
                else if (typeof( window.infoOpened2 ) != 'undefined')
                {
                    infoOpened2.close();
                }
                
                // On ouvre la nouvelle infobulle
                infowindow.open(map, marker);
                
                // On stock ces nouvelles infobulle dans les variables infoOpened et infoOpened2 afin de pouvoir les fermer par la suite
                infoOpened = infowindow;
                infoOpened2 = infoWindow;
                
            }, 700); //Ici on fixe le temps pendant lequel on doit rester sur le marqueur avant d'afficher l'infobulle

            
        });


        /*google.maps.event.addListener(marker, 'rightclick', function(latlng){   
            // Si une infobulle (d'un marqueur avec iconne flamme) est déjà ouverte, alors on la ferme
            if (typeof( window.infoOpened ) != 'undefined')
            {
                infoOpened.close();
            }
            // Si une infobulle (d'un marqueur sans iconne flamme) est déjà ouverte, alors on la ferme
            else if (typeof( window.infoOpened2 ) != 'undefined')
            {
                infoOpened2.close();
            }
            
            // On ouvre la nouvelle infobulle
            infowindow.open(map, marker);
            
            
            // On stock ces nouvelles infobulle dans les variables infoOpened et infoOpened2 afin de pouvoir les fermer par la suite
            infoOpened = infowindow;
            infoOpened2 = infoWindow;
        
        });*/
            google.maps.event.addListener(marker, 'rightclick', function(latlng){//infobulle avec icone feu avec lien modifier marqueur...
                var nomMarkLienFeu= " <b><p> " +nom+ "</p></b>" ;  
                var lienPlaqueFeu = "<a href=\"ModifSiteBis2.php?OldName="+nom+"&sec="+type+"\" target=_self id='lienModif'> Modifier Marqueur (Plaque, Nom, Adresse...)</a> <br>";
                var lienSupprimerFeu="<a href=\"SupprSite2.php?usei=USEI_IDF&zone="+type+"&oldname="+nom+"\" target=_self id='lienModif'> Supprimer Site</a> ";
                infoWindow.setContent(nomMarkLienFeu+lienPlaqueFeu+lienSupprimerFeu);
                infoWindow.open(map, marker);})
        
            google.maps.event.addListener(map, 'rightclick', function(latlng){
                // Permet de fermer l'infobulle si on clique sur la carte
                infoWindow.close(map, marker);})
        
        


        

        google.maps.event.addListener(marker, 'mouseout', function(latlng){
            // Permet de n'afficher l'infobulle que si la curseur reste 2 secondes sur un marqueur
            clearInterval(timer);
            
            // Au bout de 7 sec , si la curseur n'est plus sur le marqueur alors l'infobulle se ferme automatiquement
            setTimeout(function(){infowindow.close()}, 7000);
        });                                         

        
        google.maps.event.addListener(map, 'click', function(latlng){
            // Permet de fermer l'infobulle si on clique sur la carte
            infowindow.close();
        }); 
    
    }   
    
    
    else{
        // Uniquement pour les marqueurs qui ne possède pas l'icone de flamme
        google.maps.event.addListener(marker, 'click', function(latlng){
        
        
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
        
            var info="<b><u><a href=\"site.php?site="+nom+"\" target=_self>"+nom+"</a></u></b><br/>"  + adresse + "<br/>" + codepostal + " " + ville + "<br/><br/>"; 
            
           var lien = "<a href=\"ModifSiteBis2.php?OldName="+nom+"&sec="+type+"\" target=_self id='lienModif'></a>";
            
        
            var info= info + lien
            infoWindow.setContent(info);
            // Affiche l'infobulle 
            infoWindow.open(map, marker);           
            // setTimeout("displayStreetView('"+point.lat()+"','"+point.lng()+"');",2500);
            
            // On stock ces nouvelles infobulle dans les variables infoOpened et infoOpened2 afin de pouvoir les fermer par la suite
            infoOpened = infowindow;
            infoOpened2 = infoWindow;
            
            
        });
        

        
        google.maps.event.addListener(map, 'click', function(latlng){
            // Permet de fermer l'infobulle si on clique sur la carte
            infoWindow.close(map, marker);
        }); 
        
        google.maps.event.addListener(marker, 'rightclick', function(latlng){//infobulle avec lien modifier marqueur
            
            // Fonction permettant d'effectuer un distancier entre deux sites de façon graphique.
         
            function itineraire(latlng){
                if (indiceMarker==2){
                     while (tab_mark.length) {
                     // console.log(indiceMarker);
                        tab_mark.pop();
                    }
                    indiceMarker=1;
                    // console.log("Taille Tab Marker: "+tab_mark.length);
                }
                else{
                    indiceMarker++;
                }
                
                // console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa: "+indiceMarker);
                
                
                // Permet de fermer l'infobulle si on clique sur la carte
                var latPoints=[];
                var lngPoints=[];
                //var i = this.html;
                //console.log("marker: "+i);
                var lat = latlng.latLng.lat();
                var lgn = latlng.latLng.lng();
                var point1 = new google.maps.LatLng(lat,lgn); 
                var temp= "" + point1;
                tab_mark.push(point1);
    
                //console.log("position Lat: " + event.latLng.lat());
                //console.log("position Long: " + event.latLng.lng());
                //console.log("point 1 : " +point1);
            
                
                //console.log(tab_mark[0]);
                
                /*
                for (i=0;i<tab_mark.length;i++){
                
                
                var diParametre = tab_mark[i].replace("(","").replace(")","");  //suppression des parenthèses du contenu de la variable ce  
                var coordo = diParametre.split(',');                    //séparation/récupération de la longitude et de la lattitude dans un tableau
                var lattitude = parseFloat(coordo[0]);                  //cast des variable en float
                var longitude = parseFloat(coordo[1]);
                
                //console.log(i+") "+lattitude);
                //console.log(i+") "+longitude);
                console.log (coordo
                
                }
                */
                
                var distanceKm = google.maps.geometry.spherical.computeDistanceBetween(tab_mark[0], tab_mark[1]);
                 distanceKm = distanceKm/1000;
                //  console.log("A: " +tab_mark[0]);
                //  console.log("B: " +tab_mark[1]);
                // console.log("distance à vol d'oiseau : " +distanceKm);
                // console.log("distance réel en voiture :" +distance(50.73463821, 1.6746900079999705,43.13670731, 6.004651545999991,"K"));
            

                
                //console.log("tableau vidée");
                
                direction = new google.maps.DirectionsRenderer({
                            map   : map,
                        });
                
                 var request = {
                        origin      : tab_mark[0],
                        destination : tab_mark[1],
                        travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
                    }
                    
                    var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
                    directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
                        
                        if(status == google.maps.DirectionsStatus.OK){
                        
                            encoded_polyline = response['routes'][0]['overview_polyline'];
                            
                            var decoded_polyline = google.maps.geometry.encoding.decodePath(encoded_polyline);
                
                            for (i=0 ; i<decoded_polyline.length ; i++){
                            
                                // console.log(decoded_polyline[i].lat());
                                latPoints.push(decoded_polyline[i].lat());
                                lngPoints.push(decoded_polyline[i].lng());
                            
                            }
                            
                            var milieuTab=Math.round(latPoints.length/2);
                            var milieuLat=latPoints[milieuTab];
                            var milieuLng=lngPoints[milieuTab];
                            
                            // console.log("longueur du tableau " +latPoints.length);
                            // console.log("longueur du tableau " +milieuTab);
                            
                            // console.log("lattitude milieu"+milieuLat);
                            // console.log("longitude milieu"+milieuLng);
                
                
                            // console.log(encoded_polyline);
                            // console.log(decoded_polyline);
                            
                            
                            //console.log(response.toSource());
                            //console.log(response['routes'][0]['overview_polyline']);

                            
                            var kilometrage = response.routes[0].legs[0].distance.text;
                            var duree = response.routes[0].legs[0].duration.text ;
                            
                            var donnee= "Votre trajet a une durée de "+duree+" est de "+kilometrage ;
                            
                            // console.log((response.routes[0].legs[0].distance.text));
                            // console.log((response.routes[0].legs[0].duration.text));
                    
                        
                            direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
                            
                            var testChaine = duree.match(/heure/g);
                            // console.log(testChaine);
                            var testChaineMin = duree.match(/minute/g);
                            //var tailleChaine = ""+testChaine.length;
                            //console.log(tailleChaine);
                            
                           // myWindow.opener.document.write("<p>This is the source window!</p>");
                            // Choix de la taille du rectangle blanc du "markerWithLabel".
                            if(testChaine==null){
                                //alert(donnee);
                                infoWindow.setContent(donnee);
                                infoWindow.open(map, polyline); 
                            }   
                            else if(testChaine!=null && testChaineMin==null){
                               //alert(donnee); 
                               infoWindow.setContent(donnee);
                                infoWindow.open(map, polyline); 
                            }
                            else{
                               //alert(donnee);
                               infoWindow.setContent(donnee);
                                infoWindow.open(map, polyline);
                            }
                            
                        }
                    });
                    
                
                tab_mark = [];
                directionDisplay.set('directions', null);
                
            }
            
            // Génération de l'infobulle au clic droit sur un site d'une plaque.
            var nomMarkLien= " <b><p> " +nom+ "</p></b>" ;  
            var lienPlaque = "<a href=\"ModifSiteBis2.php?OldName="+nom+"&sec="+type+"\" target=_self id='lienModif'> Modifier Marqueur (Plaque, Nom, Adresse...)</a> <br>";
            var lienSupprimer="<a href=\"SupprSite2.php?zone="+type+"&oldname="+nom+"\" target=_self > Supprimer Site</a> <br>";
            var lienItineraire="<a id='itineraire'>Point itinéraire</a> <br>";
            infoWindow.setContent(nomMarkLien+lienPlaque+lienSupprimer+lienItineraire);
            infoWindow.open(map, marker);
            
            $(document).ready(function()
            {
                $('#itineraire').click(function(){
                    itineraire(latlng);
                });
            });
            
            
        });

        
        
        google.maps.event.addListener(map, 'rightclick', function(latlng){
            // Permet de fermer l'infobulle si on clique sur la carte
            infoWindow.close(map, marker);})
            
            
        
    }



    
    /* google.maps.event.addListener(marker, 'click', function(event){
                
                if (indiceMarker==2){
                     while (tab_mark.length) {
                     console.log(indiceMarker);
                        tab_mark.pop();
                    }
                    indiceMarker=1;
                    console.log("Taille Tab Marker: "+tab_mark.length);
                }
                else{
                    indiceMarker++;
                }
                
                console.log("aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa: "+indiceMarker);
                
                
                // Permet de fermer l'infobulle si on clique sur la carte
                var latPoints=[];
                var lngPoints=[];
                var i = this.html;
                //console.log("marker: "+i);
                var lat = event.latLng.lat();
                var lgn = event.latLng.lng();
                var point1 = new google.maps.LatLng(lat,lgn); 
                var temp= "" + point1;
                tab_mark.push(point1);
    
                //console.log("position Lat: " + event.latLng.lat());
                //console.log("position Long: " + event.latLng.lng());
                //console.log("point 1 : " +point1);
                
                for (i=0;i<tab_mark.length;i++){
                
                    console.log("tab: " +tab_mark[i]);
                
                }
                
                //console.log(tab_mark[0]);
                
                
                for (i=0;i<tab_mark.length;i++){
                
                
                var diParametre = tab_mark[i].replace("(","").replace(")","");  //suppression des parenthèses du contenu de la variable ce  
                var coordo = diParametre.split(',');                    //séparation/récupération de la longitude et de la lattitude dans un tableau
                var lattitude = parseFloat(coordo[0]);                  //cast des variable en float
                var longitude = parseFloat(coordo[1]);
                
                //console.log(i+") "+lattitude);
                //console.log(i+") "+longitude);
                console.log (coordo);
                
                }
                
                
                var distanceKm = google.maps.geometry.spherical.computeDistanceBetween(tab_mark[0], tab_mark[1]);
                 distanceKm = distanceKm/1000;
                 console.log("A: " +tab_mark[0]);
                 console.log("B: " +tab_mark[1]);
                console.log("distance à vol d'oiseau : " +distanceKm);
                console.log("distance réel en voiture :" +distance(50.73463821, 1.6746900079999705,43.13670731, 6.004651545999991,"K"));
            

                
                //console.log("tableau vidée");
                
                direction = new google.maps.DirectionsRenderer({
                            map   : map,
                        });
                
                 var request = {
                        origin      : tab_mark[0],
                        destination : tab_mark[1],
                        travelMode  : google.maps.DirectionsTravelMode.DRIVING // Type de transport
                    }
                    
                    var directionsService = new google.maps.DirectionsService(); // Service de calcul d'itinéraire
                    directionsService.route(request, function(response, status){ // Envoie de la requête pour calculer le parcours
                        
                        if(status == google.maps.DirectionsStatus.OK){
                        
                            encoded_polyline = response['routes'][0]['overview_polyline'];
                            
                            var decoded_polyline = google.maps.geometry.encoding.decodePath(encoded_polyline);
                
                            for (i=0 ; i<decoded_polyline.length ; i++){
                            
                                // console.log(decoded_polyline[i].lat());
                                latPoints.push(decoded_polyline[i].lat());
                                lngPoints.push(decoded_polyline[i].lng());
                            
                            }
                            
                            var milieuTab=Math.round(latPoints.length/2);
                            var milieuLat=latPoints[milieuTab];
                            var milieuLng=lngPoints[milieuTab];
                            
                            console.log("longueur du tableau " +latPoints.length);
                            console.log("longueur du tableau " +milieuTab);
                            
                            console.log("lattitude milieu"+milieuLat);
                            console.log("longitude milieu"+milieuLng);
                
                
                            console.log(encoded_polyline);
                            console.log(decoded_polyline);
                            
                            
                            //console.log(response.toSource());
                            //console.log(response['routes'][0]['overview_polyline']);

                            
                            var kilometrage = response.routes[0].legs[0].distance.text;
                            var duree = response.routes[0].legs[0].duration.text ;
                            
                            var donnee= ""+kilometrage+"<br />"+duree ;
                            
                            console.log((response.routes[0].legs[0].distance.text));
                            console.log((response.routes[0].legs[0].duration.text));
                    
                        
                            direction.setDirections(response); // Trace l'itinéraire sur la carte et les différentes étapes du parcours
                            
                            var testChaine = duree.match(/heure/g);
                            console.log(testChaine);
                            var testChaineMin = duree.match(/minute/g);
                            //var tailleChaine = ""+testChaine.length;
                            //console.log(tailleChaine);
                            
                            if(testChaine==null){
                                marker = new MarkerWithLabel({      //marqueur contenant un label
                                                  position: new google.maps.LatLng(milieuLat,milieuLng),
                                                  draggable: false,
                                                  labelContent: donnee,
                                                  labelAnchor: new google.maps.Point(47,47),
                                                  labelClass: "label",
                                                  labelInBackground: false,
                                                  zIndex: 1,
                                                  map: map,
                                                  optimized: false,
                                                  icon:'image/img/icone/mark.png'

                                        });     
                            }   
                            else if(testChaine!=null && testChaineMin==null){
                                marker = new MarkerWithLabel({      //marqueur contenant un label
                                                  position: new google.maps.LatLng(milieuLat,milieuLng),
                                                  draggable: false,
                                                  labelContent: donnee,
                                                  labelAnchor: new google.maps.Point(61,47),
                                                  labelClass: "label",
                                                  labelInBackground: false,
                                                  zIndex: 1,
                                                  map: map,
                                                  optimized: false,
                                                  icon:'image/img/icone/markG.png'

                                        });     
                            }
                            else{
                                marker = new MarkerWithLabel({      //marqueur contenant un label
                                                  position: new google.maps.LatLng(milieuLat,milieuLng),
                                                  draggable: false,
                                                  labelContent: donnee,
                                                  labelAnchor: new google.maps.Point(79,47),
                                                  labelClass: "label",
                                                  labelInBackground: false,
                                                  zIndex: 1,
                                                  map: map,
                                                  optimized: false,
                                                  icon:'image/img/icone/markGG.png'

                                        });     
                            }
                            
                        
                    });
                    
                
                tab_mark = [];
                directionDisplay.set('directions', null);
                
};*/
    


        

    overlays.push(marker);
    if (mapselec != type){
        Markers[j] = marker;
        j++;
    }
    return marker;
}

/**
* Returns an XMLHttp instance to use for asynchronous
* downloading. This method will never throw an exception, but will
* return NULL if the browser does not support XmlHttp for any reason.
* @return {XMLHttpRequest|Null}
*/
function createXmlHttpRequest() {
    try {
        if (typeof ActiveXObject != 'undefined') {
            return new ActiveXObject('Microsoft.XMLHTTP');
            
        }
        else if (window["XMLHttpRequest"]) {
            return new XMLHttpRequest();
        }
    }
    catch (e) {
        changeStatus(e);
    }
    return null;
    
};

/**
* Returns an XMLHttp instance to use for asynchronous
* downloading. This method will never throw an exception, but will
* return NULL if the browser does not support XmlHttp for any reason.
* @return {XMLHttpRequest|Null}
*/
function createXmlHttpRequest() {
    try {
        if (typeof ActiveXObject != 'undefined') {
            return new ActiveXObject('Microsoft.XMLHTTP');
            
        }
        else if (window["XMLHttpRequest"]) {
            return new XMLHttpRequest();
        }
    }
    catch (e) {
        changeStatus(e);
    }
    return null;
    
};

/**
* This functions wraps XMLHttpRequest open/send function.
* It lets you specify a URL and will call the callback if
* it gets a status code of 200.
* @param {String} url The URL to retrieve
* @param {Function} callback The function to call once retrieved.
*/
function downloadUrl(url, callback) {
    var status = -1;
    var request = createXmlHttpRequest();
    if (!request){
        return false;
    }

    request.onreadystatechange = function() {
        if (request.readyState == 4) {
            try {
                status = request.status;
            }
            catch (e) {
                // Usually indicates request timed out in FF.
            }
            if ((status == 200) || (status == 0)) {
                callback(request.responseText, request.status);
                request.onreadystatechange = function() {};
            }
        }
    }
    request.open('GET', url, true);
    try {
        request.send(null);
    }
    catch (e) {
        changeStatus(e);
    }
};

/**
 * Parses the given XML string and returns the parsed document in a
 * DOM data structure. This function will return an empty DOM node if
 * XML parsing is not supported in this browser.
 * @param {string} str XML string.
 * @return {Element|Document} DOM.
 */
function xmlParse(text) {
    if (typeof ActiveXObject != 'undefined'){
        
        xmlDoc=new ActiveXObject("Microsoft.XMLDOM");
        xmlDoc.async=false;
        xmlDoc.loadXML(text);
    }

    else if(typeof DOMParser != 'undefined'){
        parser=new DOMParser();
        xmlDoc=parser.parseFromString(text,"text/xml");
    }
    return(xmlDoc); 
    /*if (typeof ActiveXObject != 'undefined') {
        alert("internetexp");
        var doc = new ActiveXObject('Microsoft.XMLDOM');
        doc.loadXML(str);
        return doc;
    }

    if (typeof DOMParser != 'undefined') {
        alert("firefox");
        return(new DOMParser().parseFromString(str, 'text/xml'));
    }

    return createElement('div', null);*/
}

/**
 * Appends a JavaScript file to the page.
 * @param {string} url
 */

function downloadScript(url) {
    var script = document.createElement('script');
    script.src = url;
    document.body.appendChild(script);
}

function hide(category) {
    for (var i=0; i<overlays.length; i++) {
        if (overlays[i] != null && overlays[i].mycategory == category) {
            overlays[i].setMap(null);
            overlays[i]=null;
        }
    }
}

/* Fonction chargée d'appeler StreetView une fois l'infobulle ouverte */
// function displayStreetView(lat,lng){
//     document.getElementById("streetView").innerHTML = '';
//     /* On efface le message d'attente */
//     var panoramaOptions = {
//         position: new google.maps.LatLng(lat, lng),
//         pov: {
//             heading: 0,
//             pitch: 0
//         }
//     }
//     var StreetView = new google.maps.StreetViewPanorama(document.getElementById("streetView"), panoramaOptions);
//     /* Déclaration de l'objet streetview */
//     google.maps.event.addListener(StreetView, 'error', handleNoFlash);
//     /* Fonction "handleNoFlash" à appeler si erreur */
// }

/* Affiche le message d'erreur à la place du streetView */
function handleNoFlash(errorCode) {
    var msg = "Streetview n'est pas disponible pour cette localisation...";
    document.getElementById("streetView").innerHTML = msg;
    return;
}


function isLeft(P0, P1, P2) {    
    return (P1.lng() - P0.lng()) * (P2.lat() - P0.lat()) - (P2.lng() - P0.lng()) * (P1.lat() - P0.lat());
}

//     Input:  P[] = an array of 2D points 
//                   presorted by increasing x- and y-coordinates
//             n = the number of points in P[]
//     Output: H[] = an array of the convex hull vertices (max is n)
//     Return: the number of points in H[]


function chainHull_2D(P, n, H) {
    // the output array H[] will be used as the stack
    var bot = 0,
    top = (-1); // indices for bottom and top of the stack
    var i; // array scan index
    // Get the indices of points with min x-coord and min|max y-coord
    var minmin = 0,
        minmax;
        
     
    for (i = 1; i < n; i++) {
        if (P[i].lng() != P[0].lng()) {
            break;
        }
    }
    
    minmax = i - 1;
    if (minmax == n - 1) { // degenerate case: all x-coords == xmin 
        H[++top] = P[minmin];
        if (P[minmax].lat() != P[minmin].lat()) // a nontrivial segment
            H[++top] = P[minmax];
        H[++top] = P[minmin]; // add polygon endpoint
        return top + 1;
    }

    // Get the indices of points with max x-coord and min|max y-coord
    var maxmin, maxmax = n - 1;
   
    for (i = n - 2; i >= 0; i--) {
        if (P[i].lng() != P[n - 1].lng()) {
            break; 
        }
    }
    maxmin = i + 1;

    // Compute the lower hull on the stack H
    H[++top] = P[minmin]; // push minmin point onto stack
    i = minmax;
    while (++i <= maxmin) {
        // the lower line joins P[minmin] with P[maxmin]
        if (isLeft(P[minmin], P[maxmin], P[i]) >= 0 && i < maxmin) {
            continue; // ignore P[i] above or on the lower line
        }
        
        while (top > 0) { // there are at least 2 points on the stack
            // test if P[i] is left of the line at the stack top
            if (isLeft(H[top - 1], H[top], P[i]) > 0) {
                break; // P[i] is a new hull vertex
            }
            else {
                top--; // pop top point off stack
            }
        }
        
        H[++top] = P[i]; // push P[i] onto stack
    }

    // Next, compute the upper hull on the stack H above the bottom hull
    if (maxmax != maxmin) { // if distinct xmax points
        H[++top] = P[maxmax]; // push maxmax point onto stack
    }
    
    bot = top; // the bottom point of the upper hull stack
    i = maxmin;
    while (--i >= minmax) {
        // the upper line joins P[maxmax] with P[minmax]
        if (isLeft(P[maxmax], P[minmax], P[i]) >= 0 && i > minmax) {
            continue; // ignore P[i] below or on the upper line
        }
        
        while (top > bot) { // at least 2 points on the upper stack
            // test if P[i] is left of the line at the stack top
            if (isLeft(H[top - 1], H[top], P[i]) > 0) { 
                break;  // P[i] is a new hull vertex
            }
            else {
                top--; // pop top point off stack
            }
        }
        
        if (P[i].lng() == H[0].lng() && P[i].lat() == H[0].lat()) {
            return top + 1; // special case (mgomes)
        }
        
        H[++top] = P[i]; // push P[i] onto stack
    }
    
    if (minmax != minmin) {
        H[++top] = P[minmin]; // push joining endpoint onto stack
    }
    
    return top + 1;
}

function sortPointX(a,b) 
{ 
    return a.lng() - b.lng(); 
}

function sortPointY(a,b) 
{ 
    return a.lat() - b.lat(); 
}

function calculateConvexHull(tab, color, name) {
    tab.sort(sortPointY);
    // console.log("Test2: "+tab)
    tab.sort(sortPointX);
    // console.log("Test3: "+tab)
    DrawHull(tab, color, name);
}

function DrawHull(tab, color, name) {
    
    hullPoints = [];
    chainHull_2D( tab, tab.length, hullPoints );
    // console.log("Centre: "+tab[0])
    polyline = new google.maps.Polygon({
        html: name,
        map: map,
        visible: true,
        paths:hullPoints, 
        fillColor:color,
        //strokeWidth:2, 
        fillOpacity:0.5, 
        strokeColor:color,
        strokeOpacity:0.5
    });
    
    if(tab == useiEst || tab == useiOuest)
    {
        tabZonePoly[j6] = polyline;//tableau contenant toutes les données sur les usei EST et OUEST
        j6++;
    }
    else
    {
        tabPolyline[j2]=polyline;//tableau contenant toutes les données sur les neuf plaques
        j2++;
    }

    /*var markerLabel = new MarkerWithLabel({    // Label pour les plaques lors du clignotement
        map: map,
        position: new google.maps.LatLng(hullPoints[3].k, hullPoints[3].B),
        icon: {path: 'M0,0L0,1',strokeWeight: 0 },
        draggable: false,
        raiseOnDrag: false,
        labelVisible: false,
        labelContent: polyline.html ,    //contenu du label
        labelAnchor: new google.maps.Point(50, 0),  //position du label
        labelClass: "labels", //  CSS class pour le label par rapport au marker
    }); 
    tabMarkerIndicateur[j3] = markerLabel;
    j3++;*/
    
    
    /////////////////// Afficher marqueurs lors d'un click droit sur une plaque \\\\\\\\\\\\\\\\\\\\\\\
    
    
    /*google.maps.event.addListener(polyline, 'rightclick', function() 
    {
        document.getElementById("Chargement").innerHTML="<img src='image/img/load.gif' />"; //Ajout image de chargement
        document.getElementById("Chargement").style.display="none"; //Masque la div de chargement
        //LA MANIPULATION DE LA DIV CHARGEMENT SE FAIT DANS LA FONCTION CreationDuMarqueur() AU NIVEAU DES OT INC WO
        for( var i=0; i<zone.length;i++)
        {
            if(this.html==zone[i][0])
            {
                
                if(document.getElementById(zone[i][0]+"-ch").checked==false)
                {
                    document.getElementById(zone[i][0]+"-ch").checked=true;//cocher checkbox plaque
                    Envoimap(document.getElementById(zone[i][0]+"-ch"));//afficher marqueurs
                    checkTwo(document.getElementById(zone[i][0]+"-ch"));//cocher checkbox sites
                    
                }
                else if(document.getElementById(zone[i][0]+"-ch").checked==true)
                {
                    document.getElementById(zone[i][0]+"-ch").checked=false;//decocher checkbox plaque
                    Envoimap(document.getElementById(zone[i][0]+"-ch"));// cacher marqueurs
                    checkTwo(document.getElementById(zone[i][0]+"-ch"));//decocher sites checkbox sites
                    
                }
            }
        }
        

        
    }); */
    
    

google.maps.event.addListener(polyline, 'rightclick', function() 
{  

            var PlaqueActuelle = this.html;
            // console.log("plaque: "+PlaqueActuelle);
            var ce = "" + polygonCenter(this);
            // console.log("Centre: "+ce);
            var ceParametre = ce.replace("(","").replace(")","");   //suppression des parenthèses du contenu de la variable ce  
            var coordo = ceParametre.split(',');                    //séparation/récupération de la longitude et de la lattitude dans un tableau
            var lattitude = parseFloat(coordo[0]); 
            // console.log(coordo[0]);   
                      //cast des variable en float
            var longitude = parseFloat(coordo[1]);
            // console.log(coordo[1]);

            
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
            
            
            function efficienceTIJ(PlaqueActuelle,lattitude,longitude)
            {       
                        /*console.log("OK TIJ");
                        var PlaqueActuelle = this.html;
                        console.log("plaque: "+PlaqueActuelle);
                        var ce = "" + polygonCenter(this);
                        console.log("Centre: "+ce);
                        var ceParametre = ce.replace("(","").replace(")","");   //suppression des parenthèses du contenu de la variable ce  
                        var coordo = ceParametre.split(',');                    //séparation/récupération de la longitude et de la lattitude dans un tableau
                        var lattitude = parseFloat(coordo[0]);                  //cast des variable en float
                        var longitude = parseFloat(coordo[1]);*/
                        
                        var type= typeof lattitude ;
                        
                        // console.log("Lattitude: "+coordo[0]);
                        // console.log("longitude: "+coordo[1]);
                        // console.log("type du centre: "+type);
                        
                        $.ajax({

                        url:"activite/activiteRapport.php",

                        type:"GET", 
                        success: function(reponse)//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
                        {
                            var res = JSON.parse(reponse);
                            for(var i=0 ; i<zone.length ; i++)
                            {
                                if(PlaqueActuelle == zone[i][0])
                                    {
                                            for(var z=0; z<res.length; z++)
                                            {
                                                if(res[z].NOM_AGENCE_NIV2 == zone[i][8])
                                                {
                                                    var TIJ = res[z].COMPTAGE_TYPETICKET / res[z].COMPTAGE_NOM /220;
                                                    // console.log("TIJ : "+TIJ);
                                                    var tij= "L'efficience de la plaque que vous avez sélectionner est de "+TIJ.toFixed(2);
                                                   infoWindow.setContent(tij);
                                                     infoWindow.open(map, polyline);                    
                                                        
                                                    // console.log("affichage fait: ");
                
                                                }
                                            }

                                    }
                            }
                           
                        }
                    });
                        
            };  
            
            function distancier(){
            
                $.ajax({
                    url: 'testExcel/Classes/recupID.php',
                    type: 'GET',
                    async: false,
                    data: {zone: PlaqueActuelle},               
                    success: function(reponse)
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
                    }
                });
            };
            
            function afficherSitePlaque(PlaqueActuelle){
                document.getElementById("Chargement").innerHTML="<img src='image/img/load.gif' />"; //Ajout image de chargement
                document.getElementById("Chargement").style.display="none"; //Masque la div de chargement
                //LA MANIPULATION DE LA DIV CHARGEMENT SE FAIT DANS LA FONCTION CreationDuMarqueur() AU NIVEAU DES OT INC WO
                for( var i=0; i<zone.length;i++)
                {
                    if(PlaqueActuelle==zone[i][0])
                    {
                        
                        if(document.getElementById(zone[i][0]+"-ch").checked==false)
                        {
                            document.getElementById(zone[i][0]+"-ch").checked=true;//cocher checkbox plaque
                            Envoimap(document.getElementById(zone[i][0]+"-ch"));//afficher marqueurs
                            checkTwo(document.getElementById(zone[i][0]+"-ch"));//cocher checkbox sites
                            
                        }
                        else if(document.getElementById(zone[i][0]+"-ch").checked==true)
                        {
                            document.getElementById(zone[i][0]+"-ch").checked=false;//decocher checkbox plaque
                            Envoimap(document.getElementById(zone[i][0]+"-ch"));// cacher marqueurs
                            checkTwo(document.getElementById(zone[i][0]+"-ch"));//decocher sites checkbox sites
                            
                        }
                    }
                };
            };
            
            // Variable contenant les liens dans l'infobulle où celle-ci s'affiche par l'intermédiaire d'un clic droit sur une plaque
            var resultatDist=distancier();
            // console.log("DISTANCE: "+resultatDist);
            // console.log("AFFICHAGE: "+$('#recupid').html());
            var lienDistance = $('#recupid').html();
            var lienTIJ="<a id='afficheTIJ'>Afficher l'efficience(TIJ)</a> <br>";
            var lienDistancier="<a href='distancier.php'>Calcule du distancier</a><br>";
            var lienSitePlaque="<a id='afficheSite'>Afficher/Cacher les sites de la plaque "+PlaqueActuelle+"</a> <br>";
            var usei="<a href='AjouterUSEI.php'>Ajouter</a> /"+"<a href='ModifTec.php'>Modifier</a> /"+"<a href='SupprUSEI.php.php'>Supprimer</a>"+" l'USEI  <br>";
            var site="<a href='Ajouter.php'>Ajouter</a> /"+"<a href='ModifSite.php'>Modifier</a> /"+"<a href='SupprSite.php'>Supprimer</a>"+" le site <br>";
            var plaque="<a href='AjouterZone.php'>Ajouter</a> /"+"<a href='ModifPlaque.php'>Modifier</a> /"+"<a href='SupprPlaque.php'>Supprimer</a>"+" une plaque <br>";
            var technicien="<a href='AjouterTec.php'>Ajouter</a> /"+"<a href='ModifTec.php'>Modifier</a> /"+"<a href='Supprimertech.php'>Supprimer</a>"+" le technicien <br>";

            infoWindow.setContent(lienTIJ+lienDistancier+usei+plaque+site+technicien+lienSitePlaque);
            infoWindow.open(map, polyline);     

            $(document).ready(function()
            {
                $('#afficheTIJ').click(function(){
                    efficienceTIJ(PlaqueActuelle,lattitude,longitude);
                });
                
                $('#afficheSite').click(function(){
                    afficherSitePlaque(PlaqueActuelle);
                });
            });
            
            //setTimeout("displayStreetView('"+point.lat()+"','"+point.lng()+"');",2500);
            
            // On stock ces nouvelles infobulle dans les variables infoOpened et infoOpened2 afin de pouvoir les fermer par la suite
            //infoOpened = infowindow;
            //infoOpened2 = infoWindow;
            
            
        });
        
        
        
        /*google.maps.event.addListener(map, 'click', function(latlng){
            // Permet de fermer l'infobulle si on clique sur la carte
            infoWindow.close(map, marker);
        }); 
        
        google.maps.event.addListener(marker, 'rightclick', function(latlng){//infobulle avec lien modifier marqueur
        
        
        var nomMarkLien= " <b><p> " +nom+ "</p></b>" ;  
        var lienPlaque = "<a href=\"ModifSiteBis2.php?OldName="+nom+"&sec="+type+"\" target=_blank id='lienModif'> Modifier Marqueur (Plaque, Nom, Adresse...)</a> <br>";
        var lienSupprimer="<a href=\"SupprSite2.php?zone="+type+"&oldname="+nom+"\" target=_blank > Supprimer Site</a> ";
        infoWindow.setContent(nomMarkLien+lienPlaque+lienSupprimer);
        infoWindow.open(map, marker);})

        
        
        google.maps.event.addListener(map, 'rightclick', function(latlng){
            // Permet de fermer l'infobulle si on clique sur la carte
            infoWindow.close(map, marker);})*/
            

////////////////////////////// Calcule le centre de la plaque et ajoute l'efficience(TIJ) au centre de la plaque lors d'un clique gauche + verification conexion \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\ 
//google.maps.event.addListener(polyline, 'click', function() 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                
            

////////////////////////////// Modifier plaque lors d'un clique gauche + verification conexion \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\             
google.maps.event.addListener(polyline, 'click', function() 
{

        if ($("input[id='jrOuvre2']").is(':checked'))
        {
            var PlaqueActuelle = this.html;
            // console.log("plaque: "+PlaqueActuelle);
            /*var ce = polygonCenter(this);
            console.log("Centre2: "+ce);*/
            //  $.ajax({

            // url:"activite/activiteRapport.php",

            // type:"GET", 
            // success: function(reponse)//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
            // {
            //     var res = JSON.parse(reponse);
            //     for(var i=0 ; i<zone.length ; i++)
            //     {
            //         if(PlaqueActuelle == zone[i][0])
            //             {
            //                     for(var z=0; z<res.length; z++)
            //                     {
            //                         if(res[z].NOM_AGENCE_NIV2 == zone[i][8])
            //                         {
            //                             var TIJ = res[z].COMPTAGE_TYPETICKET / res[z].COMPTAGE_NOM / parseInt(valeurJrOuvre);
            //                             console.log("TIJ2 : "+TIJ);
            //                         }
            //                     }

            //             }
            //     }
            //     document.getElementById("tij").innerHTML="";
            //     document.getElementById("tij").style.display ="block";
            //     document.getElementById("tij").innerHTML="TIJ "+PlaqueActuelle+" : <b>"+TIJ.toFixed(2);
            // }});
            
        }
        if(this.getEditable()==true)
        {
            creationTableauMarkerTotal();
            nouveauPolygon();
        }
        
        var session= document.getElementById("sess_var").value;//session pour verrifier si l'utilisatuer est connecté en tant qu'administrateur
        
        if(session=="admin"){// ATTENTION !!! code à changer si l'administarteur change 
            this.setEditable(true);
            setSelection(this); 
        }
        if(session != "admin"){// redirection si l'admin n'est pas connecté 
            alert(" vous n'etes pas l'administrateur, vous ne pouvez pas modifier les plaques, veuillez vous connecter en tant qu'administrateur pour modifier les plaques");
             //document.location.replace('login.php');
        }
});
 



  
} 

//Fonction qui calcule le centre du polygone (de la plaque) et retourne ses coordonnées
function polygonCenter(poly){
    var lowx,
        highx,
        lowy,
        highy,
        lats = [],
        lngs = [],
        vertices = poly.getPath();

    for(var i=0; i<vertices.length; i++) {
      lngs.push(vertices.getAt(i).lng());
      lats.push(vertices.getAt(i).lat());
    }

    lats.sort();
    lngs.sort();
    lowx = lats[0];
    highx = lats[vertices.length - 1];
    lowy = lngs[0];
    highy = lngs[vertices.length - 1];
    center_x = lowx + ((highx-lowx) / 2);
    center_y = lowy + ((highy - lowy) / 2);
    return (new google.maps.LatLng(center_x, center_y));
}     
                                                                     

function clearSelection() {
    if (!selectedShape) return;
    selectedShape.setEditable(false);
    selectedShape = null;
  }
  
  
  function setSelection(shape) {  // Permet de selectionner une plaque
    clearSelection();
    selectedShape = shape;
    shape.setEditable(true);
  }
  
function distance(lat1, lon1, lat2, lon2, unit) {
        var radlat1 = Math.PI * lat1/180
        var radlat2 = Math.PI * lat2/180
        var radlon1 = Math.PI * lon1/180
        var radlon2 = Math.PI * lon2/180
        var theta = lon1-lon2
        var radtheta = Math.PI * theta/180
        var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
        dist = Math.acos(dist)
        dist = dist * 180/Math.PI
        dist = dist * 60 * 1.1515
        if (unit=="K") { dist = dist * 1.609344 }
        if (unit=="N") { dist = dist * 0.8684 }
        return dist
    }  
  
 
    
    
function afficherPlaque(val){
    var id= val.getAttribute('id')
    // console.log("valeur: "+val);
    var test1;
    if (val.checked==true){
    
        for (var i=0; i<zone.length;i++){ 
                if(id==zone[i][0]){ 
                
                test1=calculateConvexHull(tabZone2[i], zone[i][2], zone[i][0]);
                // console.log("Plaque: "+test1)
                }
                
                }
    }
        
        
        
    else{

        for (var i=0; i<zone.length;i++){ 

            if(id==zone[i][0]){
                
                for(var k = 0; k<tabPolyline.length; k++){
                        if(tabPolyline[k].html == zone[i][0])
                        {
                            tabPolyline[k].setMap(null)
                        }
                }
            }
        }
    }
}   





