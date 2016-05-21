<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
}
if (isset($_GET['idEliminar'])){
  $id = $_GET['idEliminar'];

  $sql = "UPDATE tusuarios SET estado = 0 WHERE idpersona = $id";
  $query = mysqli_query($conn,$sql)or die(mysqli_error($conn));

  $sql = "UPDATE tPersonas SET estado = 0 WHERE id = $id";
  $query = mysqli_query($conn,$sql)or die(mysqli_error($conn));
}
 ?>
 <?php
 if (isset($_GET['idActivar'])){
  $id = $_GET['idActivar'];

  $sql = "UPDATE tusuarios SET estado = 1 WHERE idpersona = $id";
  $query = mysqli_query($conn,$sql)or die(mysqli_error($conn));
  $sql = "UPDATE tpersonas SET estado = 1 WHERE id = $id";
  $query = mysqli_query($conn,$sql)or die(mysqli_error($conn));
}
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Mantenimiento de usuarios - Programación Alternativa</title>
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

<script type="text/javascript
" src="js/jquery.maskedinput.js"></script>

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
    Mantenimiento de usuarios
  <!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
  <!--AQUI INICIA EL CONTENIDO-->


  <form action="" method="post"> 

    <center>
    Buscar por: <br>
    Carne: <input type="text" name="bCarne" class="input-small">
    Nombre:<input type="text" name="bNombre" class="input-medium"> <input type="submit" value="Buscar" name="buscar" class="button">
    </center>
  </form>
    <hr>

    <?php
    if (isset($_POST['buscar'])){

      if  ($_POST['bCarne'] !=""){
         $bCarne = $_POST['bCarne'];
          $sql = "SELECT CONCAT(tp.apellidos, ' ', tp.nombre) as nombre, email, carne, id,estado FROM tpersonas as tp WHERE carne = '$bCarne' AND estado = 1";
      }else if ($_POST['bNombre'] !=""){
        $bNombre = $_POST['bNombre'];
        $sql = "SELECT CONCAT(tp.apellidos, ' ', tp.nombre) as nombre , email, carne, id,estado FROM tpersonas as tp WHERE UPPER(CONCAT('%',tp.nombre,' ',tp.apellidos,'%')) like UPPER('%$bNombre%')";
      }else{
       $sql = "SELECT CONCAT(tp.apellidos, ' ', tp.nombre) as nombre, carne, email, id,estado FROM tpersonas as tp";
      }
    }else{
      $sql = "SELECT CONCAT(tp.apellidos, ' ', tp.nombre) as nombre, carne, email, id,estado FROM tpersonas as tp";
    }
   // echo $sql;
  $query = mysqli_query($conn, $sql)or die (mysqli_error($conn));

if (mysqli_num_rows($query) == 0){
?>
<center>
<img src="img/info.png"><br>
No hay coincidencia.
</center>
<?php
}else{

//mostramos las editoriales

?>
<table width="100%" class="tabla">
<tr>
<td width="01" class="tabla_titulo"></td>
<td class="tabla_titulo" width="200">Nombre</td>
<td class="tabla_titulo" width="200">Carné</td>
<td class="tabla_titulo"width="200">Email</td>
<td class="tabla_titulo"width="200">Estado</td>

</tr>
<?php
while ($row=mysqli_fetch_assoc($query)){
  ?>
  <tr>
  <?php if ($row['estado']==1): ?>
    <td style=" background-color: #00ff00">
  <?php else: ?>
    <td style=" background-color: red">
  <?php endif ?>

  <a href="ModifiUser.php?idModificar=<?php echo $row['id']?>" style="text-decoration: none;">
  
  <img src="img/edit.png" height="20"> 
  </a>

  <?php if ($row['estado']==1): ?>
    <a href="MantUsuario.php?idEliminar=<?php echo $row['id']?>" onclick="return confirm('Esta seguro(a) que desea desactivar la cuenta.?');" style="text-decoration: none;">
  
  <img src="img/delete.png" height="20"> 
  </a>
  <?php else: ?>
      <a href="MantUsuario.php?idActivar=<?php echo $row['id']?>" onclick="return confirm('Esta seguro(a) que desea activar la cuenta.?');" style="text-decoration: none;">
  
  <img src="img/exito.png" height="20"> 
  </a>
  <?php endif ?>



  

  <td><?php echo  utf8_encode($row['nombre']);?></td>
  <td><?php echo $row['carne'];?></td>
  <td><?php echo $row['email'];?></td>
  <td><?php  
if ($row['estado']==1) {
  echo "Activo";
  # code...
}else{
  echo "No Activo";
}

  ?></td>
  
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