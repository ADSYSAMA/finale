  <?php
     try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=info', 'root', '');
		$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(Exception $e)
	{
		echo "une erreur est survenue";
		die('Erreur : '.$e->getMessage());
	}
			$reqC=' SELECT UrlImageLegende, UrlImageA,CouleurInfo from couleurs';
			$reqC1 = $bdd -> query($reqC);
			$data=$reqC1->fetchAll(PDO::FETCH_NUM);
			//print_r($data);
			//echo(Count($data));
			for($i = 0 ; $i < COUNT($data); $i++) 
				{
					echo (' Couleur : <label><img src='.$data[$i][0].'>  et Marqueur :<label><img src='.$data[$i][1].'> <input type="radio" name= couleur id='.$data[$i][2].' ></label></td><br/>' );
				
			}
			
	?>