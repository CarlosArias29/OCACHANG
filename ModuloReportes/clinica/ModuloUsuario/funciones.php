<?php 
include '../utilidades/seguridad.php';
//Cuantas filas debe de haber para que aparezca el scroll
$cantFilas=7;
$ban=0;
if(!isset($_SESSION['tipo'])){
	session_start();
}

$ban=$_SESSION['tipo'];


switch($ban){
	case 1:
	case 2:
	case 3:
	break;
	default:
		session_write_close();
		session_destroy();
		header("Location: ../index.php");
}


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


//Función mostrar usuario
function mostrarusuario(){
	//Inicializando
	$cont=TRUE;
	$salida = -1;
	
	//Verificamos si podemos continuar
	if($cont == TRUE){

		
		//Procedemos a ejecutar la consulta
		$sql='SELECT * FROM USUARIO WHERE IDUSUARIO !=\''.trim($_SESSION['usuario']).'\'  ORDER BY ROL';
		
		//WHERE IDUSUARIO !=\''.trim($_SESSION['usuario']).'\' 
			$result=mysql_query($sql);
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"] ){
				echo '<div style="height:300px;width:700px;overflow:scroll;">
				<Table border="0">';
			}else{
			  echo '<table border="0">';
			}
			
			//Procedemos a dibujar la tabla
			echo '
        <tr>
          <th width="110" scope="col" class="log">Id Usuario</th>
          <th width="215" scope="col" class="log">Nombre </th>
          <th width="165" scope="col" class="log">Tipo Usuario</th>
		  <th width="70"></th>
        </tr>';
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);

					echo '<tr>';
					echo '<td class="log">'.$fila['IDUSUARIO'].'</td>';
					echo '<td class="log">'.$fila['NOMBRE'].' '.$fila['APELLIDO'].'</td>';
					switch(trim($fila['ROL'])){
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
							$msg='Información erronea';
					}
					echo '<td  class="log" align="center">'.$msg.'</td>';
					echo '<td><input name="button" type="button" id="button" onclick="
					document.form1.modificado.value=\''.$fila['IDUSUARIO'].'\';
					document.form1.tipo.selectedIndex=\''.($fila['ROL']-1).'\';
					" value="Cargar" /></td>';
					echo '</tr>';
				}
			}
			$salida=1;
			echo '</table>';
			
			//Cerrando div
			if(@$num_result >= $GLOBALS["cantFilas"] )
				echo '</div>';

	}else{
		//No esta disponible esta funcion para el presente usuario
		$salida=0;
	}


	return $salida;
}//Fin de funcion mostrar usuarios


//Función muestra estado actual
function muestraestado(){
	//Inicializando
	$cont=TRUE;
	$salida = -1;
	
	//Verificamos si podemos continuar
	if($cont == TRUE){
		
		//Procedemos a ejecutar la consulta
		$sql='SELECT * FROM USUARIO WHERE IDUSUARIO !=\''.trim($_SESSION['usuario']).'\' ORDER BY ROL';
		
		//echo $sql;
			$result=mysql_query($sql);
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"] ){
				echo '<div style="height:300px;width:700px;overflow:scroll; " align="center">
				<Table border="0" align="center">';
			}else{
			  echo '<table border="0" align="center">';
			}
			
			//Procedemos a dibujar la tabla
			echo '
        <tr>
          <th width="110" scope="col" class="log">Id Usuario</th>
          <th width="215" scope="col" class="log">Nombre </th>
          <th width="110" scope="col" class="log">Tipo Usuario</th>
		  <th width="71" scope="col"  class="log">Estado</th>
		  <th></th>
		  
        </tr>';
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);

					echo '<tr>';
					echo '<td  class="log">'.$fila['IDUSUARIO'].'</td>';
					echo '<td  class="log">'.$fila['NOMBRE'].' '.$fila['APELLIDO'].'</td>';
					echo '<td class="log">'.tipoUser(trim($fila['ROL'])).'</td>';
					switch(trim($fila['ESTADO'])){
						case 1:
							$msg='Habilitado';
							break;
						default:
							$msg='Deshabilitado';
					}
					echo '<td  class="log">'.$msg.'</td>';
					echo '<div align="center" width="100" ><td align=\"center\">';
					echo '<input name="button" type="button" id="button" onclick="
					document.form1.idusuario.value=\''.$fila['IDUSUARIO'].'\';
					cambiarEstado();
					" value="Cambiar estado" />';

//					echo "<a href=\"cambiaestado.php?idproducto=$idproducto\"><p class=\"lista\">Cambiar estado</p></a>";	
					echo '<td></div>';
					echo '</tr>';
				}
			}
			$salida=1;
			echo '</table>';
			
			//Cerrando div
			if(@$num_result >= $GLOBALS["cantFilas"] )
				echo '</div>';

		
	}else{
		//No esta disponible esta funcion para el presente usuario
		$salida=0;
	}


	return $salida;
}



