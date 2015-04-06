<?php
$guid_inv = get_input("guid_inv");
$investigacion=new ElggInvestigacion($guid_inv);
$grupo=$investigacion->getEntitiesFromRelationship("tiene_la_investigacion", true);

//$grupo = elgg_get_relationship_inversa($investigacion, "tiene_la_investigacion")[0];
$vars = array('grupo' => $grupo[0]->guid, 'investigacion' => $guid_inv);
$bitacora4 = elgg_view('bitacoras/bitacora4/bitacora4', $vars);
$bitacora5=elgg_view('bitacoras/bitacora5/bitacora5', $vars);
$bitacora51= elgg_view('bitacoras/bitacora5_1/bitacora5_1', $vars);
$bitacora52= elgg_view('bitacoras/bitacora5_2/bitacora5_2', $vars);

$vars = array('grupo' => $grupo, 'investigacion' => $investigacion);
$bitacora6 = elgg_view('bitacoras/bitacora6/bitacora6', $vars);
$bitacora6_1 = elgg_view('bitacoras/bitacora6/bitacora6_1', $vars);
$bitacora6_2 = elgg_view('bitacoras/bitacora6/bitacora6_2', $vars);
?>
<div class="menu-bitacoras-etapa-2">
    <ul>
        <li id="bitacora-4" style="background-color: rgb(255, 204, 41);">Bitácora 4</li>
        <li id="bitacora-5">Bitácora 5</li>
        <li id="bitacora-51">Bitácora 5.1</li>
        <li id="bitacora-52">Bitácora 5.2</li>
        <li id="bitacora-6">Bitácora 6</li>
        <li id="bitacora-61">Bitácora 6.1</li>
        <li id="bitacora-62">Bitácora 6.2</li>
    </ul>
</div>
<div class="bitacoras-etapa-2">
    <div id="bitacora4" class="bitacora-etapa-2">
        <?php echo $bitacora4; ?>
    </div>
    <div id="bitacora5" class="bitacora-etapa-2">
        <?php echo $bitacora5; ?>
    </div>
    <div id="bitacora51" class="bitacora-etapa-2">
        <?php echo $bitacora51;?>
    </div>
    <div id="bitacora52" class="bitacora-etapa-2">
        <?php echo $bitacora52;?>
    </div>
    <div id="bitacora6" class="bitacora-etapa-2">
        <?php echo $bitacora6;?>
    </div>
    <div id="bitacora61" class="bitacora-etapa-2">
        <?php echo $bitacora6_1;?>
    </div>
    <div id="bitacora62" class="bitacora-etapa-2">
        <?php echo $bitacora6_2;?>
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