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
/* instanciation d'un objet connection
*/

	$une_connection = new Laconnection () ;
	/**
* utilisation de la connection du type mysql
**/
	$ma_connection = $une_connection->par_mysql() ;
	/** instanciation d'un objet comptable
**/
	$uncomptable = new Comptable () ;
/**
** appel  de la methode valider_mise_en_paiement
** @param $_SESSION['id_encours'] : id visiteur
** @param $_SESSION['mois_encours_paiement'] 
** @return chaine de caractere servant de requete sql
**/
	$une_requete = $uncomptable->valider_mise_en_paiement($_SESSION['id_encours'], $_SESSION['mois_encours_paiement']  ) ;
	$un_requeteur = new Requeteur () ;
/**
** appel de la methode envoyer_mysql 
** @param $une_requete : une requete
** @param $ma_connection : une connection
** @param $type_select false  : ne retourne pas d'enregistrement
**/	
	$type_select = false ;

	$retour_validation = $un_requeteur->envoyer_mysql($une_requete , $ma_connection , $type_select) ;

	if ($retour_validation == true ) {


			$_SESSION['confirmation'] = " ok" ;

			header("Location: ../vue/vue_confirmation_mise_en_paiement.php") ;
			
		//	}


?>