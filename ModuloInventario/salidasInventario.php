 <?php
 error_reporting(E_ERROR);
//require("traedatosorden.php");
 require("tabladinamicasal.php");
 require("zerofill.php");
 $contatransaccion;
 $contalote;
 ?>
 
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
    $( "input[type=button]" )
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

  <script type="text/javascript">
  function getData() {
   var oCombo = document.getElementById('idproducto');
   var iValue = oCombo.value;
   
 // La pagina PHP puede ser la misma en la estas
 document.location.href = 'tabladinamica.php?opcion_combo=' + iValue;
}
</script>

<script language="JavaScript">
function validacionentradas(){  
//SI EL CAMPO NO ES UN VALOR NUMÉRICO
if (isNaN(document.form1.cantidadlotes.value)) {
  alert("Error:\n¡La cantidad de lotes debe ser un número!");
  document.form1.cantidadlotes.focus();
  return false;
}
return true;
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



<script type="text/javascript">
function formReset()
{
  document.getElementById("form1").reset();
}
</script>


<script type="text/javascript">
function submit ()

{document.forms["form1"].submit();}
</script>


<script type="text/javascript">
function deshabilitarcampos(){
  var opcion = document.form1.combobox.options.value;
  
  document.form1.idproducto.disabled = true;
  document.form1.cantidadlotes.disabled = true;
  document.form1.cantidadproductosporlote.disabled = true;
  document.form1.preciolote.disabled = true;
  document.form1.idproveedor.disabled = true;
  document.form1.descripcion.disabled = false;
}
</script>




<script>
function comprobarOption(){

    // obteniendo el valor del elemento
  
    
  //deshabilitarcampos()
    //alert(idorden);
    var idorden = document.getElementById("combobox").value;
    document.form1.accion.value= idorden;
    document.form1.idproducto.disabled = true;
    document.form1.cantidadlotes.disabled = true;
    document.form1.cantidadproductosporlote.disabled = true;
    document.form1.preciolote.disabled = true;
    document.form1.idproveedor.disabled = true;
    document.form1.descripcion.disabled = false;
    submit();
    
  }
  </script>

  <script>
  function confirma(){
    document.form1.accion.value= 'Confirmar';
    submit();
  }
  </script>

  <script>
  function Guardando(){
    document.form1.accion.value= 'Guardar';
    document.forms["form1"].submit();
  }
  </script>
<script>
  function cancelar(){
    document.form1.accion.value= 'Cancelar';
    document.forms["form1"].submit();
  }
  </script>




  <script language="javascript" type="text/javascript">
    //*** Este Codigo permite Validar que sea un campo Numerico
    function Solo_Numerico(variable){
      Numer=parseInt(variable);
      if (isNaN(Numer)){
        return "";
      }
      return Numer;
    }
    function ValNumero(Control){
      Control.value=Solo_Numerico(Control.value);
    }
    //*** Fin del Codigo para Validar que sea un campo Numerico
    </script>


  </head>

  <body>
    <?php
    include ('../utilidades/config.php'); 
    ?>

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

      <h2 id="menu">Registro de Salidas de Inventario</h2>   

      <form id="form1" name="form1" method="post" action="" >
        <input type="hidden" value="Guardar" name="accion">
        <input type="hidden" value="Confirmar" name="accion2">


        
        <div id = "div_entrada" >
          <div id = "div_datos">
            <div id = "div_idtransaccion">
              <label class="log">Código: &nbsp; <?php 
                                       
                                        $idcompleto=NidtransaccionS();
                                       echo "<b>".$idcompleto."</b>"; 

                                      
                                        ?> 
                                          <!-- <td width="416" class="log"><input type="text" name="idtransaccion" textalign="center" id="idtransaccion" value="<?php echo NidtransaccionS(); ?>" align="center" placeholder="# idtransaccion /> -->
                                      </label>

                                    </div>
                                    
                                    <div id = "div_ordenes">
                                      <label> Bodega: </label>
                                      <select id="combobox" name="combobox" class = "listado" >
                                        <option value="Ninguna">Ninguna...</option>
                                        
                                        <?php


                                        $query="SELECT IDBODEGA, UBICACION FROM BODEGA ;";
                                        $link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
                                        mysql_select_db("bdsi215",$link); //selecciono mi base de datos  
                                        $result=mysql_query($query);
                                        while ($row=mysql_fetch_array($result))
                                        {
                                          ?>
                                          <option value = " <?php echo $row['IDBODEGA']; ?> "> <?php echo $row['UBICACION']; ?></option> 
                                          <?php
                                        }
                                        ?>
</select>   
</div>

             <!-- 
              <?php
                $contatransaccion=$contatransaccion+1;
                $valor=(string)$contatransaccion;
                $prefijo="EP";
                $valor2=zerofill($contatransaccion, 6);
                $valor3=(string)$valor2;
                $idcompleto=$prefijo.$valor3;
                ?>  -->

                <!-- <td width="416" class="log"><input type="text" name="idtransaccion" textalign="center" id="idtransaccion" value="<?php echo $idcompleto ?>" align="center" placeholder="# idtransaccion /> -->
                
                
                <div id = "div_fecha">
                  <label> Fecha: 
                    <?php
                    $fecha = date("d/m/Y");
                    echo "<b>".$fecha."</b>";
                    ?>
                  </label>
                </div>
                
                
              </div> <!--  div_datos -->

              
<div id = "div_datosOrdenes"  style="width: 60%;">
<div id = "div_idProducto">
<select id="idproducto" name="idproducto" class = "listado" class="ui-widget">
<option value="">Seleccione el producto</option>

<?php
$query="SELECT IDPRODUCTO, NOMBREPRODUCTO FROM PRODUCTOS;";
//$link=mysql_connect("localhost","root",""); //abro la conexion
//$result=mysql_db_query("bdsi215",$query,$link);
$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos  

$result=mysql_query($query);
while ($row=mysql_fetch_array($result))
{
  ?>
  <option value = " <?php echo $row['IDPRODUCTO']; ?> "> <?php echo $row['NOMBREPRODUCTO']; ?></option> 
  <?php
}
?>
</select>        


</div>

<div id = "div_numLotes">
 <input class = "eOrdenes" type="number" name="cantidadlotes" id="cantidadlotes"  onkeyUp="return ValNumero(this);"placeholder="Cantidad de lotes"/>
</div>

<!-- <div id = "div_prodPorLote">
 <input class = "eOrdenes" type="number" name="cantidadproductosporlote" id="" onkeyUp="return ValNumero(this);"  placeholder="Numero de productos/lote"/>
</div> -->

<div id = "div_idProveedores">
  <select id="idproveedor" class = "listado" name="idproveedor">
    <option value="">Seleccione el proveedor</option>
    <?php
      $query="SELECT IDPROVEEDOR, NOMBREEMPRESA FROM PROVEEDOR";
      $link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
      mysql_select_db("bdsi215",$link); //selecciono mi base de datos  

      $result=mysql_query($query);
      while ($row=mysql_fetch_array($result))
      {
    ?>
  <option value = " <?php echo $row['IDPROVEEDOR']; ?> "> <?php echo $row['NOMBREEMPRESA']; ?></option> 
  <?php
  }
  ?>
</select>        
</div>





 <div id = "div_descripcion">
               <input class = "eOrdenes" type="text" name="descripcion" id="descripcion"  placeholder=" agregue una descripcion"/>
            </div>
            






</div> <!--  div_datosOrdenes -->

<div id = "div_botones">
  <div id = "div_btnLimpiar">
    
    <input name="" type="button" id="" onclick="formReset()" value="Limpiar" />
  </div>
  <div id = "div_btnGuardar">
    <input name="guardar" type="button" id="Guardar"  value="Guardar" onclick="Guardando()">
  </div>
</div> <!--  div_botones -->

<div id = "div_tabla" style="margin-top:20px;">
  <table class = "tablaDin" style="border: 1px solid white;">
    
   <tr>

    <th class="log">ID del Producto</th>
    <th class="log">Nombre</th> 
    <th class="log">Cantidad de Lotes</th>
    <th class="log">Precio del Lote</th> 
    <th class="log">Cantidad de Productos por Lote</th> 
    <th class="log">Costo unitario del producto</th> 

  </tr>
  <?php
  for($i=0;$i<$_SESSION['contador'];$i++) {
    echo "
    <tr>
    <td class='log' align='center'>".$_SESSION['datos'][$i][0]."</td>
    <td class='log' align='center'>".$_SESSION['datos'][$i][1]."</td>
    <td class='log' align='center'>".$_SESSION['datos'][$i][2]."</td>
    <td class='log' align='center'>".$_SESSION['datos'][$i][3]."</td>
    <td class='log' align='center'>".$_SESSION['datos'][$i][4]."</td>
    <td class='log' align='center'>".$_SESSION['datos'][$i][5]."</td>


    </tr>
    ";
  }
  ?>
</table>
</div> <!--  div_tabla -->

<div id = "div_botonesFin">
  <div id = "div_btnCancelar">
    <input name="" type="button" id=""  value="Cancelar" onclick="cancelar()" />
  </div>
  <div id = "div_btnConfirmar">
    <input name="confirmar" type="button" id="Confirmar"  value="Confirmar" onclick="confirma()"/>
  </div>
  
  
  
  
  
</div> <!--  div_botonesFin -->

</div><!--  div_entrada -->






<div id="b_atras"> 
 <input name="atras" type="button" id="atras" onclick="MM_goToURL('parent','../menu.php');return document.MM_returnValue" value="Salir" />
</div>

</form>

</div> <!-- del div principal -->
</body>
</html>