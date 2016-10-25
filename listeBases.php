
<?php
  $pointeur=opendir('SQL');

 /* on regarde le contenu pointé par $pointeur, nom par nom */
  while ($entree = readdir($pointeur)) {
  
	if ($entree != "." && $entree != "..") 
	{
		echo '<li id="chargement" onchange="chargement()"><a href="#">'.$entree.'</a></li>';
	}
	
  }



 /* fermeture du repertoire repere par $pointeur */
  closedir($pointeur);

  
?>


	
	
