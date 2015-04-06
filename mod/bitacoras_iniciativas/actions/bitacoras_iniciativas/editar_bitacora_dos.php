<?php

$bitacora = new BitacoraDos(get_input('id_bitacora'));
$bitacora->sintesis = get_input('sintesis', '', false);
$bitacora->reflexion = get_input('reflexion', '', false);
$bitacora->discusion = get_input('discusion', '', false);
$bitacora->pregunta = get_input("pregunta", '', false);
for ($i = 0; $i < 6; $i++) {
    $pregunta = "p{$i}";
    $sintesis = "p{$i}s";
    $fuente = "p{$i}f";
    $val_p = get_input($pregunta, '', false);
    $val_s = get_input($sintesis, '', false);
    $val_f = get_input($fuente, '', false);
    if ($val_p) {
        $bitacora->$pregunta = $val_p;
    }
    if ($val_s) {
        $bitacora->$sintesis = $val_s;
    }if($val_f) {
        $bitacora->$fuente = $val_f;
    }
}
$bitacora->save();
forward(REFERER);
