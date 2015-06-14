//Implementation de fonction


//Instruction  Interractionutilisateur 
// rechercher

if (window.addEventListener) {
	document.querySelector(' #se_visiteur ').addEventListener('change', function(e) {
		var result = window.confirm("Voulez vous vraiment demannder les frais  du mois selectionné pour ce utilisateur");
		if(result == true) {
		var opt = e.target.selectedIndex;
		var id_opt = e.target[opt].id ;
		document.querySelector('#id_select').value = id_opt ;	
		document.form_identite.submit();
		} else {
			var retour = document.querySelector('#id_select_retour').value ;
			document.querySelector('#se_visiteur')[retour].selected = true ;
		}

	 },
	 false) ;
	}
	else if (window.attachEvent) {
   document.querySelector('#se_visiteur').attachEvent('onclick', function recherche(e) {} ) ;

	}


if (window.addEventListener) {
	document.querySelector(' #se_mois ').addEventListener('change', function(e) {
			
		var result = window.confirm("Voulez vous vraiment demannder les frais  du mois selectionné pour ce utilisateur");
		if(result == true) {
			var opt = e.target.selectedIndex;
		var id_opt = e.target[opt].id ;
			document.querySelector('id_mois_select').value= id_opt ;
			document.form_identite.submit();
		} else {

			var retour = document.querySelector('#id_mois_select_retour').value;
			document.querySelector('#se_mois ')[retour].selected = true ;
		}
	 		
		
	 },
	 false) ;
	}

	if (window.addEventListener) {
document.querySelector('#envoyer').addEventListener('click', function(e) {
	 e.preventDefault() ;
	var result = window.confirm("Voulez vous vraiment demannder les frais  du mois selectionné pour ce utilisateur");
	

		if(result == true) {
			document.form_identite.submit();
		}
	 		
	 		
	
	} , false);

 } 
  else if (window.attachEvent) {

 document.querySelector('#rechercher').attachEvent('onclick', function recherche(e) {} ) ;

	// body.  
}

if (window.addEventListener) {
	document.querySelector(' #se_visiteur ').addEventListener('click', function(e) {
		var opt = e.target.selectedIndex;
		document.querySelector('#id_select_retour').value= opt ;	
	 },
	 false) ;
	}
	else if (window.attachEvent) {
   document.querySelector('#id_select_retour').attachEvent('onclick', function recherche(e) {} ) ;

	}
	if (window.addEventListener) {
	document.querySelector('#se_mois ').addEventListener('click', function(e) {
		var opt = e.target.selectedIndex;
		document.querySelector('#id_mois_select_retour').value= opt ;	
	 },
	 false) ;
	}
	else if (window.attachEvent) {
   document.querySelector('#id_mois_select_retour').attachEvent('onclick', function recherche(e) {} ) ;

	}

// quantites
// fonction traitant des saisies des quantités
function RecupQuantite ( id_courant , id_recup) {

if (window.addEventListener) {
				 document.querySelector(id_courant).addEventListener('focus', function(e) {
				 var valeurActuelle = document.querySelector(id_courant).value ;
				 document.querySelector(id_recup).value = valeurActuelle ;
				} , false);

			 } 
			  else if (window.attachEvent) {

			 document.querySelector('#rechercher').attachEvent('onclick', function recherche(e) {} ) ;
	 
			}

}

function ReetablirQuantite(id_courant , id_recup) {
	if (window.addEventListener) {
			document.querySelector(id_courant).addEventListener('blur', function(e) {
						var valeurActuelle = document.querySelector(id_courant).value ;
						var valeurAncienne = document.querySelector(id_recup).value ;
			 	if(valeurActuelle != valeurAncienne   ) {
						var result = window.confirm("Voulez vous vraiment modifier cette quantite ");
						if(result == true) {
											alert("modification prise en compte") ;
											}
						else {
						var valeurAncienne = document.querySelector(id_recup).value ;
					 	document.querySelector(id_courant).value = valeurAncienne ;
					 	}
				}

			} , false);
		} 	 
	else if (window.attachEvent) {
	 document.querySelector('#rechercher').attachEvent('onclick', function recherche(e) {} ) ;
	 
	}

}




	
	// l'existence seul de l'id repas indique que le visteur a des frais forfaitisés( Repas, Km, etc........)
if(window.document.querySelector('#Etape')) {
		
		//preservation des valeurs actuelles
		// Etape		
	var valeur_id = "#Etape" ;
	var valeur_id_retour = "#Etape_retour" ;
	RecupQuantite ( valeur_id ,valeur_id_retour );

	// Repas
	var valeur_id = "#Repas" ;
	var valeur_id_retour = "#Repas_retour" ;
	RecupQuantite ( valeur_id ,valeur_id_retour );

	// nuit
	var valeur_id = "#Nuit" ;
	var valeur_id_retour = "#Nuit_retour" ;
	RecupQuantite ( valeur_id ,valeur_id_retour );

	// km
	var valeur_id = "#Km" ;
	var valeur_id_retour = "#Km_retour" ;
	RecupQuantite ( valeur_id ,valeur_id_retour );

	// Réétablissement des valeurs

	var valeur_id = "#Etape" ;
	var valeur_id_retour = "#Etape_retour" ;
	
	ReetablirQuantite ( valeur_id ,valeur_id_retour );

	// Repas
	var valeur_id = "#Repas" ;
	var valeur_id_retour = "#Repas_retour" ;
	ReetablirQuantite ( valeur_id ,valeur_id_retour );

	// nuit
	var valeur_id = "#Nuit" ;
	var valeur_id_retour = "#Nuit_retour" ;
	ReetablirQuantite( valeur_id ,valeur_id_retour );

	// km
	var valeur_id = "#Km" ;
	var valeur_id_retour = "#Km_retour" ;
	ReetablirQuantite ( valeur_id ,valeur_id_retour );






}




