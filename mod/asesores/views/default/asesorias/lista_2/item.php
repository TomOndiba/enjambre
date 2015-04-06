<?php
$asesoria = $vars['entity'];
$inv = $vars['id_inv'];
$conv = $vars['id_conv'];
$user = elgg_get_logged_in_user_guid();

$absolute_url = '<a class="" href="#" data-reveal-id="myModal3" onclick=\'getEditarActividad("' . $asesoria->guid . '")\'>Editar</a> ';

$url_el = elgg_get_site_url() . "action/asesorias/eliminar?id=" . $asesoria->guid;
$url_eliminar = elgg_add_action_tokens_to_url($url_el);

$investigacion = new ElggInvestigacion($asesoria->container_guid);


$sala = elgg_get_relationship($asesoria, "tiene_sala");
if ($asesoria->modo == "Online") {
    if (sizeof($sala) > 0) {

        $url = "webinar/view/" . $sala[0]->guid . "/" . $sala[0]->title;
        $sala_url = elgg_get_site_url() . $url;
        //$url_final="<a href='$sala_url'>Ir a Sala</a>";
        $titulo = "Ver Sala";
        $url_final = '<a class="" href="#" data-reveal-id="myModal2" onclick=\'getViewWebinar("' . $sala[0]->guid . '")\'>Ir a Sala</a> ';
    } else {
        $url = "webinar/add/$user/$inv/$asesoria->guid";
        $sala_url = elgg_get_site_url() . $url;
        //$url_final="<a href='$sala_url'>Crear Sala</a>";
        $titulo = "Agregar Sala";
        $url_final = '<a class="" href="#" data-reveal-id="myModal2" onclick=\'getAddWebinar("' . $user->guid . '","' . $investigacion->guid . '","' . $asesoria->guid . '")\'>Crear Sala</a> ';
    }
} else {
    $url_f = elgg_get_site_url()."asesores/asesorias/subir_evidencia/{$inv}/{$conv}/{$asesoria->guid}";
    $url_final = "<a href='{$url_f}'>Subir Evidencias</a>";
}
$resumen = "<p>".substr($asesoria->resumen, 0, 30)."...</p><br>"
        . "<p style='text-align:right'><a href='#' data-reveal-id='modalHistorial' onclick='verHistorial($asesoria->guid)'>Ver Historial</a></p>";
$cron .="<tr>";
$cron .="<td>$investigacion->name</td>";
$cron .="<td>$asesoria->tipo</td>";
$cron .="<td>$asesoria->modo</td>";
$cron .="<td>$asesoria->fecha</td>";
$cron .="<td>$asesoria->hora</td>";
$cron .="<td>$resumen</td>";
$cron .="<td>$absolute_url</td>";
$cron .='<td><a onclick="confirmar(\'' . $url_eliminar . '\')">Eliminar</a></td>';
$cron .="<td>$url_final </td>";
$cron .= "<td><a href='#' data-reveal-id='modalResumen' onclick='loadAsesoria({$asesoria->guid},\"{$asesoria->resumen}\")'>Resumen</a></td>";
$cron .="</tr>";
echo $cron;
?>
