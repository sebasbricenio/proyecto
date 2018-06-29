<?php
include ('./autoload.php');

use Proyecto\Models\Validadores\ValidadorEntrada;
use Proyecto\Models\Repositorios\RepositorioMySql;
use Proyecto\Models\Usuario;
$nombre = $apellido = $email = "";
$mensaje_error="";
if($_POST) {

  $nombre = trim($_POST['nombre']);
  $apellido = trim($_POST['apellido']);
  $email = trim($_POST['email']);
  try {
    $repositorio = new RepositorioMySql();

    $mensaje_error = ValidadorEntrada::validarRegistro($_POST, $repositorio);
    //var_dump($mensaje_error);
    if(empty($mensaje_error)){
        //echo "aca estoyyy";
      $usuario = new Usuario($_POST['nombre'], $_POST['email'], $_POST['password']);
      $crearUsuario= $usuario->hashearPassword();
      //var_dump($crearUsuario);
      $retorno = $repositorio->guardarUsuario($crearUsuario);
      if ($_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
        include("funcion.php");
        $mensaje_error = guardarFoto('imagen');
      }
      header('location:ingreso_correcto.php');
      exit;
    }
  }catch (Exception $e) {
    echo $e;
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
           <h1>Formulario de Registro</h1>
           <label for="" >
             <input type="text" class="texto" name="nombre" value="<?php print $nombre; ?> " placeholder="Tu Nombre"><span style="color: red;"> <?php isset($mensaje_error["nombre"]) ? print $mensaje_error["nombre"] : "";?></span>
           </label>
           <br>
           <label for="">
             <input type="text" class="texto" name="apellido" value=" <?php print $apellido; ?>" placeholder="Tu Apellido"><span style="color: red;"> <?php isset($mensaje_error["apellido"]) ? print $mensaje_error["apellido"] : "";?></span>
           </label>
           <br>
           <label for="" >
             <input type="email" class="texto" name="email" value="<?php print $email;?>" placeholder="Tu Email"><span style="color: red;"> <?php isset($mensaje_error["correo"]) ? print $mensaje_error["correo"] : "";?></span>
           </label>
           <br>
           <label for="" >
             <input type="password" class="texto" name="password" value="" placeholder="Tu contraseña"><span style="color: red;"><?php isset($mensaje_error["contrasenia"]) ? print $mensaje_error["contrasenia"] : "";?></span>
           </label>
           <br>
           <label for="" >
             <input type="password" class="texto" name="password_confirmar" value="" placeholder="confirmar tu contraseña"><span style="color: red;"><?php isset($mensaje_error["contrasenia"]) ? print $mensaje_error["contrasenia"] : "";?></span>
           </label>
           <br>
             <ul>
               <li class="estado_soltero"><h3 class="estado"><input type="radio" name="estado_civil" class="1estado" value="soltero">Hombre</h3></li>
               <li class="estado_civil"><h3 class="estado"><input type="radio" name="estado_civil" class="1estado" value="casado">Mujer</h3></li>
             </ul>
           <br><br><br>
           <div class="form-group">
               <input class="form-control" type="file" name="imagen" value=""><span style="color: red;"><?php isset($mensaje_error["imagen"]) ? print $mensaje_error["imagen"] : "";?></span>
           </div>
           <br>
           <div class="botones">


           <input type="submit" name="registro" class="boton_registro" value="Registrarse">
           <input type="reset" name="borrar" class="boton_borrar" value="Borrar">
           </div>
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
