<?php
/**
 * Formulario de registro de una actividad al cronograma de actividades
 * @author DIEGOX_CORTEX
 */
$bit = $vars['bit'];
$datos = explode(",", $bit);

//$url_action = elgg_get_site_url() . "action/bitacoras/bitacora4/save_actividad?bit=" . $datos[0] . "&grupo=" . $datos[2] . "&inv=" . $datos[1];
//$action = elgg_add_action_tokens_to_url($url_action);

if (!empty($datos[3])) {
    $actividad = new Elgg_Actividad($datos[3]);
}
?>

<div class="form-interno">

    <form>
        <h2 class="title-legend">Nueva Actividad</h2>


        <input hidden="" name="bit" value="<?php echo $datos[0] ?>">
        <input hidden="" name="grupo" value="<?php echo $datos[2] ?>">
        <input hidden="" name="inv" value="<?php echo $datos[1] ?>">   
        <input hidden="" name="act" value="<?php echo $datos[3] ?>">   

        <div>
            <label>Nombre:</label> <input type="text"  name="nombre" required="true" value="<?php echo $actividad->nombre ?>">
        </div>
        <div>
            <label>Desde:</label> <input type="date" name="desde" required="true" value="<?php echo $actividad->fecha_desde ?>">
        </div>
        <div>
            <label>Hasta:</label> <input type="date" name="hasta" required="true" value="<?php echo $actividad->fecha_hasta ?>">
        </div>
        <div>
            <label>Responsable:</label> <input type="text" name="responsable" required="true" value="<?php echo $actividad->responsable ?>">
        </div>

        <input type="submit" name="crear" value="Crear Actividad">
    </form>
</div>