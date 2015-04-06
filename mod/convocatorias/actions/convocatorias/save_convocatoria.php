<?php

/**
 * Guarda en base de datos una nueva convocatoria de acuerdo a los datos recibidos de un formulario
 */

    $tipo_convocatoria = get_input('proyectos');
    $nombre = get_input('nombre');
    $departamento = get_input('departamento'); 
    $convenio = get_input('convenio');
    $fecha_apertura = get_input('fecha_apertura'); 
    $fecha_cierre = get_input('fecha_cierre'); 
    $hora_cierre = get_input('hora'); 
    $hora1_cierre = get_input('minutos');
    $hora=$hora_cierre.":".$hora1_cierre;
    $fecha_pub_resultados = get_input('fecha_resultados'); 
    $proceso_pedagogico = get_input('proceso_pedagogico'); 
    $requisitos = get_input('requisitos'); 
    $no_aplica = get_input('no_aplica'); 
    $objetivos = get_input('objetivos_inv'); 
    $publico = get_input('publico'); 
    $criterios = get_input('criterios'); 
    $presupuesto = get_input('presupuesto');
    $especial = get_input("especial");
    error_log($especial);

   if(elgg_existe_entity($nombre,"convocatoria")){
   register_error(elgg_echo("Ya existe una Convocatoria registrada con ese nombre")); 
   forward(REFERER);
   }
    
    
    $convocatoria = new ElggConvocatoria();
    $convocatoria->name=$nombre;
    $convocatoria->tipo_convocatoria=$tipo_convocatoria;
    $convocatoria->departamento=$departamento;
    $convocatoria->convenio=$convenio;
    $convocatoria->fecha_apertura=$fecha_apertura;
    $convocatoria->fecha_cierre=$fecha_cierre;
    $convocatoria->hora_cierre=$hora;
    $convocatoria->fecha_pub_resultados=$fecha_pub_resultados;
    $convocatoria->proceso_pedagogico=$proceso_pedagogico;
    $convocatoria->requisitos=$requisitos;
    $convocatoria->no_aplica=$no_aplica;
    $convocatoria->objetivos=$objetivos;
    $convocatoria->publico=$publico;
    $convocatoria->criterios_revision_seleccion=$criterios;
    $convocatoria->presupuesto=$presupuesto;
    $convocatoria->especial = $especial;
    
    $guid=$convocatoria->save();
    if (!$guid) {
        register_error(elgg_echo("convocatoria:error:create"));
        forward(REFERER);
    }

    else{
        system_message(elgg_echo("convocatoria:ok:create"));
        forward('/convocatorias/lineas/'.$guid);
    }
