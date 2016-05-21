<?php include ("conn/conn.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--titulo de arriba-->
<title>UISIL - Reserva de Libro</title>
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
	function checkUser(value) {
		jquery.post("funcionesAJAX.php", {usuario:value,funcion:0}
		.done(function(data)){
			if (data == 1){
				err = true;
			}else{
				err = false;
			}
		}
	}
</script>

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
    Reserva de libro
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->

  <?php 
  $idLibro = $_GET['idLibro'];
  $SQL_DatosLibro = "SELECT * from tlibros where id= $idLibro and (estado=1 or estado=2)";
  //echo $SQL_DatosLibro;
  $QUERY_DatosLibro = mysqli_query($conn,$SQL_DatosLibro);
  $Libro = mysqli_fetch_assoc($QUERY_DatosLibro);

  $SQL_USUARIO = "Select idPersona from tusuarios where id = $userid";
  $query_USUARIO = mysqli_query($conn,$SQL_USUARIO);
  $res_USUARIO = mysqli_fetch_assoc($query_USUARIO);
  $persona_id = $res_USUARIO['idPersona'];


  $SQL_Persona = "SELECT * from tpersonas where id = $persona_id and estado= 1";
  $QUERY_Persona = mysqli_query($conn,$SQL_Persona);
  $Personas = mysqli_fetch_assoc($QUERY_Persona); ?>

  <br>

    <center>
      <font style="font-size: 22px;opacity: 0.56">
        Solicitud de Reservación
        <hr style="opacity: 0.52"> 
      </font>
    </center>


    <!-- Se revisa si ya se envió la solicitud -->
    <div><!-- Envia la Solicitud. -->
      <?php if (isset($_POST['solicitudEnviada'])): 
      $libroid =$idLibro;
      $resPersonaLibro = $_POST['resPersonaID'];
      $revisarDuplicadoReservas = 
      $sqlInsertReservas = "Insert into treservas (idLibro, idUsuario, estado) values ('$libroid','$resPersonaLibro',1)";
      $queryReservasInsertar = mysqli_query($conn,$sqlInsertReservas);?>
      <!-- TERMINA Se revisa si ya se envió la solicitud -->
        <font style="font-size: 35px">
        <center> <br> <br>
          La solicitud fue enviada exitosamente.
          <META HTTP-EQUIV="/buscar.php" CONTENT="2">
        </center>
        </font>
      </div>
        <?php else: ?>

    <div> <!--// Pide Solicitando-->

        <?php 

        /* Se Se Verifica que tenga todos los datos */
        //echo $SQL_DatosLibro;
        if ($Libro['id']!="" and $Personas['id']!="" and $Personas['email']!="" ) { 
          $idLibro_Reserva = $Libro['id'];
          $sql_Reservado = "Select treservas.idLibro from treservas left join tprestamos on tprestamos.idLibro = treservas.idLibro where ((treservas.estado = 2 and Date_add(treservas.fecha, interval 3 day) > now()) or tprestamos.estado =1 ) and treservas.idLibro = $idLibro_Reserva";
          $query_Reservado = mysqli_query($conn,$sql_Reservado);
          $cant = mysqli_num_rows($query_Reservado);


          /* Se verifica que el libro no este ya Reservado y Que el Usuario tenga autorizacion para realizar la solicitud*/
          if (($cant == 0) and ($userid <> "")) {
            ?> 



              <div><!-- Se permite realizar la Reservacion  -->
                <form method="post" action="">
                <center>
                  <table>
                    <tr>
                      <td style="width: 45em">
                        <font size="4">
                          <p style="text-align: justify;">
                            &nbsp;&nbsp; <b> <?php echo $Personas['nombre'] ?></b>, la solicitud para <b> <?php echo $Libro['titulo'] ?> </b> quedará pendiente de confirmar. Muy pronto se le estará enviando un correo electrónico a <b>(<?php echo $Personas['email'] ?>)</b> con respecto al estado de su reserva. 
                          </p>
                        </font>
                      </td>
                    </tr>
                    <tr>
                      <td style="text-align: right;">
                        <input type="submit" name="solicitudEnviada" class="button" value="Aceptar"></input>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input type="hidden" name="resLibroID" value="<?php echo $Libro['id'] ?>"></input>
                        <input type="hidden" name="resPersonaID" value="<?php echo $userid ?>"></input>
                      </td>
                    </tr>
                  </table>
                </center>
                </form>
                </div> 
            <?php } else { ?>
              <div><!-- No estás autorizado para reservar este libro.  -->
                <center> <br><br><br>
                <font style="font-size: 50px"> ERROR! </font> <br> <br><br> <br>
                <font style="font-size: 25px"> No estás autorizado para reservar este libro. </font> <br> <br><br> <br>
                </center>
                </div>
            <?php } ?>
            

        <?php } else { ?>

          <!-- Faltan Datos, puede ser que falta id del usuario, o su correo, o el id del libro -->  
          <center> <br><br><br>
            <font style="font-size: 50px"> ERROR! </font> <br> <br><br> <br>
            <font style="font-size: 25px"> Faltan datos. </font> <br> <br><br> <br>
          </center>

        <?php } ?>
        </div>
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

<?php include ("includes/javascript.php")?>
</body>
</html>