<?php 
//Cuantas filas debe de haber para que aparezca el scroll
$cantFilas=10;
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
		header("Location: ../index.php");//*/
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
		$sql='SELECT * FROM PRODUCTOS ORDER BY IDPRODUCTO';
			$result=mysql_query($sql);
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"] ){
				echo '<div style="height:300px;width:485px;overflow:scroll;">
				<Table border="0">';
			}else{
			  echo '<table border="0">';
			}
		  echo '
        <tr>
		  <th width="85" scope="col"><p class = \'log\'>Estado</p></th>
          <th width="85" scope="col"><p class = \'log\' >id Producto<p></th>
          <th width="100" scope="col"><p class = \'log\' >id Supervisor<p></th>
          <th width="175" scope="col"><p class = \'log\' >Nombre del Producto<p></th>
        </tr>';
			//echo '<br>Número de registros: '.$num_result;
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);
					$idproducto=$fila['IDPRODUCTO'];
					$nombre=$fila['NOMBREPRODUCTO'];
					echo '<tr align="center">';
					echo '<td align="center"><p class = \'log\'>'.msgEstado($fila['ESTADO']).'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$idproducto.'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$fila['IDUSUARIO'].'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$fila['NOMBREPRODUCTO'].'</p></td>';
					
					
					echo '<div align="center" width="100" ><td align="center">';
					echo '<input name="button" type="button" id="button" onclick="document.form1.nom.value=\''.$nombre.'\';document.form1.idproducto.value=\''.$idproducto.'\'" value="Cargar" />';

					echo '</div>';
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
	//Cuantas filas debe de haber para que aparezca el scroll

	$cont=TRUE;
	$salida = -1;
	
	//Verificamos si podemos continuar
	if($cont == TRUE){
		
		//Procedemos a ejecutar la consulta
		$sql='SELECT * FROM PRODUCTOS ORDER BY IDUSUARIO';
			$result=mysql_query($sql);
			@$num_result = mysql_num_rows($result);
			
			//Procedemos a dibujar la tabla
			if(@$num_result>= $GLOBALS["cantFilas"]){
				echo '<div style="height:300px;width:700px;overflow:scroll;">
			<table border="0">';
			} else{
				echo '<table border="0">';
			}
			  
		  echo '
        <tr>
		  <th width="71" scope="col"><p class = \'log\'>Estado</p></th>
          <th width="80" scope="col"><p class = \'log\'>id Producto</p></th>
          <th width="125" scope="col"><p class = \'log\'>id Supervisor</p></th>
          <th width="215" scope="col"><p class = \'log\'>Nombre del Producto</p></th>
		  <th></th>
        </tr>';
			//verificamos si hay registros
			if( $num_result >= 1){
				$i=0;
				for($i=0; $i <$num_result; $i++){
					$fila=mysql_fetch_array($result);
					$idproducto=$fila['IDPRODUCTO'];
					echo '<tr>';
					echo '<td align="center"><p class = \'log\'>'.msgEstado($fila['ESTADO']).'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$idproducto.'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$fila['IDUSUARIO'].'</p></td>';
					echo '<td align="center"><p class = \'log\'>'.$fila['NOMBREPRODUCTO'].'</p></td>';
					echo '<div align="center" width="100" ><td align=\"center\">';
					echo '<input name="button" type="button" id="button" onclick="
					document.form1.idproducto.value=\''.$idproducto.'\';
					cambiarEstado();
					" value="Cambiar estado" />';

//					echo "<a href=\"cambiaestado.php?idproducto=$idproducto\"><p class=\"lista\">Cambiar estado</p></a>";	
					echo '<td></div>';
					echo '</tr>';
				}
			}
			$salida=1;
			echo '</table>';
			if(@$num_result>= $GLOBALS["cantFilas"] )
				echo '</div>';
		
	}else{
		//No esta disponible esta funcion para el presente usuario
		$salida=0;
	}


	return $salida;
}



