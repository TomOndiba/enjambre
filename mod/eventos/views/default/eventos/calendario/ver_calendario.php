<?php
elgg_load_js('fullcalendar');
elgg_load_css("fullcalendar_css");
elgg_load_js("reveal2");
elgg_load_css('reveal');
$entity = $vars['entity'];

$json_data = elgg_get_json_eventos_entity($entity);
?>

<script>
    $(document).ready(function() {
        $('#info-evento').hide(), $('#calendar').fullCalendar({
            height: 450,
            width: 500,
            events:
<?php echo $json_data ?>,
            eventClick: function(calEvent, jsEvent, view) {
                pintarEvento(calEvent.id, jsEvent);
            }

        });

    });




    function pintarEvento(id, jsEvent) {
        var modalLocation = "myModalEv";
        $('#' + modalLocation).reveal($(this).data());
        elgg.get('ajax/view/eventos/calendario/ver_evento', {
            timeout: 30000,
            data: {
                guid_evento: id,
            },
            success: function(result, success, xhr) {
                $('#ver-info-evento').html(result);
            },
        });
    }
    

</script>




<div id="myModalEv" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="pop-up-calendar pop-up">
        <div id='ver-info-evento'></div>
    </div>
</div>
<div class='box contet-grupo-investigacion'><div class='padding20'>
        <?php echo $breadcrumbs . $header ?>
        <div id='calendar'>
            
        </div>

        <div id='info-evento'>

        </div>

    </div></div>
