<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Modificar permisos de usuario</title>
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
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
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css">


<script>

  $(function() {
    $( "#fechaIni" ).datepicker({changeMonth: true, changeYear: true  });

    $( "#fechaIni" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
  });
  
  
  $(function() {
    $( "#fechaFin" ).datepicker({changeMonth: true, changeYear: true  });

    $( "#fechaFin" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
  });
</script>


<script>
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:250,
      modal: true,
      buttons: {
        "Salir": function() {
          $( this ).dialog( "close" );
          window.location="http://localhost/dsi115/menu.php";
        },
        "Continuar": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>


<script>
  $(function() {
    $( "input[type=submit], input[type=button] " )
      .button()
      .click(function( event ) {
      });
  });
</script>


<script type="text/javascript">

function submit1(){
	//Combinando  javascrips y php
	var ban=1;
	var valor = document.getElementById("fechaIni").value;
	var valor2 = document.getElementById("fechaFin").value;
	
	if( valor == null || valor.length == 0 || /^\s+$/.test(valor) ) {
		ban=0;
	}
	if( valor2 == null || valor2.length == 0 || /^\s+$/.test(valor) ) {
		ban=0;
	}
	
	if(ban==1){
		document.forms["form1"].submit();
	}
}

</script>




</head>

<body>


<div id="user_activo" >
  <?php 
    date_default_timezone_set('America/El_Salvador');
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $tipo=0;
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
    <h1 id="reg_user"> Control de Acceso de Usuarios </h1>
  </DIV>
  <table width="661" border="0" align="center">
    <tr>
      <td width="474" align="center">

        <?php
        //Include
		include ('funciones.php');
		iniciarconexion();
		$var = controlusuario();
	
		//Actualizar usando javascrips
		?>

      </div>
      <p>&nbsp;        </p>
      <p>
        <input type="button" onClick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Regresar al menú">
      </p>      <p>&nbsp;</p>
      
      </td>
      <td width="177" align="center" valign="top"><p>&nbsp;</p>
        <p class="log"> Seleccione Id Usuario </p>
        <p>
          <select name="idusuario" class="listado" id="idusuario">
          <?php 
			idCombobox();
		  ?>
		  </select>
        </p>
        <p class="log">Fecha de inicio</p>
        <p>
          <label for="fechaini"></label>
        <div class = "fila">
          <span id="sprytextfield1">

          <input name="fechaIni" type="text" class = "fentrada" id="fechaIni" readonly>
        <span class="textfieldRequiredMsg"><br>
        Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span>
        </p>
        </div>
        <p class="log">Fecha Final</p>
        <div class = "fila">
        <p><span id="sprytextfield2">
        
        <input name="fechaFin" type="text" class = "fentrada" id="fechaFin" readonly>
        <span class="textfieldRequiredMsg"><br>
        Se necesita un valor.</span><span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></p>
        </div>
        <p>        
          <input type="button" name="Actualizar" id="Actualizar" value="Consultar" onClick="submit1()">
        </p>
        <p>

      <p>

      </p></td>
    </tr>
  </table>
  <p>
    <input name="userprin" type="hidden" id="userprin" value="0">
  </p>
</form>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, validateOn:["change"]});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, validateOn:["change"]});
</script>
</body>
</html>