<section class="latest pb-5">
    <div class="container-xl">
        <div class="row">
            <?php
            $q = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3
            ));
            while ($q->have_posts()) {
                $q->the_post();
                $categories = get_the_category();
                if (! empty($categories)) {
                    $cat = $categories[0]->name;
                }
            ?>
                <div class="col-md-4">
                    <a class="latest__card" href="<?= get_the_permalink($q->ID) ?>">
                        <?= get_the_post_thumbnail($q->ID, 'large', array('class' => 'latest__image')) ?>
                        <h3 class="latest__title"><?= get_the_title($q->ID) ?></h3>
                        <div class="latest__arrow"><?= $cat ?></div>
                    </a>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>