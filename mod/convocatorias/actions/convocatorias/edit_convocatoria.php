<?php
/**
 * Editar la información de una convocatoria de acuerdo a los datos modificados en un formulario
 */

$id = get_input('id');
$tipo_convocatoria = get_input('proyectos');
$nombre = get_input('nombre');
$dpto = get_input('departamento');
$convenio = get_input('convenio');
$f_apertura=  get_input('fecha_apertura');
$f_cierre = get_input('fecha_cierre');
$hora_cierre = get_input('hora'); 
$hora1_cierre = get_input('minutos');
$hora=$hora_cierre.":".$hora1_cierre;
$f_resultados = get_input('fecha_resultados');
$proceso_pedagogico = get_input('proceso_pedagogico');
$requisitos = get_input('requisitos');
$no_aplica = get_input('no_aplica');
$objetivos_inv = get_input('objetivos_inv');
$publico = get_input('publico');
$presupuesto = get_input('presupuesto');
$criterios = get_input('criterios');
$usuario = elgg_get_logged_in_user_entity();

$convocatoria_ant = new ElggConvocatoria($id);

//Arreglo con los nombres de los metadatos a actualizar
$nombre_metadato = array('tipo_convocatoria', 'departamento', 'convenio', 'fecha_apertura','fecha_cierre', 'hora_cierre', 'fecha_pub_resultados', 'proceso_pedagogico', 'requisitos', 'no_aplica', 'objetivos', 'publico',
    'criterios_revision_seleccion', 'presupuesto');
$convocatoria_ant->name = $nombre;
//Arreglo con el valor con los que se actualizaran los metadatos
$value_metadato = array($tipo_convocatoria, $dpto, $convenio,$f_apertura, $f_cierre, $hora, $f_resultados, $proceso_pedagogico, $requisitos, $no_aplica, $objetivos_inv, $publico, $criterios, $presupuesto);

for ($i = 0; $i < count($nombre_metadato); $i++) {

    if ($convocatoria_ant->$nombre_metadato[$i] != $value_metadato[$i]) {

        $options = array(
            'guid' => $convocatoria_ant->guid,
            'metadata_name' => $nombre_metadato[$i],
            'limit' => false
        );
        $g = elgg_delete_metadata($options);

       
        if (!is_null($value_metadato[$i]) && ($value_metadato[$i] !== '')) {
            create_metadata($convocatoria_ant->guid, $nombre_metadato[$i], $value_metadato[$i], 'text', $usuario->guid, ACCESS_PUBLIC);
        }
    }
}

elgg_clear_sticky_form('profile:edit');
system_message(elgg_echo("convocaroria:edit:saved"));
$convocatoria_ant->save();
forward('/convocatorias/listado');