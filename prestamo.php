<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if(isset($_GET['idEntregado'])){
  $idEntregado = $_GET['idEntregado'];
  $sql_prestamos = "SELECT dias from tprestamos where id = $idEntregado";
  $query_prestamos = mysqli_query($conn,$sql_prestamos);
  $res_prestamos = mysqli_fetch_assoc($query_prestamos);

 // echo $sql_prestamos;

  $totalDias = $res_prestamos['dias'];
  $sqlRenovacion = "SELECT * FROM trenovaciones WHERE idPrestamo = $idEntregado";
  $queryRenovacion = mysqli_query($conn, $sqlRenovacion);
  while ($rowRenovacion=mysqli_fetch_assoc($queryRenovacion)) {
    $dias = $rowRenovacion['dias'];
    $totalDias += $dias;
    echo '(+'.$dias.')';
  }
  //echo $sqlRenovacion;

  $sqlMulta = "SELECT tpr.fecha as fechaPrestamo,
ADDDATE(tpr.fecha, INTERVAL $totalDias DAY) as fechaEntrega,
CASE WHEN DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)) > 0 THEN
(tpr.multa * DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)))
ELSE
0
END as multa
FROM tprestamos as tpr WHERE id = $idEntregado";
  $queryMulta = mysqli_query($conn, $sqlMulta);
  while ($rowMulta=mysqli_fetch_assoc($queryMulta)) {
    $multa = $rowMulta['multa'];
  }
  if ($rowprestamo['cancelado']<>0) {
    $multa = $rowprestamo['cancelado'];
  }

  //echo $sqlMulta;
  //echo $multa;
   // exit();
if ($multa==0) {
  $sqlentregado = "UPDATE tprestamos SET estado = 2  WHERE id = $idEntregado";
} else {
  $sqlentregado = "UPDATE tprestamos SET estado = 3, cancelado = $multa WHERE id = $idEntregado ";
}


  //echo $sqlentregado;
  //exit();
  $queryEntregado = mysqli_query($conn,$sqlentregado)or die(mysqli_error($conn));
  ?>
<META http-equiv="refresh" content="0;URL=/biblioteca/prestamo.php?idPersona=<?php echo $_GET['idPersona'] ?>">

  <?php
  die();
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Prestamo - Programación Alternativa</title>
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
  function devolver(valONE,ValTWO) {
    var r = confirm("Desea señalar el libro como devuelto?");
if (r == true) {
    //x = "You pressed OK!";
    x = 'prestamo.php?idEntregado='+valONE+'&idPersona='+ValTWO;
   window.location= x;
} else {
    //x = "You pressed Cancel!";
    //se presiono cancelar.
}
//alert(x);

  }

  jQuery(document).ready(function() {
  jQuery(".iframe").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    width     : '90%',
  });
});
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
    Prestamo
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
  <?php
  $id=$_GET['idPersona'];
  $sqlPersona = "SELECT * FROM tpersonas WHERE id = $id";
  $queryPersonas = mysqli_query($conn, $sqlPersona);
while ($rowPersonas=mysqli_fetch_assoc($queryPersonas)) {  
  ?>
  <h3>
  <img src="img/user.png"><?php
if ($rowPersonas['tipoPersona'] == 1){
  echo "Estudiante: ";
}else if ($rowPersonas['tipoPersona'] == 2){
  echo "Funcionario: ";
}else if ($rowPersonas['tipoPersona'] == 3){
  echo "Particular: ";
}
echo $rowPersonas['nombre'].' '.$rowPersonas['apellidos'];
?>
</h3>
<table width="30%" border="0">
<tr>
<td colspan="2" class="tabla_titulo">Datos Personales:
</td>
<tr>
  <td>
      <b>
        Identificacion:
      </b>
        <?php echo $rowPersonas['identificacion']; ?>
      <br>
  </td>
  <td>
      <b>
      Email:
      </b><br>
      <?php echo $email = $rowPersonas['email']; ?>
  </td>
</tr>
<tr>
  <td>
    <b>
      Telefono Celular:
    </b>
      <?php echo $rowPersonas['telefonoCelular']; ?>
  </td>
  <td>
    <b>
      Direccion:
    </b><br>
     <?php echo $rowPersonas['direccion']; ?>
  </td>
</tr>
<tr>
  <td>
    <b>
      Telefono Casa:
    </b>
      <?php echo $rowPersonas['telefonoCasa']; ?>
  </td>
<?php
if ($rowPersonas['tipoPersona'] == 1){ ?>
<td><b>Carné:</b><br><?php echo $rowPersonas['carne'];}?></td>
<?php
}
?>
</h3>
<tr>
  <td>
    <a href="editarpersonas.php?bIdentificacion=&bCarne=&bNombre=&buscar=Buscar&&pagi=&idModificar=<?php echo $id ?>">
  <div style="text-decoration: underline;">Editar?</div>
