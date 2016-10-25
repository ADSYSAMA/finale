<?php require('menu.php');?>

	
		<br><br>
		<center style="position:relative;color:white;">

	<h1><b>Chargement de données</b></h1><br>
		<form method="POST" enctype="multipart/form-data" action="bigdump.php">

		<br><br>
		<label>Mode : <select name="mode"><br>
				<option value="1">ajouter</option>
				<option value="2">remplacer</option>
		</select><br><br></label><br><br>

		<?php
		require("connexion.php");

		$sql="show tables";
		$req= $db->prepare($sql);
		$req->execute();
		?>
			<label>Selectionnez la table :
							  <select name="table">

								<?php   
										 while($res = $req->fetch(PDO::FETCH_NUM)){
           									echo "<option value='".$res[0]."'>".$res[0]."</option>";        
       									 }?>
							  <select/> </label><br><br><br><br>

							 <p>  Les colonnes de la nouvelles tables correspondent-elles aux colonnes de l'image ci-dessus  : &nbsp;&nbsp;

							 <label>   Oui  &nbsp;&nbsp;&nbsp;&nbsp;<input id="radio1" value="1" name="radio1[]" type="checkbox"></label>  &nbsp;&nbsp;&nbsp;&nbsp;<!-- Non &nbsp;&nbsp;<input id="radio1" value="1" name="radio1[]" type="checkbox"></label><br><br> -->
							 <br><br>
								 Les valeurs de votre nouvelles tables sont-elles cohérentes avec les valeurs des colonnes de l'ancienne  : &nbsp;&nbsp;

							<label>   Oui &nbsp;&nbsp;&nbsp;&nbsp;<input id="radio2" value="2" name="radio2[]" type="checkbox" ></label>  &nbsp;&nbsp;&nbsp;&nbsp;<!-- Non &nbsp;&nbsp; <input id="radio2" value="2" name="radio2[]" type="checkbox" ></label>--></p> 
								
<br>
		<div id="parcourir" style="display:none;">
		<input name="submit" type="submit" value="Charger"/>
		</div>
		</form>

 <script type="text/javascript"> 
 
 					$(document).ready(function(){
console.info("<?php echo $_SESSION['login'];?>");
 							$('input').click(function(){


                      		 	if (CheckRadio('radio1[]')==true && CheckRadio('radio2[]')==true)
									$('#parcourir').show();
								else
									$('#parcourir').hide();

								
});
								function CheckRadio(name) { 
	//recupere tous les objets qui ont le nom "name" 
	var objs=document.getElementsByName(name); 
	//Pour chaques objets.... 
	for(i=0;i<objs.length;i++) { 
		//Si l'objet en cours en coché on renvoie true 
		if (objs[i].checked==true) 
			return true; 
	} 
	//Si on arrive ici, aucun radio-bouton n'est coché, on renvoie false 
	return false; 
}
});
								 </script>
								 </center>
