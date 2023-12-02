<?php

    //session_start();

    $login = false;

    require_once("admin/LibreriaPDO.php");

    if (isset($_POST["login"])){
        if (isset($_POST["password"]) && isset($_POST["usuario"]) && !empty($_POST["password"]) && !empty($_POST["usuario"]))
        {
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
        

            if ($conn->filas[0]["rol"] === "admin" && $conn->filas[0]["password"] == $password ){

                $login = true;
                $_SESSION["nombre"] = $conn->filas[0]["usuario"];
                $_SESSION["rol"] = $conn->filas[0]["rol"];;

                
                //echo "SESION INICIADA COMO ADMIN";

            }

            // password_verify($password,$conn->filas[0]["password"] )  Para la password cifrada que debe hacerse
            // en la bbdd cuando se añada el usuario

            if ($conn->filas[0]["rol"] === "tatuador" && password_verify($password,$conn->filas[0]["password"] ) ){

                $login = true;
                $_SESSION["idUsuario"] = $conn->filas[0]["id"];
                $_SESSION["rol"] = $conn->filas[0]["rol"];;

                //echo "SESION INICIADA COMO TATUADOR";

            }
            //echo "<script>console.log(".$_SESSION["rol"].")</script>";
            //echo  $_SESSION["rol"];
        }
    }




?>