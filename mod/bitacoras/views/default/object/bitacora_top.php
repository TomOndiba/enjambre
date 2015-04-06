<?php

/**
 * View for page object
 *
 * @package ElggPages
 *
 * @uses $vars['entity']    The page object
 * @uses $vars['full_view'] Whether to display the full view
 * @uses $vars['revision']  This parameter not supported by elgg_view_entity()
 */
elgg_load_js('menu_bitacora');
elgg_load_js("ajax_comentarios");
elgg_load_js('confirmacion');

$full = elgg_extract('full_view', $vars, FALSE);
$page = elgg_extract('entity', $vars, FALSE);
$revision = elgg_extract('revision', $vars, FALSE);
$user = elgg_get_logged_in_user_guid();


$site_url = elgg_get_site_url();

if (!$page) {
    return TRUE;
}

// pages used to use Public for write access
if ($page->write_access_id == ACCESS_PUBLIC) {
    // this works because this metadata is public
    $page->write_access_id = ACCESS_LOGGED_IN;
}


if ($revision) {
    $annotation = $revision;
} else {
    $annotation = $page->getAnnotations('bitacora', 1, 0, 'desc');
    if ($annotation) {
        $annotation = $annotation[0];
    }
}

$page_icon = elgg_view('bitacoras/icon', array('annotation' => $annotation, 'size' => 'small'));

$editor = get_entity($annotation->owner_guid);
$editor_link = elgg_view('output/url', array(
    'href' => "profile/$editor->username",
    'text' => $editor->name,
    'is_trusted' => true,
        ));

$date = elgg_view_friendly_time($annotation->time_created);
$editor_text = elgg_echo('pages:strapline', array($date, $editor_link));
$categories = elgg_view('output/categories', $vars);


//$comments_count = $page->countComments();
////only display if there are commments
//if ($comments_count != 0 && !$revision) {
//	$text = elgg_echo("comments") . " ($comments_count)";
//	$comments_link = elgg_view('output/url', array(
//		'href' => $page->getURL() . '#page-comments',
//		'text' => $text,
//		'is_trusted' => true,
//	));
//} else {
//	$comments_link = '';
//}
$subtitle = "Última actualización $date por $editor_link";

$params = array(
    'annotation_name' => 'generic_coments',
    'guid' => $page->guid,
);
$contenido = "<ul>";



$respuestas = elgg_get_annotations($params);
foreach ($respuestas as $respuesta) {
    echo $respuesta->value;
}



//// do not show the metadata and controls in widget view
if (!elgg_in_context('widgets')) {
    // If we're looking at a revision, display annotation menu
    if ($revision) {
        $metadata = elgg_view_menu('annotation', array(
            'annotation' => $annotation,
            'sort_by' => 'priority',
            'class' => 'elgg-menu-hz float-alt',
        ));
    } else {
        // Regular entity menu
//		$metadata = elgg_view_menu('entity', array(
//			'entity' => $vars['entity'],
//			'handler' => 'bitacoras',
//			'sort_by' => 'priority',
//			'class' => 'elgg-menu-hz',
//		));
    }
}



$investigacion = elgg_get_entities_from_relationship(array(
    'relationship' => 'tiene_la_bitacora',
    'relationship_guid' => $page->guid,
    'inverse_relationship' => true,
        ));



$bitacora = $page->description;

switch ($bitacora) {
    case 1:
        $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page->guid . '&bit=1&cuad=' . $investigacion[0]->guid;
        break;
    case 2:
        $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page->guid . '&bit=2&cuad=' . $investigacion[0]->guid;
        break;
    case 3:
        $url1 = elgg_get_site_url() . "action/bitacoras/print?id=" . $page->guid . '&bit=3&cuad=' .$investigacion[0]->guid;
        break;
}

$url_print = elgg_add_action_tokens_to_url($url1);


if ($full) {


    if (elgg_is_miembro_admin($investigacion[0]->guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $investigacion[0]->guid)) {

        if ($vars['grupo'] == 'true') {

            $header = '<a href="' . $site_url . 'bitacoras/edit/' . $page->guid . '" > Editar</a> &nbsp;';
            $header.='<a  href="' . $site_url . 'bitacoras/history/' . $page->guid . '"> Historial</a>';
            $header.='<a href="' . $url_print . '" ><span class="elgg-icon elgg-icon-print-alt "></span> Imprimir </a>';
        } else {
            $header = '<div><div class="row" onclick=\' editarBitacora("' . $page->guid . '")  \'> Editar</div> &nbsp; &nbsp;';
            $header.='<div class="row" onclick=\' verHistorial("' . $page->guid . '")  \'> Historial</div>';
            $header.='<div class="row"><a href="' . $url_print . '" ><span class="elgg-icon elgg-icon-print-alt "></span> Imprimir </a></div></div>';
        }
    }

    //si la bitacora se va a mostrar en el grupo se crea un href para Editar y Eliminar, sino es porque se va a mostrar
    //en una investigacion y se hace dentro de div
//	$body = elgg_view('output/longtext', array('value' => $annotation->value, 'municipio'=>$page->municipio));
//
//	$params = array(
//		'entity' => $page,
//		'metadata' => $metadata,
//		'subtitle' => $subtitle,
//	);
//	$params = $params + $vars;
//	$summary = elgg_view('object/elements/summary', $params);
//
//	echo elgg_view('object/elements/full', array(
//		'entity' => $page,
//		'title' => false,
//		'icon' => $page_icon,
//		'summary' => $summary,
//		'body' => $body,
//	));
    echo "<div class='box'>";
    echo "<div class='contenedor-button'>" . $header . "<br></div>"
    . "<div class='elgg-image-block clearfix'>"
    . "<div class='elgg-image'>{$page_icon} </div>"
    . "<div class='elgg-body'><div class='mbn'><h3>";
    echo $page->title . "<h3>";
    echo "<span class='elgg-subtext'>" . $subtitle . "<span></div></div></div>";

    echo elgg_view('output/longtext', array('value' => $annotation->value, 'municipio' => $page->municipio));
    echo $page->asesor_linea;
    echo "</div>";

    echo elgg_view('comentarios/comentarios', array('guid' => $page->guid));
} else {

    // brief view
//      $excerpt = elgg_get_excerpt($page->description);

    if (elgg_is_miembro_admin($investigacion[0]->guid, $user) && !check_entity_relationship($user, "usuario_desactivado_de", $investigacion[0]->guid)) {
        $header = '<a href="' . $site_url . 'grupo_investigacion/bitacoras/edit/' . $page->guid . '" > Editar</a>';
        $header.='<a  href="' . $site_url . 'grupo_investigacion/bitacoras/history/' . $page->guid . '"> Historial</a>';
        $header.='<a href="' . $url_print . '" ><span class="elgg-icon elgg-icon-print-alt "></span> Imprimir </a>';
    }
    echo $header;

    $params = array(
        'entity' => $page,
        'metadata' => $metadata,
        'subtitle' => $subtitle,
        'content' => $excerpt,
    );
    $params = $params + $vars;
    $list_body = elgg_view('object/elements/summary', $params);

    echo elgg_view_image_block($page_icon, $list_body);
}
