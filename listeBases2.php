<?php
 /* ouverture du repertoire de nom "photos" */
  $pointeur=opendir('SQL');
  $tab = array();

 /* on regarde le contenu pointé par $pointeur, nom par nom */

  
   while ($entree = readdir($pointeur)) {
  
	if ($entree != "." && $entree != "..") 
	{
  		$tab[] = $entree;
	}
	
  } 


 /* fermeture du repertoire repere par $pointeur */
  closedir($pointeur);
  echo JSON_encode($tab);

?>