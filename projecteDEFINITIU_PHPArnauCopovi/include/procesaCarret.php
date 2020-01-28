<?php

include 'carretCompra.php';
session_start();
if (isset($_POST["cantidad"]) && isset($_GET["producto"])) {
    if ($_POST["cantidad"] == null) {
        $cantidad = 1;
    } else {
        $cantidad = $_POST["cantidad"];
    }
    if (isset($_GET["estoc"])) {
        $estoc = $_GET["estoc"];
    }
    if ($estoc >= $cantidad) {
        $productoAInsertar = $_GET["producto"];
        $CarretCompra = unserialize($_SESSION["carret"]);
        $CarretCompra->anyadirProducto($cantidad, $productoAInsertar);
        $_SESSION['numeroProductos'] = count($CarretCompra->getListaProductos());
        $_SESSION['carret'] = serialize($CarretCompra);
        header("Location: ../index.php?page=productes");
        die();
    }else{
        $_SESSION["mensage"]= "unidadesInsu";
        header("Location: ../index.php?page=productes");
        die();
    }
}
if (isset($_POST["modificarCantidad"]) && isset($_GET["producto"])) {
    $modificarCantidad = $_POST["modificarCantidad"];
    $producto = $_GET["producto"];
    $CarretCompra = unserialize($_SESSION["carret"]);
    $CarretCompra->modificarCantidadProducto($modificarCantidad, $producto);
    $_SESSION['carret'] = serialize($CarretCompra);
    header("Location: ../index.php?page=productes&carrito=ver");
    die();
}
if (isset($_GET["productoAEliminar"])) {
    $productoAEliminar = $_GET["productoAEliminar"];
    $CarretCompra = unserialize($_SESSION["carret"]);
    $CarretCompra->eliminarProducto($productoAEliminar);
    $_SESSION['carret'] = serialize($CarretCompra);
    header("Location: ../index.php?page=productes&carrito=ver");
    die();
}
?>