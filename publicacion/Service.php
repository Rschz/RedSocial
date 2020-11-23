<?php
require_once('IService.php');

class PublicacionService implements IService
{
    private $Db;

    public function __construct($dir)
    {
        $this->Db = new Conexion($dir);
    }


    public function GetLastId()
    {

    }

    public function GetAll()
    {

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
