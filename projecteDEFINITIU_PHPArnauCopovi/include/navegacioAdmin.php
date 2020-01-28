<div class="navegacio">
    <?php
    $items = array("usuarios", "pedidos", "productos");

    foreach ($items as $item) {
        if (isset($_GET['page']) && $_GET['page'] == $item) {
            echo '<a href="?page=' . $item . '"class="active"> ' . $item . '</a>';
            $activePage = $item . ".php";
        } else {
            echo '<a href="?page=' . $item . '">' . $item . '</a>';
        }
    }
    ?>
</div>
<?php
if (isset($activePage)) {
    include $activePage;
} else {
    include "usuarios.php";
}
?>