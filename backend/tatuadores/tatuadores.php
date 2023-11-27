<?php
session_start();

require_once("../lib/LibreriaPDO.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    $conn = new DB("estudiotat");

    $consulta = "SELECT * FROM usuarios WHERE usuario=:usuario";


    $conn->consultaSimple($consulta);

    $conn->filas;



}
?>