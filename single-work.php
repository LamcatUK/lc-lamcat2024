<?php
// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

the_post();
?>
<main class="work_item">
    <div class="container-xl">
        <div class="row pb-4" id="workTitle">
            <div class="col-md-7">
                <h1 class="mb-2"><?= get_the_title() ?></h1>
                <div class="text-muted">
                    <?php
                    $post_terms = get_the_terms($post->ID, 'work-type');
                    $pprefix = '';
                    $post_categories = '';
                    foreach ($post_terms as $term) {
                        $post_categories .= $pprefix . $term->name;
                        $pprefix = ', ';
                    }
                    echo $post_categories;
                    ?>
                </div>
            </div>
            <div class="col-md-5">
                <div class="h4">
                    <?= get_field('subtitle') ?>
                </div>
            </div>
        </div>
        <div class="hero">
            <?php
            if (get_field('hero_vimeo') != '') {
            ?>
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://player.vimeo.com/video/<?= get_field('hero_vimeo') ?>?muted=1&loop=1&autoplay=1&autopause=0&background=1&quality=1080p"
                        allowfullscreen data-ready="true"></iframe>
                </div>
            <?php
            } elseif (get_field('hero_image')) {
            ?>
                <img src="<?= wp_get_attachment_image_url(get_field('hero_image'), 'full') ?>"
                    class="img-fluid">
            <?php
            } else {
            ?>
                <img src="<?= get_the_post_thumbnail_url(get_the_ID(), 'full') ?>"
                    class="img-fluid">
            <?php
            }
            ?>
        </div>
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="sticky-top sticky-offset pt-5">
                    <?= get_the_content() ?>
                    <?php
                    if (get_field('site_url') ?? null) {
                    ?>
                        <br>
                        <a href="<?= get_field('site_url') ?>"
                            target="_blank" rel="noopener"
                            class="link--external"><?= get_the_title() ?></a>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-6 single_work pt-4">
                <?php
                if (get_field('pre_quote')) {
                ?>
                    <blockquote class="mb-4">
                        <?= get_field('pre_quote') ?>
                    </blockquote>
                    <?php
                }
                $images = get_field('gallery');
                if ($images) {
                    echo '<div class="gallery">';
                    foreach ($images as $image) {
                        $full = wp_get_attachment_image_url($image, 'full');
                        $thumb = wp_get_attachment_image_url($image, 'large');
                    ?>
                        <a href="<?= $full ?>" data-fancybox="gallery" class="work_item"><img
                                src="<?= $thumb ?>"></a>
                    <?php
                    }
                    echo '</div>';
                }
                if (get_field('post_quote')) {
                    ?>
                    <blockquote class="mt-4">
                        <?= get_field('post_quote') ?>
                    </blockquote>
                <?php
                }
                ?>
            </div>
        </div>
        <?php
        lc_work_nav();
        ?>
    </div>
</main>
<?= lc_short_work_nav() ?>
<?php
add_action('wp_footer', function () {
?>
    <script src=" https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />
    <script>
        Fancybox.bind("[data-fancybox]", {
            // Your custom options
        });

        document.addEventListener('DOMContentLoaded', function() {
            const workNavBar = document.getElementById('workNavBar');
            const workTitle = document.getElementById('workTitle');
            const workNav = document.getElementById('workNav');

            let workTitleVisible = true; // Initially, #workTitle is visible at the top
            let workNavVisible = false; // Initially, #workNav is not visible at the bottom

            // Function to update visibility of the #workNavBar based on both conditions
            function updateNavBarVisibility() {
                if (!workTitleVisible && !workNavVisible) {
                    workNavBar.classList.add('visible'); // Show bar
                } else {
                    workNavBar.classList.remove('visible'); // Hide bar
                }
            }

            // Observer for #workTitle (top of the page)
            const titleObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    workTitleVisible = entry.isIntersecting; // Track if #workTitle is in view
                    updateNavBarVisibility();
                });
            }, {
                root: null, // The viewport
                threshold: 0, // Trigger as soon as even 1px of #workTitle is in view
                rootMargin: '0px 0px 0px 0px' // No margins
            });

            // Observer for #workNav (bottom of the page)
            const navObserver = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    workNavVisible = entry.isIntersecting; // Track if #workNav is in view
                    updateNavBarVisibility();
                });
            }, {
                root: null, // The viewport
                threshold: 0, // Trigger as soon as even 1px of #workNav is in view
                rootMargin: '0px 0px 0px 0px' // No margins
            });

            // Start observing both #workTitle and #workNav
            titleObserver.observe(workTitle);
            navObserver.observe(workNav);
        });
    </script>
<?php
});

get_footer();
?>