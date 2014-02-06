<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sistema de Compras e Inventarios</title>

  <link href="css/style.css" rel="stylesheet" type="text/css" />
  <link href="js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
  <script src="js/jquery-1.9.1.js"></script>
  <script src="js/jquery-ui-1.10.3.custom.js"></script>

  <script type="text/javascript">
    function MM_goToURL() { //v3.0
      var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
      for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
    }
  </script>

  <script>
    $(function() {
      $( "input[type=button]" )
      .button()
      .click(function( event ) {
      });
    });
  </script>



<body>

  <div>  
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

  // *******************************************//
  $_SESSION['contador']=0;
  $_SESSION['idSeleccionado'] = "";
  // *******************************************//
  echo '<div class="ui-widget" >
  <div class="ui-state-highlight ui-corner-all" style="height:20px; padding: 0.2em;">'.
  '<span style="float: left; font-weight:bold;">'.$dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y').'</span>'.

  '<p style="margin-right:20px; display:inline;">Bienvenido al sistema :  '.'<strong>'.$_SESSION['nombre'].'</strong>'.'</p>
  </div>
  </div>';
      }
      ?>  
    </div> <!-- user activo -->
    <h2 id="menu">Sistema de Compras e Inventarios</h2>   

    <form id="form1" name="form1" method="post" action="">

  <?php 
  $tipo=0;
  session_start();
      //Inicializamos los datos traidos de la sesión
  if(isset($_SESSION['tipo'])){
        //Si hay valor
    $tipo = $_SESSION['tipo'];
  }

  include 'utilidades/utilidadMenu.php';
  tipomenu($tipo);
  ?>

  <div id="imagen_1">
    <img src="images/logo.jpg" /> 
  </div>
  <br><br>

  <div id="b_atras"> 
    <input name="atras" type="button" id="atras" onclick="MM_goToURL('parent','index.php');return document.MM_returnValue" value="Salir" />
  </div>
  
    </form>
  </div> <!-- del div principal -->
</body>
</html>