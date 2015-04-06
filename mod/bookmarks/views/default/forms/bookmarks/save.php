<?php
/**
 * Edit / add a bookmark
 *
 * @package Bookmarks
 */
// once elgg_view stops throwing all sorts of junk into $vars, we can use extract()
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$address = elgg_extract('address', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_PUBLIC);
$container_guid = elgg_extract('container_guid', $vars);
$guid = elgg_extract('guid', $vars, null);
$shares = elgg_extract('shares', $vars, array());

if ($guid) {
    ?>
    <div class="form-nuevo-album">
        <h2 class="title-legend">Editar Marcador</h2>
        <?php
    } else {
        ?>
        <div class="form-nuevo-album">
            <h2 class="title-legend">Agregar Marcador</h2>
<?php } ?>

        <div>
            <label><?php echo elgg_echo('title'); ?></label>
<?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title, 'required' => 'true')); ?>
        </div>
        <div>
            <label><?php echo elgg_echo('bookmarks:address'); ?></label>
<?php echo elgg_view('input/text', array('name' => 'address', 'value' => $address, 'required' => 'true')); ?>
        </div>
        <div>
            <label><?php echo elgg_echo('description') . " (Opcional)"; ?></label>
<?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
        </div>

        <!--     
        <div>
                <label><?php //echo elgg_echo('tags');  ?></label>
<?php // echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags));  ?>
        </div>
        
           
        <div>
                <label><?php //echo elgg_echo('access');  ?></label><br />
<?php //echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id));  ?>
        </div>
        -->
        <div class="contenedor-button">
<?php
echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));

if ($guid) {
    echo elgg_view('input/hidden', array('name' => 'guid', 'value' => $guid));
}

echo elgg_view('input/submit', array('value' => elgg_echo("save")));
?>
        </div>
    </div>

    <script>

        $(document).ready(function() {
            $(".elgg-form-bookmarks-save").validate({/*sustituir "formulario" por el id de vuestro formulario*/
                rules: {
                    title: {/*id del campo que se aplica la regla*/
                        required: true,
                        
                    },
                    address: {/*id del campo que se aplica la regla*/
                        required: true,
                    },
                    
                },
                messages: {
                    title: {
                        required: "Es necesario el título para registrarlo",
                        
                    },
                   address: {/*id del campo que se aplica la regla*/
                        required: 'Es necesaria la url para registralo.',
                    },
                }
            });
        });
    </script>