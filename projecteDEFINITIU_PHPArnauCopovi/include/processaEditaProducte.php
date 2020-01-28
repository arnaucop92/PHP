<?php

session_start();
if (isset($_POST["idProducto"])) {
    $idProducto = $_POST["idProducto"];
}
if (isset($_POST["nombreProducto"])) {
    $nombreProducto = $_POST["nombreProducto"];
}
if (isset($_POST["descripcion"])) {
    $descripcion = $_POST["descripcion"];
}
if (isset($_POST["precio"])) {
    $precio = $_POST["precio"];
}
if (isset($_POST["estoc"])) {
    $estoc = $_POST["estoc"];
}
$servidor = "localhost";
$usuari = "root";
$contrasenya = "";
$basedades = "projectePHPArnauCopovi";
// Creem la connexió
$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
// Comprovem la connexió
if (!$connexio) {
    die("Error de connexió: " . mysqli_connect_error());
}
if (isset($_FILES['fitxer']) && !empty($_FILES['fitxer']['name'])) {
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
            if (move_uploaded_file($_FILES['fitxer']['tmp_name'], '../img/productos/' . $nombreFichero)) {
                chmod('../img/productos/' . $nombreFichero, 0644);
                $sql = "UPDATE productos SET nombre='" . $nombreProducto . "', descripcion='" . $descripcion . "', precio='" 
                        . $precio . "', estoc='" . $estoc . "', imagen='".$nombreFichero."' WHERE id='" . $idProducto . "'";
                if (mysqli_query($connexio, $sql)) {
                    $_SESSION["mensajeSubida"] = "editadoOk";
                    header("Location: ../index.php?page=productos");
                    die();
                } else {
                    $_SESSION["mensajeSubida"] = "editadoError";
                }
                mysqli_close($connexio);
            } else {
                $_SESSION["mensajeSubida"] = "errorMover";
            }
        }
    } else {
        $_SESSION["mensajeSubida"] = "errorExtension";
    }
} else {
    $sql = "UPDATE productos SET nombre='" . $nombreProducto . "', descripcion='" . $descripcion . "', precio='" . $precio . "', estoc='" . $estoc . "' WHERE id='" . $idProducto . "'";
    if (mysqli_query($connexio, $sql)) {
        $_SESSION["mensajeSubida"] = "editadoOk";
         header("Location: ../index.php?page=productos");
         die();
    } else {
        $_SESSION["mensajeSubida"] = "editadoError";
    }
}
mysqli_close($connexio);
header("Location: ../include/editaProducte.php?productoEditar=".$idProducto."");
die();
?>