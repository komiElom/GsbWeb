<?php 
session_start();
/**
* Verification des acces au model : model_demander_mise_en_paiement_mois.php
* @package pre_cond
*/

if (isset($_SESSION['acces'])) {

	var_dump($_POST);

			if(isset($_POST['id_select'])) {

				$_SESSION['id_encours'] = $_POST['id_select'] ;
				
				if (isset($_POST['id_mois_select'])) {
				$_SESSION['mois_encours_paiement'] = $_POST['id_mois_select'] ;

				}

		

		  header("Location: ../model/model_demander_mise_en_paiement_mois.php") ;

		}

} else {

	header("Location: ..") ;


}







?>