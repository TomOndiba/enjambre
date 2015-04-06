<style>

    /* http://meyerweb.com/eric/tools/css/reset/ 
       v2.0 | 20110126
       License: none (public domain)
    */

    html, body, div, span, applet, object, iframe,
    h1, h2, h3, h4, h5, h6, p, blockquote, pre,
    a, abbr, acronym, address, big, cite, code,
    del, dfn, em, img, ins, kbd, q, s, samp,
    small, strike, strong, sub, sup, tt, var,
    b, u, i, center,
    dl, dt, dd, ol, ul, li,
    fieldset, form, label, legend,
    table, caption, tbody, tfoot, thead, tr, th, td,
    article, aside, canvas, details, embed, 
    figure, figcaption, footer, header, hgroup, 
    menu, nav, output, ruby, section, summary,
    time, mark, audio, video {
        margin: 0;
        padding: 0;
        border: 0;
        font-size: 100%;
        font: inherit;
        vertical-align: baseline;
    }
    /* HTML5 display-role reset for older browsers */
    article, aside, details, figcaption, figure, 
    footer, header, hgroup, menu, nav, section {
        display: block;
    }
    body {
        line-height: 1;

    }
    ol, ul {
        list-style: none;
    }
    blockquote, q {
        quotes: none;
    }
    blockquote:before, blockquote:after,
    q:before, q:after {
        content: '';
        content: none;
    }
    table {
        border-collapse: collapse;
        border-spacing: 0;
    }

    html{
        padding:0;
        margin: 0;
        width:100%;
        height:100%;
    }

    .login{
        font-family: 'Roboto', sans-serif;
        width: 500px;
        height: 500px;
        background-image: url('<?php echo elgg_get_site_url(); ?>mod/tema_comunidad_ondas/vendors/css/images/libreta.png');
        background-size: 500px;
        background-repeat: no-repeat;
        z-index: 102;
        position: absolute;
        top: 50%; /* Buscamos el centro horizontal (relativo) del navegador */
        left: 50%; /* Buscamos el centro vertical (relativo) del navegador */
        margin-top: -200px; /* Restamos la mitad de la altura del objeto con un margin-top */
        margin-left: -300px; /* Restamos la mitad de la anchura del objeto con un margin-left */
    }

    .form-login{
        margin-left: 100px;
        margin-right: 100px;
        padding-top: 80px;
    }

    input[type='text'], input[type='password']{
        width:90%;
        margin: 10px;
        padding-top:5px;
        padding-bottom: 5px;
        padding-left: 5px;
        border-radius: 10px;
        font-size: 14px;
    }

    label{
        width: 100%;
        font-weight: 700;
    }

    legend{
        font-weight: 400;
        font-size: 24px;
        border-bottom-color:rgb(24,150,191);
        color: rgb(24,150,191);
        border-bottom-style: solid;
        border-width: 1px;
        width:100%;
        margin-bottom: 15px;
        padding-bottom: 3px;
    }
</style>
<div class='login'>
    <div class="form-login">
        <?php
        echo elgg_view_form("login", array(), array());
        ?>
    </div>
</div>

