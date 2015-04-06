<?php
/**
 * Formulario que administra la informacion de un rubro de la bitacora 5.2
 * @author DIEGOX_CORTEX
 */
$bitacora = $vars['bit'];
$datos = explode(',', $bitacora);

if (!empty($datos['3'])) {
    $rubro = new Elgg_Rubro($datos['3']);
}
?>

<div class="form-nuevo-album">

    <h2 class="title-legend">Nuevo Rubro</h2>


    <input hidden="" name="bit" value="<?php echo $datos['0'] ?>">       
    <input hidden="" name="inv" value="<?php echo $datos['1'] ?>">   
    <input hidden="" name="grupo" value="<?php echo $datos['2'] ?>">
    <input hidden="" name="rub" value="<?php echo $datos['3'] ?>">   

    <div>
        <label>Rubro:</label> <input type="text"  name="nombre" required="true" value="<?php echo $rubro->nombre; ?>">
    </div>
    <div>
        <label>Fecha del gasto:</label> <input type="date"  name="fecha_gasto" required="true" value="<?php echo $rubro->fecha_gasto; ?>">
    </div>
    <div>
        <label>Nombre del Proveedor:</label> <input type="text"  name="proveedor" required="true" value="<?php echo $rubro->proveedor; ?>">
    </div>
    <div>
        <label>Valor Unitario:</label> <input type="number"  name="valor_unitario" required="true" value="<?php echo $rubro->valor_unitario; ?>">
    </div>
    <div>
        <label>valor_total:</label> <input type="number"  name="valor_total" required="true" value="<?php echo $rubro->valor_total; ?>">
    </div>


    <input type="submit" name="crear_R" value="Crear Rubro">

</div>

