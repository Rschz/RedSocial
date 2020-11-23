<?php
require_once('IService.php');

class UserService implements IService
{
    private $Context;

    public function __construct($dir)
    {
        $this->Context = new Conexion($dir);
    }

    public function Login($user, $cont)
    {
        $stmt = $this->Context->Db->prepare("SELECT * FROM `users` WHERE usuario = ? AND contrasena = ?");
        $stmt->bind_param('ss', $user, $cont);
        $stmt->execute();

        $resul = $stmt->get_result();

        if ($resul->num_rows === 0) {
            return false;
        }else{
            $row = $resul->fetch_object();
            $user = new Usuario(
                $row->id,
                "",
                "",
                "",
                "",
                $row->usuario,
                ""
            );

            return $user;

            $stmt->close();

        }
        $stmt->close();
    }

    public function GetAll()
    {
    }

    public function GetById($id)
    {
    }

    public function Add($obj)
    {
        $stmt = $this->Context->Db->prepare("INSERT INTO `users`(`nombre`, `apellido`, `telefono`, `correo`, `usuario`, `contrasena`)
            VALUES (?,?,?,?,?,?)");

        $stmt->bind_param('ssssss', $obj->Nombre, $obj->Apellido, $obj->Telefono, $obj->Correo, $obj->Usuario, $obj->Contrasena);
        $stmt->execute();
        $stmt->close();
    }

    public function Update($obj)
    {
    }

    public function Delete($id)
    {
    }
}
