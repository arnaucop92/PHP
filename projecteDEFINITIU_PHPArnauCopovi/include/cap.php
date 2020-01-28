<div class="cap">
    <header id="cap">
        <!-- cap -->
        <h1>STAR<br />WARS <br/>SH0P</h1>
        <div id="formulariCap">
            <form id="cambiocss" method="post" action="./include/variableSessioCss.php">
                <p>Estilos pagina:</p>
                <label for="color">Blanco</label>
                <input type="radio" id="informacion" name="color" value="blanco" />
                <label for="color">Amarillo</label>
                <input type="radio" id="informacion" name="color" value="amarillo" />
                <input type="submit" id="enviar" value="Enviar" />
            </form>
            <?php
            if (isset($_SESSION["usuario"]) && (isset($_SESSION["contrasenya"]))) {
                $usuario = $_SESSION['usuario'];
                if ($usuario == "admin") {
                    echo '<img alt="usuario" id="usuario2" img src="./img/admin.png">';
                    echo 'Bienvenido ' . $usuario . ' ';
                    echo '<form id="cerrar" method="post" action="./include/cerrarSesion.php">
                    <input type="submit" for="cerrar" id="cerrarSesion" value="Cerrar sesión"/>
                    </form>';
                } else {
                    $files = array_diff(scandir('./img/usuarios/'), array('.', '..'));
                    foreach ($files as $file) {
                        $data = explode(".", $file);
                        $nombre = $data[0];
                        $extension = $data[1];
                        if ($usuario == $nombre) {
                            $usuario2 = $usuario;
                            $extension = $data[1];
                            break;
                        } else {
                            $usuario2 = "defecto";
                            $extension = "png";
                        }
                    }
                    echo '<a id="cambioImagen" href="./index.php?page=inici&cambio=ok">Cambiar imagen </a>';
                    echo '<img alt="usuario" id="usuario2" img src="./img/usuarios/' . $usuario2 . '.' . $extension . '">';
                    echo 'Bienvenid@ ' . $usuario . ' ';
                    echo '<form id="cerrar" method="post" action="./include/cerrarSesion.php">
                    <input type="submit" for="cerrar" id="cerrarSesion" value="Cerrar sesión"/>
                    </form>';
                }
            } else {
                echo '<form id="login" method="post" action="./include/processaLogin.php">
                <img alt="usuario" id="usuario" img src="./img/usuario.png">
                <label class="label" for="usuario">Usuario:</label>
                <input type="text" class="input" name="usuario" required/>
                <label class="label" for="contrasenya">Contraseña:</label>
                <input type="text" class="input" name="contrasenya" required/>
                <input type="submit" id="enviar" value="Entrar" />
                <p id="registro">¿No estas registrado? <a id="registroa" href="./include/dadesRegistre.php">Registro</a></p>';
                if (isset($_SESSION["error"])) {
                    $error = $_SESSION["error"];
                    if($error == "incorrecta"){
                        echo'<p id="mensage">::Contraseña incorrecta::</p>';
                        session_unset();
                    }else if($error == "existe"){
                        echo '<p id="mensage">::El usuario introducido no existe::</p>';
                        session_unset();
                    }
                }
                echo '</form>';
            }
            ?>        
        </div>
        <div class="data">
            <?php
            include "data.php";
            ?>
        </div> 
    </header>
</div>

