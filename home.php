<?php include ("conn/conn.php"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Inicio - Programación Alternativa</title>
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
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajesFrontal.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebarFrontal.php");?></td>
    <td valign="top">
    <div id="titulo"><i>
    <!--titulo de abajo-->
    Inicio
  <!--titulo de abajo-->
    </i></div>
    <div id="contenido">    
  <!--AQUI INICIA EL CONTENIDO-->


<?php   
  $SQL_USUARIO = "Select idPersona from tusuarios where id = $userid";
  $query_USUARIO = mysqli_query($conn,$SQL_USUARIO);
  $res_USUARIO = mysqli_fetch_assoc($query_USUARIO);
  $persona_id = $res_USUARIO['idPersona'];
  //echo $SQL_USUARIO;
  $SQL_Persona = "SELECT * from tpersonas where id = $persona_id and estado= 1";
  $QUERY_Persona = mysqli_query($conn,$SQL_Persona);
  $Personas = mysqli_fetch_assoc($QUERY_Persona); ?>

<center>
    <h3>Bienvenido <?php echo $Personas['nombre']; $idPersona = $Personas['id']; ?></h3>
  
</center>

<div class="cuadro">

  <table width="100%" border="0">
    <tr>
      <td rowspan="2" valign="top" width="64">
        <img src="img/red.png" height="64">
      </td>
      <td valign="top"><b>Préstamos pendientes de entrega<b><hr></td>
    </tr>
    <tr>
    <td valign="top">
        <?php

$sql ="SELECT tl.id, tl.titulo FROM tprestamos as tp, tlibros as tl WHERE tp.estado = 1 AND tp.idLibro = tl.id AND tp.idPersona = $idPersona"; 

$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>
<center>
<img src="img/info.png"><br>
No hay préstamos pendientes de entrega.
</center>
<?php
 }else{ ?>

<table width="100%" class="tabla">
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr> 
  <td><?php echo $row['tipo'].': '.utf8_encode($row['titulo']);?></td>
<?php
}
?>
</tr>
</table>

<?php
}
?>

     </td>     
    </tr>
  </table>

</div>

<div class="cuadro">

  <table width="100%" border="0">
    <tr>
      <td rowspan="2" valign="top" width="64">
        <img src="img/green.png" height="64">
      </td>
      <td valign="top"><b>Mis préstamos <i>(Últimos 5)</i><b><hr></td>
    </tr>
    <tr>
    <td valign="top">
        <?php

$sql ="SELECT tl.titulo,tl.id FROM tprestamos as tp, tlibros as tl WHERE tp.estado != 1 AND tp.idLibro = tl.id AND tp.idPersona = $idPersona"; 

$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>
<center>
<img src="img/info.png"><br>
No hay préstamos finalizados para mostrar.
</center>
<?php
 }else{ ?>

<table width="100%" class="tabla">
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr> 
  <td><a href="reservar.php?idLibro=<?php echo $row['id']?>"><?php echo $row['tipo'].': '.utf8_encode($row['titulo']);?></a></td>
<?php
}
?>
</tr>
</table>

<?php
}
?>

     </td>     
    </tr>
  </table>

</div>


<div class="cuadro">

  <table width="100%" border="0">
    <tr>
      <td rowspan="2" valign="top" width="64">
        <img src="img/star.png" height="64">
      </td>
      <td valign="top"><b>Recomendación de la semana<b><hr></td>
    </tr>
    <tr>
    <td valign="top">
        <?php

  $sql ="SELECT tl.id, ttp.nombre as tipo, tl.titulo FROM ttiporecurso as ttp, tlibros as tl WHERE tl.estado = 2 AND ttp.id = tl.tipo"; 

$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>
<center>
<img src="img/info.png"><br>
No hay recomendaciones para esta semana.
</center>
<?php
 }else{ ?>

<table width="100%" class="tabla">
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr> 
  <td><a href="reservar.php?idLibro=<?php echo $row['id']?>"><?php echo $row['tipo'].': '.utf8_encode($row['titulo']);?></a></td>
<?php
}
?>
</tr>
</table>

<?php
}
?>

     </td>     
    </tr>
  </table>

</div>


<div class="cuadro">

  <table width="100%" border="0">
    <tr>
      <td rowspan="2" valign="top" width="64">
        <img src="img/books.png">
      </td>
      <td valign="top"><b>Recursos más solicitados del mes<b><hr></td>
    </tr>
    <tr>
    <td valign="top">
        <?php

  $mes = date('m');
  $ano = date('Y');
  $fini = $ano.'-'.$mes.'-01 00:00:00';
  $ffin = date('Y-m-d').' 00:00:00';
  $sql ="SELECT COUNT(tpr.idLibro) as Cantidad, ttp.nombre as tipo, tpr.*, tl.titulo FROM ttiporecurso as ttp, tprestamos as tpr, tlibros as tl WHERE tl.id = tpr.idLibro AND tpr.fecha BETWEEN '$fini' AND '$ffin' AND ttp.id = tl.tipo GROUP BY tpr.idLibro ORDER BY COUNT(tpr.idLibro) DESC LIMIT 5"; 
$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>
<center>
<br>
<img src="img/info.png"><br>
No hay recursos prestados en las fechas establecidas.
</center>
<?php
 }else{ ?>

<table width="100%" class="tabla">
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr> 
  <td><a href="reservar.php?idLibro=<?php echo $row['idLibro']?>"><?php echo $row['tipo'].': '.utf8_encode($row['titulo']);?></a></td>
<?php
}
?>
</tr>
</table>

<?php
}
?>

     </td>     
    </tr>
  </table>

</div>



<style type="text/css">
  .cuadro {
    background: rgba(255,255,255,1);
    background: -moz-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(47%, rgba(246,246,246,1)), color-stop(100%, rgba(237,237,237,1)));
    background: -webkit-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -o-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: -ms-linear-gradient(top, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%, rgba(246,246,246,1) 47%, rgba(237,237,237,1) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#ededed', GradientType=0 );

    padding: 10px;
    border: 3px solid #949494;

    border-radius: 10px 10px 10px 10px;
    -moz-border-radius: 10px 10px 10px 10px;
    -webkit-border-radius: 10px 10px 10px 10px;

    -webkit-box-shadow: 9px 9px 62px -21px rgba(0,0,0,0.75);
    -moz-box-shadow: 9px 9px 62px -21px rgba(0,0,0,0.75);
    box-shadow: 9px 9px 62px -21px rgba(0,0,0,0.75);

    margin-top: 20px;
  }

</style>

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