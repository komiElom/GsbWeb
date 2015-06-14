<?php
/**
** la class comptable regroupe toutes les  actions effectuées par le comptable dans le système
**
* @package _inc
**/

class Comptable {
	public $id_compta = "" ;
	public $nom_compta = "" ;

	public function _constructor () {

	}

	   /** 
	   ** methode se_connecter : destiner à s'authentifier
	   ** @param $login : le login saisi par l'utilisateur 
	   ** @param $pass : le pass saisi par l'utilisateur
	    ** @return $idenfication une chaine de caractère servant de requete
	   **/
		public function se_connecte($login, $pass) {

			$idenfication = "SELECT nom_comptable  FROM comptable  WHERE id_comptable ='".$login."' AND pass_comptable ='".$pass."'" ;
			return $idenfication ;
		}
        /**
        ** methode  demander_validation : sert à la demande des taches de  validation du mois
        ** @return $liste  : une chaine de caractère servant de requete
        **/
		public function demander_validation() {

			$liste = "SELECT visiteur.nom , visiteur.prenom , visiteur.id  FROM visiteur JOIN fichefrais ON visiteur.id = fichefrais.idVisiteur WHERE fichefrais.idEtat ='CL'" ;
			return $liste ;
		}
		/**
		**  methode demander_mois : sert à demander les 
		**
		** @param $id_du_visiteur : l'id du visiteur 
		** @return $liste  : une chaine de caractère servant de requete
		**/
		public function demander_mois($id_du_visiteur) {
  
			$liste = "SELECT fichefrais.mois FROM  fichefrais WHERE fichefrais.idVisiteur ='".$id_du_visiteur."'  AND fichefrais.idEtat ='CL'" ;
			return $liste ;

		}

       /**
       ** methode recuperer_frais_forfait sert à la récuperation des frais forfait 
       ** @param $id_du_visiteur : l'id du visiteur 
       ** @param $lemois : le mois du visiteur
        ** @return $liste  : une chaine de caractère servant de requete
       **/
		public function recuperer_frais_forfait($id_du_visiteur, $lemois) {
			$liste = "SELECT  idfraisforfait , quantite  FROM  lignefraisforfait WHERE lignefraisforfait.idVisiteur ='".$id_du_visiteur."'  AND lignefraisforfait.mois ='".$lemois."'" ;
			return $liste;

		}

      /**
      ** methode  recuperer_frais_hors_forfait sert à la récuperation des frais hors forfait
      ** @param $id_du_visiteur  : id du visteur 
      ** @param $lemois : le mois du visiteur 
      ** @param $un_id_hf : l'id d'une note frais (facultatif)
      ** @return $liste  : une chaine de caractère servant de requete
      **/

		public function recuperer_frais_hors_forfait($id_du_visiteur, $lemois, $un_id_hf ='') {
					if ($un_id_hf =='') {
						$liste = " SELECT  lignefraishorsforfait.id, lignefraishorsforfait.date,  lignefraishorsforfait.libelle, lignefraishorsforfait.montant,  fichefrais.nbJustificatifs  FROM lignefraishorsforfait   join fichefrais  on fichefrais.idVisiteur =lignefraishorsforfait.idVisiteur AND fichefrais.mois = lignefraishorsforfait.mois WHERE  fichefrais.idVisiteur ='".$id_du_visiteur. "' AND fichefrais.mois ='".$lemois."';" ;
					} else {

						$liste = " SELECT  lignefraishorsforfait.id, lignefraishorsforfait.date,  lignefraishorsforfait.libelle, lignefraishorsforfait.montant,  fichefrais.nbJustificatifs  FROM lignefraishorsforfait   join fichefrais  on fichefrais.idVisiteur = lignefraishorsforfait.idVisiteur AND fichefrais.mois = lignefraishorsforfait.mois WHERE  fichefrais.idVisiteur ='".$id_du_visiteur. "' AND fichefrais.mois = '".$lemois."' AND lignefraishorsforfait.id='".$un_id_hf."';" ;
					}


			return $liste;

		}

        /**
        ** methode  supprimer_ligne_hors_forfait sert à la suppression d'une ligne frais hors forfait
        **
        ** @param $un_libelle : libelle d'un frais hors forfait
        **@param $un_id_hf : le id de la ligne frais hors forfait
        ** @return $liste  : une chaine de caractère servant de requete
        **/
		public function supprimer_ligne_hors_forfait ($un_libelle, $un_id_hf) {

			$ligne = "UPDATE lignefraishorsforfait SET lignefraishorsforfait.libelle ='".$un_libelle."' WHERE lignefraishorsforfait.id ='".$un_id_hf."' ;" ;
			return $ligne ;

		}

