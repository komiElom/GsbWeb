<?php
session_start() ;
		
/**
* @package vue 
*/
?>
require_once '../vue/v_inc/header_validation_mois.php' ;
?>
<?php 
	if(isset($_SESSION['confirmation'])) {
		if(! $_SESSION['confirmation'] == "ok")  {  echo " l'entrée de vos informations ont été bien recueillies" ; 

	}
		
}?>
<div>
		<div  id="div_identite">
			<form id="form_identite" name="form_identite" method="post" action="../pre_cond/pre_cond_valider.php">
				<div id="div_visiteur">  
					
					<label> Visiteur: </label>
					<select id="se_visiteur"  name="se_visiteur"> 
							<?php  
							/** affichage de la liste des visiteurs  à partir du résultat de la page model_demander_validation_mois
							** 
							*/
							 $num_id = 0 ;
							 foreach ($_SESSION['les noms'] as $noms) {
								?>
							<option id="<?php echo $_SESSION['les ids'][$num_id] ; ?>" <?php if($_SESSION['les ids'][$num_id]==$_SESSION['id_encours']) { echo "selected" ; }  ?> > <?php echo $_SESSION['les prenoms'][$num_id] ." ".  $_SESSION['les noms'][$num_id] ; ?>  </option>
							<?php $num_id = $num_id + 1 ; 
						     } ?>    
			   		 </select>	
			   		 <input id="id_select" name="id_select" value="" type="hidden"/>
			   		 <input id="id_select_retour" name="id_select_retour" value="" type="hidden"/>
				</div>
				<div id="div_mois">	
					<label> Mois : </label>
					<select id="se_mois" name="se_mois" > 
							<?php  
								/** affichage de la liste des mois à partir du résultat de la page model_demander_validation_mois
								** 
								*/
								 $num_id = 0 ;
							  foreach ($_SESSION['le mois'] as $lemois) {
								 ?>
							<option value="<?php echo $lemois ; ?>" id="<?php echo $lemois?>">  <?php echo $lemois ;   ?>  </option>
						      <?php 
						  $num_id = $num_id + 1 ; 
						      } ?>
				    </select>	
				    <input id="id_mois_select" name="id_mois_select" value="" type="hidden"/>
				     <input id="id_mois_select_retour" name="id_mois_select_retour" value="" type="hidden"/>
				</div>  
			
			
			</form> 
		</div>
	<form id="form_fiche" name="form_fiche" method="POST" action="../pre_cond/pre_cond_valider.php">
		<div id="Frais">
				<label> Frais Forfait</label>
				<div id="div_frais_forfait">  
					 <?php 
					 		/** Affichage des frais forfaitisés
					 		**/
					 		 $num_id = 0 ;
					 foreach ($_SESSION['idfraisforfait'] as $idetat ) {
					 	# code...
					 		switch ($idetat) {
					 			case 'ETP': 
					 			?>
					<label>  Etape </label>  <br/>
					<input id="Etape" name="Etape" type="text" value="<?php echo $_SESSION['quantite'][$num_id ] ; ?>" required />  <br/> 
					 				<?php
					 				break ;
					 			case 'NUI': 
					 			?>
					<label> Hotel </label>	<br/>
					<input id="Nuit"  name="Nuit" type="text" value="<?php echo $_SESSION['quantite'][$num_id ] ; ?>" required />	<br/> 
					   				<?php
					   				 break ;
					 			case 'KM':
					 			 ?>
					<label> kilometre</label> <br/>
					<input id="Km"  name="Km" type="text" value="<?php echo $_SESSION['quantite'][$num_id ] ;  ?>" required />	<br/> 
					   				<?php
					   				break ;
					 			case 'REP': 
					 			?>
					<label> Repas </label> 
					<input id="Repas" name ="Repas" type="text" value="<?php echo $_SESSION['quantite'][$num_id ]  ; ?>"  required />	
					   				<?php	
					   				break ; 			
					 		}
					 	$num_id = $num_id + 1 ;
					 }
					 	?>
					 	<input id="Repas_retour" type="hidden" value=""/>
					 	<input id="Etape_retour" type="hidden" value=""/>
						<input id="Nuit_retour" type="hidden" value=""/>
						<input id="Km_retour" type="hidden" value=""/>
					
					
					
				</div>
				<label> Frais Hors Forfait</label>
				<div id="div_frais_hors_forfait"> 
					<?php  
					/** Affichage des frais hors forfaits
					**
					*/
					 $num_id = 0 ;
						foreach ($_SESSION['dates']as $ladate ) {
					?>
					<label class="la_date"> Date </label> <label class="le_libelle"> libelle  </label>  <label class="le_montant"> montant  </label>   <br/> 
				     		<input  type="text" value="<?php echo $_SESSION['dates'][$num_id] ; ?>" disabled/>  <input  type="text "value="<?php echo  $_SESSION['libelle'][$num_id] ; ?> " disabled/>  <input id="<?php echo $_SESSION['id_h_f'][$num_id] ; ?>" data-destination="validation" name="<?php echo $_SESSION['id_h_f'][$num_id] ; ?>" type="text" value="<?php echo $_SESSION['montants'][$num_id] ;?>" disabled/>  <input type="button" id ="reporter" value="reporter"/> <input type="button" Value="supprimer" id ="supprimer"/> <br/>
						<?php  $num_id = $num_id  + 1 ; } ?>
					<br/> 
					<label id="lab_justif"> Le nombre de piece justificative </label>
					<input name="justif_mois" value=" <?php echo $_SESSION['justif_mois'] ;?>" required/>	
				</div>
		</div>


		<div id="div_validation">
				<br/> 
				<input id="validation"type="submit" value="Valider"/>
				<input id="id_select_bis" name="id_select" value="" type="hidden"/>
				<input id="id_mois_select_bis" name="id_mois_select" value="" type="hidden"/>



		</div>
	<form/>	
<div/>
<?php require '../vue/v_inc/footer_validation_mois.php' ; ?>