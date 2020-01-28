<?php
include 'carretCompra.php';
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
$CarretCompra = unserialize($_SESSION["carret"]);
$CarretCompra->anyadirLosPedidos();
$CarretCompra->actualizarEstock();
$CarretCompra->eliminarProductos();
$_SESSION['carret'] = serialize($CarretCompra);
$_SESSION['numeroProductos'] = 0;
?>
<div>
    <body>
        <h1>STAR<br />WARS <br/>SH0P</h1>
        <div id ="contenidor">
            <div id="mensajeCorrecto">
                <p id="correcto">PEDIDO REALIZADO CORRECTAMENTE</p>
                <p>En breve recibirá un correo electrónico con todos los datos de su factura.<br>
                    El envio previsto: 4-7 dias.<br>
                    ¡Gracias por confiar en nosotros!</p>
                <a href="../index.php">Volver a inicio</a>
            </div>
        </div>
    </body>
</div>