<?php
/**
 * Vista que permite crear un nuevo item en la bitacora 5, segun el trayecto
 * @author DIEGOX_CORTEX
 */
$bit_5 = get_input('bit5');
$tray = get_input('tray');
$item = get_input('item');
$investigacion = get_input('inv');
$grupo = get_input('grupo');
$trayecto = get_entity($tray);
$titulo = "";
if (!empty($item)) {
    $itemsillo = get_entity($item);
    $titulo = "Editar Item para Trayecto $trayecto->nombre ";
}else{
    $titulo = "Crear Item para Trayecto $trayecto->nombre ";
}
error_log("GRUPO -> $grupo");

?>

<input type="hidden" id="bit5" value="<?php echo $bit_5; ?>">
<input type="hidden" id="tray" value="<?php echo $tray; ?>">
<input type="hidden" id="item" value="<?php echo $item; ?>">

<div id="form-crear-componente">
    <h2 class="title-legend"><?php echo $titulo?></h2>

    <label>Nombre del Item:</label>
    <input type="text" id="nombre-act-bit5" placeholder="Digite el nombre de la actividad..."  name="" value="<?php echo $itemsillo->title; ?>">
    <br><br>
    <div class="div-actividad">
        <label>Total Aprobado:</label>
        <input type="number" id="totalAp-bit5" placeholder="Total Aprobado..." name="" value="<?php echo $itemsillo->totalAp; ?>">   
        <label>Total Desembolsado:</label>
        <input type="number" id="totalDs-bit5" placeholder="Total Desembolsado..."  name="" value="<?php echo $itemsillo->totalDs; ?>">
    </div>    
    <div class="div-actividad">  
        <label>Ejecutado:</label>
        <input type="number" id="ejecutado-bit5" placeholder="Total Desembolsado..."  name="" value="<?php echo $itemsillo->ejecutado; ?>">
        <label>Saldo:</label>
        <input type="number" id="saldo-bit5" placeholder="Total Desembolsado..." name="" value="<?php echo $itemsillo->saldo; ?>">

    </div><br><br>
    <center>
        <?php
        if (empty($item)) {
            ?>
            <input type="button" name="crear" value="Guardar Item" onclick="guardarItemTray(<?php echo $bit_5 ?>, <?php echo $tray ?>, <?php echo $investigacion ?>, <?php echo $grupo ?>)">
            <?php } else {
            ?>
            <input type="button" name="crear" value="Guardar Item" onclick="editarItemTray(<?php echo $bit_5 ?>, <?php echo $tray ?>, <?php echo $item ?>, <?php echo $investigacion ?>, <?php echo $grupo ?>)">
            <?php
        }
        ?>
    </center>
</div>

