<?php
session_start();
if (!isset($_POST["cerrar"])){
    session_unset();
    session_destroy();
}
header("Location: ../index.php");die();
?>