        /**
        ** methode  rechercher_fiche_frais_nouvel_periode sert  à voir s'il existe une fiche pour la nouvelle periode 
        ** @param $id_du_visiteur : id du visiteur 
        ** @param $unmois : un mois
        ** @return $liste  : une chaine de caractère servant de requete
        **/
		public function rechercher_fiche_frais_nouvel_periode ($id_du_visiteur, $unmois) {

			$liste ="SELECT * FROM  fichefrais WHERE fichefrais.idVisiteur ='".$id_du_visiteur."'  AND fichefrais.mois ='".$unmois."' ;" ;
			return $liste ;


		}
		/**
		** methode  creer_fiche_frais_nouvel_periode sert à creer une fiche de frais 
		** @param $id_du_visiteur : id du visteur 
		** @param $unmois : le nouveau mois
		** @return $liste  : une chaine de caractère servant de requete
		**/
	public function creer_fiche_frais_nouvel_periode($id_du_visiteur, $unmois) {
		$ligne = "INSERT INTO fichefrais (idVisiteur, mois, idEtat) VALUES ('$id_du_visiteur', '$unmois', 'CR');" ;
			return $ligne ;

	}

/**
**  methode reporter_ligne_frais_hors_forfait sert à reporter les hors forfait vers le mois suivant
**@param $un_id_hf
** @param  $un_mois
** @return $liste  : une chaine de caractère servant de requete
**/
	public function reporter_ligne_frais_hors_forfait($un_id_hf, $un_mois) {
		$ligne = "UPDATE lignefraishorsforfait SET lignefraishorsforfait.mois ='".$un_mois."' WHERE lignefraishorsforfait.id ='".$un_id_hf."' ;" ;
			return $ligne ;


	}

   /**
   ** methode  demander_prix_unitaire_frais_forfait sert à demanderl les prix unitaires des frais frorfaitises
   ** @return $liste  : une chaine de caractère servant de requete
   **/
	public function demander_prix_unitaire_frais_forfait() {

		$liste = "SELECT  fraisforfait.id, fraisforfait.montant FROM fraisforfait " ;
		return $liste ;
	}



/**
**  methode valider_fiche_frais sert à valider une fiche de frais 
** @param $nbre_justif : le nombre de justification
** @param $le_montant : le montant
** @param  $id_du_visiteur : l'id du visteur
** @param $unmois : le mois
 ** @return $liste  : une chaine de caractère servant de requete
**/
	public function valider_fiche_frais($nbre_justif, $le_montant, $id_du_visiteur, $unmois ) {

		$ligne = "UPDATE fichefrais SET fichefrais.idEtat  = 'VA' , fichefrais.nbJustificatifs ='".$nbre_justif."' , fichefrais.montantValide ='".$le_montant."' WHERE fichefrais.idVisiteur ='".$id_du_visiteur."'  AND fichefrais.mois ='".$unmois."';" ;
			return $ligne ;


		
	}

/**
** methode demander_mise_en_paiement sert  à la demandes des taches de mise en paiement
 ** @return $liste  : une chaine de caractère servant de requete
**/

	public function demander_mise_en_paiement () {

			$liste = "SELECT visiteur.nom , visiteur.prenom , visiteur.id  FROM visiteur JOIN fichefrais ON visiteur.id =fichefrais.idVisiteur WHERE fichefrais.idEtat ='VA';" ;
			
			return $liste ;


	}

/**
**methode  demander_mois_paiement sert à demander le mois pour lequel il faut effectuer la mise en paiement 
** @param  $id_du_visiteur : id visiteur
** @return $liste  : une chaine de caractère servant de requete
**/
	public function demander_mois_paiement ($id_du_visiteur) {
  
			$liste = "SELECT fichefrais.mois FROM  fichefrais WHERE fichefrais.idVisiteur ='".$id_du_visiteur."'  AND fichefrais.idEtat ='VA' ;" ;
			return $liste ;

		}

/**
** methode valider_mise_en_paiement
** @param $id_du_visiteur : l'id du visteur
** @param $unmois : le mois
** @return $liste  : une chaine de caractère servant de requete
**/

public function valider_mise_en_paiement ($id_du_visiteur, $unmois) {
  
			$ligne = "UPDATE fichefrais SET fichefrais.idEtat  ='RB'  WHERE fichefrais.idVisiteur ='".$id_du_visiteur."'  AND fichefrais.mois ='".$unmois."';" ;
			return $ligne ;


		}

}

?>