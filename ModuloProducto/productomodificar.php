<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modificación de Información de Productos</title>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>

<script language="javascript">

function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
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
    <h1 id="reg_user">Modificación de Información de Productos</h1>
  </DIV>
  <table width="661" border="0" align="center">
    <tr>
      <td width="474" align="center">

        <p class = 'log'>
          <span class="log">
          <?php
        //Include
		include ('funciones.php');
		iniciarconexion();
		$var =actualizarproducto();
			
		if(isset($var)){
			//Inicializamos variables
	        $msj='';
            if($var == 1){
				$msj='Información de producto actualizado correctamente';
            }else if($var == 2){
	            $msj='No se pudo actualizar al sistema';
            }else if($var == 3){
     	        $msj='mmm';
            }
			if($var == 1 || $var == 2 ){
				echo '<div id="dialog-confirm" title="Información"><p>'.$msj.'</p></div>';
			}
        }
	
			
			
			?>
        </span></p>
        <p>
          <span class="log">
          <input name="idproducto" type="hidden" id="idproducto" value="0">
        </span></p>
      <p>
        <input type="button" onClick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Regresar al menú">
    </p>     
      
      </td>
      <td width="474" align="center"><p><span class="log">Nombre del Producto</span></p>
        <p>
          <input name="nom" type="text" id="nom" maxlength="30" />
        </p>
        <table width="192" border="0" align="center">
          <tr>
            <td width="186" align="center"><input type="submit" name="actualiza" id="actualiza" value="Actualizar" /></td>
          </tr>
          <tr>
            <td width="186" align="center"></td>
          </tr>
        </table>
      <p></p></td>
    </tr>
  </table>
</form>
</body>
</html>