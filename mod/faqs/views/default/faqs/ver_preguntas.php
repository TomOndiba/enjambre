<?php
/**
 * Vista que muestra las preguntas de una categoria de FAQ's
 * @author DIEGOX_CORTEX
 */
$preguntas = getFaqsByCategory(get_input('categoria'));

if (sizeof($preguntas) > 0) {
    $body = "<ul class='lista-categorias-2'>";
    foreach ($preguntas as $pre) {
        //obtenfo archivos de las faqs si los hay
            $archivos = elgg_get_entities(array(
                        'type' => 'object',
                        'subtype' => 'file',
                        'owner_guid' => $pre->guid,
                        ));
            
            if(sizeof($archivos) > 0){
                $url_descarga = ". Puede descargarlo haciendo clic -> "."<a href='" . elgg_get_site_url() . "file/download/{$archivos[0]->guid}' download>aquí</a>";
            }

        $body .= "<li><label>{$pre->question}</label>"
                . "<p>{$pre->answer}{$url_descarga}.</p></li>";
          $cat=     $pre->category;
    }
    $body .= "</ul>";
} else {
    $body = "No hay preguntas registradas en esta categoria";
}
?>
<div class='item-info'>
    <div class='titulo-info'><?php echo $cat?></div>
    <?php echo $body; ?>
</div>
