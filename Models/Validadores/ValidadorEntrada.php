<?php

namespace Proyecto\Models\Validadores;

use Proyecto\Models\Repositorios\RepositorioMySql;

class ValidadorEntrada{

  public static function validarLogin($datos,  $repo){
    $mail = trim($datos['email']);
    $contrasenia = trim($datos['password']);
    $mensaje_errores = [];
    if($mail == ""){
          $mensaje_errores['correo'] = "El correo no debe de estar vacio";
    }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
          $mensaje_errores['correo'] = "Email invalido, por favor ingresa un email correcto";
    }elseif (!$usuario = $repo->TraerPorEmail($mail)){
            $mensaje_errores['correo']="El usuario no existe";
    }elseif (!password_verify($contrasenia, $usuario['pass'])) {
        $mensaje_errores['contrasenia'] = 'Usuario o Contraseña Incorrectas';
    }

    return $mensaje_errores;
  }

  public static function validarRegistro($datos, RepositorioMySql $repo){
    $nombre = trim($datos['nombre']);
    $apellido = trim($datos['apellido']);
    $contrasenia = trim($datos['password']);
    $mensaje_errores=[];
    $confirmacion_contrasenia = trim($datos['password_confirmar']);
    $mail = trim($datos['email']);

    if($nombre == ""){
          $mensaje_errores['nombre'] = "El nombre no debe de estar vacio";
    }

    if($apellido == ""){
          $mensaje_errores['apellido'] = "El apellido no debe de estar vacio";
    }

    if($contrasenia == "" || $confirmacion_contrasenia == ""){
      $mensaje_errores['contrasenia'] = "Completa tu contraseña";
    }elseif ($contrasenia != $confirmacion_contrasenia){
      $mensaje_errores['contrasenia']= "La contraseñas no coinciden";
    }

    if($mail == ""){
          $mensaje_errores['correo'] = "El correo no debe de estar vacio";
    }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
          $mensaje_errores['correo'] = "Email invalido, por favor ingresa un email correcto";
    }elseif ($repo->TraerPorEmail($mail)){
          $mensaje_errores['correo'] = "El mail ya existe, por favor ingrese otro";
    }

    return $mensaje_errores;
  }
}



 ?>
