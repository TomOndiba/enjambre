<?php
/**
 * Libreria que contiene las funciones para el plugin menssages_evaluador
 * 
 * @author DIEGOX_CORTEX
 */

/**
 * Prepare the compose form variables
 *
 * @return array
 */
function messages_evaluador_prepare_form_vars($recipient_guid = 0) {

	// input names => defaults
	$values = array(
		'subject' => '',
		'body' => '',
		'recipient_guid' => $recipient_guid,
	);

	if (elgg_is_sticky_form('messages_evaluador')) {
		foreach (array_keys($values) as $field) {
			$values[$field] = elgg_get_sticky_value('messages_evaluador', $field);
		}
	}

	elgg_clear_sticky_form('messages_evaluador');

	return $values;
}

/**
 * Función que devuelve los evaluadores registrados en el banco de evaluadores (Grupo evaluadores)
 * @return type -> Array
 */
function elgg_get_evaluadores(){
    $evaluadores = elgg_get_entities(array(
        'type' => 'group',
        'subtype' => 'RedEvaluadores',
    ));
    $eval =null;
    foreach ($evaluadores as $e){
        $eval =$e;
    }
    
   
    
    $integrantes_evaluadores = elgg_get_relationship_inversa($e, 'member');
    
  
    
    return $integrantes_evaluadores;
}

