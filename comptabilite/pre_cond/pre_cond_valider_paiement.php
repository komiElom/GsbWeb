<?php 

session_start();
/**
* verification des acces necesaires au model_valider_paiement.php
* @package pre_cond
*/
if (isset($_SESSION['acces'])) {


			if(isset($_POST['id_select'])) {

				$_SESSION['id_encours'] = $_POST['id_select'] ;
				
				if (isset($_POST['id_mois_select'])) {
			$_SESSION['mois_encours_paiement'] = $_POST['id_mois_select'] ;
			
						}

				}

		

		  header("Location: ../model/model_valider_paiement.php") ;

} else {

	header("Location: ..") ;


}









?>