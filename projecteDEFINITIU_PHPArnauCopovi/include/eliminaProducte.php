<?php

session_start();
if (isset($_GET["productoEliminar"])) {
    $productoEliminar = $_GET["productoEliminar"];
}
$servidor = "localhost";
$usuari = "root";
$contrasenya = "";
$basedades = "projectePHPArnauCopovi";
// Creem la connexió
$connexio = new mysqli($servidor, $usuari, $contrasenya, $basedades);
// Comprovem la connexió
if ($connexio->connect_error) {
    die("Error de connexió: " . $connexio->connect_error);
}
$sql2 = "SELECT imagen FROM productos WHERE id='" . $productoEliminar . "'";
$resultat2 = $connexio->query($sql2);
if ($resultat2->num_rows > 0) {
    while ($row = $resultat2->fetch_assoc()) {
        array_map('unlink', glob('../img/productos/' . $row["imagen"]));
    }
}
// sql per eliminar un registre
$sql = "DELETE FROM productos WHERE id='" . $productoEliminar . "'";

// Executem la instrucció
if ($connexio->query($sql) === TRUE) {
    echo "Registre eliminat correctament";
    $_SESSION["productoEliminado"] = "ok";
} else {
    echo "Error eliminant registre" . $connexio->error;
}
//Tanquem la connexió abans d'acabar
$connexio->close();
header("Location: ../index.php?page=productos");
die();
?>