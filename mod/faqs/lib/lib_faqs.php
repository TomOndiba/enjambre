<?php

/**
 * Libreria que contiene funciones de ayuda para el plugin faqs
 * @author DIEGOX_CORTEX
 */

/**
 * Funcion que consita y devuelve las categorias registradas en las faqs
 * @return type array
 */
function getCategoriesFaqs() {
    $result = array();

    $metadatas = elgg_get_metadata(array('annotation_name' => "category", 'type' => "object", 'subtype' => "faqs", 'limit' => getFaqsCount()));

    foreach($metadatas as $metadata) {
        $cat = $metadata['value'];
        $id = get_metastring_id($cat);

        if(!in_array($id, $result)) {
            $result[$id] = $cat;
        }
    }

    natcasesort($result);

    return $result;
}

/**
 * Funcion que consulta y devuelve las faqs dependiendo de una categoria
 * @param type $category -> categoria que se desea consultar
 * @return type ->
 */
function getFaqsByCategory($category = NULL){
    return elgg_get_entities_from_metadata(array('metadata_name' => "category",
                                                 'metadata_value' => $category,
                                                 'type' => "object",
                                                 'subtype' => "faqs",
                                                 'limit' => getFaqsCount($category)));
}

/**
 * 
 * @param type $category
 * @return type
 */
function getFaqsCount($category = NULL) {
    return elgg_get_entities_from_metadata(array('metadata_name' => "category",
                                                 'metadata_value' => $category,
                                                 'type' => "object",
                                                 'subtype' => "faqs",
                                                 'count' => true));
}
//
///**
// * 
// * @return type
// */
//function getUserQuestionsCount() {
//    return elgg_get_entities_from_metadata(array('metadata_name' => "userQuestion",
//                                                 'metadata_value' => true,
//                                                 'type' => "object",
//                                                 'subtype' => "faq",
//                                                 'count' => true));
//}
//
//function notifyAdminNewQuestion(){
//
//    global $CONFIG;
//
//    $db_prefix = elgg_get_config('dbprefix');
//    $admins1 = elgg_get_entities(array('type' => 'user',
//                                       'wheres' => "{$db_prefix}users_entity.admin = 'true'",
//                                       'joins' => "JOIN {$db_prefix}users_entity ON {$db_prefix}users_entity.guid = e.guid"));
//    $admins2 = elgg_get_entities(array('type' => 'user',
//                                       'wheres' => "{$db_prefix}users_entity.admin = 'yes'",
//                                       'joins' => "JOIN {$db_prefix}users_entity ON {$db_prefix}users_entity.guid = e.guid"));
//
//    if(is_array($admins1) && is_array($admins2)) {
//        $admins = array_merge($admins1, $admins2);
//    } elseif(is_array($admins1)) {
//        $admins = $admins1;
//    } elseif(is_array($admins2)) {
//        $admins = $admins2;
//    } else {
//        $admins = array();
//    }
//
//    $result = array();
//    foreach($admins as $admin) {
//        $result[] = notify_user($admin->guid, $admin->site_guid, elgg_echo("faq:ask:notify:admin:subject"), sprintf(elgg_echo("faq:ask:notify:admin:message"), $admin->name, $CONFIG->wwwroot . "faq/asked"));
//    }
//
//    if(in_array(true, $result)) {
//        $result = true;
//    } else {
//        $result = false;
//    }
//
//    return $result;
//}