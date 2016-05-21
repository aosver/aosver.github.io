<div id="sidebar">
<style type="text/css">
  .selectedop:hover{
  transform: scale(1.2);
  transition-duration: 0.2s;
}

  .selectedop{
  transform: scale(1);
  transition-duration: 0.5s ;
}

</style>
<ul class="nav">
        <li><a class="headitem item1" href="">Dashboard</a>
          <ul class="opened">
            <li class="selectedop"><a href="home.php">Inicio</a></li>
            <li class="selectedop"><a href="buscar.php">Buscar recurso</a></li>
            <li class="selectedop"><a href="Sugerencias.php">Sugerir recurso</a></li>
            <li class="selectedop"><a href="editarpersonasFrontal.php?idModificar=<?=$idPersona?>">Actualizar mi información</a></li>
    
  </ul>

 <?php if ($_COOKIE['idUsuario'] == "" and $_COOKIE['usuario'] == ""){ ?>

<div style="width:190px; padding: 5px;">
<form action="signin.php" method="post">
<center>
<img src="img/login.png" height="12"> Ingreso de Usuario<hr>
Usuario: <br>
<input type="text" name="username" class="input-small" style="width: 95%"><br>
Contraseña: <br>
<input type="password" name="password" class="input-small" style="width: 95%"><br>
  <?php if (isset($_GET['error'])): ?>
    <font color="red">Contraseña Incorrecta</font>
  <?php endif ?>
<br>
<input type="hidden" name="signIN" value="Osver Sexy"></input>
<input type="hidden" name="IE"></input>
<input type="submit" value="Ingresar" class="ingresar" style="float: right;">
<a href="registerie.php" style="text-decoration: none; background: none;">
<img src="img/key.png" height="12"> Registrarme
</a>
</center>
</form>

<style type="text/css">
  .ingresar {
  -moz-box-shadow:inset 0px 1px 0px 0px #9acc85;
  -webkit-box-shadow:inset 0px 1px 0px 0px #9acc85;
  box-shadow:inset 0px 1px 0px 0px #9acc85;
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #74ad5a), color-stop(1, #68a54b));
  background:-moz-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
  background:-webkit-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
  background:-o-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
  background:-ms-linear-gradient(top, #74ad5a 5%, #68a54b 100%);
  background:linear-gradient(to bottom, #74ad5a 5%, #68a54b 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#74ad5a', endColorstr='#68a54b',GradientType=0);
  background-color:#74ad5a;
  border:1px solid #3b6e22;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:13px;
  font-weight:bold;
  padding:6px 12px;
  text-decoration:none;
}
.ingresar:hover {
  background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #68a54b), color-stop(1, #74ad5a));
  background:-moz-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
  background:-webkit-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
  background:-o-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
  background:-ms-linear-gradient(top, #68a54b 5%, #74ad5a 100%);
  background:linear-gradient(to bottom, #68a54b 5%, #74ad5a 100%);
  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#68a54b', endColorstr='#74ad5a',GradientType=0);
  background-color:#68a54b;
}
.ingresar:active {
  position:relative;
  top:1px;
}

</style>

<?php } ?>