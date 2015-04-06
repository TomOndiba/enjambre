<?php
/**
 * Vista que muestra el listado de las faqs
 * @author DIEGOX_CORTEX
 */
elgg_load_js('confirmacion');
$categoria = $vars['categoria'];

$body = "";

$url = elgg_get_site_url();


if (empty($categoria)) {
    $categorias = getCategoriesFaqs();
    if (!empty($categorias)) {
        $body .= "<h2 class='title-legend'>Listado de Categorias</h2><br>";
        $body .= "<table class = 'tabla-coordinador'>"
                . "<tr>"
                . "<th>Nombre Categoria</th>"
                . "</tr>";
        foreach ($categorias as $cat) {
            $body .= "<tr>"
                    . "<td><a href='{$url}faqs/list/{$cat}'>{$cat}</a></td>"
                    . "</tr>";
        }
        $body .= "</table>";
    } else {
        $body = "No existen categorias registradas aún..";
    }
} else {
    $faqs = getFaqsByCategory($categoria);

    if (!empty($faqs)) {
        $body .= "<h2 class='title-legend'>Listado de Preguntas Frecuentes</h2>"
                . "<h3>Categoria {$categoria}</h3><br><br> ";

        $body .= "<table class = 'tabla-coordinador'>";
        foreach ($faqs as $f) {
            //obtenfo archivos de las faqs si los hay
            $archivos = elgg_get_entities(array(
                        'type' => 'object',
                        'subtype' => 'file',
                        'owner_guid' => $f->guid,
                        ));
            
            if(sizeof($archivos) > 0){
                $url_descarga = "<a href='" . $url . "file/download/{$archivos[0]->guid}' download>Descargar</a>";
            }

            
            //asigno la url para el link eliminar faq
            $eliminar = elgg_get_site_url().'action/faqs/eliminar?id='.$f->guid;
            $url_eliminar = elgg_add_action_tokens_to_url($eliminar);
            

            //concatena el contenido del cuerpo de la tabla con las respuestas de las faqs
            $body .= "<tr>"
                    . "<th colspan='3'>FAQ</th>"
                    . "</tr>"
                    . "<tr>"
                    . "<th>Pregunta</th>"
                    . "<td>{$f->question}</td>"
                    . "<td><a href='{$url}faqs/add/{$f->guid}'>Editar</a></td>"
                    . "</tr>"
                    . "<tr>"
                    . "<th>Respuesta</th>"
                    . "<td>{$f->answer} {$url_descarga}</td>"
                    . '<td><a onclick="confirmar(\'' . $url_eliminar . '\')">Eliminar</a></td>'
                    . "</tr>";
        }
        $body .= "</table>";
    } else {
        $body = "No existen faqs registradas aún..";
    }
}
?>

<div class="content-coordinacion">
    <div class="titulo-coordinacion">
        <h2>Administración</h2>
    </div>
    <div class="menu-coordinacion">
<?php echo elgg_view("convocatorias/menu_admin", array()); ?>
    </div>

    <div class="contenido-coordinacion">

        <div class="titulo-coordinacion">
            <h2>FAQ's</h2>
        </div>

<?php echo $body; ?>




    </div>
</div>
<div style="display:none;" id="dialog-confirm" title="Confirmación"> ¿Está seguro que desea eliminar la pregunta?</div>
