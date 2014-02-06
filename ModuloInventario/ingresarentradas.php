<?php
session_start();
include ('../utilidades/config.php'); 
if($_POST['accion2']=="") {
$_SESSION['contador']=0;
}

if($_POST['accion2']=="Confirmar") {
//if(strcmp( $_POST['accion2'],"Confirmar")==0) {
echo "alert('entro al archivo de ingresarentradas!!!!!!!!')";

$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexions
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 
	
for ($i=0;$i<$_SESSION['contador'];$i++){
		for ($c=0;$c<=6;$c++){

$M[$i][$c]=$_SESSION['datos'][$i][$c];
}//fin contador columnas

$correlativo=$M[$i][0];
$idtransaccion=$_POST['idtransaccion'];
$idproveedor=$_POST['idproveedor'];
$idbodega=1;
//$idproducto=$_POST['idproducto'];
$idusuario=$_SESSION['usuario'];
$descripcion=$_POST['descripcion'];
$fechaingresoinventario=$_POST['fechaingresoinventario'];



echo "<script language='javascript'>"; 
echo "alert('".$_POST['accion2']."')"; 
echo "</script>";  
$consulta="insert into INVENTARIO (CORRELATIVO,IDTRANSACCION,IDPROVEEDOR,IDBODEGA,IDPRODUCTO,IDUSUARIO,NOMBREPRODUCTO,CANTIDADPRODUCTOXLOTE,CANTIDADLOTES,COSTOXLOTE,COSTOUNITARIOREGISTRADO,DESCRIPCION,FECHAINGRESOINVENTARIO) values ('$M[$i][0]','$idtransaccion','$idproveedor','1','$M[$i][1]','$idusuario','$M[$i][2]','$M[$i][5]','$M[$i][3]','$M[$i][4]','$M[$i][6]','$descripcion','$fechaingresoinventario')";
echo $consulta;

//mysql_query("insert into inventario (CORRELATIVO,IDTRANSACCION,IDPROVEEDOR,IDBODEGA,IDPRODUCTO,IDUSUARIO,NOMBREPRODUCTO,CANTIDADPRODUCTOXLOTE,CANTIDADLOTES,COSTOXLOTE,COSTOUNITARIOREGISTRADO,DESCRIPCION,FECHAINGRESOINVENTARIO) values ('$M[$i][0]','$idtransaccion','$idproveedor','1','$M[$i][1]','$idusuario','$M[$i][2]','$M[$i][5]','$M[$i][3]','$M[$i][4]','$M[$i][6]','$descripcion','$fechaingresoinventario')", $link);


//$exresult=$mysql_query("select existencias from productos where idproducto='$M[$i][1]' ",$link);
//$ex1=mysql_fetch_array($exresult) or die("La consulta no obtuvo filas");
//$ex2=$M[$i][3];
//$existenciastotales=$ex1+$ex2;
//mysql_query("insert  into productos  where idproducto='$M[$i][1]' values($existenciastotales)",$link);


}//fin contador filas
}//fin if
echo 'Variable= '.$_POST['accion'];
?>