<?php
session_start();


/**
**  destruction de la session en cours
* @package model
 **/
session_destroy();


header("Location:../") ;


?>