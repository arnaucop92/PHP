<?php

session_start();
if (isset($_POST["usuario"]) && $_POST["usuario"] != null) {
    $rusuario = $_POST["usuario"];
} else {
    $rusuario = "vacio";
}
if (isset($_POST["contrasenya"]) && $_POST["contrasenya"] != null) {
    $rcontrasenya = $_POST["contrasenya"];
} else {
    $rcontrasenya = "vacio";
}
if (isset($_POST["contrasenya2"]) && $_POST["contrasenya2"] != null) {
    $rcontrasenya2 = $_POST["contrasenya2"];
} else {
    $rcontrasenya2 = "vacio";
}
$existe = "";
$fp = fopen("passwd.txt", "r");
while (!feof($fp)) {
    $linia = fgets($fp);
    $palabras = explode(":", $linia);
    foreach ($palabras as $a => $b) {
        if ($rusuario == $b && $a == 0) {
            $_SESSION["existeUsuario"] = "existeUsuario";
            $existe = $_SESSION["existeUsuario"];
        }
    }
}
if ($existe != "existeUsuario") {
    if ($rcontrasenya == $rcontrasenya2 && $rusuario != "vacio" && $rcontrasenya != "vacio") {
        $fp = fopen("passwd.txt", "a");
        fputs($fp,"$rusuario:$rcontrasenya:" . PHP_EOL  );
        fclose($fp);
        $_SESSION["usuario"] = $rusuario;
        $_SESSION["contrasenya"] = $rcontrasenya;
        header("Location: ../index.php");
        die();
    } else if ($rcontrasenya != $rcontrasenya2) {
        $_SESSION ["noIguales"] = "noiguales";
    } else if ($rusuario == "vacio" || $rcontrasenya == "vacio" || $rcontrasenya2 == "vacio"){
        $_SESSION ["vacio"] = "vacio";
    }
}
header("Location: ../include/dadesRegistre.php");
die();
?>

