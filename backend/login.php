<?php

    session_start();

    $login = false;

    require_once("lib/LibreriaPDO.php");

    if (isset($_POST["login"])){
        $usuario = $_POST["usuario"];
        $password= $_POST["password"];
    

        $conn = new DB ("estudiotat");

        $consulta = "SELECT * FROM usuarios WHERE usuario=:usuario";

        $param = [ 
            ":usuario"=>$usuario
        ];

        $conn->consultaDatos($consulta, $param);

        //echo $conn->filas["rol"];
        //echo $usuario;

        //var_dump($conn->filas[0]["rol"]);
    

        if ($conn->filas[0]["rol"] === "admin" && $conn->filas[0]["contraseña"] == $password ){

            $login = true;
            $_SESSION["nombre"] = $conn->filas[0]["usuario"];
            $_SESSION["rol"] = "admin";

            
            //echo "SESION INICIADA COMO ADMIN";

        }

        // password_verify($password,$conn->filas[0]["contraseña"] )  Para la contraseña cifrada que debe hacerse
        // en la bbdd cuando se añada el usuario

        if ($conn->filas[0]["rol"] === "tatuador" && $conn->filas[0]["contraseña"] == $password){

            $login = true;
            $_SESSION["idUsuario"] = $conn->filas[0]["id"];
            $_SESSION["rol"] = "tatuador";

            //echo "SESION INICIADA COMO TATUADOR";

        }
    }




?>