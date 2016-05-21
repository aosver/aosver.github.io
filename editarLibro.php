<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

$id = $_GET['idModificar'];

$bInscripcion = $_GET['bInscripcion'];
$bTitulo = $_GET['bTitulo'];
$bTipo = $_GET['bTipo'];
$busquedas = 'bInscripcion='.$bInscripcion.'&bTipo='.$bTipo.'&bTitulo='.$bTitulo.'&buscar=Buscar&';
$volver = $busquedas.'&pagi='.$_GET['pagi'];

if (isset($_POST['guardar'])){
  $id = $_POST['id'];
  $inscripcion = $_POST['inscripcion'];
  $tipoRecurso = $_POST['tipoRecurso'];
  $titulo = utf8_decode($_POST['titulo']);
  $signatura = $_POST['signatura'];
  $editorial = $_POST['editorial'];
  $edicion = $_POST['edicion'];
  $isbn = $_POST['ISBN'];


  $sqlLibros = "UPDATE tlibros SET
    inscripcion = $inscripcion, 
    tipo = $tipoRecurso,
    titulo = '$titulo', 
    signatura = '$signatura', 
    idEditorial = $editorial, 
    edicion = '$edicion', 
    isbn = '$isbn'
    WHERE id = $id;
    ";
  $queryLibros = mysqli_query($conn, $sqlLibros)or die(mysqli_error($conn));
?>
<script type="text/javascript">
  document.location.href = 'libros.php?<?PHP echo $volver ?>';
</script>
<?php
exit();
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

.selected {
  font-weight: bold;
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

<script type="text/javascript">

function mostrarAutor(){
  jQuery.post( "funcionesAJAX.php", { tipo: "0", libro: "<?php echo $id ?>" })
  .done(function( data ) {
    document.getElementById('autoresLibro').innerHTML = data;
  });
}

function addAutor(){
  var txt = document.getElementById('autores').value;
  jQuery.post( "funcionesAJAX.php", { tipo: "1", nombre: txt, libro: "<?php echo $id ?>" })
  .done(function( data ) {
    document.getElementById('autores').value = '';
    mostrarAutor();
  });
}

function eliminaAutor(idAutor){
  jQuery.post( "funcionesAJAX.php", { tipo: "2", idAutor: idAutor, libro: "<?php echo $id ?>" })
  .done(function( data ) {
    mostrarAutor();
  });
}

function valida(e){ 
  tecla=(document.all) ? e.keyCode : e.which; 
  if(tecla == 13){
    document.getElementById('agregarAutor').focus();
  }
} 
</script>

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

  <?php 
  $sqlLibros = "SELECT * FROM tlibros WHERE id = $id";
  $queryLibros = mysqli_query($conn, $sqlLibros);
  while ($rowLibros=mysqli_fetch_assoc($queryLibros)) {
  ?>

<center><h5>Agregar un libro nuevo</h5></center>

<table>
  <tr>
    <td>
      <form action="" method="post">
  <input type="hidden"  value="<?php echo $id ?>" name="id">
      <table width="100%">
      <tr>
      <td>Tipo de recurso: </td>
      <td>
        <?php 
        $sqlTipos = "SELECT * FROM ttiporecurso WHERE estado = 1";
        $queryTipos = mysqli_query($conn, $sqlTipos);

        if (mysqli_num_rows($queryTipos) == 0){
           echo 'No hay editoriales en el sistema.';
        }else{
           echo '<select name="tipoRecurso">';
            while($rowTipos = mysqli_fetch_assoc($queryTipos)){
                $selected = "";
                if ($rowTipos['id'] == $rowLibros['tipo']){
                  $selected = 'selected="selected" class="selected"';
                }
                echo '<option value="'.$rowTipos['id'].'" '.$selected.'>'.utf8_encode($rowTipos['nombre']).'</option>';
            }
           echo '</select>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td width="140">Número de inscripción: </td>
      <td><input value="<?php echo $rowLibros['inscripcion']?>" type="text" class="input-small" name="inscripcion"></td>
    </tr>
    <tr>
      <td>Título:</td>
      <td><input  value="<?php echo utf8_encode($rowLibros['titulo'])?>" type="text" class="input-big" name="titulo"></td>
    </tr>
    <tr>
      <td>Signatura: </td>
      <td><textarea name="signatura" style="width: 100px; height: 50px"><?php echo $rowLibros['signatura']?></textarea></td>
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
                $selected = "";
                if ($rowEditoriales['id'] == $rowLibros['idEditorial']){
                  $selected = 'selected="selected" class="selected"';
                }
                echo '<option value="'.$rowEditoriales['id'].'" '.$selected.'>'.utf8_encode($rowEditoriales['nombre']).'</option>';
            }
           echo '</select>';
        }
        ?>
      </td>
    </tr>
    <tr>
      <td>Edición:</td>
      <td>
        <input value="<?php echo $rowLibros['edicion']?>" type="text" class="input-small" name="edicion">
      </td>
    </tr>
     <tr>
      <td>ISBN: </td>
      <td><input value="<?php echo $rowLibros['isbn']?>" type="text" class="input-medium" name="ISBN"></td>
    </tr>
  </table>

<center><input type="submit" name="guardar" class="button" value="Guardar"> <input type="button" class="button" value="Cancelar" onclick="document.location.href='libros.php?<?php echo $volver?>'"></center>
</form>

    </td>
    <td valign="top">
      <center><h6>Autores</h6><br>
          
<div class="ui-widget">
    Nombre autor: <input id="autores" class="input-medium" onkeypress="valida(event)">
    <input type="button" class="button" name="agregarAutor" id="agregarAutor" value="Agregar" onclick="addAutor()">
</div>

          </center>
          <hr>
          <div id="autoresLibro">

         
          </div>
    </td>
  </tr>

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

<script>

mostrarAutor();

jQuery(function() {
    jQuery( "#autores" ).autocomplete({
        source: 'jsonAutores.php'
    });
});

</script>


<?php include ("includes/javascript.php");?>
</body>
</html>