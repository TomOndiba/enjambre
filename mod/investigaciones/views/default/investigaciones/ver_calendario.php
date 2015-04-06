<?php
elgg_load_js('fullcalendar');
elgg_load_css("fullcalendar_css");
elgg_load_js("reveal2");
elgg_load_css('reveal');
elgg_load_css("timer");
elgg_load_js('validate');
$guid = get_input('guid_inv');


$json_data_asesoria = elgg_get_json_asesorias($guid);
$site_url = elgg_get_site_url();

$user = elgg_get_logged_in_user_guid();

if (elgg_is_miembro_admin($guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $guid)) {
   
    $crear_evento='<div class="div-nuevo-evento" style="margin-right:60px;"data-tooltip="Crear un Nuevo Evento"  onclick=\' getCrearEvento("' . $guid . '")  \'></div>';

}
?>
<script>
    var ancho = 0;
    $(document).ready(function() {
        $('#info-evento').hide(),
                $('#calendar').fullCalendar({
            height: 400,
            width: 500,
            events:
<?php echo $json_data_asesoria ?>,
            eventClick: function(calEvent, jsEvent, view) {
                pintarEvento(calEvent.id, jsEvent);
            }
        });
        $("#calendar").fullCalendar('next');
        $("#calendar").fullCalendar('prev');
        $('[data-tooltip!=""]').qtip({// Grab all elements with a non-blank data-tooltip attr.
            style: "qtip-bootstrap",
            content: {
                attr: 'data-tooltip'
            }
        })
    });



    function pintarEvento(id, jsEvent) {
        elgg.get('ajax/view/investigaciones/ver_evento', {
            timeout: 30000,
            data: {
                guid_evento: id,
            },
            success: function(result, success, xhr) {
                $('#info-evento').html(result);
                animarVerEvento();
                pintarTimer();
            },
        });
    }

    function pintarTimer() {
        try {
            $("#DateCountdown").css('width', "65%");
            $("#DateCountdown").TimeCircles({
                "animation": "smooth",
                "bg_width": 0.83333333333333333,
                "fg_width": 0.08333333333333333,
                "circle_bg_color": "#60686F",
                "time": {
                    "Days": {
                        "text": "Dias",
                        "color": "#FFCC66",
                        "show": true
                    },
                    "Hours": {
                        "text": "Horas",
                        "color": "#99CCFF",
                        "show": true
                    },
                    "Minutes": {
                        "text": "Minutos",
                        "color": "#BBFFBB",
                        "show": true
                    },
                    "Seconds": {
                        "text": "Seconds",
                        "color": "#FF9999",
                        "show": false
                    }
                }
            });
        } catch (err) {
        }
    }


    function animarVerEvento() {
        $('#calendar').hide();
        $('#info-evento').show();
    }
    
    function pintarIconoCalendario(alto) {
        var retorno = "<div class='ver-calendario' onclick='getVerCalendario(<?php echo $guid ?>)' style='width:" + alto + "px; margin-top:" + alto + "px'>Ver Calendario<div>";
        return retorno;
    }
</script>
<script>
    function getCrearEvento(guid) {
        var owner = guid;
        elgg.get('ajax/view/grupo_investigacion/calendario/crear_evento_1', {
            timeout: 30000,
            data: {
                owner: owner,
            },
            success: function(result, success, xhr) {
                $('#info-evento').html(result);
                animarVerEvento();
            },
        });
    }

    function cerrarCalendario() {
        $('.contenedor-calendario').hide();
    }
</script>

<div class="titulo-pop-up-calendario">Calendario<?php echo $crear_evento?></div>
<div  class='calendario'>
    <?php // echo $header;      ?>
    <div id='calendar' class=''></div>

    <div id='info-evento' class=''></div>
</div>
