//
// This script is based on :
// http://www.editeurjavascript.com/scripts/scripts_navigation_3_182.php
//

/*
function getCurrentAnchor()
{
	return window.location.hash.substring(1);
}
*/

function DivStatus(divNom, imgNom, traitNom, numero, plusImgPath, minusImgPath)
{
	var divID = divNom + numero;
	var imgID = imgNom + numero;
	var traitID = traitNom + numero;
	var self;
	var trait;

	PcH = false;
	if ( document.getElementById && document.getElementById( divID ) ) // Pour les navigateurs récents
	{
		Pdiv = document.getElementById( divID );
		self = document.getElementById( imgID );
		trait = document.getElementById( traitID );
		PcH = true;
	}
	else if ( document.all && document.all[ divID ] ) // Pour les veilles versions
	{
		Pdiv = document.all[ divID ];
		self = document.all[ imgID ];
		PcH = true;
	}
	else if ( document.layers && document.layers[ divID ] ) // Pour les très veilles versions
	{
		Pdiv = document.layers[ divID ];
		self = document.layers[ imgID ];
		PcH = true;
	}

	if ( PcH )
	{  /* block none block*/
		Pdiv.style.display = Pdiv.style.display == 'none'?'block':'none';
		/* block block none */
		trait.style.display = Pdiv.style.display == 'none'?'none':'block';
		self.src = ( Pdiv.style.display == 'none' ) ? plusImgPath : minusImgPath;
	}
}
