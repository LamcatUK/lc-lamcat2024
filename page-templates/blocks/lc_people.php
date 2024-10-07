<section class="people">
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-md-6">
                <?= wp_get_attachment_image(get_field('dan_photo'), 'large', false, array('class' => 'mb-3')) ?>
                <div class="d-flex justify-content-between align-items-baseline flex-wrap">
                    <h3 class="h4">Dan Stockwell</h3>
                    <?php
                    if (get_field('dan_linkedin') ?? null) {
                    ?>
                        <a href="<?= get_field('dan_linkedin') ?>" target="_blank" class="link--linkedin"></a>
                    <?php
                    }
                    ?>
                </div>
                <p><?= get_field('dan_bio') ?></p>
            </div>
            <div class="col-md-6">
                <?= wp_get_attachment_image(get_field('diana_photo'), 'large', false, array('class' => 'mb-3')) ?>
                <div class="d-flex justify-content-between align-items-baseline flex-wrap">
                    <h3 class="h4">Diana Parker</h3>
                    <?php
                    if (get_field('diana_linkedin') ?? null) {
                    ?>
                        <a href="<?= get_field('diana_linkedin') ?>" target="_blank" class="link--linkedin"></a>
                    <?php
                    }
                    ?>
                </div>
                <p><?= get_field('diana_bio') ?></p>
            </div>
        </div>
    </div>
</section>