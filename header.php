<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta
        charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, minimum-scale=1">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/NeueHaasDisplayLight.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/NeueHaasDisplayMediu.woff2"
        as="font" type="font/woff" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/NeueHaasDisplayBold.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <link rel="preload"
        href="<?=get_stylesheet_directory_uri()?>/fonts/fa-sharp-light-300.woff2"
        as="font" type="font/woff2" crossorigin="anonymous">
    <?php
    if (!is_user_logged_in()) {
        if (get_field('ga_property', 'options')) {
            ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async
        src="https://www.googletagmanager.com/gtag/js?id=<?=get_field('ga_property', 'options')?>">
    </script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config',
            '<?=get_field('ga_property', 'options')?>'
        );
    </script>
            <?php
        }
        if (get_field('gtm_property', 'options')) {
            ?>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer',
            '<?=get_field('gtm_property', 'options')?>'
        );
    </script>
    <!-- End Google Tag Manager -->
            <?php
        }
    }
if (get_field('google_site_verification', 'options')) {
    echo '<meta name="google-site-verification" content="' . get_field('google_site_verification', 'options') . '" />';
}
if (get_field('bing_site_verification', 'options')) {
    echo '<meta name="msvalidate.01" content="' . get_field('bing_site_verification', 'options') . '" />';
}
?>
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?=get_stylesheet_directory_uri()?>/img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?=get_stylesheet_directory_uri()?>/img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?=get_stylesheet_directory_uri()?>/img/favicon/favicon-16x16.png">
    <link rel="manifest"
        href="<?=get_stylesheet_directory_uri()?>/img/favicon/site.webmanifest">
    <link rel="mask-icon"
        href="<?=get_stylesheet_directory_uri()?>/img/favicon/safari-pinned-tab.svg"
        color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <?php
wp_head();
if (is_front_page()) {
    ?>
    <meta property="article:publisher" content="https://www.facebook.com/LamcatConsulting/" />
    <meta property="fb:app_id" content="148910812398631" />
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "Lamcat Design & Consulting",
            "url": "https://www.lamcat.co.uk/",
            "logo": "https://www.lamcat.co.uk/wp-content/themes/lc-lamcat/lamcat-og-1200x630.png",
            "description": "Websites, graphic design and branding in West Sussex",
            "telephone": "+44 (0) 1403 582029",
            "email": "hello@lamcat.co.uk",
            "sameAs": [
                "https://twitter.com/LamcatDC",
                "https://www.facebook.com/LamcatConsulting/",
                "https://www.instagram.com/lamcat_dc/",
                "https://www.linkedin.com/company/18429840/"
            ]
        }
        }
    </script>
    <?php
}
?>
</head>

<body <?php body_class(); ?>
    <?php understrap_body_attributes(); ?>>
    <?php
do_action('wp_body_open');
?>
<header id="wrapper-navbar" class="fixed-top">
    <nav class="navbar navbar-expand-md" aria-labelledby="main-nav-label">
        <div id="main-nav-label" class="sr-only">Main Navigation</div>
        <div class="container-xl">
            <a class="navbar-brand" href="/" title="Lamcat Design &amp; Consulting" rel="homepage">
                <svg class="nav-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 355.28 355.28">
                    <title>Lamcat</title>
                    <circle cx="177.64" cy="177.64" r="177.64" fill="#498eb0"></circle>
                    <polygon
                        points="285.16 228.75 279.75 192.98 262.7 80.19 216.2 80.19 177.57 176.29 141.09 80.19 95.06 80.19 75.92 192.98 69.84 228.75 64.54 259.98 111.04 259.98 115.57 228.75 120.77 192.98 126.06 156.49 126.54 156.49 141.08 192.98 155.34 228.75 199.42 228.75 214.34 192.98 229.55 156.49 230.03 156.49 234.65 192.98 239.19 228.75 243.15 259.98 289.88 259.98 285.16 228.75"
                        fill="#fff"></polygon>
                    <g class="eyes">
                        <circle cx="155.34" cy="250.09" r="9.9" fill="#fff"></circle>
                        <circle cx="199.3" cy="250.09" r="9.9" fill="#fff"></circle>
                    </g>
                </svg>
            </a>
            <button class="navbar-toggler" id="navToggle" type="button" data-bs-toggle="collapse"
                data-bs-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false"
                aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <?php
            wp_nav_menu(
    array(
        'theme_location'  => 'primary_nav',
        'container_class' => 'w-100',
        'container_id'    => 'primaryNav',
        'menu_class'      => 'navbar-nav justify-content-end w-100',
        'fallback_cb'     => '',
        'menu_id'         => 'main-menu',
        'depth'           => 2,
        'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
    )
);
?>
        </div>
    </nav>
</header>