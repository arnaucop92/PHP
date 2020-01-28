
<?php

class CarretCompra {

    private $idUsuario;
    private $listaProductos;

    function __construct($idUsuario) {
        $this->idUsuario = $idUsuario;
        $this->listaProductos = array();
    }

    function getIdUsuario() {
        return $this->idUsuario;
    }

    function getListaProductos() {
        return $this->listaProductos;
    }

    function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }

    function setListaProductos($listaProductos) {
        $this->listaProductos = $listaProductos;
    }

    public function anyadirProducto($cantidad, $productoAInsertar) {
        $cont = 0;
        $cont2 = 0;
        $servidor = "localhost";
        $usuari = "root";
        $contrasenya = "";
        $basedades = "projectePHPArnauCopovi";

        $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
        if (!$connexio) {
            die("Error de connexió: " . mysqli_connect_error());
        }

        $sql = "SELECT nombre,precio FROM productos WHERE id='" . $productoAInsertar . "'";
        $resultat = mysqli_query($connexio, $sql);
        if (mysqli_num_rows($resultat) > 0) {
            while ($row = mysqli_fetch_assoc($resultat)) {
                $nombreProducto = $row["nombre"];
                $precioProducto = $row["precio"];
            }
        } else {
            echo "0 resultats";
        }

        mysqli_close($connexio);

        /* include 'dadesCarret.php';
          $cont = 0;
          $cont2 = 0;
          foreach ($dades as $productos => $value) {
          if ($productos == $productoAInsertar) {
          foreach ($value as $informacio => $apartat) {
          if ($cont == 0) {
          $nombreProducto = $apartat;
          } else if ($cont == 3) {
          $precioProducto = $apartat;
          }
          $cont ++;
          }
          }
          } */
        for ($index = 0; $index < count($this->listaProductos); $index++) {
            $producto = $this->listaProductos[$index];
            if ($producto->getIDProducto() == $productoAInsertar) {
                $producto->setUnidadesProducto($producto->getUnidadesProducto() + $cantidad);
                $cont2 ++;
            }
        }
        if ($cont2 == 0) {
            $producto = new Producto($productoAInsertar, $nombreProducto, $cantidad, $precioProducto);
            $this->listaProductos [] = $producto;
        }
    }

    public function mostrarProducto() {
        $total = 0;
        $totalPedido = 0;
        for ($index = 0; $index < count($this->listaProductos); $index++) {
            $producto = $this->listaProductos[$index];
            $cantidad = (float) $producto->getPrecioProducto();
            $precio = (int) $producto->getUnidadesProducto();
            $total = $cantidad * $precio;
            echo '<div id ="verCarrito">';
            echo '<p>Producto: ' . $producto->getIDProducto() . ' :: ID: ' . $producto->getIDProducto() . ' :: <a href="./include/procesaCarret.php?productoAEliminar=' . $producto->getIDProducto() . '">Eliminar del carrito</a>' . '</p>';
            echo '<p>Nombre Producto: ' . $producto->getNombreProducto() . '</p>';
            echo '<p>Precio: ' . $producto->getPrecioProducto() . '</p>';
            echo '<p>Unidades: ' . $producto->getUnidadesProducto() . '</p>';
            echo '<p>Precio total: ' . $total . "€" . '</p>';
            echo '<p>
                <form method="post" action="./include/procesaCarret.php?producto=' . $producto->getIDProducto() . '">
                <label class="label" for="modificarCantidad">Cambiar cantidad: </label>
                <input type="number" class="input2" name="modificarCantidad" valor="1" min="1" max="120"/>
                <input type="submit" id="enviar" value="Modificar cantidad" />
             </form>
             </p>';
            echo '</div>';
            $totalPedido += $total;
        }
        echo '<p id="totalPedido">Precio total del pedido: ' . $totalPedido . ' EUROS.</p>';
    }

    public function modificarCantidadProducto($cantidadAModificar, $productoAModificar) {

        if ($cantidadAModificar != null && $productoAModificar != null) {
            for ($index = 0; $index < count($this->listaProductos); $index++) {
                $producto = $this->listaProductos[$index];
                if ($producto->getIDProducto() == $productoAModificar) {
                    $producto->setUnidadesProducto($cantidadAModificar);
                }
            }
        }
    }

    public function eliminarProducto($productoAEliminar) {

        for ($index = 0; $index < count($this->listaProductos); $index++) {
            $producto = $this->listaProductos[$index];
            if ($producto->getIDProducto() == $productoAEliminar) {
                unset($this->listaProductos[$index]);
                $_SESSION['numeroProductos'] = count($this->listaProductos);
                $this->listaProductos = array_values($this->listaProductos);
            }
        }
    }

    public function eliminarProductos() {
        unset($this->listaProductos);
    }

    public function mostrarProductoFinCompra() {
        $total = 0;
        $totalPedido = 0;
        for ($index = 0; $index < count($this->listaProductos); $index++) {
            $producto = $this->listaProductos[$index];
            $cantidad = (float) $producto->getPrecioProducto();
            $precio = (int) $producto->getUnidadesProducto();
            $total = $cantidad * $precio;
            echo '<div id ="verCarrito">';
            echo '<p>Producto: ' . $producto->getIDProducto() . ' :: ID: ' . $producto->getIDProducto() . '</p>';
            echo '<p>Nombre Producto: ' . $producto->getNombreProducto() . '</p>';
            echo '<p>Precio: ' . $producto->getPrecioProducto() . '</p>';
            echo '<p>Unidades: ' . $producto->getUnidadesProducto() . '</p>';
            echo '<p>Precio total: ' . $total . "€" . '</p>';
            echo '</div>';
            $totalPedido += $total;
        }
        echo '<p id="totalPedido">Precio total del pedido: ' . $totalPedido . ' EUROS.</p>';
        if (!isset($_SESSION["usuario"])) {
            echo '<div id="registroPedidos">';
            echo '<p>NECESITA INICIAR SESIÓN PARA FINALIZAR LA COMPRA</p>';
            echo '<p id="registro">¿No estas registrado? <a href="./include/dadesRegistre.php">Registro</a></p> ';
            echo '</div>';
        } else if (count($this->listaProductos) != 0 && isset($_SESSION["usuario"])) {
            echo '<div id="confirmarPedidos">';
            echo '<p>' . $_SESSION["usuario"] . ', ¿ESTA SEGURO QUE QUIERE REALIZAR EL PEDIDO?</p>';
            echo '<a href="./include/pedidoRealizado.php">Finalizar pedido</a>';
            echo '</div>';
        } else {
            echo '<div id="registroPedidos">';
            echo '<p>CARRITO VACIO</p>';
            echo '</div>';
        }
    }

    public function anyadirLosPedidos() {

        if ($this->listaProductos != null) {
            if ($fp = fopen("pedidos.txt", "a")) {
                $archivo = file("pedidos.txt");
                $lineas = count($archivo);
                fputs($fp, "C" . ($lineas + 1) . ":" . $_SESSION["usuario"] . ":");
                fclose($fp);
                for ($index = 0; $index < count($this->listaProductos); $index++) {
                    $producto = $this->listaProductos[$index];
                    $IDProducto = $producto->getIDProducto();
                    $cantidad = $producto->getUnidadesProducto();
                    $precio = $producto->getPrecioProducto();
                    $fp = fopen("pedidos.txt", "a");
                    fputs($fp, "idproducto" . $IDProducto . ":" . $cantidad . ":" . $precio . ":");
                    fclose($fp);
                }
                $fp = fopen("pedidos.txt", "a");
                fputs($fp, PHP_EOL);
                fclose($fp);
            } else {
                echo "error obrint el fitxer";
            }
        }
    }

    public function actualizarEstock() {
        if ($this->listaProductos != null) {
            for ($index = 0; $index < count($this->listaProductos); $index++) {
                $producto = $this->listaProductos[$index];
                $IDProducto = $producto->getIDProducto();
                $unidades = $producto->getUnidadesProducto();
                $servidor = "localhost";
                $usuari = "root";
                $contrasenya = "";
                $basedades = "projectePHPArnauCopovi";

                $connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
                if (!$connexio) {
                    die("Error de connexió: " . mysqli_connect_error());
                }

                $sql = "SELECT estoc FROM productos WHERE id='" . $IDProducto . "'";
                $resultat = mysqli_query($connexio, $sql);
                if (mysqli_num_rows($resultat) > 0) {
                    while ($row = mysqli_fetch_assoc($resultat)) {
                        $estoc = $row["estoc"];
                    }
                } else {
                    echo "0 resultats";
                }
                if($estoc >= $unidades) {
                    $estocActualidado = $estoc - $unidades;
                    $sql2 = "UPDATE productos SET estoc='" . $estocActualidado . "' WHERE id='" . $IDProducto . "'";
                    mysqli_query($connexio, $sql2);
                }
                mysqli_close($connexio);
            }
        }
    }

}

class Producto {

    private $IDProducto;
    private $nombreProducto;
    private $unidadesProducto;
    private $precioProducto;

    function __construct($IDProducto, $nombreProducto, $unidadesProducto, $precioProducto) {
        $this->IDProducto = $IDProducto;
        $this->nombreProducto = $nombreProducto;
        $this->unidadesProducto = $unidadesProducto;
        $this->precioProducto = $precioProducto;
    }

    function getIDProducto() {
        return $this->IDProducto;
    }

    function getNombreProducto() {
        return $this->nombreProducto;
    }

    function getUnidadesProducto() {
        return $this->unidadesProducto;
    }

    function getPrecioProducto() {
        return $this->precioProducto;
    }

    function setIDProducto($IDProducto) {
        $this->IDProducto = $IDProducto;
    }

    function setNombreProducto($nombreProducto) {
        $this->nombreProducto = $nombreProducto;
    }

    function setUnidadesProducto($unidadesProducto) {
        $this->unidadesProducto = $unidadesProducto;
    }

    function setPrecioProducto($precioProducto) {
        $this->precioProducto = $precioProducto;
    }

}
?>

