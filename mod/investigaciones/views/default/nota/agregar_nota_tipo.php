<?php
$guid_diario = get_input('diario');
$etapa = get_input('etapa');
$diario_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid_diario));
$etapa_input = elgg_view('input/hidden', array('name' => 'etapa', 'value' => $etapa));

$tipo_input = elgg_view('input/dropdown', array('name' => 'tipo', 'id' => 'tipo', 'options_values' => array('Actividades/Sucesos' => 'Actividades/Sucesos', 'reflexion' => 'Reflexiones/Ideas', 'aspectos' => 'Aspectos Subjetivos', 'documentos' => 'Documentos Leídos', 'anecdotas' => 'Anecdotas y Otros')));
$button = elgg_view('input/submit', array('value' => elgg_echo('Agregar')));
?>

<div class="box">
    <h2 class="title-legend">Agregar Nota</h2>


    <div class="contenido-mensaje">
        <textarea name='nota' id='nota' placeholder="Escriba aqui su Nota" required="true" style='width: 700px;'></textarea>
    </div>

    <div>
        <?php echo $tipo_input; ?>
    </div>
    <div>
        <?php echo $diario_input . $etapa_input; ?>
    </div>
    <div class="contenedor-button">
        <input type="submit" value="Agregar" onclick="guardarNota(<?php echo $guid_diario ?>,'<?php echo $etapa ?>')" />
    </div>
</div>
<script>
    function guardarNota( diario, etapa) {
        var nota= $("#nota").val();
        var tipo=$('#tipo').val();
        elgg.get('ajax/view/nota/guardar_nota', {
            timeout: 30000,
            data: {
                guid: diario,
                etapa: etapa,
                nota: nota,
                tipo: tipo
            },
            success: function(result, success, xhr) {
                actualizarNotas();
            },
        });
    }

    function actualizarNotas() {
        $("#boton-3").click();
    }
</script>