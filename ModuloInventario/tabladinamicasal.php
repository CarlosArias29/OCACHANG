  <link href="../js/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
  <script src="../js/jquery-1.9.1.js"></script>
  <script src="../js/jquery-ui-1.10.3.custom.js"></script>
  

<script>
  $(function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:250,
      modal: true,
      buttons: {        
        "Aceptar": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
  </script>


<?php
session_start();
include ('../utilidades/config.php'); 
$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 


switch( $_POST['accion'] ) {
	case "Cancelar":
		$_SESSION['contador']=0;
		break;
   
   case "Guardar":{
	   // AQUI TODO EL CODIGO QUE HARÁ EN GUARDAR

		//if($_POST['accion']=="") {
			$_SESSION['contador']=0;
		//}


		if ($_POST['accion']=="Guardar"){
	
		$idbodega=trim($_POST['combobox']);
		$idproducto=trim($_POST['idproducto']);
		$idproveedor=trim($_POST['idproveedor']);
		$descripcion=trim($_POST['descripcion']);
		$id=mysql_query("SELECT NOMBREPRODUCTO FROM PRODUCTOS where IDPRODUCTO='$idproducto'",$link) or die("La consulta no obtuvo filas");
		$a= mysql_fetch_array($id) or die("Error en:" . mysql_error());
		$nombreproducto=$a['NOMBREPRODUCTO'];
		$cantidadlotes=trim($_POST['cantidadlotes']);


		//verificamos si hay existencias	
		$conexistencias="SELECT EXISTENCIA FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto'";
		$b=mysql_query($conexistencias,$link) or die("Error en:" . mysql_error());
		$xx= mysql_fetch_array($b) or die("Error en:" . mysql_error());


		$e=$xx['EXISTENCIA'];

		//validacion principal
		if ($e>=$cantidadlotes){

			$sql="select * from INVENTARIO where IDPRODUCTO='$idproducto' AND IDTRANSACCION LIKE 'EP%'";

			//efectúo la consulta
			$res=mysql_query($sql,$link);
			// si la consulta obtuvo resultados



			while($cantidadlotes!=0 and $registro=mysql_fetch_array($res)) { 
				$ex=$registro['EX'];
				//echo 'Hola'.$ex;
				
				$_SESSION['datos'][$_SESSION['contador']][9]=$descripcion;
				$_SESSION['datos'][$_SESSION['contador']][8]=$idbodega;
				$_SESSION['datos'][$_SESSION['contador']][7]=$idproveedor;
					
	
				$var=$registro['CORRELATIVO'];	
				
				if($ex>=$cantidadlotes){

					//imprimimos registro
		
					$_SESSION['datos'][$_SESSION['contador']][0]=$registro['IDPRODUCTO'];
					$_SESSION['datos'][$_SESSION['contador']][1]=$registro['NOMBREPRODUCTO'];
					$_SESSION['datos'][$_SESSION['contador']][2]=$cantidadlotes;
					$_SESSION['datos'][$_SESSION['contador']][3]=$registro['COSTOXLOTE'];
					$_SESSION['datos'][$_SESSION['contador']][4]=$registro['CANTIDADPRODUCTOXLOTE'];
					$_SESSION['datos'][$_SESSION['contador']][5]=$registro['COSTOUNITARIOREGISTRADO'];
					$_SESSION['datos'][$_SESSION['contador']][6]=$var;
					$_SESSION['contador']=$_SESSION['contador']+1;		
		
					$cantidadlotes=0;
		
		
					//$_SESSION['contador']=0;
		
		
			}else if ($ex<$cantidadlotes and $ex!=0){
		
					$_SESSION['datos'][$_SESSION['contador']][0]=$registro['IDPRODUCTO'];
					$_SESSION['datos'][$_SESSION['contador']][1]=$registro['NOMBREPRODUCTO'];
					$_SESSION['datos'][$_SESSION['contador']][2]=$ex;
					$_SESSION['datos'][$_SESSION['contador']][3]=$registro['COSTOXLOTE'];
					$_SESSION['datos'][$_SESSION['contador']][4]=$registro['CANTIDADPRODUCTOXLOTE'];
					$_SESSION['datos'][$_SESSION['contador']][5]=$registro['COSTOUNITARIOREGISTRADO'];
					$_SESSION['datos'][$_SESSION['contador']][6]=$var;
					$_SESSION['contador']=$_SESSION['contador']+1;
			
		
					$cantidadlotes=$cantidadlotes-$ex;
		
				}// fin if
		
			}// fin while
	}//fin del if si hay existencias

else{
	
	// NO HAY SUFICIENTES EXISTENCIAS
	$_SESSION['contador']=0;
	}// fin de else

}//fin de if ($_POST['accion']=="Guardar"){

break;
}// fin case GUARDAR

case "Confirmar":{ 
if($_POST['accion2']=="") {
$_SESSION['contador']=0;
}

if($_POST['accion2']=="Confirmar") {
	
	// AQUI TODO EL CODIGO PARA CONFIRMAR
$link=mysql_connect("localhost","root",$DB_PASS); //abro la conexion
mysql_select_db("bdsi215",$link); //selecciono mi base de datos 
	
	$idtransaccion=NidtransaccionS();
	
	for ($i=0;$i<$_SESSION['contador'];$i++){
		for ($c=0;$c<=9;$c++){

$M[$i][$c]=$_SESSION['datos'][$i][$c];
}//fin contador columnas
	

$idproveedor=trim($M[$i][7]);



$idbodega=trim($M[$i][8]);

// esto no lleva trim porque aceptara espacios
$descripcion=$M[$i][9];

$idproducto=trim($M[$i][0]);

$idusuario=trim($_SESSION['usuario']);
$nombreproducto=$M[$i][1];
$cantidadproductoporlote=$M[$i][4];
$cantidadlotes=$M[$i][2];
$costolote=$M[$i][3];
$costounitarioregistrado=$M[$i][5];
$fechaingreso=date("Y-m-d");


echo "<script language='javascript'>"; 
//echo "alert('".$_POST['accion2']."')"; 
echo "</script>";  
$consulta="insert into INVENTARIO (IDTRANSACCION,IDPROVEEDOR,IDBODEGA,IDPRODUCTO,IDUSUARIO,NOMBREPRODUCTO,CANTIDADPRODUCTOXLOTE,CANTIDADLOTES,COSTOXLOTE,COSTOUNITARIOREGISTRADO,DESCRIPCION,FECHAINGRESOINVENTARIO,EX) values ('$idtransaccion','$idproveedor','$idbodega','$idproducto','$idusuario','$nombreproducto','$cantidadproductoporlote','$cantidadlotes','$costolote','$costounitarioregistrado','$descripcion',now(),'$cantidadlotes')";
//echo $consulta;
//$corre=trim($_SESSION['datos'][$_SESSION['contador']][6]);
mysql_query($consulta, $link) or die("Error en:  " . mysql_error());

$corre=trim($M[$i][6]);

//echo 'Corre xD '.$corre;

//PRIMERA MODIFICACION
		$conexistencias="SELECT EX FROM INVENTARIO WHERE CORRELATIVO='$corre'";
		$b=mysql_query($conexistencias,$link) or die("Error1 en:" . mysql_error());
		$xx= mysql_fetch_array($b) or die("Error2 en:" . mysql_error());
        $e=$xx['EX'];
		if($e > $cantidadlotes ){
        	$ex=$e-$cantidadlotes;
		}else if($e < $cantidadlotes){
			$ex=0;
		}
	//	echo $ex.' - '.$e;
				//actualizamos el valor de EX del registro
		mysql_query("update INVENTARIO set EX='$ex' where CORRELATIVO='$corre'",$link);
	//HASTA AQUI ESTA BIEN
		
//SEGUNDA MODIFICACION
		$otra="SELECT EXISTENCIA FROM PRODUCTOS WHERE IDPRODUCTO='$idproducto'";
		$b=mysql_query($otra,$link) or die("Error3 en:" . mysql_error());
		$yy= mysql_fetch_array($b) or die("Error4 en:" . mysql_error());
        
		$exis = $yy['EXISTENCIA'];
		
		//echo $exis;
		//echo '<br>';
		//echo $cantidadlotes;
		//HASTA AQUI ESTA BIEN
		if($exis > $cantidadlotes ){
        	$tempo = $exis-$cantidadlotes;
		                           }
								   //else if($exis < $cantidadlotes){
			//$tempo = 0;
		//}		

		//disminuimos el producto en existencias de l atabla producto
		mysql_query("update PRODUCTOS set EXISTENCIA='$tempo' where IDPRODUCTO='$idproducto'",$link);

}//fin contador filas
if($_SESSION['contador']!=0)
	echo '<div id="dialog-confirm" title="Información"><p>La salida de los productos fue efectuada correctamente</p></div>';
$_SESSION['contador']=0;

}//fin if
break;
                    }//del case Confirmar

}// fin switch

function NidtransaccionS(){
    $salida='SP00000001';
    $query ="SELECT MAX(IDTRANSACCION) FROM INVENTARIO WHERE IDTRANSACCION LIKE 'SP%'";

    $result=mysql_query($query) or die("Error en: " . mysql_error());

    //Mientras exista resultados
        if( $fila=mysql_fetch_array($result) ){
            $salida= 'SP'.formatoNum($fila['MAX(IDTRANSACCION)']);
        }
    return $salida;
}//fin de nuevo id proveedor



//Formato para numero destinado a IDPRODUCTO
function formatoNum($str){
    $str = (string)((int)substr(trim($str),3)+1);
    for($i=strlen($str);$i<8;$i++){
        $str='0'.$str;
    }
    return trim($str);
}
?>


