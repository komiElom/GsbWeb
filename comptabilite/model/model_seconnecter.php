<?php
session_start();
/** 
* chargement des classes métiers  et technique
** classe "le requeteur" : est utilisé pour envoyer des requêtes
** classe "la connection" : est utilisé par le requeteur
** classe "comptable" : l'acteur du cas  d'utlisation  effectuant
**  la demande de connection
*  @package model
**/
require '../_inc/laconnection.php';
require '../_inc/requeteur.php' ;
require '../_inc/comptable.php';
 
/** instanciation d'un objet connection
**/
$connect_a = new Laconnection () ;
/**
** utilisation de la connection du type mysql
**/
$maconnect = $connect_a->par_mysql() ;
/**  instanciation d'un objet connection
**/
$un_comptable  = new comptable () ;
/** instanciation d'un objet comptable
**/
foreach ($_SESSION['POST'] as $key => $value) {
	# code...
	    if ( $key == "in_login") {
	    	$login = $value;
	    } 
	    if ($key == "in_pwd") {
	    	$pass = $value ;
	    }
}
/**
** le comptable exprime une requete : ici se connecter
**/
$requete = $un_comptable->se_connecte($login,$pass) ;
/**
** la requete est ensuite transmise par le comptable dans un requeteur
**/
/**
* instanciation du requeteur
**/
$un_requeteur = new requeteur();
$type_select = true ;
$resultat = $un_requeteur->envoyer_mysql($requete, $maconnect, $type_select );
/** si le résultat de la requete estt bonne , alors 
**une session est crée puis la page d'acceuil est transmis
*/
if($resultat) {

	foreach ($resultat as $object ) {
		 $_SESSION['acces'] = $object->nom_comptable ;
		 		 	}
 	header ("Location: ../vue/vue_seconnecter.php") ;

}
else {

	
	$_SESSION['echec_connection'] = "echec" ;

	header("location:../index.php") ;
}

?>