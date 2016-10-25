var CheminComplet = document.location.href; //Permet de recuperer le chemlin complet
var CheminRepertoire  = CheminComplet.substring( 0 ,CheminComplet.lastIndexOf( "/" ) );
var NomDuFichier     = CheminComplet.substring(CheminComplet.lastIndexOf( "/" )+1 );  //Permet de recuperer le nom du fichier php ou html

//Permet d'ajouter la class 'active', en fonction de la page ou l'on se situe
if (NomDuFichier=='AjouterUSEI.php') {
	$("a[href='AjouterUSEI.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='AjouterZone.php') {
	$("a[href='AjouterZone.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='Ajouter.php') {
	$("a[href='Ajouter.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='AjouterUSEI.php') {
	$("a[href='AjouterUSEI.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='AjouterTec.php') {
	$("a[href='AjouterTec.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='Ajoutertech.php') {
	$("a[href='Ajoutertech.php']").parent().parent().parent().addClass('active');
}


if (NomDuFichier=='ModifUSEI.php') {
	$("a[href='ModifUSEI.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='ModifPlaque.php') {
	$("a[href='ModifPlaque.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='ModifSite.php') {
	$("a[href='ModifSite.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='ModifTec.php') {
	$("a[href='ModifTec.php']").parent().parent().parent().addClass('active');
}


if (NomDuFichier=='SupprUSEI.php') {
	$("a[href='SupprUSEI.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='SupprPlaque.php') {
	$("a[href='SupprPlaque.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='SupprSite.php') {
	$("a[href='SupprSite.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='Supprimertech.php') {
	$("a[href='Supprimertech.php']").parent().parent().parent().addClass('active');
}
if (NomDuFichier=='TechSuppr.php') {
	$("a[href='TechSuppr.php']").parent().parent().parent().addClass('active');
}



if (NomDuFichier=='distancier.php') {
	$("a[href='distancier.php']").parent().addClass('active');
}

if (NomDuFichier=='iti.php') {
	$("a[href='iti.php']").parent().addClass('active');
}

if (NomDuFichier=='index.php') {
	$("a[href='index.php']").parent().addClass('active');
}

if (NomDuFichier=='login.php') {
	$("a[href='login.php']").parent().addClass('active');
}

$(function(){

	$(".optionStat").click(function(){$(this).addClass('active')});
	
});
