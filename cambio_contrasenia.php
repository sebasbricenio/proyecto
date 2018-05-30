<?php
include 'funciones.php';

if (estaLogueado()) {
    header('location:perfil.php');
    exit;
}
$email = '';

$errores = [];

if ($_POST) {
    $email = trim($_POST['correo']);

    $errores = validarMail($_POST);

    if (empty($errores)) {
        MandarMail($_POST);
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



            <input type="email" name="correo" class="texto" value="" placeholder="Correo Electronico">
            </label>
            <input type="submit" name="registro" class="boton_registro" value="Enviar">
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
