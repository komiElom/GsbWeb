<?php  
/**
* page d'acceuil du site 
* @package 
*
*
*/


 ;?>
<doctype! html>
	<html>
		<head>
			<meta  charset = "utf-8"/>
			<title>
				Geston de frais de Gsb
			</title>
			<link rel="stylesheet" type="text/css" href="comptabilite/css/ledefault.css"/>
			<link rel="stylesheet" type="text/css" href="comptabilite/css/default_b.css"/>

		</head>


		<body>
				<div id="acceuil_logo"  >
					<h1> GSB  </h1>
				</div>
				  
				  <label id="Titre" >  INTERFACE DE GESTION DES NOTES DE FRAIS   </label>
				   <div "barreTitre"> </div>
				<div id="log">
			 	
			 	
			 	<div id="comptable">
			 		<label id="compta">  Support Comptable </label>
			 		<form name= "fm_seconnecter" id= "fm_seconnecter"  method="post" action="interface.php">
			 		 	<ul> Login :
			 		 		<li> <input id = "in_login"  name="in_login" type ="text"/> </li>
			 		 		
			 		 		password:
			 		  		<li><input id = "in_pwd"  name="in_pwd" type ="password"/> </li>
			 		  		
			 		  		<li><input id="in_con"  name="comptable" type ="submit" value="connexion"/> </li>

			 		  	<ul/>
			 		  		<div id="echec" class="echec" >
		 						<?php if(isset($_SESSION['echec_connection'])) {
		 									if ($_SESSION['echec_connection'] == "echec")  {
		 									echo " ***login et le password sont incorrects  veuillez réessayer **" ;
		 											
		 											}  
		 									session_destroy() ;
		 									
		 								} ;?>

		 					</div>
			 		</form>
			 	</div>
			 	<div id="commercial">
			 	<label id="com">  Commercial visiteur </label>
			 	<form name= "fm_seconnecter_com" id= "fm_seconnecter_com"  method="post" action="interface.php">
			 		 <div>
			 		 	<ul> Login :
			 		 		<li> <input id = "in_login"  name="in_login" type ="text"/> </li>
			 		 		
			 		 		password:
			 		  		<li><input id = "in_pwd"  name="in_pwd" type ="password"/> </li>
			 		  		
			 		  		<li><input id="in_con" name="commercial" type ="submit" value="connexion"/> </li>

			 		  	<ul/>
			 		  		<div id="echec" class="echec" >
		 						
		 					</div>
		 			</div>
			 	</form>
			 	</div>

			 </div>	
			<footer>
				<label id ="lab_auteur">  Auteur : komi Elom Heekpo    </label>  
				<label id="lab_annee">  version: 2014/2015  </label>   
			</footer>
		</body>


	</html>