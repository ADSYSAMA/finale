<!DOCTYPE html>

<html>
<head>
  <meta name="author" content="Namarcil" />
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>USEI IDF</title>
 
    <!--OUTILS-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcqB2UFZMlycFszNQ-UQ_D2h6ioNE338g"type="text/javascript"></script>
    <script type="text/javascript" src="script.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js" ></script>
    <script type="text/javascript" src="bootstrap.js" language="javascript"></script>
    <script src="respond.js"></script>
    <!-- <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script> --> <!-- Marker -->

    <link rel="stylesheet" href="bootstrap.css" > 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css"> 

    <script type="text/javascript" src="elabel.js" language="javascript"></script>
    <script type="text/javascript" src="function.js" language="javascript"></script> 
    <script type="text/javascript" src="function2.js" language="javascript" ></script>


    <link rel="stylesheet" href="styles.css" type="text/css">
    <link rel="stylesheet" href="style2.css" type="text/css"  media="screen,projection" />
    <link rel="stylesheet" href="style3.css" type="text/css"  media="screen,projection" />
<!--     <link rel="stylesheet" href="style4.css" type="text/cssmenus"  media="screen,projection" /> -->
    <!-- <link rel="stylesheet" href="moteur.css" type="text/css"  media="screen,projection" /> -->
    <link rel="stylesheet" href="stylesAutre.css" type="text/css">
    <link rel="stylesheet" href="diag/plusAffichage.css">
    <link rel="stylesheet" href="diag/affichage.css"> 

  <!-- <script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"></script> --> <!-- Marker -->
  <link rel="shortcut icon" href="image/img/mini_orange.jpg">

   

  <script type="text/javascript">

        function open_infos()
        {
            width = 300;
            height = 200;
            if(window.innerWidth)
            {
                var left = (window.innerWidth-width)/2;
                var top = (window.innerHeight-height)/2;
            }
            else
            {
                var left = (document.body.clientWidth-width)/2;
                var top = (document.body.clientHeight-height)/2;
            }
            window.open('index.php','nom_de_ma_popup','menubar=no, scrollbars=no, top='+top+', left='+left+', width='+width+', height='+height+'');
        }

  </script>
</head>

    <?php
    session_start();
    ?>

<body>
    <!--<a href="#null" onclick="javascript:open_infos();">Ouvrir et centrer la Pop-Up</a>-->
  <div class="row" id="top"> 
    
    <!-- LOGO ORANGE -->
    <div class="col-md-2 col-md-offset-1"><a href='index.php'><img id="logo" src='image/img/france-telecom-orange.jpg' style="width: 80px; height: 80px; border-radius:5px;" title="Cliquez pour revenir à l'accueil" /></a>
    </div>
   
    <!-- TITRE ACCEUIL -->
    <div class="col-md-4 col-md-offset-1" align="center">
      <h1 class="Style1" ><a href='index.php'></a> Orange USEI </h1> <br/>
    </div>

    <!-- BARRE DE RECHERCHE -->
    <div class="col-md-2 col-md-offset-2">
      <form method="post" action="moteur.php" style="float: right;">
        <p>
          <div class="frmSearch">
            <div class="row">
              <div class="col-md-6">
                <input type="text" style="margin-right: 50px;z-index:5"  name="requete" autocomplete="off" placeholder="Chercher un technicien..." />
              </div>
              <div class="col-md-6"> 
                <input type="image" src="image/img/loupe.png" style="margin-left:40px;height:50px;padding-bottom:20px;" title="Entrer un nom et cliquer ici pour chercher un technicien"  alt="Submit" name="submit  "/>
              </div>
            </div>
          </div>          
        </p>
      </form> 
    </div> 
  </div>

  <!-- FONCTION BARRE DE RECHERCHE -->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
  <script>
    $(document).ready(function(){
        $("#search-box").keyup(function(){
            $.ajax({
            type: "POST",
            url: "readCountry.php",
            data:'keyword='+$(this).val(),                      
            });
        });
    });
  </script>

  <!-- CSS -->  
  <style>
    #top{margin-top: 60px;}
    .frmSearch {margin: 2px 0px;padding:20px;}
    #country-list{list-style:none;margin:0;padding:0;width:190px;position:relative;z-index: 10;}
    #country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
    #{line-height: 100px;}
    .col-md-2,{padding-top: 30px;}
  </style>

  <!-- BARRE DE MENU FAIT AVEC BOOTSTRAP -->
  <div id='cssmenu' style='position: :relative; z-index: 3; height:50px;font-size:20px;'>
    <ul>
      <li><a href='index.php'>Acceuil</a></li>
      <li class='active has-sub'><a href='#'>Element</a>
        <ul>
          <li class='has-sub'><a href='#'>USEI</a>
            <ul>
              <li><a href='AjouterUSEI.php'>Ajouter</a></li>
              <li><a href='ModifUSEI.php'>Modifier</a></li>
              <li><a href='SupprUSEI.php'>Supprimer</a></li>
            </ul>
          </li>
          <li class='has-sub'><a href='#'>Plaque</a>
            <ul>
              <li><a href='AjouterZone.php'>Ajouter</a></li>
              <li><a href='ModifPlaque.php'>Modifier</a></li>
              <li><a href='SupprPlaque.php'>Supprimer</a></li>
            </ul>
          </li>
          <li class='has-sub'><a href='#'>Site</a>
            <ul>
              <li><a href='Ajouter.php'>Ajouter</a></li>
              <li><a href='ModifSite.php'>Modifier</a></li>
              <li><a href='SupprSite.php'>Supprimer</a></li>
            </ul>
          </li>
          <li class='has-sub'><a href='#'>Technicien</a>
            <ul>
              <li><a href='AjouterTec.php'>Ajouter</a></li>
              <li><a href='ModifTec.php'>Modifier</a></li>
              <li><a href='Supprimertech.php'>Supprimer</a></li>
            </ul>
          </li>
        </ul>
      </li>
      <li class='active has-sub'><a href='#'>Autre</a>
        <ul>
          <li class='has-sub'><a href='#'>Assigner</a>
            <ul>
              <li><a href='Ajoutertech.php'>Techicien à un site</a></li>
              <li><a href='ModifSansZone.php'>Les marqueurs sans zone</a></li>
            </ul>
          </li>
          <li class='has-sub'><a href='#'>Supprimer</a>
            <ul>
              <li><a href='TechSuppr.php'>Un technicien en fonction du site</a></li>
            </ul>
          </li>
        </ul>
        <li><a href='iti.php'>Itinéaire</a></li>
              <?php 
                if (!empty($_SESSION['login'])&&$_SESSION['login']=="admin")
                {
                  echo '<li><a href="chargementTable2.php">Chargement</a></li>';
                  echo ('<li class="save"><a href="#">Sauvegarde</a></li>');                 
                }
              ?>
        <li><a href="distancier.php">Distancier</a></li>
              <?php
                if (!empty($_SESSION['login']))
                {
                    echo ('<li class="dropdown">                                
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chargement<b></b></a>
                            <ul class="dropdown-menu">');        
                    require("listeBases.php"); 
                    echo ('</ul></li>');
                }
              ?>
              <?php
                if (!empty($_SESSION['login']))
                  echo '<li><a href="deco.php">Déconnexion</a></li>';
                else 
                  echo '<li><a href="login.php">Connexion</a></li>';
              ?> 
    </ul>
  </div>

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