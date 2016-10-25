<?php

$envoi = $_GET['donnee'];

$db_server   = "localhost";
$db_name     = "info"; 
$db_username = "root";
$db_password = "";
$db_charset = "utf8"; /* mettre utf8 ou latin1 */
/* C'est tout. Placez ce fichier par FTP quelque part sur votre serveur Web, dans un endroit discret. */
/* Puis ouvrez-le avec votre navigateur web et suivez les instructions. */

echo "sauvegarde.......\n<br>";
$commande = "C:\\wamp\\bin\\mysql\\mysql5.6.12\\bin\\mysqldump.exe --databases -h $db_server -u $db_username $db_name > SQL/$envoi.sql";
system($commande, $ret);
echo $ret;


?>



