
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
/**
** appel de la methode par_mysql
** appel de la methode demander_mise_en_paiement
** @return une chaine de caractère servant de requete sql
**/


$une_connection = new Laconnection () ;
$ma_connection = $une_connection->par_mysql() ;
$uncomptable = new Comptable () ;
$unerequete = $uncomptable->demander_mise_en_paiement() ;
/**
** appel la methode envoyer_mysql
**@param $unerequete : une requtee
** @param $ma_connection  : une connection
**@param $type_select true , retourne des enregistrement
**@return $liste_visiteur : tableau des visiteur
**/

$unrequeteur = new Requeteur ();
$type_select = true ;
$liste_visiteur = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/**
** affectation  des tableaux à des variables de session pour une redirection vers la vue vue_demander_mise_en_paiement.php
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
$_SESSION['le mois'] = $le_mois ;
header("Location: ../vue/vue_demander_mise_en_paiement.php") ;

?>

