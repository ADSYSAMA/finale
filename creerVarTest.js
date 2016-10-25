
	$.ajax({
				
				url:"crerVar.php",
				
				type:"GET",				
								
				success: function(reponse){//Recupere du PHP un tableau contenant toutes les intervention et tous les techniciens par plaque.
				
					var res= JSON.parse(reponse);
					for (var i in res){
						console.log(res[i]);}}
						});