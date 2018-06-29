<?php

if($_POST){
  include("Models/Repositorios/Conexion.php");
  //$datos = conexion($_POST);
  $datos =new Conexion ($_POST['usuario'],$_POST['contrasenia']);
  $datos->nueva_db();
  $datos->nueva_tabla();
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Restauracion BD</title>
  </head>
  <body>
    <form class="" action="restaurar.php" method="post" autocomplete="off">
      <input type="text" name="usuario" value="" placeholder="Usuario">
      <input type="password" name="contrasenia" value="" placeholder="Contraseña">
      <input type="submit" name="Restaurar" value="Restaurar BD">
    </form>
  </body>
</html>