if(window.document.querySelector('#Etape')) {

var les_boutons_hors_frais = document.querySelectorAll('#div_frais_hors_forfait input[type=button]') ;
var nombre_bouton = les_boutons_hors_frais.length ;
nombre_bouton = nombre_bouton - 1 ;

	for (var i = 0 ; i <= nombre_bouton ; i++) {

		if( window.addEventListener ) {
		document.querySelectorAll('#div_frais_hors_forfait input[type=button]')[i].addEventListener('click', function(e) {

		var le_button = e.target.id  ;


		switch(le_button) {

			case'reporter' :

				var result = window.confirm("Voulez vous vraiment reporter cette ligne frais ?");
				if(result) {
					var id_name =  e.target.previousElementSibling.getAttribute('name') ;
					var nouveau_name = "report" + id_name ;
					e.target.previousElementSibling.setAttribute('name',nouveau_name) ;

					e.target.previousElementSibling.removeAttribute('data-destination') ;
					var supp = e.target.nextElementSibling ;
					e.target.parentNode.removeChild(supp) ;
					e.target.setAttribute('disabled','true');

				}

			break ;

			case'supprimer' :
			var result = window.confirm("Voulez vous vraiment supprimer cette ligne frais ?");

			if(result) {


				var libelle = e.target.previousElementSibling.previousElementSibling.previousElementSibling.value ;
				libelle = libelle + "SUPPRIME" ;
				e.target.previousElementSibling.previousElementSibling.previousElementSibling.value = libelle ;
				var id_name =  e.target.previousElementSibling.previousElementSibling.getAttribute('name') ;
				var nouveau_name = "suppression" + id_name ;
				e.target.previousElementSibling.previousElementSibling.setAttribute('name',nouveau_name) ;
				e.target.previousElementSibling.previousElementSibling.setAttribute('value',libelle) ;

					e.target.previousElementSibling.previousElementSibling.removeAttribute('data-destination') ;
			
				e.target.setAttribute('disabled','true');
				var supp = e.target.previousElementSibling ;
				e.target.parentNode.removeChild(supp) ;



			}


		}


		}, false ) ; 

		 }

		else if (window.attachEvent) {
			document.querySelector('#id_mois_select_retour').attachEvent('onclick', function recherche(e) {} ) ;

		}

	}





}










if( window.addEventListener ) {

					document.querySelector('#validation').addEventListener('click', function (e) {
						// body...
					
						e.preventDefault() ;
						var result = window.confirm("Voulez vous vraiment valider cette fiche de frais ?");
				if(result) {
							var ligne_frais_hf = document.querySelectorAll('#div_frais_hors_forfait input[data-destination]') ;
							var nombre_bouton = ligne_frais_hf.length ;
							nombre_bouton =  nombre_bouton - 1 ;

							for (var i = 0 ; i <=  nombre_bouton; i++) {

										if (ligne_frais_hf[i].hasAttribute('data-destination') == true) {

											var id_hf = ligne_frais_hf[i].getAttribute('id') ;
											var nouveau_name = "validation" + id_hf ;
												ligne_frais_hf[i].setAttribute('name',nouveau_name) ;
											
										}
								
							}
							// activation des lignes de frais hors forfait à transferer
						var ligne_frais_hf = document.querySelectorAll('#div_frais_hors_forfait input[name]') ;
						var nombre_bouton = ligne_frais_hf.length ;
							nombre_bouton =  nombre_bouton - 1 ;
							for (var i = 0 ; i <=  nombre_bouton; i++) {
								ligne_frais_hf[i].removeAttribute('disabled') ;		
								
							}
						
				}
				var opt = document.form_identite.se_visiteur.selectedIndex ;

				document.querySelector('#id_select_bis').value = document.form_identite.se_visiteur[opt].id ;

				var opt = document.form_identite.se_mois.selectedIndex ;
				document.querySelector('#id_mois_select_bis').value = document.form_identite.se_mois[opt].id ;



				document.form_fiche.submit() ;

					} , false) ;
 					


	}

else if  (window.attachEvent)   {



}










// compter mynnode = queryselectorall
 // mynode.ompter
 // for node dans mynode ajouter eventclick
 // apres clique d'un bouton utilise sibbling(input texta areeat  pour les couleur)
 // pour les sibbling buton supprimer  en plus du bouton lui meme






//

// changement d'utilisateur window.addeventlistner (...addeventlistener ('',function() {hhhh ;} ,false); else   window.attachEvent{ ...attachEvent(onclick, function()) ;}



//changement mois



// changement quantite frais forfait

// reporter
	// condition prealable

  // confirmation

// supprimer
		// condition prealable

// confirmation



// valider