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
<title>Ingresos por multas - Programación Alternativa</title>
<!--titulo de arriba-->
<style type="text/css">
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
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

  $sql = "SELECT tpr.id as idPrestamo, tl.titulo, CONCAT(tp.nombre,'',tp.apellidos) as persona, tpr.fecha, tpr.dias, tpr.multa FROM tlibros
       as tl, tpersonas as tp, tprestamos as tpr
       WHERE tpr.idLibro = tl.id AND tpr.fecha BETWEEN '$fini' AND '$ffin' AND tpr.idpersona = tp.id AND tpr.estado = 3";


 
   
    //$sql =  "SELECT * FROM tprestamos WHERE estado = 3";
      //$sql = "SELECT multa as tprestamos, SUM(multa) AS total FROM tprestamos where estado = 3 GROUP BY multa";
$query = mysqli_query($conn,$sql); 
if (mysqli_num_rows($query) == 0){
?>

<center>
<br><br>
<img src="../img/info.png"><br>
No hay ingresos por multas en las fechas establecidas.
</center>
<?php
 }else{
//mostramos las editoriales
?>

<table width="100%" class="tabla">
<tr>
<td class="tabla_titulo">Título</td>
<td class="tabla_titulo">Persona</td>
<td class="tabla_titulo">Fecha</td>
<td class="tabla_titulo">Dias</td>
<td class="tabla_titulo">Multa</td>
</tr>
<?php
$suma = 0;

while ($row=mysqli_fetch_assoc($query)){
  $idPrestamo = $row['idPrestamo'];
  $totalDias = $row['dias'];


 $sqlPrestamo = "SELECT tpr.fecha as fechaPrestamo, ADDDATE(tpr.fecha, INTERVAL $totalDias DAY) as fechaEntrega, 
  CASE WHEN DATEDIFF(now(), ADDDATE(tpr.fecha, INTERVAL $totalDias DAY)) > 0 THEN 
  (tpr.multa * DATEDIFF(now(), ADDDATE(tpr.fecha, INTERVAL $totalDias DAY))) ELSE 0 END as multa  FROM tprestamos AS tpr WHERE id = '$idPrestamo'
  ";
  //echo $sqlPrestamo;
  $queryPrestamo = mysqli_query($conn, $sqlPrestamo);
  while ($rowPrestamo=mysqli_fetch_assoc($queryPrestamo)) {
    $multa = $rowPrestamo['multa'];
    $suma = $suma + $multa;
  }

  ?>
  <tr>
  <td><?php echo $row['titulo'];?></td>
  <td><?php echo utf8_encode($row['persona']);?></td>
  <td><?php echo $row['fecha'];?></td>
  <td><?php echo $row['dias'];?></td>
  <td>&cent; <?php echo number_format($multa,2);
  ?></td>
<?php
}
?>

<?php
      $sql = "SELECT multa as tprestamos, SUM(multa) AS total FROM tprestamos  GROUP BY multa";
      $query = mysqli_query($conn,$sql);
      if (mysqli_num_rows($query)==0) {  # code...
      }
      ?>

      <table width="100%" class="tabla">
<tr>
<td width="79%" class="tabla"></td>
<td >Total de multas </td>
<td><?php echo '&cent;'.number_format($suma, 2);?></td>
<?php
while ($row=mysqli_fetch_assoc($query)){
  ?>
  </td>
  </tr>
  </tr>
  </table>

<?php 
}
?>


<?php
}?>


 <script type="text/javascript">
  window.print();
</script>
</body>
</html>