<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_GET['idEliminar'])){
  $id = $_GET['idEliminar'];
  $sql = "UPDATE tcategorias SET estado = 0 WHERE id = $id";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
}

if (isset($_POST['nueva'])){
  $nombre = $_POST['nombre'];
  $sql = "INSERT INTO tcategorias (id, nombre, estado) VALUES (null, '$nombre',1)";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
}

if (isset($_POST['modifica'])){
	$id = $_POST['id'];
	$nombre = $_POST['nombre'];

	$sql = "UPDATE tcategorias SET 
	nombre = '$nombre' 
	WHERE id = $id";
	$query = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Categorias - Programación Alternativa</title>
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
    Categorias
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
  
  <?php if (isset($_GET['idModificar'])){ 
  	$id = $_GET['idModificar'];
  	$sql = "SELECT * FROM tcategorias WHERE id = $id";
  	$query = mysqli_query($conn, $sql);

  	while ($row=mysqli_fetch_assoc($query)) {
  		$nombre = $row['nombre'];
  	}
  	?>
 <center>
    Modificar una categoría<hr>
    <form action="categorias.php" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['idModificar']?>">
    Nombre: 
    <input type="text" name="nombre" value="<?php echo $nombre?>" autocomplete="off" class="input-medium"> 
    <input type="submit" name="modifica" class="button" value="Modificar">
    <a href="categorias.php"><input type="button" value="Cancelar" class="button"></a>
    </form>
  </center>
  <?php }else{ ?>
  <center>
    Agregar una nueva categoría<hr>
    <form action="" method="post">
    Nombre: 
    <input type="text" name="nombre" autocomplete="off" class="input-medium"> 
    <input type="submit" name="nueva" class="button" value="Guardar">
    </form>
  </center>
  <?php } ?>
  <hr>

  <?php 
    $sql = "SELECT * FROM tcategorias WHERE estado = 1";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 0){
      //mostramos mensaje: no hay editoriales
      ?>
      <center>
        <img src="img/info.png"><br>
        No hay categorias registradas.
      </center>
      <?php
    }else{
      //mostramos la tabla con las editoriales 
      ?>
        <table width="100%" class="tabla">
          <tr>
            <td width="50" class="tabla_titulo"></td>
            <td class="tabla_titulo">Editorial</td>  
          </tr>
          <?php
            while ($row=mysqli_fetch_assoc($query)) {
              ?>
                <tr>
                  <td>
                  <a href="categorias.php?idModificar=<?php echo $row['id'] ?>">
                  	<img src="img/edit.png" height="20">
                  </a> 
                  	<a href="categorias.php?idEliminar=<?php echo $row['id'] ?>" onclick="return confirm('Está seguro(a) que desea eliminar?');">
                  		<img src="img/delete.png" height="20">
                  	</a>
                  </td>
                  <td><?php echo $row['nombre'];?></td>                  
                </tr>
              <?php
            }
          ?>
          </table>
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

<?php include ("includes/javascript.php")?>
</body>
</html>