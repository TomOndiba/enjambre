<?php

    $id_convocatoria=get_input('id');
    
    $tipo_evento = get_input('tipo_evento');
    $nombre = get_input('nombre_evento');
    $fecha_inicio = get_input('fecha_inicio'); 
    $fecha_terminacion = get_input('fecha_terminacion'); 
    $fecha_lim_confirmacion = get_input('fecha_lim_confirmacion'); 
    $lugar = get_input('lugar'); 
    $max_asistentes = get_input('max_asistentes'); 
    $objetivo = get_input('objetivo'); 
    $dirigido_a = get_input('dirigido_a'); 
    $requisitos = get_input('requisitos'); 
    
    $evento = new ElggEvento();
    $evento->title=$nombre;    
    $evento->nombre_evento=$nombre;
    $evento->tipo_evento=$tipo_evento;
    $evento->fecha_inicio=$fecha_inicio;
    $evento->fecha_terminacion=$fecha_terminacion;
    $evento->fecha_limite_confirmacion=$fecha_lim_confirmacion;
    $evento->lugar=$lugar;
    $evento->max_asistentes=$max_asistentes;
    $evento->objetivo=$objetivo;
    $evento->dirigido_a=$dirigido_a;
    $evento->requisitos_evento=$requisitos;
    $evento->access_id=ACCESS_PUBLIC;
    $guid=$evento->save();
    if (!$guid) {
        register_error(elgg_echo("evento:error:create"));
        forward(REFERER);
    }else{
        $entity=new ElggGroup($id_convocatoria);
        if($entity->addRelationship($guid, "tiene_el_evento")){
            system_message(elgg_echo("evento:ok:create"));
            forward('/eventos/listado/'.$id_convocatoria);
        }else{
            $subtype=$entity->getSubtype();
            if($subtype=='convocatoria'){
                register_error(elgg_echo("evento:error:create:asociacion"));
            }else if($subtype=='feria'){
                register_error(elgg_echo("evento:error:create:asociacion:feria"));
            }
            forward(REFERER);
        }
    }
