<?php

    class tatuador {
        private $id;
        private $nombre;
        private $imagen;
        private $descripcion;
        private $estilo;
        private $apellido;
        private $id_usuario;

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