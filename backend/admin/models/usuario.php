<?php

    class usuario {
        private $id;
        private $usuario;
        private $rol;
        private $email;
        private $password;

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