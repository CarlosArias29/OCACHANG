<?php
switch( $_POST['cmdForm'] ) {
case "Procesar texto con el boton 1": header (“location:boton1.php?texto=”.$_POST['texto']);
break;
case "Procesar texto con el boton 2": header (“location:boton2.php?texto=”.$_POST['texto']);
break;
}
?>