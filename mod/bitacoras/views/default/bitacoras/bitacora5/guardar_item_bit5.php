<?php

/**
 * Vista que ejecuta el guardar un item de la bitacora 5
 * @author DIEGOX_CORTEX
 */
$bit = get_input('bit');
$tray = get_input('tray');
$item = get_input('item');
$nombre = get_input('nombre');
$total_ap = get_input('total_ap');
$total_ds = get_input('total_ds');
$ejecutado = get_input('ejecutado');
$saldo = get_input('saldo');
$inv = get_entity(get_input('inv'));
$grupo = get_input('grupo');

if (!empty($nombre) && !empty($total_ap) && !empty($total_ds) && !empty($ejecutado) && !empty($saldo)) {
    if (empty($item)) {
        $item_tray = new Elgg_Item_Trayecto();
    }else{
        $item_tray = new Elgg_Item_Trayecto($item);
    }
    
    $item_tray->title = $nombre;
    $item_tray->totalAp = $total_ap;
    $item_tray->totalDs = $total_ds;
    $item_tray->ejecutado = $ejecutado;
    $item_tray->saldo = $saldo;
    $item_tray->owner_guid = $tray;
    $item_tray->container_guid = $bit;

    if ($item_tray->save()) {
        ?>
        <script>
            alert('Se ha almacenado el item...');
        </script>

        <?php

    } else {
        ?>
        <script>
            alert('No se ha completado la acción...');
        </script>

        <?php

    }
} else {
    ?>
    <script>
        alert('Se ha cancelado la accion...');
    </script>

    <?php

}

echo cargar_tabla_items_trayecto_bit5($bit, $inv->owner_guid, $inv->guid, $grupo);

