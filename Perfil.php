<?php
require_once('funciones.php');

if (!estaLogueado()) {
    header('location:login.php');
    exit;
}

$usuario = traer_todos_ID($_SESSION['id']);
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
      <section class="formulario_perfil">
      <h1 class="perfil">Perfil de <?=$usuario['nombre']?></h1>
      <br><br>

      <a class="cierre_sesion" href="logout.php">Cerrar Session!</a>
    </section>
  </body>
</html>
