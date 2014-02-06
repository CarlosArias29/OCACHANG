<?php

function tipomenu($tipo){
	
echo "<div id='cssmenu'>		<ul>
<li class='has-sub'>
<a href='ModuloUsuario/usuarionuevo.php'>
<span>Reporte por Producto</span></a>
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
					         <li><a href='#'><span>Registro de salidas</span></a></li>
					         <li class='last'><a href='#'><span>Modificación de productos</span></a></li>
					      </ul>
					   </li>
					   <li><a href='#'><span>Gestión de Ordenes de Compra</span></a>
					   	  <ul>
					   		<li><a href='#'><span>Crear órden de compra</span></a></li>
					        <li><a href='#'><span>Modificar órden de compra</span></a></li>
					        <li class='last'><a href='#'><span>Eliminar órden de compra</span></a></li>
					      </ul>
					   </li>
					   <li class='last'><a href='#'><span>Gestión de Reportes</span></a>
					   	  <ul>
					        <li><a href='#'><span>Reporte de órden de compra</span></a></li>
					        <li class='last'><a href='#'><span>Reporte de inventario</span></a></li>
					      </ul>
					   </li>
					</ul>
					</div>";
		  
}

?>