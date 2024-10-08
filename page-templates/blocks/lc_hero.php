<section class="hero">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-11 hero__title">
                <h1><?= get_field('title') ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-1 hero__line">
            </div>
            <div class="col-md-6 hero__intro mb-5 mb-md-0">
                <?= get_field('intro') ?>
            </div>
            <?php
            if (!is_page('contact-us')) {
            ?>
                <div class="col-md-5 text-center">
                    <?= do_shortcode('[contact_button]') ?>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>