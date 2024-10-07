<section class="list pb-5">
    <div class="container-xl">
        <?php
        $n = 1;
        while (have_rows('items')) {
            the_row();
        ?>
            <div class="list__item">
                <div class="list__number"><?= $n ?></div>
                <div class="list__title"><?= get_sub_field('title') ?></div>
                <div class="list__content"><?= get_sub_field('content') ?></div>
            </div>
        <?php
            $n++;
        }
        ?>
    </div>
</section>