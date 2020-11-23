<?php
require_once('./../layout/Layout.php');
require_once('./../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('./Usuario.php');
require_once('./Service.php');

$servicios = new UserService('../conexion');


//Agrega o edita el transaccion
if (isset($_POST['submit'])) {
	$servicios->Login($_POST['inputUser'],$_POST['inputPassword']);

	//header("Location:./../index.php");
	//exit();
}

$layout = new Layout();
$layout->PrintTopPage();

?>

<form class="form-signin" method="POST" action="login.php">
      <img class="mb-4" src="../assets/img/df.svg" alt="" width="100" height="100">
	  <h3 class="mb-3 font-weight-normal"><?= $layout->CURRENT_PAGE;?></h3>
	  <p class="h6 text-muted"><?= $layout->DESC_PAGE; ?></p>
      <label for="inputUser" class="sr-only">Usuario</label>
      <input type="text" id="inputUser" name="inputUser" class="form-control" placeholder="Usuario" required="" autofocus="">
      <label for="inputPassword" class="sr-only">Contraseña</label>
      <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Contraseña" required="">
	  <button name="submit" class="btn btn-lg btn-primary btn-block" type="submit">Iniciar</button>
	  <a href="form_usuario.php" class="btn btn-lg btn-outline-info btn-block">Registrarme</a>
      <p class="mt-5 mb-3 text-muted">&copy SocialNET 2020-2021</p>
    </form>