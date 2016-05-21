<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if (isset($_GET['idEliminar'])){
  $id = $_GET['idEliminar'];
  $sql = "UPDATE tpersonas set estado=0 WHERE id = $id";
  $query = mysqli_query($conn, $sql) or die(mysqli_error($conn));
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

function mostrarpersonas(identificacion, nombre){
  alert(identificacion+' -- '+nombre);
}
</script>
<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>
<body>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajes.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebar.php");?></td>
    <td valign="top">
    <div id="titulo">
    <!--titulo de abajo-->
    Personas
	<!--titulo de abajo-->
    </div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
    
    <form action="" method="get">
    <center>
    Buscar por: <br>
    Carné: <input type="text" name="bCarne" class="input-small" value="<?PHP echo $_GET['bCarne']?>"> 
    Identificación: <input type="text" name="bIdentificacion" class="input-small" value="<?PHP echo $_GET['bIdentificacion']?>">   
    Nombre: <input type="text" name="bNombre" class="input-medium" value="<?PHP echo $_GET['bNombre']?>"> <input type="submit" value="Buscar" name="buscar" class="button">
    </center>
    </form>
    <hr>
    <?php 
    if (isset($_GET['buscar'])){
      if ($_GET['bIdentificacion'] != ""){
        $bIdentificacion = $_GET['bIdentificacion'];
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND identificacion = '$bIdentificacion' ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por número de identificación: <b>'.$bIdentificacion.'</b> :: <a href="personas.php">Restablecer</a>';
      }else if ($_GET['bNombre'] != ""){
        $bNombre = utf8_decode($_GET['bNombre']);
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND CONCAT(UPPER(apellidos),' ',UPPER(nombre)) like UPPER('%$bNombre%') ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por nombre: <b>'.utf8_encode($bNombre).'</b> :: <a href="personas.php">Restablecer</a>';
      }else if ($_GET['bCarne'] != 0){
         $bCarne = $_GET['bCarne'];
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 AND carne = '$bCarne' ORDER BY apellidos, nombre";  
        $mostrando = 'Mostrando el resultado de la búsqueda por número de carné: <b>'.$bCarne.'</b> :: <a href="personas.php">Restablecer</a>';
      }else{
        $sql = "SELECT * FROM tpersonas WHERE estado = 1 ORDER BY apellidos, nombre"; 
        //$bError = "Por favor indique algún criterio de búsqueda.";
      }
    }else{
      $sql = "SELECT * FROM tpersonas WHERE estado = 1 ORDER BY apellidos, nombre";  
    }
    $query = mysqli_query($conn, $sql);

    if (mysqli_num_rows($query) == 0){
      //mostramos mensaje: no hay personas
      ?>
      <center><br>
        <?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}?>
        <img src="img/info.png"><br>
        No hay personas registradas.
        <br>
        <br>
        <a href="nuevaPersona.php"><img src="img/add.png" height="16px" align="absmiddle"> Agregar nueva persona</a>
      </center>
      <?php
    }else{
      //mostramos la tabla con las personas 
      ?>

        <?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}
        if ($bError != ''){echo '<div class="bError">'.$bError.'</div><hr>';}?>


        <table width="100%" class="tabla">
          <tr>
            <td width="50" class="tabla_titulo"></td>
            <td class="tabla_titulo" width="75">Carné</td> 
            <td class="tabla_titulo" width="150">Identificación</td> 
            <td class="tabla_titulo">Nombre <a href="nuevaPersona.php" style="float: right; color: white; margin-right: 5px;"> <img src="img/add.png" height="16px" align="absmiddle"> Agregar nueva persona</a></td>   
          </tr>

<?php  

$busquedas = 'bIdentificacion='.$bIdentificacion.'&bCarne='.$bCarne.'&bNombre='.$bNombre.'&buscar=Buscar&';
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
    while ($row = mysqli_fetch_array($result)){ ?>
            
                <tr>
                  <td>
                  <a href="editarpersonas.php?<?php echo $busqueypagi?>&idModificar=<?php echo $row['id'] ?>" style="text-decoration: none">
                    <img src="img/edit.png" height="20">
                  </a> 
                    <a href="personas.php?idEliminar=<?php echo $row['id'] ?>" onclick="return confirm('Está seguro(a) que desea eliminar?');">
                      <img src="img/delete.png" height="20" style="text-decoration: none">
                    </a>
                  </td>
                  <td><?php echo $row['carne'];?></td>  
                  <td><?php echo ($row['identificacion']);?></td>    
                  <td><a href="prestamo.php?idPersona=<?php echo $row['id'] ?>"><?php echo ($row['apellidos']);?> <?php echo ($row['nombre']);?></a></td>                  
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
</table>

<?php include ("includes/javascript.php"); ?>
</body>
</html>