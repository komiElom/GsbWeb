<?php
 session_start() ;
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
$unerequete = $uncomptable->demander_validation() ;
/**
** la requete est ensuite transmise par le comptable dans un requeteur
**/
/**
** instanciation du requeteur
** appel de la methode envoyer_mysql
** @param $unerequete : une requete
** @param $ma_connection : une  connection
** @param $type_select true, renvoi des enregistrement
** @return  $liste_visiteur la liste des visteur 
**/
$unrequeteur = new Requeteur ();
$type_select = true ;
$liste_visiteur = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;

$les_noms = array();
$les_prenoms = array();
$les_id = array() ;

foreach ($liste_visiteur as $object ) {

	$les_noms [] = $object->nom ;
	$les_prenoms[] = $object->prenom ;
	$les_id [] = $object->id ;
}
/** 
** initlialisation des élements à afficher dans la  page vue 
**/
$_SESSION['les noms'] = $les_noms ;
$_SESSION['les prenoms'] = $les_prenoms ;
$_SESSION['les ids'] = $les_id ;

/**
** verifie si  c'est le visiteur recemment traité qui fait toujours l'objet de validation
**  ou si un s'il faut passer à d'autre visteur à traiter 
**/

if (!$_SESSION['id_encours'] =='') {
$id_visit = ($_SESSION['id_encours']);
}else {
$id_visit = $_SESSION['les ids'][0];
}
/** 
**appel  de la méthode demander_mois  par le comptable pour demander les mois concernant le visiteurs
** @param $id_visit id du visteur
** @return : retourne une chaine de caractère pour formuler la requete
**/
$unerequete = $uncomptable->demander_mois($id_visit) ;
/**
** appel de la méthode envoyer_mysql 
** @param true , vraie pour  une requete devant retourner un résultat
** @param une requete, une connection
** @return la liste des mois disponibles sous forme de tableau
**/
$type_select = true ;
$liste_mois = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/**
** affectation des mois retourner dans un tableau puis dans une variable session pour rediriger ver la vue demander_mois
**/
$les_mois = array () ;
foreach ($liste_mois as $object ) {
			$les_mois[] = $object->mois ;
		}
		$_SESSION['le mois'] = $les_mois ;
/**
** appel de la methode recuperer_frais_forfait  pour recevoir la chaine de charactere devant servir de requete
** @param  $id_visit l'id du visteur
** @param $_SESSION['le mois'][0] le mois 
** @return retourne une chaine de caractère pour formuler la requete pour la recuperation des frais forfaitises
**/
$unerequete = $uncomptable->recuperer_frais_forfait($id_visit , $_SESSION['le mois'][0] ) ;
/**
** appel de la methode envoyer_mysql
** @param  $unerequete : une requete,
 ** @param  $ma_connection: une connection 
** @param true , vraie pour  une requete devant retourner un résultat
** @return   $liste_ff tableau de la liste des frais forfaitisés
**/
$type_select = true ;
$liste_ff =  $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;

/**
** creation de session idfraisforfait , quantite 
**/
$les_quantites = array () ;
$les_idfraisforfaits = array () ;

		foreach ($liste_ff  as $object ) {
			$les_quantites[]= $object->quantite ;
			$les_idfraisforfaits []= $object->idfraisforfait ;
		}

		$_SESSION['idfraisforfait'] = $les_idfraisforfaits  ;
		$_SESSION['quantite'] = 	$les_quantites;

    /**
    **
    ** appel de la methode recuperer_frais_hors_forfait
    ** @param true ;
    ** @param $id_visit
    ** @param $_SESSION['le mois'][0] : le premier mois disponible
    ** @return $liste_hf : tableau des frais hors forfait
    **/     		
$ma_connection = $une_connection->par_mysql() ;
$unerequete = $uncomptable->recuperer_frais_hors_forfait($id_visit , $_SESSION['le mois'][0]) ;
$type_select = true ;
$liste_hf =  $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/**
**
** creation session date, libelle, montant, juttif_mois, id_h_f destiné à la vue
**/

$les_dates = array () ;
$les_libelles = array () ;
$les_montants = array () ;
$les_id_fr_hors = array () ;
$justif = array () ;

		foreach ($liste_hf  as $object ) {
			$les_dates [] = $object->date;
			$les_libelles [] = $object->libelle ;
			$les_montants [] = $object->montant ;
			$justif [] = $object->nbJustificatifs ;
			$les_id_fr_hors [] = $object->id ;
		}

		$_SESSION['dates'] = $les_dates  ;
		$_SESSION['libelle'] = 	$les_libelles ;
		$_SESSION['montants'] = 	$les_montants ;
		$_SESSION['justif_mois'] = $justif [0] ;
		$_SESSION['id_h_f'] = $les_id_fr_hors ;
	


header("Location: ../vue/vue_demander_validation_mois.php") ;

?>