<?php

$bitacora = new BitacoraTres(get_input('id_bitacora'));
$bitacora->campo1 = get_input('campo_uno', '', false);
$bitacora->campo2 = get_input('campo_dos', '', false);
$bitacora->campo3 = get_input('campo_tres', '', false);
$bitacora->save();
forward(REFERER);