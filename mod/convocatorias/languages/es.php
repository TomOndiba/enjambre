<?php
/**
 * Lenguaje español para el plugin de convocatorias
 */
$espa = array(
    //Registrar convocatoria
    'convocatorias:admin:instruct' => 'Por favor diligencie el siguiente formulario',
    'convocatoria:ok:create' => 'La convocatoria ha sido creada',
    'convocatoria:error:create'=>'Ha ocurrido un error al crear la convocatoria',
    
    //Asociar líneas temáticas a la convocatoria
    'convocatoria:ok:rel_lin_conv' => 'La relación convocatoria-linea ha sido creada',
    'convocatoria:error:rel_lin_conv' => 'Ha ocurrido un error al crear la relacion con la(s) linea(s)',
    //Desasociar líneas temáticas de una convocatoria
    'convocatoria:ok:delete:rel_lin_conv' => 'Se ha desasociado exitosamente la línea temática',
    'convocatoria:error:delete:rel_lin_conv' => 'Ha ocurrido un error al desasociar la línea temática',
    
    //Listar convocatorias
    'convocatoria:listado'=>'A continuación encontrará el listado de las convocatorias. Para crear una nueva, haga clic en Registrar.',
    'convocatoria:listado:vacio'=>'No existen convocatorias registradas. Para crear una nueva, haga clic en Registrar.',
    'convocatoria:ok:delete'=>'Se ha eliminado exitosamente la convocatoria',
    'convocatoria:error:delete'=>'Ha ocurrido un error al eliminar la convocatoria',
    
    //Administrar lineas temáticas a una convocatoria
    'convocatoria:lineas:asociadas'=>'Las líneas asociadas a esta convocatoria son:',
    'convocatoria:lineas:no:asociadas'=>'Selecciones las líneas que desea asociar y de clic en el botón Aceptar:',
    'convocatoria:lineas:asociadas:vacia'=>'Esta convocatoria no tiene líneas asociadas.',
    'convocatoria:lineas:no:asociadas:vacia'=>'No existen otras líneas temáticas para asociar a esta convocatoria.',
    'convocatoria:lineas:admin' => 'Administrar Líneas Temáticas',
    
    //Editar una convocatoria
    'convocaroria:edit:saved'=>'Se almacenaron los datos de la convocatoria...',
    'inscripcion:convocatoria:rechazada'=>'La Investigación no se puede inscribir a la convocatoria porque fue rechazada',
    
    'convocatoria:evaluador:asignado:ok' => 'Se ha asignado el evaluador a la investigacion.',
    'convocatoria:evaluador:asignado:fail' => 'Ha ocurrido un error, por favor intentelo de nuevo.',
    'convocatoria:evaluador:asignado:clean' => 'Por favor seleccione el evaluador apra asignarlo.',
    
    //Investigaciones
    'seleccionada:convocatoria:ok'=>'Aprobación exitosa',
    'seleccionada:convocatoria:error'=>'No se pudo aprobar la investigación',
    'presupuesto:ok:asignacion'=>'Presupuesto asignado exitosamente',
    'presupuesto:error:asignacion'=>'Error al asignar el presupuesto',
    
    //Banco elegibles
    'convocatorias:elegibles:instruct'=>'Seleccione las investigaciones que desea invitar para ser financiadas en esta convocatoria.',
    'convocatorias:no:elegibles:instruct'=>'No existen investigaciones en el banco para ser invitadas a esta convocatoria.',
    'invitacion:aceptada:ok'=>'Invitación aceptada exitosamente',
    'invitacion:aceptada:error'=>'Ha ocurrido un error al aceptar la invitación',
    'invitacion:aceptada:error1'=>'No se pudo aceptar la invitación a la convocatoria',
    'invitacion:rechazada:ok'=>'Ha rechazado exitosamente la invitación',
    'invitacion:rechazada:error'=>'Ha ocurrido un error al rechazar la invitación',
    'invitacion:rechazada:error1'=>'No se pudo rechazar la invitación a la convocatoria',
);

add_translation('es', $espa);