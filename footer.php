<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
?>
<div id="footer-top"></div>
<footer class="footer pt-5 pb-3">
    <div class="container-xl">
        <div class="row mb-4">
            <div class="col-sm-6 col-lg-3 order-lg-2">
                <?= wp_nav_menu(array('theme_location' => 'footer_menu1')) ?>
            </div>
            <div class="col-sm-6 col-lg-3 order-lg-3">
                <?= wp_nav_menu(array('theme_location' => 'footer_menu2')) ?>
            </div>
            <div class="col-sm-6 col-lg-3 order-lg-4">
                <ul class="footer__contact">
                    <li class="icon--email">
                        <a
                            href="mailto:<?= get_field('contact_email', 'options') ?>"><?= get_field('contact_email', 'options') ?></a>
                    </li>
                    <li class="icon--phone">
                        <a
                            href="tel:<?= parse_phone(get_field('contact_phone', 'options')) ?>"><?= get_field('contact_phone', 'options') ?></a>
                    </li>
                </ul>
                <div class="footer__socials fs-300">
                    <a href="https://www.facebook.com/" class="icon icon--facebook"></a>
                    <a href="https://www.linkedin.com/" class="icon icon--linkedin"></a>
                    <a href="https://www.instagram.com/" class="icon icon--instagram"></a>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 order-lg-1">
                <img src="<?= get_stylesheet_directory_uri() ?>/img/lamcat-logo--wo.svg"
                    alt="Lamcat Design & Consulting" class="footer__logo" width="829" height="247">
            </div>
        </div>
        <div class="colophon">
            <div class="row">
                <div class="col-md-6 text-center text-md-start">
                    &copy; <?= date('Y') ?> Lamcat Design &amp; Consulting
                </div>
                <div class="col-md-6 text-center text-md-end">
                    <a href="/privacy-policy/">Privacy</a> & <a href="/cookie-policy/">Cookie</a> Policy
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>