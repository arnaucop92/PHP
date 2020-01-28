
<?php
session_start();
if (isset($_POST["color"])) {
    $color = $_POST["color"];
    $_SESSION["color"] = $color;
}else{
    $_SESSION["color"] = "normal";
}
header("Location: ../index.php");die();
?>       