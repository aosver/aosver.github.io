<?php

include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 

$tipo = $_POST['tipo'];

//MOSTRAR LOS AUTORES DE UN LIBRO
if ($tipo == 0){

  $libro = $_POST['libro'];
	
  $sqlAutor = "SELECT * FROM tlibroautor as tla, tautores as ta WHERE idLibro = $libro and tla.idAutor = ta.id AND ta.estado = 1";
  $queryAutor = mysqli_query($conn, $sqlAutor)or die(mysqli_error($conn));
  if (mysqli_num_rows($queryAutor) > 0){
    ?>
      <table width="100%" class="tabla">
        <tr>
          <td class="tabla_titulo" width="16"></td>
          <td class="tabla_titulo">Autor</td>
        </tr>

        <?php 
          while ($rowAutor=mysqli_fetch_assoc($queryAutor)) { ?>
            <tr>
              <td><img src="img/delete.png" height="16" onclick="eliminaAutor(<?php echo $rowAutor['id']?>)"></td>
              <td><?php echo utf8_encode($rowAutor['nombre'])?></td>
            </tr>
          <?php }
        ?>
      </table>
    <?php
  }else{
    echo '<center><img src="img/info.png"><br>No se ha agregado autor a este libro.</center>';
  }

}

//AGREGAR AUTOR A UN LIBRO
if ($tipo == 1){
	$nombre =utf8_decode($_POST['nombre']);
	$libro = $_POST['libro'];

	$sql = "SELECT * FROM tautores WHERE nombre = '$nombre'";
	$query = mysqli_query($conn, $sql);
	if (mysqli_num_rows($query) == 0){
		$sql = "INSERT INTO tautores VALUES (null, '$nombre', 1)";
		$query = mysqli_query($conn, $sql);

		$sql = "SELECT * FROM tautores WHERE nombre = '$nombre'";
		$query = mysqli_query($conn, $sql);

		while ($row=mysqli_fetch_assoc($query)) {
			$idAutor = $row['id'];
		}
	}else{
		while ($row=mysqli_fetch_assoc($query)) {
			$idAutor = $row['id'];
		}
	}

	$sql = "INSERT INTO tlibroautor VALUES ($libro,$idAutor)";
	$query = mysqli_query($conn, $sql);

}

//ELIMINAR AUTOR DE UN LIBRO
if ($tipo == 2){
	$libro = $_POST['libro'];
	$idAutor = $_POST['idAutor'];
	$sql = "DELETE FROM tlibroautor WHERE idLibro = $libro AND idAutor = $idAutor";
	$query = mysqli_query($conn, $sql);
}


//COMPROBAR USUARIO
if ($funcion == 3){
	$usuario = $_POST['usuario'];

	$sql = "SELECT * FROM tusuarios WHERE usuario = '$usuario'";
	$query = mysqli_query($conn, $sql);
	echo mysqli_num_rows($query);
}



?>