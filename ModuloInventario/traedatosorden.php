<?php

session_start();

include ('../utilidades/config.php');
if($_POST['accion3']=="") {
$_SESSION['contador']=0;
}



$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 

// capturo el id de la orden del combobox
$idorden=trim($_GET['idorden']);


//selecciono la tabla ordendecompra
$sql = "SELECT * FROM ORDENDECOMPRA";  // sentencia sql
//almaceno la solución
$result = mysql_query($sql);
//cuento el número de filas de la tabla
$max = mysql_num_rows($result); // obtenemos el número de filas
//echo 'El número de registros de la tabla es: '.$max.'';  // imprimos en pantalla el número 

//para cada fila de la tabla
for($i=0;$i<$max;$i++){
// obtengo todos los atributos de la fila donde de la orden anterior	
$sql="select * from ORDENDECOMPRA where IDORDEN='$idorden'";
//efectúo la consulta
$res=mysql_query($sql,$link);

// si la consulta obtuvo resultados, es decir el producto es de la orden que deseamos
if($registro=mysql_fetch_array($res)) 
{ 
//obtenemos los campos que deseamos y los almacenamos
$idproveedor=trim($registro["IDPROVEEDOR"]); 
$idproducto=trim($registro["IDPRODUCTO"]);
$idor=mysql_query("SELECT NOMBREPRODUCTO FROM PRODUCTOS where IDPRODUCTO='$idproducto'",$link) or die("La consulta no obtuvo filas");;
$nombreproducto= mysql_fetch_array($idor) or die("La consulta no obtuvo filas");
$productosporlote=$registro["PRODUCTOSXLOTE"] ;
$cantidadlotes=$registro["CANTIDADLOTES"] ;
$costoporlote=$registro["COSTOPORLOTE"] ;
$costounitario=$registro["COSTOUNITARIO"] ;


//echo $registro["COSTOUNITARIO"] ;

//$_SESSION['datos'][$_SESSION['contador']][0]=$correlativo;
$_SESSION['datos'][$_SESSION['contador']][1]=$idproducto['IDPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][2]=$nombreproducto['NOMBREPRODUCTO'];
$_SESSION['datos'][$_SESSION['contador']][3]=$cantidadlotes['CANTIDADLOTES'];;
$_SESSION['datos'][$_SESSION['contador']][4]=$costoporlote['COSTOPORLOTE'];;
$_SESSION['datos'][$_SESSION['contador']][5]=$productosporlote['PRODUCTOSXLOTE'];
$_SESSION['datos'][$_SESSION['contador']][6]=$costounitario['COSTOUNITARIO'];;



$_SESSION['datos'][$_SESSION['contador']][7]=$descrip['DESCRIPCION'];
$_SESSION['datos'][$_SESSION['contador']][8]=$iprov['IDPROVEEDOR'];


$_SESSION['contador']=$_SESSION['contador']+1;
//$correlativo=$correlativo+1;   
}// if

}// fin for


?>