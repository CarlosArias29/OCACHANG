<?php 
//Iniciamos sesion
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
		$sql='SELECT * FROM PROVEEDOR ORDER BY IDPROVEEDOR';
			$result=mysql_query($sql);
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"] ){
				echo '<div style="height:300px;width:500px;overflow:scroll;">
				<Table border="0">';
			}else{
			  echo '<table border="0">';
			}
			
			
			//Procedemos a dibujar la tabla
			echo '<tr>
          <th width="80" scope="col" class="log"> Id Proveedor </th>
          <th width="350" scope="col" class="log">Nombre de la Empresa</th>
		  <th width="70"></th>
			
        </tr>';

			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);
					//Almacenandolo en variables
					$idproveedor=$fila['IDPROVEEDOR'];
					$nom=$fila['NOMBREEMPRESA'];
					$direccion=$fila['DIRECCION'];
					$telefono=$fila['TELEFONO'];
					$correo=$fila['EMAIL'];
					$descrip=$fila['DESCRIPCION'];

					//Imprimiendolo en la tabla
					echo '<tr>';
					echo '<td><p class = \'log\'>'.$idproveedor.'</p></td>';
					echo '<td><p class = \'log\'>'.$fila['NOMBREEMPRESA'].'</p></td>';
					echo '<td><input name="button" type="button" id="button" onclick="
					document.form1.idproveedor.value=\''.$idproveedor.'\';
					document.form1.nom.value=\''.$nom.'\';
					document.form1.direccion.value=\''.$direccion.'\';
					document.form1.tel.value=\''.$telefono.'\';
					document.form1.email.value=\''.$correo.'\';
					document.form1.descripcion.value=\''.$descrip.'\';
					" value="Cargar" /></td>';

					echo '</tr>';
//					echo '<br> '.$idproveedor.'<br>'.$nom.'<br>'.$direccion.'<br>'.$telefono.'<br>'.$correo.'<br>'.$descrip.'<br><br>';
				}
			}
			$salida=1;
			echo '</table>';
			//colocando div
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
		$sql='SELECT * FROM PROVEEDOR ORDER BY IDPROVEEDOR';
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
			echo '<tr>
		  <th width="80" scope="col" class="log">Estado</th>
          <th width="125" scope="col" class="log">id Proveedor</th>
          <th width="520" scope="col" class="log">Nombre de la Empresa</th>
		  
		  <th width="71" scope="col"></th>
		  
		  
        </tr>';
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);
					$idproveedor=$fila['IDPROVEEDOR'];
					echo '<tr>';
					echo '<td><p class = \'log\'>'.msgEstado($fila['ESTADO']).'</p></td>';
					echo '<td><p class = \'log\'>'.$idproveedor.'</p></td>';
					echo '<td><p class = \'log\'>'.$fila['NOMBREEMPRESA'].'</p></td>';
					
					echo '<td><input name="button" type="button" id="button" onclick="document.form1.idproveedor.value=\''.$idproveedor.'\';cambiarEstado();" value="Cambiar estado" /></td>';

					echo '</tr>';
				}
			}
			$salida=1;
			echo '</table>';
			
			//colocando div
			if(@$num_result >= $GLOBALS["cantFilas"] )
				echo '</div>';

		
	}else{
		//No esta disponible esta funcion para el presente usuario
		$salida=0;
	}


	return $salida;
}



//Funcion insertar usuario
function insertarproveedor(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['nom'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$idproveedor = trim($_POST['idproveedor']);
		$idU = trim($_SESSION['usuario']);
		$nom = trim($_POST['nom']);
		$direccion = trim($_POST['direccion']);
		$tel = trim($_POST['telefono']);
		$email = trim($_POST['email']);
		$descrip = trim($_POST['descripcion']);
//		$fecha=date("Y-m-d H:i:s");

		//Verificamos si los campos no validados no estan vacios
		if(!empty($idproveedor) and !empty($idU)and !empty($nom)and !empty($direccion)and !empty($tel)and !empty($email) and !empty($descrip) ){
			$salida=2;
			//Iniciamos conexion
//			if(iniciarconexion()==1){
				//Sentencia sql
				$query ="SELECT IDPROVEEDOR FROM PROVEEDOR WHERE IDPROVEEDOR='$idproveedor'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				//Si no existe un registro con ese id...
				if( $fila=mysql_fetch_row($result)<=0){
					$query = "INSERT INTO PROVEEDOR (IDPROVEEDOR,IDUSUARIO,NOMBREEMPRESA,DIRECCION,TELEFONO,EMAIL,DESCRIPCION,FECHAINGRESO) 
					VALUES ('$idproveedor','$idU','$nom','$direccion','$tel','$email','$descrip',CURRENT_TIMESTAMP())";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());

					//Si se ejecuto correctamente...
					if($result){
						$salida=1;
					}
				}else{
					//Ya existe un usuario...
					$salida = 3;
				}
//			}
			
		}else{
			//Hacemos que regrese a la pagina porque no estan completos
//			header("Location: usuarionuevo.php");
			$salida=-1;
		}
	}else{
		//Si no se han inicializado es porque no hay campos
		$salida=0;
	}
	return $salida;
}//Fin de insertar usuario



