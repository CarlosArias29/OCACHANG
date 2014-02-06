
<?php
session_start();
include ('../utilidades/config.php'); 
$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 

echo $_POST['accion'];

switch( $_POST['accion'] ) {
   
   
   case "Guardar":{
	   
	   	
	// AQUI TODO EL CODIGO QUE HARÁ EN GUARDAR

if($_POST['accion']=="") {
$_SESSION['contador']=0;
}


if ($_POST['accion']=="Guardar"){
	
$idbodega=trim($_POST['combobox']);
$idproducto=trim($_POST['idproducto']);
$id=mysql_query("SELECT NOMBREPRODUCTO FROM PRODUCTOS where IDPRODUCTO='$idproducto'",$link) or die("La consulta no obtuvo filas");
$a= mysql_fetch_array($id) or die("Error en:" . mysql_error());
$nombreproducto=$a['NOMBREPRODUCTO'];
$cantidadlotes=trim($_POST['cantidadlotes']);


//verificamos si hay existencias	
//$verexistencias="SELECT SUM(EX) FROM INVENTARIO WHERE IDPRODUCTO=$idproducto AND IDPROVEEDOR=$idproveedor";
$conexistencias="SELECT EXISTENCIA FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto'";
//$b=mysql_query($conexistencias,$link) or die("La consulta de existencias no se realizo");
$b=mysql_query($conexistencias,$link) or die("Error en:" . mysql_error());
$xx= mysql_fetch_array($b) or die("Error en:" . mysql_error());


$e=$xx['EXISTENCIA'];


if ($e>$cantidadlotes){

//$sql = "SELECT * FROM INVENTARIO";  // sentencia sql
//$result = mysql_query($sql);
//$max = mysql_num_rows($result); // obtenemos el número de filas
// si hay existencias

	
$sql="select * from INVENTARIO where IDPRODUCTO='$idproducto' AND IDTRANSACCION LIKE 'EP%'";

//efectúo la consulta
$res=mysql_query($sql,$link);

// si la consulta obtuvo resultados
while($registro=mysql_fetch_array($res)) 
{ 
	$ex=$registro['EX'];
	
	echo $ex;
	if($ex>$cantidadlotes){
		
		$var=$registro['CORRELATIVO'];
		//imprimimos registro
		
$_SESSION['datos'][$_SESSION['contador']][0]=$registro['IDPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][1]=$registro['NOMBREPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][2]=$registro['CANTIDADLOTES'];
$_SESSION['datos'][$_SESSION['contador']][3]=$registro['PRECIOLOTE'];
$_SESSION['datos'][$_SESSION['contador']][4]=$registro['CANTIDADPRODUCTOXLOTE'];
$_SESSION['datos'][$_SESSION['contador']][5]=$registro['COSTOUNITARIOREGISTRADO'];

$_SESSION['contador']=$_SESSION['contador']+1;		
		
		$ex=$ex-$cantidadlotes;
				//actualizamos el valor de EX del registro
		mysql_query("update inventario set EX='$ex' where CORRELATIVO='$var'",$link);
		
		$tempo=$e-$cantidadlotes;
		//disminuimos el producto en existencias de l atabla producto
		mysql_query("update productos set EXISTENCIA='$tempo' where IDPRODUCTO='$idproducto",$link);
		
		}// fin if
	
	
	
	if ($ex<=$cantidadlotes){
		
$_SESSION['datos'][$_SESSION['contador']][0]=$registro['IDPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][1]=$registro['NOMBREPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][2]=$registro['CANTIDADLOTES'];
$_SESSION['datos'][$_SESSION['contador']][3]=$registro['PRECIOLOTE'];
$_SESSION['datos'][$_SESSION['contador']][4]=$registro['COSTOUNITARIOREGISTRADO'];
$_SESSION['datos'][$_SESSION['contador']][5]=$costouni;
$_SESSION['contador']=$_SESSION['contador']+1;
		
		$tem=$cantidadlotes-$ex;
		
		//actualizamos el valor de EX del registro
		mysql_query("update inventario set EX='0' where CORRELATIVO='$var'",$link);
		
		//$tempo=$e-$cantidadlotes;
		//disminuimos el producto en existencias de l atabla producto
		
		mysql_query("update productos set EXISTENCIA='$tem' where IDPRODUCTO='$idproducto'",$link);
		
		}// fin if
		
	
	
}// fin while


	
}//fin del if si hay existencias



}

 break;
}// fin case GUARDAR








case "Confirmar":{ 
if($_POST['accion2']=="") {
$_SESSION['contador']=0;
}

if($_POST['accion2']=="Confirmar") {
	
	// AQUI TODO EL CODIGO PARA CONFIRMAR
	
}//fin if
break;
                    }//del case Confirmar



}// fin switch














function NidtransaccionS(){
    $salida='SP00000001';
    $query ="SELECT MAX(IDTRANSACCION) FROM INVENTARIO WHERE IDTRANSACCION LIKE 'SP%'";

    $result=mysql_query($query) or die("Error en: " . mysql_error());

    //Mientras exista resultados
        if( $fila=mysql_fetch_array($result) ){
            $salida= 'SP'.formatoNum($fila['MAX(IDTRANSACCION)']);
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


