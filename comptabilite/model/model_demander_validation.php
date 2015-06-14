<?php
 session_start() ;
 /** chargement des classes métiers  et technique
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
**/
$unerequete = $uncomptable->demander_validation() ;
/**
** la requete est ensuite transmise par le comptable dans un requeteur
**/
/**
* instanciation du requeteur
**/
$unrequeteur = new Requeteur ();
$type_select = true ;
$liste_visiteur = $unrequeteur->envoyer_mysql($unerequete , $ma_connection , $type_select) ;
/***
** initlialisation des élements à afficher dans la  page vue 
**/
$les_noms =  array();
$les_prenoms = array();
$les_id = array() ;
$le_mois  = array() ;

/** @  affectation des tableaux nom, prenom, ids à partir de la liste des utilisateurs
** @ creation d'une variable session "les noms" contenant le tableau des noms
**  @  creation d'une variable session "les prenoms" contenant le tableau de prenoms
**  @ creation d'une variable session "id"  contenant  le tableau des id
**  **/
foreach ($liste_visiteur as $object ) {

	$les_noms [] = $object->nom ;
	$les_prenoms[] = $object->prenom ;
	$les_id [] = $object->id ;
    $le_mois [] = $object->mois ;


$_SESSION['les noms'] = $les_noms ;
$_SESSION['les prenoms'] = $les_prenoms ;
$_SESSION['les ids'] = $les_id ;


header("Location: ../vue/vue_demander_validation.php") ;

}

?>