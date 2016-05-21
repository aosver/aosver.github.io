<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_POST['guardar']) or isset($_POST['guardarAutor'])){
  $inscripcion = $_POST['inscripcion'];
  $tipoRecurso = $_POST['tipoRecurso'];
  $titulo = utf8_decode($_POST['titulo']);
  $signatura = $_POST['signatura'];
  $editorial = $_POST['editorial'];
  $edicion = $_POST['edicion'];
  $isbn = $_POST['ISBN'];

  $sqlLibros = "INSERT INTO tlibros (inscripcion, titulo, signatura, idEditorial, edicion, isbn, estado) VALUES ($inscripcion, '$titulo', '$signatura', $editorial, '$edicion', '$isbn', 1)";

  $queryLibros = mysqli_query($conn, $sqlLibros)or die(mysqli_error($conn));

  if (isset($_POST['guardar'])){
      ?>
      <script type="text/javascript">
        document.location.href = 'libros.php?<?PHP echo $volver ?>';
      </script>
      <?php
      exit();
  }else if (isset($_POST['guardarAutor'])){
        $sql = "SELECT * FROM tlibros WHERE inscripcion = '$inscripcion' ORDER BY id DESC LIMIT 1";
        $query = mysqli_query($conn, $sql);
        while ($row=mysqli_fetch_assoc($query)) {
            $idModificar = $row['id'];
        }
      ?>
      <script type="text/javascript">
        document.location.href = 'editarLibro.php?idModificar=<?PHP echo $idModificar ?><?PHP echo $volver ?>';
      </script>
      <?php
      exit();
  }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Libros - Programación Alternativa</title>
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

<?php if ($mensaje == 1){ ?>
<script type="text/javascript">
  alert('Se guardó correctamente.');
  document.location.href='libros.php';
  </script>
<?php } ?>

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
    <a href="libros.php">Libros</a> &raquo; Nuevo libro
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
  <form action="" method="post">
  <center><h5>Agregar un libro nuevo</h5></center>
  <table width="100%">
    <tr>
      <td>Tipo de recurso: </td>
      <td>
        <?php 
        $sqlTipos = "SELECT * FROM ttiporecurso WHERE estado = 1";
        $queryTipos = mysqli_query($conn, $sqlTipos);

        if (mysqli_num_rows($queryTipos) == 0){
          echo 'No hay tipos de recurso en el sistema.';
        }else{
           echo '<select name="tipoRecurso">';
            while($rowTipos = mysqli_fetch_assoc($queryTipos)){
                echo '<option value="'.$rowTipos['id'].'">'.utf8_encode($rowTipos['nombre']).'</option>';

            }
           echo '</select>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td width="140">Número de inscripción: </td>
      <td><input type="text" class="input-small" name="inscripcion"></td>
      <td rowspan="6" valign="top"><center><h6>Autores</h6><hr><img src="img/info.png"><br>Debes guardar el libro para poder agregar autores</center></td>
    </tr>
    <tr>
      <td>Título:</td>
      <td><input type="text" class="input-big" name="titulo"></td>
    </tr>
    <tr>
      <td>Signatura: </td>
      <td><textarea name="signatura" style="width: 100px; height: 50px"></textarea></td>
    </tr>
     <tr>
      <td>Editorial: </td>
      <td>
        <?php 
        $sqlEditoriales = "SELECT * FROM teditorial WHERE estado = 1";
        $queryEditoriales = mysqli_query($conn, $sqlEditoriales);

        if (mysqli_num_rows($queryEditoriales) == 0){
        	echo 'No hay editoriales en el sistema.';
        }else{
           echo '<select name="editorial">';
            while($rowEditoriales = mysqli_fetch_assoc($queryEditoriales)){
                echo '<option value="'.$rowEditoriales['id'].'">'.utf8_encode($rowEditoriales['nombre']).'</option>';

            }
           echo '</select>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td>Edición:</td>
      <td>
        <input type="text" class="input-small" name="edicion">
      </td>
    </tr>
     <tr>
      <td>ISBN: </td>
      <td><input type="text" class="input-medium" name="ISBN"></td>
    </tr>
  </table>
<center><input type="submit" name="guardar" class="button" value="Guardar"><input type="submit" name="guardarAutor" class="button" value="Guardar y agregar autores"> <input type="button" class="button" value="Cancelar" onclick="document.location.href='libros.php'"></center>
</form>
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