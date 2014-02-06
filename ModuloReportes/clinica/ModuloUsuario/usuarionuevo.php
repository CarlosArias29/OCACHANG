<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Creación de usuario</title>

<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
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
    



  </table>

  <table width="305" border="0" align="center">
    <tr>
      <td align="center"><input type="button" onclick="MM_goToURL('parent','../menu.php'); return document.MM_returnValue" value="Regresar al menú"></td>
      <td><input name="crear" type="submit" id="crear" value="Agregar" onclick="submit1()"/></td>
    </tr>
  </table>
  </p>
  


<input name="nId" type="hidden" value="0" /></form>




</div> <!-- Del div principal -->
</body>
</html>