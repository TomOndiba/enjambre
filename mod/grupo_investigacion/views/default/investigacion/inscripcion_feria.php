<?php

elgg_load_js('acciones_investigacion');
$guid = get_input('id');
$guid_grupo = get_input('id_grupo');
$guid_investigacion = get_input('id_investigacion');

$feria = new ElggFeria($guid);
$descripcion = $feria->descripcion;
$objetivos = $feria->objetivos;
$fecha_inicio_feria = $feria->fecha_inicio_feria;
$fecha_fin_feria = $feria->fecha_fin_feria;

/**
 *  set_input("id_inv", $page[1]);
  set_input("id_group", $page[2]);
  set_input("id_feria", $page[3]);
 */
$y = elgg_view('input/hidden', array('name' => 'id_feria', 'class' => 'convocatoria', 'value' => $guid));
$x = elgg_view('input/hidden', array('name' => 'guid_grupo', 'class' => 'convocatoria', 'value' => $guid_grupo));
$z = elgg_view('input/hidden', array('name' => 'guid_investigacion', 'class' => 'convocatoria', 'value' => $guid_investigacion));
$url = elgg_get_site_url() . "investigaciones/ver/$guid_investigacion/grupo/$guid_grupo";
$url_feria = elgg_get_site_url() . "ferias/inscripcion/{$guid_investigacion}/{$guid_grupo}/{$guid}";

$url_inscribirse = '';
if (sizeof(elgg_get_relationship(get_entity($guid_investigacion), 'participa_en')) < 1) {
    if (!check_entity_relationship($guid_investigacion, 'inscrita_en', $guid)) {
        $url_inscribirse = "<a href='$url_feria' class='link-button'>Inscribirse a Feria</a>";
    } else {
        $investigacion = get_entity($guid_investigacion);
        $insc = elgg_get_relationship($investigacion, 'inscrita_en_' . $guid . '_con');
        $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $insc[0]->guid . '&bit=92';
        $url_print = elgg_add_action_tokens_to_url($url1);
        $url_inscribirse = "Ya esta inscrita.Imprima la inscripcion desde <a href='$url_print'>aqui</a>";
    }
}else{
    $url_inscribirse = "YA se ha participado en una feria municipal con esta investigación";
}

echo <<<HTML
<br>
<div>
    <table  class='vertical-table' >
        <tr><th>Descripción Feria:</th>
            <td>$descripcion</td></tr>
       <tr><th>Objetivos de la Feria:</th>
            <td>$objetivos</td></tr>
        <tr><th>Fecha de Inicio de la Feria:</th>
            <td>$fecha_inicio_feria</td></tr>
        <tr><th>Fecha de Finalización de la Feria:</th>
            <td>$fecha_fin_feria</td></tr>
    </table><br><br>
</div>  
<div>
   <br>$y $x $z
   </div>
<div class="contenedor-button">
    $url_inscribirse     
    
</div>
HTML;
?>
