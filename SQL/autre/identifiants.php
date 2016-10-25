<?php
try
{
// Connexion à MySQL
$db = new PDO('mysql:host=localhost;dbname=test','root', '',array(PDO::MYSQL_ATTR_LOCAL_INFILE=>1));
}
catch (Exception $e)
// En cas d'erreur, on affiche un message et on arrête tout
{
		echo "une erreur est survenue";
        die('Erreur : ' . $e->getMessage());
}
?>


