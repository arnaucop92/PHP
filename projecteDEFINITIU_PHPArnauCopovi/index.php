<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <?php
        include './include/carretCompra.php';
        session_start();
        if (isset($_SESSION["usuario"])) {
            $usuario = $_SESSION["usuario"];
        } else {
            $usuario = session_id();
        }
        if (!isset($_SESSION["carret"])) {
            $CarretCompra = new CarretCompra($usuario);
            $_SESSION['carret'] = serialize($CarretCompra);
            $CarretCompra = unserialize($_SESSION["carret"]);
            $_SESSION['numeroProductos'] = count($CarretCompra->getListaProductos());
        }
        ?>
        <?php
        if (isset($_SESSION["color"])) {
            $color = $_SESSION['color'];
            if ($color == "amarillo") {
                echo '<link href="./css/amarillo.css" rel="stylesheet">';
            } else if ($color == "blanco") {
                echo '<link href="./css/blanco.css" rel="stylesheet">';
            } else {
                echo '<link href="./css/estils.css" rel="stylesheet">';
            }
        } else {
            echo '<link href="./css/estils.css" rel="stylesheet">';
        }
        ?>
        <meta charset="UTF-8">
        <title>Activitat Formularis PHP</title>
    </head>
    <body>
        <div id='wrapper'>
            <?php
            include "./include/cap.php";
            if (isset($_SESSION["usuario"])) {
                $usuario = $_SESSION["usuario"];
                if ($usuario == "admin") {
                    include "./include/navegacioAdmin.php";
                    include "./include/peu2.php";
                } else {
                include "./include/navegacio.php";
                include "./include/peu.php";
            }
            } else {
                include "./include/navegacio.php";
                include "./include/peu.php";
            }
            ?>
    </body>
</html>
