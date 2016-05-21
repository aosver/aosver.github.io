<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_GET['idEliminar'])){
  $id = $_GET['idEliminar'];
  $sql = "UPDATE ttiporecurso SET estado = 0 WHERE id = $id";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
}

if (isset($_POST['nueva'])){
  $nombre = utf8_decode($_POST['nombre']);
  $sql = "INSERT INTO ttiporecurso (id, nombre, estado) VALUES (null, '$nombre',1)";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
}

if (isset($_POST['modifica'])){
	$id = $_POST['id'];
	$nombre = utf8_decode($_POST['nombre']);

	$sql = "UPDATE ttiporecurso SET 
	nombre = '$nombre' 
	WHERE id = $id";
	$query = mysqli_query($conn, $sql);
}

$busquedas = '&pagi='.$_GET['pagi'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Tipos de recurso - Programación Alternativa</title>
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
    Tipos de recurso
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
  
  <?php if (isset($_GET['idModificar'])){ 
  	$id = $_GET['idModificar'];
  	$sql = "SELECT * FROM ttiporecurso WHERE id = $id";
  	$query = mysqli_query($conn, $sql);

  	while ($row=mysqli_fetch_assoc($query)) {
  		$nombre = $row['nombre'];
  	}
  	?>
 <center>
    Modificar un tipo<hr>
    <form action="tipoRecurso.php?<?php echo $busquedas?>" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['idModificar']?>">
    Nombre: 
    <input type="text" name="nombre" value="<?php echo utf8_encode($nombre)?>" autocomplete="off" class="input-medium"> 
    <input type="submit" name="modifica" class="button" value="Modificar">
    <a href="tipoRecurso.php"><input type="button" value="Cancelar" class="button"></a>
    </form>
  </center>
  <?php }else{ ?>
  <center>
    Agregar una nuevo tipo<hr>
    <form action="" method="post">
    Nombre: 
    <input type="text" name="nombre" autocomplete="off" class="input-medium"> 
    <input type="submit" name="nueva" class="button" value="Guardar">
    </form>
  </center>
  <?php } ?>
  <hr>

  <?php 
    $sql = "SELECT * FROM ttiporecurso WHERE estado = 1";
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 0){
      //mostramos mensaje: no hay editoriales
      ?>
      <center>
        <img src="img/info.png"><br>
        No hay tipos registrados.
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
$pagi = $_GET['pagi']; 
$contar_pagi = (strlen($pagi));    // Contamos el numero de caracteres 
// Numero de registros por pagina 
$numer_reg = 20; 
// Contamos los registros totales 
    //$sql = "SELECT * FROM tclientes WHERE estado = '1' $busqueda";
   
$query0 = $sql;
$result0 = mysqli_query($conn, $query0);  
$numero_registros0 = mysqli_num_rows($result0);  
$numpaginas = ceil($numero_registros0/$numer_reg);
############################################## 
// ----------------------------- Pagina anterior 
$prim_reg_an = $numer_reg - $pagi; 
$prim_reg_ant = abs($prim_reg_an);        // Tomamos el valor absoluto 

if ($pagi <> 0)  
{  
$pag_anterior = "<a href='".$_SERVER['PHP_SELF']."?".$busquedas."pagi=0'><img src=\"img/first.png\"></a><a href='".$_SERVER['PHP_SELF']."?".$busquedas."pagi=$prim_reg_ant'><img src=\"img/prev.png\"></a>"; 
} 
// ----------------------------- Pagina siguiente 
$prim_reg_sigu = $numer_reg + $pagi; 

if ($pagi < $numero_registros0 - ($numer_reg - 1))  
{  
$ultimapagina = ($numpaginas*$numer_reg)-$numer_reg;
$pag_siguiente = "<a href='".$_SERVER['PHP_SELF']."?".$busquedas."pagi=$prim_reg_sigu'><img src=\"img/next.png\"></a><a href='".$_SERVER['PHP_SELF']."?".$busquedas."pagi=$ultimapagina'><img src=\"img/last.png\"></a>"; 
} 
// ----------------------------- Separador 
//$separador = (($pagi/$numer_reg)+1)." de ".$numpaginas;

if ($numpaginas == 1){
  $separador = 'Página 1 de 1';
}else{
  $separador = '<select onchange="document.location.href=\''.$_SERVER['PHP_SELF'].'?'.$busquedas.'pagi=\'+this.value">';
  for ($x=1; $x <= $numpaginas; $x++) {
    $selected = '';
    if ((($x*$numer_reg+1)-$numer_reg) == $pagi){
      $selected = 'selected="selected" class="selected"';
    }
    $separador .= '<option value="'.(($x*$numer_reg+1)-$numer_reg).'" '.$selected.'>'.$x.'</option>'; 
  }
  $separador .= '</select>';
}

// Creamos la barra de navegacion 
if ($numpaginas == 1){
  $pagi_navegacion = "$separador"; 
}else{
  $pagi_navegacion = "$pag_anterior $separador $pag_siguiente"; 
}
// ----------------------------- 
############################################## 
if ($contar_pagi > 0)  
{  
// Si recibimos un valor por la variable $page ejecutamos esta consulta 
    $query = $sql." LIMIT $pagi,$numer_reg"; 
}  
else  
{  
// Si NO recibimos un valor por la variable $page ejecutamos esta consulta 
    $query = $sql." LIMIT 0,$numer_reg"; 
}  
    $result = mysqli_query($conn, $query);  
    $numero_registros = mysqli_num_rows($result);
            while ($row=mysqli_fetch_assoc($result)) {
              ?>
                <tr>
                  <td>
                  <a href="tipoRecurso.php?idModificar=<?php echo $row['id'] ?>&<?php echo $busquedas ?>">
                  	<img src="img/edit.png" height="20">
                  </a> 
                  	<a href="tipoRecurso.php?idEliminar=<?php echo $row['id'] ?><?PHP echo $busquedas?>" onclick="return confirm('Está seguro(a) que desea eliminar?');">
                  		<img src="img/delete.png" height="20">
                  	</a>
                  </td>
                  <td><?php echo utf8_encode($row['nombre']);?></td>                  
                </tr>
              <?php
            }
          ?>
          </table>
          <div style="width: 100%; text-align: right" >Registros: <?=$numero_registros?> de un total de <?=$numero_registros0?></div>
<p align='center'><?=$pagi_navegacion?></p>
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