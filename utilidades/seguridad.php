<?php 
//A cargo de la seguridad del sistema

//Ingresamos evento a la bitacora
function seguridad($nombre, $tipoUser,$msg){
	
	//si esta definida la variable
	if(isset($nombre)){
		//Procedemos a ejecutar la consulta
		$rol=rolUsuario($tipoUser);
		$log='Tipo: '.$rol.', '.$msg;

		$sql="INSERT INTO BITACORA (IDUSUARIO,EVENTO) VALUES ('$nombre','$log' )";
		$result=mysql_query($sql);
	}

}


function rolUsuario($tipo){
	switch($tipo){
		case 1:
			$msg='Administrador';
			break;
		case 2:
			$msg='Supervisor';
			break;
		case 3:
			$msg='Encargado de Inventario';
			break;
		default:
			$msg='No habilitado';
	}
	return $msg;
}

?>