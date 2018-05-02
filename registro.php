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
        <div class="container">
          <h1>Formulario de Registro</h1>
          <label for="" >
            <input type="text" class="texto" name="nombre" value="" placeholder="Tu Nombre">
          </label>
          <br>
          <label for="">
            <input type="text" class="texto" name="apellido" value="" placeholder="Tu Apellido">
          </label>
          <br>
          <label for="" >
            <input type="email" class="texto" name="correo" value="" placeholder="Tu Email">
          </label>
          <br>
            <ul>
              <li class="estado_soltero"><h3 class="estado"><input type="radio" name="estado_civil" class="1estado" value="soltero">Hombre</h3></li>
              <li class="estado_civil"><h3 class="estado"><input type="radio" name="estado_civil" class="1estado" value="casado">Mujer</h3></li>
            </ul>
          <br>
          <div class="botones">


          <input type="button" name="registro" class="boton_registro" value="Registrarse">
          <input type="reset" name="borrar" class="boton_borrar" value="Borrar">
          </div>  
        </div>
        </div>
      </section>
      </fieldset>
      <footer>
              <?php  include "pie_pagina.php"; ?>
      </footer>
  </body>
</html>
