<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creación de usuario</title>

<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<?php 
	include ('funciones.php');  
	//session_start();
?>
<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
</script>

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
    $( "#fecha" ).datepicker({changeMonth: true, changeYear: true  });

    $( "#fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
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


<script>
function realizaProceso(valorCaja1, valorCaja2){
        var parametros = {
                "valorCaja1" : valorCaja1,
                "valorCaja2" : valorCaja2
        };
        $.ajax({
                data:  parametros,
                url:   'idnuevo.php',
                type:  'post',
                beforeSend: function () {
                        $("#nuevo").html("Generando usuario, espere por favor...");
                },
                success:  function (response) {
                        $("#nuevo").html(response);
                }
        });
}
</script>

<script>
function submit1(){
	var id = document.getElementById("nuevo").innerHTML;
	document.form1.nId.value= id;
	document.forms["form1"].submit();
}
</script>

</head>

<body>

<div>

<div id="user_activo" >
  <?php 
    date_default_timezone_set('America/El_Salvador');
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $tipo=0;
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
  
    <h1 id="reg_user">Registrar  Nuevo Usuario</h1>

  <table width="400" border="0" align="center">
    <tr>
      <td width="100">
        <p class = 'log' >Nuevo Id:</p>
      </td>

      <td width="250">
      <div class = "log"  name="nuevo" id="nuevo"></div>

      </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Nombre:</p></td>
      <td>
        <div class = "fila">
          <span id="sprytextfield3">
            <input class = "fentrada" name="nom" type="text" id="nom" maxlength="30"  onchange="realizaProceso($('#nom').val(), $('#apell').val());return false;" />
            <br> 
            <span class="textfieldRequiredMsg">Campo obligatorio</span>
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Apellido:</p></td>
      <td>
        <div class = "fila">
          <span id="sprytextfield4">
            <input  class = "fentrada" name="apell" type="text" id="apell" maxlength="30" onchange="realizaProceso($('#nom').val(), $('#apell').val());return false;" />
            <br>
            <span class="textfieldRequiredMsg">Campo Obligatorio</span>
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Fecha de nacimiento:</p></td>
      <td>
        <div class = "fila">
          <span  id="sprytextfield1" >
            <input class = "fentrada" type="text" name="fecha" id="fecha"/>
             <span class="textfieldRequiredMsg">Campo Obligatorio</span>
            <span class="textfieldInvalidFormatMsg">Fecha inválida.</span>
            <span class="textfieldMinValueMsg">Fecha inválida.</span>
            <span class="textfieldMaxValueMsg">Fecha inválida.</span> 
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Contraseña:</p></td>
      <td>
        <div class = "fila">
          <span id="sprypassword1">
            <input  class = "fentrada" type="password" name="pass" id="pass" />
            <br>
            <span class="passwordRequiredMsg">Contraseña requerida</span>
            <span class="passwordMinCharsMsg">Contraseña débil</span>
          </span>
        </div>
    </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Confirmar contraseña:</p></td>
      <td>
        <div class = "fila">
          <span id="spryconfirm1">
            <input  class = "fentrada" type="password" name="confirma" id="confirma" />
            <span class="confirmRequiredMsg">La contraseña no coincide</span>
            <span class="confirmInvalidMsg">La contraseña no coincide</span>
          </span>
        </div>
      </td>
    </tr>

    <tr>
      <td>
        <p class = 'log'>Tipo de permisos</p></td>
      <td><select class = 'lista' name="tipo" id="tipo">
        <option value="1" selected="selected">Administrador</option>
        <option value="2">Supervisor</option>
        <option value="3">Encargado de Inventario</option>
      </select></td>
    </tr>
  </table>

  <table width="305" border="0" align="center">
    <tr>
      <td align="center"><input type="button" onclick="MM_goToURL('parent','../menu.php'); return document.MM_returnValue" value="Regresar al menú"></td>
      <td><input name="crear" type="submit" id="crear" value="Agregar" onclick="submit1()"/></td>
    </tr>
  </table>
  </p>
  
<?php 
        
        $var=insertarusuario();
        if(isset($var)){
          //Inicializamos variables
          $msj='';
            if($var == 1){
              $msj='Fue agregado al sistema correctamente';
            }else if($var == 2){
              $msj='No se pudo agregar al sistema';
            }else if($var == 3){
              $msj='Ya existe un usuario con esas credenciales';
            }
			if($var == 1 || $var == 2 || $var == 3 ){
				echo '<div id="dialog-confirm" title="Información"><p>'.$msj.'</p></div>';
			}
        }
?>

<input name="nId" type="hidden" value="0" /></form>



<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", minValue:"01/01/1900", useCharacterMasking:true, validateOn:["change"]});
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {validateOn:["blur", "change"], minChars:4});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "pass", {validateOn:["blur", "change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "none", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "none", {validateOn:["blur"]});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "none", {validateOn:["blur"]});
</script>

</div> <!-- Del div principal -->
</body>
</html>