<?php
include 'funciones.php';

if (estaLogueado()) {
    header('location:perfil.php');
    exit;
}
$email = '';

$errores = [];

if ($_POST) {
    $errores = validarPass($_POST);
    if (empty($errores)) {
        CambiarPass($_POST);
        header('location:index.php');
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-sclate=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/style.css">
  </head>
  <header>
     <?php include "cabecera.php"; ?>
  </header>
  <body>
    <fieldset>
      <section class="formulario">
        <form  method="post" enctype="multipart/form-data">
          <div class="container">
            <h1>Recupero de contraseña</h1>
            <div class="inicio">
              <label>
                <input type="password" name="password" class="texto" value="" placeholder="Nueva contraseña">
              </label>
              <label>
                <input type="password" name="repetir_password" class="texto" value="" placeholder="Repetir Contraseña">
              </label>
              <input type="submit" name="enviar" class="boton_registro" value="Enviar">
              <input type="reset" name="borrar" class="boton_borrar" value="Borrar">
            </div>
          </div>
        </form>
      </section>
    </fieldset>
    <footer>
      <?php  include "pie_pagina.php"; ?>
    </footer>
  </body>
</html>
