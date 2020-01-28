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
if (isset($_GET["productoEditar"])) {
    $productoAEditar = $_GET["productoEditar"];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACTIVITAT REGISTRE</title>
    </head>
    <body>
        <h1>STAR<br />WARS <br/>SH0P</h1>
        <div id="formulari">
            <form method="post" action="../include/processaEditaProducte.php" enctype="multipart/form-data">
                <article id="formulario">
                    <fieldset id="registro">
                        <legend>EDITAR PRODUCTO</legend>
                        <div class="registro">
                            <?php
                            $servidor = "localhost";
                            $usuari = "root";
                            $contrasenya = "";
                            $basedades = "projectePHPArnauCopovi";
                            // Creem la connexió
                            $connexio = new mysqli($servidor, $usuari, $contrasenya, $basedades);
                            // Comprovem la connexió
                            if ($connexio->connect_error) {
                                die("Error de connexió: " . $connexio->connect_error);
                            }
                            // sql per eliminar un registre
                            $sql = "SELECT id,nombre,descripcion,precio,imagen,megusta,fecha,estoc FROM productos WHERE id='" . $productoAEditar . "'";
                            $resultat = $connexio->query($sql);
                            // Executem la instrucció, comprovant si hi ha hagut algun tipus d'error i si n'ha retornat més de 0
                            if ($resultat->num_rows > 0) {
                                // dades d'eixida de cada fila
                                while ($row = $resultat->fetch_assoc()) {
                                    echo ' <div class="formularioProducto">
                                            <label class="label" for="idProducto">Id producto:</label>
                                            <input type="text" class="input3" name="idProducto" value="' . $row["id"] . '" readonly/>
                                           </div>';
                                    echo ' <div class="formularioProducto">
                                            <label class="label" for="nombreProducto">Nombre producto:</label>
                                            <input type="text" class="input3" name="nombreProducto" value="' . $row["nombre"] . '" required/>
                                           </div>';
                                    echo '<div class="formularioProducto">
                                            <label class="label" for="descripcion">Descripcion:</label>
                                            <textarea  name="descripcion" id="textarea" rows="2" cols="20" wrap="hard" >' . $row["descripcion"] . '</textarea>
                                           </div>';
                                    echo ' <div class="formularioProducto">
                                            <label class="label" for="precio">Precio:</label>
                                            <input type="text" class="input3" name="precio" value="' . $row["precio"] . '" required/>
                                           </div>';
                                    if ($row["imagen"] == "defecto.jpg") {
                                        echo '<div class="formularioProducto">
                                <span>Imagen del producto:</span>
                                <span><input type="file" name="fitxer" id="fitxer"/></span>
                            </div>';
                                    } else {
                                        echo ' <div class="formularioProducto">
                                            <span class="label">Imagen del producto:</span>
                                            <span class="input3"><img alt="imagenProductos" class="imagenProductos" img src="../img/productos/' . $row["imagen"] . '"><a id="eliminaFoto" href="../include/eliminaFotoProducto.php?idEliminaFoto='.$row["id"].'">Eliminar imagen</a></span>
                                           </div>';
                                    }
                                    echo ' <div class="formularioProducto">
                                            <span class="label" >Me gusta:</span>
                                            <span class="input3">' . $row["megusta"] . '<span/>
                                           </div>';
                                    echo ' <div class="formularioProducto">
                                            <span class="label" >Fecha registro producto:</span>
                                            <span class="input3">' . $row["fecha"] . '<span/>
                                           </div>';
                                    echo ' <div class="formularioProducto">
                                            <label class="label" for="estoc">Estock:</label>
                                            <input type="text" class="input3" name="estoc" value="' . $row["estoc"] . '" required/>
                                           </div>';
                                }
                            } else {
                                //no s'ha trobat cap resultat
                                echo "0 resultats";
                            }
                            //Tanquem la connexió abans d'acabar
                            $connexio->close();
                            ?>
                            <li id="formularioProducto">
                                <input type="submit" id="enviar" value="Enviar"/>
                                <input type="reset" id="reset" value="Borrar"/>
                                <a  href="../index.php?page=productos" id="volver">Volver a la gestión de productos </a>
                            </li>
                            <?php
                            if (isset($_SESSION["mensajeSubida"])) {
                                $mensaje = $_SESSION["mensajeSubida"];
                                if ($mensaje == "errorTamaño") {
                                    echo '<p id="mensage">ERROR :: El archivo supera el tamaño.<p>';
                                } else if ($mensaje == "errorMover") {
                                    echo '<p id="mensage">ERROR :: No se ha podido subir el archivo.<p>';
                                } else if ($mensaje == "errorExiste") {
                                    echo '<p id="mensage">ERROR :: Error de fichero.<p>';
                                } else if ($mensaje == "errorExtension") {
                                    echo '<p id="mensage">ERROR :: La imagen no es de tipo jpg, jpeg, gif o png.<p>';
                                } else if($mensaje == "errorRegistro"){
                                     echo '<p id="mensage">ERROR :: No se puede registrar el producto.<p>';
                                } else if($mensaje == "errorConexion"){
                                     echo '<p id="mensage">ERROR :: No es posible conectarse a la base de datos.<p>';
                                }else if($mensaje == "fotoBorrada"){
                                    echo '<p id="mensageOk">Imagen eliminada correctamente.<p>';
                                }
                                unset($_SESSION["mensajeSubida"]);
                            }
                            ?>
                        </div>
                    </fieldset>    
                </article>        
            </form>
        </div> 
    </body>
</html>
