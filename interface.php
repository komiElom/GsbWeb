<?php
session_start() ;

/** 
*Interface commune au dommaine de Gestion 
* Comptable et Commercial
* Verification selon que c'est le formulaire comptable ou ou commercial qui a été soumis
* creation d'une variable session POST et affectation de la session  par la variable global POST
* package
* @author komi Elom Heekpo
* @since 
*
**/

if(!empty($_POST)) {
	$_SESSION['POST']= $_POST ;
	   foreach ($_POST as $champ => $value ) {
	   			if ($champ == "comptable" ) {
	   				
	   				header("Location: comptabilite/pre_cond/pre_cond_seconnecter.php") ;
	   			}

	   			if ($champ == "commercial" ) {
	   				header("Location: commercial/cSeconnecter.php") ;
	   			}
	   }
}
//
?>