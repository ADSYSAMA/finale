<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>test</title> 
</head> 
<?php
// vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
require_once('identifiants.php');

?>
<body> 

<style>
	#fichier td{
		--border: 1px solid;
	}
	
	#envoie{
		margin-left: 50px;
		margin-right: 50px;
	}
</style>

	<!-- Formulaire principal de la page "Bigdump.php". -->
	<form method="post" enctype="multipart/form-data" action="traitement.php">
		<table border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#eeeeee" id="fichier">
			<tr><td colspan=3><input type="button" class="button" id='create' value="Creer une table" onclick="afficheFormu()" /></td></tr>
			<tr colspan=5 height=10px></tr>
			<tr id="selection">
				<td width="300"><font size=3><b>Selectionner votre fichier *.csv :</b></font></td>
				<td align="center" width="300" colspan=2><input type="hidden" name="MAX_FILE_SIZE" value="10000000"><input type="file" name="userfile" id="userfile" value="userfile"></td>
			</tr>
			<tr colspan=5 height=10px></tr>
			<tr><td width="600" colspan=2><a href="#" data-width="500" data-rel="popup_name" class="poplight" id="fenPop">Vider/Supprimer Table</a><input type="submit" value="Envoyer" name="envoyer" id="envoie"><input type="button" value="Voir noms des colonnes" name="visuel" id="visuel"></tr>
			<tr id="alert"></tr>
		</table>
	</form>

</body>
</html>