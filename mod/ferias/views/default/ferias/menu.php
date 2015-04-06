<?php
$guid=$vars['guid'];

$url = elgg_get_site_url();
$url_eventos = $url . "eventos/listado/$guid";
$url_crear_eventos = $url."eventos/registro_evento/$guid";
$url_areas=$url."ferias/asociar/$guid";
$url_patro=$url."ferias/asociar_patro/$guid";
$url_investigaciones = $url . "ferias/investigaciones/$guid";


$tipo_feria= get_entity($guid)->tipo_feria;

    $url_ferias_mpales = "{$url}ferias/ver_municipales_disponibles/{$guid}";
    $href_ferias_mpales="<a href='$url_ferias_mpales'>Incluir Ferias Municipales</a>&nbsp;&nbsp;&nbsp;&nbsp;";



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
            <div><a >Áreas/Niveles</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_areas;?>">Asociar área/nivel</a>
                </li>
            </ul>
        </li>
          <li>
            <div><a >Patrocinadores</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_patro;?>">Asociar Patrocinadores</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a>Investigaciones</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_investigaciones;?>">Consultar Investigaciones</a>
                </li>
            </ul>
            
        </li>
        <li>
            <div><a>Evaluadores</a></div>
             <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url."evaluadores/convocar_feria/$guid";?>">Convocar Evaluadores</a>
                </li>
                <li>
                    <a href="<?php echo $url."ferias/evaluadores_feria/ver/$guid";?>">Listar Evaluadores</a>
                </li>
            </ul>
        </li>
        <?php if($tipo_feria=='Departamental'){ ?>
        <li>
         <div><a>Ferias Municipales</a></div>
             <ul class="nav-interno">
                <li>
                  <?php echo $href_ferias_mpales;?>
                </li>
             </ul>
        </li>
        <?php }?>
    </ul>
</nav>
