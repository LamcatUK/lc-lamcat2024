<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;
get_header();
$img = get_the_post_thumbnail_url(get_the_ID(), 'full');
?>
<main id="main" class="blog">
    <?php
    $content = get_the_content();
    $blocks = parse_blocks($content);
    $sidebar = array();
    $after;
    ?>
    <section class="breadcrumbs container-xl">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs" class="my-2">', '</div>');
        }
        ?>
    </section>
    <div class="container-xl">
        <div class="row gx-5 gy-4">
            <div class="col-lg-8 order-2 order-lg-1">
                <img src="<?= $img ?>" alt="" class="blog__image">
                <div class="blog__content bg-white pt-4 mb-2">
                    <h1 class="blog__title"><?= get_the_title() ?></h1>
                    <div class="news_index__meta mb-2">
                        <div class="fs-300 fw-bold">
                            <?= get_the_date() ?>
                        </div>
                        <?php

                        $categories = get_the_category();

                        if ($categories) {
                            echo '<span>';
                            foreach ($categories as $category) {
                        ?>
                                <span
                                    class="news_index__category"><?= esc_html($category->name) ?></span>
                        <?php
                            }
                            echo '<span>';
                        }
                        ?>
                    </div>
                    <?php
                    $count = estimate_reading_time_in_minutes(get_the_content(), 200, true, true);
                    ?>
                    <div class="reading mb-4"><?= $count ?></div>
                    <?php

                    foreach ($blocks as $block) {
                        if ($block['blockName'] == 'core/heading') {
                            if (!array_key_exists('level', $block['attrs'])) {
                                $heading = strip_tags($block['innerHTML']);
                                $id = acf_slugify($heading);
                                echo '<a id="' . $id . '" class="anchor"></a>';
                                $sidebar[$heading] = $id;
                            }
                        }
                        echo render_block($block);
                    }

                    echo lc_post_nav();

                    ?>
                    <hr>
                </div>
            </div>
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="sidebar pb-2">
                    <div class="quick_links">
                        <div class="h6 d-lg-none headline mb-0 collapsed" data-bs-toggle="collapse" href="#links"
                            role="button">Quick
                            Links
                        </div>
                        <div class="h6 d-none d-lg-block headline">Quick Links</div>
                        <div class="collapse d-lg-block" id="links">
                            <ul class="pt-3 pt-lg-0 ps-0 ff-body">
                                <?php
                                foreach ($sidebar as $s => $l) {
                                ?>
                                    <li><a
                                            href="#<?= $l ?>"><?= $s ?></a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="text-center button button--inverse">
                        <a href="/contact-us/">Get in touch</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $cats = get_the_category();
    $ids = wp_list_pluck($cats, 'term_id');
    $r = new WP_Query(array(
        'category__in' => $ids,
        'posts_per_page' => 3,
        'post__not_in' => array(get_the_ID())
    ));
    if ($r->have_posts()) {
    ?>
        <section class="latest pb-5">
            <div class="container-xl">
                <h2 class="h3">Related Posts</h2>
                <div class="row">
                    <?php
                    while ($r->have_posts()) {
                        $r->the_post();
                        $categories = get_the_category();
                        if (! empty($categories)) {
                            $cat = $categories[0]->name;
                        }
                    ?>
                        <div class="col-md-4">
                            <a class="latest__card" href="<?= get_the_permalink($r->ID) ?>">
                                <?= get_the_post_thumbnail($r->ID, 'large', array('class' => 'latest__image')) ?>
                                <h3 class="latest__title"><?= get_the_title($r->ID) ?></h3>
                                <div class="latest__arrow"><?= $cat ?></div>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
    <?php
    }
    ?>
</main>
<?php
get_footer();
?>