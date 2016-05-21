<?php  

if (isset($_COOKIE['usuario']) and isset($_COOKIE['idUsuario'])) {
	setcookie('usuario', '', time()-300);   
	setcookie('idUsuario', '', time()-300);   
	setcookie('sess', '', time()-300);  
	setcookie('tipo', '', time()-300);   
	$userid = "";
 	$usuario = "";
 	$session_code = "";
} 

 ?>

 <META http-equiv="refresh" content="0;URL=index.php?">
