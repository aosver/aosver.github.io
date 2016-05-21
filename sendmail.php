<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} ?>


<!DOCTYPE html>
<html>
<head>
  <title>send mail</title>
</head>
<body style="overflow: hidden; height: 150%;">
<link rel="stylesheet" href="css/style_all.css" type="text/css" media="screen">
<?php 
$idPersona = $_GET['idPersona'];
$email = $_GET['email'];

$sql = "SELECT * FROM tajustes WHERE id = 3";
$query = mysqli_query($conn, $sql);
//echo $sql;
while ($row=mysqli_fetch_assoc($query)) {
  $msgx = $row['Dato'];
}

if (isset($_POST['send'])) {
  include 'phpmailer/sjdvhonleas.dll';
   $to_email = $_POST['email'];
   $idPersona = $_POST['idPersona'];
   $message =  $_POST['message'];

   //echo "Se envio un correo a ".$to_email;


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
    ?>
    <font color="white" size="25">
      <center>
      <br><br>
        Mensaje Enviado!
      </center>
    </font>
    <?php

} else { 
  $correoenviado = 1;
  }
  //echo $correoenviado;;
 ?>
<script type="text/javascript">
 window.top.location.href = "prestamo.php?idPersona=<?php echo $idPersona ?>"; 
  javascript:void(0);
</script>
 <?php
  exit();
  } 

   ?>
   <form action="" method="POST">
  <center>
    <textarea style="height: 50px;" name="message" placeholder="Escriba Su Mensaje Aqui.">
    
      <?php echo $msgx ?>
    </textarea><br>
    <input type="hidden" name="idPersona" value="<?php echo $idPersona ?>"></input>
    <input type="hidden" name="email" value="<?php echo $email ?>"></input>
    <input type="submit" name="send" value="Enviar" class="button"></input>
  </center></form>
  <br><br><br>
</body>
</html>