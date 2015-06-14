<?php
/**
*
* @package  vue
* sommaire regroupant les menues de navigation de toutes les pages 
*  Validation des fiches de frais; Suivre le paiement des fiches de frais
*/

?>
<h4>
	<div class"le_sommaire" >
		<ul class="liste_menu">
			<li>
				<a class="menu1" href ="../pre_cond/pre_cond_demander_validation.php"> Validation des fiches de frais <a>
			</li>

			<li>
				<a class="menu2" href="../pre_cond/pre_cond_paiement.php"> Suivre le paiement des fiches de frais </a>
			</li>
			<li>
				<a class="menu3" id="la_deconnection" href="../model/model_deconnecter.php">   Deconnection </a>
			</li>

		</ul>
	</div>
	<div class="utilisateur">
				<label> Nom du Valideur: </label> 
				<label id="lenom_valideur"> <?php print_r($_SESSION['acces']) ;?> </label>
			
	</div>	
</h4>
