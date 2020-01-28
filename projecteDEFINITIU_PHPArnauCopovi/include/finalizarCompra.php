<div id ="carritoVer">
    <div>
        <h2 id ="cantidadProductos">FINALIZAR PEDIDO</h2>
        <?php
        if (isset($_SESSION['numeroProductos'])) {
            $numeroProductos = $_SESSION['numeroProductos'];
            echo '<p id="totalPedido">Numero de productos en el carrito: ' . $numeroProductos . '</p>';
        }
        ?>
    </div>
    <p id ="totalPedido"><a href="index.php?page=productes">SEGUIR COMPRANDO</a></p>
    <div>
        <?php
        $CarretCompra = unserialize($_SESSION["carret"]);
        $CarretCompra->mostrarProductoFinCompra();
       $_SESSION['carret'] = serialize($CarretCompra);
        ?>
    </div>
</div>
</div>