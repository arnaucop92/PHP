<div class="inici">
    <div id="contenidor">
        <h2>ADMINISTRACIÓN </br> Bienvenido Admin.</h2>
        <div id="eliminaUsuari">
            <li>
                <p class="elimina">Nº</p>
                <p class="elimina">USUARIO</p>
                <p class="elimina">CONTRASEÑA</p>
                <p class="elimina">ACCIÓN</p>
            </li>
            <?php
            $cont = 1;
            $okUsuario = "user";
            $okContrasenya = "cont";
            
            $fp = fopen("../projecteArnauCopovi/include/passwd.txt", "r");
            while (!feof($fp)) {
                $linia = fgets($fp);
                $palabras = explode(":", $linia);
                foreach ($palabras as $a => $b) {
                    if ($a == 0) {
                        $okUsuario = $b;
                    } else if ($a == 1) {
                        $okContrasenya = $b;
                    }
                }
                if($okUsuario != ""){
                echo '<li>
        <p class="elimina">' . $cont . '</p>
        <p class="elimina">' . $okUsuario . '</p>
        <p class="elimina">' . $okContrasenya . '</p>
        <a class="elimina" href="./include/eliminaUsuari.php?usuarioAEliminar=' . $okUsuario . '"><img alt="papelera" id="papelera" img src="./img/papelera2.png"></a>
                </li>';}
                $cont ++;
            }
            ?>
        </div>
        <h2>Página web en desarrollo.</h2>
    </div>
</div>