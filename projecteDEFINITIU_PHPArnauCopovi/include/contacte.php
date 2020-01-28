
<div id="formulari">
    <form method="post" action="./include/procesaFormulari.php">
        <article id="formulario">
            <fieldset id="datos">
                <legend>Datos personales</legend>
                <div class="personales">
                    <li>
                        <label class="label" for="nombre">Nombre:</label>
                        <input type="text" class="input2" name="nombre" />
                    </li>
                    <li>
                        <label class="label" for="apellidos">Apellidos:</label>
                        <input type="text" class="input2" name="apellidos"  />
                    </li>
                </div>
                <div class="personales">
                    <li>
                        <label class="label" for="edad">Edad:</label>
                        <input type="number" class="input2" name="edad" valor="0" min="1" max="120"  />
                    </li>
                    <li>
                        <label class="label" for="correo">Correo:</label>
                        <input type="email" class="input2" name="correo"  />
                    </li>
                </div>
                <div class="personales">
                    <li>
                        <label class="label" for="poblacion">Poblacion:</label>
                        <input type="text" class="input2" name="poblacion"  />
                    </li>
                    <li> 
                        <label class="label" for="url">Teléfono:</label>
                        <input type="tel" class="input2" name="url" pattern="[0-9]{3}.[0-9]{3}.[0-9]{3}" />
                    </li>
                </div>
            </fieldset>
            <fieldset id="favoritas">
                <legend>Peliculas Favoritas</legend>
                <li><label for="pelicules" class="pelicules">Peliculas favoritas:</label> 
                    <select name="pelicules">
                        <option value="vacio" checked>Elige una opción.</option>
                        <option value="IV" >Star Wars: Episode IV - Una nueva esperanza (1977)</option>
                        <option value="V" >Star Wars: Episode V - El imperio contraataca (1980)</option>
                        <option value="VI" >Star Wars: Episode VI - El retorno del Jedi (1983)</option>
                        <option value="I">Star Wars: Episode I - La amenaza fantasma (1999)</option>
                        <option value="II" >Star Wars: Episode II - El ataque de los clones (2002)</option>
                        <option value="III">Star Wars: Episode III - La venganza de los Sith (2005)</option>
                        <option value="VII">Star Wars: Episode VII - El despertar de la fuerza (2015)</option>
                        <option value="VIII">Star Wars: Episode VIII - Los ultimos Jedi (2017)</option>
                        <option value="Rogue One">Rogue One: Una historia de Star Wars (2016)</option>
                        <option value="Han Solo">Han Solo: una historia de Star Wars (2018)</option>
                    </select>
                </li> 

                <li id="checkbox"><label for="personajes">Personajes favoritas:
                        <input type="checkbox" name="personajes[]" value="dv" />Darth Vader
                        <input type="checkbox" name="personajes[]" value="hans" />Hans Solo
                        <input type="checkbox" name="personajes[]" value="r2" />R2-D2
                        <input type="checkbox" name="personajes[]" value="chewbacca" />Chewbacca
                        <input type="checkbox" name="personajes[]" value="leia" />Princesa Leia
                    </label>
                </li>    
            </fieldset>
            <fieldset id="terminar">
                <legend>Otros</legend>
                <li>
                    <label  for="puntuacion">Puntuación de la página:</label>
                    <input type="number" name="puntuacion" valor="0" min="0" max="5" step="1" />
                </li>
                <li>
                    <label  for="coleccion">¿Cuantas peliculas tienes en tu colección?:</label>
                    <input type="number" name="coleccion" valor="0" min="0" max="100" step="1" />
                </li>
                <li>
                    <p>Color del formulario:</p>
                    <label for="color">Amarillo</label>
                    <input type="radio" id="color" name="color" value="amarillo" />
                    <label for="color">Blanco</label>
                    <input type="radio" id="color" name="color" value="blanco" />
                </li>
                <li>
                    <p>¿Has visto todas las peliculas?</p>
                    <label for="vistas">Si</label>
                    <input type="radio" id="vistas" name="vistas" value="si" />
                    <label for="vistas">No</label>
                    <input type="radio" id="vistas" name="vistas" value="no" />
                </li>
                <li>
                    <p>¿Te gustaria suscribirte para recibir todas las novedades sobre Star Wars?</p>
                    <label for="informacion">Si</label>
                    <input type="radio" id="informacion" name="informacion" value="si" />
                    <label for="informacion">No</label>
                    <input type="radio" id="informacion" name="informacion" value="no" />
                </li>
                <li><textarea  name="comentario" id="textarea" rows="2" cols="20" wrap="hard" placeholder="Comentarios:"></textarea></li>
            </fieldset>
            <li id="botones">
                <input type="submit" id="enviar" value="Enviar" />
                <input type="reset" id="reset" value="Borrar" />
            </li>
        </article>
    </form>
</div>       