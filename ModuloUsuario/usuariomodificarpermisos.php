<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modificar permisos de usuario</title>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>


<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>



<script>
  $(function() {
    $( "input[type=submit], input[type=button] " )
      .button()
      .click(function( event ) {
      });
  });
</script>


<script>
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:250,
      modal: true,
      buttons: {        
        "Aceptar": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>

</head>

<body>

<div id="user_activo" >
  <?php 
    date_default_timezone_set('America/El_Salvador');
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//    $tipo=0;
    session_start();
    //Inicializamos los datos traidos de la sesión
    if(isset($_SESSION['tipo'])){
      //Si hay valor
      $tipo = $_SESSION['tipo'];
      echo '<div class="ui-widget" >
              <div class="ui-state-highlight ui-corner-all" style="height:20px; padding: 0.2em;">'.
              '<span style="float: left; font-weight:bold;">'.$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').'</span>'.

              '<p style="margin-right:20px; display:inline;">Bienvenido al sistema :  '.'<strong>'.$_SESSION['nombre'].'</strong>'.'</p>
              </div>
          </div>';
    }
  ?>  
</div>


<form name="form1" method="post" action="">
  <DIV ALIGN=center>  
    <h1 id="reg_user"> Modificar Permisos de Usuarios </h1>
  </DIV>
  <table width="661" border="0" align="center">
    <tr>
      <td width="474" align="center">


        <?php
        //Include
		include ('funciones.php');
		iniciarconexion();
		$var = actualizarusuario();

		if($var == 1){
				$msj='Se actualizo el usuario en el sistema correctamente.';

			}else if($var == 2){
				$msj='No se pudo actualizar en el sistema...';
			}else if($var == 3){
			$msj= 'No existe usuario con ese id...';
		}
		
		if($var==1 || $var==2 || $var==3){
			echo '<div id="dialog-confirm" title="Información"><p>'.$msj.'</p></div>';
		}
		?>

      </div>
      <p>&nbsp;        </p>
      <p>
        <input type="button" onClick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Regresar al menú">
      </p>      <p>&nbsp;</p>
      
      </td>
      <td width="177" align="center" valign="top"><p>&nbsp;</p>
        <p>&nbsp;</p>
        <p class="log">Seleccione </p>
        <p>
          <select name="tipo" class="listado" id="tipo">
            <option value="1">Administrador</option>
            <option value="2">Supervisor</option>
            <option value="3">Encargado de Inventario</option>
          </select>
        </p>
        <p>
          <input type="submit" name="Actualizar" id="Actualizar" value="Actualizar">
        </p>
        <p>

      <p>

      </p></td>
    </tr>
  </table>
  <p>
    <input name="modificado" type="hidden" id="modificado" value="0">
  </p>
</form>
</body>
</html>