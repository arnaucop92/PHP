<?php
if(isset($_GET["idProducto"])){
    $idProducto = $_GET["idProducto"];
}
$servidor = "localhost";
$usuari = "root";
$contrasenya = "";
$basedades = "projectePHPArnauCopovi";
$connexio = mysqli_connect($servidor, $usuari, $contrasenya, $basedades);
if (!$connexio) {
		 die ("Error de connexió: ".mysqli_connect_error ());
}

$sql = "SELECT megusta FROM productos WHERE id='".$idProducto."'";
$resultat = mysqli_query($connexio, $sql);

if (mysqli_num_rows($resultat) > 0) {
    
    while($row = mysqli_fetch_assoc($resultat)) {
        $meGusta = $row["megusta"];
    }
} else {
	
    echo "0 resultats";
}
$meGusta +=1;
$sql2 = "UPDATE productos SET megusta='".$meGusta."' WHERE id='".$idProducto."'";
if (mysqli_query($connexio, $sql2)) {
    echo "Registre actualitzat correctament";
} else {
    echo "Error actualitzant registre" . mysqli_error($connexio);
}
//Tanquem la connexió abans d'acabar
mysqli_close($connexio);
header("Location: ../index.php?page=productes");
die();
?>