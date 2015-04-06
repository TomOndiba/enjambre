<?php

$guid = get_input('guid');
$convocatoria = get_input('convocatoria');
$grupo = get_input('grupo');
if (!$guid || !$convocatoria) {
    register_error("Ha ocurrido un error en la operación");
    forward(REFERER);
}
$investigacion = new ElggCuadernoCampo($guid);
$investigacion->presupuesto = 1000000;
$investigacion->save();
$dbprefix = elgg_get_config('dbprefix');
$subtype_id = add_subtype('group', 'investigacion');
update_data("UPDATE {$dbprefix}entities set subtype='$subtype_id' WHERE guid=$investigacion->guid");
if (remove_entity_relationship($guid, 'inscrita_a_convocatoria_especial', $convocatoria)) {
    if (remove_entity_relationship($grupo, 'tiene_cuaderno_campo', $guid)) {
        if (add_entity_relationship($grupo, 'tiene_la_investigacion', $guid)) {
            if (add_entity_relationship($guid, "seleccionada_a_convocatoria_especial", $convocatoria)) {
                system_message("La investigación se ha aceptado exitosamente");
            } else {
                add_entity_relationship($guid, 'inscrita_a_convocatoria_especial', $convocatoria);
                register_error("No se ha podido aceptar esta investigación, intenta nuevamente.");
            }
        } else {
            register_error("No se ha podido aceptar esta investigación, intenta nuevamente.");
        }
    }
}
forward(REFERER);
