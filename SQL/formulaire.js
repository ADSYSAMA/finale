
// javascript pour afficher ma première ligne de formulaire au chargement
function init() {
	document.getElementById('moreFields').onclick = moreFields;
	//moreFields();
	$('#formu').hide();
	$('#envoyer').hide();
	$('#annuler').hide();
	$('#moreFields').hide();
	$('#test').hide();
	$('#test0').hide();
	$('.nomColo').hide();
	//$('#vide').hide();
	//$('#allTable').hide();
	setSeance();
}

// javacsript qui ajoute une ligne
var counter = 1;
function moreFields() {
	counter++;
	
	//var newFields = document.getElementById('readroot').cloneNode(true);
	var newFields = $('#readroot').clone().find('input').val('').end();
	//console.log(newFields.index());
	newFields.id = '';
	newFields.find('#moins').val('-');
	newFields.css('display: block');
	$('#formu').append(newFields);
	console.log(counter);
	return counter;
}

function afficheFormu(){
	$('#formu').show();
	$('#envoyer').show();
	$('#annuler').show();
	$('#moreFields').show();
	$('#create').hide();
}

function supprimerLigne(element){
	if (counter!=1){
		element.parent().parent().remove();
		counter--;
		console.log(counter);
	}
}

function annulerCreate(){
	$('#formu').hide();
	$('#envoyer').hide();
	$('#annuler').hide();
	$('#moreFields').hide();
	$('#create').show();
}

$(document).ready(function()
{
	// Évènement JavaScript gérant l'affichage du tableau des noms de colonnes ou le fait de le cacher.
	$('#visuel').click(function()
	{
		$('#alert').empty();
		var vide = $('#userfile').val();
		if(vide!=''){
			var etat = $('#visuel').val();
			console.log(etat);
			if(etat=='Voir noms des colonnes'){
				$('#test').show();
				$('#test0').show();
				$('#visuel').val('Cacher noms des colonnes');
				$('.nomColo').show();
			}
			else{
				$('#test').hide();
				$('#test0').hide();
				$('#visuel').val('Voir noms des colonnes');
				$('#test').empty();
				$('.nomColo').hide();
			}
		}
		else{
			var ligne=$('<td colspan=3></td>');
			ligne.text("Veuillez sÃ©lectionner un fichier avant ! Merci.");
			$('#alert').append(ligne);
		}
	});
	
	
	// Évènement JavaScript gérant l'affichage du gestionnaire de tables ou le fait de le cacher.
	$('#allTable').click(function()
	{
		$('#vide').empty();
		var etat = $('#allTable').val();
		console.log(etat);
		if(etat=='Vider/Supprimer Table'){
			$('#vide').show();
			$('#allTable').val('Annuler Vider/Supprimer');
		}
		else{
			$('#vide').hide();
			$('#allTable').val('Vider/Supprimer Table');
		}
	});
});

