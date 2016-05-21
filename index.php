<?php
  if (isset($_COOKIE['idUsuario']) and isset($_COOKIE['usuario'])) {?>
    <META http-equiv="refresh" content="0;URL=home.php">

  <?php exit();
}


?>
<script type="text/javascript">
   
var isIE = /*@cc_on!@*/false || !!document.documentMode;
    // Edge 20+
var isEdge = !isIE && !!window.StyleMedia;

if (isEdge || isIE) {
  window.location= "indexie.php";
}

</script>


<?php


	$useragent=$_SERVER['HTTP_USER_AGENT'];
	
	if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
		$mobile= 'True';
	} else {
		$mobile= 'False';
	}

	?>
		<?php  if ($mobile=='False'): ?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>UISIL</title>
				<script type="text/javascript" src="js/jquery.js"></script>
		<script>
    var tipox
			$(window).load(function(){
        <?php  if (isset($_GET['error'])): ?>
        document.getElementById('lawawa').style = 'display: none;';
        document.getElementById('elwawo').style = 'display: none;'; 
        document.getElementById('uisilogo').style = 'display: none;';
        document.body.style = "margin: 0;padding: 0; background: linear-gradient(green,white);-webkit-transition: opacity 1s ease-in-out;font-family: 'helvetica neue';letter-spacing: 1px;margin-top: 0%;padding-top: 0%;";
        document.getElementById('login').style = '-webkit-opacity: 1; -webkit-transition-duration: 0.85s;height: 295px;padding-top: 25px;'; 
        <?php  else : ?>
        document.getElementById('lawawa').style = 'opacity: 1; -webkit-transition: all 0.85s ease-in-out;transition: all 0.85s ease-out;height: 200px;-webkit-animation: blinking 10s linear infinite;';
        setTimeout(function () {
          document.getElementById('lawawa').style.opacity = '1';
        },851 )

        <?php  endif  ?>
    });
			function clicka(value) {
      //document.getElementById('uisilogo').style = 'opacity:0;transition-duration: 0.85s;';
      document.getElementById('lawawa').style = '-webkit-opacity: 0; transition-duration: 0.85s;-webkit-animation: blinking 10s linear infinite;';
      setTimeout( function () {
        document.getElementById('uisilogo').style = 'display: none;'
        document.getElementById('lawawa').style = 'display: none;-webkit-animation: blinking 10s linear infinite;'; 
        document.getElementById('elwawo').style = 'display: none;'; 
        document.getElementById('login').style = 'display: flex;opacity: 0'; }, 900)

      setTimeout( function (value) {
        document.body.style = "margin: 0;padding: 0; background: linear-gradient(green,white);-webkit-transition: opacity 1s ease-in-out;font-family: 'helvetica neue';letter-spacing: 1px;margin-top: 0%;padding-top: 0%;";
        document.getElementById('login').style = '-webkit-opacity: 1; -webkit-transition-duration: 0.85s;height: 295px;padding-top: 25px;'; 
        document.getElementById('name').focus();
      }, 950);
      tipox = value;}

      
     function ClickB() {
      var register_link = "<iframe  src='register.php?tipo="+tipox+"' style='border: 0;transform: scale(0.75);position: fixed;top: -100;left:0;right:0;bottom:0;width:100%;height: 134%;overflow: hidden;'></iframe>";
     // var d = document.getElementById('login');
     // d.className = "bouncex";
       document.body.innerHTML = register_link;



    }

    function comprobarUsuario(valuex){
	   if (valuex != ""){
		jQuery.post("funcionesAJAX.php", {usuario:valuex, funcion:0})
		.done(function (data){
			if (data == 1){
				alert('Ya existe ese usuario.')
			}else{
				//alert('Aun no Existe Usuario');

			}
		});
	}
}
		</script>
		<style type="text/css">



  body {
  height: 98.5vh;
  width: 100% ;
  background:  linear-gradient(white,green);
  margin-top: 5%;
  overflow: hidden;
}
.card-container{
  perspective: 900px;
  margin-right: 20px;
}

@-webkit-keyframes blinking{
  0% {opacity: 1}
  45% {opacity: 1}
  50% {opacity: 0.65}
  55% {opacity: 1}
  100% {opacity: 1}


}

