<?php

date_default_timezone_set('America/Costa_Rica');

ini_set('display_errors', 0);

include ("conn/db.php");

function base_url(){
	return "http://biblioteca.netne.net/default.php";	
}

if (($_COOKIE['idUsuario'] == "" and $_COOKIE['usuario'] == "")){
if (basename($_SERVER['REQUEST_URI']) == "home.php" or basename($_SERVER['REQUEST_URI']) == "sugerencias.php" or basename($_SERVER['REQUEST_URI']) == "lost_password.php" or  basename($_SERVER['REQUEST_URI']) == "buscar.php" or basename($_SERVER['REQUEST_URI']) == "reservar.php"){
}else{
	if (basename($_SERVER['REQUEST_URI']) != "index.php" and basename($_SERVER['REQUEST_URI']) != "indexIE.php" and basename($_SERVER['REQUEST_URI']) != "indexie.php" and basename($_SERVER['REQUEST_URI']) != "signin.php"  ){
			echo "<script type='text/javascript'>
			parent.location.href = '".base_url()."index.php';
			</script>";
			exit();
		}
	}
}

$conn = mysqli_connect($server, $user, $password);
mysqli_select_db($conn,$database);

mysqli_set_charset($conn, "utf8"); /* Codigo Osver */


$tipoUsuario = $_COOKIE['tipo'];

if (isset($_COOKIE['sess']) or $tipoUsuario==1) {
	$session_code = $_COOKIE['sess'];
	$session_codeX = $session_code.$_SERVER['REMOTE_ADDR'];
	$userid = $_COOKIE['idUsuario'];
 	$usuario = $_COOKIE['usuario'];
 	$sql_checkSess = "Select id from tusuarios where id= '$userid' and session = '$session_codeX' and usuario = '$usuario'  and tipo = $tipoUsuario and estado = 1 limit 1"; 
 	$query_checkSess = mysqli_query($conn,$sql_checkSess);
 	//echo $sql_checkSess;
 	//exit();
 	if (mysqli_num_rows($query_checkSess)==0) {
 	setcookie('usuario', '', time()-300);   
	setcookie('idUsuario', '', time()-300);   
	setcookie('sess', '', time()-300);
	setcookie('tipo', '', time()-300);
	$session_code = '';
	$userid = '';
 	$usuario = '';  
 	$tipoUsuario = '';
 	?> 
 	 <META http-equiv="refresh" content="0;URL=index.php?"> 
 	<?php
 	exit();
 	} 
 
}


?>
