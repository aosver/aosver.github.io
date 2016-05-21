<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
}

$sql = "UPDATE treservas SET 
estado = 4,
detalle = 'Vencido por no retirar libro en plazo establecido.' 
WHERE DATEDIFF(NOW(), fecha) > 3 AND estado = 2";
$query = mysqli_query($conn, $sql);


if (isset($_GET['idEliminar'])){
$id = $_GET['idEliminar'];
$sql ="UPDATE treservas SET estado = 3 WHERE id = $id";
$query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Reservaciones</title>
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
    Reservaciones 
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

<?php
$sqlReservas = "SELECT * FROM treservas where id = '$id'";
$query = mysqli_query($conn, $sqlReservas) or die(mysqli_error($conn));
?>

    
<center><h5>Reservaciones aprobadas</h5>
<hr size="1px" width="100%" align="left"/></center>
  <form action="" method="post">
  </form>

<?php
$sql = "SELECT CONCAT(tp.apellidos, ' ', tp.nombre) as nombre, tp.identificacion, tl.titulo, tr.id, tr.fecha FROM tpersonas as tp, tlibros as tl, treservas as tr, tusuarios as tu
WHERE tr.idUsuario = tu.id AND tu.idPersona = tp.id AND tr.idLibro = tl.id AND tr.estado = 2";
$query = mysqli_query($conn, $sql);
//echo $sql;

if (mysqli_num_rows($query) == 0){
  //mostramos mensaje : no hay reservaciones
  ?>
  <center>
    <img src="img/info.png"><br>
    No hay reservaciones registrados.
  </center>
  <?php
  }else{ 
    //mostramos la tabla con las reservaciones
    ?>

<center>Simbología: <img src="img/right.png" height="16px;"> Realizar préstamo. <img src="img/delete.png" height="16px;"> Eliminar.</center>

    <table width="100%" class="tabla">
    <tr>
      <td width="20" class="tabla_titulo"></td>
      <td class="tabla_titulo"width="150">Fecha</td>
      <td class="tabla_titulo"width="150">Identificacion</td>
      <td class="tabla_titulo" width="150">Nombre</td>
      <td class="tabla_titulo" width="150">Libro</td>
      </tr>
      <?php
      while ($row =mysqli_fetch_assoc($query)) { 
      ?>
      <tr>
      <td><a href="nuevoPrestamo.php?idMostrar=<?php echo $row['id'];?>" style="text-decoration: none"><img src="img/right.png" height="20px;"></a>
        
      <a href="reservaciones.php?idEliminar=<?php echo $row['id'] 
        ?>" onclick="return confirm('Está seguro(a) que desea eliminar');" style="text-decoration: none"><img src="img/delete.png" height="20px;"></a></td>
        <td><?php echo $row['fecha'];?></td>
      <td><?php echo $row['identificacion'];?></td>
      <td><?php echo ($row['nombre']);?></td>
      <td><?php echo ($row['titulo']);?></td>
      </tr>
      <?php
      }
    ?>

     </table>
    <?php  
  } ?>

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