.mainclass{
  height: 150px;
  width: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
  opacity: 0;
}
.card{
  position: relative;
  align-content: center;
  width: 150px;
  height: 150px;
  transition: all 0.6s;
  transform-style: preserve-3d;
}
.front,.back{
  position: absolute;
  background: #7FC6A4;
  top: 0;
  left: 0;
  width: 150px;
  height: 150px;
  border-radius: 5px;
  color: white;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
  backface-visibility: hidden;
}
.front{
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 30px;
}
.back{
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
}
.card-container:hover .card {
  transform: rotateY(180deg)scale(1.1)translateY(-25px);
  transition-duration: 0.75s;
}
.mainclass:hover .card-container:not(:hover){
  opacity: 0.25;
  transition-duration: 1s;
}
.back{
  transform: rotateY(180deg) ;
}
.mainclass.permahover {
  opacity: 0;
  transition-duration: 0.5s;
}
input {
  font-size: inherit;
  margin: 0;
  padding: 0;
}
/* ---------- END CARDS --------*/
</style>
      </head>
      <body>
      <style type="text/css">
  /* ----------- Start desktop login ------*/
/* entypo */
[class*="entypo-"]:before {
  font-family: 'entypo', sans-serif;
}

@keyframes sunmovment{
	0%{-webkit-box-shadow:-23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  -moz-box-shadow: -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  box-shadow:  -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);}
  50%{-webkit-box-shadow:23px 39px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  -moz-box-shadow: 23px 39px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  box-shadow:  23px 39px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);}
  100%{-webkit-box-shadow:-23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  -moz-box-shadow: -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  box-shadow:  -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);}
}

#login {
  align-self: top;
  transform: rotateX(150deg);
  width: 370px;
  height: 280px;
  background: rgba(255,255,255,0.2);
  margin: auto;
  margin-top: 100px;
  padding-top: 30px;
  border-radius: 5px;
  border: 1px solid rgba(255,255,255,0.4);
  -webkit-box-shadow:-23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  -moz-box-shadow: -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  box-shadow:  -23px 25px 26px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;

}
#login:after {
  content:'';
  display: block;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  width: 80px;
  height: 7px;
  margin: 25px auto 38px auto;
  background: rgba(0,0,0,.2);
  border: 1px solid rgba(255,255,255,0.4);
  border-radius:4px;
}
#login:before {
  content:'';
  display: block;
  position: absolute;
  left: 0;
  right: 0;
  margin: auto;
  top: -91%;
  width: 54px;
  height: 297px;
  -webkit-box-shadow: inset 0px -5px 5px rgba(0,0,0,0.25);
  -moz-box-shadow: inset 0px -5px 5px rgba(0,0,0,0.25);
  box-shadow: inset 0px -5px 5px rgba(0,0,0,0.25);
  background-color: #dfdfdf;
  background-image: url(data:image/png;base64,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);
  background-repeat:repeat-y;
  z-index: 999;
}
h2 {
  position: relative;
  text-align: center;
  text-transform: uppercase;
  text-shadow: 1px 1px 2px rgba(0,0,0,0.15);
  color: #fff;
  font-size: 24px;
  margin-bottom: 22px;
  font-family: sans-serif;
}
#login form {
  width: 285px;
  margin: auto;
}
.input {
  width: 100%;
  height: 38px;
  line-height: 36px;
  padding: 0px 9px;
  margin-bottom: 10px;
  border-radius:5px;
  border: 1px solid rgba(242,242,242,0.3);
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-box-shadow: inset 0px 0px 8px rgba(0,0,0,.2);
  -moz-box-shadow: inset 0px 0px 8px rgba(0,0,0,.2);
  box-shadow: inset 0px 0px 8px rgba(0,0,0,.2);
}
.input label {
  color: #fff;
  display: inline-block;
  text-align: center;
  width: 20px;
}
.input input {
  -webkit-appearance: none;
  -moz-appearance: none;
  appearance: none;
  background: none;
  border:none;
  width: 235px;
  outline:none;
  color: #fff;
  font-size:12px;
  font-weight: 100;
  letter-spacing: 1px;
}
::-webkit-input-placeholder { /* WebKit browsers */
    color:    #fff;
}
:-moz-placeholder { /* Mozilla Firefox 4 to 18 */
    color:    #fff;
}
::-moz-placeholder { /* Mozilla Firefox 19+ */
    color:    #fff;
}
:-ms-input-placeholder { /* Internet Explorer 10+ */
    color:    #fff;
}
input[type="submit"]{
  display: block;
  width: 100%;
  height: 38px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background: orange;
  border-radius:5px;
  border:1px solid #73a84c;
  outline:none;
  cursor: pointer;
  color: #fff;
  font-size: 14px;
  box-shadow:  inset 1px 1px 0px #c8e5b3, 1px 2px 1px rgba(0,0,0,.09);
  box-shadow:  1px 5px 10px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);

}
input[type="submit"]:hover {
   box-shadow:  inset 1px 1px 2px #333;
   transform: scale(1.05);
   transition-duration: 0.5s;
}
input[type="button"]:hover {
   box-shadow:  inset 1px 1px 2px #333;
   transform: scale(1.05);
   transition-duration: 0.5s;
}
input[type="button"]:active {
   background: darkorange;
   transform: scale(1.15);
   transition-duration: 0.1s;
}
input[type="submit"]:active {
   background: darkorange;
   transform: scale(1.15);
   transition-duration: 0.1s;;
}

