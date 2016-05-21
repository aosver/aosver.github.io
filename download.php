<?php
include ("conn/conn.php");

if ($tipoUsuario == 2){
  echo '<meta content="0;URL=home.php" http-equiv="refresh">';
} 
// Database Connection
 function getfile($table)
		{
			//$table='tusuarios';
		$host="localhost";
		$uname="root";
		$pass="";
		$database = "progra3"; 

		$connection=mysqli_connect($host,$uname,$pass); 


		//or die("Database Connection Failed");
		$selectdb=mysqli_select_db($connection, $database) or die("Database could not be selected"); 
		$result=mysqli_select_db($connection, $database)or die("database cannot be selected <br>");

		// Fetch Record from Database

		$output = "";
		//$table = "tprestamos"; // Enter Your Table Name 
		$sql = mysqli_query($connection,"select * from $table");
		$columns_total = mysqli_num_fields($sql);

		// Get The Field Name

		for ($i = 0; $i < $columns_total; $i++) {
		$heading = mysqli_fetch_field($sql);
		//$output = $output.'* * * '.$heading;
		//$fields .= $heading;
		}

		//exit();

		$output .="\n";

		// Get Records from the table

		while ($row = mysqli_fetch_array($sql)) {
		for ($i = 0; $i < $columns_total; $i++) {
		$output .='"'.$row["$i"].'",';
		}
		$output .="\n";
		}

		// Download the file

		$filename = "myFile.csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);

		return $output;
		exit;
}

	$x = 'BASE DE DATOS BIBLIOTECA';
	$x .= '------------INICIA LIBROS------------'."\n";
	$x .= getfile('tlibros')."\n";
	$x .= '------------FINALIZA LIBROS------------'."\n";


	if ($tipoUsuario==1) {
	$x .= '------------INICIA USUARIOS------------'."\n";
	$x .= 'USUARIOS NO DISPOBIBLES';
	$x .= '------------FINALIZA USUARIOS------------'."\n";
	} else {
	$x .= '------------INICIA USUARIOS------------'."\n";
	$x .= getfile('tusuarios')."\n";
	$x .= '------------FINALIZA USUARIOS------------'."\n";
	}
	



	$x .= '------------INICIA PERSONAS ------------'."\n";
	$x .= getfile('tpersonas')."\n";
	$x .= '------------FINALIZA TPERSONAS ------------'."\n";


	$x .= '------------INICIA AUTORES------------'."\n";
	$x .= getfile('tautores');
	$x .= '------------FINALIZA AUTORES------------'."\n";

	$x .= '------------INICIA CATEGORIAS------------'."\n";
	$x .= getfile('tcategorias')."\n";
	$x .= '------------FINALIZA CATEGORIAS------------'."\n";


	$x .= '------------INICIA EDITORIALES------------'."\n";
	$x .= getfile('teditoriales');
	$x .= '------------FINALIZA EDITORIALES------------'."\n";
	$x .= '------------INICIA LIBRO-AUTOR------------'."\n";
	$x .= getfile('tlibroautor')."\n";
	$x .= '------------FINALIZA LIBRO-AUTOR------------'."\n";

	$x .= '------------INICIA Libro-Categoria------------'."\n";
	$x .= getfile('tlibrocat')."\n";
	$x .= '------------FINALIZA Libro-Categoria------------'."\n";



	$x .= '------------INICIA Prestamos------------'."\n";
	$x .= getfile('tprestamos')."\n";
	$x .= '------------FINALIZA Prestamos------------'."\n";



	$x .= '------------INICIA RENOVACIONES------------'."\n";
	$x .= getfile('trenovaciones')."\n";
	$x .= '------------FINALIZA RENOVACIONES------------'."\n";



	$x .= '------------INICIA SUGERIENCIAS------------'."\n";
	$x .= getfile('tsugeriencias')."\n";
	$x .= '------------FINALIZA SUGERIENCIAS------------'."\n";



	$x .= '------------INICIA RECURSOS------------'."\n";
	$x .= getfile('trecursos')."\n";
	$x .= '------------FINALIZA RECURSOS------------'."\n";
echo $x;



?>