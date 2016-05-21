<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_GET['idEliminar'])){
  $id = $_GET['idEliminar'];

  $error = 0;
  $sql = "SELECT * FROM treservas WHERE idLibro = $id AND estado = 1 OR estado = 2";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
  if (mysqli_num_rows($query) != 0){
    $error = 1;
    $bError = 'No se puede eliminar el libro porque tiene reservas relacionados a él.';
  }

  $sql = "SELECT * FROM tprestamos WHERE idLibro = $id AND estado = 1";
  $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));
  if (mysqli_num_rows($query) != 0){
    $error = 1;
    $bError = 'No se puede eliminar el libro porque tiene prestamos pendientes relacionados a él.';
  }
  if ($error == 0){
    $sql = "UPDATE tlibros SET estado = 0 WHERE id = $id";
    $query = mysqli_query($conn, $sql)or die(mysqli_error($conn));  
  }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Personas - Programación Alternativa</title>
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

.mostrando {
  text-align: center;
  border-radius: 10px 10px 10px 10px;
-moz-border-radius: 10px 10px 10px 10px;
-webkit-border-radius: 10px 10px 10px 10px;
  border: 1px solid #2BB700;
  padding: 5px;

background: rgba(255,216,77,1);
background: -moz-linear-gradient(top, rgba(255,216,77,1) 0%, rgba(255,202,10,1) 100%);
background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255,216,77,1)), color-stop(100%, rgba(255,202,10,1)));
background: -webkit-linear-gradient(top, rgba(255,216,77,1) 0%, rgba(255,202,10,1) 100%);
background: -o-linear-gradient(top, rgba(255,216,77,1) 0%, rgba(255,202,10,1) 100%);
background: -ms-linear-gradient(top, rgba(255,216,77,1) 0%, rgba(255,202,10,1) 100%);
background: linear-gradient(to bottom, rgba(255,216,77,1) 0%, rgba(255,202,10,1) 100%);
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffd84d', endColorstr='#ffca0a', GradientType=0 );

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
jQuery(document).ready(function() {
  jQuery(".iframe").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    width     : '80%',
  });
});

function mostrarLibro(inscripcion, titulo){
  alert(inscripcion+' -- '+titulo);
  
}
</script>
<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body>
    <form action="" method="get">
    <center>
    Buscar por: <br>
    Identificación: <input type="text" name="bInscripcion" class="input-small" value="<?PHP echo $_GET['bInscripcion']?>">   
    Carné: <input type="text" name="bCarne" class="input-small" value="<?PHP echo $_GET['bCarne']?>"> 
    Nombre: <input type="text" name="bTitulo" class="input-medium" value="<?PHP echo $_GET['bTitulo']?>"> <input type="submit" value="Buscar" name="buscar" class="button">
    </center>
    </form>
    <hr>
    <?php 
    if (isset($_GET['buscar'])){
      if ($_GET['bInscripcion'] != ""){
        $bInscripcion = $_GET['bInscripcion'];
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND identificacion = '$bInscripcion' ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por número de identificación: <b>'.$bInscripcion.'</b> :: <a href="buscarPersona.php">Restablecer</a>';
      }else if ($_GET['bTitulo'] != ""){
        $bTitulo = utf8_decode($_GET['bTitulo']);
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND CONCAT(UPPER(apellidos),' ',UPPER(nombre)) like UPPER('%$bTitulo%') ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por nombre: <b>'.utf8_encode($bTitulo).'</b> :: <a href="buscarPersona.php">Restablecer</a>';
      }else if ($_GET['bCarne'] != 0){
         $bCarne = $_GET['bCarne'];
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND carne = '$bCarne' ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por número de carné: <b>'.$bCarne.'</b> :: <a href="buscarPersona.php">Restablecer</a>';
      }else{
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 ORDER BY apellidos, nombre"; 
        //$bError = "Por favor indique algún criterio de búsqueda.";
      }
    }else{
      $sql = "SELECT * FROM tpersonas WHERE estado = 1 ORDER BY apellidos, nombre";  
    }
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 0){
      //mostramos mensaje: no hay editoriales
      ?>
      <center><br>
        <?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}?>
        <img src="img/info.png"><br>
        No hay personas registradas.
      </center>
      <?php
    }else{
      //mostramos la tabla con las editoriales 
      ?>

        <?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}
        if ($bError != ''){echo '<div class="bError">'.$bError.'</div><hr>';}?>


        <table width="100%" class="tabla">
          <tr>
            <td width="20" class="tabla_titulo"></td>
            <td class="tabla_titulo" width="75">Carné</td> 
            <td class="tabla_titulo" width="150">Identificación</td> 
            <td class="tabla_titulo">Nombre</td>   
          </tr>

<?php  

$busquedas = 'bInscripcion='.$bInscripcion.'&bTipo='.$bTipo.'&bTitulo='.$bTitulo.'&buscar=Buscar&';
$busqueypagi = $busquedas.'&pagi='.$_GET['pagi'];

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
    while ($row = mysqli_fetch_array($result)){ 
      if ($row['tipoPersona'] == 1){
        $tipo = "Estudiante";
      }
      if ($row['tipoPersona'] == 2){
        $tipo = "Funcionario";
      }
      if ($row['tipoPersona'] == 3){
        $tipo = "Particular";
      }
      ?>

            
                <tr>
                  <td>
                  <a href="javascript:void(0);" onclick="parent.mostrarPersona('<?php echo $row['id']?>','<?php echo $row['identificacion']?>','<?php echo $row['carne']?>','<?php echo $row['nombre']?>','<?php echo $row['apellidos']?>','<?php echo $tipo?>','<?php echo $row['direccion']?>','<?php echo $row['telefonoCasa']?>','<?php echo $row['telefonoCelular']?>','<?php echo $row['email']?>')">
                    <img src="img/right.png" height="20">
                  </a> 
                  </td>
                  <td><?php echo $row['carne'];?></td>  
                  <td><?php echo utf8_encode($row['identificacion']);?></td>    
                  <td><?php echo utf8_encode($row['apellidos']);?> <?php echo utf8_encode($row['nombre']);?></td>                  
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

<?php include ("includes/javascript.php");?>
</body>
</html>