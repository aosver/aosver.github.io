<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

$id = $_GET['idEliminar'];

if (isset($_POST['denegar'])){
  $id = $_POST['idEliminar'];
  $detalle = $_POST['detalle'];

  $sqleliminareserva = "UPDATE treservas SET `fecha` = DATE_ADD(now() , INTERVAL 3 DAY), estado = 3 WHERE id = $id";
  $queryeliminareserva = mysqli_query($conn, $sqleliminareserva); 

  echo $sqleliminareserva;

  $sql_GETaprobaciondatos="Select tpersonas.email as email ,UPPER(tpersonas.nombre) as nombrex,UPPER(tlibros.titulo)as titulox from treservas inner join tusuarios on tusuarios.id = treservas.idUsuario inner join tpersonas on tpersonas.id = tusuarios.idPersona inner join tlibros on tlibros.id = treservas.idlibro where treservas.id = $id";
  $query_GETaprobaciondatos = mysqli_query($conn,$sql_GETaprobaciondatos);
  $Datos_GETaprobaciondatos = mysqli_fetch_assoc($query_GETaprobaciondatos);


   $to_name= $Datos_GETaprobaciondatos['nombrex'];
   $to_email= $Datos_GETaprobaciondatos['email'];
   $to_libro = $Datos_GETaprobaciondatos['titulox'];
   $from_email= 'uisilbiblioteca@gmail.com';
   $from_password= 'qwerty9876543210';
  

   
$message="<b>'$to_name'</b>, tu reservacion del libro <b> '$to_libro'</b> fue denegada. <br><br> Motivo: <br><br> $detalle";
//echo $MsgHTML;
    require "phpmailer/class.phpmailer.php"; //include phpmailer class
      
    // Instantiate Class  
    $mail = new PHPMailer();  

      
    // Set up SMTP  
    $mail->IsSMTP();                // Sets up a SMTP connection  
    $mail->SMTPAuth = true;         // Connection with the SMTP does require authorization    
    $mail->SMTPSecure = "ssl";      // Connect using a TLS connection  
    $mail->Host = "smtp.gmail.com";  //Gmail SMTP server address
    $mail->Port = 465;  //Gmail SMTP port
    $mail->Encoding = '7bit';
    
    // Authentication  
    $mail->Username   = $from_email; // Your full Gmail address
    $mail->Password   = $from_password; // Your Gmail password
      
    // Compose
    $mail->SetFrom($from_email, 'UISIL');
    //$mail->AddReplyTo($_POST['emailid'], $_POST['fullname']);
    $mail->Subject = "Biblioteca";      // Subject (which isn't required)  
    $mail->MsgHTML($message);
 
    // Send To  
    $mail->AddAddress($to_email, "Recipient Name"); // Where to send it - Recipient
    $result = $mail->Send();    // Send!  
    $message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
  unset($mail);

  if ($message=='Successfully Sent!') { 
    $correoenviado = 0;

} else { 
  $correoenviado = 1;
  }










  ?>
  <script type="text/javascript">
    parent.document.location.href = 'reservas.php';
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
<title>Corredores - Programación Alternativa</title>
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
<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/jquery.wysiwyg.css" type="text/css" media="screen">
    
<script type="text/javascript" src="js/fancybox/source/jquery.fancybox.js"></script>
<link rel="stylesheet" href="js/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />

<!--AQUI INICIA CSS Y JAVASCRIPT-->

<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body>
<form action="" method="post">
<center><h3>Detalle de negación</h3>
<input type="hidden" name="idEliminar" value="<?php echo $id?>">
<textarea name="detalle" style="width: 285px; height: 50px;"></textarea><br><br>
<input type="submit" value="Denegar" name="denegar" class="button"> <a href="javascript: void(0)" onclick="parent.jQuery.fancybox.close('.iframe')">Cancelar</a>
</center>
</form>
<style type="text/css">
html {
  background: none;
}
</div>
</body>
</html>