<?php
/**
 * Formulario de registro de una actividad al cronograma de actividades
 * @author DIEGOX_CORTEX
 */
$bit = get_input("bitacora");
$investigacion = get_input('inv');
$grupo = get_input('grupo');
$act = get_input('act');

//$url_action = elgg_get_site_url() . "action/bitacoras/bitacora4/save_actividad?bit=" . $datos[0] . "&grupo=" . $datos[2] . "&inv=" . $datos[1];
//$action = elgg_add_action_tokens_to_url($url_action);

if (!empty($act)) {
    $actividad = new Elgg_Actividad($act);
}
?>
<input type="hidden" name="act" id="actividad-crear" value="<?php echo $act?>">

<div id="form-crear-archivo">
<h2 class="title-legend">Crear Nueva Actividad</h2>

 <div class="div-actividad">
<label>Nombre:&nbsp; &nbsp; &nbsp; </label> <input id="bit4-nombre" type="text"  name="nombre" required value="<?php echo $actividad->nombre ?>">
<label>Responsable:</label> <input  id="bit4-responsable" type="text" name="responsable" value="<?php echo $actividad->responsable ?>">
 </div>
<div class="div-actividad">
<label>Desde:</label> <input id="bit4-desde"  type="date" name="desde" required value="<?php echo $actividad->fecha_desde ?>">
<label>Hasta:</label> <input id="bit4-hasta"  type="date" name="hasta" required value="<?php echo $actividad->fecha_hasta ?>">
</div>  
<br>
<div class="actividad">
 <input type="button" name="crear" class="link-button" value="Guardar Actividad" onclick="guardarActividad(<?php echo $bit ?>, <?php echo $investigacion ?>, <?php echo $grupo ?>)">
 </div>

</div><br><br>