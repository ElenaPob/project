<?php

    class pedido {
        private $id;
        private $id_tatuador;
        private $detalle;
        private $fecha;
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