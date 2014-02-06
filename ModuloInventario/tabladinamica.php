  <link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
  <script src="../js/jquery-1.9.1.js"></script>
  <script src="../js/jquery-ui-1.10.3.custom.js"></script>
  

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

<?php
session_start();
include ('../utilidades/config.php'); 
switch( $_POST['accion'] ) {
	
		
			
   case "Guardar":{

if($_POST['accion']=="") {
$_SESSION['contador']=0;
}

if ($_POST['accion']=="Guardar"){
	
$ip=trim($_POST['idproducto']);
$pl=trim($_POST['preciolote']);
$cppl=trim($_POST['cantidadproductosporlote']);
$costouni=($pl)/($cppl);

$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 
$np=mysql_query("SELECT NOMBREPRODUCTO FROM PRODUCTOS  where IDPRODUCTO='$ip'",$link) or die("La consulta no obtuvo filas");
$nombreproducto= mysql_fetch_array($np) or die("La consulta nou obtuvo filas");

$_SESSION['datos'][$_SESSION['contador']][0]=$_POST['idproducto'];
$_SESSION['datos'][$_SESSION['contador']][1]=$nombreproducto['NOMBREPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][2]=$_POST['cantidadlotes'];
$_SESSION['datos'][$_SESSION['contador']][3]=$_POST['preciolote'];
$_SESSION['datos'][$_SESSION['contador']][4]=$_POST['cantidadproductosporlote'];
$_SESSION['datos'][$_SESSION['contador']][5]=$costouni;

$_SESSION['datos'][$_SESSION['contador']][6]=$_POST['descripcion'];
$_SESSION['datos'][$_SESSION['contador']][7]=$_POST['idproveedor'];
$_SESSION['contador']=$_SESSION['contador']+1;

//echo 'Variable= '.$_POST['accion'];
  }// fin if
 
 break;
}// fin case


case "Confirmar":{ 





if($_POST['accion2']=="") {
$_SESSION['contador']=0;
}

if($_POST['accion2']=="Confirmar") {

$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 
	
	
$idtransaccion=Nidtransaccion();	
	
	
	
	
for ($i=0;$i<$_SESSION['contador'];$i++){
		for ($c=0;$c<=7;$c++){

$M[$i][$c]=$_SESSION['datos'][$i][$c];

//echo $M[$i][$c];


}//fin contador columnas

//$idtransaccion=trim($_POST['idtransaccion']);
//$idtransaccion=$idcompleto;

$idproveedor=trim($M[$i][7]);

$idbodega=trim('BDG0000001');
$idusuario=trim($_SESSION['usuario']);
// esto no lleva trim porque aceptara espacios
$descripcion=$M[$i][6];
$fechaingreso=date("Y-m-d");

echo "<script language='javascript'>"; 
//echo "alert('".$_POST['accion2']."')"; 
echo "</script>";  
$consulta="insert into INVENTARIO (IDTRANSACCION,IDPROVEEDOR,IDBODEGA,IDPRODUCTO,IDUSUARIO,NOMBREPRODUCTO,CANTIDADPRODUCTOXLOTE,CANTIDADLOTES,COSTOXLOTE,COSTOUNITARIOREGISTRADO,DESCRIPCION,FECHAINGRESOINVENTARIO,EX) values ('$idtransaccion','$idproveedor','$idbodega','".trim($M[$i][0])."','$idusuario','".$M[$i][1]."','".$M[$i][4]."','".$M[$i][2]."','".$M[$i][3]."','".$M[$i][5]."','".$M[$i][6]."',now(),'".$M[$i][2]."')";

//echo $consulta;

mysql_query($consulta, $link) or die("Error en:  " . mysql_error());;
//echo $consulta;

//Lo que sigue es para acumular las existencias
//echo $con="select EXISTENCIA from productos where IDPRODUCTO='".trim($M[$i][0])."'";
$exresult=mysql_query("select EXISTENCIA from productos where IDPRODUCTO='".trim($M[$i][0])."'",$link);
$ex1=mysql_fetch_array($exresult) or die("La consulta no obtuvo filas");
$ex2=$M[$i][2];
//echo $consul="update productos set EXISTENCIA='$existenciastotales' where IDPRODUCTO='".$M[$i][0]."'";
$existenciastotales=$ex1['EXISTENCIA']+$ex2;
mysql_query("update productos set EXISTENCIA='$existenciastotales' where IDPRODUCTO='".trim($M[$i][0])."' ",$link);

}//fin contador filas

echo ('<script languaje="javascript"> 
                                confirmacion(); 
                            </script>');

if($_SESSION['contador']!=0)
echo '<div id="dialog-confirm" title="Información"><p>La entrada de los productos fue efectuada correctamente</p></div>';
$_SESSION['contador']=0;
}//fin if

break;
                    }//del case Confirmar



case $_POST['accion']:{
//default : {
	//echo 'Valor de la orden pasado= '.$_POST['accion'];
	
if($_POST['accion']=="") {
$_SESSION['contador']=0;
}

$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 





// capturo el id de la orden del combobox
//$idorden=trim($_GET['idorden']);
$idorden=trim($_POST['accion']);

//Cambiamos el estado de la orden a completada
mysql_query("update ordendecompra set ESTADO='2' where IDORDEN='$idorden' ",$link);
//selecciono la tabla ordendecompra
$sql = "SELECT * FROM ORDENDECOMPRA";  // sentencia sql
//almaceno la solución
$result = mysql_query($sql);
//cuento el número de filas de la tabla
$max = mysql_num_rows($result); // obtenemos el número de filas
//echo 'El número de registros de la tabla es: '.$max.'';  // imprimos en pantalla el número 

//para cada fila de la tabla

//for($i=0;$i<$max;$i++){

// obtengo todos los atributos de la fila donde de la orden anterior	
$sql="select * from ORDENDECOMPRA where IDORDEN='$idorden'";
//efectúo la consulta
$res=mysql_query($sql,$link);

// si la consulta obtuvo resultados, es decir el producto es de la orden que deseamos
while($registro=mysql_fetch_array($res)) 
{ 
//obtenemos los campos que deseamos y los almacenamos

$idproducto=trim($registro["IDPRODUCTO"]);
//$nueva=mysql_query("SELECT * FROM ordendecompra  where IDORDEN='$idorden'",$link) or die("La consulta no obtuvo filas");;
//echo "<br>$sql";
$idor=mysql_query("SELECT NOMBREPRODUCTO FROM PRODUCTOS where IDPRODUCTO='$idproducto'",$link) or die("La consulta no obtuvo filas");;
$nombreproducto= mysql_fetch_array($idor) or die("La consulta no obtuvo filas");
$productosporlote=trim($registro["PRODUCTOSXLOTE"]);
$cantidadlotes=trim($registro["CANTIDADLOTES"]);
$costoporlote=trim($registro["COSTOPORLOTE"]);
$costounitario=trim($registro["COSTOUNITARIO"]);
$idproveedor=trim($registro['IDPROVEEDOR']);
//echo 'Paso de las consultas';

$_SESSION['datos'][$_SESSION['contador']][0]=$idproducto;
$_SESSION['datos'][$_SESSION['contador']][1]=$nombreproducto['NOMBREPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][2]=$cantidadlotes;
$_SESSION['datos'][$_SESSION['contador']][3]=$costoporlote;;
$_SESSION['datos'][$_SESSION['contador']][4]=$productosporlote;
$_SESSION['datos'][$_SESSION['contador']][5]=$costounitario; 


//echo $idproveedor;
//$_SESSION['datos'][$_SESSION['contador']][6]=$descrip['DESCRIPCION'];
//$_SESSION['datos'][$_SESSION['contador']][7]=$iprov['IDPROVEEDOR'];


$_SESSION['datos'][$_SESSION['contador']][6]='Entrada proveniente de una Orden de Compra';
$_SESSION['datos'][$_SESSION['contador']][7]=$idproveedor;

$_SESSION['contador']=$_SESSION['contador']+1;
  }// if

//}// fin for
}

}// fin switch



function Nidtransaccion(){
    $salida='EP00000001';
    $query ="SELECT MAX(IDTRANSACCION) FROM INVENTARIO WHERE IDTRANSACCION LIKE 'EP%'";

    $result=mysql_query($query) or die("Error en: " . mysql_error());

    //Mientras exista resultados
        if( $fila=mysql_fetch_array($result) ){
            $salida= 'EP'.formatoNum($fila['MAX(IDTRANSACCION)']);
        }
    return $salida;
}//fin de nuevo id proveedor



//Formato para numero destinado a IDPRODUCTO
function formatoNum($str){
    $str = (string)((int)substr(trim($str),3)+1);
    for($i=strlen($str);$i<8;$i++){
        $str='0'.$str;
    }
    return trim($str);
}
?>


