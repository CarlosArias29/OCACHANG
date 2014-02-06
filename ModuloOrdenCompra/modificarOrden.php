<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
function fillTable(dropdown){

   document.getElementById("insertarOrden").dobleBoton.value = "Cargar";
   var boton = document.getElementById("insertarOrden").dobleBoton;
   boton.click();



}
</script>

</head>
<body>
  
  <!-- Confirmacion de guardado-->

  <div id="dialog-message" title="Actualizada con éxito" style="display:none;">
  <p>
    <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 50px 0;"></span>
    <p>Orden de compra actualizada con éxito.</p>
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

	  <h2 id="menu">Modificación de Orden de Compra</h2>   

  <form id="insertarOrden" name="insertarOrden" method="post" action="modificarOrden.php">

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

              <label>Código Orden: </label>

              <select id="combobox" name="combobox" class="listado" onchange="fillTable(this);" >
                <option value="ninguna">Selección</option>
                <?php
                  $query="SELECT DISTINCT IDORDEN  FROM ORDENDECOMPRA where ESTADO=1";
                  $link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
                  mysql_select_db("bdsi215",$link); //selecciono mi base de datos  
                  $result=mysql_query($query);
                  while ($row=mysql_fetch_array($result))
                  {
                  ?>
                  <option value = " <?php echo $row['IDORDEN']; ?> "> <?php echo $row['IDORDEN']; ?></option> 
                  <?php
                  }
                ?>
              </select> 
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

          <!-- Tabla dinamica e ingreso a la base -->
                <?php 
                    //para la tabla dinamica
                  switch( $_POST['botones'] ) {        
                    case "Cancelar":{ 
                        $_SESSION['contador']=0;
                        break;
                    }//del case cancelar

                    case "Cargar":{ 
                        if(iniciarconexion()==1){
                              $i = 0;
                              $_SESSION['idSeleccionado'] = trim($_POST['combobox']);
                              //Obtenemos las filas de todas las ordenes de compra
                              $SQL = "SELECT * FROM ORDENDECOMPRA WHERE IDORDEN ='".$_SESSION['idSeleccionado']."';";
                              $QUERYP =  mysql_query ($SQL);

                              while($ordenCompleta = mysql_fetch_array($QUERYP)){
                                  //Obtenemos el nombre del proveedor
                                  $SQL = "SELECT NOMBREEMPRESA FROM PROVEEDOR WHERE IDPROVEEDOR ='".$ordenCompleta['IDPROVEEDOR']."';";
                                  $QUERY =  mysql_query ($SQL);
                                  $nombreProveedor= mysql_fetch_array($QUERY);

                                  //Obtenemos el nombre del producto
                                  $SQL = "SELECT NOMBREPRODUCTO FROM PRODUCTOS WHERE IDPRODUCTO ='".$ordenCompleta['IDPRODUCTO']."';";
                                  $QUERY =  mysql_query ($SQL);
                                  $nombreProducto= mysql_fetch_array($QUERY);

                                  //****************************************************//
                                  $_SESSION['datos'][$i][0]=$nombreProducto['NOMBREPRODUCTO'];
                                  $_SESSION['datos'][$i][1]=$ordenCompleta['CANTIDADLOTES'];
                                  $_SESSION['datos'][$i][2]=$ordenCompleta['CANTIDADLOTES'];
                                  $_SESSION['datos'][$i][3]=$ordenCompleta['COSTOPORLOTE'];
                                  $_SESSION['datos'][$i][4]=$nombreProveedor['NOMBREEMPRESA'];
                                  $i++;
                                  $_SESSION['contador']=$i;
                              }//del while 
                            }//del if
                        break;
                    }//del case Cargar

                    case "Confirmar":{ 
                      //obtenemos los numeros (unico) de la fila
                      $SQL = "SELECT NUMERO FROM ORDENDECOMPRA WHERE IDORDEN ='".$_SESSION['idSeleccionado']."';";
                      $QUERY =  mysql_query ($SQL);
                      $numeros = mysql_fetch_array($QUERY);
                      $_SESSION['numero'] = $numeros['NUMERO'];

                      //recuperamos los datos a insertar
                      for($i=0;$i<$_SESSION['contador'];$i++) {
                        $producto = $_SESSION['datos'][$i][0];

                        $aux = "canLotes".$i;
                        $cantidad = $_POST[$aux];

                        $aux = "pLotes".$i;
                        $prodxlote = $_POST[$aux];

                        $aux = "precLote".$i;
                        $precxlote = trim($_POST[$aux]);
                        
                        $proveedor = $_SESSION['datos'][$i][4];

                        $SQL = "UPDATE ORDENDECOMPRA SET CANTIDADLOTES =".$cantidad.", COSTOPORLOTE =".$precxlote.", PRODUCTOSXLOTE =".$prodxlote.",COSTOUNITARIO =".($precxlote/$prodxlote)." WHERE IDORDEN = '".$_SESSION['idSeleccionado']."' AND NUMERO = ".$_SESSION['numero'].";";
                        //echo "<span class='log'>".$SQL."<br><span>";
                        mysql_query ($SQL);
                        $_SESSION['numero'] = $_SESSION['numero'] +1;

                        // echo $SQL;
                      } //entrada de datos

                        
                        if ($_POST['botones']=="Confirmar" && $_SESSION['contador']>0){ 
                        ?> 
                            <script languaje="javascript"> 
                                confirmacion(); 
                            </script> 
                        <?php 
                        } 
                      $_SESSION['contador']=0;
                      $_SESSION['idSeleccionado']="";
                      break;
                    
                   }
                   $_SESSION['contador']=0;
                  }       
                ?>

          <!-- Tabla dinamica e ingreso a la base -->
          <div id = "div_tabla" style="margin-top:20px;">
            <table class = "tablaDin" style="border: 1px solid white;">
              <tr>
                <th colspan="5" style="color: white;">Orden de compra a Modificar: <?php echo $_SESSION['idSeleccionado'];?></th> 
              </tr>
              <tr>
                <th>Productos</th>
                <th>Cantidad de lotes</th> 
                <th>Productos por lote</th>
                <th>Precio por lote</th>  
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
                // $_SESSION['contador']=0;
                // <td> <input name='' type='number' value='' placeholder=̈́'".$_SESSION['datos'][$i][1]."' />""</td>
              ?>
             </table>
          </div> <!--  div_tabla -->

           <div id = "div_botonesFin">
            <div id = "div_btnCancelar">
              <input name="botones" type="submit" value="Cancelar" />
            </div>
            <div id = "div_btnConfirmar">
              <input type="submit" value="Confirmar" name="botones" />
              <input id="dobleBoton" type="submit" value="Cargar" name="botones" style="display:none;"/>
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
