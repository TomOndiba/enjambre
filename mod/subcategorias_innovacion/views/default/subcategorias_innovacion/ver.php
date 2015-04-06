<?php

/**
 * Vista que permite ver las subcategorías de innovación registradas en el sistema
 */

elgg_load_js('acciones_subcategoria');
$subcategoriasInn = $vars['lista_subcategorias'];
$contenido = "";
$url = elgg_get_site_url() . "subcategorias/crear";



if (!empty($subcategoriasInn)) {
    foreach ($subcategoriasInn as $sub) {
        $href_eliminar = $sub['href_elim'];
        $href_editar = $sub['href_edit'];
//        $contenido .= "<div class='elgg-image-block clearfix', id='paginable' class='lista-coordinacion'>"
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
//                . $sub['nombre']
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
        ."<h3>".$sub['nombre']."</h3>"
        ."<div class='menu-item-coordinacion'>"
        ."<ul>"
        . "<li> <a href='$href_editar' title='Editar'> Editar </a></li>"
//        . " <a onclick=elgg_confirmar_elim('" . $href_eliminar . "');  title='Eliminar'> Eliminar </a>"
        ."</div></div></div>";
        
    }
} else {
    $contenido = "No existen subcategorías de innovación registradas.";
}


 ?>
    <div class="content-coordinacion">
        <div class="titulo-coordinacion">
            <h2>Subcategorías de Innovación</h2>
        </div>
<?php
  echo "<div class='contenedor-button'>"
                . "<a href='$url' class=\"link-button\">Crear nueva</a> ";
        $header.="</div>";
        echo $header;

echo <<<HTML
<div style='display:none;' id="dialog-confirm-subcategoria" title="Confirmación">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>¿Está seguro que desea eliminar la subcategoría de innovación?</p>
</div>

        $contenido   
HTML


?>
    </div>
