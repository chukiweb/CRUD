<?php 

//Función para medir las descripciones de los items.
function medir_string($param)
{

    if (strlen($param) >= 70) {
        $resultado = substr($param, 0, 70);
    } else {
        $resultado = $param;
    }
    return $resultado;
}

function filtrarCampos($variable){
    $retorno = stripcslashes($variable);
    $retorno = strip_tags($retorno);
    $retorno = htmlentities($retorno);
    $retorno = addslashes($retorno);
    $retorno = trim($retorno);
    
    return $retorno;
}