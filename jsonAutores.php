<?php
    include ("conn/conn.php");
    
    //get search term
    $searchTerm = $_GET['term'];
    
    //get matched data from skills table
    $sqlAutores = "SELECT id, nombre FROM tautores WHERE nombre LIKE '%".$searchTerm."%' AND estado = 1 ORDER BY nombre ASC";
    $queryAutores = mysqli_query($conn, $sqlAutores);
    while ($rowAutores = mysqli_fetch_assoc($queryAutores)) {
        $data[] = utf8_encode($rowAutores['nombre']);
    }    

    //return json data
    echo json_encode($data);
?>