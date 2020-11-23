<?php
require_once('layout/Layout.php');
require_once('publicacion/Publicacion.php');
require_once('helpers/JsonHandler.php');
require_once('conexion/db_conexion.php');
require_once('publicacion/Service.php');

$layout = new Layout();
$servicios = new PublicacionService('conexion');
$publicaciones = $servicios->GetAll();


//Elimina
if (isset($_GET['id'])) {
    $servicios->Delete($_GET['id']);
    header('Location:index.php');
}


$layout->PrintTopPage();
$layout->PrintHeader();

?>
<main role="main">
    <section class="jumbotron text-center mb-0">
        <div class="container">
            <h1 class="display-4"><?= $layout->CURRENT_PAGE; ?></h1>
            <p class="lead"><?= $layout->DESC_PAGE; ?></p>
        </div>
    </section>
    <div class="py-5 bg-light">
        <div class="container">
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

            <div class="row">
                <div class="col">
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">UsuarioPrueba</h5>
                            <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Editar</button>
                                    <button type="button" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $layout->PrintBottomPage(); ?>