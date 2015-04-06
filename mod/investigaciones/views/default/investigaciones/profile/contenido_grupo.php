<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="contet-grupo-investigacion">
    <?php
    set_input('guid_grupo', $vars['grupo']['guid']);
    echo elgg_view('grupo_investigacion/profile/info_grupo');
    ?>
</div>