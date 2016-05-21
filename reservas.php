<?php include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
  exit();
} 


$sql = "UPDATE treservas SET
estado = 4
WHERE DATEDIFF(NOW(),fecha) > 3 AND estado = 2";
$query = mysqli_query($conn, $sql);


if (isset($_GET['idAprobar'])){
  $id = $_GET['idAprobar'];
  $sql = "Select idLibro from treservas where id = $id";
  $query = mysqli_query($conn,$sql);
  $result= mysqli_fetch_assoc($query);
  $idLibro_Reserva = $result['idLibro'];


  $sql="Select treservas.idLibro from treservas left join tprestamos on tprestamos.idLibro = treservas.idLibro where ((treservas.estado = 2 and Date_add(treservas.fecha, interval 3 day) > now()) or tprestamos.estado =1 ) and treservas.idLibro = $idLibro_Reserva";
  $query = mysqli_query($conn,$sql);
  $result = mysqli_num_rows($query);
  if ($result<>0) {
    ?>
    <script type="text/javascript">
    window.location = "reservas.php?";
      alert('El Libro ya se encuentra reservado o prestado. Se debe negar la reserva.');
    </script>
    <?php 
  } else {
   
  


  $fecha = date("Y/m/d");

  $sqlapruebareserva = "UPDATE treservas SET `fecha` = now(), estado = 2 WHERE id = $id";
  $queryapruebareserva = mysqli_query($conn, $sqlapruebareserva); 
   $sql_GETaprobaciondatos="Select tpersonas.email as email ,UPPER(tpersonas.nombre) as nombrex,UPPER(tlibros.titulo)as titulox from treservas inner join tusuarios on tusuarios.id = treservas.idUsuario inner join tpersonas on tpersonas.id = tusuarios.idPersona inner join tlibros on tlibros.id = treservas.idlibro where treservas.id = $id";
  $query_GETaprobaciondatos = mysqli_query($conn,$sql_GETaprobaciondatos);
  $Datos_GETaprobaciondatos = mysqli_fetch_assoc($query_GETaprobaciondatos);


   $to_name= $Datos_GETaprobaciondatos['nombrex'];
   $to_email= $Datos_GETaprobaciondatos['email'];
   $to_libro = $Datos_GETaprobaciondatos['titulox'];
   $from_email= 'uisilbiblioteca@gmail.com';
   $from_password= 'qwerty9876543210';
  

   
$message="<b>'$to_name'</b>, tu reservacion del libro <b> '$to_libro'</b> fue aprobada. Tienes tres dias antes de que se venza ésta reservación.";
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
    $mail->AddAddress($to_email, $to_name); // Where to send it - Recipient
    $result = $mail->Send();    // Send!  
    $message = $result ? 'Successfully Sent!' : 'Sending Failed!';      
  unset($mail);

  if ($message=='Successfully Sent!') { 
    $correoenviado = 0;

} else { 
  $correoenviado = 1;
  }


 echo '<script> parent.document.location.href = "reservas.php"; </script>';
  
}
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>Reservas - Programación Alternativa</title>
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
<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery(".iframe").fancybox({
    openEffect  : 'elastic',
    closeEffect : 'elastic',
    width     : '300',
  });
});

function mostrarLibro(inscripcion, titulo){
  alert(inscripcion+' -- '+titulo);
  
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
    Reservaciones
	<!--titulo de abajo-->
    </div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

<center><h3>Reservaciones pendientes de aprobación</h3></center>

<?php
   $sql = "SELECT tr.id, CONCAT(tp.nombre,' ',tp.apellidos) as persona, tu.usuario, tl.titulo, tr.fecha
FROM tpersonas as tp, tusuarios as tu, treservas as tr, tlibros as tl 
WHERE tr.idUsuario = tu.id AND tu.idPersona = tp.id AND tr.idLibro = tl.id AND tr.estado = 1"; 
   $query = mysqli_query($conn, $sql);

   //echo $sql;

    if(mysqli_num_rows($query) == 0){
      //mostramos mensaje: no hay reservas
      ?>

      <center>
        <img src="img/info.png"><br>
        No hay reservaciones pendientes.
      </center>

      <?php
    }else{
      //mmostramos la tabla con la reserva
      ?>
        <table width="100%" class="tabla">
          <tr>
            <td width = "50" class = "tabla_titulo"></td>
            <td class = "tabla_titulo">Persona</td>
            <td class = "tabla_titulo">Libro</td>
            <td class = "tabla_titulo">Usuario</td>
            <td class = "tabla_titulo">Fecha</td>
          </tr>
          <?php
          while ($row=mysqli_fetch_assoc($query)) {
            ?>
            <tr>
              <td>
                  <a href="reservas.php?idAprobar=<?php echo $row['id']?>">
                  <img src="img/exito.png" height = "19">
                  </a> 
                  <a href="detalleNegacion.php?idEliminar=<?php echo $row['id']?>" class="fancybox fancybox.iframe iframe">
                <img src="img/delete.png" height = "19">
                </a>
              </td>
              <td><?php echo $row['persona']; ?></td>
              <td><?php echo $row['titulo']; ?></td>
              <td><?php echo $row['usuario']; ?></td>
              <td><?php echo $row['fecha']; ?></td>
            </tr>
            <?php
          }
          ?>
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

<?php include ("includes/javascript.php") ?>
</body>
</html>