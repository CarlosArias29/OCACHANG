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

	  <h2 id="menu">Creación de Orden de Compra</h2>   

  <form id="insertarOrden" name="insertarOrden" method="post" action="crearOrden.php">

      <div id = "div_entrada" >
          <div id = "div_datos">
            <div id = "div_ordenes" >
               <?php 
                  include ('../ModuloUsuario/funciones.php'); 
                  if(iniciarconexion()==1){
                  $SQL= "SELECT IDORDEN FROM ORDENDECOMPRA ORDER BY NUMERO DESC;"; //obtengo la lista de id's
                  $QUERY =  mysql_query ($SQL);
                  }
                ?>

              <label>Código: &nbsp; <?php  $resultado = mysql_fetch_row($QUERY);
                                        $codigoAnterior = $resultado[0];
                                        $nParteNumerica = substr($codigoAnterior, -8)+1;
                                        $tamaño = 8 - strlen($nParteNumerica);
                                        //creamos el nuevo codigo
                                        $codigoActual = "OR";
                                        for($i = 0; $i < $tamaño; $i++){
                                          $codigoActual .= "0";
                                        }
                                        $codigoActual .= $nParteNumerica;

                                        echo "<b>".$codigoActual."</b>"; 
                                    ?> 
              </label>
            </div>

            <div id = "div_fecha">
              <label> Fecha: 
                  <?php
                    $fecha = date("d/m/Y");
                    echo "<b>".$fecha."</b>";
                  ?>
              </label>
            </div>
          </div> <!--  div_datos -->

          <div id = "div_datosOrdenes">
            <div id = "div_idProducto">

              <input type="hidden" value="anadir" name="accion"> <!-- de la tabla dinamica -->

              <select id="combobox" class = "listado" class="ui-widget" name="productos">
             
              <?php 
                  if(iniciarconexion()==1){
                  $SQL= "SELECT NOMBREPRODUCTO FROM PRODUCTOS;";
                  $QUERY =  mysql_query ($SQL);
                    while ( $resultado = mysql_fetch_row($QUERY)){
                    echo "<option value='".$resultado[0]."'> ".$resultado[0]."</option>";
                    }
                  }
                ?>

              </select>        
            </div>
            <div id = "div_numLotes">
               <input class = "eOrdenes" name="nlotes" type="number"  min="1" title = "Debe ser un número mayor que cero" placeholder="# lotes"/>
            </div>
            <div id = "div_prodPorLote">
               <input class = "eOrdenes" name="prodxlote" type="number"  min="1" title = "Debe ser un número mayor que cero" placeholder="# productos/lote"/>
            </div>
            <div id = "div_precioPorLote">
              <input class = "eOrdenes" name="precxlote" type="number" pattern="[0-9]+([\.|,][0-9]+)?" step="0.01" title="Solo se permiten dos decimales"  placeholder="# costo/lote"/>
            </div>
            
            <div id = "div_idProveedores">
              <select id="combobox" class = "listado" name="proveedores">
                <?php 
                  if(iniciarconexion()==1){
                  $SQL= "SELECT NOMBREEMPRESA FROM PROVEEDOR;";
                  $QUERY =  mysql_query ($SQL);
                    $j=0;
                    while ( $resultados = mysql_fetch_row($QUERY)){
                    echo "<option value='".$resultados[0]."'> ".$resultados[0]."</option>";
                    $prov[$j]=$resultados[1];
                    $j++;
                    }
                  }
                ?>
              </select> 
            </div> <!--  div_idProveedores -->
          </div> <!--  div_datosOrdenes -->

          <div id = "div_botones">
            <div id = "div_btnLimpiar">
              <input name="" type="button" id="" onclick="formReset()" value="Limpiar" />
            </div>
            <div id = "div_btnGuardar">
              <input type="submit" value="Guardar" name="botones"/>
            </div>
          </div> <!--  div_botones -->

          <!-- Tabla dinamica e ingreso a la base -->
                <?php 
                    //para la tabla dinamica
                  switch( $_POST['botones'] ) {
                    case "Guardar":{
                      if($_POST['accion']=="") {
                        $_SESSION['contador']=0;
                      }
                      if($_POST['accion']=="anadir") {


                          $_SESSION['datos'][$_SESSION['contador']][0]=$_POST['productos'];
                          $_SESSION['datos'][$_SESSION['contador']][1]=$_POST['nlotes'];
                          $_SESSION['datos'][$_SESSION['contador']][2]=$_POST['prodxlote'];
                          $_SESSION['datos'][$_SESSION['contador']][3]=$_POST['precxlote'];
                          $_SESSION['datos'][$_SESSION['contador']][4]=$_POST['proveedores'];        
                          $_SESSION['contador']=$_SESSION['contador']+1;

                      }
                       break;
                    } //del case Guardar         
                    case "Cancelar":{ 
                        $_SESSION['contador']=0;
                        break;
                    }//del case cancelar

                    case "Confirmar":{ 
                      //recuperamos los datos a insertar
                      if($_SESSION['datos'][0][1]!="" && $_SESSION['datos'][0][2]!="" && $_SESSION['datos'][0][3]!=""){

                      for($i = 0; $i<$_SESSION['contador'];$i++){
                            if(iniciarconexion()==1){
                              //Obtenemos el NUMERO ACTUAL
                              $SQL = "SELECT NUMERO FROM ORDENDECOMPRA ORDER BY NUMERO DESC;";
                              $QUERY =  mysql_query ($SQL);
                              $resultado = mysql_fetch_row($QUERY);
                              $numero = $resultado[0]+1;

                              //Obtenemos el IDPRODUCTO
                              $SQL = "SELECT IDPRODUCTO FROM PRODUCTOS WHERE NOMBREPRODUCTO = "."'".$_SESSION['datos'][$i][0]."'".";";
                              $QUERY =  mysql_query ($SQL);
                              $resultado = mysql_fetch_row($QUERY);
                              $idProducto = $resultado[0];


                              //Obtenemos el IDPROVEEDOR
                              $SQL = "SELECT IDPROVEEDOR FROM PROVEEDOR WHERE NOMBREEMPRESA = "."'".$_SESSION['datos'][$i][4]."'".";";
                              $QUERY =  mysql_query ($SQL);
                              $resultado = mysql_fetch_row($QUERY);
                              $idProveedor = $resultado[0];

                              //Obtenemos el IDUSARIO ACTIVO
                              $SQL = "SELECT IDUSUARIO FROM USUARIO WHERE ROL = ".$_SESSION['tipo'].";";
                              $QUERY =  mysql_query ($SQL);
                              $resultado = mysql_fetch_row($QUERY);
                              $idUsuario = $resultado[0];

                            }

                              $idOrden = $codigoActual;

                              $aux = "canLotes".$i;
                              $cantidadLotes = $_POST[$aux];

                              $aux = "pLotes".$i;
                              $productosPorLote = $_POST[$aux];

                              $aux = "precLote".$i;
                              $costoPorLote = trim($_POST[$aux]);

                              $estado = 1;
                              $costoUnitario = $costoPorLote/$productosPorLote;
                              $fecha = date("Y-m-d H:i:s");

                              // //Insertamos a la base de datos
                              $SQL = "INSERT INTO ORDENDECOMPRA VALUES(".$numero.",'".$idOrden."','".$idProducto."','".$idProveedor."','".$idUsuario."',".$cantidadLotes.",'".$costoPorLote."',".$estado.",'".$costoUnitario."',".$productosPorLote.",'".$fecha."','".$fecha."');";
                              //echo $SQL;
                              mysql_query ($SQL);
                      }
                        
                        if ($_POST['botones']=="Confirmar"  && $_SESSION['contador']>0){ 
                        ?> 
                            <script languaje="javascript"> 
                                confirmacion(); 
                            </script> 
                        <?php 
                        } 
                      $_SESSION['contador']=0;
                      break;
                    }
                   }
                   $_SESSION['contador']=0;
                  }       
                ?>

          <!-- Tabla dinamica e ingreso a la base -->
          <div id = "div_tabla" style="margin-top:20px;">
            <table class = "tablaDin" style="border: 1px solid white;">
              <tr>
                <th>Productos</th>
                <th># Lotes</th> 
                <th>Productos/lote</th>
                <th>Precio/lote</th>  
                <th>Proveedores</th>  
              </tr>
              <?php
                for($i=0;$i<$_SESSION['contador'];$i++) {
                  echo "
                    <tr>
                      <td> <label >".$_SESSION['datos'][$i][0]."</label></td>
                      <td> <input name='canLotes".$i."' type=\"number\"  min=\"1\" title = \"Debe ser un número mayor que cero\" value=\"".$_SESSION['datos'][$i][1]."\"/> </td>
                      <td> <input name='pLotes".$i."' type=\"number\"  min=\"1\" title = \"Debe ser un número mayor que cero\" value=\"".$_SESSION['datos'][$i][2]."\"/> </td>  
                      <td> <input name='precLote".$i."' type=\"number\" pattern=\"[0-9]+([\.|,][0-9]+)?\" step=\"0.01\" title=\"Solo se permiten dos decimales\" value=\"".$_SESSION['datos'][$i][3]."\"/> </td>
                      <td> <label >".$_SESSION['datos'][$i][4]."</label></td>
                    </tr>
                  ";
                }
              ?>
             </table>
          </div> <!--  div_tabla -->

           <div id = "div_botonesFin">
            <div id = "div_btnCancelar">
              <input name="botones" type="submit" value="Cancelar" />
            </div>
            <div id = "div_btnConfirmar">
              <input type="submit" value="Confirmar" name="botones" />
            </div>
          </div> <!--  div_botonesFin -->

      </div><!--  div_entrada -->
    	<div id="b_atras"> 
    	  <input name="botones" type="submit" id="atras"  value="Salir" onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue"/>
    	</div>
	
   </form>

  </div> <!-- del div principal -->
</body>
</html>


<!-- onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" -->