</a>
  </td>
  <td>

    <a href="sendmail.php?email=<?php echo $email; ?>&idPersona=<?php echo $id ?>" class="fancybox fancybox.iframe iframe">
      <div style="text-decoration: underline;">Enviar Correo.</div>
    </a>
  </td>
</tr>
</table>



<hr>
<h2><center><u>
LIBROS PRESTADOS
</h2></center></u>

<?php

if (isset($_GET['vertodo'])) {
  $sqlprestamo = "SELECT * FROM tprestamos Where idPersona = $id order by id desc";
} else {
  $sqlprestamo = "SELECT * FROM tprestamos Where idPersona = $id and estado = '1'";
}

//echo $sqlprestamo;
$queryprestamo = mysqli_query($conn,$sqlprestamo);
?>
<center>Simbología: <img src="img/entregar.png" height="16px;"> Entregar. <img src="img/renew.png" height="16px;"> Renovar prestamo.</center>

<form name="LibrosPrestados">
<table width="100%" border="0" class="tabla">
<tr>
  <td class="tabla_titulo"><center>Inscripcion</td>
  <td class="tabla_titulo"><center>Libro</td>
  <td class="tabla_titulo"><center>ISBN</td>
  <td class="tabla_titulo"><center>Fecha de Retiro</td>
    <td class="tabla_titulo"><center>Dias de Prestamo</td>
  <td class="tabla_titulo"><center>Multa</td>
  <td class="tabla_titulo"><center>Opciones</center></td>
</tr>
<?php while ($rowprestamo=mysqli_fetch_assoc($queryprestamo)) { 
  $idPrestamo = $rowprestamo['id'];
  $idLibro = $rowprestamo['idLibro'];
  $sqlLibro="SELECT * FROM tlibros where id = $idLibro";
  $queryLibros = mysqli_query($conn,$sqlLibro);
 while ($rowLibros = mysqli_fetch_assoc($queryLibros)) {
  ?>
<tr>
  <td> <?php echo $rowLibros['inscripcion'] ?></td>
  <td><?php echo ($rowLibros['titulo']) ?></td>
  <td><center><?php echo $rowLibros['isbn'] ?></center></td>
  <td><center><?php echo $rowprestamo['fecha'] ?></center></td>
  <td width="10%"><center>
  <?php echo $rowprestamo['dias'];
  $totalDias = $rowprestamo['dias'];
  $sqlRenovacion = "SELECT * FROM trenovaciones WHERE idPrestamo = $idPrestamo";
  $queryRenovacion = mysqli_query($conn, $sqlRenovacion);
  while ($rowRenovacion=mysqli_fetch_assoc($queryRenovacion)) {
    $dias = $rowRenovacion['dias'];
    $totalDias += $dias;
    echo '(+'.$dias.')';
  }

  $sqlMulta = "SELECT tpr.fecha as fechaPrestamo,
ADDDATE(tpr.fecha, INTERVAL $totalDias DAY) as fechaEntrega,
CASE WHEN DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)) > 0 THEN
(tpr.multa * DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)))
ELSE
0
END as multa
FROM tprestamos as tpr WHERE id = $idPrestamo";
  $queryMulta = mysqli_query($conn, $sqlMulta);
  while ($rowMulta=mysqli_fetch_assoc($queryMulta)) {
    $multa = $rowMulta['multa'];
  }
  if ($rowprestamo['cancelado']<>0) {
    $multa = $rowprestamo['cancelado'];
  }


  ?></center></td>
  <?php if ($multa>0): ?>
    <td style="background-color: red"><center><font color="white">&cent;<?php echo number_format($multa,2) ?></font></center></td>
  <?php else: ?>
    <td><center>&cent;<?php echo number_format($multa,2) ?></center></td>
  <?php endif ?>
  
  <td width="44px;"> 
  <?php if ($rowprestamo['estado']==1): ?>
    <center>
  <img src="img/entregar.png" height="20px;" onclick="devolver(<?php echo $rowprestamo['id']?>,<?php echo $rowprestamo['idPersona']?>)">
  <a href="renovar.php?idrenovar=<?php echo $rowprestamo['id'] ?>"><img src="img/renew.png" height="22px;" sytle="text-decoration:none"></a>
  </center>
  <?php else: ?>
    <center><b>Entregado</b></center>
  <?php endif ?>
    </td>

</tr>
<?php
}
}
?>
</table>
</form>
<?php if (isset($_GET['vertodo'])): ?>
  <a href="prestamo.php?idPersona=<?php echo $id ?>">
  <div>
    <input type="button" class="button" value="Ver Pendiente"></input>
  </div>
</a>
<?php else: ?>
  <a href="prestamo.php?idPersona=<?php echo $id ?>&vertodo">
  <div>
    <input type="button" class="button" value="Ver Todo"></input>
  </div>
</a>
<?php endif ?>
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