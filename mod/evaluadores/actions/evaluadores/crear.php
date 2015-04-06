<?php

$red = new ElggRedEvaluadores();
if ($red->save()) {
  
    system_message('guardado');
}
forward(REFERER);

