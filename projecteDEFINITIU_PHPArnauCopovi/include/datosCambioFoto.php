<body>
    <main >
        <div id="contenidor">
            <h2>CAMBIO DE FOTO</h2>
            <form id="cambioFoto" method="POST" action="./include/subir.php" enctype="multipart/form-data">
                <div id="cambioDiv">
                    <span>La imagen debe de ser tipo jpg, jpeg, gif o png.</span>
                </div>
                <div id="cambioDiv">
                    <span>La imagen no tiene que superar los 5MB.</span>
                </div>
                <div id="cambioDiv">
                    <span>Subir archivo</span>
                    <span><input type="file" name="fitxer" id="fitxer" /></span>
                </div>
                <div id="cambioDiv">
                    <span><input id="enviar" name="enviar" type="submit" value="Envia" /></span>
                    <input type="reset" id="reset" value="Borrar" />
                </div>
                <div>
                    <a id="eliminarImagen" href="./include/eliminarFoto.php?foto=eliminar">NO quiero foto de perfil</a>
                </div>    
                <div>
                    <?php
                        if(isset($_SESSION["mensajeSubida"])){
                            $mensaje = $_SESSION["mensajeSubida"];
                            if($mensaje == "correcto"){
                                echo '<p id="mensageOk">Archivo subido correctamente<p>';
                            }else if ($mensaje == "errorTamaño"){
                                echo '<p id="mensage">ERROR :: El archivo supera el tamaño.<p>';
                            }else if ($mensaje == "errorMover"){
                                echo '<p id="mensage">ERROR :: No se ha podido subir el archivo.<p>';
                            }else if ($mensaje == "errorExiste"){
                                echo '<p id="mensage">ERROR :: Error de fichero.<p>';
                            }else if ($mensaje == "errorExtension"){
                                echo '<p id="mensage">ERROR :: La imagen no es de tipo jpg, jpeg, gif o png.<p>';
                            }
                            unset($_SESSION["mensajeSubida"]);
                        }    
                    ?>
                </div>
            </form>
        </div>
    </main>
</body>