.forgot:hover{
	transform: scale(1.15);
   transition-duration: 0.5s;
}



@-webkit-keyframes rightThenLeft {
    0%   {transform: scale(1)}
    25%  {transform: scale(1.25)}
    50%  {transform: scale(1.1)}
    75%  {transform: scale(1.2)}
    100%  {transform: scale(1.0)}
}

input[type="button"]{
  display: block;
  width: 100%;
  height: 38px;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  background: orange;
  border-radius:5px;
  border:1px solid #73a84c;
  outline:none;
  cursor: pointer;
  color: #fff;
  font-size: 14px;
  box-shadow:  inset 1px 1px 0px #c8e5b3, 1px 2px 1px rgba(0,0,0,.09);
  box-shadow:  1px 5px 10px rgba(0,0,0,0.2), inset -10px -0px 15px rgba(255,255,255,0.25),inset 05px -5px 15px rgba(255,255,255,0.25);
}

h1 {
  margin-top: 50px;
  color: #fff;
  text-align: center;
  font-weight: 200;
}
h1 a { 
  color: #ea4c89;
  text-decoration: none;
}
.animated {
  animation-duration: 1500ms;
  animation-fill-mode: forwards;
  animation-iteration-count: 1;   
}
.bounce {
  animation-name: bounce;
  -webkit-transform-origin: top center;
  -ms-transform-origin: top center;
  transform-origin: top center;
}


@keyframes bounce {
  0% {
    -webkit-transform: rotate(15deg) translateY(-250px) translateX(-50px);
    -ms-transform: rotate(15deg) translateY(-250px) translateX(-50px);
    transform: rotate(15deg) translateY(-250px) translateX(-50px);
  }
  25% {
    -webkit-transform: rotate(-10deg) translateY(0px) translateX(10px);
    -ms-transform: rotate(-10deg) translateY(0px) translateX(10px);
    transform: rotate(-10deg) translateY(0px) translateX(10px);
  }
  50% {
    -webkit-transform: rotate(5deg) translateY(-10px) translateX(0);
    -ms-transform: rotate(5deg) translateY(-10px) translateX(0);
    transform: rotate(5deg) translateY(-10px) translateX(0);
  }
  75% {
    -webkit-transform: rotate(0deg) translateY(0);
    -ms-transform: rotate(0deg) translateY(0);
    transform: rotate(0deg) translateY(0);
  }
  100% {
    -webkit-transform: rotate(0deg) translateY(0);
    -ms-transform: rotate(0deg) translateY(0);
    transform: rotate(0deg) translateY(0);
  }
}



/* ------------ END DESKTOP LOGIN -------*/
</style>
<body>
	<div style="display: flex;
  align-items: center; 
  justify-content: center;
font-family: Tahoma; padding-left: 2%; padding-top: 0%;">
		<img src="./img/uisil.png" id="uisilogo" style="width: 500px; height: auto;">
	</div>
	<div id="elwawo" style="display: flex;
  align-items: center; 
  justify-content: center;
font-family: Tahoma; padding-top: 12%;">	
		<divx class="mainclass" id="lawawa" style='opacity: 0;'>
    <span onclick="<?php $tipo=1 ?>">
		<div class="card-container" onclick="clicka(1)">
		  <div class="card" class="hide">
		    <div class="front" style="background: #0f864d">
		      <img src="./img/Estudiantes.png" style="width: 75px;height: 75px; ">
		    </div>
		    <div class="back" style="background: #0f864d">Estudiante</div>
		  </div>
		</div>
    </span>
    <span onclick="<?php $tipo="" ?>">
		<div class="card-container" onclick="clicka(2)">
		  <div class="card" class="hide" >
		    <div class="front"  style="background: #ff6600">
		      <img src="./img/Funcionarios.png" style="width: 75px;height: 75px; ">
		    </div>
		    <div class="back" style="background: #ff6600">Funcionario</div>
		  </div>
		</div>
    </span>
    <span>
		<a href="home.php">
		<div class="card-container">
		  <div class="card" class="hide">
		    <div class="front" style="background: #0f864d">
		      <img src="./img/Invitados.png" style="width: 75px;height: 75px; ">
		    </div>
		    <div class="back" style="background: #0f864d">Invitado</div>
		  </div>
		</div>
		</divx></a></div>	</span>
		<form method="post" action="signin.php" autocomplete="off">
		<div id="login" class="animated bounce" style="display: none;padding-top: 0%; padding-bottom: 20px">
			  
			  <?php if (isset($_GET['error'])): ?>
			  	<h2 style="font-size: 25px;-webkit-animation: rightThenLeft 1s linear 3;">ERROR</h2>
			  <?php else: ?>
			  	<h2 style="font-size: 15px;padding-bottom: 10px;">Iniciar Sessión </h2>
			  <?php endif ?>

			  <form action="#">
			    <div class="input">
			      <label for="name" class="entypo-user"></label>
			      <input type="text" name="username" id="name" placeholder="Usuario" />
			    </div>
			    <div class="input">
			      <label for="name" class="entypo-lock"></label>
			      <input type="password" name="password" id="pw" placeholder="Contraseña" />
			    </div>
			      <input type="submit" value="Iniciar" />
            <input type="hidden" value="Hakuna Matata" name="signIN"></input>
			  	<input type="button" value="Registrarse" onClick="ClickB()"/>
			  	<a href="lost_password.php"><center> <div class="forgot">Olvido su contraseña?</div> </center> </a>
	
	
			  </form>  
			 

			</div>
      <input type="hidden" name="loginx" value="Hello World"></input>
		</form>
			</body>
			</html>
		<?php  else : ?>

