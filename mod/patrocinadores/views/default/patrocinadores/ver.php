<?php

/**
 * Vista que permite ver las lineas temáticas registradas en el sistemas
 * @author DIEGOX_CORTEX
 */

elgg_load_js('acciones_patrocinadores');
$lineasP = $vars['lista_patro'];
$contenido = "";

if (!empty($lineasP)) {
    foreach ($lineasP as $patro) {
        $href_eliminar = $patro['href_elim'];
        $href_editar = $patro['href_edit'];
        $site_url = elgg_get_site_url();
        $url = $site_url . "photos/thumbnail/{$patro['logo']}/small/";
//        $contenido .= "<div class='elgg-image-block clearfix', id='paginable'>"
//                . "<div class='elgg-image'>"
//                . "<a href=''>"
//                . "<img width='50' src='$url'>"
//                . "</a>"
//                . "</div>"
//                . "<div class='elgg-body'>"
//                . "<ul class='elgg-menu elgg-menu-entity elgg-menu-hz elgg-menu-entity-default'>"
//                . "<li class='elgg-menu-item-access'>"
//                . "<span title='El nivel de acceso' class='elgg-access elgg-access-private'>"
//                . ""
//                . "</span>"
//                . "</li>"
//                . "<li class='elgg-menu-item-edit'>"
//                . "<a href='$href_editar' title='Editar'>"
//                . "Editar"
//                . "</a>"
//                . "</li>"
//                . "<li class='elgg-menu-item-delete'>"
//                . "<a onclick=elgg_confirmar_elim('" . $href_eliminar . "'); href='#' title='Eliminar'>"
//                . "<span class='elgg-icon elgg-icon-delete '>"
//                . "</span>"
//                . "</a>"
//                . "</li>"
//                . "</ul>"
//                . "<h3>"
//                . "<a href='#'>"
//                . $patro['nombre']
//                . "</a>"
//                . "</h3><div class='elgg-subtext'>"
//                . "<a href='#'>"
//                . ""
//                . "</a> "
//                . "<acronym title=''>"
//                . ""
//                . "</acronym>  "
//                . "</div>"
//                . "</div>"
//                . "</div>";
        
        $contenido.= "<div id='paginable' class='lista-coordinacion'>"
         ."<div class='item-convocatoria'>"
        ."<h3>".$patro['nombre']."</h3>"
        ."<div class='menu-item-coordinacion'>"
        ."<ul>"
        . "<li> <a href='$href_editar' title='Editar'> Editar </a>"
        . " <a onclick=elgg_confirmar_elim('" . $href_eliminar . "');  title='Eliminar'> Eliminar </a></li>"
        ."</div></div></div>";   
        
    }
} else {
    $contenido = elgg_echo('patrocinadores:list:empty');
}

$url = elgg_get_site_url() . "patrocinadores/crear";
 ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Listado de Patrocinadores de  Feria</h2>
        </div>
<?php
 echo "<div class='contenedor-button'>"
                . "<a href='$url' class=\"link-button\">Crear nuevo</a> ";
        $header.="</div>";
echo $header;

echo <<<HTML
<div style='display:none;' id="dialog-confirmpatro" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el Patrocinador?</p>
</div>
<div class="elgg-image-block elgg-river-item clearfix"> 
    <div class="elgg-body">
        $contenido
    </div>
</div>

        
HTML


?>

    </div>