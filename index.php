<?php
require_once('helpers/auth.php');
require_once('layout/Layout.php');
require_once('publicacion/IService.php');
require_once('publicacion/Publicacion.php');
require_once('helpers/JsonHandler.php');
require_once('conexion/db_conexion.php');
require_once('publicacion/Service.php');


$layout = new Layout();
$servicios = new PublicacionService('conexion');
$logged = json_decode($_SESSION['user']);
$publicaciones = $servicios->GetAll($logged->Id);

//Elimina
if (isset($_GET['id'])) {
    $servicios->Delete($_GET['id']);
    header('Location:index.php');
}
//Agrega
if (isset($_POST['submit'])) {
    $publicacion = new Publicacion('', date("d/m/Y h:i:s a"), $_POST['new-publish'], $logged->Id);
    $servicios->Add($publicacion);
    header('Location:index.php');
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
            <form method="POST" action="index.php">
                <div class="row my-3">
                    <div class="col">
                        <input name="new-publish" type="text" class="form-control" placeholder="Que hay de nuevo?" required>
                    </div>
                    <div class="col">
                        <button type="submit" name="submit" class="btn btn-primary">Publicar</button>
                    </div>
                </div>
            </form>

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
                                    <h5 class="card-title"><?= $logged->Usuario; ?></h5>
                                    <p class="card-text"><?= $publicacion->Contenido; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#staticBackdrop" data-whatever="<?= $publicacion->Contenido; ?>" data-id="<?= $publicacion->Id; ?>">Editar</button>
                                            <a href="index.php?id=<?= $publicacion->Id; ?>" type="button" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar registro?');">Eliminar</a>
                                        </div>
                                        <small class="text-muted"><?= $publicacion->Fecha; ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</main>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="index.php" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Editar publicación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="edited-publish" name="edited-publish" type="text" class="form-control" placeholder="Que hay de nuevo?" required>
                    <input  id="id-publish" type="hidden" name="id-publish">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="edit" class="btn btn-primary">Aceptar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $layout->PrintBottomPage(); ?>