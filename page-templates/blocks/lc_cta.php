<?php
$class = $block['className'] ?? 'py-5';
$l = get_field('link');
?>
<section class="cta <?= $class ?>">
    <a href="<?= $l['url'] ?>" class="container-xl has-blue-400-background-color text-white px-5 py-4 d-flex justify-content-between align-items-center column-gap-5 row-gap-4 flex-wrap">
        <h2 class="mb-0"><?= get_field('content') ?></h2>
        <div class="button button--inverse"><span><?= $l['title'] ?></span></div>
    </a>
</section>