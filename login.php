    <?php require('menu_hors_acceuil.php');?>

<style type="text/css">
        #MonFormulaire {
    /* Pour le centrer dans la page */
    margin: auto auto;
    width: auto;
    /* Pour voir les limites du formulaire */
    padding: 1em;
    border: 1px solid #CCC;
    border-radius: 1em;
}
#MonFormulaire div + div {
    margin-top: 1em;
}
label {
    /* Afin de s'assurer que toutes les étiquettes aient la même dimension et soient alignées correctement */
    display: inline-block;
    width: 90px;
    text-align: right;
    color: #000A2E;
}



</style>


<script type="text/javascript" language="javascript" src="menu.js"></script>


		 <?php

            

            function redirect($url, $time=3){     
                //On vérifie si aucun en-tête n'a déjà été envoyé    
                if (!headers_sent()){
                    header("refresh: $time;url=$url"); 
                    exit;
                }
                else{
                    echo '<meta http-equiv="refresh" content="',$time,';url=',$url,'">';
                }
            }

            if (isset($_POST) && !empty($_POST['login']) && !empty($_POST['pass'])){
                ($GLOBALS["___mysqli_ston"] = mysqli_connect("localhost", "root", "")) or die ("'ERREUR CONNEXION BDD");
                ((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")) or die ("ERREUR CHOIX BDD");
                extract($_POST);
                // on recupère le password de la table qui correspond au login du visiteur
                $sql = "SELECT password FROM users where login='".$login."'";
                $req = mysqli_query($GLOBALS["___mysqli_ston"], $sql) or die('Erreur SQL !');

                $data = mysqli_fetch_assoc($req);
              
                if($data['password'] != $pass) {
                    //echo "<p style='color: #fff; text-align: center;'>Le login ou le mot de passe est incorrect, vous allez être redirigé ...</p>";
                    //redirect("login.php","4");
                    echo "<script type='text/javascript'>
                            alert('Le login ou le mot de passe est incorrect, veuillez réessayer ...');
                            document.location.replace('login.php');
                        </script>";    
                }
                else {
                    //session_start();
                    $_SESSION['login'] = $login;
                    //echo "<p style='color: #fff; text-align: center;'>Vous êtes maintenant identifié, vous allez être redirigé vers la page d'accueil...</p>";
                    //redirect("index.php","4");
                    echo "<script type='text/javascript'>
                            document.location.replace('index.php');
                        </script>";    
                }    
            }
            else{
        ?>
		
        <form id="MonFormulaire" action="login.php" method='post'>
    <div>
        <label for="nom">Login :</label>
        <input type="text" name="login" maxlength="250" >
    </div>
    <div>
        <label for="courriel">Mot de passe :</label>
        <input type="password" name="pass" maxlength="10">
        <br>
        <input type="submit" value="Connectez-vous" style="position: center;"></td>
    </div>
    <div>
    </div>
</form>

		<?php
			}
		?>
	</body>
</html>
