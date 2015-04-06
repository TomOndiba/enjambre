<?php

//function elgg_get_notas($limit, $offset, $guid, $etapa) {
//        

//    $query = array('type' => 'object', 'subtype' => 'nota', 'owner_guid'=>$guid, 'metadata_names'=>'etapa', 'metadata_values'=>$etapa);
//    $options = array('query' => $query, 'limit' => $limit, 'offset' => $offset, 'view' => 'nota/lista_notas', 'guid'=>$guid);
//    $content = elgg_list_paginable_entities_metadata($options);

//    echo $content;
//    
//}


function elgg_get_total_notas($guid, $etapa, $tipo) {
    $options = array("type" => 'object',
        'subtype' => 'nota',
        'owner_guid' => $guid,
        'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => $etapa),
            array('name' => 'tipo', 'value' => $tipo),
        ),
        'count' => true);
    return elgg_get_entities_from_metadata($options);
}

function elgg_get_total_actividades($guid, $etapa, $tipo) {
    $options = array("type" => 'object',
        'subtype' => 'nota',
        'owner_guid' => $guid,
        'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => $etapa),
            array('name' => 'tipo', 'value' => $tipo),
        ),
        'count' => true);
    $return = elgg_get_entities_from_metadata($options);
    if(!$return){
        $return=0;
    }
    error_log($return);
    return $return;
}

function elgg_get_notas($guid, $offset, $limit, $etapa, $tipo) {
    $options = array("type" => 'object',
        'subtype' => 'nota',
        'owner_guid' => $guid,
        'limit' => $limit,
        'offset' => $offset,
        'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => $etapa),
            array('name' => 'tipo', 'value' => $tipo),
        )
    );
    return elgg_get_entities_from_metadata($options);
}

function elgg_get_totales_notas_investigacion($guid) {
    $etapas = array('cero', 'uno', 'dos', 'tres', 'cuatro');
    $tipos = array('Actividades/Sucesos', 'reflexion', 'aspectos', 'documentos', 'anecdotas');
    $resultado = array();
    foreach ($etapas as $etapa) {
        $fila = array();
        foreach ($tipos as $tipo) {
            $cantidad = elgg_get_total_notas($guid, $etapa, $tipo);
            array_push($fila, $cantidad);
        }
        array_push($resultado, $fila);
    }
    return $resultado;
}


function elgg_get_componentes($etapa,$categoria, $investigacion){
    
     $options = array("type" => 'object', 
        'subtype' => 'componente',
         'owner_guid'=>$investigacion,
          'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => $etapa),
            array('name' => 'categoria', 'value' => $categoria),
        )
    );
    $resultado=elgg_get_entities_from_metadata($options);
   
    
    $options2= array("type" => 'object',
        'subtype' => 'componente',
        'owner_guid'=>$investigacion,
        'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => 'todas'),
            array('name' => 'categoria', 'value' => $categoria),
        )
    );
    
     $resultado2=elgg_get_entities_from_metadata($options2);
     
     $resultado= array_merge($resultado,$resultado2);
     return $resultado;
     
     
    
}

function elgg_get_componentes2($etapa,$categoria, $investigacion, $tipo){
    
     $options = array("type" => 'object', 
        'subtype' => 'componente',
         'owner_guid'=>$investigacion,
          'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => $etapa),
            array('name' => 'categoria', 'value' => $categoria),
            array('name' => 'tipo', 'value' => $tipo),
        )
    );
    $resultado=elgg_get_entities_from_metadata($options);
   
    
    $options2= array("type" => 'object',
        'subtype' => 'componente',
        'owner_guid'=>$investigacion,
        'metadata_name_value_pair' => array(
            array('name' => 'etapa', 'value' => 'todas'),
            array('name' => 'categoria', 'value' => $categoria),
            array('name'=>'tipo', 'value'=>$tipo),
        )
    );
    
     $resultado2=elgg_get_entities_from_metadata($options2);
     
     $resultado= array_merge($resultado,$resultado2);
     return $resultado;
     
     
    
}