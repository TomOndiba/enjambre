<?php

$guid=get_input('id_evento');
$id_conv= get_input('id_conv');
$nombre_evento= get_input('nombre_evento');
$fecha_inicio= get_input('fecha_inicio');
$tipo_evento= get_input('tipo_evento');
$fecha_terminacion= get_input('fecha_terminacion');
$fecha_limite_confirmacion= get_input('fecha_lim_confirmacion');
$lugar= get_input('lugar');
$max_asistentes = get_input('max_asistentes');
$objetivo=get_input('objetivo');
$dirigido_a=get_input('dirigido_a');
$requisitos=get_input('requisitos');

$evento_ant=new ElggEvento($guid);
        
//Arreglo con los nombres de los metadatos a actualizar
$nombre_metadato = array('tipo_evento', 'nombre_evento', 'fecha_inicio', 'fecha_terminacion', 'fecha_limite_confirmacion', 'lugar', 'max_asistentes', 'objetivo', 'dirigido_a', 
                            'requisitos_evento');
$evento_ant->title = $nombre_evento;
//Arreglo con el valor con los que se actualizaran los metadatos
$value_metadato = array($tipo_evento, $nombre_evento, $fecha_inicio, $fecha_terminacion, $fecha_limite_confirmacion, $lugar, $max_asistentes, $objetivo, $dirigido_a, 
                        $requisitos);

for ($i = 0; $i < count($nombre_metadato); $i++) {

    if ($evento_ant->$nombre_metadato[$i] != $value_metadato[$i]) {

        $options = array(
            'guid' => $evento_ant->guid,
            'metadata_name' => $nombre_metadato[$i],
            'limit' => false
        );
        $g = elgg_delete_metadata($options);

        if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
            
            $user = elgg_get_logged_in_user_entity();
            $var=create_metadata($evento_ant->guid, $nombre_metadato[$i], $value_metadato[$i], 'text', $user->guid, ACCESS_PUBLIC);
        
        }
    }
}

elgg_clear_sticky_form('profile:edit');
system_message(elgg_echo("evento:edit:saved"));
$evento_ant->save();
forward('/eventos/listado/'.$id_conv);