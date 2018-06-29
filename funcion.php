<?php
function guardarFoto($imagen){
    $errores = [];

    $nombreArchivo = $_FILES[$imagen]['name'];

    $ext = pathinfo($nombreArchivo, PATHINFO_EXTENSION);

    $archivoFisico = $_FILES[$imagen]['tmp_name'];

    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png' || $ext == 'JPG') {
          mkdir('img/'.$_POST['email'], 0777, true);
          $rutaFinalConNombre = 'img/'.$_POST['email'].'/'.$_POST['email'] . '.' . $ext;
          move_uploaded_file($archivoFisico, $rutaFinalConNombre);
    }else{
          $errores['imagen'] = 'La foto no tiene un formato valido';
    }

    return $errores;
}
?>
