<?php
session_start();

    $pathToLogin = basename(realpath(__DIR__ . '/..')) == basename(getcwd()) ? "usuario/login.php" : "../usuario/login.php";
    if (!isset($_SESSION['user'])) {
        $_SESSION['msgAuth'] = "Debe iniciar sesion para acceder al contenido";
        header("Location:$pathToLogin");
        exit();
    }


?>