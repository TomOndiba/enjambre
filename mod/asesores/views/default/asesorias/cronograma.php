<?php

elgg_load_library('asesores');
elgg_load_js('pagination/investigaciones');
elgg_load_js("reveal2");
elgg_load_css('reveal');

$offset = get_input('offset');
$ajax = get_input('ajax');
$limit = 10;

$inv = new ElggInvestigacion($vars['id_inv']);
$id_conv = $vars["id_conv"];

$txt = "<table class=\"vertical-table\">";
$txt .="<tr>";
$txt .="<td>nombre:</td>";
$txt .="<td>{$inv->name}</td>";
$txt .="</tr>";
$txt .="<tr>";
$txt .="<td>Categoria:</td>";
$txt .="<td>{$inv->categoria_inv}</td>";
$txt .="</tr>";
$txt .="<tr>";
$txt .="<td>Linea tematica:</td>";
$txt .="<td>{$inv->linea_tematica}</td>";
$txt .="</tr>";
$txt .="</table>";

$content = "";
$lista = "";

$url = elgg_get_site_url();
$investigacion= get_entity($vars['id_inv']);
$volver="<div class='titulo-coordinacion'><h2>Investigacion:  {$investigacion->name}</h2></div>";
$volver.= "<a href={$url}asesores/asesorias/asignadas/{$id_conv}>Volver a Investigaciones Asignadas</a>";
if (!$ajax) {
//    $reg = elgg_view('output/url', array(
//        'text' => 'Registrar actividad',
//        'href' => elgg_get_site_url() . "asesores/asesorias/registrar/{$vars['id_inv']}/{$vars['id_conv']}",
//        'is_trusted' => true,
//    ));
    echo $volver.'<br><br>';
    echo "<div class='contenedor-button'>"
            . '<a class="link-button" href="#" data-reveal-id="myModal" onclick=\'getRegistrarActividad("' . $vars['id_inv'] . '", "' . $vars['id_conv'] . '")  \'>Registrar Actividad</a> '
            . "</div>";
        
    echo "{$reg}<hr/>{$txt}<hr/>{$cron}";
 
    echo "<div id='paginable'>";
    echo elgg_get_asesorias($limit, 0, $vars['id_inv'], $id_conv);
    echo "</div>";
    
} else {
    $lista = elgg_get_asesorias($limit, $offset, $vars['id_inv'], $id_conv);
    echo $lista;
}
?>


<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
     <div class="form-asesor-evaluador" id="pop-up-form">
                    <div class='titulo-pop-up'>
                        <h2>Registrar Nueva Actividad</h2>
                    </div>
                    <div class="content-pop-up" id='content-pop-up'>
                        
                    </div>
                </div>
    </div>
</div>
<script>
    function getRegistrarActividad(guid, guid_conv){
        var owner=guid;
        var convocatoria=guid_conv;
        elgg.get('ajax/view/asesorias/registrar_actividad', {
            timeout: 30000,
            data: {
                guid_inv:owner,
                guid_conv:convocatoria
                
            },
            success: function(result, success, xhr) {
                $('#content-pop-up').html(result);
            },
        });
    }
</script>
