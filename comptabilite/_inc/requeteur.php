<?php 
/**
** la class Requeteur est regroupe la methode qui execute la requete sql et qui recoit les enregistrements en provenance des bases de données
* @package _inc
**/

	class Requeteur {

/**
*** la methode envoyer_mysql formalise execute, et récupere les enregistrement en provenance de mysql Server
** @param $la_requete
** @param $la_connexion
** @param $requete_type_select = true si la methode doit recuperer des enregistrements
** @return soit $tableau quand il s'agit de recuperer des enregistrement , soit $resultat  boolean pour s'avoir s'il y'a erreur ou non
**/
		public function envoyer_mysql ($la_requete, $la_connexion, $requete_type_select = true) {
				$resultat = mysql_query($la_requete, $la_connexion) ;
				if($requete_type_select == true) { 
					if($resultat) {
						$tableau = array();
							while ( $row= mysql_fetch_object($resultat)) {
									$tableau[] = $row ;
							}
						return $tableau ;
					}
				return false ;
				}
			return $resultat ;
		}
			
	}

?>