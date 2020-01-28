<div class="inici">
    <div id="contenidor">
        <h2>ADMINISTRACIÓN </br> Bienvenido Admin.</h2>
        <div id="eliminaUsuari">
            <li>
                <p class="elimina">Nº</p>
                <p class="elimina">PEDIDO</p>
                <p class="elimina">USUARIO</p>
                <p class="elimina">ACCIÓN</p>
            </li>
            <?php
            $cont = 1;
            $okUsuario = "user";
            $okPedido = "cont";
            
            $fp = fopen("../projecteArnauCopovi/include/pedidos.txt", "r");
            while (!feof($fp)) {
                $linia = fgets($fp);
                $palabras = explode(":", $linia);
                foreach ($palabras as $a => $b) {
                    if ($a == 0) {
                        $okPedido = $b;
                    } else if ($a == 1) {
                        $okUsuario = $b;
                    }
                }
                if($okPedido != ""){
                echo '<li>
        <p class="elimina">' . $cont . '</p>
        <p class="elimina">' . $okPedido . '</p>
        <p class="elimina">' . $okUsuario . '</p>
        <a class="elimina" href="./include/verPedido.php?pedidoAVer=' . $okPedido . '"><img alt="papelera" id="papelera" img src="./img/lupa.png"></a>
                </li>';}
                $cont ++;
            }
            ?>
        </div>
        <h2>Página web en desarrollo.</h2>
    </div>
</div>