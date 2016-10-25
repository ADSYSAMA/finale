 <?php


require_once("menu_hors_acceuil.php");

    
    
    
    
if($_SERVER['REQUEST_METHOD'] == 'POST') 
{

//On nettoie un peut la requête
$requete =strtr($_POST['requete'],'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ' , 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');

 
($GLOBALS["___mysqli_ston"] = mysqli_connect('localhost', 'root', ''));
((bool)mysqli_query($GLOBALS["___mysqli_ston"], "USE info")); 
// or die('Impossible de s&eacute;lectionner une base de donn&eacute;e. Assurez vous d\'avoir correctement remplit les donn&eacute;es du fichier connexion_bd.php.');

$query = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM technicien WHERE USEI
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR NOM_AGENCE_NIV1 
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR NOM_AGENCE_NIV2
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR CODE
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR USEI
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR NOM
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR PRENOM
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR POINT_EMBAUCHE
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR Tel
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR Mail
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' OR Site
REGEXP '[[:<:]]".((isset($GLOBALS["___mysqli_ston"]) && is_object($GLOBALS["___mysqli_ston"])) ? mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $requete) : ((trigger_error("[MySQLConverterToo] Fix the mysql_escape_string() call! This code does not work.", E_USER_ERROR)) ? "" : ""))."[[:>:]]' ORDER BY Technicien DESC") 
or die (((is_object($GLOBALS["___mysqli_ston"])) ? mysqli_error($GLOBALS["___mysqli_ston"]) : (($___mysqli_res = mysqli_connect_error()) ? $___mysqli_res : false))); 

//On utilise la fonction mysql_num_rows pour compter les résultats
$nb_resultats = mysqli_num_rows($query); 
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
                <table style="width:1500px">   
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
                    while($donnees = mysqli_fetch_array($query)) 
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
