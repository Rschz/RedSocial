<?php
session_start();

if (basename($_SERVER["SCRIPT_NAME"]) !== "login.php") {
    $pathToLogin = basename(realpath(__DIR__ . '/..')) == basename(getcwd()) ? "usuario/login.php" : "../usuario/login.php";
    if (!isset($_SESSION['user'])) {
        $_SESSION['tmpMgs'] = "Debe iniciar sesion para acceder al contenido";
        header("Location:$pathToLogin");
        exit();
    }
}

?>