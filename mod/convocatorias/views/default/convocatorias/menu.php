<?php

$guid=$vars['guid'];
$url = elgg_get_site_url();
$url_eventos = $url . "eventos/listado/$guid";
$url_crear_eventos = $url."eventos/registro_evento/$guid";
#Deshabilitada por el momento
//$url_investigaciones = $url . "convocatorias/investigaciones/$guid";
$url_iniciativas = "{$url}convocatorias/especial/iniciativas/$guid";
$url_investigaciones = "{$url}convocatorias/especial/investigaciones/$guid";
$url_elegibles = $url . "convocatorias/banco_elegibles/$guid";
$url_lineas=$url."convocatorias/lineas/$guid";
?>
<nav>
    <ul>
        <li>
            <div><a >Eventos</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_eventos;?>">Ver Eventos</a>
                </li>
                <li>
                    <a href="<?php echo $url_crear_eventos;?>">Crear Evento</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a>Investigaciones</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_iniciativas;?>">Iniciativas Inscritas</a>
                </li>
                <li>                    
                    <a href="<?php echo $url_investigaciones;?>">Investigaciones Aceptadas</a>
                </li>
                <li>
                    <a href="<?php echo $url_elegibles;?>">Banco de Elegibles</a>
                </li>
            </ul>
            
        </li>
        <li>
            <div><a>Lineas Tematicas</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_lineas;?>">Asociar Lineas</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a>Asesores</a></div>
<!--             <ul class="nav-interno">
                <li>
                    <a href="<?php //echo $url."asesores/convocar/$guid";?>">Convocar Asesores</a>
                </li>
                <li>
                    <a href="<?php //echo $url."convocatorias/vinculacion/asesores/$guid";?>">Listar Asesores</a>
                </li>
            </ul>-->
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url."convocatorias/asesores/{$guid}/registro"?>">Registrar Asesor</a>
                </li>
                <li>
                    <a href="<?php echo $url."convocatorias/asesores/{$guid}"?>">Listado de Asesores</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a>Evaluadores</a></div>
             <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url."evaluadores/convocar/$guid";?>">Convocar Evaluadores</a>
                </li>
                <li>
                    <a href="<?php echo $url."convocatorias/vincular_evaluador/evaluadores/$guid";?>">Listar Evaluadores</a>
                </li>
               
            </ul>
        </li>
        <li>
            <div><a>Visitas realizadas</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url."visitas/listar/$guid";?>">Listar visitas</a>
                </li>
                <li>
                    <a href="<?php echo $url."visitas/registrar/$guid";?>">Registrar visita</a>
                </li>
            </ul>
        </li>
        
    </ul>
</nav>
