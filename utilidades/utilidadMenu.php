<?php

function tipomenu($tipo){
	switch($tipo){ 
		case 1:
			echo "<div id='cssmenu'>
					<ul>
					   <li class='has-sub'><a href='ModuloUsuario/usuarionuevo.php'><span>Gestión de Usuarios</span></a>
					      <ul>
					         <li><a href='ModuloUsuario/usuarionuevo.php'><span>Crear nuevo usuario</span></a></li>
					         <li><a href='ModuloUsuario/usuariomodificarpermisos.php'><span>Modificar permisos</span></a></li>
					         <li><a href='ModuloUsuario/usuariobaja.php'><span>Dar de baja (usuarios)</span></a></li>
					         <li class='last'><a href='ModuloUsuario/usuariocontrol.php'><span>Control de acceso de usuarios</span></a></li>
					      </ul>
					   </li>
					   <li class='has-sub'><a href='#'><span>Gestión de Proveedores</span></a>
					      <ul>
					         <li><a href='ModuloProveedor/proveedornuevo.php'><span>Agregar nuevo proveedor</span></a></li>
					         <li><a href='ModuloProveedor/proveedormodificar.php'><span>Modificar proveedores</span></a></li>
					         <li class='last'><a href='ModuloProveedor/proveedorbaja.php'><span>Dar de baja (proveedores)</span></a></li>
					      </ul>
					   </li>
					   <li class='has-sub'><a href='#'><span>Gestión de Productos</span></a>
					      <ul>
					         <li><a href='ModuloProducto/productonuevo.php'><span>Agregar nuevo producto</span></a></li>
					         <li><a href='ModuloProducto/productomodificar.php'><span>Modificar producto</span></a></li>
					         <li class='last'><a href='ModuloProducto/productobaja.php'><span>Dar de baja (productos)</span></a></li>
					      </ul>
					   </li>
					   <li><a href='#'><span>Gestión de Inventario</span></a>
						  <ul>
					         <li><a href='ModuloInventario/entradasInventario.php'><span>Registro de entradas</span></a></li>
					         <li class='last'><a href='ModuloInventario/salidasInventario.php'><span>Registro de salidas</span></a></li>
					      </ul>
					   </li>
					   <li><a href='#'><span>Gestión de Ordenes de Compra</span></a>
					   	  <ul>
					   		<li><a href='ModuloOrdenCompra/crearOrden.php'><span>Crear órden de compra</span></a></li>
					        <li><a href='ModuloOrdenCompra/modificarOrden.php'><span>Modificar órden de compra</span></a></li>
					        <li class='last'><a href='ModuloOrdenCompra/eliminarOrden.php'><span>Eliminar órden de compra</span></a></li>
					      </ul>
					   </li>
					   <li class='last'><a href='#'><span>Gestión de Reportes</span></a>
					   	  <ul>
					        <li><a href='ModuloReportes/OrdenxProv.php'><span>Orden de compra por proveedor</span></a></li>
					        <li><a href='ModuloReportes/OrdenxProd.php'><span>Orden de compra por producto</span></a></li>
					        <li><a href='ModuloReportes/OrdenEstado.php'><span>Orden de compra por estado</span></a></li>
					        <li><a href='ModuloReportes/OrdenGen.php'><span>Orden de compra general</span></a></li>
					        <li><a href='ModuloReportes/InvxProd.php'><span>Inventario por producto</span></a></li>
					        <li><a href='ModuloReportes/InvEn.php'><span>Entradas al inventario</span></a></li>
					        <li><a href='ModuloReportes/InvSal.php'><span>Salidas del inventario</span></a></li>
					        <li class='last'><a href='ModuloReportes/InvGen.php'><span>General del Inventario</span></a></li>
					      </ul>
					   </li>
					</ul>
					</div>";
		  	break;
		case 2:
			echo "<div id='cssmenu'>
					<ul>
					   <li class='has-sub'><a href='#'><span>Gestión de Proveedores</span></a>
					      <ul>
					         <li><a href='ModuloProveedor/proveedornuevo.php'><span>Agregar nuevo proveedor</span></a></li>
					         <li><a href='ModuloProveedor/proveedormodificar.php'><span>Modificar proveedores</span></a></li>
					         <li class='last'><a href='ModuloProveedor/proveedorbaja.php'><span>Dar de baja (proveedores)</span></a></li>
					      </ul>
					   </li>
					   <li class='has-sub'><a href='#'><span>Gestión de Productos</span></a>
					      <ul>
					         <li><a href='ModuloProducto/productonuevo.php'><span>Agregar nuevo producto</span></a></li>
					         <li><a href='ModuloProducto/productomodificar.php'><span>Modificar producto</span></a></li>
					         <li class='last'><a href='ModuloProducto/productobaja.php'><span>Dar de baja (productos)</span></a></li>
					      </ul>
					   </li>
					   <li><a href='#'><span>Gestión de Inventario</span></a>
						  <ul>
					         <li><a href='ModuloInventario/entradasInventario.php'><span>Registro de entradas</span></a></li>
					         <li class='last'><a href='ModuloInventario/salidasInventario.php'><span>Registro de salidas</span></a></li>
					      </ul>
					   </li>
					   <li><a href='#'><span>Gestión de Ordenes de Compra</span></a>
					   	  <ul>
					   		<li><a href='ModuloOrdenCompra/crearOrden.php'><span>Crear órden de compra</span></a></li>
					        <li><a href='ModuloOrdenCompra/modificarOrden.php'><span>Modificar órden de compra</span></a></li>
					        <li class='last'><a href='ModuloOrdenCompra/eliminarOrden.php'><span>Eliminar órden de compra</span></a></li>
					      </ul>
					   </li>
					   <li class='last'><a href='#'><span>Gestión de Reportes</span></a>
					   	  <ul>
					        <li><a href='ModuloReportes/OrdenxProv.php'><span>Orden de compra por proveedor</span></a></li>
					        <li><a href='ModuloReportes/OrdenxProd.php'><span>Orden de compra por producto</span></a></li>
					        <li><a href='ModuloReportes/OrdenEstado.php'><span>Orden de compra por estado</span></a></li>
					        <li><a href='ModuloReportes/OrdenGen.php'><span>Orden de compra general</span></a></li>
					        <li><a href='ModuloReportes/InvxProd.php'><span>Inventario por producto</span></a></li>
					        <li><a href='ModuloReportes/InvEn.php'><span>Entradas al inventario</span></a></li>
					        <li><a href='ModuloReportes/InvSal.php'><span>Salidas del inventario</span></a></li>
					        <li class='last'><a href='ModuloReportes/InvGen.php'><span>General del Inventario</span></a></li>
					      </ul>
					   </li>
					</ul>
					</div>";
		  		break;
			
			case 3:
			echo "<div id='cssmenu'>
					<ul>
					   <li><a href='#'><span>Gestión de Inventario</span></a>
						  <ul>
					         <li><a href='ModuloInventario/entradasInventario.php'><span>Registro de entradas</span></a></li>
					         <li class='last'><a href='ModuloInventario/salidasInventario.php'><span>Registro de salidas</span></a></li>
					      </ul>
					   </li>
					   <li class='last'><a href='#'><span>Gestión de Reportes</span></a>
					   	  <ul>
					        <li><a href='ModuloReportes/OrdenxProv.php'><span>Orden de compra por proveedor</span></a></li>
					        <li><a href='ModuloReportes/OrdenxProd.php'><span>Orden de compra por producto</span></a></li>
					        <li><a href='ModuloReportes/OrdenEstado.php'><span>Orden de compra por estado</span></a></li>
					        <li><a href='ModuloReportes/OrdenGen.php'><span>Orden de compra general</span></a></li>
					        <li><a href='ModuloReportes/InvxProd.php'><span>Inventario por producto</span></a></li>
					        <li><a href='ModuloReportes/InvEn.php'><span>Entradas al inventario</span></a></li>
					        <li><a href='ModuloReportes/InvSal.php'><span>Salidas del inventario</span></a></li>
					        <li class='last'><a href='ModuloReportes/InvGen.php'><span>General del Inventario</span></a></li>
					      </ul>
					   </li>
					</ul>
					</div>";
		  		break;


			break;
		default:
			session_write_close();
			session_destroy();
			header("Location: index.php");
	}
}

?>