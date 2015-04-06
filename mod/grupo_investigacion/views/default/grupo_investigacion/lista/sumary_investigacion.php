<?php

/**
 * Object summary
 *
 * Sample output
 * <ul class="elgg-menu elgg-menu-entity"><li>Public</li><li>Like this</li></ul>
 * <h3><a href="">Title</a></h3>
 * <p class="elgg-subtext">Posted 3 hours ago by George</p>
 * <p class="elgg-tags"><a href="">one</a>, <a href="">two</a></p>
 * <div class="elgg-content">Excerpt text</div>
 *
 * @uses $vars['entity']    ElggEntity
 * @uses $vars['title']     Title link (optional) false = no title, '' = default
 * @uses $vars['metadata']  HTML for entity menu and metadata (optional)
 * @uses $vars['subtitle']  HTML for the subtitle (optional)
 * @uses $vars['tags']      HTML for the tags (default is tags on entity, pass false for no tags)
 * @uses $vars['content']   HTML for the entity content (optional)
 */
$entity = $vars['entity'];
$grupo = new ElggGrupoInvestigacion($entity->guid);
$var = array('guid' => $grupo->guid,
    'owner_guid' => $grupo->owner_guid);
$title_link = elgg_extract('title', $vars, '');
if ($title_link === '') {
    if (isset($entity->title)) {
        $text = $entity->title;
    } else {
        $text = $entity->name;
    }
    $params = array(
        'text' => elgg_get_excerpt($text, 100),
        'href' => 'grupo_investigacion/ver/' . $entity->guid,
        'is_trusted' => true,
    );
    $title_link = elgg_view('output/url', $params);
}
$content = elgg_extract('content', $vars, '');
echo elgg_view("grupo_investigacion/lista/option", $var);

if ($title_link) {
    echo "<h3>$title_link</h3>";
}
$subtitle = " Numero de Miembros: " . $grupo->getMembers(null, null, true);
echo "<div class=\"elgg-subtext\">$subtitle</div>";



if ($content) {
    echo "<div class=\"elgg-content\">hola</div>";
}
