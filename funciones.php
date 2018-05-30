<?php
session_start();
function validar_datos($datos,$imagen){
    $mensaje_errores = [];
    $nombre = trim($datos['nombre']);
    $apellido = trim($datos['apellido']);
    $contrasenia = trim($datos['password']);
    $confirmacion_contrasenia = trim($datos['password_confirmar']);
    $mail = trim($datos['correo']);

    if($nombre == ""){
          $mensaje_errores['nombre'] = "El nombre no debe de estar vacio";
    }

    if($apellido == ""){
          $mensaje_errores['apellido'] = "El apellido no debe de estar vacio";
    }

    if($mail == ""){
          $mensaje_errores['correo'] = "El correo no debe de estar vacio";
    }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)){
          $mensaje_errores['correo'] = "Email invalido, por favor ingresa un email correcto";
    }elseif (mail_existente($mail)){
          $mensaje_errores['correo'] = "El mail ya existe, por favor ingrese otro";
    }

    if($contrasenia == "" || $confirmacion_contrasenia == ""){
      $mensaje_errores['contrasenia'] = "Completa tu contraseña";
    }elseif ($contrasenia != $confirmacion_contrasenia){
      $mensaje_errores['contrasenia']= "La contraseñas no coinciden";
    }
    if ($_FILES[$imagen]['error'] != UPLOAD_ERR_OK) {
        $mensaje_errores['imagen'] = "Por favor suba una foto";
    }
    return $mensaje_errores;
}

function mail_existente($mail){
  $todos_usuarios = traer_todos_datos();

  foreach($todos_usuarios as $usuarios){
    if($usuarios['correo'] == $mail){
      return $usuarios;
    }
  }
  return false;
}

function ValidarPass($datos){
  $mensaje_errores = [];
  $contrasenia = trim($datos['password']);
  $confirmacion_contrasenia = trim($datos['repetir_password']);
  if($contrasenia == "" || $confirmacion_contrasenia == ""){
    $mensaje_errores['contrasenia'] = "Completa tu contraseña";
  }elseif ($contrasenia != $confirmacion_contrasenia){
    $mensaje_errores['contrasenia']= "La contraseñas no coinciden";
  }
}

/*function CambiarPass($datos){
    $contrasenia = trim($datos['password']);
    $contrasenia = password_hash($dato['password'], PASSWORD_DEFAULT)
    $id = $_SESSION['id-cambio'];
    $usuarios = traer_todos_datos();
    foreach ($usuarios as $buscar_usuario) {
        $id = $buscar_usuario['id'];

        $usuario = [
            'nombre' => $buscar_usuario['nombre'],
            'correo' => $buscar_usuario['correo'],
            'password' => $contrasenia,
            'id' => $id,
            'foto' => 'img/'.'/'.$dato['correo'].'/' . $dato['correo']. '.' . pathinfo($_FILES[$imagen]['name'], PATHINFO_EXTENSION),
        ];
    }
    $usuario_json = json_encode($usuario);
}

function MandarMail($datos){
    $mail = trim($datos["correo"]);

    $destinatario = $mail;
    $asunto = "Restablecimiento de contraseña";
    $cuerpo = '
      <html>
        <head>
          <title></title>
        </head>
        <body>
          <h1>Hola!</h1>
          <p>
            <b>Has solicitado cambiar tu contraseña</b>. Para hacerlo, hace click en el siguiente. <a href="cambio_pass.php">Enlace</a>
          </p>
        </body>
      </html>
    ';

    //para el envío en formato HTML
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    //dirección del remitente
    $headers .= "From: Label <label@label.com>\r\n";

    //ruta del mensaje desde origen a destino
    $headers .= "Return-path: localhost\r\n";

    mail($destinatario,$asunto,$cuerpo,$headers);
}*/

function traer_todos_datos(){
    $todos_usuarios_json = file_get_contents('usuarios.json');

    $array_todos_usuarios = explode(PHP_EOL, $todos_usuarios_json);

    array_pop($array_todos_usuarios);

    $array_usuarios = [];

    foreach ($array_todos_usuarios as $usuarios) {
        $array_usuarios[] = json_decode($usuarios, true);

    }


    return $array_usuarios;
}

