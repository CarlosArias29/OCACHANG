
<?php

function nomUsuario($iduser){
	$query = "SELECT * FROM USUARIO WHERE IDUSUARIO='$iduser'";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	if( $fila=mysql_fetch_array($result)){
		return $fila['NOMBRE'].' '.$fila['APELLIDO'];
	}
}


function verificaPass(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['user'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		include ('config.php'); 
		$user=trim($_POST['user']);
		$pass=trim($_POST['pass']);

		//Verificamos si los campos no estan vacios
		if(!empty($user) and !empty($pass)){
			//Procedemos a cifrar el password
			$pass=md5($_POST['pass']);
			
			//Procedemos a establecer conexion
			if(($link=mysql_connect(DB_SERVER,DB_USER,DB_PASS))){
				mysql_select_db(DB_NAME,$link);//Seleccionamos base de datos
				
				//Realizamos una breve busqueda
				 inicializando();
				//Sentencia sql. Verificamos si existe ese usuario
				$query = "SELECT ROL FROM USUARIO WHERE IDUSUARIO='$user'  AND PASS='$pass'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());

				//Eliminamos datos sensibles
				unset($pass);
//*******************************************************************
				//Si hay usuario ccon esas credenciales, entonces...
				if( mysql_fetch_row($result) > 0){
					$query = "SELECT ROL FROM USUARIO WHERE IDUSUARIO='$user' and ESTADO = '1' ";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());
					//Si se ejecuto correctamente...
					//Si hay datos
					while( $fila=mysql_fetch_array($result)){
						return $fila['ROL'];
					}
					return -3;
				}
//*******************************************************************
				
				return 0;//Credenciales invalidas
				

			}else{//No se abrio la base de datos...
			echo '';
//				header("Location: utilidades/error_conexion.php");
			}
		}else{
			//No hacemos nada ya que hay campos vacios
			return -1;//Significa que hay campos en blanco
		}
	}else{
		//Si no estan creadas las variables no hace nada
		return -2;	//Significa que no se ha ejecutado el login
	}
}

function inicializando(){
	//Verificamos si existe...
	$query = "SELECT * FROM USUARIO WHERE IDUSUARIO='A1'";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());

	//Si no existe lo insertamos
	if( mysql_fetch_row($result)<=0){
		$query="INSERT INTO USUARIO (IDUSUARIO, NOMBRE, APELLIDO, FECHANACIMIENTO, PASS, ROL) 
		VALUES ('A1','Juan','Perez','1989-12-25','21232f297a57a5a743894a0e4a801fc3','1')";
		$result=mysql_query($query) or die("Error en:  " . mysql_error());
		//Insertamos en las tres tablas dependientes
		$query="INSERT INTO ADMINISTRADOR (IDUSUARIO, ESTADO) VALUES ('A1','1')";
		$result=mysql_query($query) or die("Error en:  " . mysql_error());
		$query="INSERT INTO ENCARGADOINVENTARIO (IDUSUARIO, ESTADO) VALUES ('A1','0')";;
		$result=mysql_query($query) or die("Error en:  " . mysql_error());
		$query="INSERT INTO SUPERVISOR (IDUSUARIO, ESTADO) VALUES ('A1','0')";
		$result=mysql_query($query) or die("Error en:  " . mysql_error());
		
		$sql="INSERT INTO BITACORA (IDUSUARIO,EVENTO) VALUES ('A1','System: Creación de primer usuario' )";
		$result=mysql_query($sql);
	}
}

?>