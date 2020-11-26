<?php
require_once('../helpers/auth.php');
require_once('../layout/Layout.php');
require_once('IService.php');
require_once('Publicacion.php');
require_once('amigoService.php');
require_once('../usuario/Usuario.php');
require_once('../helpers/JsonHandler.php');
require_once('../conexion/db_conexion.php');
require_once('Service.php');


$layout = new Layout();
$servicios = new PublicacionService('../conexion');
$logged = json_decode($_SESSION['user']);
$publicaciones = $servicios->GetAllFromFriends($logged->Id);
$amigoService = new AmigoServices('../conexion');
$userFriends = $amigoService->GetUserFriends($logged->Id);

//Elimina
if (isset($_GET['id'])) {
    $userFriendId = $_GET['id'];
    $amigoService->Delete($logged->Id, $userFriendId);
    header('Location:amigos.php');
}
//Agrega amigo
if (isset($_POST['add-friend'])) {
    $amigoUser = $_POST['friend-user'];
    $amigoService->Add($logged->Id,$amigoUser);
    header('Location:amigos.php');
}
//Edita
if (isset($_POST['edit'])) {

    $publicacion = new Publicacion($_POST['id-publish'], date("d/m/Y h:i:s a"), $_POST['edited-publish'], $logged->Id);
    $servicios->Update($publicacion);
    header('Location:index.php');
}


$layout->PrintTopPage();
$layout->PrintHeader();

?>
<main role="main">
    <section class="jumbotron text-center mb-0">
        <div class="container">
            <h1 class="display-4"><?= $layout->PAGE_TITLE; ?></h1>
            <p class="lead"><?= $layout->DESC_PAGE; ?></p>
        </div>
    </section>
    <div class="py-5 bg-light">
        <div class="container text-left">
            <div class="row">
                <div class="col-8">
                    <?php if (empty($publicaciones)) : ?>
                        <div class="row">
                            <div class="col text-center">
                                NO HAY REGISTROS
                            </div>
                        </div>
                    <?php else : ?>
                        <?php foreach ($publicaciones as $publicacion) : ?>
                            <div class="row">
                                <div class="col">
                                    <div class="card mb-4 shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= $publicacion->Usuario; ?></h5>
                                            <p class="card-text"><?= $publicacion->Contenido; ?></p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <small class="text-muted"><?= $publicacion->Fecha; ?></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="col-4">
                    <div class="d-flex align-items-center mb-2 pl-2"><h5 class="mr-2">Lista de amigos</h5><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#staticBackdrop" >Agregar</button></div>
                    
                    <ul class="list-group">
                    <?php if (empty($userFriends)) : ?>
                        <div class="row">
                            <div class="col text-center">
                                NO HAY REGISTROS
                            </div>
                        </div>
                    <?php else : ?>
                        <?php foreach($userFriends as $userFriend):?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div><?=$userFriend->Nombre ." ".$userFriend->Apellido; ?><small class="text-muted"> @<?=$userFriend->Usuario?></small></div> 
                            <a href="amigos.php?id=<?= $userFriend->Id; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar registro?');">Eliminar</a>
                        </li>
                        <?php endforeach?>
                        <?php endif?>
                    </ul>
                </div>
            </div>


        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="amigos.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Agregar nuevo amigo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="friend-user" name="friend-user" type="text" class="form-control" placeholder="Usuario de amigo" required>
                    <div class="invalid-feedback">Indroducir valor valido.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" id="add-friend" name="add-friend" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $layout->PrintBottomPage(); ?>