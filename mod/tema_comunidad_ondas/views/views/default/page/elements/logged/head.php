<?php
/**
 * The standard HTML head
 *
 * @uses $vars['title'] The page title
 */
// Set title
if (empty($vars['title'])) {
    $title = elgg_get_config('sitename');
} else {
    $title = elgg_get_config('sitename') . ": " . $vars['title'];
}

global $autofeed;
if (isset($autofeed) && $autofeed == true) {
    $url = full_url();
    if (substr_count($url, '?')) {
        $url .= "&view=rss";
    } else {
        $url .= "?view=rss";
    }
    $url = elgg_format_url($url);
    $feedref = <<<END

	<link rel="alternate" type="application/rss+xml" title="RSS" href="{$url}" />

END;
} else {
    $feedref = "";
}

$js = elgg_get_loaded_js('head');
$css = elgg_get_loaded_css();
$version = get_version();
$release = get_version(true);
?>



<link rel="shortcut icon" href="/enjambre/favicon.ico" type="image/x-icon">
<link rel="icon" href="/enjambre/favicon.ico" type="image/x-icon">


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ElggRelease" content="<?php echo $release; ?>" />
<meta name="ElggVersion" content="<?php echo $version; ?>" />
<title><?php echo $title; ?></title>
<?php echo elgg_view('page/elements/shortcut_icon', $vars); ?>
<?php
$ie_url = elgg_get_simplecache_url('css', 'ie');
$ie7_url = elgg_get_simplecache_url('css', 'ie7');
$ie6_url = elgg_get_simplecache_url('css', 'ie6');
?>
<!--[if gt IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo $ie_url; ?>" />
<![endif]-->
<!--[if IE 7]>
        <link rel="stylesheet" type="text/css" href="<?php echo $ie7_url; ?>" />
<![endif]-->
<!--[if IE 6]>
        <link rel="stylesheet" type="text/css" href="<?php echo $ie6_url; ?>" />
<![endif]-->

<?php
foreach ($js as $script) {
    ?>

    <script  src="<?php echo $script; ?>"></script>
<?php }
?>
<?php foreach ($css as $style) { ?>
    <link rel="stylesheet" type="text/css" href="<?php echo $style; ?>"> 

    <?php
}
$url = elgg_get_site_url();
$script = "{$url}vendors/jquery/jquery-ui.js";
$script2 = "{$url}vendors/tooltip/qtip.js";
$script3 = "{$url}vendors/datepick/datepick.js";
?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<script type="text/javascript" src="<?php echo $script2; ?>"></script>
<script type="text/javascript" src="<?php echo $script3; ?>"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('[data-tooltip!=""]').qtip({// Grab all elements with a non-blank data-tooltip attr.
            style: "qtip-bootstrap",
            content: {
                attr: 'data-tooltip'
            },
            position: {
                target: 'mouse', // Track the mouse as the positioning target
                adjust: {x: 20, y: 20} // Offset it slightly from under the mouse
            }
        })
        // MAKE SURE YOUR SELECTOR MATCHES SOMETHING IN YOUR HTML!!!
        $('a.informacion-user').each(function() {
            $(this).qtip({
                content: {
                    text: function(event, api) {
                        $.ajax({
                            url: $(this).attr('tooltip-view') // Use href attribute as URL
                        })
                                .then(function(content) {
                                    // Set the tooltip content upon successful retrieval
                                    api.set('content.text', content);
                                }, function(xhr, status, error) {
                                    // Upon failure... set the tooltip content to error
                                    api.set('content.text', status + ': ' + error);
                                });

                        return 'Loading...'; // Set some initial text
                    }
                },
                position: {
                    viewport: $(window)
                },
                hide: {
                    fixed: true,
                    delay: 300
                },
                style: 'qtip-wiki'
            });
        });
        $('#notificaciones').each(function() {
            var con=$(this).attr('tooltip-view');
            $(this).qtip({
                content: {
                    text: function(event, api) {
                        $.ajax({
                            url: $(this).attr('tooltip-view') // Use href attribute as URL
                        })
                                .then(function(content) {
                                    // Set the tooltip content upon successful retrieval
                                    api.set('content.text', "<div id='actualizar-notificaciones'>"+content+"</div>");
                                }, function(xhr, status, error) {
                                    // Upon failure... set the tooltip content to error
                                    api.set('content.text', status + ': ' + error);
                                });

                        return 'Loading...'; // Set some initial text
                    }

                },
                position: {
                    at: 'bottom center', // Position my top left
                    my: 'top center',
                    adjust: {
                        y: 19,
                    }
                },
                hide: {
                    fixed: true,
                    delay: 300
                },
                events: {
                    show: function(event, api) {
                        $.ajax({
                            url: con // Use href attribute as URL
                        })
                                .then(function(content) {
                                    // Set the tooltip content upon successful retrieval
                                   $("#actualizar-notificaciones").html(content);
                                }, function(xhr, status, error) {
                                    // Upon failure... set the tooltip content to error
                                    api.set('content.text', status + ': ' + error);
                                });

                        return 'Loading...'; // Set some initial text
                    }
                },
                style: 'qtip-wiki'
            });
        });
    })
