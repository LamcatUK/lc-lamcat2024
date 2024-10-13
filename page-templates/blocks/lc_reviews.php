<section class="reviews py-5">
    <div class="container-xl">
        <div class="row g-5">
            <?php
            $q = new WP_Query(array(
                'post_type' => 'review',
                'posts_per_page' => -1,
                'orderby' => 'rand'
            ));

            while ($q->have_posts()) {
                $q->the_post();
                $l = get_field('site_url');
            ?>
                <div class="col-md-6">
                    <div class="review">
                        <div class="review__content"><?= get_field('review', get_the_ID()) ?></div>

                        <div class="review__name">
                            <div class="review__reviewer"><?= get_field('reviewer', get_the_ID()) ?></div>
                            <?= get_field('reviewer_role', get_the_ID()) ?>, <?= get_the_title() ?>
                        </div>
                        <div class="review__footer">
                            <?php
                            if (isset($l)) {
                            ?>
                                <div class="review__link">
                                    <a
                                        href="<?= $l['url'] ?>"
                                        target="_blank"><?= $l['title'] ?></a>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="review__stars"><span class="icon-star"></span><span class="icon-star"></span><span
                                    class="icon-star"></span><span class="icon-star"></span><span class="icon-star"></span></div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<?php
echo '<script type="application/ld+json">';
?>
{
"@context": "http://schema.org/",
"@graph": [
<?php
$JSON = array();
while ($q->have_posts()) {
    $q->the_post();
    $title = get_the_title();
    $content = esc_attr(wp_strip_all_tags(get_the_content()));
    $JSON[] = <<<EOT
{
    "@type": "Review",
    "itemReviewed": {
        "@type": "Organization",
        "name": "Services"
    },
    "reviewRating": {
        "@type": "Rating",
        "ratingValue": "5",
        "bestRating": "5"
    },
    "name": "{$title}",
    "author": {
        "@type": "Person",
        "name": "{$title}"
    },
    "reviewBody": "{$content}"
}
EOT;
}
echo implode(',', $JSON);
?>
]
}
<?php
echo '</script>';
