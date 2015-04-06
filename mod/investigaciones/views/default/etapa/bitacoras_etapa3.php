<?php
$guid_inv = get_input("guid_inv");
$investigacion = new ElggInvestigacion($guid_inv);
$grupo = $investigacion->getEntitiesFromRelationship("tiene_la_investigacion", true);

//$grupo = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion")[0];
$vars = array('grupo' => $grupo, 'investigacion' => $investigacion);
$bitacora7 = elgg_view('bitacoras/bitacora7/bitacora7', $vars);
$bitacora8 = elgg_view('bitacoras/bitacora8/bitacora8', $vars);
$bitacora9 = elgg_view('bitacoras/bitacora9/bitacora9', $vars);
?>
<div class="menu-bitacoras">
    <ul>
        <li id="bitacora-1" style="background-color: rgb(255, 204, 41);">Bitácora 7</li>
        <li id="bitacora-2">Bitácora 8</li>
        <li id="bitacora-3">Bitácora 9</li>
    </ul>
</div>
<div class="bitacoras">
    <div id="bitacora1" class="bitacora">
        <?php echo $bitacora7; ?>
    </div>
    <div id="bitacora2" class="bitacora">
        <?php echo $bitacora8; ?>
    </div>
    <div id="bitacora3" class="bitacora">
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