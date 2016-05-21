<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Consulta de Prestamos - Programación Alternativa</title>
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
    Consulta de Prestamos
  <!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
  <!--AQUI INICIA EL CONTENIDO-->
    <form action="" method="post">
    <center><h3>Buscar Prestamo por:</h3></center>
    <center>
      Titulo: <input type="text" name="tituloB" class="input-medium">
      Inscripción: <input type="text" name="inscripcionB" class="input-medium">
   
        <input type="submit" name="buscar" value="Buscar" class="button">
        </center>
    </form>
    <hr>
        <?php 
   if (isset($_POST['buscar'])) {
    $tituloB = $_POST['tituloB'];
    $inscripcionB = $_POST['inscripcionB'];

    if ($tituloB<>"") {
      $sql = "Select tprestamos.cancelado as Cancelado,tpersonas.id as idp, tprestamos.estado as estado, tprestamos.id as id, tprestamos.dias as dias, tlibros.titulo as titulo, tlibros.inscripcion as inscripcion, CONCAT(tpersonas.nombre,' ',tpersonas.apellidos) as nombre,tpersonas.identificacion as cedula, tprestamos.fecha as fecha, tprestamos.multa as multa from tprestamos inner join tlibros on tprestamos.idLibro = tlibros.id inner join tpersonas on tpersonas.id = tprestamos.idPersona where ((tprestamos.fecha > ADDDATE(now(), interval -30 DAY)) or tprestamos.estado =1 ) and upper(tlibros.titulo)  like UPPER('%$tituloB%')";
      //echo $sql;
    } elseif ($inscripcionB<>"") {
      $sql= "Select tprestamos.cancelado as Cancelado,tpersonas.id as idp, tprestamos.estado as estado, tprestamos.id as id, tprestamos.dias as dias, tlibros.titulo as titulo, tlibros.inscripcion as inscripcion, CONCAT(tpersonas.nombre,' ',tpersonas.apellidos) as nombre,tpersonas.identificacion as cedula, tprestamos.fecha as fecha, tprestamos.multa as multa from tprestamos inner join tlibros on tprestamos.idLibro = tlibros.id inner join tpersonas on tpersonas.id = tprestamos.idPersona where ((tprestamos.fecha > ADDDATE(now(), interval -30 DAY)) or tprestamos.estado =1 ) and tlibros.inscripcion = '$inscripcionB'";
    }else{
      $sql= "Select tprestamos.cancelado as Cancelado,tpersonas.id as idp, tprestamos.estado as estado, tprestamos.id as id, tprestamos.dias as dias, tlibros.titulo as titulo, tlibros.inscripcion as inscripcion, CONCAT(tpersonas.nombre,' ',tpersonas.apellidos) as nombre,tpersonas.identificacion as cedula, tprestamos.fecha as fecha, tprestamos.multa as multa from tprestamos inner join tlibros on tprestamos.idLibro = tlibros.id inner join tpersonas on tpersonas.id = tprestamos.idPersona where ((tprestamos.fecha > ADDDATE(now(), interval -30 DAY)) or tprestamos.estado =1 )";
    } }else{
      $sql= "Select tprestamos.cancelado as Cancelado,tpersonas.id as idp, tprestamos.estado as estado, tprestamos.id as id, tprestamos.dias as dias, tlibros.titulo as titulo, tlibros.inscripcion as inscripcion, CONCAT(tpersonas.nombre,' ',tpersonas.apellidos) as nombre,tpersonas.identificacion as cedula, tprestamos.fecha as fecha, tprestamos.multa as multa from tprestamos inner join tlibros on tprestamos.idLibro = tlibros.id inner join tpersonas on tpersonas.id = tprestamos.idPersona where ((tprestamos.fecha > ADDDATE(now(), interval -30 DAY)) or tprestamos.estado =1 ) order by id desc ";
    }
     
    $query=mysqli_query($conn,$sql);
    if (mysqli_num_rows($query)==0){
      //mostramos el mensaje no hay Libros.
      ?>
      <center>
        <img src="img/info.png"><br>
        No hay Prestamos registrados.
      </center>

      <?php
      }else{
        //mostramos la tabla con los libros
      ?>
      <?php
$count=0;

?>
     * <font color="green">Entregado </font><font color="blue">Pendiente </font><font color="Red">Tarde </font><font color="Black">Entregado Tarde </font>
    <table border="0" width="100%" class="tabla">
    <tr>
    <td with="50" class="tabla_titulo">#</td>
      <td class="tabla_titulo">Titulo</td>
        <td class="tabla_titulo">Inscripcion</td>
        <td class="tabla_titulo">Nombre</td>
        <td class="tabla_titulo">Fecha de Prestamo</td>
        <td class="tabla_titulo"> Dias </td>
        <td class="tabla_titulo">Multa</td>
    </tr>
    <?php
     while ($row =mysqli_fetch_assoc($query)){
      $count = $count + 1 ; 

      $prestamo_id = $row['id'];
      $sql_dias = "Select * from trenovaciones where idPrestamo = '$prestamo_id'";
      //echo $sql_dias;
      $query_dias = mysqli_query($conn,$sql_dias);
      if (mysqli_num_rows($query<>0)) {
        $cant_dias = $row['dias'];
      } else {
        $row_dias = mysqli_fetch_assoc($query_dias);
        $cant_dias = $row['dias']+$row_dias['dias'];
      }
      
$sqlMulta = "SELECT tpr.fecha as fechaPrestamo,
ADDDATE(tpr.fecha, INTERVAL $cant_dias DAY) as fechaEntrega,
CASE WHEN DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $cant_dias DAY)) > 0 THEN
(tpr.multa * DATEDIFF(now(),ADDDATE(tpr.fecha, INTERVAL $cant_dias DAY)))
ELSE
0
END as multa
FROM tprestamos as tpr WHERE id = $prestamo_id";
  $queryMulta = mysqli_query($conn, $sqlMulta);
  while ($rowMulta=mysqli_fetch_assoc($queryMulta)) {
    $multa = $rowMulta['multa'];
  }
