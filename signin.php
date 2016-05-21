<?php  include ("conn/conn.php");

    //Se inicia session
    if (isset($_POST['signIN']) and isset($_POST['password']) and isset($_POST['username'])) {

        $passwordx = $_POST['password'];
        $usernamex = $_POST['username'];

        if ($passwordx=="" and $usernamex=="") {?>
    <meta content="0;URL=index.php?error" http-equiv="refresh"><?php
            }

        $sql="Select * from tusuarios where upper(usuario) like upper('$usernamex') and password='$passwordx' and estado=1 limit 1";
        $query = mysqli_query($conn,$sql);


        $row = mysqli_fetch_assoc($query);
        if ($row['id']<>"") {
            $sessioncode = randomString(40);
            $id_usuario =$row['id'];
            $tipo = $row['tipo'];
            setcookie("usuario",$usernamex, time() + (60*60*24*30));
            setcookie("idUsuario",$id_usuario, time() + (60*60*24*30));
            setcookie("sess",$sessioncode, time() + (60*60*24*30));
            setcookie("tipo",$row['tipo'], time() + (60*60*24*30));
            $sessioncode.= $_SERVER['REMOTE_ADDR'];
            $sqlsession="UPDATE tusuarios SET session = '$sessioncode' where id = $id_usuario";
            $queryDos = mysqli_query($conn,$sqlsession);

            if ($tipo == 1) {
                echo '<script> parent.document.location.href = "reservas.php"; </script>';
            }else{
                echo '<script> parent.document.location.href = "home.php"; </script>';
            }

            ?>
    <?php
        }else{
            if (isset($_POST['IE'])) {?>
    <meta content="0;URL=indexie.php?error" http-equiv="refresh">
    <?php }else{ ?>
    <meta content="0;URL=index.php?error" http-equiv="refresh"><?php }
    exit;
            ?>
    <meta content="0;URL=index.php?error" http-equiv="refresh"><?php } exit();
    }


    //Se registra el usuario
    if (isset($_POST['register']) and isset($_POST['username']) and isset($_POST['rp_email'])) {
        
        if (isset($_POST['btnFun'])) {
            $tipo = 2;
        }else{
            $tipo=1;
        }

        $username = $_POST['username'];
        $password = $_POST['rp_email'];
        $email = $_POST['email'];
        $fName = $_POST['fName'];
        $lName = $_POST['lName'];
        $ced = $_POST['ced'];
        $carne = $_POST['carne'];
        $cTele = $_POST['cTele'];
        $mTele = $_POST['mTele'];
        $dirr = $_POST['dirr'];

        $sqlTres="Select * from tusuarios where upper(usuario) like upper('$username') limit 1";
        $queryTres = mysqli_query($conn,$sqlTres);
        $rowTres="";
        $rowTres = mysqli_fetch_assoc($queryTres);
        

        //se verifica que el usuarui aun no exista
        if ($rowTres['id']=="") {
            
            //se ingresan datos  a tpersonas
        $sql="INSERT INTO `tpersonas` (`id`, `tipoPersona`, `identificacion`, `carne`, `nombre`, `apellidos`, `telefonoCasa`, `telefonoCelular`, `email`, `direccion`, `estado`) VALUES (NULL, $tipo, '$ced', '$carne', '$fName', '$lName', '$cTele', '$mTele', '$email', '$dirr', '1')";
        $query = mysqli_query($conn,$sql);

        $sqlGETIDPERSONA="Select id from tpersonas order by id desc limit 1";
        $queryGETIDPERSONA = mysqli_query($conn,$sqlGETIDPERSONA);
        $varGETIDPERSONAFETCH = mysqli_fetch_assoc($queryGETIDPERSONA);
        $varGETIDPERSONA = $varGETIDPERSONAFETCH['id'];


        //se ingresan datos a tusuarios
        $sqlDos="INSERT INTO `tusuarios` (`id`, `idPersona`, `usuario`, `password`, `tipo`, `estado`) VALUES (NULL, $varGETIDPERSONA, '$username', '$password', '2', '1')";
        $queryDos = mysqli_query($conn,$sqlDos);
        //echo $sql."<br>".$sqlDos."<br>".$tipo;

        //se inicia session

        $passwordx = $password;
        $usernamex = $username;
        $sql="Select * from tusuarios where upper(usuario) like upper('$usernamex') and password='$passwordx' and estado=1 limit 1";
        $query = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($query);
        if ($row['id']<>"") {
            $sessioncode = randomString(40);
            $id_usuario = $row['id'];
            $tipo = $row['tipo'];
            setcookie("usuario",$usernamex, time() + (60*60*24*30));
            setcookie("idUsuario",$id_usuario, time() + (60*60*24*30));
            setcookie("sess",$sessioncode, time() + (60*60*24*30));
            setcookie("tipo",$tipo, time() + (60*60*24*30));
            $sessioncode.= $_SERVER['REMOTE_ADDR'];
            $sqlsession="UPDATE `tusuarios` SET `session` = '$sessioncode' where id = $id_usuario";
            $queryDos = mysqli_query($conn,$sqlsession);

            if ($tipo == 1) {
                echo '<script> parent.document.location.href = "reservas.php"; </script>';
            }else{
                echo '<script> parent.document.location.href = "home.php"; </script>';
            }

            ?>
     <?php
        }else{?>
    <meta content="0;URL=index.php" http-equiv="refresh"><?php }

        }else{?>
    <meta content="0;URL=register.php?errUsuario=null" http-equiv="refresh">
    <?php } exit();

    }

    function randomString($length) {
        $str = "";
        $characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
        $max = count($characters) - 1;
        for ($i = 0; $i < $length; $i++) {
            $rand = mt_rand(0, $max);
            $str .= $characters[$rand];
        }
        return $str;
    }

    ?>