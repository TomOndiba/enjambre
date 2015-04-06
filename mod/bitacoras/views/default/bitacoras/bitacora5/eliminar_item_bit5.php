<?php

/**
 * Vista que permite ejecutar la eliminación de un item de un trayecto de la bitácora 5
 * @author DIEGOX_CORTEX
 */
$bit = get_input("bit");
$item = get_entity(get_input("item"));
$inv = get_entity(get_input('inv'));
$grupo = get_input('grupo');
if ($item->delete()) {
    ?>
    <script>
        alert("Se ha eliminado el item...");
    </script>
    <?php

} else {
    ?>
    <script>
        alert("No se ha completado la acción...");
    </script>
    <?php

}

echo cargar_tabla_items_trayecto_bit5($bit, $inv->owner_guid, $inv->guid, $grupo);
