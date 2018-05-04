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
      <div class="container">
      
          <div class="inicio">



          <input type="email" name="usuario" class="texto_sesion" value="" placeholder="Tu Usuario">
          <input type="password" name="contraseña" class="texto_sesion" value="" placeholder="Tu Contraseña">

          <input type="button" name="iniciar_session" class="boton_inicio" value="Iniciar Session">

 <a class="cambio_contrasenia" href="cambio_contrasenia.php">¿Olvidaste tu contraseña?</a>





          <div class="recordar"><input type="checkbox" name="recordarme" class="" value="recordarme"><label>Recordarme</label></div>

          <h1> Si no tenes cuenta</h1>
          <h1><a class="cambio" href="registro.php">Registrate Aqui</a></h1>
          </div>
      </div>
    </section>
    <footer>
     <?php  include "pie_pagina.php"; ?>
    </footer>
    </body>
</html>
