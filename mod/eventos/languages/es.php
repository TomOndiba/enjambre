<?php

$espa = array(
    'evento:listado'=>'A continuación encontrará el listado de los eventos asociados a la convocatoria.',
    'evento:listado:vacio'=>'No existen eventos registrados para esta convocatoria.',
    'evento:admin:instruct' => 'Por favor diligencie el siguiente formulario',
    'evento:ok:create' => 'El evento ha sido creado',
    'evento:error:create'=>'Ha ocurrido un error al crear el evento',
    'evento:error:create:asociacion'=>'Ha ocurrido un error al asociar el evento a la convocatoria',
    
    'evento:asistentes:instruct'=>'A continuación encontrará la lista de personas que se han preinscrito al evento. Para '
                                    . 'confirmar la asistencia, seleccionelos y haga clic en Vincular. <br><br>'
                                    . 'Si desea vincular un nuevo usuario, haga clic en Directorio. ',
    'evento:ok:asistencia'=>'Se confirmó exitosamente la asistencia de los usuarios al evento',
    'evento:error:asistencia'=>'No se pudo confirmar la asistencia de todos los usuarios al evento',
    'evento:no:preinscritos:instruct'=>'No existen personas inscritas para asistir a este evento. Para añadir asistentes de clic en Directorio.',
    'evento:otros:asistentes:instruct'=>'A continuación encontrará la lista de las personas que no se han preinscrito para participar en el evento. '
                                            . 'Para marcar como asistentes, seleccionelos y haga clic en Vincular.',
    'evento:no:usuarios:instruct'=>'No existen usuarios para ser registrados como asistentes al evento',
    'evento:ok:nueva:asistencia'=>'Registro exitoso de los usuarios como asistentes del evento',
    'evento:error:nueva:asistencia'=>'No se pudo realizar el registro de los usuarios como asistentes del evento',
    
    'aceptada:inscripcion:eventos' => 'Se ha inscrito satisfactoriamente.',
    'rechazada:inscripcion:eventos' => 'No se puedo completar la inscripción.',
    
    'evento:ok:delete'=>'Se ha eliminado exitosamente el evento',
    'evento:error:delete'=>'Ha ocurrido un error al eliminar el evento',
    'evento:edit:saved'=>'Se almacenaron los datos del evento',
    'ok:desinscripcion:eventos' => 'Eliminada la inscripcion',
    'error:desinscripcion:eventos' => 'No se ha completado la acción.',
    
    'convocatorias:menu:title'=>'Convocatorias',
    
    //feria
    'evento:listado:feria'=>'A continuación encontrará el listado de los eventos asociados a la feria.',
    'evento:listado:vacio:feria'=>'No existen eventos registrados para esta feria.',
    'evento:error:create:asociacion:feria'=>'Ha ocurrido un error al asociar el evento a la feria',
    
);

add_translation('es', $espa);