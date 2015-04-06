<div class="form-nuevo-album" style="margin-top: 30px; width: 92%; margin-left: 2%;margin-right: 2%;">

    <?php
    elgg_load_js('validate');

    if (empty($vars['entity']->guid)) {
        echo "<h2 class='title-legend'>Registrar Grupo de Investigacion</h2>";
    } else {
        echo "<h2 class='title-legend'>Editar Grupo de Investigacion</h2>";
    }
    ?>
    <?php
    $name = $membership = $vis = $entity = null;
    extract($vars, EXTR_IF_EXISTS);

    if (isset($vars['entity'])) {
        $entity = $vars['entity'];
        $owner_guid = $vars['entity']->owner_guid;
    } else {
        $entity = false;
    }
    ?>
    <style>
        .thumb{ 
            display: inline-block;
            margin:5px;
            background-color: ghostwhite;
        }

        .thumb>img{
            height: 105px;
            border:none;
        }
    </style>
    <div>
        <label><?php echo elgg_echo("groups:icon"); ?></label><br />
        <label class="lbl-button"> <span>Seleccione la imagen</span><?php echo elgg_view("input/file", array('name' => 'icon', 'id' => 'files', 'onchange' => 'nombre(this.value)')); ?>
        </label>
    </div>
    <output id="list"></output>
    <div>
        <label><?php echo elgg_echo("groups:name"); ?></label><br />
        <?php
        echo elgg_view("input/text", array(
            'name' => 'name',
            'value' => $entity->name
        ));
        ?>
    </div>
    <div>
        <label>Descripción</label><br />
        <textarea name='description' style='height:100px;' placeholder="Escriba una breve descripción sobre su grupo de Investigación"><?php if($entity->description!='')echo $entity->description;?></textarea>
    </div>

    <?php
    if ($entity && ($owner_guid == elgg_get_logged_in_user_guid() || elgg_is_admin_logged_in())) {
        $members = array();

        $options = array(
            'relationship' => 'administrador',
            'relationship_guid' => $vars['entity']->getGUID(),
            'inverse_relationship' => true,
            'type' => 'user',
            'limit' => 0,
        );

        $batch = new ElggBatch('elgg_get_entities_from_relationship', $options);
        foreach ($batch as $member) {
            $members[$member->guid] = "$member->name (@$member->username)";
        }
    }
    ?>
    <div class="elgg-foot">
        <?php
        if ($entity) {
            echo elgg_view('input/hidden', array(
                'name' => 'group_guid',
                'value' => $entity->getGUID(),
            ));
        }

        echo elgg_view('input/submit', array('value' => elgg_echo('save')));
        ?>
    </div>
</div>
<script>
    function handleFileSelect(evt) {
        var files = evt.target.files; // FileList object
        $("#list").html("");
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function(theFile) {
                return function(e) {
                    // Render thumbnail.

                    var span = document.createElement('span');
                    span.innerHTML = ['<div class="thumb"><img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/></div>'].join('');
                    document.getElementById('list').insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }

    document.getElementById('files').addEventListener('change', handleFileSelect, false);



    function nombre(fic) {
        fic = fic.split('\\');
        var nombre = fic[fic.length - 1];
        if (nombre == "") {
            nombre = "Seleccione aquí la imagen";
        }
        $(".lbl-button span").html(nombre);
    }




    $(document).ready(function() {
        $(".elgg-form-grupo-investigacion-register").validate({/*sustituir "formulario" por el id de vuestro formulario*/
            rules: {
                name: {/*id del campo que se aplica la regla*/
                    required: true,
                   
                },
                description: {/*id del campo que se aplica la regla*/
                    required: true,
                  
                },
            },
            messages: {
                name: {
                    required: "Es necesario el nombre del Grupo para registrarlo",
                   
                },
                description: {
                    required: "Este campo es obligatorio, Haga una breve Descripción del grupo",
                   
                }

            }
        });
    });

</script>       