<a href="#top" id="top"></a>

<?php require('menu.php'); ?>
<!-- FIN DE LA BARRE DE MENU FAIT AVEC BOOTSTRAP -->

<center> <div id="Chargement" style="width:100px" > </div> </center>

<!-- BOUTONS MENUS DEROULANTS -->
<center id="boutons" style="z-index: 10;top:200px;">
    <button class="afficheCacheMenu2"  id="button2" style="z-index:3;
    border: none;
    border-radius: 0px 2px 2px 2px;
    padding: 5px 5px;
    font-size: 16px;
    left:0;
    background-color: #051D2E;color:#FFA119;position: fixed;vertical-align: bottom;">></button>

    <button class="afficheCacheMenu1" id="button1" style=" z-index:3;
    border: none;
    border-radius: 2px;
    padding: 5px 5px;
    font-size: 16px;
    right: 0;
    background-color: #051D2E;color:#FFA119;position: fixed;vertical-align: bottom;"><</button>
</center>
<div class="contentBox" id="content_8">

    <script type="text/javascript"> //Chargement de la page
        function hide_precharge() {
            document.getElementById('imagechargement').style.display='none';
        }
        if (window.attachEvent) { 
            eval("window.attachEvent('onload',hide_precharge);"); 
        }
        else { 
            eval("window.addEventListener('load',hide_precharge,false);"); 
        }
    </script>

    <div id="imagechargement" style="position: absolute; top: 200px; left: 50%;">
        <img src="image/img/load.gif" />
    </div>

    <div class="formDiv" id="map_canvas"></div>  

    <script type="text/javascript">
        console.info("<?php echo $_SESSION['login'];?>");
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
            function checkThree(li){
                for(var i = 0 ; i < tabMarker.length; i++)
                {
                    tabMarker[i].setMap(null);
                }
                var OT = document.getElementById("OT");
                var INC = document.getElementById("INC");
                var WO = document.getElementById("WO");
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
            /*
            Cette fonction permet en cas de click sur l'une des case correspondant aux USEI (menu de droite) de faire apparaître toutes les icones DES PLAQUES en question
            Cette fonction marche de pair avec la fonction checkFour (plus bas dans le code) qui elle permet de gerer la bidirectionnalité entre les deux menu
            */  
            function checkTwo(li){
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
        </script>

<!--********************************************************************************************
*                                                                                              *
*                        CREATION DU MENU GEOGRAPHIQUE (DROITE)                             *                    
*                                                                                              *
*********************************************************************************************-->

<body onload="initialize();">

    <br/>
    <br/>

    <div id="map_index">

        <div id="panel">
            <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><br><br>
            <script type="text/javascript">

                $(document).ready( function () {

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
                
                
                
                </script> 
                
                <br />
                
                <script type="text/javascript">

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

                    
                </script>
                
                
                <ul class="navigation">
                    <?php
                    if(file_exists('data.xml')){
                        unlink('data.xml');
                    }
                    try{
                            // Connexion à MySQL
                        $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
                        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        
                    }
                    catch(Exception $e){
                            // En cas d'erreur, on affiche un message et on arrête tout
                        echo "une erreur est survenue";
                        die('Erreur : '.$e->getMessage());

                    }
                    $req = "SELECT ID, USEI FROM usei";
                    $reponse = $bdd->query($req);       
                    $categories = array();
                    while ($donnees = $reponse->fetch()){
                        $idUsei = $donnees['ID'];
                        $usei = $donnees['USEI'];
                        echo "<li class=\"toggleSubMenu\"><input type=\"checkbox\" name=\"map\" id=\"$usei-ch\" value=\"$usei\" onclick=\"checkThree(this)\"/><span>$usei</span>\n";
                        echo "<ul style=\"display:block; \" class=\"subMenu\">\n";
                        $reponse2 = $bdd->query("SELECT * FROM zone WHERE USEI = '$idUsei'");
                        while ($donnees2 = $reponse2->fetch()){
                            $idZone = $donnees2['ID'];
                            $zone =  $donnees2['Zone'];
                            echo "<li style=\"position: static; left: 5%; \" class=\"toggleSubMenu2 open\"><input type=\"checkbox\" name=\"map\" class=\"five\" id=\"$zone-ch\" value=\"$zone\" onclick=\"checkTwo(this)\"/><span> $zone  </span>\n";
                            echo "<ul style=\"display: block; \" class=\"subMenu2\">\n";
                            $reponse3 = $bdd->query("SELECT ID, SECTEUR, SITE_CLIENT FROM base WHERE SECTEUR = '$idZone'");
                            while ($donnees3 = $reponse3->fetch()){
                                $idSite = $donnees3['ID'];
                                $site = $donnees3['SITE_CLIENT'];
                                echo "<li><input style=\"left:25%;\" type=\"checkbox\" name=\"map\"  value=\"$site\" onclick=\"Envoimap(this)\"/><a href=\"site.php?site=$site\" target=_blank>$site</a></li>\n";
                                }//
                                echo "</ul>\n</li>\n";
                            }
                            echo "</ul>\n</li>\n";
                        }
                        ?>
                        <h3 class="titreZones"><label name="legendeIcone" id="zoneAll">Zones</label></h3>
                        <table>

                            <tr>
                                <td><label> ZONE : Est<input type ="checkbox" name="zone[]" id="USEI_EST" onclick="afficherPlaque(this);"/></label></td>
                                <td><label> ZONE : Ouest<input type ="checkbox" name="zone[]" id="USEI_OUEST"onclick="afficherPlaque(this);"/></label></td>
                            </tr>
                        </table>
                    </ul>
                </div>
                
<!--********************************************************************************************
*                                                                                              *
*                         CREATION DU MENU INDICATEUR (GAUCHE)                               *                    
*                                                                                              *
*********************************************************************************************-->

<div id="menuChoix">


        <center id="contenuu"><h1>Indicateur</h1></br>
        
        <b><p id="indicone" style="position:relative;left:-4px";><span></span> Indicateur Icone</p></b>

        
        <ul class="trie">
        <?php 
        // echo '<script>n=0; console.info(n++);</script>';
        $indic=array("WO","OT","INC");
        foreach($indic as $k => $v){

            echo'<li><label>&nbsp;'.$v;
        
                if(file_exists('data.xml')){
                    echo '<script>console.info(n++);</script>'; 
                    unlink('data.xml');

                }
                 // echo '<script>console.info(n++);</script>'; 

                require('connexion.php');

                $reponse = $db -> prepare('SELECT TYPETICKET, CODESITE, COUNT(*) AS COMPTAGE 
                FROM activite 
                WHERE TYPETICKET = :indic
                GROUP BY CODESITE'); 
                $reponse -> bindValue(':indic',$v);
                $reponse -> execute();

                // echo '<script>console.info(n++);</script>';     
                $Total = 0;
                while ($donnees = $reponse -> fetch(PDO::FETCH_ASSOC))
                {
                    $CMPT = $donnees['COMPTAGE'];
                    $Total= $Total + $CMPT;
                }
                // echo '<script>console.info(n++);</script>'; 
                echo "<span>&nbsp;($Total)&nbsp;&nbsp;:&nbsp;&nbsp;     </span><input type='checkbox' name='act[]' id='$v' value='$Total' /></label>&nbsp;&nbsp;&nbsp;
            </li>";

            }?>
            </ul>
           

                <b><p id="indicplaque" style="cursor:pointer;" ><span></span> Indicateur plaque </p></b>

                <ul class="trie2">
                    <li><label style="cursor:pointer;">Nombre de jours ouvrés :
                        <input type="checkbox" id="jrOuvre" name="jr" value="" /><span></span></label>
                    </li> 
                    
                    <li>
                        <select name="S1" onchange="ClignoteSelect()" id="S1">
                            <option value="C0" id=0>Selectionnez une valeur</option>
                            
                            
                            <?php
                            if(file_exists('data.xml')){
                                unlink('data.xml');
                            }
                            try{
                                        // Connexion à MySQL
                                $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
                                $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            }
                            catch(Exception $e){
                                        // En cas d'erreur, on affiche un message et on arrête tout
                                echo "une erreur est survenue";
                                die('Erreur : '.$e->getMessage());
                            }

                            $req = "SELECT COUNT(TYPETICKET) AS COMPTAGE_TYPETICKET, nombretechnicien.COMPTAGE_NOM,
                            nombretechnicien.NOM_AGENCE_NIV2
                            FROM activiteplaque3, nombretechnicien
                            WHERE nombretechnicien.NOM_AGENCE_NIV2 = activiteplaque3.NOM_AGENCE_NIV2
                            GROUP BY nombretechnicien.NOM_AGENCE_NIV2";
                            $reponse = $bdd->query($req);
                            while($donnees = $reponse -> fetch())
                            {
                                echo("<option></option>");
                            }
                            
                            ?>
                        </select>
                    </li>
                    <br>
                    <div id="AffichePlaque2"></div>
                    
                </ul>
                <script>

                    $("#S1").hide();
                    
                </script>
                

               <b><p id="indicplaque3" style="cursor:pointer;position:relative;left:6px;"><span></span> Indicateur plaque 2 </p></b>
                <ul class="trie4">
                    <li>
                        <label style="cursor:pointer;margin-right: 40px;">Nombre de jours ouvrés :
                            <input type="checkbox" id="jrOuvre3" name="jrOuvre3" value=""/><span></span></label>
                        </li>
                        <li>
                            <input id=RangeTIJ type="range" step="0.05" onchange="ShowRangeValue(this.value)" onmouseup="ClignoteRange(this.value)">
                            <span id="selRange">0</span> 
                            <div id="RangePlaqueClignotante"></div>
                        </li>
                         
                    </ul>

                    <!-- <input id="popFen" type="button" value="  carte  " onclick="ouvrirFenFille()"></input> -->

            
               
                </p>

                <br><br><input href="#" type="button" data-width="50%" data-rel="popup_name" class="poplight" id="fenPop" value="Statistique efficience plaque" style="position:relative;font-size:20px;"></input><br><br><br>


                 <p style="font-size:30px" class="titrePlaque"><label><input type="checkbox" name="plaque" id="Plaque" onclick="cocherToutPlaque(this.checked);"/>Plaques</p><br>
               



                   document.write('<table>');
                   document.write("");
                   document.write("<tr>");

                   var tr=0
                   for (var i =0; i<zone.length;i++){
                    if(i!=8 && i!=9){
                        if(tr%2==0 && tr>0)
                            document.write('</tr><tr>');
                            document.write('<td><label><img src='+zone[i][7]+' >&nbsp;&nbsp;&nbsp;'+zone[i][0]);
                            document.write('&nbsp;&nbsp;&nbsp;<input type=\"checkbox" name="plaque[]" id='+zone[i][0]+'  onclick="afficherPlaque(this);"></label></td>');

                            tr++;
                           
                        }
                    }           
                    document.write("</tr></td></table>"); 
                    function show_hide_div(nomdiv1){
                        $('#menuChoix').toggle();
                        $('#panel').toggle();
                    }




                </script>   

                <h3><label><input type="checkbox" name="legendeIcone" id="Icone" onclick="cocherToutIcone(this.checked);"/>&nbsp;Icones</label></h3><br>


                     <table>

                   <tr>

                       <td><labe><img src="image/img/icone/binome.png" alt="Binome"> : Binome
                        <input type="checkbox" name="icone[]"  id="binome" checked></label></td>

                        <td><label><img src="image/img/icone/boutique.png" alt="Boutique"> : Boutique
                            <input type="checkbox" name="icone[]"  id="boutique" checked></label></td>
                             <td> <label><img src="image/img/icone/service.png" alt="Service"> : Service
                            <input type="checkbox" name="icone[]"  id="service" checked></label></td>


                        </tr>

                        <tr>

                           <td> <label><img src="image/img/icone/pdl.png" alt="pdl"> : PDL
                            <input type="checkbox" name="icone[]"  id="pdl" checked></label></td>

                            <td><label><img src="image/img/icone/pdp.png" alt="pdp"> : PDP
                                <input type="checkbox" name="icone[]"  id="pdp" checked></label></td>


                            <td><label><img src="image/img/icone/pde.png" alt="pde"> : PDE
                                <input type="checkbox" name="icone[]"  id="pde" checked></label></td>

                            </tr>

                        </table>

                   
                    <script>
                        document.getElementById("RangeTIJ").style.display="none";
                        document.getElementById("selRange").style.display="none";
                        function ShowRangeValue(RangeValue)
                        {
                            document.getElementById("selRange").innerHTML = RangeValue;

                        }   
                    </script>

                    <script>

                       var woVal = document.getElementById('WO');
                        if(woVal.checked == true)
                        {
                            woVal = prompt("entrer une valeur repère pour les wo");
                        }



                        function checkFour(li)
                        {
                            var idf = document.getElementById("USEI_IDF-ch");
                            var ouest = document.getElementById("USEI_OUEST-ch");
                            var est = document.getElementById("USEI_EST-ch");

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
    
    
    
        function checkFive(li)//Le paramètre pris est la balise input correspondant a la case du site sur lequel on a cliqué
        {


            var tab = document.getElementsByName("act[]");
            var sousTab = document.querySelectorAll('.five');        
            
            
            
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
        </script>
    </center>
</div>
    

<!-- CARTE GOOGLE MAP -->   
<div id="EmplacementDeMaCarte" align=center>
    
    <script type="text/javascript">
                   	$(function() {
      				$('a[href*="#"]:not([href="#"])').click(function() {
        			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
         			 var target = $(this.hash);
          			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          			if (target.length) {
            		$('html, body').animate({
             		 scrollTop: target.offset().top
           			 }, 1000);
            		return false;
          						}
        					}
      					});
    				});
    </script>
</div> 

<?php   
$monfichier1=fopen('data.xml','a+');
fputs($monfichier1,'<?xml version="1.0" encoding="UTF-8"?>
    <!-- JE PEUX METTRE DES COMMENTAIRES-->
    <xml>
        <markers>
            ');
try{
                // Connexion à MySQL
    $bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
}
catch(Exception $e){
                // En cas d'erreur, on affiche un message et on arrête tout

    die('Erreur : '.$e->getMessage());
}
$reponse = $bdd->query('SELECT usei.id, base.id, zone.id, zone.Zone as ZONE, SITE_CLIENT, ADRESSE, VILLE, CODE_POSTAL, SECTEUR, LONGITUDE, LATITUDE, TECHNICIEN, zone.USEI, usei.usei as USEIFORXML, TYPE_DE_SITE
    FROM base, usei, zone
    WHERE base.SECTEUR = zone.id
    AND zone.usei = usei.ID');
while ($data = $reponse->fetch()){



    if(empty($tt)){
        $tt=$data['ZONE'];
        fputs($monfichier1,'<!-- '.$data['ZONE'].' -->
            ');
    }
    if($tt!=$data['ZONE']){
        fputs($monfichier1,'<!-- '.$data['ZONE'].' -->
            ');
    }
    fputs($monfichier1,'<marker lat="');
    fputs($monfichier1,str_replace(',', '.', $data['LATITUDE']));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'lng="');
    fputs($monfichier1,str_replace(',', '.', $data['LONGITUDE']));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'Zone="');
    fputs($monfichier1,stripcslashes($data['ZONE']));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'Nom="');
    fputs($monfichier1,stripcslashes($data['SITE_CLIENT']));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'adresse="');
    fputs($monfichier1,stripcslashes($data['ADRESSE']));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'nomc="');
    fputs($monfichier1,str_replace('_', ' ', stripcslashes($data['SITE_CLIENT'])));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'codepostal="');
    fputs($monfichier1,$data['CODE_POSTAL']);
    fputs($monfichier1,'" ');
    fputs($monfichier1,'nomtec="');
    fputs($monfichier1,str_replace('_', ' ', stripcslashes($data['TECHNICIEN'])));
    fputs($monfichier1,'" ');
    fputs($monfichier1,'USEI="');
    fputs($monfichier1,$data['USEIFORXML']);
    fputs($monfichier1,'" ');
    fputs($monfichier1,'type="');
    fputs($monfichier1,$data['TYPE_DE_SITE']);
    fputs($monfichier1,'" ');
    fputs($monfichier1,'ville="');
    fputs($monfichier1,stripcslashes($data['VILLE'])); 
    fputs($monfichier1,'" />
        ');
    $tt=$data['ZONE'];
}
fputs($monfichier1,'</markers>');
fputs($monfichier1, "</xml>\n");
fclose($monfichier1);
?>

<script>
    var inputElem = document.getElementsByTagName("input");
    for(i=0;i<inputElem.length;i++){
        if(inputElem[i].getAttribute("type")=="checkbox"){
            inputElem[i].checked = false;
        }
        if(inputElem[i].checked){
            inputElem[i+1].checked=true;
        }
    }
    
</script>


<!--********************************************************************************************
*                                                                                              *
*                             TRAITEMENT ET CODE DE LA LEGENDE                               *                    
*                                                                                              *
**********************************************************************************************-->

    <!-- BOUTON EFFICIENCE -->
   <div id="popup_name" class="popup_block">
        
         <input id="limite" type="button"  value="Choisissez votre propre limite !"></input>
         
         <script>
             $('#limite').click(function()  
            {
                    // alert("salut");
                var nb = prompt("Entrez l'efficience MAX souhaitée");
                
                //$('.chart').hide();
                $("#vide").html("");
                
                histogram(nb);
            });
         </script>
         <div id="vide"></div>
    </div>


    <script>document.getElementById('Icone').checked = true;

            // Fonction pour instancier (créer) un histogramme
            function histogram(nb){

                $.post('diag/index.php',
                {   
                    efficience: nb,
                },
                function(reponse)
                {   
                            //console.log(reponse);
                            $('#vide').append(reponse);
                        });
            };
            
            $('#fenPop').click(function()
            {
                $('#vide').empty();
                histogram(1);
            });
            
            
            
            jQuery(function($){

                //Lorsque vous cliquez sur un lien de la classe poplight
                $('input.poplight').on('click', function() {

                    var popID = $(this).data('rel'); //Trouver la pop-up correspondante
                    var popWidth = $(this).data('width'); //Trouver la largeur

                    //Faire apparaitre la pop-up et ajouter le bouton de fermeture
                    $('#' + popID).fadeIn().css({ 'width': '95%'}).prepend('<a href="#" class="close"><img src="image/img/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>');
                    
                    //Récupération du margin, qui permettra de centrer la fenêtre - on ajuste de 80px en conformité avec le CSS
                    var popMargTop = ($('#' + popID).height() + 80) / 2;
                    var popMargLeft = ($('#' + popID).width() + 80) / 2;
                    
                    //Apply Margin to Popup
                    $('#' + popID).css({ 
                        'margin-top' : -popMargTop,
                        'margin-left' : -popMargLeft
                    });
                    
                    //Apparition du fond - .css({'filter' : 'alpha(opacity=80)'}) pour corriger les bogues d'anciennes versions de IE
                    $('body').append('<div id="fade"></div>');
                    $('#fade').css({'filter' : 'alpha(opacity=80)'}).fadeIn();
                    
                    return false;
                });
                
                
                //Close Popups and Fade Layer
                $('body').on('click', 'a.close, #fade', function() { //Au clic sur le body...
                    $('#fade , .popup_block').fadeOut(function() {
                        $('#fade, a.close').remove();  
                }); //...ils disparaissent ensemble
                    
                    return false;
                });
            });           
    </script>
    


<!--********************************************************************************************
*                                                                                              *
*                           FIN DU TRAITEMENT DE LA LEGENDE                                    *                    
*                                                                                              *
*********************************************************************************************-->

<!--********************************************************************************************
*                                                                                              *
*                           SCRIPT PERMETTANT LA SAUVEGARDE                                    *                    
*                                                                                              *
*********************************************************************************************-->

<script>

        $(".save").click(function(){
        
            var nomSauvegarde = prompt("choisir un nom pour la sauvegarde");
            
            $.ajax({//On envoie par AJAX le nom de la sauvegarde choisi afin que le fichier SQL généré prennent ce nom la
            
                url: "listeBases2.php",
                type: "get",
                success: function(reponse){
                
                    var res = JSON.parse(reponse);
                    for(var i = 0; i< res.length; i++)
                    {
                        var elem = res[i].split('.');
                        if(elem[0] == nomSauvegarde)
                        {
                            if(confirm("cette base existe déjà voulez vous l'ecraser ?"))
                            {
                                $.ajax({
                                    
                                    url: "sauvegarde.php",
                                    type: "get",
                                    data:{"donnee": nomSauvegarde},
                                    error: function(xhr,etat,erreur){   
                                        alert(xhr.status + ":" + erreur);},

                                });                         
                                
                            }
                            else 
                                break;
                        }
                        
                        $.ajax({
                                    
                                    url: "sauvegarde.php",
                                    type: "get",
                                    data:{"donnee": nomSauvegarde},
                                    error: function(xhr,etat,erreur){   
                                        alert(xhr.status + ":" + erreur);},

                                });
                    }
                
                },
        
        
        });
    
    });
    
    </script>

    <!-- PIED DE PAGE -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="text-align: center;">
            <p>Application ORANGE - <a href="http://www.orange.fr/portail" onclick="window.open(this.href); return false;">ORANGE FRANCE</p>
        </div>

        <!-- BOUTON RETOUR EN HAUT --> 
        <a class="col-md-1 col-md-offset-2" id="retourtop" href="#top" title="Retour vers le haut"><img src="image/img2/fleche.png"></a>


    <style>
            body{
                /* Anciens navigateurs */
                background: black url("body-bg.png") repeat-y left;
                -o-background-size: 100% 100%;
                -moz-background-size: 100% 100%;
                -webkit-background-size: 100% 100%;
                background-size: 100% 100%;
                /* Navigateurs récents */
                background-color: #FFFCF2;
            }
            #boutons{
                margin-top: 40px;
            }
            #fade { /*--Masque opaque noir de fond--*/
                display: none; /*--masqué par défaut--*/
                background: #000;
                position: fixed; left: 0; top: 0;
                width: 100%; height: 100%;
                opacity: .80;
                z-index: 9999;
            }
            .popup_block{
                display: none; /*--masqué par défaut--*/
                background: #fff;
                --padding: 20px;
                border: 20px solid #ddd;
                float: left;
                font-size: 1.2em;
                position: fixed;
                top: 10%; left: 51%;
                z-index: 99999;
                /*--Les différentes définitions de Box Shadow en CSS3--*/
                -webkit-box-shadow: 0px 0px 20px #000;
                -moz-box-shadow: 0px 0px 20px #000;
                box-shadow: 0px 0px 20px #000;
                /*--Coins arrondis en CSS3--*/
                -webkit-border-radius: 10px;
                -moz-border-radius: 10px;
                border-radius: 10px;
            }
            
            .popup_block #vide{
                text-align: center;
                margin-left: auto;
                margin-right: auto;
            }
            
            img.btn_close {
                float: right;
                margin: -43px -42px 0 0;
            }
            /*--Gérer la position fixed pour IE6--*/
            *html #fade {
                position: absolute;
            }
            *html .popup_block {
                position: absolute;
            }

        </style>
    
    <input type="hidden" id="sess_var" value="<?php 

    if(isset($_SESSION['login']))
        echo $_SESSION['login']; ?>"/>

    <noscript> 
        <p>Attention : </p> 
        <p>Afin de pouvoir utiliser Google Maps, JavaScript doit être activé.</p> 
        <p>Or, il semble que JavaScript est désactivé ou qu'il n'est pas supporté par votre navigateur.</p> 
        <p>Pour afficher Google Maps, activez JavaScript en modifiant les options de votre navigateur, puis essayez à nouveau.</p> 
    </noscript> 
</body>
</html>


