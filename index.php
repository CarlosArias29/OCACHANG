<?php
	require_once('../php-console-master/src/PhpConsole/__autoload.php');
?>	


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inicio Sesión</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>

<script>
  $(function() {
    $( "input[type=submit], a, button" )
      .button()
      .click(function( event ) {
      });
  });
</script>

</head>

<body>

<div id="marco">
<form id="form1" name="form1" method="post" action="">

  <div id="login"> 
   
	  <h2>&nbsp;</h2>
	  <h2 id = "login1">Acceso al Sistema</h2>
  </div>


  <?php
	  session_start();
	  $_SESSION['tipo'] = 0;	
  ?>

  	<div id = "entrada">
  		<label class = "log" for="user">Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
  		<input name="user" type="text" id="user" maxlength="10" />
  		<br>
  		<label class = "log" for="pass2">Contraseña:&nbsp;</label>
  		<input class = "pass" name="pass" type="password" id="pass" />
  		<br>
  		<input name="Enviar" type="submit" id="Enviar" value="Entrar" />
  		<br>

  		    <?php 
				include ('utilidades/verificacion.php'); 
				include ('utilidades/seguridad.php'); 
				
				//Verificamos password
				$var=trim(verificaPass());
				

				if(isset($var)){
					//Inicializamos variables
					$msj='Credenciales Inválidas';
					//Almacenamos variables en la sesión
					$_SESSION['tipo'] = $var;
					if(isset($_POST['user'])){
						$_SESSION['usuario'] = $_POST['user'];
						$_SESSION['nombre']= nomUsuario($_POST['user']);
					}
					switch($var){
						case 0:
							echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">
									<p>
										<span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\">
										</span>
										<strong>Advertencia:</strong> Credenciales Inválidas
									</p>
							      </div>"; 
							break;
						case 1;
						case 2:
						case 3:

							seguridad($_POST['user'],$var,'Inicio de sesión');
							header('Location: menu.php');
							break;
						case -3:
							echo "<div class=\"ui-state-error ui-corner-all\" style=\"padding: 0 .7em;\">
									<p style=\"font-size:16px;\">
										<span class=\"ui-icon ui-icon-alert\" style=\"float: left; margin-right: .3em;\">
										</span>
										<strong>Advertencia:</strong> Usuario deshabilitado, contacte al administrador
									</p>
							      </div>"; 
					}
					
				}

  			?>
  	<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em; font-family: "Arial", "Helvetica";">
			</span>Las 'Cookies' deben estar habilitadas en su navegador
		</p>
	</div>
  	</div>



</div>  
</form>

</body>
</html>