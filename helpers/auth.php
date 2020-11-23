<?php
session_start();

if (basename($_SERVER["SCRIPT_NAME"]) === "login.php") {
    if (!isset($_SESSION['tmpUser'])) {
        $_SESSION['tmpMgs'] = "Debe iniciar sesion para acceder al contenido";
        header("Location:../index.php");
        exit();
    }
}

?>