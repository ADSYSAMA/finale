	function modifValues(){ 
	var val = $('#progress progress').attr('value'); 
	if (val < 100 && val != 0) {var newVal = val*1+0.75;}
	if (val == 100){ val=0;}
	var txt = Math.floor(newVal)+'%'; 
	$('#progress progress').attr('value',newVal).text(txt); 
	$('#progress strong').html(txt); 
	}
	$('body').onload= setInterval(function(){ modifValues(); },40); 