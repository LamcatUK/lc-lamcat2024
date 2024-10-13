<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

$page_for_posts = get_option('page_for_posts');

get_header();
$bg = get_the_post_thumbnail_url($page_for_posts, 'full') ?? null;
?>
<main id="main">
    <!-- <section class="breadcrumbs container-xl mb-4">
        <?php
        if (function_exists('yoast_breadcrumb')) {
            yoast_breadcrumb('<div id="breadcrumbs" class="my-2">', '</div>');
        }
        ?>
    </section> -->
    <section class="news_index pb-4">
        <div class="container-xl bg-white pb-4">
            <?= apply_filters('the_content', get_the_content(null, false, $page_for_posts)) ?>
            <div class="news_index__grid pt-5 mt-5">
                <?php
                $style = 'news_index__card--first';
                $length = 50;
                $c = 'news_index__meta--first';
                while (have_posts()) {
                    the_post();

                    $categories = get_the_category();
                ?>
                    <a href="<?= get_the_permalink() ?>"
                        class="news_index__card <?= $style ?>">
                        <div class="news_index__image">
                            <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'large') ?>"
                                alt="">
                        </div>
                        <div class="news_index__inner">
                            <h2><?= get_the_title() ?></h2>
                            <p><?= wp_trim_words(get_the_content(), $length) ?>
                            </p>
                            <div class="news_index__meta <?= $c ?>">
                                <div class="fs-300 fw-bold">
                                    <?= get_the_date() ?>
                                </div>
                                <div>
                                    <?php
                                    if ($categories) {
                                        foreach ($categories as $category) {
                                    ?>
                                            <span
                                                class="news_index__category"><?= esc_html($category->name) ?></span>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </a>
                    <?php
                    if ($c != '') {
                    ?>
                        <section class="cta my-5">
                            <a href="/contact-us/" class="container-xl has-blue-400-background-color text-white px-5 py-4 d-flex justify-content-between align-items-center column-gap-5 row-gap-4 flex-wrap">
                                <h2 class="my-0">Let's elevate your brand together</h2>
                                <div class="button button--inverse"><span>Contact Us Today</span></div>
                            </a>
                        </section>
                <?php
                    }
                    $style = '';
                    $c = '';
                    $length = 20;
                }
                ?>
            </div>
            <section class="cta my-5">
                <a href="/contact-us/" class="container-xl has-blue-400-background-color text-white px-5 py-4 d-flex justify-content-between align-items-center column-gap-5 row-gap-4 flex-wrap">
                    <h2 class="my-0">Let's elevate your brand together</h2>
                    <div class="button button--inverse"><span>Contact Us Today</span></div>
                </a>
            </section>
        </div>
    </section>
</main>
<?php

get_footer();
?>