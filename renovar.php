<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_POST['renovar'])){

  $dias = $_POST['dias'];
$idPRE = $_GET['idrenovar'];
$idPersona = $_POST['inputIDPERSONA'];
//echo($idPersona);
  $sql="INSERT INTO trenovaciones (idPrestamo,dias,estado) 
  Values ('$idPRE','$dias',1)
  ";
$query = mysqli_query($conn,$sql)or die(mysqli_error($conn));
?>
<meta http-equiv="refresh" content="0; url=prestamo.php?idPersona=<?php echo $idPersona ?>"/>
<?php
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Renovacion- Programación Alternativa</title>
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
    Renovacion
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
<?php
$id=$_GET['idrenovar'];
$sqlPrestamo = "SELECT * FROM tprestamos WHERE id = $id";
$queryPrestamo = mysqli_query($conn, $sqlPrestamo);
while ($rowPrestamo=mysqli_fetch_assoc($queryPrestamo)) {
  $totalDias = $rowprestamo['dias'];
  $sqlRenovacion = "SELECT * FROM trenovaciones WHERE idPrestamo = $idPrestamo";
  $queryRenovacion = mysqli_query($conn, $sqlRenovacion);
  $idLibro = $rowPrestamo['idLibro'];
  $idPersona = $rowPrestamo['idPersona'];
  $sqlLibro="SELECT * FROM tlibros WHERE id = $idLibro";
  $sqlpersona="SELECT * FROM tpersonas where id = $idPersona";
  $queryLibro=mysqli_query($conn,$sqlLibro);
  $queryPersona = mysqli_query($conn,$sqlpersona);
  while ($rowPersona = mysqli_fetch_assoc($queryPersona)) {
    while ($rowLibro = mysqli_fetch_assoc($queryLibro)){
  ?>
    <form action="" method="POST">
<table width="100%" class="tabla" border="0">
<tr>
<td>
<h3 class="tabla_titulo">Datos del Cliente</h3>
<b><?php echo $rowPersona['nombre'].' '.$rowPersona['apellidos']?></b>
<br>
<b>Identificacion: </b><?php echo $rowPersona['identificacion']?>
<br>
<b>
<?php if ($rowPersona['tipoPersona'] == 1){
  echo "Estudiante";
}else if ($rowPersona['tipoPersona'] == 2){
  echo "Funcionario";
}else if ($rowPersona['tipoPersona'] == 3){
  echo "Particular";
} ?></b>
<br>
<b>Telefono Casa :</b>  <?php echo $rowPersona['telefonoCasa']?>
    <b>Telefono Celular :</b> <?php echo $rowPersona['telefonoCelular']?>
  <br>
    <b>Correo Electronico :</b> <?php echo $rowPersona['email']?> 
    <h3 class="tabla_titulo">Datos De Prestamo</h3>
    <b>inscripcion:</b> <?php echo $rowLibro['inscripcion'] ?>
    <br>
    <b>Libro:</b><?php echo utf8_encode($rowLibro['titulo']) ?>
    <br>
    <b>IBSN:</b><?php echo $rowLibro['ibsn'] ?>
    <br>
     <b> Fecha de Retiro:</b><?php echo $rowPrestamo['fecha'] ?>
    <br>
    <b> Dias de Prestamo:</b><?php echo $totalDias = $rowPrestamo['dias'] ?>
    <br>
      <h3 class="tabla_titulo">Renovacion de Prestamo</h3>
      <b>Dias a renovar :</b><input type="number" max="5" min="1" name="dias" autocomlete="off">
      <br>
      <b>Multa Pendiente:&cent;<?php 
      $sqlMulta = "SELECT tpr.fecha as fechaPrestamo,
      ADDDATE(tpr.fecha, INTERVAL $totalDias DAY) as fechaEntrega,
      CASE WHEN DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)) > 0 THEN
      (tpr.multa * DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)))
      ELSE
      0
      END as multa
      FROM tprestamos as tpr WHERE id = $id";
        $queryMulta = mysqli_query($conn, $sqlMulta);
        while ($rowMulta=mysqli_fetch_assoc($queryMulta)) {
          $multa = $rowMulta['multa'];
        }
    echo number_format($multa,2);
?>
      <br><br>
      <input type="hidden" name="inputIDPERSONA" value="<?php echo $idPersona ?>"></input>
       <input type="submit" class="button" value="Renovar" name="renovar">
       <a href="consultaPrestamos.php" ><input type="button" class="button" value="Cancelar" name="cancelar">
      </tr>
    </table>
<?php
}}}
?>
</form
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