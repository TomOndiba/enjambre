<?php

/**
 * Action que almacena la informacion de una nueva faq
 * @author DIEGOX_CORTEX
 */
elgg_load_library('tidypics:upload');
action_gatekeeper();
admin_gatekeeper();

$question = get_input("pregunta");
$answer = get_input("answer");
$oldCat = get_input("oldCat");
$newCat = get_input("newCat");
$id = get_input('id');
//$access = (int) get_input("access");

if (!empty($question) && !empty($answer) && (!empty($oldCat) || !empty($newCat))) {

    $cat = "";
    if ($oldCat == "newCat" && !empty($newCat)) {
        $cat = ucfirst(strtolower($newCat));
    } else {
        $cat = ucfirst(strtolower($oldCat));
    }  
   

    if (!empty($cat)) {
        if (empty($id)) {
            $faqs = new Elgg_Faq();
        } else {
            $faqs = new Elgg_Faq($id);
        }
        $faqs->category = $cat;
        $faqs->question = $question;
        $faqs->answer = $answer;
        $faqs->owner_guid = elgg_get_logged_in_user_guid();
        $guid_F = $faqs->save();
        if ($guid_F) {            

            $archivo = get_input('archivo2', '', false);
            
                        
                $name = $_FILES['archivo2']['name'];
                $error = $_FILES['archivo2']['error'];
                $tmp_name = $_FILES['archivo2']['tmp_name'];
                $type = $_FILES['archivo2']['type'];
                $other_name = "archivo2";
                
                elgg_upload_fileS($archivo, $id_file, $name, $error, $tmp_name, $type,  $guid_F, $other_name, $ase, $guid_F);
            

            system_message('Se ha almacenado la información de la pregunta', 'success');
            forward(elgg_get_site_url()."faqs/list/{$cat}");
        } else {
            register_error("No se ha podido completar la accion...");
        }
    } else {
        register_error("No se lecciono una categoria correctamente..");
    }
} else {
    register_error('Asegurese de haber llenado todos los datos...');
    forward(REFERER);
}

