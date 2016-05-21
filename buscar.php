<?php include ("conn/conn.php");?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<!--titulo de arriba-->
<title>Buscar</title>
<!--titulo de arriba-->
<style type="text/css">
body {
	padding: 0px;
	margin: 0px;
}

  .selectedopx{
  transform: scale(1);
  background: default;
  transition-duration: 0.5s;

}

  .selectedopx:hover{
  transform: scale(1.02);
  background: lightgrey;
  left: 30px;
  text-decoration-color: white;
  transition-duration: 0.2s;

}

a { text-decoration: none; }

#contenido {
	min-height: 200px;
	padding: 10px;
}

/* -------------------------------------------
	----------------- Osver Objects --------------*/
.slideOne {
	width: 50px;
	height: 10px;
	background: #333;
	margin: 0px auto;

	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;
	position: relative;

	-webkit-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	-moz-box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
	box-shadow: inset 0px 1px 1px rgba(0,0,0,0.5), 0px 1px 0px rgba(255,255,255,0.2);
}

.slideOne label {
	display: block;
	width: 16px;
	height: 16px;

	-webkit-border-radius: 50px;
	-moz-border-radius: 50px;
	border-radius: 50px;

	-webkit-transition: all .4s ease;
	-moz-transition: all .4s ease;
	-o-transition: all .4s ease;
	-ms-transition: all .4s ease;
	transition: all 0.5s ease;
	cursor: pointer;
	position: absolute;
	top: -3px;
	left: -3px;

	-webkit-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	-moz-box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	box-shadow: 0px 2px 5px 0px rgba(0,0,0,0.3);
	background: #fcfff4;

	background: -webkit-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -moz-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -o-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: -ms-linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	background: linear-gradient(top, #fcfff4 0%, #dfe5d7 40%, #b3bead 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fcfff4', endColorstr='#b3bead',GradientType=0 );
}

.slideOne input[type=checkbox]:checked + label {
	left: 37px;}



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
		function AdvanceClick() {
			if (slideOne.checked) {
				advance.style.visibility = "visible"
				//advance.display = "all";
			} else {
				advance.style.visibility = "hidden"
			}
		
		}
	</script>





<style type="text/css">

	
	.rotate180 {
    -webkit-transform: rotate(180deg);
    -moz-transform: rotate(180deg);
    -o-transform: rotate(180deg);
    -ms-transform: rotate(180deg);
    transform: rotate(180deg);
}

.input-medium{
	width: 25em;
	height: 1em;
}
							 

input[type=checkbox] {
	visibility: hidden;
}


</style>

<!--AQUI FINALIZA CSS Y JAVASCRIPT-->

</head>

<body onload="onload()">
<table width="100%" border="0" cellpadding="0" cellspacing="0" name="tabla123" class="tabla_final">
  <tr>
    <td height="48" colspan="2"><img src="img/logo.png" width="150" style="margin-left: 20px;"/><?php include("includes/mensajesFrontal.php");?></td>
  </tr>
  <tr> <td width="204" style="background: #eee;" valign="top"><?php include("includes/sidebarFrontal.php");?></td>
    <td valign="top">
    <div id="titulo"><i>
    <!--titulo de abajo-->
    <font size="5">Buscar</font>
	<!--titulo de abajo-->
    </i></div>
    <div id="contenido">  
	<!--AQUI INICIA EL CONTENIDO-->
	 <a href="buscar.php"> <img src="./img/right.png" style="float:left;" class="rotate180" id="backlink"> </a>
	
	<br> <br>

		<div>

			<?php if (isset($_POST['search'])): 
				$srchTitulo = $_POST['srchTitulo'];
				$srchAutor = $_POST['srchAutor'];
				$srchCategoria = $_POST['srchCategoria'];
				$srchEditorial = $_POST['srchEditorial'];
				$srchInscripcion = $_POST['srchInscripcion'];
				$srchSignatura = $_POST['srchSignatura'];
				$srchISBN = $_POST['srchISBN'];
				//echo "OSVER";



				if (($srchISBN <> "") or ($srchSignatura <> "") or ($srchInscripcion <> "") or ($srchEditorial <> "") or ($srchCategoria <> "") or ($srchAutor <> "") or ($srchTitulo <> "")) {
					$sql = "SELECT *,tcategorias.nombre,tautores.nombre as cAutor,tlibros.id as iddelLibro from tlibros left join tlibrocat on tlibros.id = tlibrocat.idLibro left join tcategorias on tcategorias.id = tlibrocat.idCategoria left join tlibroautor on tlibroautor.idlibro = tlibros.id left join tautores on tautores.id = tlibroautor.idautor Where ";
					if ($srchTitulo <> "") {
						$sql .= " upper(titulo) like upper('%$srchTitulo%') and ";
					};
					if ($srchAutor  <> "") {
						$sql .= "upper(tautores.nombre) like upper('%$srchAutor%') and ";
					};
					if ($srchCategoria  <> "") {
						$sql .= "upper(tcategorias.nombre) = Upper('$srchCategoria') and ";
					};
					if ($srchEditorial  <> "") {
						$sql .= "upper( tlibros.idEditorial ) = upper( '$srchEditorial') and ";
					};
					if ($srchISBN  <> "") {
						$sql .= "tlibros.isbn like '$srchISBN' and ";
					};
					if ($srchInscripcion  <> "") {
						$sql .= "tlibros.inscripcion = '$srchInscripcion' and ";
					};
					if ($srchSignatura  <> "") {
						$sql .= "tlibros.signatura = '$srchSignatura' and ";

					};

					$sql .= " tlibros.estado = 1 group by tlibros.id order by tlibros.titulo";
					$query = mysqli_query($conn, $sql);
					//echo $sql;


				    if (mysqli_num_rows($query) == 0){
				      //mostramos mensaje: no hay libros
				      ?>
				      <center>
				        <img src="img/info.png"><br>
				        <font size="3">No se encontraron resultados. </font> <br> 
				        <font size="4">
				        <a href="Sugerencias.php"> Sugiéralo</a>
				        	
				        </font>

				      </center>
				      <?php
				    }else{
				      //mostramos la tabla con las libros 
				      ?>

				      	<!-- Slide ONE -->
				      	
						</div>
			
						<div>

						<?php if ($userid == ""){?>
						<center><img src="img/info.png"><br>Solamente los usuarios registrados pueden reservar recursos.</center>
						<?php }?>


					        <table width="100%" class="tabla" id="tablaresultado">
					          <tr>
					            <td width="50" class="tabla_titulo"></td>
					            <td class="tabla_titulo"><b>Libros</b></td>  
					            <td class="tabla_titulo"><b>Autor</b></td>
					          </tr>

					          <?php
					            while ($row=mysqli_fetch_assoc($query)) {

					            	$idLibro_Reserva = $row['iddelLibro'];
					            	$sql_Reservado = "Select treservas.idLibro from treservas left join tprestamos on tprestamos.idLibro = treservas.idLibro where ((treservas.estado = 2 and Date_add(treservas.fecha, interval 3 day) > now()) or tprestamos.estado =1 ) and treservas.idLibro = $idLibro_Reserva ";
									$query_Reservado = mysqli_query($conn,$sql_Reservado);
									//echo "Tu ID Es: ".$userid; 
					            	?>

					                <tr class="selectedopx">


					                  <td width="4%"><center>

					                  <?php if ((mysqli_num_rows($query_Reservado) == 0) and ($userid <> "")): 
					                  $reservarlink = "reservar.php?idLibro=".$row['iddelLibro'];
					                  ?>
					                  	<!-- No permitirá realizar la reserva -->
					                  	<a href="reservar.php?idLibro=<?php echo $row['iddelLibro'] ?>" >
					                    <img src="img/Streamline-53-32.png" height="20" title="Reservar">
					                  </a>
					                  <?php else: 
					                  $reservarlink="";
					                  ?>
					                  	<!-- Existen Reservas Activas Pendientes -->
					                  	
					                    <img src="img/Streamline-53-32.png" height="20" style="opacity: 0.25;" title="No está disponible para Reservar." />
					                  <?php endif ; ?>  

					                    </center>
					                  </td>
					                  <td >
					                  
					                  	<?php if ($reservarlink<>""): ?>
					                  			<a href="<?php echo $reservarlink ?>" style:"text-decoration:none">
					                  <font style="text-transform:  lowercase; text-decoration: none"><?php echo $row['titulo'];?></td>
										
					                  </font>
					                  <td><?php echo $row['cAutor'];?></td> 
					                      </a> 
					                  	<?php else: ?>
					                  		   
					                  <font style="text-transform:  lowercase; text-decoration: none"><?php echo $row['titulo'];?></td>
										
					                  </font>
					                  <td><?php echo $row['cAutor'];?></td> 
					                    
					                  	<?php endif ?>

					                   


					                    


					                </tr>
					              <?php } ?>
					          </table>  <!-- Tabla con resltados Basicos -->
				        </div>


				       

				      		<?php } 

				  }else{
							?> 
							<center>
								<font size="22" style="margin-top: 30%">
								Especifique su busquéda.

									<META HTTP-EQUIV="refresh" CONTENT="2">
								</font>
							</center>

							<?php
						}; ?>
			 <?php else: ?><!-- Resultados de Busquedad -->
		</div>

		<div style="padding: 1em; background-position: center;overflow: hidden;" > <!-- BUSCADOR -->
			<center>
			<font size="5" style="opacity: 0.55; height: 1px">
				Buscar
			</font>
			<hr style="opacity: 0.25">
			<br>
			<form action="" method="post">
				<table class="tabla" style="font-size: 18px;margin-bottom: auto;margin-top: auto;margin-left: auto;margin-right: auto;">
					<tr >
						<td>
							Titulo: 
						</td>
						<style type="text/css">

						#lolita{
							transform: scale(1);
  							transition-duration: 0.5s ;
						}

						#lolita:focus{
							-webkit-transition: all .5s ease;-moz-transition: all .5s ease;transition: all .5s ease;
							transform: scale(1.1);
						}

						
						</style>
						<td>
							<input type="text" name="srchTitulo" id="lolita" class="input-medium" autocomplete="off"></input>
						</td>
					</tr>
					<tr>
						<td>
							Autor: 
						</td>
						<td>
							<input type="text" name="srchAutor" id="lolita" class="input-medium" autocomplete="off"></input>
						</td>
					</tr>
					<tr>
						<td>
							Categoria:
						</td>
						<td>
							<input type="text" name="srchCategoria" id="lolita" class="input-medium" autocomplete="off"></input>
						</td>
					</tr>
					<tr>
						<td>
							Editorial:
						</td>
						<td>
							<input type="text" name="srchEditorial" id="lolita" class="input-medium" autocomplete="off"></input>
						</td>
					</tr>
				</table>
				<table>
					<tr>
						
					</tr>
				</table>

				<div id="advance" style="visibility:hidden;">
				<hr style="opacity: 0.25">

					<table class="tabla" style="font-size: 18px;margin-bottom: auto;margin-top: auto;margin-left: auto;margin-right: auto;">
						<tr>
							<td>
								Inscripcion: 
							</td>
							<td>
								<input type="text" name="srchInscripcion" class="input-medium" autocomplete="off"></input>
							</td>
						</tr>
						<tr>
							<td>
								Signatura: 
							</td>
							<td>
								<input type="text" name="srchSignatura" class="input-medium" autocomplete="off"> </input>
							</td>
						</tr>
						<tr>
							<td>
								ISBN: 
							</td>
							<td>
								<input type="text" name="srchISBN" class="input-medium" autocomplete="off"> </input>
							</td>
						</tr>
					</table>	
					<hr style="opacity: 0.25">
				</div>

				<table border="0">	

					<tr>
						<td >
							<font style="font-size: 15px;align-content: left"> Ver Avanzado         &nbsp;&nbsp;</font>
							</td><td>
						<div class="slideOne" style="float:right;">
						  <input type="checkbox" value="None" id="slideOne" name="checkAvanzado" onclick="AdvanceClick()" />
						<label for="slideOne"></label>
						</div>
						</td>
						</tr>
						<tr>
						<td width="5px" style="text-align: right;" colspan="2"> <br >
							<input type="submit" class="button" name="search" value="BUSCAR"></input>
						</td>
					</tr>



				</table>
			</form>
			</center>
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
   <?php include 'includes/scrollingcredits.html'; ?>
</table>

<?php include ("includes/javascript.php") ?>
</body>
</html>