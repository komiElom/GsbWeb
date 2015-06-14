<?php
session_start();
/**
* Confirmation de la mise en paiement final 
* @package vue 
*/
$_SESSION['mois_encours_paiement'] = 0 ;



?>
<doctype! html>
" l'entrée de vos informations ont été bien recueillies" <br/>
<form  name="fm_conf" method="post" action="../pre_cond/pre_cond_continuer_valider_paiement.php"> 
		<input type="submit" value="Veuiller cliquer ici pour continuer " />
</form>
