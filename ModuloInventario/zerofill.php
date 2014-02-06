<?php
function zerofill($entero, $largo){
    // Limpiamos por si se encontraran errores de tipo en las variables
    $entero = (int)$entero;
    $largo = (int)$largo;
     $relleno = '';
   
    if (strlen($entero) < $largo) {
    $relleno = str_repeat('0',$largo-strlen($entero));
    }
    return $relleno.$entero;
}
?>