<?php
require_once('config.php');
try
{
	$login = DB_USER; 
	$mdp = DB_PASSWORD; 
	$dsn = DB_DRIVER .":dbname=" . DB_DATABASE . ";host=" . DB_SERVER; 

	$db = new PDO($dsn,$login,$mdp);
	$db->query('SET NAMES utf8');
  	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e)
{
   	// On termine le script en affichant le n de l'erreur ainsi que le message 
    die('<p> La connexion a échoué. Erreur[' .$e->getCode().'] : ' .$e->getMessage() . '</p>');
}
?>