<section class="lp_hero pb-5">
    <?= wp_get_attachment_image(get_field('hero_bg'), 'full', false, array('class' => 'lp_hero__bg')) ?>
    <div class="container-lg w-100 h-100 d-flex align-items-center">
        <div class="w-md-50">
            <h1 class="lp_hero__title"><?= get_field('title') ?></h1>
        </div>
    </div>
</section>