//Funcion insertar producto
function insertarproducto(){
	
	//Verificamos la existencia de las variables.
	if(isset($_POST['nom'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$idproducto = trim($_POST['idproducto']);
		$idU = trim($_SESSION['usuario']);
		//$idU = trim($_POST['idusuario']);
		$nom = trim($_POST['nom']);

		//Verificamos si los campos no validados no estan vacios
		if(!empty($idproducto) and !empty($idU)and !empty($nom)){
			$salida=2;
			//Iniciamos conexion
//			if(iniciarconexion()==1){
				//Sentencia sql
				$query ="SELECT IDPRODUCTO FROM PRODUCTOS WHERE IDPRODUCTO ='$idproducto'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				//Si no existe un registro con ese id...
				if( $fila=mysql_fetch_row($result)<=0){
					$query = "INSERT INTO PRODUCTOS (IDPRODUCTO,IDUSUARIO,NOMBREPRODUCTO) 
					VALUES ('$idproducto','$idU','$nom')";
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
function actualizarproducto(){

	//Verificamos la existencia de las variables.
	if(isset($_POST['nom'])){
		//Como ya estan declaradas, procedemos a inicializar variables
		$idprod = trim($_POST['idproducto']);
		$idsupervisor = trim($_SESSION['usuario']);
		$nom = trim($_POST['nom']);
		
		//Verificamos si los campos no validados no estan vacios
		if(!empty($idprod) and !empty($idsupervisor) ){
			$salida=2;
			//mysql_close();
			//Iniciamos conexion
//			if(iniciarconexion()==1){
				//Sentencia sql
				$query ="SELECT IDPRODUCTO FROM PRODUCTOS WHERE IDPRODUCTO='$idprod'";
				$result=mysql_query($query) or die("Error en:  " . mysql_error());
				
				//Si existe un registro con ese Id...
				if( mysql_fetch_row($result) > 0){
					
					$query = "UPDATE PRODUCTOS SET IDUSUARIO ='$idsupervisor' WHERE IDPRODUCTO='$idprod'";
					$result=mysql_query($query) or die("Error en:  " . mysql_error());
					//Si hay un texto en nom correspondiente al nombre del producto...
					if(!empty($nom)){
						$query = "UPDATE PRODUCTOS SET NOMBREPRODUCTO ='$nom' WHERE IDPRODUCTO='$idprod'";
						$result=mysql_query($query) or die("Error en:  " . mysql_error());
					}
					
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
			//echo "<script>window.history.back();<script>"; 
		}
}//Fin de idCombobox


//Función que carga un combobox
function idCombobox2(){
	$i=0;
	//Sentencia sql
	$query ="SELECT DISTINCT IDPRODUCTO FROM PRODUCTOS WHERE ESTADO=1 ORDER BY IDUSUARIO";
	$result=mysql_query($query) or die("Error en:  " . mysql_error());
	
	//Mientras exista resultados
		while( $fila=mysql_fetch_array($result) ){
			$i++;
			echo '<option value="'.$fila['IDPRODUCTO'].'">'.$fila['IDPRODUCTO'].'</option>';
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

//Funcion que devuelve nuevo IdProducto
function nIdprod(){
	$salida='PRD0000001';
	$query ="SELECT MAX(IDPRODUCTO) FROM PRODUCTOS";

	$result=mysql_query($query) or die("Error en: " . mysql_error());
	
	//Mientras exista resultados
		if( $fila=mysql_fetch_array($result) ){
			$salida= 'PRD'.formatoNum($fila['MAX(IDPRODUCTO)']);
		}
	return $salida;
}

//Formato para numero destinado a IDPRODUCTO
function formatoNum($str){
	$str = (string)((int)substr(trim($str),3)+1);
	for($i=strlen($str);$i<7;$i++){
		$str='0'.$str;
	}
	return trim($str);
}

?>