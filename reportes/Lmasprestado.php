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
<title>libro mas prestado - Programación Alternativa</title>
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

  REPORTE DE PRESTAMOS
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
  $sql ="SELECT COUNT(tpr.idLibro) as Cantidad, tpr.*, tl.titulo 
     FROM tprestamos as tpr, tlibros as tl 
     WHERE tl.id = tpr.idLibro AND tpr.fecha BETWEEN '$fini' AND '$ffin' 
     GROUP BY tpr.idLibro ORDER BY COUNT(tpr.idLibro) DESC LIMIT 25";
 /*$sql = "SELECT tl.titulo,tpr.fecha, tpr.dias, tpr.multa FROM tlibros
       as tl, tpersonas as tp, tprestamos as tpr
       WHERE tpr.idLibro = tl.id AND tpr.idpersona = tp.id";*/
    //$sql =  "SELECT * FROM tprestamos";
      //$sql = "SELECT tpr.idLibro, FROM tprestamos as tpr";
$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>
<center>
<br><br>
<img src="img/info.png"><br>
No hay libros prestados en las fechas establecidas.
</center>
<?php
 }else{
//mostramos las editoriales
?>

<table width="100%" class="tabla">
<tr>
<td width="60"class="tabla_titulo">Cantidad de veces prestados</td>
<td class="tabla_titulo">titulo</td>
<td class="tabla_titulo">Ultima vez prestado</td>
</tr>
<?php
//$idLibro = 0;

while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr> 
  <td><?php echo $row['Cantidad'];?></td>
  <td><?php echo ($row['titulo']);?></td>
  <td><?php echo $row['fecha'];?></td>
<?php
}
?>
</tr>
</table>

<?php
}
?>
<script type="text/javascript">
  window.print();
</script>
</body>
</html>