function crearUsuario($dato,$imagen){
    $usuario = [
        'nombre' => $dato['nombre'],
        'correo' => $dato['correo'],
        'password' => password_hash($dato['password'], PASSWORD_DEFAULT),
        'id' => traerUltimoID_Creado(),
        'foto' => 'img/'.'/'.$dato['correo'].'/' . $dato['correo']. '.' . pathinfo($_FILES[$imagen]['name'], PATHINFO_EXTENSION),
    ];

    return $usuario;
}

function agregarUsuario($dato,$imagen){
    $usuario = crearUsuario($dato,$imagen);

    $usuario_json = json_encode($usuario);

    file_put_contents('usuarios.json', $usuario_json . PHP_EOL , FILE_APPEND );
}

function traerUltimoID_Creado(){
    $todos_datos = traer_todos_datos();

    if (count($todos_datos) == 0) {
        return 1;
    }

    $ultimoUsuarioRegistrado = array_pop($todos_datos);

    $ultimoID_Creado = $ultimoUsuarioRegistrado['id'];

    return $ultimoID_Creado + 1;
}

function validarMail($datos){
  $array_ErroresADevolver = [];
  $mail = trim($datos['correo']);

  if ($mail == '') {
      $array_ErroresADevolver['correo'] = 'El Correo no debe de estar vacio';
  }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
      $array_ErroresADevolver['correo'] = 'Correo Invalido, por favor ingrese un correo correcto';
  }elseif (!mail_existente($mail)) {
      $array_ErroresADevolver['correo'] = 'Este correo no esta registrado';
  }else{
    $id = ObtenerId($mail);
    usuario_cambio_pass($id);
  }

  return $array_ErroresADevolver;
}
function validarLogin($datos){
    $array_ErroresADevolver = [];
    $mail = trim($datos['email']);
    $contrasenia = trim($datos['password']);

    if ($mail == '') {
        $array_ErroresADevolver['correo'] = 'El Correo no debe de estar vacio';
    }elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        $array_ErroresADevolver['correo'] = 'Correo Invalido, por favor ingrese un correo correcto';
    }elseif (!mail_existente($mail)) {
        $array_ErroresADevolver['correo'] = 'Este correo no esta registrado';
    }else {
        $usuario = mail_existente($mail);

        if (!password_verify($contrasenia, $usuario['password'])) {
            $array_ErroresADevolver['password'] = 'Usuario o Contraseña Incorrectas';
        }
    }

    return $array_ErroresADevolver;
}

function loguear($usuario){
    $_SESSION['id'] = $usuario['id'];
}

function usuario_cambio_pass($usuario){
    $_SESSION['id-cambio'] = $usuario['id'];
}

function estaLogueado(){
    return isset($_SESSION['id']);
}

function traer_todos_ID($id){
    $todos_usuarios = traer_todos_datos();

    foreach ($todos_usuarios as $usuarios) {
        if ($usuarios['id'] == $id) {
            return $usuarios;
        }
    }
    return false;
}

function ObtenerId($mail){
    $todos_usuarios = traer_todos_datos();

    foreach ($todos_usuarios as $usuarios) {
        if ($usuarios['mail'] == $mail) {
            return $usuarios['id'];
        }
    }
}
function guardarFoto($imagen){
    $errores = [];

    if ($_FILES[$imagen]['error'] == UPLOAD_ERR_OK) {
        $nombreArchivo = $_FILES[$imagen]['name'];

        $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

        $archivoFisico = $_FILES[$imagen]['tmp_name'];

        if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG') {

            //$dondeEstoyParado = dirname(__FILE__);
            mkdir('img/'.$_POST['correo'], 0777, true);

            $rutaFinalConNombre = 'img/'.$_POST['correo'].'/'.$_POST['correo'] . '.' . $ext;

            move_uploaded_file($archivoFisico, $rutaFinalConNombre);

        }else {
                $errores['imagen'] = 'La foto no tiene un formato valido';
        }

    }else {
        $errores['imagen'] = 'No subiste ninguna foto';
    }

    return $errores;
}
?>
