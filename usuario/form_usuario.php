<?php
require_once('./../layout/Layout.php');
require_once('./../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('./Usuario.php');
require_once('./Service.php');

$servicios = new UserService('../conexion');
$msg = "";

$tmpUser = new stdClass();


//Agrega
if (isset($_POST['submit'])) {
    $user = new  Usuario(
        '',
        $_POST['nombre'],
        $_POST['apellido'],
        $_POST['telefono'],
        $_POST['correo'],
        $_POST['usuario'],
        $_POST['contras']
    );
    if (!($_POST['contras'] === $_POST['confir-contras'])) {

        $tmpUser = $user;
        $msg = 'Contraseñas no coinciden';
    }else{
        $servicios->Add($user);
        session_destroy();
        header("Location:login.php");
        exit();

    }


}

$layout = new Layout();
$layout->PrintTopPage();

?>

<main role="main">
    <?php if (!empty($msg)) : ?>
        <div class="alert alert-danger" role="alert">
            <?= $msg; ?>
        </div>
    <?php endif ?>
    <div class="py-5 bg-light">
        <div class="container">
            <img class="mb-4" src="../assets/img/df.svg" alt="" width="100" height="100">
            <form method="POST" action="form_usuario.php">
                <input type="hidden" name="id" value="0">
                <h3 class="mb-3 font-weight-normal"><?= $layout->CURRENT_PAGE; ?></h3>
                <p class="h6 text-muted"><?= $layout->DESC_PAGE; ?></p>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribir aqui..." value="<?= isset($tmpUser->Nombre) ? $tmpUser->Nombre : ""; ?>" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Escribir aqui..." value="<?= isset($tmpUser->Apellido) ? $tmpUser->Apellido : ""; ?>" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="usuario">Usuario</label>
                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Escribir aqui..." value="<?= isset($tmpUser->Usuario) ? $tmpUser->Usuario : ""; ?>" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="telefono">Telefono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" pattern="[8(0|2|4)9]{3}[0-9]{3}[0-9]{4}" title="Formato de telefono: 8x94567890. x puede ser 0, 2 o 4." placeholder="1234567890" value="<?= isset($tmpUser->Telefono) ? $tmpUser->Telefono : ""; ?>" required="">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="correo">Correo electronico</label>
                    <input type="email" class="form-control" id="correo" name="correo" placeholder="you@example.com" value="<?= isset($tmpUser->Correo) ? $tmpUser->Correo : ""; ?>" required="">
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contras">Contraseña</label>
                        <input type="password" class="form-control" id="contras" name="contras" placeholder="Escribir contraseña" value="<?= isset($tmpUser->Contrasena) ? $tmpUser->Contrasena : ""; ?>" required="">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="confir-contras">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="confir-contras" name="confir-contras" placeholder="Escribir contraseña de nuevo" value="" required="">
                    </div>
                </div>
                <hr class="mb-4">
                <button name="submit" class="btn btn-primary btn-lg" type="submit">Registrarse</button>
                <a href="login.php" class="btn btn-danger btn-lg">Cancelar</a>
            </form>
        </div>
    </div>
</main>



<?= $layout->PrintBottomPage(); ?>