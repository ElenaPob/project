<?php

    class pedido {
        private $id;
        private $detalle;
        private $fecha;
        private $id_tatuador;
        private $estado;

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