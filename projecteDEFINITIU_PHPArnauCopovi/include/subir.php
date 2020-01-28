
<?php

session_start();
$usuario = $_SESSION["usuario"];
//obtenim fitxer que ha carregat l'usuari
//si no indiquem una ruta, es guarda a la carpeta on es troba el fitxer pujar.php
if (isset($_FILES['fitxer']) && !empty($_FILES['fitxer']['name'])) {
    //mida màxima 5MB
    $mida_fitxer = $_FILES['fitxer']['size'];
    $nombreFichero = $_FILES['fitxer']['name'];
    $palabras = explode(".", $nombreFichero);
    foreach ($palabras as $a => $b) {
        if ($a == 1) {
            $extension = $b;
            $_SESSION ["extension"] = $extension;
        }
    }
    if ($extension == "jpg" || $extension == "jpeg" || $extension == "gif" || $extension == "png") {
        if ($mida_fitxer > 5242880) {
            $_SESSION["mensajeSubida"] = "errorTamaño";
        } else {
            $files = array_diff(scandir('./img/usuarios/'), array('.', '..'));
            array_map('unlink', glob('../img/usuarios/' . $usuario . '.*'));
            if (move_uploaded_file($_FILES['fitxer']['tmp_name'], '../img/usuarios/' . $usuario . '.' . $extension)) {
                //canviem els permisos del fitxer
                chmod('../img/usuarios/' . $usuario . '.' . $extension, 0644);
                $_SESSION["mensajeSubida"] = "correcto";
            } else {
                $_SESSION["mensajeSubida"] = "errorMover";
            }
        }
    }else{
         $_SESSION["mensajeSubida"] = "errorExtension";
    }
} else {
    $_SESSION["mensajeSubida"] = "errorExiste";
}
header("Location: ../index.php?page=inici&cambio=ok");
die();
?>