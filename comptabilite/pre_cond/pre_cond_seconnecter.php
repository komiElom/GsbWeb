<?php
session_start() ;
/**
* Vérification des données de l'entête du serveur
* pour vérifier si on a les données du formulaire
* vérification faite sur la variable la  session POST
* soit le système affiche un problème  d'authentificaton 
* soit un problème d'acces lié au sessio
* @package pre_cond
**/

if(!empty($_SESSION['POST'])) {
	
	$check = true ;
	   foreach ($_SESSION['POST'] as $champ => $value) {
	   			if ($value ==''){
	   				$check = false ;
	   			}
	   }
	   if ($check == true) {
	  	header("Location: ../model/model_seconnecter.php") ;
	  	print_r($_SESSION['POST']) ;
	   }
	   else {
	   		 echo"recommencer l'authentification" ;
	   }
}
else { 
		  echo"Problemes d'accès à distance" ;

}


?>
<form name="retour" method="post" action="../">
<input type="submit" value="retour"/>
</form>
