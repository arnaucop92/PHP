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
            <form method="post" action="../include/registre.php">
                <article id="formulario">
                    <fieldset id="registro">
                        <legend>Registro nuevo usuario</legend>
                        <div class="registro">
                            <label class="label" for="usuario">Usuario:</label>
                            <input type="text" class="input3" name="usuario"/>
                            <label class="label" for="contrasenya">Contraseña:</label>
                            <input type="text" class="input3" name="contrasenya"/>
                            <label class="label" for="contrasenya2">Repite contrasenya:</label>
                            <input type="text" class="input3" name="contrasenya2"/>
                            <div>
                            <?php
                            if (isset($_SESSION["noIguales"])) {
                                $rusuario = $_SESSION["noIguales"];
                                if ($rusuario == "noiguales") {
                                    echo '<p id="mensage">Error. Las contrasenyas no son iguales.</p>';
                                }
                            }else if (isset($_SESSION["vacio"])){
                                 $vacio = $_SESSION["vacio"];
                                if ($vacio == "vacio") {
                                    echo '<p id="mensage">Error. TODOS los campos son obligatorios.</p>';
                                }
                            }else if (isset($_SESSION["existeUsuario"])) {
                                $rusuario = $_SESSION["existeUsuario"];
                                if ($rusuario == "existeUsuario") {
                                    echo '<p id="mensage">Error. El usuario ya existe.</p>';
                                }
                            }
                            session_unset();
                            session_destroy();
                            ?>
                            </div>
                            <li id="botones">
                                <input type="submit" id="enviar" value="Enviar"/>
                                <input type="reset" id="reset" value="Borrar"/>
                            </li>
                        </div>
                    </fieldset>    
                </article>        
            </form>
        </div> 
    </body>
</html>
