<?php
session_start();
$usuario = $_SESSION["usuario"];
if(isset($_GET["foto"]) &&  $_GET["foto"] == "eliminar"){
    array_map('unlink', glob('../img/usuarios/'. $usuario. '.*'));
}
header("Location: ../index.php?page=inici&cambio=ok");
?>
