<?php
session_start();
if (isset($_SESSION["color"])) {
    $color = $_SESSION["color"];
    if ($color == "amarillo") {
        echo '<link href="../css/amarillo.css" rel="stylesheet">';
    } else if ($color == "blanco") {
        echo '<link href="../css/blanco.css" rel="stylesheet">';
    } else {
        echo '<link href="../css/estils.css" rel="stylesheet">';
    }
} else {
    echo '<link href="../css/estils.css" rel="stylesheet">';
}
?>
<div class="inici">
    <body>
        <h1>STAR<br />WARS <br/>SH0P</h1>
        <div  id="contenidor">
            <h2>DETALLES DEL PEDIDO</h2>
            <p id ="totalPedido"><a href="../index.php?page=pedidos">Volver al menu de admin.</a></p>
            <div id="mostrarPedido">
                <?php
                $precioTotal = 0;
                if (isset($_GET["pedidoAVer"])) {
                    $pedido = $_GET["pedidoAVer"];
                }
                if ($fp = fopen("pedidos.txt", "r")) {
                    while (!feof($fp)) {
                        $linia = fgets($fp);
                        $palabras = explode(":", $linia);
                        $cont = 0;
                        foreach ($palabras as $a => $b) {
                            if ($pedido == $b && $a == 0) {
                                $palabras = explode(":", $linia);
                                foreach ($palabras as $a => $b) {
                                    if ($a == 0) {
                                        echo '<div id ="verCarrito">';
                                        echo 'ID Pedido: ' . $b;
                                        echo '</div>';
                                    } else if ($a == 1) {
                                        echo '<div id ="verCarrito">';
                                        echo 'Usuario: ' . $b;
                                        echo '</div>';
                                    } else if ($a >= 2 && $cont == 0) {
                                        echo '<div id ="verCarrito">';
                                        echo '<p>';
                                        echo 'Producto: ' . $b;
                                        echo '</p>';
                                        $cont ++;
                                    } else if ($a > 2 && $cont == 1) {
                                        echo '<p>';
                                        echo 'Cantidad: ' . $b;
                                        echo '</p>';
                                        $cantidad = (int) $b;
                                        $cont ++;
                                    } else if ($a > 2 && $cont == 2) {
                                        echo '<p>';
                                        echo 'Precio: ' . $b;
                                        echo '</p>';
                                        echo '</div>';
                                        $precio = (float) $b;
                                        $cont ++;
                                    } if ($cont == 3) {
                                        $cont = 0;
                                        $precioTotal += $cantidad * $precio;
                                    }
                                }
                            }
                        }
                    }
                    echo '<p>Total precio pedido: '. $precioTotal . '€</p>';
                } else {
                    echo "error obrint el fitxer";
                }
                ?>
            </div>
        </div>
    </body>
</div>