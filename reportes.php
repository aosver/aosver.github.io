<?php include ("conn/conn.php"); 

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Reportes - Programación Alternativa</title>
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
    Reportes
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
  <?php $ffin = date("m/d/Y"); ?>
    <center><h3>Reportes</h3></center>
<?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}
        if ($bError != ''){echo '<div class="bError">'.$bError.'</div><hr>';}?>

<script>
  jQuery(function() {
    jQuery( "#tabs" ).tabs().addClass( "ui-tabs-vertical ui-helper-clearfix" );
    jQuery( "#tabs li" ).removeClass( "ui-corner-top" ).addClass( "ui-corner-left" );
  });
  </script>
  <style>
  .ui-tabs-vertical { width: 100%; }
  .ui-tabs-vertical .ui-tabs-nav { padding: .2em .1em .2em .2em; float: left; width: 170px; }
  .ui-tabs-vertical .ui-tabs-nav li { clear: left; width: 100%; border-bottom-width: 1px !important; border-right-width: 0 !important; margin: 0 -1px .2em 0; }
  .ui-tabs-vertical .ui-tabs-nav li a { display:block; width: 145px}
  .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active { padding-bottom: 0; padding-right: .1em; border-right-width: 1px; }
  .ui-tabs-vertical .ui-tabs-panel { padding: 0px; float: right; width: 75%}
  </style>

<div id="tabs">
  <ul>
    <li><a href="#tabs-1">Préstamos</a></li>
    <li><a href="#tabs-2">Préstamos pendientes</a></li>
    <li><a href="#tabs-3">Ingresos por multa</a></li>
    <li><a href="#tabs-4">Libros más prestados</a></li>
    <li><a href="#tabs-5">Sugerencias</a></li>
  </ul>
  <div id="tabs-1">
    <p>

<form action="reportes/Prestamos.php" method="get" target="reporte">
<b>Préstamos realizados</b><hr>
<center>
  FILTRAR POR FECHAS<br><br>
  Fecha inicial: <input type="date" class="input-small" name="fini" value="<?php echo $fini?>" required="required" style="width: 135px;"> 
  <?php $datetime = new DateTime('tomorrow');?>
  Fecha final: <input type="date" class="input-small" name="ffin"  value="<?php echo $datetime->format('Y-m-d'); ?>" required="required" style="width: 135px;"> 

  <input type="submit" class="button" value="Generar"> 
</center>
</form>

</p>

  </div>
  
  <div id="tabs-2">
    <p>
      
<form action="reportes/Pendientes.php" method="get" target="reporte">
<b>Préstamos pendientes de entrega</b><hr>

<center>
  FILTRAR POR FECHAS<br><br>
  Fecha inicial: <input type="date" class="input-small" name="fini" value="<?php echo $fini?>" required="required"> 
  Fecha final: <input type="date" class="input-small" name="ffin" value="<?php echo $ffin?>" required="required"> 

  <input type="submit" class="button" value="Generar"> 
</center>

</form>

    </p>
  </div>


  <div id="tabs-3">
    <p>
      
<form action="reportes/Ingresos.php" method="get" target="reporte">
<b>Ingresos por Multa</b><hr>
<center>
FILTRAR POR FECHAS<br><br>
Fecha inicial: <input type="date" class="input-small" name="fini" value="<?php echo $fini?>" required="required"> 
Fecha final: <input type="date" class="input-small" name="ffin" value="<?php echo $ffin?>" required="required"> 

<input type="submit" class="button" value="Generar"> 
</center>
</form>

    </p>
  </div>


  <div id="tabs-4">
    <p>

<form action="reportes/Lmasprestado.php" method="get" target="reporte">
<b>Libros más prestados</b><hr>
<center>
FILTRAR POR FECHAS<br><br>
Fecha inicial: <input type="date" class="input-small" name="fini" value="<?php echo $fini?>" required="required"> 
Fecha final: <input type="date" class="input-small" name="ffin" value="<?php echo $ffin?>" required="required"> 

<input type="submit" class="button" value="Generar"> 
</center>
</form>


    </p>
  </div>


  <div id="tabs-5">
    <p>
 
<form action="reportes/Rsugerencia.php" method="get" target="reporte">
<b>Sugerencias</b><hr>
<center>
FILTRAR POR FECHAS<br><br>
Fecha inicial: <input type="date" class="input-small" name="fini" value="<?php echo $fini?>" required="required"> 
Fecha final: <input type="date" class="input-small" name="ffin" value="<?php echo $ffin?>" required="required"> 

<input type="submit" class="button" value="Generar"> 
</center>
</form>

  </p>
  </div>


  
</div>

	<!--AQUI FINALIZA EL CONTENIDO-->
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="background: #484848; "><div style="width: 230px; height: 22px; background: url(img/logo%20pa.jpg) no-repeat; float: right; padding-top: 3px; padding-left: 15px;">Con la tecnología de <img src="img/logopa.jpg" width="100" style="float: right;" border="0"/></div></td>
  </tr>
</table>
<iframe src="" name="reporte" style="display: none;"></iframe>
<?php include ("includes/javascript.php")?>
</body>
</html>