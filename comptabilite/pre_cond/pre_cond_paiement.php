<?php 
session_start();
/**
* verifie si la session est active ou non , puis redirection vers le model model_demande_mise_en_paiement.php
* @package pre_cond
*/
if (isset($_SESSION['acces'])) {

header("Location: ../model/model_demande_mise_en_paiement.php") ;




} else {

	header("Location: ..") ;


}







?>