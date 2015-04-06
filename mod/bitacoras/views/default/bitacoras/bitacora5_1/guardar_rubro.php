<?php

/**
 * Action que almacena la informacion editada en el formulario para un rubro de la
 * bitcora 5.1
 * @author DIEGOX_CORTEX
 */
$bit = get_input('bit');
$tray = get_input('tray');
$item = get_input('item');
$descripcion = get_input('descripcion');
$valorUnitario = get_input('valorunitario');
$valorTotalRubro = get_input('valortotalrubro');
$valortotal = get_input('valortotal');
$inv = get_entity(get_input('inv'));

if (!empty($descripcion) && !empty($valorUnitario) && !empty($valorTotalRubro) && !empty($valortotal)) {

    $item_tray = new Elgg_Item_Trayecto($item);
    
    $item_tray->desc_gasto = $descripcion;
    $item_tray->valr_unit = $valorUnitario;
    $item_tray->vlr_tot_rub = $valorTotalRubro;
    $item_tray->total = $valortotal;

    if ($item_tray->save()) {
        ?>
        <script>
            alert('Se ha almacenado el rubro...');
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
        alert('Se ha cancelado la acción...');
    </script>

    <?php

}

echo cargar_tabla_items_trayecto_bit51($bit, $inv->owner_guid, $inv->guid);



