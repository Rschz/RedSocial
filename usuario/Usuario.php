<?php

class Usuario
{
   public $Id;
   public $Nombre;
   public $Apellido;
   public $Telefono;
   public $Correo;
   public $Usuario;
   public $Contrasena;

   public function __construct($id, $nom, $ape, $tel,$corr,$usu,$contr)
   {
      $this->Id = $id;
      $this->Nombre = $nom;
      $this->Apellido = $ape;
      $this->Telefono = $tel;
      $this->Correo = $corr;
      $this->Usuario = $usu;
      $this->Contrasena = $contr;

   }

   
    
}



?>