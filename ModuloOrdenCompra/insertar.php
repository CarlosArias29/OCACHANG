<?php
	include 'crearOrden.php'
	//recuperamos los datos a insertar
              $idOrden = $codigoActual;
              $idProducto = "";
              $idProveedor = "";
              $idUsuario = "";
              $cantidadLotes = "";
              $costoPorLote = "";
              $estado = "";
              $costoUnitario = "";
              $productosPorLote = "";
              $fecha = "";
              $fechaUltimaModificacion = "";

            //   $SQL= "SELECT NOMBREEMPRESA FROM PROVEEDOR;";
            //   $QUERY =  mysql_query ($SQL);
            //     while ( $resultados = mysql_fetch_row($QUERY)){
            //     echo "<option value='".$resultados[0]."'> ".$resultados[0]."</option>";
            //    }

              echo "<p>".$idOrden."-".$idProducto."-".$idProveedor."-".$idUsuario."-".$cantidadLotes."-".
                    $costoPorLote."-".$estado."-".$costoUnitario."-".$productosPorLote."-".$fecha."-".
                    $fechaUltimaModificacion."</p>"  ;

?>