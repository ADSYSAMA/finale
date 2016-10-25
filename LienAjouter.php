<?php
	require_once("menu.php");
	if (empty($_SESSION['login'])) {
		echo "<script type='text/javascript'>
			alert('Vous n\'êtes pas autorisé à acceder à cette page, vous allez être redirigé après avoir validé cette boite de dialogue');
			</script>";
		header("Refresh:1;url=login.php"); // redirection vers "login.html" dans 1 seconde
		die();
	}
?>

		</br>
		</br>
		</br>
		</br>
		</br>
		</br>
	
		<div style="align:center;">
			<ul>
				<li><a href="AjouterUSEI.php" style="text-decoration : none; color:#FF6600";> Ajouter un USEI  </a></li></br>
				<li><a href="AjouterZone.php" style="text-decoration : none; color:#FF6600";> Ajouter une plaque </a> </li></br>
				<li><a href="Ajouter.php" style="text-decoration : none; color:#FF6600";>  Ajouter un site  </a></li></br>
				<li><a href="AjouterTec.php" style="text-decoration : none; color:#FF6600";> Ajouter un technicien</a></li></br>
				<li><a href="Ajoutertech.php" style="text-decoration : none; color:#FF6600";> Assigner un technicien à un site</a></li>
			</ul>
		</div>	
	</body>
</html>
