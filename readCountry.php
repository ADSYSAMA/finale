<?php
require('config.php');
require_once('connexion.php');

if(!empty($_POST["keyword"])) {
	$sql="SELECT * FROM technicien WHERE Technicien like '" . $_POST["keyword"] . "%' ORDER BY Technicien LIMIT 0,6";

$query =$db->prepare($sql);
$query->execute();

while($result = $query->fetch(PDO::FETCH_ASSOC)){
?>

<ul id="country-list">
	<li><?php echo $result["Technicien"]; ?></li>
</ul>

<?php } } ?>