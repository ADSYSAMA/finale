<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			 document.location.replace('login.php');
			 </script>";
		//header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
		die();
	}
?>


<form id="MonFormulaire" name="form" method="post" action="ModifTecBis.php" onsubmit="valider(event);" >

    </br><center><h1><strong style="color:white;">Modifier un Technicien</strong></h1></center></br></br>
    <p> <h4> Techniciens : </h4></p>
<select id="tech" name="tech">
        <?php
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
        ?>

    
        <?php
        $req = "SELECT * from technicien ORDER BY Technicien";
        $reponse = $bdd ->query($req);
        while($data = $reponse->fetch())
        {
            echo("<option value=".$data['ID'].">".$data['Technicien']."</option>");
        }

        ?>
    
</select>
	<br/> <br/>
	<input type="submit" value="Modifier"/>
</form>
