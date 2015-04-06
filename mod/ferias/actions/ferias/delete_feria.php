<?php
/**
 * Eliminar una feria a partir de su id
 */

$id_feria=get_input('id');

$feria= new ElggFeria($id_feria);

//se buscan los eventos pertenecientes a dicha feria para ser eliminados
$eventos= $feria->getEntitiesFromRelationship("tiene_el_evento");

foreach($eventos as $ev){
    $ev->delete();
}

$premios=$feria->premios_distinciones;
$actividades=$feria->actividades;
$requisitos_participacion=$feria->requisitos_participacion;
$publico_invitado=$feria->publico_invitado;
$costos_organizadores=$feria->costos_organizadores;
$parametros_puestos=$feria->parametros_puestos;
$herramientas_presentaciones=$feria->herramientas_presentaciones;
$proceso_valoracion=$feria->proceso_valoracion;
$agenda_feria=$feria->agenda_feria;
$reglamento_feria=$feria->reglamento_feria;

if(!empty($premios)){
    $fil = new FilePluginFile($premios);
    $fil->delete();
    delete_entity($premios);
}

if(!empty($actividades)){
    $fil = new FilePluginFile($actividades);
    $fil->delete();
    delete_entity($actividades);
}

if(!empty($requisitos_participacion)){
    $fil = new FilePluginFile($requisitos_participacion);
    $fil->delete();
    delete_entity($requisitos_participacion);
}

if(!empty($publico_invitado)){
    $fil = new FilePluginFile($publico_invitado);
    $fil->delete();
    delete_entity($publico_invitado);
}

if(!empty($costos_organizadores)){
    $fil = new FilePluginFile($costos_organizadores);
    $fil->delete();
    delete_entity($costos_organizadores);
}

if(!empty($parametros_puestos)){
    $fil = new FilePluginFile($parametros_puestos);
    $fil->delete();
    delete_entity($parametros_puestos);
}

if(!empty($herramientas_presentaciones)){
    $fil = new FilePluginFile($herramientas_presentaciones);
    $fil->delete();
    delete_entity($herramientas_presentaciones);
}

if(!empty($proceso_valoracion)){
    $fil = new FilePluginFile($proceso_valoracion);
    $fil->delete();
    delete_entity($proceso_valoracion);
}

if(!empty($agenda_feria)){
    $fil = new FilePluginFile($agenda_feria);
    $fil->delete();
    delete_entity($agenda_feria);
}

if(!empty($reglamento_feria)){
    $fil = new FilePluginFile($reglamento_feria);
    $fil->delete();
    delete_entity($reglamento_feria);
}

$result = $feria->delete();

if ($result) {
	system_message(elgg_echo('feria:ok:delete'));
} else {
	register_error(elgg_echo('feria:error:delete'));
}

forward("/ferias/listado/");