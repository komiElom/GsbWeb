<?php 
session_start();
/** 
* Si la session de l'utilisateur est toujours active redirection vers la 
* page d'autentification  
* @package pre_cond
**/
if (isset($_SESSION['acces'])) {

			/** verifie que un choix(visiteur) a été bien selectionné
			** afin que celui ci puisse être transmie à la page model
			** pour une requete
			*/
			if(isset($_POST['id_select'])) {

				$_SESSION['id_encours'] = $_POST['id_select'] ;
							
				}

			/**
			** redirection des variables sessions vers le model  model_demander_validation_mois.php
			**/

		 header("Location: ../model/model_demander_validation_mois.php") ;
			
		

}else {

	header("Location: ..") ;


}







?>