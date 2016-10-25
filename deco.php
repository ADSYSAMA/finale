<?php require('menu_hors_acceuil.php'); ?>


<script type="text/javascript" language="javascript" src="menu.js"></script>


<?php
	if (!empty($_SESSION['login'])){
		session_destroy();
		echo "<p style='color: #fff; text-align: center;'>Vous êtes maintenant déconnecté, vous allez être redirigé vers la page d'accueil...</p>";
		echo "<script type='text/javascript'>
			document.location.replace('index.php');
			</script>";
		
	}
else{
	echo "<script type='text/javascript'>
		alert('Vous devez être connecté pour pouvoir vous déconnecter !');
		document.location.replace('index.php');
		</script>";
	}
?>
