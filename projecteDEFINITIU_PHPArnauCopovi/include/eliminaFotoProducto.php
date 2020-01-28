<?php

session_start();
if (isset($_GET["idEliminaFoto"])) {
    $idEliminaFoto = $_GET["idEliminaFoto"];
}
$servidor = "localhost";
$usuari = "root";
$contrasenya = "";
$basedades = "projectePHPArnauCopovi";
$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
if (!$connexio) {
    die("Error de connexió: " . mysqli_connect_error());
}
$sql = "SELECT imagen FROM productos WHERE id='" . $idEliminaFoto . "'";
$resultat = mysqli_query($connexio, $sql);

if (mysqli_num_rows($resultat) > 0) {
    while($row = mysqli_fetch_assoc($resultat)) {
        echo $row["imagen"];
        array_map('unlink', glob('../img/productos/' . $row["imagen"]));
    }
}
$sql2 = "UPDATE productos SET imagen='defecto.jpg' WHERE id='" . $idEliminaFoto . "'";
if (mysqli_query($connexio, $sql2)) {
    $_SESSION["mensajeSubida"] = "fotoBorrada";
}
$connexio->close();
header("Location: ../include/editaProducte.php?productoEditar=".$idEliminaFoto."");
die();
?>