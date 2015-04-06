<?php
/**
 * Discussion topic add/edit form body
 * 
 */

$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$status = elgg_extract('status', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_PUBLIC);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);


if($guid){
?>
<div class="form-nuevo-album">
    <h2 class="title-legend">Editar Foro</h2>
<?php
}
else{
?>
 <div class="form-nuevo-album">
    <h2 class="title-legend">Crear Nuevo Foro</h2>
    
<?php }?>
<div>
    
	<label><?php echo elgg_echo('title'); ?></label><br />
	<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title, 'required'=>'true')); ?>
</div>
<div>
	<label><?php echo elgg_echo('groups:topicmessage'); ?></label>
	<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc, 'required'=>'true')); ?>
</div>
    
    
<!--    
<div>
	<label><?php //echo elgg_echo('tags'); ?></label>
	<?php //echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
</div>

<div>
    <label><?php //echo elgg_echo("groups:topicstatus"); ?></label><br />
	<?php
		/**echo elgg_view('input/dropdown', array(
			'name' => 'status',
			'value' => $status,
			'options_values' => array(
				'open' => elgg_echo('groups:topicopen'),
				'closed' => elgg_echo('groups:topicclosed'),
			),
		));*/
	?>
</div>
-->
<!--
<div>
	<label><?php //echo elgg_echo('access'); ?></label><br />
	<?php //echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id)); ?>
</div>
-->
<div class="contenedor-button">
<?php

echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
	echo elgg_view('input/hidden', array('name' => 'topic_guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));

?>
</div>
</div>
    
    <script>

        $(document).ready(function() {
            $(".elgg-form-discussion-save").validate({/*sustituir "formulario" por el id de vuestro formulario*/
                rules: {
                    title: {/*id del campo que se aplica la regla*/
                        required: true,
                       
                    },
                    description: {/*id del campo que se aplica la regla*/
                        required: true,
                    },
                    
                },
                messages: {
                    title: {
                        required: "Es necesario el título para registrarlo",
                        
                    },
                    description: {/*id del campo que se aplica la regla*/
                        required: 'Campo obligatorio',
                    },
                }
            });
        });
    </script>