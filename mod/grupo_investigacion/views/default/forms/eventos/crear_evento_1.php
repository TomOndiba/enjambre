<?php
$guid = $vars['entity'];
$evento = get_entity($vars['evento']);

$nombre_input = elgg_view('input/text', array('name' => 'nombre_evento', 'value' => $evento->nombre_evento,));
$fecha_inicio_input = elgg_view('input/date', array('name' => 'fecha_inicio', 'id' => 'fechaInicio', 'value' => $evento->fecha_inicio));
//$fecha_inicio_input = "<input type='text' class='calendario' name='fecha_inicio' id='fechaInicio' value='$evento->fecha_inicio' 'required = true'>";
$fecha_terminacion_input = elgg_view('input/date', array('name' => 'fecha_fin', 'id' => 'fechaFin', 'value' => $evento->fecha_terminacion));
//$fecha_terminacion_input = "<input type='text' class='calendario' name='fecha_fin' id='fechaFin' value='$evento->fecha_terminacion' 'required = true'>";

$lugar_input = elgg_view('input/text', array('name' => 'lugar', 'value' => $evento->lugar,));
$button = elgg_view('input/submit', array('id' => 'aceptarEvento', 'value' => elgg_echo('Aceptar')));
$hora_input = elgg_view('input/text', array('name' => 'hora', 'id' => 'horaInicioE', 'value' => $evento->hora, 'class' => 'input-hora',));

$hora_input2 = elgg_view('input/text', array('name' => 'hora2', 'id' => 'horaFinE', 'value' => $evento->horaFin, 'class' => 'input-hora',));

$hidden_input = "<input type='hidden' name='guid' value='{$guid}'/> ";
$hidden_input2 = "<input type='hidden' name='evento' value='{$evento->guid}'/> ";
$site_url = elgg_get_site_url();



if ($evento) {
    $titulo = "Editar Evento";
} else {
    $titulo = "Crear Evento";
}

echo <<<HTML
<div id="dialog_ev" title="Fecha inválida"></div>
<div class="form-calendario">
<h2 class="title-legend"> $titulo </h2>

<div>
    <label>Nombre(*)</label><br />$nombre_input
</div>
<div class='row' style='width:45%; margin-left:20px;'>        
        <label>Fecha de inicio(*)</label><br />$fecha_inicio_input
    </div>
    <div class='row' style='width:45%'>
        <label>Fecha de terminación(*)</label><br />$fecha_terminacion_input
    </div>
<div class='row' style='width:45%; margin-left:20px;'>
    <label>Hora de Inicio del Evento:</label> $hora_input
</div>
 
   <div  class='row' style='width:45%'>
    <label>Hora de Fin del Evento:</label> $hora_input2
</div> 
        
<div>
    <label>Lugar(*)</label>$lugar_input
</div>
{$hidden_input}{$hidden_input2}
<div class="contenedor_button">

$button &nbsp;&nbsp;&nbsp;&nbsp;
</div></div>
HTML;
?>
<script>
    $(document).ready(function() {

        $(".elgg-form-eventos-crear-evento-1").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                nombre_evento: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                lugar: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                fecha_inicio: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                fecha_fin: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                hora: {/*id del campo que se aplica la regla*/
                    required: true,
                },
                hora2: {/*id del campo que se aplica la regla*/
                    required: true,
                },
            },
            messages: {
                nombre_evento: {
                    required: "Es necesario el nombre del evento para crearlo",
                },
                lugar: {/*id del campo que se aplica la regla*/
                    required: 'Es necesario el lugar donde se llevará a cabo el evento para crearlo.',
                },
                fecha_inicio: {/*id del campo que se aplica la regla*/
                    required: 'Es necesaria la fecha de inicio del evento para crearlo',
                },
                fecha_fin: {/*id del campo que se aplica la regla*/
                    required: 'Es necesaria la fecha de finalización del evento para crearlo',
                },
                hora: {/*id del campo que se aplica la regla*/
                    required: 'Es necesaria la hora de inicio del evento para crearlo',
                },
                hora2: {/*id del campo que se aplica la regla*/
                    required: 'Es necesaria la hora de finalización del evento para crearlo',
                },
            }
        });


        $("#dialog_ev").dialog({
            autoOpen: false, // no abrir automáticamente
            resizable: true, //permite cambiar el tamaño
            height: 220, // altura
            modal: true, //capa principal, fondo opaco
            buttons: {//crear botón de cerrar
                "Cerrar": function() {
                    $(this).dialog("close");
                }
            }
        });


        $('#aceptarEvento').live('click', function() {
            var fechaActual = new Date();
            var fechaInicioEvento = new Date($('#fechaInicio').val());
            fechaInicioEvento.setDate(fechaInicioEvento.getDate() + 1);
            var fechaFinEvento = new Date($('#fechaFin').val());
            fechaFinEvento.setDate(fechaFinEvento.getDate() + 1);

            var horaInicio = $('#horaInicioE').val();
            var horaFin = $('#horaFinE').val();


            var cadena1 = horaInicio.split(':');
            var cadena2 = horaFin.split(':');
            var hora1 = cadena1[0];
            var hora2 = cadena2[0];


            var minutosHI = cadena1[1].split(" ");
            var minutosHF = cadena2[1].split(" ");


            if (fechaActual >= fechaInicioEvento) {
                $("#dialog_ev").html("");
                $("#dialog_ev").append("La fecha de inicio del Evento debe ser mayor o igual a la fecha actual");
                $("#dialog_ev").dialog("open");
                return false;
            }
            else if (fechaActual >= fechaFinEvento) {
                $("#dialog_ev").html("");
                $("#dialog_ev").append("La fecha de fin del Evento debe ser mayor o igual a la fecha actual");
                $("#dialog_ev").dialog("open");
                return false;
            }
            else if (fechaInicioEvento > fechaFinEvento) {
                $("#dialog_ev").html("");
                $("#dialog_ev").append("La fecha de inicio del Evento debe ser menor o igual a la fecha de Fin");
                $("#dialog_ev").dialog("open");
                return false;
            }
            else if (fechaInicioEvento.getDay() == fechaFinEvento.getDay()) {
               
                if (minutosHI[1] == "PM") {
                    hora1 = parseInt(hora1) + 12;

                }
                if (minutosHF[1] == "PM") {
                    hora2 = parseInt(hora2) + 12;

                }
                if (hora1 > hora2) {
                    $("#dialog_ev").html("");
                    $("#dialog_ev").append("La hora de inicio debe ser menor a la hora de fin");
                    $("#dialog_ev").dialog("open");
                    return false;
                }

                if (hora1 == hora2) {
                    if (minutosHI[0] > minutosHF[0]) {
                        $("#dialog_ev").html("");
                        $("#dialog_ev").append("La hora es la misma, pero los minutos de inicio deben ser menores a los minutos de fin");
                        $("#dialog_ev").dialog("open");
                        return false;
                    }

                }
            }
            return true;
        });
    });
</script>