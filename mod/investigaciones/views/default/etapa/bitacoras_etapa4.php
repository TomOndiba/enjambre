<?php
$guid_inv = get_input("guid_inv");
$investigacion = new ElggInvestigacion($guid_inv);
$grupo = $investigacion->getEntitiesFromRelationship("tiene_la_investigacion", true);

//$grupo = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion")[0];
$vars = array('grupo' => $grupo, 'investigacion' => $investigacion);
$bitacora8 = elgg_view('bitacoras/bitacora8/bitacora8', $vars);
$bitacora9 = elgg_view('bitacoras/bitacora9/bitacora9', $vars);
?>
<div class="menu-bitacoras-etapa-2">
    <ul>
        <li id="bitacora-4" style="background-color: rgb(255, 204, 41);">Bitácora 8</li>
        <li id="bitacora-5">Bitácora 9</li>

    </ul>
</div>
<div class="bitacoras-etapa-2">
    <div id="bitacora4" class="bitacora-etapa-2">
    <?php echo $bitacora8; ?>
    </div>
    <div id="bitacora5" class="bitacora-etapa-2">
        <?php echo $bitacora9; ?>
    </div>
   
</div>
<script type="text/javascript">
    tinymce.init({
        selector: "textarea",
        theme: "modern",
        language: "es_MX",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
        toolbar2: "print preview media | forecolor backcolor emoticons",
        image_advtab: true,
        templates: [
            {title: 'Test template 1', content: 'Test 1'},
            {title: 'Test template 2', content: 'Test 2'}
        ]
    });
</script>