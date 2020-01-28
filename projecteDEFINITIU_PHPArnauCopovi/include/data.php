<?php
$dias = array ("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
$meses = array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
echo "<div class='fecha'>";
echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
echo "</div>";  
?> 


