<?php	 
/* 
si la variable de session login n'existe pas cela siginifie que le visiteur 
n'a pas de session ouverte, il n'est donc pas logué ni autorisé à
acceder à l'espace membres
*/
	if($_SESSION['login'] != "admin") {
		echo "<script type='text/javascript'>
			alert('Vous n\'êtes pas autorisé à accéder à cette page, vous allez être redirigé après avoir validé cette boite de dialogue');
			</script>";
		header("Refresh:1;url=login.php"); // redirection vers "login.php" dans 1 seconde
		die();
	}
?>
