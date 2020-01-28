<?php
session_start();
if (isset($_POST["usuario"])) {
    $usuario = $_POST["usuario"];
}

if (isset($_POST["contrasenya"])) {
    $contrasenya = $_POST["contrasenya"];
}
?>
<?php

$okUsuario = "user";
$okContrasenya = "cont";
$fp = fopen("passwd.txt", "r");
while (!feof($fp)) {
    $linia = fgets($fp);
    echo $linia . "<br/>";
    $palabras = explode(":", $linia);
    foreach ($palabras as $a => $b) {
        if ($usuario == $b && $a == 0) {
            $okUsuario = $b;
        } else if ($contrasenya == $b && $a == 1) {
            $okContrasenya = $b;
        }
    }
}
if ($usuario == $okUsuario && $contrasenya == $okContrasenya) {
    echo 'Bienvenido de nuevo ' . $usuario;
    $_SESSION["usuario"] = $usuario;
    $_SESSION["contrasenya"] = $contrasenya;
   
}else if ($usuario == $okUsuario && $contrasenya != $okContrasenya){
    $_SESSION["error"] = "incorrecta";
 echo 'Contraseña incorrecta';
}else{
    $_SESSION ["error"] = "existe";
    echo 'El usuario '.$usuario.' no existe.';
}
fclose($fp);
 header("Location: ../index.php");die();
?>

