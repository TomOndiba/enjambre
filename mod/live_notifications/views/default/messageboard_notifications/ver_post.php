<script>

//<![CDATA[
    $(document).ready(function() {
        $('textarea.txt-comment').autoResize({
// Al redimensionar
            onResize: function() {
                $(this).css({opacity: 0.8});
            },
// Llamar efecto despues de redimensionar:
            animateCallback: function() {
                $(this).css({opacity: 1});
                $(this).css({'background-color': '#A39565'});
            },
// Diración de la animación:
            animateDuration: 300,
// Limite en pixeles hasta los que se va a expandir
// pasado el límite genera el scroll tradicional, valor por defecto 1000px
            limit: 300,
// Espacio Extra al final del texto:
            extraSpace: 0
        });

// reseteamos el textarea
        
    });
//]]></script>
<?php
elgg_load_js('ver_mas');
elgg_load_js('autoresize');
elgg_load_js("ajax_comentarios");
$guid_annotation= $vars['annotation'];
$annotation= elgg_get_annotation_from_id($guid_annotation);
$aux=array('annotation'=>$annotation, 'nuevo'=>true, "notification"=>true);
echo elgg_view('messageboard/post',$aux);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

