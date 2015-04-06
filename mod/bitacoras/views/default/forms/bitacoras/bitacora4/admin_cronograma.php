<?php
/**
 * vista donde se administraran las actividades del cronograma
 * @author DIEGOX_CORTEX
 */
elgg_load_js('imprimir');
elgg_load_js("vista_modal");
elgg_load_js("reveal2");
elgg_load_css('reveal');

$investigacion = $vars['id_inv'];
$group = $vars['id_group'];
$bit = $vars['bit'];
$actividades = $vars['actividades'];

$tabla_actividades = '';
if (sizeof($actividades) > 0) {
    $tabla_actividades .= "<table class='tabla-integrantes'>"
            . "<tr>"
            . "<th>Nombre</th>"
            . "<th>Desde</th>"
            . "<th>Hasta</th>"
            . "<th>responsable</th>"
            . "<th></th>"
            . "<th></th>"
            . "</tr>";

    foreach ($actividades as $actividad) {
        $url_edit = "<a onclick='cargarEditarActividad({$bit}, {$investigacion}, {$group}, {$actividad['guid']})' id='boton-editar-actividad-bit4' class='elgg-button button-publicar'>Editar</a>";
        //$url_edit = '<a class="elgg-button button-publicar" href="#" data-reveal-id="myModalBit4" onclick=\' getCrearActividad("' . $bit . ',' . $investigacion . ',' . $group . ',' . $actividad['guid'] . '")  \'>Editar</a>';
        $href = elgg_get_site_url() . "action/bitacoras/bitacora4/delete_actividad?act=" . $actividad['guid'];
        $href_eliminar = elgg_add_action_tokens_to_url($href);
        $url_eliminar = "<a onclick=elgg_confirmar_elim_ACT('" . $href_eliminar . "');  class='elgg-button button-publicar' title='Eliminar'> Eliminar </a>";
        $tabla_actividades .= "<tr>"
                . "<td>{$actividad['nombre']}</td>"
                . "<td>{$actividad['desde']}</td>"
                . "<td>{$actividad['hasta']}</td>"
                . "<td>{$actividad['responsable']}</td>"
                . "<td>$url_edit</a></td>"
                . "<td>$url_eliminar</td>"
                . "</tr>";
    }
    $tabla_actividades .= "</table>";
} else {
    $tabla_actividades = "No hay actividades registradas en el cronograma.";
}

?>

<div class="form-nuevo-album">
    
    <div style='display:none;' id="dialog-confirm-act" title="Confirmación">
        <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar la actividad?</p>
    </div>

    <h2 class="title-legend">Administrar Cronograma de Actividades</h2>
      
    <br><br><br><br>
    <div>
        <?php echo $tabla_actividades ?>
    </div>
    <br><br><br><br>   

</div>

