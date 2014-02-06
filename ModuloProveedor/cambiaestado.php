<?php 

iniciarconexion();

function iniciarconexion(){
	$result=0;
	//Como ya estan declaradas, procedemos a inicializar variables
	include ('../utilidades/config.php'); 
	
	//Procedemos a establecer conexion
	if(($link=mysql_connect(DB_SERVER,DB_USER,DB_PASS))){
		mysql_select_db(DB_NAME,$link);//Seleccionamos base de datos
		$result=1;
	}else{//No se abrio la base de datos...
		header("Location: ../utilidades/error_conexion.php");
	}
	
	return $result;
}//Fin de la funcion iniciar conexion


	
//Verificamos la existencia de las variables.
if(isset($_GET['idproveedor'])){
	//Como ya estan declaradas, procedemos a inicializar variables
	$idproveedor = trim($_GET['idproveedor']);
	$estado=1;
	$sql="SELECT ESTADO FROM PROVEEDOR WHERE IDPROVEEDOR='$idproveedor'";
	$result=mysql_query($sql);
	if($fila=mysql_fetch_array($result)){
		$val=(int)trim($fila['ESTADO']);
		if($val==1){
			$estado=0;
		}
		$sql="UPDATE PROVEEDOR SET ESTADO=$estado WHERE IDPROVEEDOR='$idproveedor'";
		$result=mysql_query($sql);
	}
}
header("Location: proveedorbaja.php");

?>