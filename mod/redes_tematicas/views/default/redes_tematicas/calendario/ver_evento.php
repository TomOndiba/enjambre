<?php

$guid_evento = get_input('guid_evento');
$evento = new ElggAsesoriaRed($guid_evento);
$turnos = json_decode($evento->turno);
$html_turnos = "<table style='width:100%;text-align:center;  border:black 1px solid; padding:5px;' class='table-turnos' border='1'>"
        . "<tr><th><b>Hora</b></th><th><b>Estado</b></th><th><b>Opciones</b></th></tr>";
$investigaciones = elgg_get_entities_from_relationship(array(
        'relationship' => 'pertenece_a_red',
        'relationship_guid'=> $red,
        'inverse_relationship'=>true));
$inv = "<select name='investigacion' id='investigacion'>";
foreach($investigaciones as $investigacion){
   if($investigacion->owner_guid  == elgg_get_logged_in_user_guid()){
       $inv.= "<option value='$investigacion->guid'>{$investigacion->name}</option>";
   }
}
if($inv == "<select name='investigacion' id='investigacion'>"){
    $inv = false;
}else{
    $inv.= "</select>";
}
foreach($turnos as $turno){
    $estado = "Disponible";
    $link = "<a onclick=\"apartarTurno('{$turno->hora}')\">Reservar</a>";
    if($turno->inv != "n"){
        $estado = "Reservada";
        $link = "No disponible";
    }
    if(!$inv){
        $link = "No disponible";
    }
    $html_turnos .= "<tr><td>{$turno->hora}</td><td>{$estado}</td><td>$link</td></tr>";
}
$html_turnos .= "</table>";
$select = "";
if($inv){
    $select = "<span><b>Seleccione una Investigación</b></span>".$inv."<br><br>";
}
echo elgg_view('vistas/js');
echo <<<HTML
<div id="ver-evento">
<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar el Evento?</div>
<h2 class="title-legend">Asesoria</h2>
<div class='iconos-eventos' style='display:inline-block; margin-top: 20px;'>$editar $eliminar</div>
<span><b>Fecha:</b>&nbsp;</span>{$evento->fecha} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span><b>Hora de Inicio:</b>&nbsp;</span>{$evento->hora_inicio}:00 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<span><b>Hora fin:</b>&nbsp;</span>{$evento->hora_fin}:00<br><br> 
$select
$html_turnos
        
<script>    
    function apartarTurno(hora){
        var investigacion = $("#investigacion").val();
        elgg.get('ajax/view/redes_tematicas/calendario/apartar_turno', {
            timeout: 30000,
            data: {
                hora:hora,
                red: $evento->owner_guid,
                asesoria: $evento->guid,
                investigacion: investigacion
            }, 
            success: function(result, success, xhr) {
                $('#info-result').html(result);
                location.reload(true);
            },
        });
    }
</script>
</div>
HTML;
?>