<?php
 session_start() ;
  /**
 ** chargement des classes métiers  et techniques
** classe "le requeteur" : est utilisée pour envoyer des requêtes
** classe "la connection" : est utilisée par le requeteur
** classe "comptable" : l'acteur du cas  d'utlisation  effectuant
**  la demande de connection
* @package model
**/
require '../_inc/laconnection.php' ;
require '../_inc/comptable.php' ;
require '../_inc/requeteur.php' ;
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
** le comptable exprime une requete : demande la liste des visteurs à valider
** @return une chaine de caractère pour être traduite en requete sql
**/

$unerequete = $uncomptable->demander_mise_en_paiement();
/**
** appel de la methode envoyer_mysql
**@param $unerequete : une requtee
** @param $ma_connection  : une connection
** @return liste_visiteur : liste des visteurs
**/
$unrequeteur = new Requeteur ();
$type_select = true ;
$liste_visiteur = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/** 
** initlialisation des élements à afficher dans la  page vue 
**/
$les_noms = array();
$les_prenoms = array();
$les_id = array() ;

foreach ($liste_visiteur as $object ) {

	$les_noms [] = $object->nom ;
	$les_prenoms[] = $object->prenom ;
	$les_id [] = $object->id ;
}

$_SESSION['les noms'] = $les_noms ;
$_SESSION['les prenoms'] = $les_prenoms ;
$_SESSION['les ids'] = $les_id ;
/**
** verifie si  c'est le visiteur recemment traité qui fait toujours l'objet de validation
**  ou si s'il faut passer à d'autre visteur à traiter 
**/

if (!$_SESSION['id_encours'] =='') {
$id_visit = ($_SESSION['id_encours']);
}else {
$id_visit = $_SESSION['les ids'][0];
}
/**
** appel de la methode demander_mois_paiement
** @param id_visit
** @return une chaine de caractère pour être traduite en requete sql
**/
$unerequete = $uncomptable->demander_mois_paiement($id_visit) ;
$type_select = true ;
$liste_mois = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;

$les_mois = array () ;

		foreach ($liste_mois as $object ) {
			$les_mois[]= $object->mois ;
		}

		$_SESSION['le mois'] = $les_mois ;
/**
** verifie si  c'est le visiteur recemment traité qui fait toujours l'objet de validation
**  ou s'il faut passer à d'autre visteur à traiter 
**/


if (isset($_SESSION['mois_encours_paiement']) AND (!$_SESSION['mois_encours_paiement'] == 0) ) {
		/**
** appel de la methode recuperer_frais_forfait  pour recevoir la chaine de charactere devant servir de requete
** @param  $id_visit l'id du visteur
** @param  $_SESSION['mois_encours_paiement'] le mois 
** @return retourne une chaine de caractère pour formuler la requete pour la recuperation des frais forfaitises
**/
	$unerequete = $uncomptable->recuperer_frais_forfait($id_visit , $_SESSION['mois_encours_paiement']) ;
	
} else {
		/**
** appel de la methode recuperer_frais_forfait  pour recevoir la chaine de charactere devant servir de requete
** @param  $id_visit l'id du visteur
** @param $_SESSION['le mois'][0] le mois 
** @return retourne une chaine de caractère pour formuler la requete pour la recuperation des frais forfaitises
**/
		$unerequete = $uncomptable->recuperer_frais_forfait($id_visit , $_SESSION['le mois'][0]) ;
	}

/**
** appel de la méthode envoyer_mysql 
** @param true , vraie pour  une requete devant retourner un résultat
** @param une requete, une connection
** @return $liste_ff  la liste frais forfaitises
**/
$unrequeteur = new Requeteur ();
$type_select = true ;
$liste_ff =  $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
$les_quantites = array () ;
$les_idfraisforfaits = array () ;

		foreach ($liste_ff  as $object ) {
			$les_quantites[]= $object->quantite ;
			$les_idfraisforfaits []= $object->idfraisforfait ;
		}

		$_SESSION['idfraisforfait'] = $les_idfraisforfaits  ;
		$_SESSION['quantite'] = 	$les_quantites;
  		

if (isset($_SESSION['mois_encours_paiement']) AND (!$_SESSION['mois_encours_paiement'] == 0) ) {
	/**
    **
    ** appel de la methode recuperer_frais_hors_forfait
    ** @param true ;
    ** @param $id_visit
    ** @param $_SESSION['mois_encours_paiement'] : le premier mois disponible
    ** @return $liste_hf : tableau des frais hors forfait
    **/  
	$unerequete = $uncomptable->recuperer_frais_hors_forfait($id_visit , $_SESSION['mois_encours_paiement']) ;
} else {
	 /**
    **
    ** appel de la methode recuperer_frais_hors_forfait
    ** @param true ;
    ** @param $id_visit
    ** @param  $_SESSION['le mois'][0] : le premier mois disponible
    ** @return $liste_hf : tableau des frais hors forfait
    **/  
		$unerequete = $uncomptable->recuperer_frais_hors_forfait($id_visit , $_SESSION['le mois'][0]) ;

	}

$type_select = true ;
$liste_hf =  $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/**
** affectation  des tableaux à des variables de session pour une redirection vers la vue  vue_continuer_mise_en_paiement_mois.php
**/

$les_dates = array () ;
$les_libelles = array () ;
$les_montants = array () ;
$les_id_fr_hors = array () ;
$justif = array () ;

		foreach ($liste_hf  as $object ) {
			$les_dates []= $object->date;
			$les_libelles []= $object->libelle ;
			$les_montants [] = $object->montant ;
			$justif [] = $object->nbJustificatifs ;
			$les_id_fr_hors [] = $object->id;
		}

		$_SESSION['dates'] = $les_dates  ;
		$_SESSION['libelle'] = 	$les_libelles;
		$_SESSION['montants'] = 	$les_montants;
		$_SESSION['justif_mois'] = $justif [0];
		$_SESSION['id_h_f'] = $les_id_fr_hors ;
	


header("Location: ../vue/vue_demander_mise_en_paiement_mois.php") ;


?>