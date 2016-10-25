<?php


require_once("menu.php");

	
	
	
	
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{

//On nettoie un peut la requête
$requete =strtr($_POST['requete'],'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ' , 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

 
mysql_connect('localhost','root','');
mysql_select_db('info'); 
// or die('Impossible de s&eacute;lectionner une base de donn&eacute;e. Assurez vous d\'avoir correctement remplit les donn&eacute;es du fichier connexion_bd.php.');

$query = mysql_query("SELECT * FROM technicien WHERE USEI
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR NOM_AGENCE_NIV1 
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR NOM_AGENCE_NIV2
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR CODE
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR USEI
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR NOM
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR PRENOM
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR POINT_EMBAUCHE
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR Tel
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR Mail
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' OR Site
REGEXP '[[:<:]]".mysql_real_escape_string($requete)."[[:>:]]' ORDER BY Technicien DESC") 
or die (mysql_error()); 

//On utilise la fonction mysql_num_rows pour compter les résultats
$nb_resultats = mysql_num_rows($query); 
//Si le nombre de résultats est différent de 0, on continue
	if($nb_resultats != 0)
	
		{
		//On affiche le nombre de résultats 
			echo '<p class="white">Il existe <b>'.$nb_resultats.' </b>'; 
			if($nb_resultats > 1)
				// on vérifie le nombre de résultats pour orthographier correctement. 
				{ 
					echo ' r&eacute;sultats';
				}
			else 
				{ 
					echo ' r&eacute;sultat'; 
				} 
				echo ' pour votre recherche dans la base de données des techniciens, pour "<b>'.$requete.'</b>" :<br/></p>';
				//On attribue un chiffre pour chaque enregistrement trouvé
				$i = "1";
				?>
				<table>
								
								
								<th>Nom USEI</u></th>
								<th>Nom de plaque</th>
								<th>Nom de secteur</th>
								<th>Code technicien</th>
								<th>Nom du technicien</th>
								<th>Prenom du technicien</th>
								<th>Adresse du point d'embauche</th>
								<th>Numero de telephone</th>
								<th>Adresse e-mail</th>
								<th>Adresse du site</th>
								
								</tr>
								<?php
					//On boucle pour afficher la liste des enregistrements trouvés
					while($donnees = mysql_fetch_array($query)) 
						{ 
 
							?>	
								<tr>
								
								<td><?php echo $donnees['USEI']; ?></td>
								<td><?php echo $donnees['NOM_AGENCE_NIV1']; ?></td>
								<td><?php echo $donnees['NOM_AGENCE_NIV2']; ?></td>
								<td><?php echo $donnees['CODE']; ?></td>
								<td><?php echo $donnees['NOM']; ?></td>
								<td><?php echo $donnees['PRENOM']; ?></td>
								<td><?php echo $donnees['POINT_EMBAUCHE']; ?></td>
								<td><?php echo $donnees['Tel']; ?></td>
								<td><?php echo $donnees['Mail']; ?></td>
								<td><?php echo $donnees['Site']; ?></td>
								
								
								</tr>
								
						
							
							
							<?php
							$i++;
							
						}

							
		//on ferme if($nb_resultats > 1)
		}
		
	
	
	//Si il n'y a rien
	else 
	{
		echo "<p style='color : white;'>Nous n'avons trouv&eacute; aucun r&eacute;sultats pour votre recherche <b>
		'$requete'</b> dans la base de données des techniciens !</p>";
	}
	//On ferme if(isset($_POST['requete'])
	echo "</table>";



}
?>

</body>
</html>
