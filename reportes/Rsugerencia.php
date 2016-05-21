<?php include ("../conn/db.php"); 

$conn = mysqli_connect($server, $user, $password);
mysqli_select_db($conn,$database);

mysqli_set_charset($conn, "utf8"); /* Codigo Osver */

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Sugerencias - Programación Alternativa</title>
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

<!--AQUI INICIA CSS Y JAVASCRIPT-->
<style type="text/css">
.tabla td {
  border-bottom: 1px solid #CCC;}

.tabla tr:hover {
  background: #e9e9e9;
}

.tabla_titulo {
  background: #484848;
  height: 30px;
  color: #FFF;}
  
td .tabla_final {
  border-top: 3px solid #484848;
  border-bottom: none;}
</style>
<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body>

<img src="../img/logouisil.png" style="float: left; position: absolute; top: 10px;" height="50">

<center>
<br>
  UNIVERSIDAD INTERNACIONAL SAN ISIDRO LABRADOR<br>
  DEPARTAMENTO DE BIBLIOTECA<br>  
  SISTEMA DE CONTROL DE PRESTAMOS<br><br>

  REPORTE DE Sugeriencias
</center>

<?php 
if (isset($_GET['fini'])){
  $fini = $_GET['fini'];
}else{
  $fini = date("d/m/Y");
}
if (isset($_GET['ffin'])){
  $ffin = $_GET['ffin'];
}else{
  $ffin = date("d/m/Y");
}

  $fini = $fini.' 00:00:00';
  $ffin = $ffin.' 00:00:00';

?>
  <?php
  $sql ="SELECT * FROM tsugerencia WHERE  estado = 0 AND fecha BETWEEN '$fini' AND '$ffin'";  
  //echo $sql;
  $query = mysqli_query($conn,$sql)or die(mysqli_error($query)); 
   
if (mysqli_num_rows($query) == 0){

?>


<center>
<br><br>
<img src="../img/info.png"><br>
No hay sugerencias en las fechas establecidas.
</center>
<?php
 }else{
//mostramos las editoriales
?>
<center>
<table width="100%" class="tabla">
<tr>
<td width="150"class="tabla_titulo">Fecha&nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora</td>
<td class="tabla_titulo">Detalle</td>

</tr>
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr>
  <td><?php echo $row['fecha'];?></td>
  <td><?php echo $row['detalle'];?></td>
<?php
}
?>
</td>
</tr>
</table>

<?php
}
?>
</table>
<center>

<script type="text/javascript">
  window.print();
</script>
</body>
</html>
