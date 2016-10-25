<?php
try
{
// Connexion à MySQL
$db = new PDO('mysql:host=localhost;dbname=test','root', '');
}
catch (Exception $e)
// En cas d'erreur, on affiche un message et on arrête tout
{
		echo "une erreur est survenue";
        die('Erreur : ' . $e->getMessage());
}
?>


