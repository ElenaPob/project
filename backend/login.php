<?php

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

            $autenticacionFallida = true; 

            $conn->consultaDatos($consulta, $param);

        

            if ($conn->filas[0]["rol"] === "admin" && $conn->filas[0]["password"] == $password ){

                $login = true;
                $_SESSION["nombre"] = $conn->filas[0]["usuario"];
                $_SESSION["rol"] = $conn->filas[0]["rol"];;

                $autenticacionFallida = false; 

            

            }


            if ($conn->filas[0]["rol"] === "tatuador" && password_verify($password,$conn->filas[0]["password"] ) ){

                $login = true;
                $_SESSION["idUsuario"] = $conn->filas[0]["id"];
                $_SESSION["rol"] = $conn->filas[0]["rol"];;

                $autenticacionFallida = false; 

            }

        }

    }



?>