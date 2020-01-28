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
<html>
    <head>
        <meta charset="UTF-8">
        <title>ACTIVITAT REGISTRE</title>
    </head>
    <body>
        <h1>STAR<br />WARS <br/>SH0P</h1>
        <div id="formulari">
            <form method="post" action="../include/processaNouProducte.php" enctype="multipart/form-data">
                <article id="formulario">
                    <fieldset id="registro">
                        <legend>AÑADIR NUEVO PRODUCTO</legend>
                        <div class="registro">
                            <div class="formularioProducto">
                                <label class="label" for="nombreProducto">Nombre producto:</label>
                                <input type="text" class="input3" name="nombreProducto" required/>
                            </div>
                            <div class="formularioProducto">
                                <label class="label" for="descripcion">Descripcion:</label>
                                <textarea  name="descripcion" id="textarea" rows="2" cols="20" wrap="hard" placeholder="Texto aquí:"></textarea>
                            </div>
                            <div class="formularioProducto">
                                <label class="label" for="precio">Precio:</label>
                                <input type="text" class="input3" name="precio" required/>
                            </div>
                            <div class="formularioProducto">
                                <label class="label" for="estoc">Estoc:</label>
                                <input type="text" class="input3" name="estoc" required/>
                            </div>
                            <div class="formularioProducto">
                                <span>Imagen del producto:</span>
                                <span><input type="file" name="fitxer" id="fitxer"/></span>
                            </div>
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

<?php
include "../include/peu.php";
?>