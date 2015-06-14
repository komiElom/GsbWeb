<?php
session_start();
 /**
 ** chargement des classes métiers  et technique
** classe "le requeteur" : est utilisé pour envoyer des requêtes
** classe "la connection" : est utilisé par le requeteur
** classe "comptable" : l'acteur du cas  d'utlisation  effectuant
**  la demande de connection
* @package model
**/
require '../_inc/laconnection.php' ;
require '../_inc/comptable.php' ;
require '../_inc/requeteur.php ';

 /**
 ** insertion du libelle en fonction du id hors forfait
 **/
if(!$_SESSION['id_hf_supp'] == '' ) {

	foreach ($_SESSION['id_hf_supp']as $key ) {
			$nbre_id = 0 ;
			$nbre_id = $nbre_id + 1 ;
				}
			$nbre_id = $nbre_id -1 ;
	for ($i= 0; $i <= $nbre_id ; $i++) { 
			$une_connection = new Laconnection () ;
			$ma_connection = $une_connection->par_mysql() ;
			$uncomptable = new Comptable () ;
			/**
			** appel de la methode supprimer_ligne_hors_forfait
			** @param $_SESSION['libelle_supp'][$i] : un nouveauu libelle
			** @param $_SESSION['id_hf_supp'][$i] : le id de frais hors forfait
			** @return une chaine de caractère servant de requete sql 
			**/
			$une_requete = $uncomptable->supprimer_ligne_hors_forfait($_SESSION['libelle_supp'][$i] , $_SESSION['id_hf_supp'][$i]) ;
			$un_requeteur = new Requeteur () ;
			/**
			** appel de la methode envoyer_mysql
			** @param $type_select : false , ne renvoi pas de resultat
			**/
			$type_select = false ;
			$mise_a_jour = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;
			/**
			** creation de la session confirmation, si aucune erreur de la methode envoyer_mysql n'est intervenue
			**/

			if($mise_a_jour == true) {
				$_SESSION['confirmation'] = " ok" ;
			}
	}
	
}	

/**
** recherche de la periode à atteindre en cas de  report des frais forfaitises
**
**/

if(!$_SESSION['id_hf_report'] == '') {

	 $annee_Actuel = substr($_SESSION['mois_encours'],0 ,4) ;
	 $mois = substr($_SESSION['mois_encours'], 4 ) ;


	 	switch ($mois ) {
		case '12':
			$mois_plus_n = 01 ;
			$annee_plus_n = $annee_Actuel + 1 ;

		    break;

		default:
			$mois_plus_n = $mois + 1 ;
			$annee_plus_n = $annee_Actuel ;
			break;
		}
	
 	if ($mois_plus_n < 10 ) { 
 		$periode_plus_n  = $annee_plus_n."0".$mois_plus_n ;
 	} else {
 		$periode_plus_n  = $annee_plus_n.$mois_plus_n ;
 	}
	foreach ($_SESSION['id_hf_report'] as $key ) {
			$nbre_id = 0 ;
			$nbre_id = $nbre_id + 1 ;
				}
			$nbre_id = $nbre_id -1 ;
			/**
			** verification si une fiche de frais non validé pour la periode p+1 est disponible oui non
			** appel de la méthode par_mysql
			** appel de la méthode rechercher_fiche_frais_nouvel_periode
			** @param $_SESSION['id_encours'] : id du visteur
			** @param $periode_plus_n : le mois suivant 
			** @return chaine de caratère devant effectuer la requete sql
			**/
			$une_connection = new Laconnection () ;
			$ma_connection = $une_connection->par_mysql() ;
			$uncomptable = new Comptable () ;
			$une_requete = $uncomptable->rechercher_fiche_frais_nouvel_periode( $_SESSION['id_encours'], $periode_plus_n) ;
			
			/**
			** appel la methode envoyer_mysql 
			** @param $une_requet  : une requete 
			** @param  $ma_connection : une connection 
			** @param $type_select : true , pour retourner un resultat sql 
			** @return : $detection_periode , vrai s'il existe reellement une fiche de frais du mois suivant
			**/
			$un_requeteur = new Requeteur () ;
			$type_select = true ;
			$detection_periode = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;

			/**
			** création d'une fiche de la période p+1 , si aucune fiche de frais non detectée
			**  appel de la methode par_mysql
			** appel de la methode creer_fiche_frais_nouvel_periode
			** @param $_SESSION['id_encours'
			** @param $periode_plus_n : le mois suivant
			** @param $type_select false  : ne retourne pas d'enregistrement
			**/

			if ($detection_periode == false) {
	
			 
			$une_connection = new Laconnection () ;
			$ma_connection = $une_connection->par_mysql() ;
			$uncomptable = new Comptable () ;
			$une_requete = $uncomptable->creer_fiche_frais_nouvel_periode( $_SESSION['id_encours'], $periode_plus_n) ;
			$un_requeteur = new Requeteur () ;
			$type_select = false ;
			$creation_periode = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;

			}

			/**
			** report des frais hors forfaits demandées
			** appel de la methode par_mysql
			** reporter_ligne_frais_hors_forfait 
			** @param $_SESSION['id_hf_report'][$i] :id  visiteur 
			** @param $periode_plus_n : le mois suivant 
			** @param $type_select false , ne retourne aucun enregistrement
			**/
	 for ($i= 0; $i <= $nbre_id ; $i++) { 
			$une_connection = new Laconnection () ;
			$ma_connection = $une_connection->par_mysql() ;
			$uncomptable = new Comptable () ;
			$une_requete = $uncomptable->reporter_ligne_frais_hors_forfait($_SESSION['id_hf_report'][$i] , $periode_plus_n) ;
			$un_requeteur = new Requeteur () ;
			$type_select = false ;
			$mise_a_jour = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;
			/**
			** creation de la session confirmation, si aucune erreur de la methode envoyer_mysql n'est intervenue
			**/
			if ($mise_a_jour  == true) {

				$_SESSION['confirmation'] = " ok" ;
				}
	}
}
/**
** appel de la methode par_mysql
**	demander_prix_unitaire_frais_forfait 
** appel de la methode envoyer_mysql
** @param $type_select
** @return $prix_unit  , les prix unitaires
	**/		
