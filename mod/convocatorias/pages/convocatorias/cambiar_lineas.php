<?php
/**
 * Página que prepara los datos necesarios para la administración de las líneas temáticas dentro de una convocatoria 
 */
elgg_load_css("coordinacion");

$title = "Cambiar Líneas";
$guid=  get_input('id');

$convocatoria= new ElggConvocatoria($guid);

elgg_push_breadcrumb(elgg_echo('convocatorias:menu:title'), 'convocatorias/');
elgg_push_breadcrumb($convocatoria->name,"convocatorias/detalles/{$guid}");
elgg_push_breadcrumb('Administrar lineas tematicas',"convocatorias/lineas/$guid");

if($convocatoria->tipo_convocatoria=="Proyectos abiertos y preestructurados"){
    $lineasTodas= elgg_get_lineas_tematicas();
    $tipo='Mixta';
}else{
    $lineasTodas= elgg_get_lineas_tematicas_tipo($convocatoria->tipo_convocatoria);
    $tipo='Normal';
}
$lineasAsociadas = elgg_get_relationship($convocatoria, "tiene_la_línea_temática");

$lineas_sin_asociar= Array();
$lineas_asociadas= Array();
$lineas_abiertas= Array();
$lineas_abiertas_asociadas= Array();

foreach ($lineasAsociadas as $linea) {
    if($convocatoria->tipo_convocatoria=="Proyectos abiertos y preestructurados"){
        if($linea->tipo=="Proyectos abiertos"){
            $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
            array_push($lineas_abiertas_asociadas, $lin);
        }else{
            $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
            array_push($lineas_asociadas, $lin);
        }
    }else{
        $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
        array_push($lineas_asociadas, $lin);
    }
}

foreach ($lineasTodas as $linea) {
    $sw=false;
    foreach ($lineasAsociadas as $lin){
        if($linea->guid == $lin->guid){
            $sw=true;
            break;
        }
    }
    if(!$sw){
        if($convocatoria->tipo_convocatoria=="Proyectos abiertos y preestructurados"){
            if($linea->tipo=="Proyectos abiertos"){
                $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
                array_push($lineas_abiertas, $lin);
            }else{
                $lin= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
                array_push($lineas_sin_asociar, $lin);
            }
        }else{
            $line= array('id_linea'=>$linea->guid, 'nombre_linea'=>$linea->name);
            array_push($lineas_sin_asociar, $line);
        }
    }
}

$params = array ('id'=>$guid, 'nombre'=>$convocatoria->name, 'departamento'=>$convocatoria->departamento, 
                    'convenio'=>$convocatoria->convenio, 'fecha_apertura'=>$convocatoria->fecha_apertura, 
                    'fecha_cierre'=>$convocatoria->fecha_cierre, 'lineas_sin_asociar'=>$lineas_sin_asociar, 
                    'lineas_asociadas'=>$lineas_asociadas, 'lineas_sin_asociar_abiertas'=>$lineas_abiertas,
                    'lineas_asociadas_abiertas'=>$lineas_abiertas_asociadas, 'tipo'=>$tipo);

$content.= elgg_view('convocatorias/listado_lineas', $params);
$body = array('content' => $content);
echo elgg_view_page($title, $body, "coordinacion_one_column", array());