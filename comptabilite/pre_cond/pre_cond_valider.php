<?php 

session_start();
/**
* verification des acces    et  données nécessaires au model model_valider.php
* @package pre_cond
*/
if (isset($_SESSION['acces'])) {

	var_dump($_POST);

			if(isset($_POST['id_select'])) {

				$_SESSION['id_encours'] = $_POST['id_select'] ;
				
				if (isset($_POST['id_mois_select'])) {
			$_SESSION['mois_encours'] = $_POST['id_mois_select'] ;

							$liste_des_id_suppr = array() ;
							$liste_des_id_report = array() ;
							$liste_des_id_validation = array() ;
							$liste_des_libelles = array() ;
							$montants_hors_f_valides = array() ;

						foreach ($_POST as $key => $value) {
									$recherche_suppression = substr($key,0 ,11 ) ;
										if ($recherche_suppression == "suppression") {
											$liste_des_id_suppr[] = substr($key,11 ) ;
											$liste_des_libelles[] = $value ;
										}
									$recherche_report = substr($key,0,6 ) ;
									if ($recherche_report == "report") {
											$liste_des_id_report[] = substr($key,6 ) ;


										}

									$recherche_validation = substr($key,0,10 ) ;
									if ($recherche_validation == "validation") {
											$montants_hors_f_valides[] = $value ;

										}

									switch ($key) {
										case 'Etape':
											$_SESSION['Forfait etape'] = $value ;
											break;
										case 'Km':
											$_SESSION['Forfait Km'] = $value ;
											break;
										case 'Nuit':
											$_SESSION['Forfait Nuit'] = $value ;
											break;
										case 'Repas':
											$_SESSION['Forfait Repas'] = $value ;
											break;
										case 'justif_mois':
											$_SESSION['la_justif'] = $value ;
											break;
										
									}

									$_SESSION['id_hf_supp'] = $liste_des_id_suppr ;		
									$_SESSION['libelle_supp'] = $liste_des_libelles;	
									$_SESSION['id_hf_report'] = $liste_des_id_report ;	
									$_SESSION['montant_fh'] = $montants_hors_f_valides ;				
						}

				}

		

		 header("Location: ../model/model_valider.php") ;

		}

} else {

	header("Location: ..") ;


}







?>