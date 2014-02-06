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
if(isset($_GET['idusuario'])){
	//Como ya estan declaradas, procedemos a inicializar variables
	$idusuario = trim($_GET['idusuario']);
	$estado=1;
	$sql="SELECT ESTADO FROM USUARIO WHERE IDUSUARIO='$idusuario'";
	$result=mysql_query($sql);
	if($fila=mysql_fetch_array($result)){
		$val=(int)trim($fila['ESTADO']);
		//Mensaje  para habilitar usuario
		$msj='Se habilito el usuario '.$idusuario.' en el sistema correctamente.';
		//Si esta habilitado, se procede a deshabilitar
		if($val==1){
			$estado=0;
			$msj='Se deshabilito el usuario '.$idusuario.' en el sistema correctamente.';
		}
		$sql="UPDATE USUARIO SET ESTADO=$estado WHERE IDUSUARIO='$idusuario'";
		$result=mysql_query($sql);
		
		echo '<input name="estado" type="hidden" id="estado" value="'.$estado.'">';
		
	}
}
header("Location: usuariobaja.php");



?>