<?php

class tatudor {
    private $Id;
    private $Nombre;
    private $imagen;
    private $Descripcion;
    private $estilo;
    private $apellido;

    function __get($nombre)
    {
        return $this->$nombre;
    }

    function __set($nombre, $valor)
    {
        $this->$nombre = $valor;
    }

}


?>