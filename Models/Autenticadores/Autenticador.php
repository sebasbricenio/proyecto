<?php

namespace Proyecto\Models\Autenticadores;

use Proyecto\Models\Repositorios\RepositorioMySql;

class Autenticador{


  public static function loguear($usuario, $repo){
      //session_start();
      $usuarioLoguear = $repo->TraerPorEmail($usuario['email']);
      $_SESSION['id'] = $usuarioLoguear['id'];
  }

  public static function estaLogueado(){
    return isset($_SESSION['id']);
  }

  public static function desloguear(){
    session_start();

    setcookie('id', '', time() -10);

    session_destroy();

    header('location:index.php');
    exit;

  }

  public static function usuarioLogueado(){
     setcookie('id', $_SESSION['id'], time() + 3600 );
     return $_SESSION['id'];
  }
}



 ?>