//Funcion insertar usuario
function insertarusuario(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['nom'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$nId = trim($_POST['nId']);
		$nom = trim($_POST['nom']);
		$apell=trim($_POST['apell']);
		$fecha=trim($_POST['fecha']);
		$pass= trim($_POST['pass']);
		$tipo= trim($_POST['tipo']);
		
		//colocandolo al formato correcto
		$fecha = date("Y-m-d", strtotime($fecha));

		//Verificamos si los campos no validados no estan vacios
		if(!empty($nom) and !empty($apell)and !empty($nId)and !empty($fecha)and !empty($pass)){
			$salida=2;
			//Procedemos a cifrar el password
			$pass=md5($_POST['pass']);
			//Iniciamos conexion
			if(iniciarconexion()==1){
				//Sentencia sql
				$query ="SELECT IDUSUARIO FROM USUARIO WHERE IDUSUARIO='$nId'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				//Si no existe un registro con esas credenciales...
				if( !$fila=mysql_fetch_array($result)){
					$query = "INSERT INTO USUARIO (IDUSUARIO, NOMBRE, APELLIDO, FECHANACIMIENTO, PASS, ROL) VALUES ('$nId','$nom','$apell','$fecha','$pass','$tipo')";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());

					//Eliminamos datos sensibles
					unset($pass);
					//Si se ejecuto correctamente...
					if($result){
						
						//Ejecutamos modulo de seguridad 
						seguridad($_SESSION['usuario'],$_SESSION['tipo'],'Insertamos usuario '.$nId);
						$salida=1;
						$query = "INSERT INTO ADMINISTRADOR (IDUSUARIO) VALUES ('$nId')";
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
						$query = "INSERT INTO SUPERVISOR (IDUSUARIO) VALUES ('$nId')"; 
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
						$query = "INSERT INTO ENCARGADOINVENTARIO (IDUSUARIO) VALUES ('$nId')";
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
						$tabla='';
						//Habilitamos el usuario que requerimos
						switch($tipo){
							case 1:
								$tabla='ADMINISTRADOR';
								break;
							case 2:
								$tabla='SUPERVISOR';
								break;
							case 3:
								$tabla='ENCARGADOINVENTARIO';
								break;
						}
						$query = "UPDATE $tabla SET ESTADO='1'  WHERE IDUSUARIO= '$nId';";
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
					}
				}else{
					//Ya existe un usuario...
					return 3;
				}
			}
			
		}else{
			//Hacemos que regrese a la pagina porque no estan completos
//			header("Location: usuarionuevo.php");
			$salida=0;
		}
	}else{
		//Si no se han inicializado es porque no hay campos
		$salida=0;
	}
	return $salida;
}//Fin de insertar usuario



//funcion actualizar
function actualizarusuario(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['modificado']) ){
		//Como ya estan declaradas, procedemos a inicializar variables
		$id=trim($_POST['modificado']);
		$tipo=trim($_POST['tipo']);
		
		
		//Verificamos si los campos no validados no estan vacios
		if(!empty($id) ){
			$salida=2;
			//mysql_close();
			//Iniciamos conexion
//			if(iniciarconexion()==1){
				//Sentencia sql
				$query ="SELECT IDUSUARIO FROM USUARIO WHERE IDUSUARIO='$id'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				
				//Si existe registro con esas credenciales...
				if( mysql_fetch_row($result) > 0){

					$query = "UPDATE USUARIO SET ROL='$tipo' WHERE IDUSUARIO= '$id'"; 
					$result=mysql_query($query) or die("Error en:  " . mysql_error());
					
						
					//Deshabilitando usuarios
					deshabilita($id);

					//Cambiamos Rol
					$tabla='';
					switch($tipo){
						case 1:
							$tabla='ADMINISTRADOR ';
							break;
						case 2:
							$tabla='SUPERVISOR';
							break;
						case 3:
							$tabla='ENCARGADOINVENTARIO';
							break;
					}
					$query = "UPDATE $tabla SET ESTADO='1' WHERE IDUSUARIO= '$id';";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());
					
					
						
					//Ejecutamos modulo de seguridad 

					seguridad($_SESSION['usuario'],$_SESSION['tipo'],'Actualizamos usuario '.$id.' a usuario tipo '.$tabla);
					
					
					//Si se ejecuto correctamente...
					if($result){
						$salida=1;
					}
				}else{
					//Ya existe un usuario...
					$salida= 3;
				}
//			}
			
		}else{
			//Hacemos que regrese a la pagina porque no estan completos
//			header("Location: usuarionuevo.php");
			$salida=0;
		}
	}else{
		//Si no se han inicializado es porque no hay campos
		$salida=0;
	}
	//Actualizando
	mostrarusuario();
	
	return $salida;
}//Fin de la funcion actualizar usuario



