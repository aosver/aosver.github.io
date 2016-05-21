<?php include ("conn/conn.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Sugeriencias</title>
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
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajesFrontal.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebarFrontal.php");?></td>
    <td valign="top">
    <div id="titulo"><i>
    <!--titulo de abajo-->
    Sugeriencias
  <!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
  <!--AQUI INICIA EL CONTENIDO-->


<?php if (isset($_POST['sugerir'])):
  $detalle = $_POST['detalle'];
  $sql_Sugeriencia = "INSERT INTO `tsugerencia`(`id`, `fecha`, `detalle`, `estado`) VALUES (null,now(),'$detalle',0)";
  $query_Sugerir = mysqli_query($conn,$sql_Sugeriencia);


 ?>

 <!DOCTYPE html>
 <html>
 <head>
   <title>UISIL - Sugerir</title>
 </head>
 <body>
 <center>
   <h1 style="color: black;">
     Sugeriencia
   </h1>
   <br>
   <h3 style="color: black;">
     Fue Enviada exitosamente.
   </h3>
 </center>
 </body>
 </html>
  
<?php else: ?>
  




<?php   $SQL_Persona = "SELECT * from tpersonas where id = $userid and estado= 1";
  $QUERY_Persona = mysqli_query($conn,$SQL_Persona);
  $Personas = mysqli_fetch_assoc($QUERY_Persona); ?>

<center><h3 style="color: black;">Sugerir Recursos</h3></center>

<center>
<form method="post" action="">
    <table>
      <tr>
        <td colspan="2"> </td>
      </tr>
      <tr>
        <td>
          La UISIL siempre está agregando recursos nuevos a la Biblioteca. Nos gustaría que nos indiques que recurso necesitas en la Biblioteca de la Universidad.<br>
        </td>
      </tr>
      <tr>
        <td>
          <center><textarea name="detalle" style="width: 400px; height: 100px;"></textarea></center>
        </td>
      </tr>
      <tr>
        <td colspan="1" style="text-align: right">
          <center><input type="submit" name="sugerir" class="button" ></input></center>
        </td>
      </tr>
    </table>
    </form>
  
</center>
<?php endif ?>
  <!--AQUI FINALIZA EL CONTENIDO-->
    </div>
    </td>
  </tr>
  <tr>
    <td colspan="2" style="background: #484848; "><div style="width: 230px; height: 22px; background: url(img/logo%20pa.jpg) no-repeat; float: right; padding-top: 3px; padding-left: 15px;">Un proyecto más de<a href="http://programacionalternativa.com" target="_blank"><img src="img/logopa.jpg" width="100" style="float: right;" border="0"/></a></div></td>
  </tr>
   <?php include 'includes/scrollingcredits.html'; ?>
</table>

<?php include ("includes/javascript.php") ?>
</body>
</html>