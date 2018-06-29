<?php
session_start();
include ('./autoload.php');
use Proyecto\Models\Autenticadores\Autenticador;
use Proyecto\Models\Repositorios\RepositorioMySql;
if(!Autenticador::estaLogueado()){
  header('location:index.php');
  exit;
}
$repositorio = new RepositorioMySql();
$usuario = $repositorio->traerPorId($_SESSION['id']);
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
    <section class="formulario">
      <h1>Perfil de <?=$usuario['nickname']?></h1>
      <br><br>
      <a class="cierre_session" href="logout.php">Cerrar Session!</a>
    </section>
    <footer>
    </footer>
  </body>
</html>
