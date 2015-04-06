<?php
/**
 * Page icon
 *
 * Uses a separate icon view due to dependency on annotation
 *
 * @package ElggPages
 *
 * @uses $vars['entity']
 * @uses $vars['annotation']
 * <a href="<?php echo $annotation->getURL(); ?>">
 * </a>
 * 
 * 
 */

$annotation = $vars['annotation'];
$entity = get_entity($annotation->entity_guid);

// Get size
if (!in_array($vars['size'], array('small', 'medium', 'large', 'tiny', 'master', 'topbar'))) {
	$vars['size'] = "medium";
}

?>


	<img alt="<?php echo $entity->title; ?>" src="<?php echo $entity->getIconURL($vars['size']); ?>" />
