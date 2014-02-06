<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modificar Información de Proveedores</title>

<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
<script src="../js/jquery-1.9.1.js"></script>
<script src="../js/jquery-ui-1.10.3.custom.js"></script>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="../SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
function MM_goToURL() { //v3.0
  var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
  for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
}
function MM_validateForm() { //v4.0
  if (document.getElementById){
    var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
    for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=document.getElementById(args[i]);
      if (val) { nm=val.name; if ((val=val.value)!="") {
        if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
          if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
        } else if (test!='R') { num = parseFloat(val);
          if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
          if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
      } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
    } if (errors) alert('The following error(s) occurred:\n'+errors);
    document.MM_returnValue = (errors == '');
} }
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
    <h1 id="reg_user"> Modificar Información de Proveedores</h1>
  </DIV>
  <table width="695" border="0" align="center">
    <tr>
      <td width="341" align="center">

        <?php
		
		include ('funciones.php');
		iniciarconexion();
		$var = actualizarproveedor();
		
		$msj='';
            if($var == 1){
              $msj='Información de proveedor actualizado correctamente';
            }else if($var == 2){
              $msj='No se pudo actualizar en el sistema';
            }
			if($var == 1 || $var == 2 ){
				echo '<div id="dialog-confirm" title="Información"><p>'.$msj.'</p></div>';
			}
			mostrarusuario();
		?>


      <p>&nbsp;        </p>
      <p>
        <input type="button" onClick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Regresar al menú">
      </p>      <p>&nbsp;</p>
      
      </td>
      <td width="344" align="center" ><table width="344" height="396" border="0" align="center">
          
          <tr>
            <td align="center" class="log">Nombre de la Empresa:</td>
          </tr>
          <tr>
          
            <td align="center"><input name="nom" type="text" id="nom" maxlength="30" /></td>
          </tr>
          <tr>
          
            <td align="center" class="log">Dirección:</td>
          </tr>
          <tr>
          
            <td align="center"><label>
              <input name="direccion" type="text" id="direccion" maxlength="30" />
            </label></td>
          </tr>
          <tr>
          
            <td align="center" class="log">Teléfono:</td>
          </tr>
          <tr>
          <td align="center"><span id="sprytextfield1">
          <input name="tel" type="text" id="tel" maxlength="14">
          <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          </tr>
          <tr>
          
            <td align="center" class="log">Email:</td>
          </tr>
          <tr>   
          </tr>
          <tr>
            <td align="center"><span id="emailSpy">
            <label for="email"></label>
            <input name="email" type="text" id="email" maxlength="30">
            <span class="textfieldInvalidFormatMsg">Formato incorrec</span></span></td>
          </tr>
          <tr>
            <td align="center" class="log">Descripción:</td>
          </tr>
          <tr>
            <th><span id="sprytextarea1">
            <textarea name="descripcion" id="descripcion" cols="45" rows="5" ></textarea>
            <span id="countsprytextarea1">&nbsp;</span><span class="textareaMaxCharsMsg">Se ha superado el número máximo de caracteres permitidos.</span></span></th>
          </tr>
        </table>
        <p>&nbsp;</p>
        <p>
          <input type="submit" name="Actualizar" id="Actualizar" value="Actualizar">
        </p>
        <p>

      <p>

      </p></td>
    </tr>
  </table>
  <p>
    <input name="idproveedor" type="hidden" id="idproveedor" value="0">
  </p>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "phone_number", {validateOn:["change"], format:"phone_custom", pattern:"(000)0000-0000", isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("emailSpy", "email", {validateOn:["blur", "change"], useCharacterMasking:true, isRequired:false});
var sprytextarea1 = new Spry.Widget.ValidationTextarea("sprytextarea1", {maxChars:150, validateOn:["blur", "change"], counterId:"countsprytextarea1", isRequired:false});
</script>
</body>
</html>