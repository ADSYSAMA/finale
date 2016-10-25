 <div id='cssmenu' style='position: :relative; z-index: 2; height:50px;'>
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
               <li><a href='ModifSite.
                   php'>Modifier</a></li>
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
           <li><a href='ModifierSansZone.php'>Les marqueurs à un site</a></li>
           <li><a href=''>Les marqueurs sans zone</a></li>
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
    echo ('<li class="save">                                
        <a href="#">Sauvegarde</a>
    </li>');                

}
?>
<li><a href="distancier.php">Distancier</a></li>
    
    <?php
    if (!empty($_SESSION['login']))
    {
        echo ('<li class="dropdown">                                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Chargement<b class="caret"></b></a>
                <ul class="dropdown-menu">');
                    
        require("listeBases.php"); 
            

        echo ('</ul>
        </li>');
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