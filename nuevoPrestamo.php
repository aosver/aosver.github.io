<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

$idReserva = $_GET['idMostrar'];

if (isset($_POST['realizarPrestamo'])){ // isset ve si ya hay algo
  $idReserva = $_POST['idReserva'];
  $usuario= $_POST['usuario'];

  $SQL_USUARIO = "Select idPersona from tusuarios where id = $usuario";
  $query_USUARIO = mysqli_query($conn,$SQL_USUARIO);
  $res_USUARIO = mysqli_fetch_assoc($query_USUARIO);
  $persona_id = $res_USUARIO['idPersona'];


  $libro= $_POST['libro'];
  $fecha = date("Y-m-d h:i:s");
  $dia = $_POST['dias'];
  $MultaDiaria = "200";
  $sql = "INSERT INTO tprestamos (idLibro,idPersona,fecha,dias,multa,estado) VALUES ('$libro','$persona_id','$fecha','$dia','$MultaDiaria','1')";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  $sql ="UPDATE treservas SET estado = 5 WHERE id = $idReserva";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn))

?>
<meta http-equiv="refresh" content="0; url=consultaPrestamos.php"/>
<?php
exit();
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
  <?php
$fecha = date("d/m/y");
  ?>
  <center><h5>Datos Del Prestamo</h5><hr></center>

<?php 
$sqlReserva = "SELECT tp.apellidos, tp.nombre, tp.tipoPersona, tp.identificacion, tp.telefonoCasa, tp.telefonoCelular, tp.direccion, tp.email, tl.titulo, tr.id, tr.idUsuario, tr.idLibro, tl.inscripcion,tl.signatura FROM tpersonas as tp, tlibros as tl, treservas as tr, tusuarios as tu
WHERE tr.idUsuario = tu.id AND tu.idPersona = tp.id AND tr.idLibro = tl.id AND tr.estado = 2 AND tr.id = $idReserva";
$queryReserva = mysqli_query($conn, $sqlReserva);
while ($rowReserva = mysqli_fetch_assoc($queryReserva)) {
  $idUsuario = $rowReserva['idUsuario'];
  $idLibro = $rowReserva['idLibro'];
  ?>
  <form action="" method="post">
<input type="hidden" value="<?php echo $idUsuario?>" name="usuario">
<input type="hidden" value="<?php echo $idLibro?>" name="libro">
<input type="hidden" value="<?php echo $idReserva?>" name="idReserva">
  <?php 
    $multaDiaria = 200;
  ?>

  <table border="0" width="100%">
    <tr>
      <td width="150">Nombre: </td>
      <td>
        <b><?php echo $rowReserva['nombre']?></b>
      </td>
    </tr>
    <tr>
      <td>Apellidos</td>
      <td>
        <b><?php echo $rowReserva['apellidos']?></b>
      </td>
    </tr>
     <tr>
      <td>Identificacion</td>
      <td>
        <b><?php echo $rowReserva['identificacion']?></b>
      </td>
    </tr>
    <tr>
      <td>Tipo de cliente:</td>
      <td><b>
        <?php if ($rowReserva['tipoPersona'] == 1){echo 'Estudiante';} 
        if ($rowReserva['tipoPersona'] == 2){echo 'Funcionario';}
        if ($rowReserva['tipoPersona'] == 3){echo 'Particular';}?> 
        </b>
      </td>
    </tr>
    <tr>
      <td>Direccion:</td>
      <td>
        <b><?php echo $rowReserva['direccion']?></b>
      </td>
    </tr>
    <tr>
      <td>Telefono Celular: </td>
      <td>
        <b><?php echo $rowReserva['telefonoCelular']?></b>
      </td>
    </tr>
    <tr>
      <td>Telefono Casa: </td>
      <td>
        <b><?php echo $rowReserva['telefonoCasa']?></b>
      </td>
    </tr>
    <tr>
    <tr>
      <td>Email: </td>
      <td>
        <b><?php echo $rowReserva['email']?></b>
      </td>
    </tr>
</table>
<hr>
<table border="0" width="100%">
    <tr>
      <td width="150">Libro:</td>
      <td>
        <b><?php echo ($rowReserva['titulo'])?></b>
      </td>
    </tr>
    <tr>
      <td>
        Inscripcion:
      </td>
      <td>
        <b><?php echo $rowReserva['inscripcion'] ?></b>
      </td>
    </tr>
    <tr>
      <td>
        Signatura:
      </td>
      <td>
        <b><?php echo $rowReserva['signatura'] ?></b>
      </td>
    </tr>
    <tr>
      <td>Fecha:</td>
      <td>
          <b><?php echo $fecha . " " ."Hora:" . " " . date("h:i:a")?></b>
      </td>
    </tr>
    <tr>
      <td>Dias:</td>
      <td>

      <?php 
  $sqlprecio = "SELECT * FROM tajustes WHERE id = 2"; 
  $queryprecio = mysqli_query($conn,$sqlprecio)or die(mysqli_error($conn));
  while ($rowprecio = mysqli_fetch_assoc($queryprecio)) {
    $dias = $rowprecio['precio'];
  }?>
        <input type="number" max="<?php echo $dias;?>" value="<?php echo $dias;?>" min="1" name="dias" id="dias" class="input-small" style="width: 50px" onblur="validarMax('dias', <?php echo $dias;?>)">
      </td>
    </tr>
    <tr>
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
      <td colspan="2">
        <hr><input type="submit" value="Realizar Prestamo" name="realizarPrestamo" class="button">
        <a href="reservaciones.php"> <input type="button" value="Cancelar" name="cancelar" class="button"> </a>
      </td>
    </tr>
    
    <tr>
  </table>
</form>
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

<script type="text/javascript">
  function validarMax(valor, max){
    var val = document.getElementById(valor).value;
    if (val > max){
      alert('El valor máximo es '+max);
      document.getElementById(valor).value = max;
    }
  }
</script>

<?php include ("includes/javascript.php")
?>
</body>
</html>