<html><head>
  <title>osver</title>

<style type="text/css">
  body {
  height: 98.5vh;
  width: 99%;
  background:  linear-gradient(white,green);
  
}


input {
  font-size: inherit;
  margin: 0;
  padding: 0;
}
/* ---------- END CARDS --------*/



</style>



 <!--- PÁGINA MOVIL -->
  <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <style type="text/css"> body{display: table-row;} </style>
  <style type="text/css">
  /* ---------- MOBILE LOGIN ---------- */

#login {
  margin: 10px auto;
  width: 242px;
}

#login span {
  color: #676767;
  display: block;
  height: 48px;
  line-height: 48px;
  position: absolute;
  text-align: center;
  width: 36px;
}

#login input {
  border: none;
  height: 48px;
  outline: none;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

#login input[type="text"] {
  background: #dedede;
  border-top: 1px solid #000;
  border-right: 1px solid #000;
  border-left: 1px solid #000;
  border-radius: 5px 5px 0 0;
  color: #363636;
  padding-left: 36px;
  width: 242px;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

#login input[type="password"] {
  background-color: #dedede;
  border-top: 1px solid #828282;
  border-right: 1px solid #000;
  border-bottom: 1px solid #000;
  border-left: 1px solid #000;
  border-radius: 0 0 5px 5px;
  color: #363636;
  margin-bottom: 20px;
  padding-left: 36px;
  width: 242px;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

#login input[type="submit"] {
  background: darkgreen;
  border: 1px solid #391515;
  border-radius: 5px;
  color: #fff;
  font-weight: bold;
  line-height: 48px;
  text-align: center;
  text-transform: uppercase;
  width: 242px;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

#login input[type="submit"]:hover {
  background: green;
}

#login input[type="button"] {
  background: darkgreen;
  border: 1px solid #391515;
  border-radius: 5px;
  color: #fff;
  font-weight: bold;
  line-height: 48px;
  text-align: center;
  text-transform: uppercase;
  width: 242px;
  box-shadow: 0 27px 55px 0 rgba(0, 0, 0, 0.3), 0 17px 17px 0 rgba(0, 0, 0, 0.15);
}

#login input[type="button"]:hover {
  background: green;
}


 */
/* ----------- END LOGIN -----------*/</style>
  
  <center><img src=".//img/uisil.png" style="width: 65%; height: auto;margin-top: 10%; align-self: center;padding-left: 12%;">  </center>
  <form method="post" action="signin.php" autocomplete="off">
  <div id="login">
    
      <!-- <form method="post" name="loginform"> -->
      <span ></span><input type="text" id="idusername" name="username" required="" placeholder="Username"  onfocus="this.value=''"> <!-- JS because of IE support; better: placeholder="Username" -->
      <span ></span><input type="password" id="idpsasword" name="password" required="" placeholder="•••••••••" onfocus="this.value='' "> <!-- JS because of IE support; better: placeholder="Password" -->
      <input type="hidden" name="signIN" value="Hakuna Matata"></input>
      <input type="submit" name="loginx" value="Login">
      <a href="home.php">
      <input type="button" style="margin-top: 10px" value="Invitado" style="padding-bottom: 100px;"></a>
      <a href="Register.php">
      <input type="button" style="margin-top: 10px" value="Registrarse" style="padding-bottom: 100px;"></a>
      <a href="lost_password.php">
      <input type="button" style="margin-top: 10px" value="¿Olvidó su contraseña? " style="padding-bottom: 100px;"></a>
    <!-- </form>-->
    </div>
    </form>
  

  


</body></html>
		<?php  endif  ?>