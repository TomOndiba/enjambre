<?php

$investigacion = get_input('investigacion');
$user = get_input('user');
if (add_entity_relationship($user, 'hace_parte_de', $investigacion)) {
    system_message("El usuario se ha vinculado a la investigación correctamente");
} else {
    register_error("Ha ocurrido un error. Intentelo nuevamente");
}
forward(REFERER);

