<?php

elgg_load_library('elgg:webinar');

$invitacion = get_input('enviar_a');

$variables = webinar_prepare_form_vars();
$input = array();
foreach (array_keys($variables) as $field) {

    $input[$field] = get_input($field);
    if ($field == 'title') {
        $input[$field] = strip_tags($input[$field]);
    }
    if ($field == 'tags') {
        $input[$field] = string_to_tag_array($input[$field]);
    }
}

elgg_make_sticky_form('webinar');

if (!$input['title']) {
    register_error(elgg_echo('webinar:error:no_title'));
    forward(REFERER);
}


if (sizeof($input) > 0) {

    if (isset($input[guid]) && !empty($input[guid])) {
        $webinar = get_entity($input[guid]);
        if (!$webinar || !$webinar->canEdit()) {
            register_error(elgg_echo('webinar:error:no_save'));
            forward(REFERER);
        }
        $new_webinar = false;
    } else {
        $webinar = new ElggWebinar();
        $new_webinar = true;
    }

    foreach ($input as $field => $value) {
        $webinar->$field = $value;
    }

    if ($webinar->save()) {

        elgg_clear_sticky_form('webinar');

        system_message(elgg_echo('webinar:saved'));


        if ($new_webinar) {
            //$webinar->logout_url = $webinar->getURL();
            $webinar->logout_url = elgg_get_site_url();
            $webinar->estado = 'creada';
            $webinar->save();


            // Instatiate the BBB class:
            $bbb = new BigBlueButton();

            /* ___________ CREATE MEETING w/ OPTIONS ______ */
            /*
             */
            $creationParams = array(
                'meetingId' => $webinar->getGUID(), // REQUIRED
                'meetingName' => $webinar->title, // REQUIRED
                'attendeePw' => 'ap', // Match this value in getJoinMeetingURL() to join as attendee.
                'moderatorPw' => 'mp', // Match this value in getJoinMeetingURL() to join as moderator.
                'welcomeMsg' => $webinar->welcome_msg, // ''= use default. Change to customize.
                'dialNumber' => '', // The main number to call into. Optional.
                'voiceBridge' => '12345', // 5 digit PIN to join voice. Required.
                'webVoice' => '', // Alphanumeric to join voice. Optional.
                'logoutUrl' => $webinar->logout_url, // Default in bigbluebutton.properties. Optional.
                'maxParticipants' => '-1', // Optional. -1 = unlimitted. Not supported in BBB. [number]
                'record' => 'true', // New. 'true' will tell BBB to record the meeting.
                'duration' => '0', // Default = 0 which means no set duration in minutes. [number]
                    //'meta_category' => '', 				// Use to pass additional info to BBB server. See API docs.
            );
            $itsAllGood = true;
            try {
                $result = $bbb->createMeetingWithXmlResponseArray($creationParams);
            } catch (Exception $e) {
                echo 'Caught exception: ', $e->getMessage(), "\n";
                $itsAllGood = false;
            }

            if ($itsAllGood == true) {
                // If it's all good, then we've interfaced with our BBB php api OK:
                if ($result == null) {
                    // If we get a null response, then we're not getting any XML back from BBB.
                    echo "Failed to get any response. Maybe we can't contact the BBB server.";
                } else {
                    // We got an XML response, so let's see what it says:
                    print_r($result);
                    if ($result['returncode'] == 'SUCCESS') {
                        // Then do stuff ...
                        echo "<p>Meeting succesfullly created.</p>";
                    } else {
                        echo "<p>Meeting creation failed.</p>";
                    }
                }
            }
            add_to_river('river/object/webinar/create', 'create', elgg_get_logged_in_user_guid(), $webinar->getGUID());
        }

        if (!empty(get_input('investigacion'))) {
            //Identifico la investigación
            $investigacion = get_entity(get_input('investigacion'));
            $asesoria = get_entity(get_input('guid_asesoria'));

            $asesoria->addRelationship($webinar->guid, 'tiene_sala');
            //Verifico qué se desea realizar. A quién se le notifica
            if ($invitacion == 'Grupo de Investigación') {

                //Busco el grupo de inv al que pertenece la investigacion
                $grupo_inv = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion");
                $integrantes_grupo = elgg_get_relationship_inversa($grupo_inv[0], "es_miembro_de");

                //Preparo el link para que los invitados ungresen al webinar
                $link = elgg_get_site_url() . "asesores/asesorias/ver_sala/{$webinar->getGUID()}";
                $url_ready = "<a href='{$link}'>clic aquí</a>";

                if (sizeof($integrantes_grupo) > 0) {
                    foreach ($integrantes_grupo as $in) {
                        if (!empty($in->email)) {
                            elgg_enviar_correo($in->email, "invitacion a Actividad", "Hola!, Como integrante del grupo de investigacion " . $grupo_inv->name . ", haz sido invitado a participar en la actividad con tu asesor. Para ingresar da " . $url_ready);
                        }
                        messages_send("invitacion a Actividad", "Hola!, Como integrante del grupo de investigacion " . $grupo_inv->name . ", has sido invitado a participar en la actividad con tu asesor. Para ingresar da " . $url_ready, $in->guid);
                    }
                }
            } else {

                //busco lo estudiantes que pertenecen a la investigacion
                $integrantes = elgg_get_relationship_inversa($investigacion, 'hace_parte_de');

                //Preparo el link para que los invitados ungresen al webinar
                $link = elgg_get_site_url() . "asesores/asesorias/ver_sala/{$webinar->getGUID()}";
                $url_ready = "<a href='{$link}'>clic aquí</a>";


                if (sizeof($integrantes) > 0) {
                    foreach ($integrantes as $in) {
                        if (!empty($in->email)) {
                            elgg_enviar_correo($in->email, "invitacion a Actividad", "Hola!, Como integrante de la investigación " . $investigacion->name . ", haz sido invitado a participar en la actividad con tu asesor. Para ingresar da " . $url_ready);
                        }
                        messages_send("invitacion a Actividad", "Hola!, Como integrante de la investigación " . $investigacion->name . ", has sido invitado a participar en la actividad con tu asesor. Para ingresar da " . $url_ready, $in->email);
                    }
                }
            }
        }

        //forward($webinar->getURL());
        forward(REFERER);
    }
}

register_error(elgg_echo('pages:error:no_save'));
forward(REFERER);


