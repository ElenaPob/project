<?php

    class galeria {
        private $id;
        private $imagen;
        private $id_tatuador;

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