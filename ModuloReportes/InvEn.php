<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Sistema de Compras e Inventarios</title>

  <link href="../css/style.css" rel="stylesheet" type="text/css" />
  <link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
  <script src="../js/jquery-1.9.1.js"></script>
  <script src="../js/jquery-ui-1.10.3.custom.js"></script>

  <script type="text/javascript">
    function MM_goToURL() { //v3.0
      var i, args=MM_goToURL.arguments; document.MM_returnValue = false;
      for (i=0; i<(args.length-1); i+=2) eval(args[i]+".location='"+args[i+1]+"'");
    }
  </script>

  <script>
    $(function() {
      $( "input[type=button], input[type=submit] " )
      .button()
      .click(function( event ) {
      });
    });
  </script>

  <script>
  $(function() {
    $( "#combobox" ).combobox();
    $( "#toggle" ).click(function() {
      $( "#combobox" ).toggle();
    });
  });
</script>

<!-- Limpiar los campos -->
<script type="text/javascript">
function formReset()
{
document.getElementById("insertarOrden").reset();
}
</script>

<script languaje="javascript"> 
function confirmacion(){ 
    $( "#dialog-message" ).dialog({
      modal: true,
      buttons: {
        Ok: function() {
          $( this ).dialog( "close" );
          window.location.reload();
        }
      }
    });
  
} 
</script>

<script>
  $(function() {
    $( "#fecha" ).datepicker({changeMonth: true, changeYear: true  });

    $( "#fecha" ).datepicker( "option", "dateFormat", "dd/mm/yy" );
  });
</script>

</head>

<body>
  
  <!-- Confirmacion de guardado-->

  <div id="dialog-message" title="Guardado con éxito" style="display:none;">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
    <p>Orden de compra guardada con éxito.</p>
</div>
  <!-- Confirmacion de guardado-->

  <div>  
    <div id="user_activo" >
      <?php 
        include ('../ModuloUsuario/funciones.php'); 
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
        </div>';} 
      ?>  

    </div> <!-- user activo -->

    <h2 id="menu">Reporte de Entradas al Inventario</h2>   

  <form id="insertarOrden" name="insertarOrden" method="post" action="crearOrden.php">

      <div id = "div_entrada" >

          <div id = "div_datosOrdenes2">
    <fieldset class='log' style='margin-bottom:20px;'>
            <div id = "div_fechaIni">
              <p>Seleccione la fecha</p>
              <p>
                <label class='log'> Desde: </label>
                <input class = "eOrdenes" name="nlotes" type="date" max=<?php echo '"'.date("Y-m-d").'"';?>/>
              </p>
              <p>
                <label class='log'>Hasta: </label>
                <input class = "eOrdenes" name="prodxlote" type="date" max=<?php echo '"'.date("Y-m-d").'"';?>/>
              </p>
            </div>
    <div id = "div_fechaFin"></div><!--  div_datosOrdenes -->

   </fieldset><!--  div_entrada -->
      <div id="b_atras"> 
        <p>
          <input type="submit" value="Vista Previa" onclick="this.form.action='clinica/invEntradas.php'">
          <input type="submit" value="Imprimir" onclick="this.form.action='clinica/invEntradas - IMP.php'">
        </p>
        <p>
          <input name="botones" type="submit" id="atras"  value="Salir" onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue"/>
        </p>
      </div>
  
   </form>

  </div> <!-- del div principal -->
</body>
</html>


<!-- onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" -->
