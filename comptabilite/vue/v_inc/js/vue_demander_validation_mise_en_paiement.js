//Implementation de fonction


//Instruction  Interractionutilisateur 
// rechercher

if (window.addEventListener) {
	document.querySelector(' #se_visiteur ').addEventListener('change', function(e) {
		var opt = e.target.selectedIndex;
		var id_opt = e.target[opt].id ;
		document.querySelector('#id_select').value= id_opt ;	
	 },
	 false) ;
	}
	else if (window.attachEvent) {
   document.querySelector('#se_visiteur').attachEvent('onclick', function recherche(e) {} ) ;

	}

if (window.addEventListener) {
document.querySelector('#rechercher').addEventListener('click', function(e) {
	 e.preventDefault() ;
	 	var num = document.querySelector('#se_visiteur').selectedIndex ;
	 	var id_select = document.querySelector('#se_visiteur ')[num].id ;
	 		if (id_select != "indicateur" ) {
	 			document.form_identite.submit();
	 		}
	
	} , false);

 } 
  else if (window.attachEvent) {

 document.querySelector('#rechercher').attachEvent('onclick', function recherche(e) {} ) ;

	// body.  
}