if(isset($_SESSION['montant_fh'])) {
			$une_connection = new Laconnection () ;
			$ma_connection = $une_connection->par_mysql() ;
			$uncomptable = new Comptable () ;
			$une_requete = $uncomptable->demander_prix_unitaire_frais_forfait() ;
			$un_requeteur = new Requeteur () ;
			$type_select = true ;
			$prix_unit = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;
			foreach ($prix_unit as $object) {

				$type_forfait = $object->id ;
				$le_pu = $object->montant ;
				switch ($type_forfait) {
					case 'ETP':
						$ETP_unitaire = $le_pu ;
						$total_ETP =  $_SESSION['Forfait etape'] * $ETP_unitaire ;
						break;
					case 'KM':
						$KM_unitaire = $le_pu ;
						$total_KM =  $_SESSION['Forfait Km'] * $KM_unitaire ;
						break;
					case 'NUI':
						$NUIT_unitaire = $le_pu ;
						$total_NUIT =  $_SESSION['Forfait Nuit'] * $NUIT_unitaire ;

						break;
					case 'REP':
						$REPAS_unitaire = $le_pu ;
						$total_REPAS = $_SESSION['Forfait Repas'] * $REPAS_unitaire ;
						break;
				} 
			}
			$Total_frais_forfaitise = $total_ETP + $total_REPAS + $total_KM + $total_NUIT ;
			$Total_frais_hors_forfaitise  = 0 ;
			foreach ($_SESSION['montant_fh'] as $montant_fh) {
				$Total_frais_hors_forfaitise = $Total_frais_hors_forfaitise + $montant_fh ;
			
			}

			$total_frais_valides = $Total_frais_hors_forfaitise  +  $Total_frais_forfaitise ;
			
           /**
           ** appel de la methode valider_fiche_frais
           ** @param $_SESSION['la_justif'] : le nombre de justification
           ** @param $total_frais_valides : montant des frais validés
           ** @param $_SESSION['id_encours'] :id du visiteur 
           ** @param $_SESSION['mois_encours'] : le mois de la fiche à traiter
           ** @param $type_select falde , pas de retour d'enregistrement
           **/

			
			$une_requete = $uncomptable->valider_fiche_frais($_SESSION['la_justif'], $total_frais_valides , $_SESSION['id_encours'], $_SESSION['mois_encours']  ) ;
			$type_select = false ;
			$retour_validation = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;

			if ($retour_validation == true ) {


			$_SESSION['confirmation'] = " ok" ;
			
			}

header("Location: ../vue/vue_continuer_validation_mois.php") ;

}
//recupereation de la ligne hors forfait à reporter
	// verification de l'existance dde la fiche du mois prochain , si
	// n'existe pas , creer  fiche
	// puis insertion de la ligne recuperee
// validation de la fiche en cours 
	// demande des montant unitaire forfaitisé 
	// calcul des frais forfaitisés
	// calcul des frais hors forfaits
	// mise à jour du de la fiche



























?>