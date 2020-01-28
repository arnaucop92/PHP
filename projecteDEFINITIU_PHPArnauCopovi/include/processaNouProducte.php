<?php

session_start();
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
            if (move_uploaded_file($_FILES['fitxer']['tmp_name'], '../img/productos/' . $nombreFichero)) {
                chmod('../img/productos/' . $nombreFichero, 0644);
                $servidor = "localhost";
                $usuari = "root";
                $contrasenya = "";
                $basedades = "projectePHPArnauCopovi";
// Creem la connexió
                $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
// Comprovem la connexió
                if (!$connexio) {
                    die("Error de connexió: " . mysqli_connect_error());
                    $_SESSION["mensajeSubida"] = "errorConexion";
                    echo'error conexion';
                }
//  Introduïm la instrucció SQL en la variable $sql
                $sql = "INSERT INTO productos (id, nombre, descripcion, precio, imagen, megusta, fecha, estoc)
VALUES (NULL,'" . $nombreProducto . "', '" . $descripcion . "', '" . $precio . "', '" . $nombreFichero . "','0',CURRENT_TIMESTAMP,'" . $estoc . "')";
// Executem la instrucció, comprovant si hi ha hagut algun tipus d'error
                if (mysqli_query($connexio, $sql)) {
                    $ultim_id = mysqli_insert_id($connexio);
                    echo "Nou registre creat amb èxit. Últim id: " . $ultim_id;
                    $_SESSION["mensajeSubida"] = "registroCorrecto";
                    header("Location: ../index.php?page=productos");
                    die();
                } else {
                    echo "Error: " . $sql . "<br/>" . mysqli_error($connexio);
                    $_SESSION["mensajeSubida"] = "errorRegistro";
                }
//Tanquem la connexió abans d'acabar
                mysqli_close($connexio);
            } else {
                $_SESSION["mensajeSubida"] = "errorMover";
            }
        }
    } else {
        $_SESSION["mensajeSubida"] = "errorExtension";
    }
} else {
    $servidor = "localhost";
    $usuari = "root";
    $contrasenya = "";
    $basedades = "projectePHPArnauCopovi";
    $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
    if (!$connexio) {
        die("Error de connexió: " . mysqli_connect_error());
        $_SESSION["mensajeSubida"] = "errorConexion";
        echo'error conexion';
    }
    $sql = "INSERT INTO productos (id, nombre, descripcion, precio, imagen, megusta, fecha, estoc)
VALUES (NULL,'" . $nombreProducto . "', '" . $descripcion . "', '" . $precio . "', 'defecto.jpg','0',CURRENT_TIMESTAMP,'" . $estoc . "')";
    if (mysqli_query($connexio, $sql)) {
        $ultim_id = mysqli_insert_id($connexio);
        $_SESSION["mensajeSubida"] = "registroCorrecto";
        header("Location: ../index.php?page=productos");
        die();
    } else {
        echo "Error: " . $sql . "<br/>" . mysqli_error($connexio);
        $_SESSION["mensajeSubida"] = "errorRegistro";
    }
    mysqli_close($connexio);
}
header("Location: ../include/nouProducte.php");
die();
?>