<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Nuevo Proveedor</title>

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>




<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />



<script>
  $(function() {
    $( "input[type=submit], input[type=button] " )
      .button()
      .click(function( event ) {
      });
  });
</script>



<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
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

<form id="form1" name="form1" method="post" action="">

        <p>
          <?php 

		include ('funciones.php');
		iniciarconexion();
		?>
        </p>
  <p>&nbsp; </p>
  <table width="567" border="0" align="center">
    <tr>
      <td width="561" align="center"><h1 id="reg_user">Agregar Nuevo Proveedor</h1></td>
    </tr>
  </table>
  <table width="476" border="0" align="center">
    <tr>
      <td width="279" class="log">Nuevo Id Proveedor:</td>
      <td width="221"><span id="sprytextfield3">
      <input name="idproveedor" type="text" id="idproveedor" maxlength="10" readonly="readonly" />
      <br />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldMaxCharsMsg">Se ha superado el número máximo de caracteres.</span></span></td>
    </tr>
   
    <tr>
      <td class="log">Nombre de la Empresa:</td>
      <td><span id="sprytextfield4">
      <input name="nom" type="text" id="nom" maxlength="30" />
      <br />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="log">Dirección:</td>
      <td><span id="sprytextfield5">
      <input name="direccion" type="text" id="direccion" maxlength="30" />
      <span class="textfieldRequiredMsg"><br />
      Se necesita un valor.</span></span></td>
    </tr>
    <tr>
      <td class="log">Teléfono:</td>
      <td><span id="sprytextfield2">
      <label for="telefono"></label>
      <input name="telefono" type="text" id="telefono" maxlength="15" />
      <span class="textfieldRequiredMsg">Se necesita un valor.</span><span class="textfieldInvalidFormatMsg"><br />
      Formato no válido.</span></span></td>
    </tr>
    <tr>
      <td class="log">Email:</td>
      <td><span id="sprytextfield1">
      <label>
        <input name="email" type="text" id="email" size="30" maxlength="30" />
      </label>
      <span class="textfieldRequiredMsg"> <br />
Se necesita un valor.</span><span class="textfieldInvalidFormatMsg"><br />
Formato no válido.</span><span class="textfieldMaxCharsMsg"><br />
Se ha superado el número <br />
máximo de caracteres.</span></span></td>
    </tr>
    <tr>
      <td class="log">Descripción:</td>
      <td><span id="sprytextarea1">
      <label for="descripcion"></label>
      <textarea name="descripcion" cols="30" rows="5" id="descripcion"></textarea>
<span class="textareaMaxCharsMsg"> Se ha superado el número máximo de caracteres permitidos.</span></span></td>
    </tr>
  </table>
  
  <table width="278" border="0" align="center">
    <tr>
      <td width="137" align="center"><input type="button" onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Regresar al menú"></td>
      <td width="147" align="center"><input type="submit" name="Agregar" id="Agregar" value="Agregar" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center">
	<?php 
	  		
	$var =insertarproveedor();

	if(isset($var)){
          //Inicializamos variables
          $msj='';
            if($var == 1){
              $msj='Proveedor agregado al sistema correctamente';
            }else if($var == 2){
              $msj='No se pudo agregar al sistema';
            }else if($var == 3){
              $msj='Ya existe un proveedor con esa pk';
            }
			if($var == 1 || $var == 2 || $var == 3 ){
				echo '<div id="dialog-confirm" title="Información"><p>'.$msj.'</p></div>';
			}
        }
	
	
	$nuevoidgenerado=nIdprov();
	
	echo "<script>document.form1.idproveedor.defaultValue=\"$nuevoidgenerado\";</script>";
		
 ?></td>
    </tr>
  </table>
  <p>&nbsp;</p>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email", {hint:"nomcorreo@dominio.com", useCharacterMasking:true, validateOn:["blur", "change"], maxChars:30});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {maxChars:150, validateOn:["blur", "change"], isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "phone_number", {format:"phone_custom", pattern:"(000)0000-0000", validateOn:["blur", "change"], useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur", "change"], maxChars:10});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur", "change"]});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none", {validateOn:["blur", "change"]});
</script>
</body>
</html>