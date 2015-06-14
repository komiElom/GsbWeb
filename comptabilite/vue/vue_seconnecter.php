<?php
session_start() ;
/**
* chargement des entetes comprenant : le sommaire , les menus de navigation
* @package vue
*/
require_once '../vue/v_inc/header.php' ;
?>
<div id="div_bienvenue">
			<p>  BIENVENUE DANS L'INTERFACE DE VALIDATION DE NOTE DE FRAIS</p>
</div>


<?php
/** Chargement des pieds de pages qui contiennent les scripts javascript destinés à 
** interagir avec l'ulisateur
**/
require'../vue/v_inc/footer.php';
?>


