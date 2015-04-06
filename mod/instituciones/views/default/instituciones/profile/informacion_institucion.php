<?php

 
$institucion=$vars['institucion'];
 
    
?>

<div class="box contet-grupo-investigacion infor-institucion">
    <h2 class="title-legend">Información</h2>
<label> Nombre: </label>
<p><?php echo $institucion->name; ?></p>
<br><label>Departamento: </label>
<p><?php echo $institucion->departamento; ?></p>
<br><label>Municipio: </label>
<p><?php echo $institucion->municipio; ?></p>
<br><label>Direccion: </label>
<p><?php echo $institucion->direccion; ?></p>
<br><label>Telefono: </label>
<p><?php echo $institucion->telefono; ?></p>
<br><label>Nombre del Director: </label>
<p><?php echo $institucion->director; ?></p>
<br><label>Email: </label>
<p><?php echo $institucion->email; ?></p>
<br><label>Página : </label>
<p><?php echo $institucion->website; ?></p>

</div>