<?php

require_once("admin/LibreriaPDO.php");
session_start();


    $login = false;



    $mensaje ="";



    if (isset($_POST["password"]) && isset($_POST["usuario"]))
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

        $mensaje = "Usuario o contraseña incorrectos";

        if ($conn->filas[0]["rol"] === "admin" && $conn->filas[0]["password"] == $password ){

            $login = true;
            $_SESSION["nombre"] = $conn->filas[0]["usuario"];
            $_SESSION["rol"] = $conn->filas[0]["rol"];;

            $autenticacionFallida = false; 

            $mensaje = "";

        }


        if ($conn->filas[0]["rol"] === "tatuador" && password_verify($password,$conn->filas[0]["password"] ) ){

            $login = true;
            $_SESSION["idUsuario"] = $conn->filas[0]["id"];
            $_SESSION["rol"] = $conn->filas[0]["rol"];;

            $autenticacionFallida = false; 
            $mensaje = "";

        }

      if ($autenticacionFallida)  {
        
        $data = array('mensaje' => $mensaje, 'autenticacion'=>$autenticacionFallida);
        //print_r($data);
        header('Content-Type: application/json');
        echo json_encode($data);

      }

    }




?>