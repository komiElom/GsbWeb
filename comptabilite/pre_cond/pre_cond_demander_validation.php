<?php 
session_start();

/** 
*  Si la session de l'utilisateur est toujours active redirection vers la 
* page d'autentification  
* sinon  poursuite vers le modele model_demander_validation.php
* @package pre_cond
*/
if (isset($_SESSION['acces'])) {

header("Location: ../model/model_demander_validation.php") ;




} else {

	header("Location: ..") ;


}





?>