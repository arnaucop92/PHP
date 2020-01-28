<div id="contenidor">
    <?php
    if (isset($_SESSION["mensage"])) {
        $mensage = $_SESSION["mensage"];
        if ($mensage == "unidadesInsu") {
            echo '<p id=unidadesInsu>¡No quedan tantas unidades!</p>';
        }
        unset($_SESSION["mensage"]);
    }
    if (isset($_GET["carrito"])) {
        if ($_GET["carrito"] == "ver") {
            include "verCarrito.php";
        } else if ($_GET["carrito"] == "finalizar") {
            include "finalizarCompra.php";
        }
    } else {
        echo'<h2 id ="cantidadProductos">PRODUCTOS</h2>';
        isset($_GET['pagina']) ? $pagina = $_GET['pagina'] : $pagina = 0;
        $elem_per_pagina = 5;
        $servidor = "localhost";
        $usuari = "root";
        $contrasenya = "";
        $basedades = "projectePHPArnauCopovi";

        $connexio = new mysqli($servidor, $usuari, $contrasenya, $basedades);

        if ($connexio->connect_error) {
            die("Error de connexió: " . $conn->connect_error);
        }
        $offset = $pagina * $elem_per_pagina;
        $sql = "SELECT id,nombre,descripcion,precio,imagen,megusta,estoc FROM productos LIMIT $elem_per_pagina OFFSET $offset";
        $resultat = $connexio->query($sql);

        if ($resultat->num_rows > 0) {
            // dades d'eixida de cada fila
            while ($row = $resultat->fetch_assoc()) {
                echo '<div class="productos">';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo $row["nombre"];
                echo '</div>';
                echo '</div>';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo '<img id="1" src="./img/productos/' . $row["imagen"] . '"/>';
                echo '</div>';
                echo '</div>';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo $row["descripcion"];
                echo '</div>';
                echo '</div>';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo $row["precio"] . ' €';
                echo '</div>';
                echo '</div>';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo 'Me gusta: ' . $row["megusta"] . '   <a href="./include/magrada.php?idProducto=' . $row["id"] . '"><img id="usuario" src="./img/like.png"/></a>';
                echo '</div>';
                echo '</div>';
                echo '<div class="fila1">';
                echo '<div class="columna2">';
                echo 'Stock: ' . $row["estoc"];
                echo '</div>';
                echo '</div>';
                echo '<div>';
                if ($row["estoc"] == 0) {
                    echo'<p>PRODUCTO AGOTADO</p>';
                    echo '</div>';
                } else {
                    echo '<div>
      <form method="post" action="./include/procesaCarret.php?producto=' . $row["id"] . '&estoc=' . $row["estoc"] . '">
      <label class="label" for="cantidad">Cantidad:</label>
      <input type="number" class="input2" name="cantidad" valor="1" min="1" max="120"/>
      </div>
      <div>
      <input type="submit" id="enviar" value="Añadir al carrito" />
      </div></form>';
                    echo '</div>';
                }
                echo '</div>';
            }
        } else {
            //no s'ha trobat cap resultat
            echo "0 resultats";
        }
    }

    /*     * else {
      include 'dadesCarret.php';
      foreach ($dades as $producte => $value) {
      echo '<div class="productos">';
      foreach ($value as $informacio => $apartat) {
      echo '<div class="fila1">';
      echo '<div class="columna2">';
      echo $apartat;
      echo '</div>';
      echo '</div>';
      }
      echo '<div>
      <form method="post" action="./include/procesaCarret.php?producto=' . $producte . '">
      <label class="label" for="cantidad">Cantidad:</label>
      <input type="number" class="input2" name="cantidad" valor="1" min="1" max="120"/>
      </div>
      <div>
      <input type="submit" id="enviar" value="Añadir al carrito" />
      </div></form>';
      echo '</div>';
      }
      }* */
    ?>
</div>

<!-- Sabent quin és l'offset i la quantitat d'elements, calculem quantes pàgines fan falta -->
<?php
if (!isset($_GET["carrito"])) {
    echo'<div id="paginacio">';
    //quan tenim una consunta amb funcions d'agregació, cal definir alias amb 'as'
    $sql = "SELECT COUNT(*) as total FROM productos";
    $resultat = mysqli_query($connexio, $sql);
    if (mysqli_num_rows($resultat) > 0) {
        $row = mysqli_fetch_assoc($resultat);
        echo "Cantidad de productos: " . $row['total'] . "<br/>";
        echo "Productos por página: " . $elem_per_pagina . "<br/>";
        $n_pagines = ceil($row['total'] / $elem_per_pagina);
        echo "Número de páginas: " . $n_pagines . "<br/>";

        //Indicador anar a la primera pàgina 
        if ($pagina != 0) {
            echo '<a href="index.php?page=productes&pagina=0">Inicio</a>  ';
        } else {
            echo 'Inicio  ';
        }

        //Indicador anar a pàgina anterior
        if ($pagina != 0) {
            echo '<a href="index.php?page=productes&pagina=' . ($pagina - 1) . '"><<</a>  ';
        } else {
            echo '<< ';
        }

        for ($i = 0; $i < $n_pagines; $i++) {
            //si la pàgina és l'actual, no li fiquem enllaç
            if (($pagina) != $i) {
                echo ' <a href="index.php?page=productes&pagina=' . ($i) . '">' . ($i + 1) . '</a> ';
            } else {
                echo ($i + 1) . ' ';
            }
        }

        //Indicador anar a pàgina posterior
        //hem de veure si estem en l'última pàgina
        if (($pagina + 1) != $n_pagines) {
            echo '  <a href="index.php?page=productes&pagina=' . ($pagina + 1) . '" >>></a>';
        } else {
            echo '  >>';
        }

        //Indicador anar a l'última pàgina
        //hem de veure si estem en l'última pàgina
        if (($pagina + 1) != $n_pagines) {
            echo '  <a href="index.php?page=productes&pagina=' . ($n_pagines - 1) . '" >Final</a>';
        } else {
            echo '  Final';
        }
    } else {
        echo " No hi ha resultats";
    }

    //Tanquem la connexió abans d'acabar
    mysqli_close($connexio);
    echo'</div>';
}
?>
