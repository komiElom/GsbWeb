<?php
/**
*** la class Laconnection regroupe les methodes sevrvant de connection au serveur web et à la base de donnée
* @package _inc
**/

class Laconnection {
	  	public $param  = array(
	  		'hote' => 'localhost',
	  		'utilisateur' => 'examen',
	  		'password' => 'elom',
	  		'bd' => 'base_sio');		
	  	public function _constructor () {
	  	
	  	}
	  	/**
	  	*  par_mysql sert à envoyer une requete vers la base de donnée mysql 
	  	* @param $this->param['hote'] : l'hote 
	  	* @param $this->param['utilisateur'] : le nom du'utilisateur de la base de donnée
	  	* @param $this->param['password'] le mot de pass de la base de donnée
	  	* @param $this->param['bd'] : le nom de la base de donnée
	  	**/
	  	public function par_mysql () {
	  				$conn = mysql_connect($this->param['hote'], $this->param['utilisateur'], $this->param['password'], $this->param['bd'])  
	  						or  die ("Serveur inaccessible contacté l'administrateur");
	  			  	if($conn) {
	  			  				 $tentative = mysql_select_db($this->param['bd'],$conn) ;
	  			  				 if(!$tentative) {
	  			  				 					die("Base de donnée impossible d'accès :" . mysql_error());
	  				  			  					}
	  				 	return $conn ;
	  				}
	  			return  " pas de connection vers la base ";
	  	}
		
}


?>