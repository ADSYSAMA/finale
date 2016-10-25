 <?php

require_once("menu.php");
    if (empty($_SESSION['login'])) {
        echo "<script type='text/javascript'>
            alert('Vous n\'etes pas autorise a acceder a cette page, vous allez etre redirige apres avoir valide cette boite de dialogue');
            document.location.replace('login.php');
            </script>"; // redirection vers "login.html" dans 1 seconde
        die();
    }

    if( (isset($_GET["zone"])) && (isset($_GET["oldname"]))){
    
        ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("ERREUR CONNEXION BDD");
        ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
        $site=$_GET['oldname'];
    
        $sql="SELECT technicien.Technicien FROM technicien,base WHERE technicien.Site=base.SITE_CLIENT AND base.SITE_CLIENT='$site';"; // Selectionne les techniciens où le site est $site pour voir si il y a des techniciens présent
        $req=mysqli_query($GLOBALS["___mysqli_ston"], $sql);

        
        if(mysqli_num_rows($req)==0){ // Si le retour de la requete precedente renvoie 0 ligne... 
            //$sql2="SELECT SITE_CLIENT FROM base WHERE ID='$site';"; 
            //$req2=mysql_query($sql2);
            //$data=mysql_fetch_assoc($req2);
            //$nom=$data['SITE_CLIENT'];
            $sql1="DELETE FROM base WHERE SITE_CLIENT='$site';"; // ...Suppression dans la table base
            $req1=mysqli_query($GLOBALS["___mysqli_ston"], $sql1);
            
            if($req1==true){ // Si la suppression a été effectué avec succes 
                 echo ' <center><h3 style="color: orange;"> Le site : '.$site.' à bien été supprimé </p></center>';
                 echo'<script type=text/javascript> alert("vous serez redirigé vers l\'accueil");</script>';// alert redirection
                 echo "<script type='text/javascript'>
                    document.location.replace('index.php');
                    </script>"; // redirection vers "index.php" dans 1 seconde
                 
                //header("Refresh: 1;url=SupprSite.php");
            }
        }
        else{
            echo '<script type=text/javascript>alert("Suppression non effectuee car il reste des techniciens affectes a ce site.");
			document.location.replace("index.php");
			</script>';
        }
    }
    
    ?> 