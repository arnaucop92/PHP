<div class="navegacio">
    <?php
    $items = array("inici", "productes", "contacte");

    foreach ($items as $item) {
        if (isset($_GET['page']) && $_GET['page'] == $item) {
            echo '<a href="?page=' . $item . '"class="active"> ' . $item . '</a>';
            $activePage = $item . ".php";
        } else {
            echo '<a href="?page=' . $item . '">' . $item . '</a>';
        }
    }
    ?>
    <div id="carret">
        <?php
        if (isset($_SESSION['numeroProductos']) && $_SESSION['numeroProductos'] != 0) {
            $numeroProductos = $_SESSION['numeroProductos'];
            echo '<p id="cantidadProductos">Productos: '.$numeroProductos .'</p>';
        }
        ?>
        <a href="./index.php?page=productes&carrito=ver"><img id="fotoCarret" src="./img/carret2.png"/></a>
        <a href="./index.php?page=productes&carrito=finalizar"><img id="fotoPago" src="./img/pago.png"/></a>
    </div>
</div>
<?php
if (isset($activePage)) {
    include $activePage;
} else {
    include "inici.php";
}
?>