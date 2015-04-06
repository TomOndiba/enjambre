<?php
$guid_inv = get_input("guid_inv");
$cuaderno = new ElggInvestigacion($guid_inv);
$bitacorauno = $cuaderno->getBitacoraUno();
$bitacorados = $cuaderno->getBitacoraDos();
$bitacoratres = $cuaderno->getBitacoraTres();
if ($cuaderno->owner_guid == elgg_get_logged_in_user_guid()) {
    $bitacora1 = elgg_view("bitacoras/edit/bitacora_uno", 
            array('id_bitacora' => $bitacorauno->guid));
    $bitacora2 = elgg_view("bitacoras/edit/bitacora_dos", 
            array('id_bitacora' => $bitacorados->guid));
    $bitacora3 = elgg_view("bitacoras/edit/bitacora_tres", 
            array('id_bitacora' => $bitacoratres->guid));
} else {    
    $bitacora1 = elgg_view("bitacoras/show/bitacora_uno", 
            array('id_bitacora' => $bitacorauno->guid));
    $bitacora2 = elgg_view("bitacoras/show/bitacora_dos", 
            array('id_bitacora' => $bitacorados->guid));
    $bitacora3 = elgg_view("bitacoras/show/bitacora_tres", 
            array('id_bitacora' => $bitacoratres->guid));
}

?>
<div class="menu-bitacoras">
    <ul>
        <li id="bitacora-1" style="background-color: rgb(255, 204, 41);">Bitácora 1</li>
        <li id="bitacora-2">Bitácora 2</li>
        <li id="bitacora-3">Bitácora 3</li>
    </ul>
</div>
<div class="bitacoras">
    <div id="bitacora1" class="bitacora">
<?php echo $bitacora1; ?>
    </div>

    <div id="bitacora2" class="bitacora">
        <?php echo $bitacora2; ?>
    </div>

    <div id="bitacora3" class="bitacora">
        <?php echo $bitacora3; ?>
    </div>
</div>