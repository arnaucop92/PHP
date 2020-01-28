
<?php

if (isset($_SESSION["usuario"]) && isset($_SESSION["contrasenya"])) {
    $usuario = $_SESSION["usuario"];
    $contrasenya = $_SESSION["contrasenya"];
    if (isset($_GET["cambio"])) {
        if ($_GET["cambio"] == "ok") {
            include './include/datosCambioFoto.php';
        }
    } else {
        echo '<div class="inici">
    <div id="tenda">
        <div id="contenidor">
            <h2>BIENVENIDOS A LA TIENDA ONLINE</h2>
            <img alt="bienvenida" id="bienvenida" img src="./img/bienvenida.jpeg">
        </div>
    </div>
</div>';
    }
} else {
    echo '<div class="inici">
    <div id="tenda">
        <div id="contenidor">
            <h2>BIENVENIDOS A LA TIENDA ONLINE</h2>
            <img alt="bienvenida" id="bienvenida" img src="./img/bienvenida.jpeg">
        </div>
    </div>
</div>';
}
?>