<?php include ("conn/conn.php"); 

if (isset($_POST['guardar'])){
  $pass1 = $_POST['pass1'];
  $pass2 = $_POST['pass2'];

  if ($pass1 != ''){
    if ($pass1 != $pass2){
      $bError = "Las contraseñas deben ser iguales.";
    }else{ 
      $sql = "UPDATE tusuarios SET 
      password = '$pass1' 
      WHERE id = $userid";
      $query = mysqli_query($conn, $sql);
      ?>  
      <script type="text/javascript">
        parent.jQuery.fancybox.close('.iframe');
      </script>
      <?php 
      exit();
    }
  }
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Cambiar Contraseña - Programación Alternativa</title>
<!--titulo de arriba-->
<style type="text/css">
body {
	padding: 0px;
	margin: 0px;
  height: 150%;
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
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="screen">
    
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />

<!--AQUI INICIA CSS Y JAVASCRIPT-->

<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body>

<?php if ($tipo <> 0){ ?>
<center><img src="img/error.png"><br>No tienes permiso para esta acción.</center>
<?php }else{ ?>
<center><h3>Cambiar Contraseña</h3></center>
<?php if ($mostrando != ''){echo '<div class="mostrando">'.$mostrando.'</div><hr>';}
        if ($bError != ''){echo '<div class="bError">'.$bError.'</div><hr>';}?>

<form action="" method="post">
  <table>
    <tr>
  <td>Contraseña: </td>
  <td><input type="password" class="input-small" name="pass1" required="required"></td>
</tr>
<tr>
  <td>Repita la contraseña: </td>
  <td><input type="password" class="input-small" name="pass2" required="required"></td>
</tr>
  </table>
  <br>
<center>
<input type="submit" value="Guardar" class="button" name="guardar">
<input type="button" value="Cancelar" class="button" name="cancelar" onclick="parent.jQuery.fancybox.close('.iframe');">
</center>

</form>

<?php } ?>
<style type="text/css">
  html {
    background: none;
  }
</style>
</body>
</html>