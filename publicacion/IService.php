<?php
interface IServicePublicacion {
    public function GetAll($userId);
    public function GetById($id);
    public function Add($obj);
    public function Update($obj);
    public function Delete($id);
}

?>