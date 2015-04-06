<?php
/**
 * Formulario que administra la informacion de un rubro de la bitacora 5.1
 * @author DIEGOX_CORTEX
 */
$bitacora = get_input("bitacora");
$tray = get_input('tray');
$rub = get_input('item');
$inv = get_input('inv');

$item = get_entity($rub);

?>

<div id="form-crear-archivo">

    <h2 class="title-legend">Editar Rubro <?php echo $item->title; ?></h2>

    <div class="div-actividad">

        <label>Descripción del gasto:</label> <input type="text" id="descripcion-bit51" name="descripcion_gasto"  value="<?php echo $item->desc_gasto; ?>">
        <label>Valor Unitario:</label> <input type="number" id="valorunitario-bit51" name="valor_unit" value="<?php echo $item->valr_unit; ?>">
    </div>
    <div class="div-actividad">
        <label>Valor total del rubro:</label> <input type="number" id="valortotalrubro-bit51" name="valor_tot_rub"  value="<?php echo $item->vlr_tot_rub; ?>">
        <label>valor_total:</label> <input type="number" id="valortotal-bit51" name="valor_total"  value="<?php echo $item->total; ?>">
    </div>
    <br><br>
    <center>
        <input type="button" name="crear" value="Guardar Rubro" onclick="guardarRubro(<?php echo $bitacora ?>, <?php echo $tray;?>, <?php echo $rub?>, <?php echo $inv ?>)">
    </center>

</div>