<?php

class Conexion
{
    public $Db;
    function __construct($dir)
    {
        $fileHandler = new JsonHandler($dir,'db_config');
        $dbConfig = $fileHandler->ReadFile();

        $this->Db = new mysqli($dbConfig->server, $dbConfig->user,$dbConfig->psw,$dbConfig->db);
        if ($this->Db->connect_error) {
            exit("Error conectando a la base de datos");
        }
    } 
    
}




?>