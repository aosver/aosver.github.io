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
<a href="consultaPrestamosx.php">
  <div style="float: right;">
    <input type="button" class="button" value="Ver Todos"></input>
</div>
</a>
<br><br>
    <form action="" method="post">
    <center><h3>Buscar Prestamo por:</h3></center>
    <center>
    	Nombre Persona: <input type="text" name="nombreB" class="input-medium">
    	Cedúla: <input type="text" name="CedulaB" class="input-medium">
        Carné : <input type="text" name="CarneB" class="input-medium"> * Estudiantes <br><br>
        <input type="submit" name="buscar" value="Buscar" class="button">
        </center>
    </form>
    <hr>
        <?php 
   if (isset($_POST['buscar'])) {
      if ($_POST['nombreB']!="") {
        $nombreB = $_POST['nombreB'];
        $sql="SELECT * FROM tpersonas WHERE UPPER(nombre) LIKE UPPER('%$nombreB%') AND estado=1";
      }else if ($_POST['CedulaB']!="") {
        $CedulaB = $_POST['CedulaB'];
        $sql="SELECT * FROM tpersonas WHERE identificacion = '$CedulaB' AND estado=1";
      }else if ($_POST['CarneB']!="") {
        $CarneB = $_POST['CarneB'];
        $sql="SELECT * FROM tpersonas WHERE carne = '$CarneB' AND estado=1";
      }else{
        $sql ="SELECT * From tpersonas WHERE estado = 1";
      }
      }else{
        $sql ="SELECT * From tpersonas WHERE estado = 1";
      } 
    $query=mysqli_query($conn,$sql);
    if (mysqli_num_rows($query)==0){
      //mostramos el mensaje no hay Libros.
      ?>
      <center>
        <img src="img/info.png"><br>
        No hay libros registradas.
      </center>

      <?php
      }else{
        //mostramos la tabla con los libros
      ?>
      <?php


?>
    
    <table border="0" width="100%" class="tabla">
    <tr>
    <td with="50" class="tabla_titulo"></td>
    	<td class="tabla_titulo">Nombre</td>
        <td class="tabla_titulo">Apellidos</td>
        <td class="tabla_titulo">Tipo de Cliente</td>
        <td class="tabla_titulo">Cedula</td>
    </tr>
    <?php
     while ($row =mysqli_fetch_assoc($query)){

      $idPersona = $row['id'];
      $sql2 = "SELECT * FROM tprestamos WHERE idPersona = $idPersona and estado=1";
      $query2 = mysqli_query($conn,$sql2);
      if (mysqli_num_rows($query2) != 0){
    	?>
    	<tr>
    		<td width="50">
    		<a href="prestamo.php?idPersona=<?php echo $row['id'] ?>"><input type="button" name="" value="Ingresar" class="button" >
    			   		</td>
<td><?php echo $row['nombre'];?></td>
<td><?php echo $row['apellidos'];?></td>
<td><?php 

if ($row['tipoPersona'] == 1){
	echo "Estudiante";
}else if ($row['tipoPersona'] == 2){
	echo "Funcionario";
}else if ($row['tipoPersona'] == 3){
	echo "Particular";
}
?></td>
<td><?php echo $row['identificacion'];?></td>

</tr>
<?php
}
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