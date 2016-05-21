<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 
if (isset($_POST['Guardar'])){
$id = $_POST['id'];

$password = $_POST['password'];

$sqlCambiar = " UPDATE tusuarios SET 
  password ='$password'
 WHERE id = $id;
 ";

$queryCambiar=mysqli_query($conn,$sqlCambiar) or die (mysqli_error($conn));
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html lang ="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Mantenimiento de usuarios - Programación Alternativa</title>
<!--titulo de arriba-->
<style type="text/css">
body {
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
<style type="text/css">
  #showhide {
    margin-top: 5px;
    padding-bottom: 5px;
    height: 20px;
    width: 20px;

    cursor: pointer;
  }

</style>

<script type="text/javascript">
var estado = 0;
function cambiarEstado(){
  if (estado == 0){
    document.getElementById('showhide').innerHTML = '<img src="img/show.png">';
    document.getElementById('password').type = 'password';
    estado = 1;
  }else{
    document.getElementById('showhide').innerHTML = '<img src="img/hide.png">';
    document.getElementById('password').type = 'text';
    estado = 0;
  }
}

</script>
<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajes.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebar.php");?></td>
    <td valign="top">
    <div id="titulo"><i>
    <!--titulo de abajo-->
    Mantenimiento de usuario
  <!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
  <!--AQUI INICIA EL CONTENIDO-->
  <?php 
$id = $_GET['idModificar'];

$sqlUsuarios = "SELECT * FROM tusuarios WHERE idPersona=$id";
$queryUsuarios = mysqli_query($conn,$sqlUsuarios)or die (mysqli_error($conn));

if (mysqli_num_rows($queryUsuarios) == 0){
  echo "<br><br><br><br><center>Esta persona no tiene una cuenta registrada.</center>";
}

while ($rowUsuarios= mysqli_fetch_assoc($queryUsuarios)) {

?>
<center>


<?php

  ?>
<form action="" method="post">
    <input type= "hidden" value = "<?php echo $id ?>" name="id"> 
 <table border="0">
  <tr>
<td>Usuario:</td>
  <td><input OnFocus="this.blur()" value = "<?php echo  $rowUsuarios['usuario'] ?>" type="text" name="usuario" class="input-small"></td>
  <td width="20"></td>

    </tr>
    <tr>
    <td>Password:</td>
    <td><input value = "<?php echo $rowUsuarios['password'] ?>"   type="password" id="password" name="password"  class="input-small"/>
    </td>
    <td width="20"><div id="showhide" onclick="cambiarEstado();"><img src="img/show.png"></div></td>
    </tr>
    <tr>
    <td colspan="3">
    <center>
        <input type="submit"value="Guardar"class="button" name="Guardar" >
        <a href="MantUsuario.php"><input type="button" value="Cancelar"class="button" name="cancelar"></a>
      </center>
    </td> 
    </tr>
  </table>
  </form>

  </center>
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

<?php include ("includes/javascript.php")?>
</body>
</html>