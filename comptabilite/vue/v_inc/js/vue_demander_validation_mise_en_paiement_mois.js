//Implementation de fonction


//Instruction  Interraction utilisateur 
// rechercher

/**
** functionn selectionner
   @param select : element Html soumis à un évenement
   @param choix id : le choix de l'utilisateur après declenchement de l'évenement
   @param retour_id : retour à l'état initial de l'élement HTML avant le declement de l'évenement 

**/
function selectionner (select , choix_id , retour_id) {

	if (window.addEventListener) {
		document.querySelector(select).addEventListener('change', function(e) {
			var result = window.confirm("Voulez vous vraiment demander les frais  du mois selectionné pour ce utilisateur");
			if(result == true) {
			var opt = e.target.selectedIndex;
			var id_opt = e.target[opt].id ;
			document.querySelector(choix_id).value = id_opt ;	
			document.form_identite.submit();
			} else {
				var retour = document.querySelector(retour_id).value ;
				document.querySelector(select)[retour].selected = true ;
			}

		 },
	 	false) ;
	}
	else if (window.attachEvent) {
   				document.querySelector(select ).attachEvent('onchange', function recherche(e) {
   					var result = window.confirm("Voulez vous demander les frais  du mois selectionné pour ce utilisateur");
					if(result == true) {
					var opt = e.target.selectedIndex;
					var id_opt = e.target[opt].id ;
					document.querySelector(choix_id).value = id_opt ;	
					document.form_identite.submit();
					} else {
						var retour = document.querySelector(retour_id).value ;
						document.querySelector(select)[retour].selected = true ;
					}

   			} ) ;

	}

}

/**
  fonction preserver 
  @param select : element Html soumis à un évenement
   @param id_select_retour : id de l'element HTML à retourner si le choix de  utilisateur a fini par être renoncé
**/

function preserver (id_select ,id_select_retour) {

	if (window.addEventListener) {
			document.querySelector(id_select).addEventListener('click', function(e) {
			var opt = e.target.selectedIndex;
			document.querySelector(id_select_retour).value = opt ;	
	 },
	 		false) ;
	}
	else if (window.attachEvent) {
   		document.querySelector(id_select).attachEvent('onclick', function recherche(e) {
   		var opt = e.target.selectedIndex;
		document.querySelector(id_select_retour).value = opt ;	
   } ) ;

	}
	
}
	







// choix utilisateur
var un_select = "#se_visiteur" ;
var un_choix_id = "#id_select" ;
var un_retour_id = "#id_select_retour" ;
selectionner (un_select , un_choix_id , un_retour_id) ;
// choix mois
var un_select = "#se_mois" ;
var un_choix_id = "#id_mois_select" ;
var un_retour_id = "#id_mois_select_retour" ;
selectionner (un_select , un_choix_id , un_retour_id) ;

// les retours selection utilisateur 
var un_choix_id = "#se_visiteur" ;
var un_retour_id = "#id_select_retour" ;
preserver(un_choix_id , un_retour_id) ;
// les retours selection mois
var un_choix_id = "#se_mois" ;
var un_retour_id = "#id_mois_select_retour" ;
preserver(un_choix_id ,un_retour_id ) ;



if(window.document.querySelector('#Etape')) {
		//valisation
		if( window.addEventListener ) {

					document.querySelector('#validation').addEventListener('click', function (e) {			
							e.preventDefault() ;
							var result = window.confirm("Voulez vous vraiment mettre en paiement cette fiche de frais ?");
							if(result) {
							var opt = document.form_identite.se_visiteur.selectedIndex ;
							document.querySelector('#id_select_bis').value = document.form_identite.se_visiteur[opt].id ;
							var opt = document.form_identite.se_mois.selectedIndex ;
							document.querySelector('#id_mois_select_bis').value = document.form_identite.se_mois[opt].id ;
							
							document.form_fiche.submit() ;
							}
				
					} , false) ;

		}

		else if  (window.attachEvent)   {
					document.querySelector('#validation').attachEvent('onclick', function (e) {
						e.preventDefault() ;
							var result = window.confirm("Voulez vous vraiment mettre en paiement cette fiche de frais ?");
							if(result) {
							var opt = document.form_identite.se_visiteur.selectedIndex ;
							document.querySelector('#id_select_bis').value = document.form_identite.se_visiteur[opt].id ;
							var opt = document.form_identite.se_mois.selectedIndex ;
							document.querySelector('#id_mois_select_bis').value = document.form_identite.se_mois[opt].id ;
							document.form_fiche.submit() ;	
						}	
					} );

		}
}				
// compter mynnode = queryselectorall
 // mynode.ompter
 // for node dans mynode ajouter eventclick
 // apres clique d'un bouton utilise sibbling(input texta areeat  pour les couleur)
 // pour les sibbling buton supprimer  en plus du bouton lui meme
//changement mois



// changement quantite frais forfait

// reporter
	// condition prealable

  // confirmation

// supprimer
		// condition prealable

// confirmation



// valider