<?php
	//Ejemplo usando ajax y jquery

	$nombre = substr (trim($_POST['valorCaja1']),0,1);
	$apellido = substr (trim($_POST['valorCaja2']),0,1);	
	//nIdUser();
	
	$resultado = 'USER_'.$nombre.$apellido ;
	if(strlen($nombre)==0 || strlen($apellido)==0){
		$resultado = $resultado.$nombre.$apellido ;
	}
	//Iniciamos conexion
	iniciarconexion();
	//Procedemos a realizar la operación
	echo strtoupper(nIdUser($resultado));
	

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
	
	
//Funcion que devuelve nuevo IdProveedor
function nIdUser($id){
	//USER_NA001
	$salida=trim($id).'001';
	$query ="SELECT MAX(IDUSUARIO) FROM USUARIO WHERE IDUSUARIO LIKE '".$id."%' ";

	$result=mysql_query($query) or die("Error en: " . mysql_error());
	
	//Mientras exista resultados
		if( $fila=mysql_fetch_array($result) ){
			$salida= $id.formatoNum($fila['MAX(IDUSUARIO)']);
		}
	return $salida;
}//fin de nuevo id proveedor



//Formato para numero destinado a IDPRODUCTO
function formatoNum($str){
	$str = (string)((int)substr(trim($str),3)+1);
	$i=strlen($str);
	while($i<3){
		$str='0'.$str;
		$i++;
	}
	return trim($str);
}

?>

