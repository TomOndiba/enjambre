<?php

/*
 * Vista para listar visitas en un cuadro
 */
elgg_load_js('js.listar.visitas');
$lista = elgg_get_visitas_from_user();
$sitio=  elgg_get_site_url();

$txt="<ul class=''>";
foreach ($lista as $v) {
    $txt.="<li id='elgg-object-observaciones-" . $v['id'] . "' class=''>" .
    "<div class='elgg-image-block clearfix item-lista-visitas'>"
        ."<div class='elgg-body'>";
            $txt.="<div class=' elgg-image'><img src='{$v['institucion-icon']}'/></div>";
            $txt.="<div class='elgg-body' ><h3><a href='{$v['institucionURL']}'>" . $v['institucion'] . "</a></h3>";
                $txt.="<div class='elgg-subtext'>";
                $txt.="".$v['municipio'].",".$v['departamento'];
                $txt.="</div></div>";
                
                $txt.="<div class='elgg-subtext'>";
                $txt.="<div class='contenedor-button'><a class='mostrar right link-button' id='mostrar_".$v['id']."' onclick='ver_detalles(".$v['id'].")'>Ver Información</a>";
                $txt.="<a class='ocultar right link-button' id='ocultar_".$v['id']."' onclick='ocultar_detalles(".$v['id'].")'>Ocultar</a></div>";
                $txt.="</div>";
                $txt.="<div class='detalles-visitas' id='observaciones_".$v['id']."'>";
                
                $txt.="<br>DETALLES";
                $txt.='<table class="vertical-table">';
                $txt.='<tr>';
                $txt.="<td>Fecha de la visista</td><td>".$v['fecha_visita']."</td></tr>";
                $txt.="<tr><td >Tipo de visita:</td><td>".$v['tipo_comunicacion']."</td>";
                $txt.='</tr>';
                $txt.='<tr>';
                $txt.="<td >Esta interesado:</td><td >".$v['interesado']."</td>";
                $txt.='</tr>';
                $txt.='<tr>';
                $txt.='<td>Observaciones:</td> <td> '.$v['observaciones'].'</td>';
                $txt.='</tr>';
                $txt.='</table>';
                
                $txt.="<a class='link-button' href='{$sitio}visitas/editar/{$v['id']}'>Editar</a>";
                $delete = "{$sitio}action/visitas/delete?id_v={$v['id']}";
                $url_delete = elgg_add_action_tokens_to_url($delete);
                $txt.="<a class='link-button' href='{$url_delete}'>Eliminar</a>";
                
                
                $txt.="</div>";
        $txt.="</div>"
    ."</div>";
}
$txt.="</ul>";

echo $txt;

