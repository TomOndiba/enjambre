<?php

$fecha_visita = get_input('fecha_visita');
$departamento = get_input('departamento');
$municipio = get_input('municipio');
$asunto = get_input('asunto');
$observaciones = get_input('observaciones');
$tipo_comunicacion = get_input('tipo_comunicacion');
$id_visita = get_input('id_visita');

$visita = new ElggVisita($id_visita);

$metadata_names=array('fecha_visita','departamento','municipio','asunto','observaciones','tipo_comunicacion');

$metadata_values=array($fecha_visita,$departamento,$municipio,$asunto,$observaciones,$tipo_comunicacion);

for ($i = 0; $i < count($metadata_names); $i++) {

    if ($visita->$metadata_names[$i] != $metadata_values[$i]) {

        $options = array(
            'guid' => $visita->guid,
            'metadata_name' => $metadata_names[$i],
            'limit' => false
        );
        $g = elgg_delete_metadata($options);

       
        if (!is_null($metadata_values[$i]) && ($metadata_values[$i] !== '')) {
            create_metadata($visita->guid, $metadata_names[$i], $metadata_values[$i], 'text', $visita->owner_guid, ACCESS_PUBLIC);
        }
    }
}

system_message(elgg_echo("visita:edit:saved"));
forward("visitas/");
