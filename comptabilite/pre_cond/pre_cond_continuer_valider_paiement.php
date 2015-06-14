<?php 
session_start();
/**
* verification de l'acces au model : model_continuer_mise_en_paiement_mois.php
* @package pre_cond
**/
if (isset($_SESSION['acces'])) {


      if(isset($_POST['id_select'])) {

				$_SESSION['id_encours'] = $_POST['id_select'] ;
			}

		  header("Location: ../model/model_continuer_mise_en_paiement_mois.php") ;



} else {

	header("Location: ..") ;


}







?>