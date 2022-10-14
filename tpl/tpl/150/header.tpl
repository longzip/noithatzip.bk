{$g_functions->display_extension_by_position('begin')}<!DOCTYPE html>

<html>

<head>

    {$g_functions->display_extension_by_position('after_open_head')}

    {$g_functions->hcv_head()}



    {$g_functions->cdn()}



    <link href="{$c_fontend_template_url}/css/font.css" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">

    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap&subset=vietnamese" rel="stylesheet">-->



    <link async rel="stylesheet" type="text/css" href="{$c_fontend_template_url}/css/css.css?v=2024" media="all"/>

    <link async rel="stylesheet" type="text/css" href="{$c_cdn_domain}/inc/css/cart.css?v=2024" media="all"/>





    <link async rel="stylesheet" type="text/css" href="{$c_fontend_template_url}/css/res.css?v=2024" media="all"/>

    <link async rel="stylesheet" type="text/css" href="{$c_fontend_template_url}/css/animate.css?v=2024" media="all"/>



    {$g_functions->display_carousel_cdn()}



    

    <script src="{$c_cdn_domain}/inc/js/cart.js?v=2024" async></script>

    <script src="{$c_fontend_template_url}/js/js.js?v=2024" async></script>

    <script src="{$c_fontend_template_url}/js/animate.js?v=2024" async></script>



    <script src="https://noithatzip.com/inc/js/lazysizes.min.js" async></script>

   



    {$g_functions->display_extension_by_position('before_close_head')}



        

    {if ($g_functions->checktype() == 'post')}

        

        <script>

            dataLayer = [];

            dataLayer.push({

            'ecomm_prodid': {$g_functions->format_string($post_info.masp)},

            'ecomm_pagetype': 'product',

            'ecomm_totalvalue': {$post_info.gia}

            });

        </script>

    

    {/if}

    <meta name="facebook-domain-verification" content="54holp7rwdc8lhsfkxf433a0ux666q" />

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-164115835-1"></script>

    <script>

    window.dataLayer = window.dataLayer || [];

    function gtag(){

        dataLayer.push(arguments);

          

    }

    gtag('js', new Date());

    

    gtag('config', 'UA-164115835-1');

    </script>

    

    <script>

        (function(w,d,s,l,i){

            w[l]=w[l]||[];

            w[l].push({

                'gtm.start':new Date().getTime(),event:'gtm.js'

            });

            var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';

            j.async=true;

            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;

            f.parentNode.insertBefore(j,f);

        })(window,document,'script','dataLayer','GTM-KFDGT86');

    </script>

    <meta name="google-site-verification" content="EOodLA17Va3ieeVakOifaJAi8S0bR21Tj0Ckd2lYmyI" />

    <meta name="facebook-domain-verification" content="54holp7rwdc8lhsfkxf433a0ux666q" />

    

</head>

<body class="v-tx-prl-5 v-xs-prl-5">

<noscript>

    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KFDGT86"height="0" width="0" style="display:none;visibility:hidden"></iframe>

</noscript>    

<!-- Google Tag Manager (noscript) -->

<!--<noscript> -->

<!--  <iframe src = "https://www.googletagmanager.com/ns.html?id=GTM-NJV2BHW" height = "0" width = "0" style = "display:none;visibility:hidden" ></iframe>-->

<!--</noscript>-->

<!--End Google Tag Manager(noscript) -->

{$g_functions->display_extension_by_position('after_open_body')}

{$g_functions->fb_sdk_js()}

{$g_functions->wp_footer()}



{include file="{$c_cdn_tpl_tpl_path}/inc/header/header-2.tpl"}

<!-- End header-wrap -->

