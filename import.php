<html> 
<head> 
<meta charset="utf-8">
<title>test</title> 
</head> 
<?php
// vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
require_once('identifiants.php');

?>
<body> 


<form method="post" enctype="multipart/form-data" action="treatment.php">
<table width="628" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#eeeeee">
<tr>
<td width="500"><font size=3><b>Selectionner votre fichier *.csv :</b></font></td>
<td width="244" align="center"><input type="file" name="userfile" value="userfile"></td>
<td width="137" align="center">
<input type="submit" value="Envoyer" name="envoyer">
</td>
</tr>
</table>
</form>

</body>
</html>