//funcion actualizar
function actualizarproveedor(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['nom'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$idprov=trim($_POST['idproveedor']);
		$iduser=trim($_SESSION['usuario']);
		$nom=trim($_POST['nom']);
		$direccion=trim($_POST['direccion']);
		$tel=trim($_POST['tel']);
		$email=trim($_POST['email']);
		$descrip=trim($_POST['descripcion']);
		
		
		//Verificamos si los campos no validados no estan vacios
//		if(!empty($idprov) and !empty($iduser) and !empty($nom) and !empty($direccion) and !empty($tel) and !empty($email) and !empty($descrip) ){
		$salida=2;
		
			//Iniciamos conexion
//			if(iniciarconexion()==1){
				//Sentencia sql
		$query ="SELECT IDUSUARIO FROM PROVEEDOR WHERE IDPROVEEDOR='$idprov'";
		$result=mysql_query($query) or die("Error en:  " . mysql_error());
				
		//Si  existe ese registro...
		if( mysql_fetch_row($result) > 0){
			$query = "UPDATE PROVEEDOR SET IDUSUARIO='$iduser' WHERE IDPROVEEDOR = '$idprov'";
			$result=mysql_query($query) or die("Error en:  " . mysql_error());
			
			//Si el campo nombre no esta vacio...
			if(!empty($nom)){
				$query = "UPDATE PROVEEDOR SET NOMBREEMPRESA='$nom' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
		
			//Si direccion se ingreso
			if(!empty($direccion)){
				$query = "UPDATE PROVEEDOR SET DIRECCION='$direccion' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
			
			//Si el campo telefono no esta vacio
			if(!empty($tel)){
				$query = "UPDATE PROVEEDOR SET TELEFONO='$tel' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
			
			//Si el campo telefono no esta vacio
			if(!empty($tel)){
				$query = "UPDATE PROVEEDOR SET TELEFONO='$tel' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
		
			//El numero de telefono se ingreso
			if(!empty($direccion)){
				$query = "UPDATE PROVEEDOR SET EMAIL='$email' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
			
			//El numero de telefono se ingreso
			if(!empty($descrip)){
				$query = "UPDATE PROVEEDOR SET DESCRIPCION='$descrip' WHERE IDPROVEEDOR = '$idprov'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
			}
			//Si se ejecuto correctamente...
			if($result){
				$salida=1;
			}
		}else{
			//No existe ese Proveedor...
			return 3;
		}
//			}
			
//		}else{
			//Hacemos que regrese a la pagina porque no estan completos
//			header("Location: usuarionuevo.php");
//			$salida=0;
//		}
	}else{
		//Si no se han inicializado es porque no hay campos
		$salida=0;
	}
	//Actualizando
	
	
	return $salida;
}//Fin de la funcion actualizar usuario



//Función que sustituye la eliminacion de informacion de usuarios
function bajaProveedor(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['variable'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$id=trim($_POST['variable']);
		$tipo=trim($_POST['tipo']);
		
		//Verificamos si los campos no validados no estan vacios
		if(!empty($id) ){
			$salida=2;
			//Sentencia sql
			$query ="SELECT IDUSUARIO FROM PROVEEDOR WHERE IDPROVEEDOR='$id'";
			$result=mysql_query($query) or die("Error en:  " . mysql_error());
			
			//Si no existe un registro con esas credenciales...
			if( mysql_fetch_row($result) > 0){
				$query = "UPDATE PROVEEDOR SET ESTADO='$tipo' WHERE IDPROVEEDOR= '$id'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				//Si se ejecuto correctamente...
				if($result){
					$salida=1;
				}
			}else{
				//Ya existe un usuario...
				return 3;
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




//Función que carga un combobox
function idCombobox(){
	$i=0;
	//Sentencia sql
	$query ="SELECT DISTINCT IDUSUARIO FROM SUPERVISOR WHERE ESTADO=1 ORDER BY IDUSUARIO";

	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	
	//Mientras exista resultados
		while( $fila=mysql_fetch_array($result) ){
			$i++;
			echo '<option value="'.$fila['IDUSUARIO'].'">'.$fila['IDUSUARIO'].'</option>';
		}
		if($i==0){
			echo "<script>window.history.back();<script>"; 
		}
}//Fin de idCombobox



//Función que carga un combobox
function idCombobox2(){
	$i=0;
	//Sentencia sql
	$query ="SELECT DISTINCT IDPROVEEDOR FROM PROVEEDOR WHERE ESTADO=1 ORDER BY IDUSUARIO";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	
	//Mientras exista resultados
		while( $fila=mysql_fetch_array($result) ){
			$i++;
			echo '<option value="'.$fila['IDPROVEEDOR'].'">'.$fila['IDPROVEEDOR'].'</option>';
		}
		if($i==0){
			echo "<script>window.history.back();<script>"; 
		}
}//Fin de idCombobox


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
}//Fin del metodo tipoUser


//Metodo que devuelve cual es el tipo de usuario
function msgEstado($tipo){

	switch(trim($tipo)){
		case 1:
			$msg='Habilitado';
			break;
		default:
			$msg='Deshabilitado';
	}
	
	return $msg;
}



//Funcion que devuelve nuevo IdProveedor
function nIdprov(){
	$salida='PRV0000001';
	$query ="SELECT MAX(IDPROVEEDOR) FROM PROVEEDOR";

	$result=mysql_query($query) or die("Error en: " . mysql_error());
	
	//Mientras exista resultados
		if( $fila=mysql_fetch_array($result) ){
			$salida= 'PRV'.formatoNum($fila['MAX(IDPROVEEDOR)']);
		}
	return $salida;
}//fin de nuevo id proveedor



//Formato para numero destinado a IDPRODUCTO
function formatoNum($str){
	$str = (string)((int)substr(trim($str),3)+1);
	for($i=strlen($str);$i<7;$i++){
		$str='0'.$str;
	}
	return trim($str);
}

?>