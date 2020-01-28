<!DOCTYPE html>
<html>
    <?php
    session_start();
    if (isset($_POST["nombre"]) && $_POST["nombre"] != null) {
        $nombre = $_POST["nombre"];
    } else {
        $nombre = "Datos no introducidos.<p>";
    }
    if (isset($_POST["apellidos"]) && $_POST["apellidos"] != null) {
        $apellidos = $_POST["apellidos"];
    } else {
        $apellidos = "Datos no introducidos.<p>";
    }
    if (isset($_POST["edad"]) && $_POST["edad"] != null) {
        $edad = $_POST["edad"];
    } else {
        $edad = "Datos no introducidos.<p>";
    }
    if (isset($_POST["correo"]) && $_POST["correo"] != null) {
        $correo = $_POST["correo"];
    } else {
        $correo = "Datos no introducidos.<p>";
    }
    if (isset($_POST["poblacion"]) && $_POST["poblacion"] != null) {
        $poblacion = $_POST["poblacion"];
    } else {
        $poblacion = "Datos no introducidos.<p>";
    }
    if (isset($_POST["url"]) && $_POST["url"] != null) {
        $url = $_POST["url"];
    } else {
        $url = "Datos no introducidos.<p>";
    }
    if (isset($_POST["pelicules"])) {
        $pelicules = $_POST["pelicules"];
    }
    if (isset($_POST["personajes"]) && $_POST["personajes"] != null) {
        $personajes = $_POST["personajes"];
        $cantidadPersonajes = count($personajes);
    } else {
        $cantidadPersonajes = 0;
        $personajes = '<img src="../img/defecto.png" / width=100%<p>';
    }
    if (isset($_POST["color"])) {
        $color = $_POST["color"];
        if ($color == "amarillo") {
            echo '<link href="../css/amarillo.css" rel="stylesheet">';
        } else if ($color == "blanco") {
            echo '<link href="../css/blanco.css" rel="stylesheet">';
        }
    } else {
        if (isset($_SESSION["color"])) {
            $color = $_SESSION['color'];
            if ($color == "amarillo") {
                echo '<link href="../css/amarillo.css" rel="stylesheet">';
            } else if ($color == "blanco") {
                echo '<link href="../css/blanco.css" rel="stylesheet">';
            }else{
                echo '<link href="../css/estils.css" rel="stylesheet">';
            }
        }else{
             echo '<link href="../css/estils.css" rel="stylesheet">';
        } 
    }
    if (isset($_POST["vistas"])) {
        $vistas = $_POST["vistas"];
    } else {
        $vistas = "Datos no introducidos.<p>";
    }
    if (isset($_POST["informacion"])) {
        $informacion = $_POST["vistas"];
    } else {
        $informacion = "Datos no introducidos.<p>";
    }
    $puntuacion = $_POST["puntuacion"];
    if (isset($_POST["coleccion"]) && $_POST["coleccion"] != null ){
        $coleccion = $_POST["coleccion"];
    }else {
        $coleccion = "Datos no introducidos.<p>";
    }
    
    ?>
    
    <head>
        <meta charset="UTF-8">
        <title>ACTIVITAT FORMULARI</title>
    </head>
    <body>
        <h1>STAR<br />WARS <br/>SHOP</h1>
        <div id="contenidor">
            <div class="fila">
                <div class="columna">
                    <p>Nombre: </p>
                </div>
                <div class="columna">
                    <p><?php echo $nombre ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Apellidos: </p>
                </div>
                <div class="columna">
                    <p><?php echo $apellidos ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Edad: </p>
                </div>
                <div class="columna">
                    <p><?php echo $edad ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Correo: </p>
                </div>
                <div class="columna">
                    <p><?php echo $correo ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Poblacion: </p>
                </div>
                <div class="columna">
                    <p><?php echo $poblacion ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Telefono: </p>
                </div>
                <div class="columna">
                    <p><?php echo $url ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Personajes favoritos: </p>
                </div>
                <div class="columna">
                    <p><?php
                        if ($cantidadPersonajes == 0) {
                            print $personajes;
                        } else {
                            for ($i = 0; $i < $cantidadPersonajes; $i++) {

                                if ($personajes[$i] == "dv") {
                                    echo '<img src="../img/personajes/1.jpg" / width=100%><p>';
                                } else if ($personajes[$i] == "hans") {
                                    echo '<img src="../img/personajes/25.jpg" / width=100%><p>';
                                } else if ($personajes[$i] == "r2") {
                                    echo '<img src="../img/personajes/6.jpg" / width=100%><p>';
                                } else if ($personajes[$i] == "chewbacca") {
                                    echo '<img src="../img/personajes/26.jpg" / width=100%><p>';
                                } else if ($personajes[$i] == "leia") {
                                    echo '<img src="../img/personajes/24.jpg" / width=100%><p>';
                                }
                            }
                        }
                        ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Peliculas favoritas: </p>
                </div>
                <div class="columna">
                    <p><?php
                        if ($pelicules == "IV") {
                            echo '<img src="../img/peliculas/1.jpg" / width=100%><p>';
                        } else if ($pelicules == "V") {
                            echo '<img src="../img/peliculas/2.jpg" / width=100%><p>';
                        } else if ($pelicules == "VI") {
                            echo '<img src="../img/peliculas/3.jpg" / width=100%><p>';
                        } else if ($pelicules == "I") {
                            echo '<img src="../img/peliculas/4.jpg" / width=100%><p>';
                        } else if ($pelicules == "II") {
                            echo '<img src="../img/peliculas/5.jpg" / width=100%><p>';
                        } else if ($pelicules == "III") {
                            echo '<img src="../img/peliculas/6.jpg" / width=100%><p>';
                        } else if ($pelicules == "VII") {
                            echo '<img src="../img/peliculas/7.jpg" / width=100%><p>';
                        } else if ($pelicules == "VIII") {
                            echo '<img src="../img/peliculas/8.jpg" / width=100%><p>';
                        } else if ($pelicules == "Rogue One") {
                            echo '<img src="../img/peliculas/10.jpg" / width=100%><p>';
                        } else if ($pelicules == "Han Solo") {
                            echo '<img src="../img/peliculas/11.jpg" / width=100%><p>';
                        } else if ($pelicules == "vacio") {
                            echo '<img src="../img/defecto.png" / width=100%<p>';
                        }
                        ?> </p>
                </div>
            </div>
            <div class="datos">
                <p id="datosTitulo">Datos de tus peliculas favoritas:</p>
                <div>
                    <?php
                    include 'dades.php';
                    foreach ($dades as $pelicula => $value) {
                        if ($pelicules == $pelicula) {
                            foreach ($value as $informacio => $apartat) {
                                echo '<div class="fila1">';
                                echo '<div class="columna1">';
                                echo $informacio;
                                echo '</div>';
                                echo '<div class="columna2">';
                                echo $apartat;
                                echo '</div>';
                                echo '</div>';
                            }
                        }  
                    }
                    if($pelicules == "vacio"){
                        echo '<p>Datos no introducidos.</p>';
                    }
                    
                    ?>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Puntuación de la página:</p>
                </div>
                <div class="columna">
                    <p><?php
                    switch ($puntuacion) {
                        case 0:
                            echo '<img src="../img/estrelles/star_05.png" / width=100%><p>';
                            break;
                        case 1:
                            echo '<img src="../img/estrelles/star_15.png" / width=100%><p>';
                            break;
                        case 2:
                            echo '<img src="../img/estrelles/star_25.png" / width=100%><p>';
                            break;
                        case 3:
                            echo '<img src="../img/estrelles/star_35.png" / width=100%><p>';
                            break;
                        case 4:
                            echo '<img src="../img/estrelles/star_45.png" / width=100%><p>';
                            break;
                        case 5:
                            echo '<img src="../img/estrelles/star_55.png" / width=100%><p>';
                            break;
                    }
                    ?></p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>¿Cuantas peliculas tienes en tu colección?:</p>
                </div>
                <div class="columna">
                    <p><?php
                        for ($i = 0; $i < $coleccion; $i++) {
                            echo '<img src="../img/darthvader.png" / width=20%>';
                        }
                        if ($coleccion == 0){
                           echo '<p>Datos no introducidos.</p>'; 
                        }
                    ?></p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>¿Has visto todas las peliculas? </p>
                </div>
                <div class="columna">
                    <p><?php echo $vistas ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>¿Te gustaria suscribirte para recibir todas las novedades sobre Star Wars? </p>
                </div>
                <div class="columna">
                    <p><?php echo $informacion ?> </p>
                </div>
            </div>
            <div class="fila">
                <div class="columna">
                    <p>Comentario enviado:</p>
                </div>
                <div class="columna">
                    <p><?php
                        $texto = $_POST["comentario"];
                        $palabras = explode(" ", $texto);
                        foreach ($palabras as $a => $b){
                            if ($b == "Hola"){
                                echo '<div class="color1">';
                                echo $b;
                                echo '</div>';
                            }else{
                                echo '<div class="color2">';
                                echo $b;
                                echo '</div>';
                            }
                        }
                    ?></p>
                </div>
            </div>
        </div>
    </body>
</html>


