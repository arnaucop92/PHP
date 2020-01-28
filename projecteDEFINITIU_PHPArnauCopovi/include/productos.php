<div id="contenidor">
    <h2>ADMINISTRACIÓN DE PRODUCTOS</h2>
    <?php
    if (isset($_SESSION["productoEliminado"])) {
        $productoEliminado = $_SESSION["productoEliminado"];
        if ($productoEliminado == "ok") {
            echo '<p id="mensageOk">Producto eliminado correctamente</p>';
        } 
    }else if(isset($_SESSION["mensajeSubida"])){
        $mensaje = $_SESSION["mensajeSubida"];
        if ($mensaje == "registroCorrecto") {
            echo '<p id="mensageOk">Producto registrado correctamente.<p>';
        }else  if ($mensaje == "editadoOk") {
            echo '<p id="mensageOk">Producto editado correctamente.<p>';
        }else  if ($mensaje == "editadoError") {
            echo '<p id="mensageOk">ERROR :: No se ha podido editar.<p>';
        }
    }
    unset($_SESSION["productoEliminado"]);
    unset($_SESSION["mensajeSubida"]);
    ?>
    <p id="anyadirProducte"><a id="enlaceNuevo" href="./include/nouProducte.php"><img alt="anyadir" id="anyadir" img src="./img/anyadir.png">Añadir nuevo producto</a></p>
    <div id="eliminaProducte">
        <li>
            <p class="eliminaProducte">ID</p>
            <p class="eliminaProducte">NOMBRE</p>
            <p class="eliminaProducte">PRECIO</p>
            <p class="eliminaProducte">IMAGEN</p>
            <p class="eliminaProducte">ESTOC</p>
            <p class="eliminaProducte">ACCIÓN</p>
        </li>
    </div>
    <?php
    $servidor = "localhost";
    $usuari = "root";
    $contrasenya = "";
    $basedades = "projectePHPArnauCopovi";
// Creem la connexió
    $connexio = new mysqli($servidor, $usuari, $contrasenya, $basedades);
// Comprovem la connexió
    if ($connexio->connect_error) {
        die("Error de connexió: " . $conn->connect_error);
    }

    $sql = "SELECT id,nombre,precio,imagen,estoc FROM productos";
    $resultat = $connexio->query($sql);


// Executem la instrucció, comprovant si hi ha hagut algun tipus d'error i si n'ha retornat més de 0
    if ($resultat->num_rows > 0) {
        // dades d'eixida de cada fila
        while ($row = $resultat->fetch_assoc()) {

            echo '<li>
        <p class="eliminaProducte">' . $row["id"] . '</p>
        <p class="eliminaProducte">' . $row["nombre"] . '</p>
        <p class="eliminaProducte">' . $row["precio"] . '</p>
        <p class="eliminaProducte"><img alt="imagenProductos" class="imagenProductos" img src="./img/productos/' . $row["imagen"] . '"></p>
        <p class="eliminaProducte">' . $row["estoc"] . '</p>                 
        <p class="eliminaProducte"><a class="eliminaProducte" href="./include/eliminaProducte.php?productoEliminar=' . $row["id"] . '"><img alt="papelera" id="papelera2" img src="./img/papelera2.png"></a>
        <a class="eliminaProducte" href="./include/editaProducte.php?productoEditar=' . $row["id"] . '"><img alt="papelera" id="papelera2" img src="./img/editar.png"></a></p> 
                </li>';
        }
    } else {
        //no s'ha trobat cap resultat
        echo "0 resultats";
    }
//Tanquem la connexió abans d'acabar
    $connexio->close();
    ?>
    <h2>Página web en desarrollo.</h2>
</div>