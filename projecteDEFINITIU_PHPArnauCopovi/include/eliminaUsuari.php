<div id="contenidor">
<?php
if (isset($_GET["usuarioAEliminar"])) {
    $cont2 = 0;
    $usuarioAEliminar = $_GET["usuarioAEliminar"];
    $fp = fopen("../include/passwd.txt", "r");
    while (!feof($fp)) {
        $linia = fgets($fp);
        $palabras = explode(":", $linia);
        foreach ($palabras as $a => $b) {
            if ($usuarioAEliminar != $b && $a == 0) {
                if ($cont2 == 0) {
                    $fp2 = fopen("../include/temporal.txt", "w");
                } else {
                    $fp2 = fopen("../include/temporal.txt", "a");
                }
                fputs($fp2, "$linia");
                $cont2 ++;
            }
        }
    }
    $paswwd = "../include/passwd.txt";
    $contingut_fitxer = file_get_contents("../include/temporal.txt");
    file_put_contents($paswwd, $contingut_fitxer);
    fclose($fp2);
    array_map('unlink', glob('../img/usuarios/'. $usuarioAEliminar. '.*'));
}
header("Location: ../index.php");
?>
</div>