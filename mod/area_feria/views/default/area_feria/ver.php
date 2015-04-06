<?php

/**
 * Vista que permite ver las áreas de feria registradas en el sistemas
 * @author DIEGOX_CORTEX
 */

elgg_load_js('acciones_area');
$areasF = $vars['lista_areas'];
$contenido = "";



if (!empty($areasF)) {
    foreach ($areasF as $area) {
        $href_eliminar = $area['href_elim'];
        $href_editar = $area['href_edit'];
//        $contenido .= "<div class='elgg-image-block clearfix', id='paginable'>"
//                //. "<div class='elgg-image'>"
//                //. "<a href='#'>"
//                //. "<img src='#'>"
//                //. "</a>"
//                //. "</div>"
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
//                . $area['nombre']
//                . "</a>"
//                . "</h3><div class='elgg-subtext'>"
//                //. 'Tipo:'.$linea['tipo'].'    '.$linea['descripcion']
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
        ."<h3>".$area['nombre']."</h3>"
        ."<div class='menu-item-coordinacion'>"
        ."<ul>"
        . "<li> <a href='$href_editar' title='Editar'> Editar </a>"
        . " <a onclick=elgg_confirmar_elim('" . $href_eliminar . "');  title='Eliminar'> Eliminar </a></li>"
        ."</div></div></div>"; 
    }
} else {
    $contenido = "No existen áreas de feria registradas.";
}



$url = elgg_get_site_url() . "area/crear";
 ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Listado de Áreas de la Feria</h2>
        </div>
<?php
echo "<div class='contenedor-button'>"
                . "<a href='$url' class=\"link-button\">Crear nuevo</a> ";
        $header.="</div>";
echo $header;


echo <<<HTML
<div style='display:none;' id="dialog-confirm-area" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar el área de feria?</p>
</div>
<div class="elgg-image-block elgg-river-item clearfix">
    <div class="elgg-body">
        $contenido
    </div>
</div>

        
HTML


?>

