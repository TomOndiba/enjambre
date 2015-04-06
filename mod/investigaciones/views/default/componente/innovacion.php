<?php
$investigacion = get_input('investigacion',$vars['investigacion']);
$categoria = get_input('categoria',$vars['categoria']);
$etapa = get_input('etapa',$vars['etapa']);
$nombre_input = elgg_view('input/text', array('name' => 'nombre', 'required' => 'true',));
$nombre2_input = elgg_view('input/text', array('name' => 'nombre', 'required' => 'true',));
$url_input = elgg_view('input/text', array('name' => 'url', 'required' => 'true',));
$icono_input = elgg_view('input/file', array('name' => 'images', 'id' => 'input-file'));
$file_input = elgg_view('input/file', array('name' => 'files', 'id' => 'input-file-2'));
$etapa_opcion_input = elgg_view('input/checkbox', array('name' => 'etapas_todas', 'align' => 'Vertical', 'value' => 'ON'));
$categoria_input = elgg_view('input/hidden', array('name' => 'categoria', 'value' => $categoria));
$etapa_input = elgg_view('input/hidden', array('name' => 'etapa', 'value' => $etapa));
$investigacion_input = elgg_view('input/hidden', array('name' => 'investigacion', 'value' => $investigacion));
$etapa_input.=$investigacion_input;
$url = elgg_get_site_url() . 'action/componente/agregar_componente';
$url2 = elgg_add_action_tokens_to_url($url);
$url = elgg_get_site_url() . 'action/componente/agregar_archivo';
$url_arc = elgg_add_action_tokens_to_url($url);
$button = elgg_view('input/submit', array('value' => elgg_echo('Agregar')));
?>

<div class="titulo-componente bg-color-7">
    <div class="gancho" style="float:left;margin-left: 20%;">

    </div>
    <div class="gancho" style=" float:right;margin-right: 20%;">

    </div>
    <h2>Innovación</h2>
</div>
<div class="overflow-2">
    <div class="menu-componente">
        <div onclick="mostrarForm('form-crear-componente')" class="add-componente"><br><br><br><br><br>AGREGAR COMPONENTE</div>
        <div onclick="mostrarForm('form-crear-archivo')" class="subir-componente"><br><br><br><br><br>SUBIR ARCHIVO</div>
    </div>
    <div class="no-display" id="form-crear-componente">
        <form action="javascript: mandarForm(this,'<?php echo $url2; ?>', '<?php echo $categoria?>','<?php echo $etapa?>','<?php echo $investigacion?>')" class='formulario'>
            <h2 class="title-legend">Agregar Nuevo Componente</h2>
            <div class="div-2datos">

                <label>Nombre:</label><?php echo $nombre_input; ?>


                <label>Url:</label><?php echo $url_input; ?>

            </div>
            <div class="div-2datos">

                <label>Icono:</label><br><?php echo $icono_input; ?>

                <br>
                <label>Desea que aparezca en todas las etapas:</label><?php echo $etapa_opcion_input; ?>

            </div>   
            <div>
                <?php echo $categoria_input . $etapa_input; ?>
            </div>
            <div class="contenedor-button">
                <?php echo $button ?>
            </div>
        </form>
    </div>
    <div class="no-display" id="form-crear-archivo">
        <form action="javascript: mandarFormArchivo(this,'<?php echo $url_arc; ?>', '<?php echo $categoria?>','<?php echo $etapa?>','<?php echo $investigacion?>')" class='formulario-archivo'>
            <h2 class="title-legend">Agregar Nuevo Archivo</h2>
            <div class="div-2datos">

                <label>Nombre:</label><?php echo $nombre2_input; ?>

            </div>
            <div class="div-2datos">
                <label>Archivo:</label> <?php echo $file_input; ?>
            </div>
            <br>
            <div>
                <label>Desea que aparezca en todas las etapas:</label><?php echo $etapa_opcion_input; ?>
            </div>

            <div>
                <?php echo $categoria_input . $etapa_input; ?>
            </div>
            <div class="contenedor-button">
                <?php echo $button ?>
            </div>
        </form>
    </div>


    <?php
    $componentes = elgg_get_componentes($etapa, $categoria, $investigacion);
    $vars = array("componentes" => $componentes);
    echo elgg_view("componente/listarComponentes", $vars);
    ?>
</div>