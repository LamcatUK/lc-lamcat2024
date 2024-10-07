<?php
$l1 = get_field('link_1');
$l2 = get_field('link_2');
$l3 = get_field('link_3');
?>
<section class="three_cards">
    <div class="container-xl">
        <div class="row g-4">
            <div class="col-md-4">
                <a class="three_cards__card" href="<?= $l1['url'] ?>">
                    <?= wp_get_attachment_image(get_field('icon_1'), 'full', false, array('class' => 'three_cards__icon')) ?>
                    <h2 class="three_cards__title"><?= get_field('title_1') ?></h2>
                    <div class="three_cards__content"><?= get_field('content_1') ?></div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="three_cards__card" href="<?= $l2['url'] ?>">
                    <?= wp_get_attachment_image(get_field('icon_2'), 'full', false, array('class' => 'three_cards__icon')) ?>
                    <h2 class="three_cards__title"><?= get_field('title_2') ?></h2>
                    <div class="three_cards__content"><?= get_field('content_2') ?></div>
                </a>
            </div>
            <div class="col-md-4">
                <a class="three_cards__card" href="<?= $l3['url'] ?>">
                    <?= wp_get_attachment_image(get_field('icon_3'), 'full', false, array('class' => 'three_cards__icon')) ?>
                    <h2 class="three_cards__title"><?= get_field('title_3') ?></h2>
                    <div class="three_cards__content"><?= get_field('content_3') ?></div>
                </a>
            </div>
        </div>
    </div>
</section>