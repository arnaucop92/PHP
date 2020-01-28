<div id ="carritoVer">
    <h2 id ="cantidadProductos">CARRITO</h2>
    <div>
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
        if ($_SESSION['numeroProductos'] == 0) {
            echo '<p id="totalPedido">CARRITO VACIO</p>';
        } else {
            $CarretCompra = unserialize($_SESSION["carret"]);
            $CarretCompra->mostrarProducto();
            $_SESSION['carret'] = serialize($CarretCompra);
        }
        ?>
    </div>
</div>
</div>

