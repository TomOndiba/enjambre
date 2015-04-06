<?php

$convocatoria = get_input("convocatoria");
$investigacion = get_input("iniciativa");
if(add_entity_relationship($investigacion, "inscrita_a_convocatoria_especial", $convocatoria)){
    system_message("Se ha registrado tu iniciativa a la convocatoria. Tu iniciativa sera evaluada y recibiras un email con el resultado de tu evaluación.");
}else{
    register_error("Ha ocurrido un error en el proceso. Intentalo nuevamente");
}
forward(REFERER);