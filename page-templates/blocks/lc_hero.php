<section class="hero">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-11 hero__title">
                <h1><?=get_field('title')?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-1 hero__line">
            </div>
            <div class="col-md-6 hero__intro">
                <?=get_field('intro')?>
            </div>
            <div class="col-md-5 text-center">
                <?=do_shortcode('[contact_button]')?>
            </div>
        </div>
    </div>
</section>