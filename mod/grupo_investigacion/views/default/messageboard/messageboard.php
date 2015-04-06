<?php
$items=$vars['entities'];
$add_comment=$vars['new_post'];
foreach($items as $item){
    $aux=array('annotation'=>$item, 'nuevo'=>$add_comment);
    echo elgg_view('messageboard/post',$aux);
}