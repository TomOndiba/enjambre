<!DOCTYPE html>
<html>
<?php
/**
 * Elgg pageshell
 * The standard HTML page shell that everything else fits into
 *
 * @package Elgg
 * @subpackage Core
 *
 * @uses $vars['title']       The page title
 * @uses $vars['body']        The main content of the page
 * @uses $vars['sysmessages'] A 2d array of various message registers, passed from system_messages()
 */
// backward compatability support for plugins that are not using the new approach
// of routing through admin. See reportedcontent plugin for a simple example.
// render content before head so that JavaScript and CSS can be loaded. See #4032
$topbar = elgg_view('page/elements/topbar', $vars);
$messages = elgg_view('page/elements/messages', array('object' => $vars['sysmessages']));
$header = elgg_view('page/elements/header', $vars);
$body = elgg_view('page/elements/body', $vars);
$footer = elgg_view('page/elements/footer', $vars);
$grupos = elgg_view("grupo_investigacion/ultimos_grupos", array());
$usuarios = elgg_view("usuarios/ultimos_usuarios", array());
// Set the content type
header("Content-type: text/html; charset=UTF-8");
$form_login = elgg_view("usuarios/login", array(), array());
$lang = get_current_language();
$site_url = elgg_get_site_url();
$img_url = $site_url . "imagenes/";
?>
    <head>
        <?php echo elgg_view('page/elements/head_inicio', $vars);
        ?>
    </head>
    <body>
        <style>
            .pagination-item{
                cursor: pointer;
            }
        </style>
        <div class="elgg-page-messages">                                                                                                                                     
            <?php //echo $messages; ?>
            <?php //cho $notices_html; ?>
        </div>
        <div class="todo">
            <div class="left-inicio">
                <div class="header-inicio">
                    <div class="banner-titulo">
                        <div class="logo"></div>
                        <div class="titulo"></div>
                    </div>
                    <div class="header-menu">
                        <nav>
                            <ul>
                                <li onclick="location.href = '<?php echo $site_url ?>'" class="fc-rojo">Inicio</li>
                                <li onclick="location.href = '<?php echo $site_url ?>revistas'" class="fc-verde">Periódicos</li>
                                <li onclick="location.href = '<?php echo $site_url ?>faqs/preguntas'" class="fc-azul">Preguntas Frecuentes</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos'" class="fc-azul">Contenidos Digitales</li>
                                <li onclick="location.href = '<?php echo $site_url ?>contenidos/tutoriales'" class="fc-azul">Tutoriales</li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="contenido">
                <div style="padding-top:40px; margin-left:50px">
                <h2 class="title-legend">Tutoriales</h2>
                <?php echo elgg_view('contenidos/tutoriales_2')?>
                </div>
                </div>
                <div style="background-color: white; width: 100%; height: 90px; text-align: center">
                    <ul class="icons-footer">
                        <li><img src="http://104.131.19.127/imagenes/logo_gob.png" /></li>
                        <li><img src="http://104.131.19.127/imagenes/logo_ufps.png"/></li>
                        <li><img src="http://104.131.19.127/imagenes/logo_cun.png"/></li>
                    </ul>                    
                </div>
            </div>
            <div class="right-inicio">
                <div class="search">

                </div>
                <div class="panel">
                    <div class="entrar" data-reveal-id="myModal">
                        
                    </div>
                    <div class="girl"></div>
                    <div class="box-item">
                        <div class="titulo-box-item bd-radius-white">
                            <h2>Grupos</h2>
                        </div>
                        <div class="contenido-box-item bd-radius-white">
                            <ul class="galeria-imagenes">
                                <?php echo $grupos; ?>                            
                            </ul>
                        </div>
                    </div>
                    <div class="box-item">
                        <div class="titulo-box-item bd-radius-white">
                            <h2>Investigadores</h2>
                        </div>
                        <div class="contenido-box-item bd-radius-white">
                            <ul class="galeria-imagenes">
                                <?php echo $usuarios; ?>               
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal" class="reveal-modal">
            <div class="login">
                <?php echo $form_login; ?>
            </div>
        </div>
        <footer>
        </footer>
        <script>
        (function($) {        
    $.fn.easyPaginate = function(options){
        var defaults = {                
            step: 4,
            delay: 100,
            numeric: true,
            nextprev: true,
            auto:false,
            loop:false,
            pause:4000,
            clickstop:true,
            controls: 'pagination',
            current: 'current',
            randomstart: false
        }; 
        
        var options = $.extend(defaults, options); 
        var step = options.step;
        var lower, upper;
        var children = $(this).children();
        var count = children.length;
        var obj, next, prev;        
        var pages = Math.floor(count/step);
        var page = (options.randomstart) ? Math.floor(Math.random()*pages)+1 : 1;
        var timeout;
        var clicked = false;
        
        function show(){
            clearTimeout(timeout);
            lower = ((page-1) * step);
            upper = lower+step;
            $(children).each(function(i){
                var child = $(this);
                child.hide();
                if(i>=lower && i<upper){ setTimeout(function(){ child.fadeIn('fast') }, ( i-( Math.floor(i/step) * step) )*options.delay ); }
                if(options.nextprev){
                    if(upper >= count) { next.fadeOut('fast'); } else { next.fadeIn('fast'); };
                    if(lower >= 1) { prev.fadeIn('fast'); } else { prev.fadeOut('fast'); };
                };
            }); 
            $('li','#'+ options.controls).removeClass(options.current);
            $('li[data-index="'+page+'"]','#'+ options.controls).addClass(options.current);
            
            if(options.auto){
                if(options.clickstop && clicked){}else{ timeout = setTimeout(auto,options.pause); };
            };
        };
        
        function auto(){
            if(options.loop) if(upper >= count){ page=0; show(); }
            if(upper < count){ page++; show(); }                
        };
        
        this.each(function(){ 
            
            obj = this;
            
            if(count>step){
                                
                if((count/step) > pages) pages++;
                
                var ol = $('<ol id="'+ options.controls +'"></ol>').insertAfter(obj);
                
                if(options.nextprev){
                    prev = $('<li class="prev">Previous</li>')
                        .hide()
                        .appendTo(ol)
                        .click(function(){
                            clicked = true;
                            page--;
                            show();
                        });
                };
                
                if(options.numeric){
                    for(var i=1;i<=pages;i++){
                    $('<li data-index="'+ i +'">'+ i +'</li>')
                        .appendTo(ol)
                        .click(function(){  
                            clicked = true;
                            page = $(this).attr('data-index');
                            show();
                        });                 
                    };              
                };
                
                if(options.nextprev){
                    next = $('<li class="next">Next</li>')
                        .hide()
                        .appendTo(ol)
                        .click(function(){
                            clicked = true;         
                            page++;
                            show();
                        });
                };
            
                show();
            };
        }); 
        
    };  

})(jQuery);</script>
    </body>

</html>
