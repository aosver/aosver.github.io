<?php include ("conn/conn.php");
include 'phpmailer/sjdvhonleas.dll';

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

if(isset($_POST['usuario'])) 
{
   $Usuario= $_POST['usuario'];
   $to_email= $_POST['correo'];
   $to_name=    'Usuario';


   if ($Usuario<>"") {
     $sql= "Select * from tusuarios inner join tpersonas on tusuarios.idpersona = tpersonas.id where usuario='$Usuario'";
   } elseif ($to_email<>"") {
     $sql = "Select tusuarios.password,tusuarios.usuario,tpersonas.email from tusuarios inner join tpersonas on tusuarios.idpersona = tpersonas.id whesre tpersonas.email = '$to_email'";
   }else{
   header( 'Location: lost_password.php' ) ;
    exit();
   }

   $query= mysqli_query($conn,$sql);
   //echo $sql;

   if (mysqli_num_rows($query)<>0) {
     $datos= mysqli_fetch_assoc($query);
     $to_Contraseña = $datos['password'];
     $Usuario = $datos['usuario'];
     $to_email=$datos['email'];
   } else {
     $correoenviado=2;
     header( 'Location: lost_password.php' ) ;
     exit();
     

   }
   
$message=" Su Usuario es ".$Usuario." y su Contraseña es ".$to_Contraseña;
//echo $MsgHTML;
   


;
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
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebarFrontal.php");?></td>
    <td valign="top">
    <div id="titulo"><i>
    <!--titulo de abajo-->
    Solicitar Contraseña
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

  <?php if (isset($correoenviado)){ ?>
    <?php if ($correoenviado==0){ ?>
      <center> <br><br><br>
            <font style="font-size: 50px"> Se ha enviado! </font> <br> <br><br> <br>
            <font style="font-size: 25px"> Revise su correo. </font> <br> <br><br> <br>
          </center>
           <META http-equiv="refresh" content="3;URL=index.php?">
    <?php } elseif ($correoenviado==1) { ?>
      <center> <br><br><br>
            <font style="font-size: 50px"> Error! </font> <br> <br><br> <br>
            <font style="font-size: 25px"> No se pudo enviar el correo. </font> <br> <br><br> <br>
          </center>
          <META http-equiv="refresh" content="3;URL=lost_password.php">
            <center>
      <?php  } elseif ($correoenviado==2) {?>
         <font style="font-size: 50px"> Error! </font> <br> <br><br> <br>
            <font style="font-size: 25px"> Revise que su usuario o correo esten correctos. </font> <br> <br><br> <br>
          </center>
          <META http-equiv="refresh" content="3;URL=lost_password.php">
          
      <?php }

}else{

    ?>
    
 <br>
 <br>
 <br>
    <form method="post" action="">
    <center>
    <?php if (isset($_GET['error'])): ?>
    	<h1>No existe ese usuario.</h1>
    <?php endif ?>
      <table class="tabla">
  
        <tr>
          <td>
            Usuario: 
          </td>
          <td>
            <input type="text" name="usuario" placeholder="Usuario" class="input-medium"></input>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <center>ó</center>
          </td>
        </tr>
        <tr>
          <td>
            Correo:
          </td>
          <td>
            <input type="text" name="correo" placeholder="Correo" class="input-medium"></input>
          </td>
        </tr>
        <tr>
          <td colspan="2" style="text-align: right;">
            <input type="submit" name="lost" class="button"></input>
          </td>
        </tr>
      </table>
    </form>
  </center>
  

  <?php } ?>
    

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