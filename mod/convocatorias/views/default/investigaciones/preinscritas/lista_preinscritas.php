<?php
$entities = $vars['entities'];
$guid_linea = $vars['guid'];
$guid_conv = $vars['id_conv'];
$tabla_preinscritas = "<table class='tabla-coordinador'><thead><tr><th>Investigacion</th><th colspan='2'>Opciones</th></tr></thead><tbody>";
if (!$entities) {
    echo "<br><b>No existen Investigaciones</b>";
} else {
    foreach ($entities as $entity) {


        $url = "investigaciones/ver/{$entity->guid}";
        $params = array(
            'text' => elgg_view('output/longtext', array('value' => $entity->name)),
            'href' => $url,
            'is_trusted' => true,
        );
        $title_link = elgg_view('output/url', $params);

        $url1 = elgg_get_site_url() . "action/convocatorias/aprobar_investigaciones?id_inv=" . $entity->guid . "&id_conv=" . $guid_conv . "&id_linea=" . $guid_linea;
        $url_aprobar = elgg_add_action_tokens_to_url($url1);

        $tabla_preinscritas.="<tr>"
                . "<td>{$title_link}</td>"
                . "<td><a  data-reveal-id='myModal' >Cambiar Línea Temática</a>"
                . "&nbsp; &nbsp; &nbsp;  &nbsp;<a href='$url_aprobar'>Aceptar</a></td>"
                . "</tr>";

        $parametros = array('id_conv' => $guid_conv, 'id_linea' => $guid_linea, 'id_inv' => $entity->guid);
        $form = elgg_view_form('investigaciones/preinscritas/cambiar_linea', null, $parametros);
    }
    $tabla_preinscritas.="</tbody></table>";

    echo "<br>".$tabla_preinscritas;
}
?>
<div id="myModal" class="reveal-modal">
    <div class="close-reveal-modal"></div>
    <div class="form-asesor-evaluador" id="pop-up-form">
        <div class='titulo-pop-up'>
            <h2>Cambiar la Linea Tematica</h2>
        </div>
        <div class="content-pop-up" id='content-pop-up'>
            <?php echo $form;?>
        </div>
    </div>
</div>