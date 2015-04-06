<?php
$etapa = get_input('etapa');
$guid_diario = get_input('diario');
$diario_input = elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid_diario));
$etapa_input = elgg_view('input/hidden', array('name' => 'etapa', 'value' => $etapa));
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
        <input type="submit" value="Agregar" onclick="guardarNota2(<?php echo $guid_diario ?>, '<?php echo $etapa ?>')" data-reveal-id="myModal"/>
    </div>
</div>
<script>
    function guardarNota2(diario, etapa) {
        var nota = $("#nota").val();
        elgg.get('ajax/view/nota/guardar_nota', {
            timeout: 30000,
            data: {
                guid: diario,
                etapa: etapa,
                nota: nota,
                tipo: tipo
            },
            success: function(result, success, xhr) {
                actualizarNotas2();
            },
        });
    }

    function actualizarNotas2() {
        $("#magazine").show();
        $("#pestana-cuaderno").show();
        $("#add-nota").hide();
        verCuaderno(0,<?php echo $guid_diario ?>);
        $(".botones").show();
    }
</script>