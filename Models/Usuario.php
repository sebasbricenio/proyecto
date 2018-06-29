<?php

namespace Proyecto\Models;


class Usuario {

  protected $nombre;
  protected $email;
  protected $pass;


  public function __construct($nombre, $email, $pass) {
    $this->nombre = $nombre;
    $this->email = $email;
    $this->pass = $pass;

  }

  public function hashearPassword() {

    $this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
      $crearUsuario = [
        "nombre" => $this->nombre,
        "pass" => $this->pass,
        "email" => $this->email,
      ];
    return $crearUsuario;
  }
}



 ?>
