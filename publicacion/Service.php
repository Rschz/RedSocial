<?php
class PublicacionService implements IServicePublicacion
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function GetAll($userId)
    {
        $publicaciones = array();
        $stmt = $this->Context->Db->prepare("SELECT * FROM `publicaciones` WHERE usuario_id = ?");
        $stmt->bind_param('s', $userId);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $publicaciones;
        }else{
            while ($row = $resul->fetch_object()) {
                $publicaciones[] = new Publicacion($row->id,$row->fecha,$row->contenido,$row->usuario_id);
            }
            return $publicaciones;
        }
        $stmt->close(); 
    }

    public function GetById($id)
    {

    }

    public function Add($obj)
    {

    }

    public function Update($obj)
    {

    }

    public function Delete($id)
    {

    }

}
