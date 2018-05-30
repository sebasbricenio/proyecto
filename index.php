<?php
require_once('funciones.php');

if (estaLogueado()) {
    header('location:perfil.php');
    exit;
}

$email = '';

$errores = [];

if ($_POST) {
    $email = trim($_POST['email']);

    $errores = validarLogin($_POST);

    if (empty($errores)) {

        $usuario = mail_existente($email);

        loguear($usuario);

        if ($_POST['recordarme']) {
            setcookie('id', $usuario['id'], time() + 3600 );
        }

        header('location:perfil.php');
        exit;
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

          <input type="email" name="email" class="texto_sesion" value="" placeholder="Tu Usuario">
          <input type="password" name="password" class="texto_sesion" value="" placeholder="Tu Contraseña">

          <input type="submit" name="iniciar_session" class="boton_inicio" value="Iniciar Session">

          <a class="cambio_contrasenia" href="cambio_contrasenia.php">¿Olvidaste tu contraseña?</a>

          <div class="recordar"><input type="checkbox" name="recordarme" class="" value="recordarme"><label>Recordarme</label></div>

          <h1> Si no tenes cuenta</h1>
          <h1><a class="cambio" href="registro.php">Registrate Aqui</a></h1>
          </div>
      </div>
    </form>
    </section>
    <?php if (count($errores) > 0 ): ?>
            <div class="div-errores">
                <ul>
                <?php foreach ($errores as $value): ?>
                    <li><?=$value?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <footer>
     <?php  include "pie_pagina.php"; ?>
    </footer>
    </body>
</html>
