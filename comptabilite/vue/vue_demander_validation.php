<?php
session_start() ;

/**
* @package vue
*/
?>
require_once '../vue/v_inc/header_validation.php' ;
?>



<div  id="div_identite">
	<form id="form_identite" name="form_identite" method="post" action="../pre_cond/pre_cond_demander_validation_mois.php">
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
					<option id="<?php echo $_SESSION['les ids'][$num_id] ; ?>" >  <?php echo $_SESSION['les prenoms'][$num_id]. " " .$noms ; ?>  </option>
					<?php $num_id = $num_id + 1 ; 
				     }?>
				     <option id="indicateur" selected >  Veuilez Selectionner le visiteur  </option>
	   		 </select>	
	   		 <input id="id_select" name="id_select" value="" type="hidden"/>
		</div> 	
		<input type="submit" value="Rechercher" id="rechercher" />
	</form>
</div>

<?php 
/* Chargement des pieds de pages qui contient les script javascript destiné à 
* interagir avec l'ulisateur
*/
require '../vue/v_inc/footer_validation.php' ; ?>