?> <tr> <?php
  if ($row['estado']==1) {
    if ($multa<>0) {
      $prestamo_state = 'late';
      ?>
        <td style="background: red ;"> <font color="white"><?php echo $count ?> </font> </td>
      <?php
      //lleva multa
    } else {
      ?>
      <td style="background: blue;"> <font color="white"><?php echo $count ?> </font> </td>
      <?php
      $prestamo_state = 'pending';
      //pendiente
    }
  } elseif ($row['estado']==2) {
    //entregado a tiempo
    $prestamo_state = 'entregado';
    ?>
    <td style="background: green;"> <font color="white"><?php echo $count ?> </font> </td>
    <?php
  } elseif ($row['estado']==3) {
    //entregado tarde
    $multa = $row['Cancelado'];
    ?>
    <td style="background: black ;"> <font color="white"><?php echo $count ?> </font> </td>

    <?php

  }
  
      ?>
      <td> <a href="prestamo.php?idPersona=<?php echo $row['idp'] ?>"> <?php echo $row['titulo'] ?></a> </td>
      <td> <a href="prestamo.php?idPersona=<?php echo $row['idp'] ?>"><?php echo $row['inscripcion'] ?> </a> </td>
      
      <td> <a href="prestamo.php?idPersona=<?php echo $row['idp'] ?>"> <?php echo $row['nombre'] ?></a></td>
      
      <td> <a href="prestamo.php?idPersona=<?php echo $row['idp'] ?>"><?php echo $row['fecha'] ?> </a> </td>
      <td> <a href="prestamo.php?idPersona=<?php echo $row['idp'] ?>"><?php echo $cant_dias ?></a></td>
      <td> &cent;<?php echo number_format($multa,2) ?> </td>



      </tr>
    <?php } ?>
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

<?php include ("includes/javascript.php") ?>
</body>
</html>