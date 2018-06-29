<?php
session_start();
include ('./autoload.php');

use Proyecto\Models\Validadores\ValidadorEntrada;
use Proyecto\Models\Repositorios\RepositorioMySql;
use Proyecto\Models\Usuario;
use Proyecto\Models\Autenticadores\Autenticador;

$email = "";
//$mensaje_error=[];
//var_dump($_SESSION['id']);
//exit;
if(Autenticador::estaLogueado()){
  header('location:perfil.php');
  exit;
}
if($_POST) {
  $email = trim($_POST['email']);
try {
  $repositorio = new RepositorioMySql();

  $mensaje_error = ValidadorEntrada::validarLogin($_POST, $repositorio);

  if(empty($mensaje_error)){
    $usuario = new Usuario('', $_POST['email'], $_POST['password']);
    $datos = $usuario->hashearPassword();

    $loguear= Autenticador::loguear($datos, $repositorio);
    if ($_POST['recordarme']) {
        $usuarioLogueado= Autenticador::usuarioLogueado();
    }
    
    header('location:perfil.php');
    exit;
  }
} catch (Exception $e) {
  echo $e;
}
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sclate=1.0">
    <title>Red Social</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <header class="cabecera">
      <?php include "cabecera.php"; ?>
  </header>
  <body>
    <section class="formulario">
      <form  method="post" enctype="multipart/form-data">
      <div class="container">

          <div class="inicio">

          <input type="email" name="email" class="texto_sesion" value="<?php print $email ?>" placeholder="Tu Usuario">
          <input type="password" name="password" class="texto_sesion" value="" placeholder="Tu Contraseña">

          <input type="submit" name="iniciar_session" class="boton_inicio" value="Iniciar Session">
          <span style="color: red;"><?php isset($mensaje_error["correo"]) ? print $mensaje_error["correo"] : "";?></span>
          <span class="cartel"><?php isset($mensaje_error["contrasenia"]) ? print $mensaje_error["contrasenia"] : "";?></span>
          <a class="cambio_contrasenia" href="cambio_contrasenia.php">¿Olvidaste tu contraseña?</a>

          <div class="recordar"><input type="checkbox" name="recordarme" class="" value="recordarme"><label>Recordarme</label></div>

          <h1> Si no tenes cuenta</h1>
          <h1><a class="cambio" href="registro.php">Registrate Aqui</a></h1>
          </div>
      </div>
    </form>
    </section>

    <footer>
     <?php  include "pie_pagina.php"; ?>
    </footer>
    </body>
</html>
