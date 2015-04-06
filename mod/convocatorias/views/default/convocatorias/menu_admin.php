<?php
$guid=$vars['guid'];
$url = elgg_get_site_url();
$url_institucion_add = $url . "instituciones/registrar";
$url_institucion = $url . "convocatorias/administracion";
$url_grupo = $url."convocatorias/listar_grupos_inactivos";
$url_redes = $url . "convocatorias/listar_redes_inactivas";
$url_faqs_add= $url ."faqs/add";
$url_faqs= $url . "faqs/list";
$url_estudiante=$url."usuario/registro_estudiante";

?>
<nav>
    <ul>
        <li>
            <div><a>Estudiantes</a></div>
            <ul class="nav-interno">
                <li>
                   <a href="<?php echo $url_estudiante;?>">Registrar Estudiante</a>  
                </li>  
            </ul>
            <ul class="nav-interno">
                <li>
                   <a href="<?php echo $url_lista;?>">Listar Username Estudiante</a>  
                </li>  
            </ul>
        </li>
        <li>
            <div><a>Instituciones </a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_institucion_add;?>">Registrar Nueva</a>
                </li>
                <li>
                    <a href="<?php echo $url_institucion;?>">Listar Inactivas</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a >Grupos </a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_grupo;?>">Listar Inactivos</a>
                </li>
            </ul>
        </li>
        <li>
            <div><a>Redes </a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_redes;?>">Listar Inactivas</a>
                </li>
               
            </ul>
            
        </li>
        
         <li>
            <div><a>FAQ's</a></div>
            <ul class="nav-interno">
                <li>
                    <a href="<?php echo $url_faqs_add;?>">Registrar FAQ's</a>
                </li>
                <li>
                    <a href="<?php echo $url_faqs;?>">Listar Categorias</a>
                </li>
            </ul>
        </li>
       
       
        
    </ul>
</nav>
