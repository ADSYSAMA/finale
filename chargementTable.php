<?require('menu.php');?>

<body>

		<h3>Veuillez choisir un fichier *.csv : </h3>
		<form method="POST" enctype="multipart/form-data" action="chargementTable.php">
		<input name="bdd" type='text'/>
		<input name="table" type="text" />
		<select><option value="1">rajouter</option>
				<option value="2">remplacer</option>
		</select>
		<input name="userfile" type="file" value="Table" />
		<input name="submit" type="submit" value="Charger"/>
		</form>

<?php

if(isset($_POST['submit'])){

	if($_FILES["fichier"]["type"] != "application/vnd.ms-excel"){
		die("Ce n'est pas un fichier de type .csv");

		elseif(is_uploaded_file($_FILES['fichier']['tmp_name'])){

			extract(filter_input_array(INPUT_POST));

			$fichier=$_FILES["userfile"]["name"];

		if($fichier){ // ouverture du fichier tmp

			$fp= fopen ($_FILES["userfile"]["tmp_name"], "r"); 
		}

		else{ //fichier non trouvé ?>

			<p align="center" >- Importation echouee -</p>
			<p align="center" ><B> Desole, mais vous n'avez pas specifie de chemin valide ...</B></p>
			<?php exit();}

// cpt = variable comptant le nombre de modification
			$cpt=0;?>  
			<p align="center">- Importation Reussie -</p>
		<?php

			$ligne = fgets($fp,4096);

			while(!feof($fp)){
				$liste = explode(";",$ligne);
				$table = filter_input(INPUT_POST, 'userfile');
			}

			// premier élément
		$liste[0] = (isset($liste[0])) ? $liste[0]: Null;
		$liste[1] = (isset($liste[1])) ? $liste[1]: Null;
		$liste[2] = (isset($liste[2])) ? $liste[2]: Null;
		$liste[3] = (isset($liste[3])) ? $liste[3]: Null;
		$liste[4] = (isset($liste[4])) ? $liste[4]: Null;
		$liste[5] = (isset($liste[5])) ? $liste[5]: Null;
		$liste[6] = (isset($liste[6])) ? $liste[6]: Null;

		$champs1=$liste[0];
		$champs2=$liste[1];
		$champs3=$liste[2];
		$champs4=$liste[3];
		$champs5=$liste[4];
		$champs6=$liste[5];
		$champs7=$liste[6];



		if($champs1!='')
		{
			$cpt++;
			require('connexion.php');
				
				if($('select').val()=2)
				$sql="DELETE from :table";

				$sql.="
				LOAD DATA INFILE :file 
				INTO TABLE :table
				FIELDS TERMINATED BY ',' 
				ENCLOSED BY :comma
				LINES TERMINATED BY '\n'
				IGNORE 1 ROWS";


				$req=$db->prepare($sql);
				$req->bindParam(':file',$_POST['userfile']);
				$req->bindValue(':table',$_POST['table']);
				$req->bindValue(':comma','"');
				$req->execute();


		}
$this->redirect('index.php?view=people', 'fichier envoyé à la base');
	}
		// fermeture du fichier
		fclose($fp); 
?>
	<h2> Nombre de modification : </h2><b><?php echo $cpt;?></b>

</body>
</html>