// <![CDATA[
<?php //echo elgg_view('js/initialize_elgg'); ?>
// ]]>
</script>
<style>/*
 * qTip2 - Pretty powerful tooltips - v2.2.0
 * http://qtip2.com
 *
 * Copyright (c) 2014 Craig Michael Thompson
 * Released under the MIT, GPL licenses
 * http://jquery.org/license
 *
 * Date: Sat Mar 15 2014 10:47 EDT-0400
 * Plugins: None
 * Styles: css3
 */
    .qtip{
        position: absolute;
        left: -28000px;
        top: -28000px;
        display: none;

        max-width: 280px;
        min-width: 50px;

        font-size: 10.5px;
        line-height: 12px;

        direction: ltr;

        box-shadow: none;
        padding: 0;
    }

    .qtip-content{
        position: relative;
        padding: 5px 9px;
        overflow: hidden;

        text-align: left;
        word-wrap: break-word;
    }

    .qtip-titlebar{
        position: relative;
        padding: 5px 35px 5px 10px;
        overflow: hidden;

        border-width: 0 0 1px;
        font-weight: bold;
    }

    .qtip-titlebar + .qtip-content{ border-top-width: 0 !important; }

    /* Default close button class */
    .qtip-close{
        position: absolute;
        right: -9px; top: -9px;

        cursor: pointer;
        outline: medium none;

        border-width: 1px;
        border-style: solid;
        border-color: transparent;
    }

    .qtip-titlebar .qtip-close{
        right: 4px; top: 50%;
        margin-top: -9px;
    }

    * html .qtip-titlebar .qtip-close{ top: 16px; } /* IE fix */

    .qtip-titlebar .ui-icon,
    .qtip-icon .ui-icon{
        display: block;
        text-indent: -1000em;
        direction: ltr;
    }

    .qtip-icon, .qtip-icon .ui-icon{
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        text-decoration: none;
    }

    .qtip-icon .ui-icon{
        width: 18px;
        height: 14px;

        line-height: 14px;
        text-align: center;
        text-indent: 0;
        font: normal bold 10px/13px Tahoma,sans-serif;

        color: inherit;
        background: transparent none no-repeat -100em -100em;
    }

    /* Applied to 'focused' tooltips e.g. most recently displayed/interacted with */
    .qtip-focus{}

    /* Applied on hover of tooltips i.e. added/removed on mouseenter/mouseleave respectively */
    .qtip-hover{}

    /* Default tooltip style */
    .qtip-default{
        border-width: 1px;
        border-style: solid;
        border-color: #F1D031;

        background-color: #FFFFA3;
        color: #555;
    }

    .qtip-default .qtip-titlebar{
        background-color: #FFEF93;
    }

    .qtip-default .qtip-icon{
        border-color: #CCC;
        background: #F1F1F1;
        color: #777;
    }

    .qtip-default .qtip-titlebar .qtip-close{
        border-color: #AAA;
        color: #111;
    }



    .qtip-shadow{
        -webkit-box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
        -moz-box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
        box-shadow: 1px 1px 3px 1px rgba(0, 0, 0, 0.15);
    }

    /* Add rounded corners to your tooltips in: FF3+, Chrome 2+, Opera 10.6+, IE9+, Safari 2+ */
    .qtip-rounded,
    .qtip-tipsy,
    .qtip-bootstrap{
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }

    .qtip-rounded .qtip-titlebar{
        -moz-border-radius: 4px 4px 0 0;
        -webkit-border-radius: 4px 4px 0 0;
        border-radius: 4px 4px 0 0;
    }

    /* Youtube tooltip style */
    .qtip-youtube{
        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;

        -webkit-box-shadow: 0 0 3px #333;
        -moz-box-shadow: 0 0 3px #333;
        box-shadow: 0 0 3px #333;

        color: white;
        border-width: 0;

        background: #4A4A4A;
        background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0,#4A4A4A),color-stop(100%,black));
        background-image: -webkit-linear-gradient(top,#4A4A4A 0,black 100%);
        background-image: -moz-linear-gradient(top,#4A4A4A 0,black 100%);
        background-image: -ms-linear-gradient(top,#4A4A4A 0,black 100%);
        background-image: -o-linear-gradient(top,#4A4A4A 0,black 100%);
    }

    .qtip-youtube .qtip-titlebar{
        background-color: #4A4A4A;
        background-color: rgba(0,0,0,0);
    }

    .qtip-youtube .qtip-content{
        padding: .75em;
        font: 12px arial,sans-serif;

        filter: progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#4a4a4a,EndColorStr=#000000);
        -ms-filter: "progid:DXImageTransform.Microsoft.Gradient(GradientType=0,StartColorStr=#4a4a4a,EndColorStr=#000000);";
    }

    .qtip-youtube .qtip-icon{
        border-color: #222;
    }

    .qtip-youtube .qtip-titlebar .ui-state-hover{
        border-color: #303030;
    }


    /* jQuery TOOLS Tooltip style */
    .qtip-jtools{
        background: #232323;
        background: rgba(0, 0, 0, 0.7);
        background-image: -webkit-gradient(linear, left top, left bottom, from(#717171), to(#232323));
        background-image: -moz-linear-gradient(top, #717171, #232323);
        background-image: -webkit-linear-gradient(top, #717171, #232323);
        background-image: -ms-linear-gradient(top, #717171, #232323);
        background-image: -o-linear-gradient(top, #717171, #232323);

        border: 2px solid #ddd;
        border: 2px solid rgba(241,241,241,1);

        -moz-border-radius: 2px;
        -webkit-border-radius: 2px;
        border-radius: 2px;

        -webkit-box-shadow: 0 0 12px #333;
        -moz-box-shadow: 0 0 12px #333;
        box-shadow: 0 0 12px #333;
    }

    /* IE Specific */
    .qtip-jtools .qtip-titlebar{
        background-color: transparent;
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#717171,endColorstr=#4A4A4A);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#717171,endColorstr=#4A4A4A)";
    }
    .qtip-jtools .qtip-content{
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#4A4A4A,endColorstr=#232323);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#4A4A4A,endColorstr=#232323)";
    }

    .qtip-jtools .qtip-titlebar,
    .qtip-jtools .qtip-content{
        background: transparent;
        color: white;
        border: 0 dashed transparent;
    }

    .qtip-jtools .qtip-icon{
        border-color: #555;
    }

    .qtip-jtools .qtip-titlebar .ui-state-hover{
        border-color: #333;
    }


    /* Cluetip style */
    .qtip-cluetip{
        -webkit-box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);
        -moz-box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);
        box-shadow: 4px 4px 5px rgba(0, 0, 0, 0.4);

        background-color: #D9D9C2;
        color: #111;
        border: 0 dashed transparent;
    }

    .qtip-cluetip .qtip-titlebar{
        background-color: #87876A;
        color: white;
        border: 0 dashed transparent;
    }

    .qtip-cluetip .qtip-icon{
        border-color: #808064;
    }

    .qtip-cluetip .qtip-titlebar .ui-state-hover{
        border-color: #696952;
        color: #696952;
    }


    /* Tipsy style */
    .qtip-tipsy{
        background: black;
        background: rgba(0, 0, 0, .87);

        color: white;
        border: 0 solid transparent;

        font-size: 11px;
        font-family: 'Lucida Grande', sans-serif;
        font-weight: bold;
        line-height: 16px;
        text-shadow: 0 1px black;
    }

    .qtip-tipsy .qtip-titlebar{
        padding: 6px 35px 0 10px;
        background-color: transparent;
    }

    .qtip-tipsy .qtip-content{
        padding: 6px 10px;
    }

    .qtip-tipsy .qtip-icon{
        border-color: #222;
        text-shadow: none;
    }

    .qtip-tipsy .qtip-titlebar .ui-state-hover{
        border-color: #303030;
    }


    /* Tipped style */
    .qtip-tipped{
        border: 3px solid #959FA9;

        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;

        background-color: #F9F9F9;
        color: #454545;

        font-weight: normal;
        font-family: serif;
    }

    .qtip-tipped .qtip-titlebar{
        border-bottom-width: 0;

        color: white;
        background: #3A79B8;
        background-image: -webkit-gradient(linear, left top, left bottom, from(#3A79B8), to(#2E629D));
        background-image: -webkit-linear-gradient(top, #3A79B8, #2E629D);
        background-image: -moz-linear-gradient(top, #3A79B8, #2E629D);
        background-image: -ms-linear-gradient(top, #3A79B8, #2E629D);
        background-image: -o-linear-gradient(top, #3A79B8, #2E629D);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr=#3A79B8,endColorstr=#2E629D);
        -ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr=#3A79B8,endColorstr=#2E629D)";
    }

    .qtip-tipped .qtip-icon{
        border: 2px solid #285589;
        background: #285589;
    }

    .qtip-tipped .qtip-icon .ui-icon{
        background-color: #FBFBFB;
        color: #555;
    }


    /**
     * Twitter Bootstrap style.
     *
     * Tested with IE 8, IE 9, Chrome 18, Firefox 9, Opera 11.
     * Does not work with IE 7.
     */
    .qtip-bootstrap{
        /** Taken from Bootstrap body */
        font-size: 14px;
        line-height: 20px;
        color: #333333;

        /** Taken from Bootstrap .popover */
        padding: 1px;
        background-color: #ffffff;
        border: 1px solid #ccc;
        border: 1px solid rgba(0, 0, 0, 0.2);
        -webkit-border-radius: 6px;
        -moz-border-radius: 6px;
        border-radius: 6px;
        -webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        -webkit-background-clip: padding-box;
        -moz-background-clip: padding;
        background-clip: padding-box;
    }

    .qtip-bootstrap .qtip-titlebar{
        /** Taken from Bootstrap .popover-title */
        padding: 8px 14px;
        margin: 0;
        font-size: 14px;
        font-weight: normal;
        line-height: 18px;
        background-color: #f7f7f7;
        border-bottom: 1px solid #ebebeb;
        -webkit-border-radius: 5px 5px 0 0;
        -moz-border-radius: 5px 5px 0 0;
        border-radius: 5px 5px 0 0;
    }

    .qtip-bootstrap .qtip-titlebar .qtip-close{
        /**
         * Overrides qTip2:
         * .qtip-titlebar .qtip-close{
         *   [...]
         *   right: 4px;
         *   top: 50%;
         *   [...]
         *   border-style: solid;
         * }
         */
        right: 11px;
        top: 45%;
        border-style: none;
    }

    .qtip-bootstrap .qtip-content{
        /** Taken from Bootstrap .popover-content */
        padding: 9px 14px;
    }

    .qtip-bootstrap .qtip-icon{
        /**
         * Overrides qTip2:
         * .qtip-default .qtip-icon {
         *   border-color: #CCC;
         *   background: #F1F1F1;
         *   color: #777;
         * }
         */
        background: transparent;
    }

    .qtip-bootstrap .qtip-icon .ui-icon{
        /**
         * Overrides qTip2:
         * .qtip-icon .ui-icon{
         *   width: 18px;
         *   height: 14px;
         * }
         */
        width: auto;
        height: auto;

        /* Taken from Bootstrap .close */
        float: right;
        font-size: 20px;
        font-weight: bold;
        line-height: 18px;
        color: #000000;
        text-shadow: 0 1px 0 #ffffff;
        opacity: 0.2;
        filter: alpha(opacity=20);
    }

    .qtip-bootstrap .qtip-icon .ui-icon:hover{
        /* Taken from Bootstrap .close:hover */
        color: #000000;
        text-decoration: none;
        cursor: pointer;
        opacity: 0.4;
        filter: alpha(opacity=40);
    }


    /* IE9 fix - removes all filters */
    .qtip:not(.ie9haxors) div.qtip-content,
    .qtip:not(.ie9haxors) div.qtip-titlebar{
        filter: none;
        -ms-filter: none;
    }




</style>
<?php
echo $feedref;

$metatags = elgg_view('metatags', $vars);
if ($metatags) {
    elgg_deprecated_notice("The metatags view has been deprecated. Extend page/elements/head instead", 1.8);
    echo $metatags;
}
?>
