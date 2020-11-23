<?php
class Publicacion
{
    public $Id;
    public $Fecha;
    public $Contenido;
    public $Usuario;

    public function __construct($id, $fecha, $contenido, $usuarioId)
    {
        date_default_timezone_set('America/Santo_Domingo');
        $this->Id = $id;        
        $this->Fecha = empty($fecha) ? date("d:m:Y h:i:s a") : $fecha;
        $this->Contenido = $contenido;
        $this->Usuario = $usuarioId;

    }
}