//Función que sustituye la eliminacion de informacion de usuarios
function bajausuario(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['variable'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$id=trim($_POST['variable']);
		$tipo=trim($_POST['tipo']);
		
		//Verificamos si los campos no validados no estan vacios
		if(!empty($id) ){
			$salida=2;
			//Sentencia sql
			$query ="SELECT IDUSUARIO FROM USUARIO WHERE IDUSUARIO='$id'";
			$result=mysql_query($query) or die("Error en:  " . mysql_error());
			
			//Si no existe un registro con esas credenciales...
			if( mysql_fetch_row($result) > 0){
				$query = "UPDATE USUARIO SET ESTADO='$tipo' WHERE IDUSUARIO= '$id'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				//Si se ejecuto correctamente...
				if($result){
					$salida=1;
					
					//Seguridad
					$msg='';
					seguridad($_SESSION['usuario'],$_SESSION['tipo'],$msg);

					//Deshabilitamos antes de habilitar un usuario
					deshabilita($id);
					if($tipo!=0){
						//Buscamos el ROL del usuario para habilitarlo
						$query ="SELECT ROL FROM USUARIO WHERE IDUSUARIO='$id'";
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
						//****************************
						
						$fila=mysql_fetch_array($result);
					//Cambiamos Rol
					switch(trim($fila['ROL'])){
						case 1:
							$tabla='ADMINISTRADOR ';
							break;
						case 2:
							$tabla='SUPERVISOR';
							break;
						case 3:
							$tabla='ENCARGADOINVENTARIO';
							break;
					}
					$query = "UPDATE $tabla SET ESTADO='1' WHERE IDUSUARIO= '$id';";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());
					echo 'hay almacenamiento s';
					
						
						//****************************
					}
				}
			}else{
				//Ya existe un usuario...
				$salida=3;
			}
		}else{
			//Hacemos que regrese a la pagina porque no estan completos
			$salida=0;
		}
	}else{
		//Si no se han inicializado es porque no hay campos
		$salida=0;
	}
	//Actualizando informacion
	muestraestado();
	
	return $salida;
}//Fin de baja de usuarios



//Metodo que devuelve cual es el tipo de usuario
function tipoUser($tipo){

	switch(trim($tipo)){
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
			$msg='Información errónea';
	}
	
	return $msg;
}//Fin de tipo de usuario

//funcion que busca los usuarios existentes
function controlusuario(){
	$query =0;
	
	
	
		if(isset($_POST['fechaIni'])){
			$fecha1=trim($_POST['fechaIni']);
			$fecha2=trim($_POST['fechaFin']);
			if(strlen($fecha1)!=0 && strlen($fecha2)!=0 ){
			//Inicializamos las variables
			$idusuario=$_POST['idusuario'];
			$fechaini=date("Y-m-d", strtotime(str_replace('/','-',$fecha1)));
			$fechafin=date("Y-m-d", strtotime(str_replace('/','-',$fecha2)));
			
			
			if(strtotime($fechaini)>strtotime($fechafin)){
				$aux=$fechafin;
				$fechafin =  $fechaini;
				$fechaini=$aux;
			}
			
			//Buscamos todos los datos que necesitamos del control de usuarios
			$query ="SELECT * FROM BITACORA WHERE IDUSUARIO='$idusuario' AND FECHAULTIMAMODIFICACION BETWEEN '$fechaini' AND '$fechafin'";
			
			$result=mysql_query($query) or die("Error en:  " . mysql_error());
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"] ){
				echo '<div style="height:300px;width:700px;overflow:scroll;">
				<Table border="0">';
			}else{
			  echo '<Table border="0">';
			}
			
			//Procedemos a dibujar la tabla
			echo '<tr>
			 <caption class="log">
          Información de '.date("d-m-Y", strtotime($fechaini)).' hasta '.date("d-m-Y", strtotime($fechafin)).'
          </caption>
          <th width="70" scope="col" class="log">Id Usuario</th>
          <th width="515" scope="col" class="log">Evento</th>
          <th width="71" scope="col" class="log">Fecha de última Modificación</th>
        </tr>';
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);
					echo '<tr>';
					echo '<td class="log">'.$fila['IDUSUARIO'].'</td>';
					echo '<td class="log">'.$fila['EVENTO'].'</td>';
					echo '<td class="log">'.$fila['FECHAULTIMAMODIFICACION'].'</td>';
					echo '</tr>';
				}
			}
			$salida=1;
			
		echo '</table></div>';
		//Cerrando div
			if(@$num_result >= $GLOBALS["cantFilas"] )
				echo '</div>';}
		}
}



//Función que carga un combobox
function idCombobox(){
	$i=0;
	//Sentencia sql
	$query ="SELECT DISTINCT IDUSUARIO FROM USUARIO ORDER BY IDUSUARIO";

	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	
	//Mientras exista resultados
		while( $fila=mysql_fetch_array($result) ){
			$i++;
			echo '<option value="'.$fila['IDUSUARIO'].'">'.$fila['IDUSUARIO'].'</option>';
		}
		if($i==0){
			//echo "<script>window.history.back();<script>"; 
		}
}//Fin de idCombobox

//Destinada para deshabilitar masivamento todos los usuarios
function deshabilita($id){
	//Deshabilitamos todos los tipos de usuarios
	$query = "UPDATE ADMINISTRADOR SET ESTADO='0' WHERE IDUSUARIO= '$id'";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	$query = "UPDATE SUPERVISOR SET ESTADO='0' WHERE IDUSUARIO= '$id'";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	$query = "UPDATE ENCARGADOINVENTARIO SET ESTADO='0' WHERE IDUSUARIO= '$id';";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
					
	}//Fin de deshabilita usuarios




?>