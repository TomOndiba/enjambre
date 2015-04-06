<?php
/**
 * Elgg file upload/save form
 *
 * @package ElggFile
 */
// once elgg_view stops throwing all sorts of junk into $vars, we can use 
$title = elgg_extract('title', $vars, '');
$desc = elgg_extract('description', $vars, '');
$tags = elgg_extract('tags', $vars, '');
$access_id = elgg_extract('access_id', $vars, ACCESS_PUBLIC);
$container_guid = elgg_extract('container_guid', $vars);
$container = get_entity($container_guid);
$autoformacion = elgg_extract('autoformacion', $vars);

if (!$container_guid) {
    $container_guid = elgg_get_logged_in_user_guid();
}
$guid = elgg_extract('guid', $vars, null);

if ($guid) {
    $file_label = elgg_echo("file:replace");
    $submit_label = elgg_echo('save');
} else {
    $file_label = elgg_echo("file:file");
    $submit_label = elgg_echo('upload');
}
?>
<div class="form-nuevo-album">
    <h2 class="title-legend">Subir Archivo</h2>
    <div>
        <label>Seleccione el archivo</label>
        <label class="lbl-button">
            <span>Clic aquí para seleccionar el Archivo</span><?php echo elgg_view('input/file', array('name' => 'upload', 'onchange' => 'nombre(this.value)')); ?>
        </label>
    </div>
    <div>
        <label><?php echo elgg_echo('title'); ?></label>
        <?php echo elgg_view('input/text', array('name' => 'title', 'value' => $title,)); ?>
    </div>
    <div>
        <label><?php echo elgg_echo('description') . ' (Opcional)'; ?></label>
        <?php echo elgg_view('input/longtext', array('name' => 'description', 'value' => $desc)); ?>
    </div>


    <!--
    <div>
        <label><?php //echo elgg_echo('tags');   ?></label>
    <?php //echo elgg_view('input/tags', array('name' => 'tags', 'value' => $tags)); ?>
    </div>-->
    <?php
    if ($autoformacion == "true") {

        $option = array('Caja de Herramientas' => 'Caja de Herramientas', 'Lineamientos Pedagogicos' => 'Lineamientos Pedagogicos', 'Sistematizacion' => 'Sistematizacion', 'otros' => 'Otros');
        ?><div>
            <label><?php echo elgg_echo('Categoria del Archivo'); ?></label><br />
            <?php
            echo elgg_view('input/dropdown', array('name' => 'categoria', 'options' => $option));
        } else {
            echo elgg_view('input/hidden', array('name' => 'categoria', 'value' => 'ninguna'));
        }
        ?>
        <!--        <div>
                    <label><?php //echo elgg_echo('access');  ?></label><br />
        <?php //echo elgg_view('input/access', array('name' => 'access_id', 'value' => $access_id));  ?>
                </div>-->

        <?php
        echo elgg_view('input/hidden', array('name' => 'container_guid', 'value' => $container_guid));
        ?>

        <div class="contenedor-button">
            <?php
            echo elgg_view('input/submit', array('value' => $submit_label));
            ?>
        </div>
    </div>
</div>

<script>

    function nombre(fic) {
        fic = fic.split('\\');
        var nombre = fic[fic.length - 1];
        if (nombre == "") {
            nombre = "Seleccione aquí la imagen";
        }
        $(".lbl-button span").html(nombre);
    }



    $(document).ready(function() {

        $(".elgg-form-file-upload").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                upload: {/*id del campo que se aplica la regla*/
                    required: true,
                  
                },
                title: {/*id del campo que se aplica la regla*/
                    required: true,
                  
                },
            },
            messages: {
                upload: {
                    required: "Es necesario subir un archivo",
                    
                },
                title: {/*id del campo que se aplica la regla*/
                    required: 'Campo obligatorio',
                    
                },
            }
        });
    });
</script>