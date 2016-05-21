<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
}

if(isset($_POST["guardar"]))
{
  $tipoPersona = $_POST['tipoPersona'];
  $carne = $_POST['carne'];
  $identificacion = $_POST['identificacion'];
  $nombre = $_POST['nombre'];
  $apellidos = $_POST['apellidos'];
  $telefonoCasa = $_POST['telefonoCasa'];
  $telefonoCelular = $_POST['telefonoCelular'];
  $email = $_POST['email'];
  $direccion = $_POST['direccion'];

  $sqlmantepersonas = "INSERT INTO tpersonas (tipoPersona, carne, identificacion, nombre, apellidos, telefonoCasa, telefonoCelular, email, direccion, estado) 
  VALUES ('$tipoPersona', '$carne', '$identificacion', '$nombre', '$apellidos', '$telefonoCasa', '$telefonoCelular','$email', '$direccion', 1)";

  $querymantepersonas = mysqli_query($conn, $sqlmantepersonas) or die(mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0; url=personas.php"/>
<?php
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Mantenimiento de persona - Programación Alternativa</title>
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
<script type="text/javascript">

function desactivarCarne(val){
  if (val == 1){
   document.getElementById('carneSpan').innerHTML = '<input type="text" name="carne"  autocomplete="off" placeholder="Carné" class="input-small">';
  }else{
    document.getElementById('carneSpan').innerHTML = 'No Aplica';
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
    <div id="titulo">
    <!--titulo de abajo-->
    Mantenimiento Persona
	<!--titulo de abajo-->
    </div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

  <center><h3>Nueva persona</h3></center>

  <form action="" method="post">
    <table border="0">
      <tr>
         <td><b>Tipo Persona: </b></td>
        <td>
          <select name="tipoPersona" onchange="desactivarCarne(this.value)">
            <option value="1">Estudiante</option>
            <option value="2">Docente</option>
            <option value="3">Particular</option>
          </select>
        </td>
      </tr>
      <tr>
      <td><b>Carné: </b></td>
      <td>
        <span id="carneSpan">
          <input type="text" name="carne" autocomplete="off" placeholder="Carné" class="input-small">
        </span>
      </td>
    </tr></tr>
    <tr>
      <td><b>Identificación: </b></td>
      <td> <input type="text" name="identificacion" autocomplete="off" placeholder="Identificación" class="input-small"> </td>
    </tr>
    <tr>
       <td><b>Nombre: </b></td>
      <td>
          <input type="text" name="nombre" autocomplete="off" placeholder="Nombre" class="input-medium">
      </td>
    </tr>
    <tr>
      <td><b>Apellidos: </b></td>
      <td> <input type="text" name="apellidos" placeholder="Apellidos" autocomplete="off" class="input-medium"></td>
    </tr>       
    <tr>
       <td><b>Dirección: </b></td>
      <td>
        <textarea name="direccion" placeholder="Dirección" style="width: 240px; height: 80px"></textarea>
      </td>
    </tr>
        <tr>
       <td><b>Teléfono Casa: </b></td>
      <td>
          <input type="text" name="telefonoCasa" placeholder="Teléfono casa" autocomplete="off" class="input-small">
      </td>
    </tr>
    <tr>
      <td><b>Teléfono Celular: </b></td>
      <td>
          <input type="text" name="telefonoCelular" placeholder="Teléfono celular" autocomplete="off" class="input-small">
      </td>
    </tr>
    <tr>
      <td><b>Email: </b></td>
      <td>
          <input type="text" name="email" placeholder="Email" autocomplete="off" class="input-big">
      </td>
    </tr>
    <tr>  
      <td colspan="2">
        <center>
          <input type="submit" class="button" value="Guardar" name="guardar"></input>
          <a href="personas.php"><input type="button" class="button" value="Cancelar" name="cancelar"></input></a>
        </center>
      </td>
    </tr></tr>
    </table>
  </form>

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