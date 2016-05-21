<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 
if (isset($_POST['hacerPrestamo'])){
  $idLibro = $_POST['idLibro'];
  $idPersona = $_POST['idPersona'];
  if (($idLibro==0) or ($idPersona == 0)) {
    ?>
    <script type="text/javascript">
      alert('error faltan datos!')
    </script>
<meta http-equiv="refresh" content="0; url=hacerPrestamo.php"/>
    <?php
  } else {
     // isset ve si ya hay alg
  $fecha = date("Y-m-d h:i:s");
  $dias = $_POST['dias'];
  $MultaDiaria = $_POST['multa'];

  $sql = "INSERT INTO tprestamos (idLibro,idPersona,fecha,dias,multa,estado) VALUES ('$idLibro','$idPersona','$fecha','$dias','$MultaDiaria','1')";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$sqlajustes = "UPDATE tajustes SET precio = $MultaDiaria WHERE id = 1 ";
$queryajustes = mysqli_query($conn,$sqlajustes)or die(mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0; url=consultaPrestamos.php"/>
<?php

  }
  

}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Nuevo Prestamo - Programación Alternativa</title>
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
jQuery(document).ready(function() {
  jQuery(".iframe").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    width     : '80%',
  });
});

function mostrarPersona(idPersona, identificacion, carne, nombre, apellidos, tipo, direccion, telefonoCasa, telefonoCelular, email){
  document.getElementById('idPersona').value = idPersona;
  document.getElementById('identificacion').value = identificacion;
  document.getElementById('carne').value = carne;
  document.getElementById('nombre').value = nombre;
  document.getElementById('apellidos').value = apellidos;
  document.getElementById('direccion').value = direccion;
  document.getElementById('telefonoCasa').value = telefonoCasa;
  document.getElementById('telefonoCelular').value = telefonoCelular;
  document.getElementById('tipo').value = tipo;
  document.getElementById('email').value = email;

  jQuery.fancybox.close("#iframe");
}

function mostrarLibro(idLibro, inscripcion, tituloLibro,signatura){
  document.getElementById('idLibro').value = idLibro;
  document.getElementById('inscripcion').value = inscripcion;
  document.getElementById('tituloLibro').value = tituloLibro;
  document.getElementById('signatura').value = signatura;

  jQuery.fancybox.close("#iframe");

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
    Nuevo Prestamo
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

  <center><h3>Datos Del Prestamo</h3><hr></center>

    <form action="" method="post">
     <?php
$fecha = date("d/m/y");
$multaDiaria = "multa";
?>
  <input type="hidden" name="idPersona" id="idPersona">
  <input type="hidden" name="idLibro" id="idLibro">

  <table border="0" width="100%">
    <tr>
      <td width="150">Identificacion:</td>
      <td>
        <input type="text" name="identificacion" id="identificacion" placeholder="Identificación" autocomplete="off" class="input-medium">
        <a href="buscarPersona.php" class="fancybox fancybox.iframe iframe"><img src="img/search.png" align="center" height="25"></a>
      </td>
    </tr>
    <tr>
      <td width="150">Carné:</td>
      <td>
        <input type="text" name="carne" id="carne" placeholder="Carné" autocomplete="off" class="input-medium">
      </td>
    </tr>
    <tr>
      <td width="150">Nombre:</td>
      <td>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" autocomplete="off" class="input-medium">
      </td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td>
        <input type="text" name="apellidos" id="apellidos" placeholder="Apellido" autocomplete="off" class="input-medium">
      </td>
    </tr>
    <tr>
      <td>Tipo de cliente:</td>
      <td>
        <input type="text" name="tipo" id="tipo" placeholder="Tipo de usuario" autocomplete="off" class="input-small">
      </td>
    </tr>
    <tr>
      <td>Direccion:</td>
      <td>
        <textarea name="direccion" id="direccion" placeholder="Identificación" autocomplete="off" style="width: 200px; height: 25px;"> </textarea>
      </td>
    </tr>
    <tr>
      <td>Telefono Casa: </td>
      <td>
        <input type="text" id="telefonoCasa" name="telefonoCasa" autocomplete="off" class="input-small">
      </td>
    </tr>
    <tr>
      <td>Telefono Celular: </td>
      <td>
        <input type="text" id="telefonoCelular" name="telefonoCelular" autocomplete="off" class="input-small">
      </td>
    </tr>
    <tr>
    <tr>
      <td>Email: </td>
      <td>
        <input type="text" name="email" id="email" autocomplete="off" class="input-medium">
      </td>
    </tr>
    </table>
    <hr>
    <table border="0" width="100%">
    <tr>
      <td width="150">Inscripción:</td>
      <td>
        <input type="text" name="inscripcion" id="inscripcion" autocomplete="off" class="input-small">
        <a href="buscarLibros.php" class="fancybox fancybox.iframe iframe"><img src="img/search.png" align="center" height="25"></a>
      </td>
    </tr>
    <tr>
      <td>Libro:</td>
      <td>
        <input type="text" name="tituloLibro" id="tituloLibro" autocomplete="off" class="input-big">
      </td>
    </tr>
    <tr>
      <td>
        Signatura:
      </td>
      <td>
        <input type="text" name="tituloLibro" id="signatura" autocomplete="off" class="input-big">
      </td>
    </tr>
      <tr>
      <td width="150"> Fecha:</td>
      <td> <b> <?php echo $fecha . " ". " ". date("h:i:a");?> </b> </td>
    </tr>
    <tr>
      <td>Dias a Prestar</td>
      <td>
      <?php 
  $sqlprecio = "SELECT * FROM tajustes WHERE id = 2"; 
  $queryprecio = mysqli_query($conn,$sqlprecio)or die(mysqli_error($conn));
  while ($rowprecio = mysqli_fetch_assoc($queryprecio)) {
    $dias = $rowprecio['precio'];
  }?>
        <input type="number" max="<?php echo $dias?>" value="<?php echo $dias?>" min="1" name="dias" id="dias" class="input-small" onblur="validarMax('dias', <?php echo $dias;?>)" style="width: 30px;">
      </td>
    </tr>
    <tr>
      <?php 
  $sqlprecio = "SELECT * FROM tajustes WHERE id = 1"; 
  $queryprecio = mysqli_query($conn,$sqlprecio)or die(mysqli_error($conn));
  while ($rowprecio = mysqli_fetch_assoc($queryprecio)) {
?>
      <td>Multa Diaria:</td>
      <td>
        <input type="text" name="multa" value="<?php echo $rowprecio['precio'] ?>" autocomplete="off" class="input-small">* La multa se puede cambiar en este campo.
      </td>
      <?php
    }
      ?>
    </tr>
    <tr>
      <td colspan="2">
        <hr><input type="submit" value="Realizar Prestamo" name="hacerPrestamo" class="button">
        <a href="hacerPrestamo.php"><input type="button" value="Cancelar" name="cancelar" class="button"></a>
        <a href="nuevaPersona.php">
        <input type="button" value="Agregar Persona" name="particular" class="button"></a>
      </td>
    </tr>
    <tr>
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

<script type="text/javascript">
  function validarMax(valor, max){
    var val = document.getElementById(valor).value;
    if (val > max){
      alert('El valor máximo es '+max);
      document.getElementById(valor).value = max;
    }
  }
</script>

<?php include ("includes/javascript.php")?>
</body>
</html>