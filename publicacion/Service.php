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
        $stmt = $this->Context->Db->prepare("SELECT * FROM `publicaciones` WHERE usuario_id = ? ORDER BY id DESC");
        $stmt->bind_param('s', $userId);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $publicaciones;
        } else {
            while ($row = $resul->fetch_object()) {
                $publicaciones[] = new Publicacion($row->id, $row->fecha, $row->contenido, $row->usuario_id);
            }
            return $publicaciones;
        }
        $stmt->close();
    }

    public function GetAllFromFriends($userId)
    {
        $publicaciones = array();
        $stmt = $this->Context->Db->prepare("SELECT * from publicaciones WHERE usuario_id IN (SELECT amigo_id from amigos WHERE usuario_id = ?)
        ORDER BY id DESC");
        $stmt->bind_param('s', $userId);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return $publicaciones;
        } else {
            while ($row = $resul->fetch_object()) {
                $publicaciones[] = new Publicacion($row->id, $row->fecha, $row->contenido, $row->usuario_id);
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
        $stmt = $this->Context->Db->prepare("INSERT INTO `publicaciones`(`fecha`, `contenido`, `usuario_id`)
            VALUES (?,?,?)");

        $stmt->bind_param('sss', $obj->Fecha, $obj->Contenido, $obj->Usuario);
        $stmt->execute();
        $stmt->close();
    }

    public function Update($obj)
    {
        $stmt = $this->Context->Db->prepare("UPDATE `publicaciones` SET `contenido`= ? WHERE id = ?");

        $stmt->bind_param('ss', $obj->Contenido, $obj->Id);
        $stmt->execute();
        $stmt->close();
    }

    public function Delete($id)
    {
        $stmt = $this->Context->Db->prepare("DELETE FROM `publicaciones` WHERE id = ?");

        $stmt->bind_param('s', $id);
        $stmt->execute();
        $stmt->close();
    }
}
