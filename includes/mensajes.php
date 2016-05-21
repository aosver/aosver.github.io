<?php
$mensajes = 20;

$usuario = $_COOKIE['usuario'];
$cant = strlen($usuario);
$w = $cant * 9;
$w = $w + 260;

?>

<table width="80%" border="0" style="height:41px; float: right; ">
  <tr>
    <td>
        <div style="width: <?=$w?>px; height: 20px; float: right; ">Bienvenido <?php echo strtoupper($usuario)?> | <a href="Miperfil.php">Mi perfil</a> | <a href="logout.php">Cerrar Sesión</a><br /><span style="font-size: 10px; text-align: left;"><a href="mensajes.php" style="display: none">Tienes <?php echo $mensajes?> mensajes nuevos.</a></span></div>
    
    <a href="mensajes.php" style="width: 35px; display: none; margin-right: 5px; float: right; height: 32px; background: url(img/unreadmail.png) no-repeat center center;"><span style="font-size: 10px; color: #FFF; float: right; width: 15px; text-align: center; height: 15px;"><?php echo $mensajes?></span>
    </a></td>
  </tr>
</table>
