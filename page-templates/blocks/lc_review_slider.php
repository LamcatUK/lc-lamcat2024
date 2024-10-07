<section class="review_slider">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="swiper review_slider__slider">
                    <div class="swiper-wrapper">
                        <?php
                        foreach (get_field('reviews') as $r) {
                        ?>
                            <div class="swiper-slide">
                                <?php
                                if (get_field('case_study', $r)) {
                                    $link = get_the_permalink(get_field('case_study', $r));
                                    echo '<a href="' . $link . '" class="review__inner">';
                                } else {
                                    echo '<div class="review__inner">';
                                }
                                ?>
                                <?= get_the_post_thumbnail($r, 'large', array('class' => 'review__image')) ?>
                                <div class="review__content">
                                    <div class="review__review"><?= get_field('review', $r) ?></div>
                                    <div class="review__reviewer">
                                        <?= get_field('reviewer', $r) ?><br>
                                        <?= get_field('reviewer_role', $r) ?>, <?= get_the_title($r) ?>
                                    </div>
                                </div>
                                <?php
                                if (get_field('case_study', $r) ?? null) {
                                    echo '</a>';
                                } else {
                                    echo '</div>';
                                }
                                ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
add_action('wp_footer', function () {
?>
    <script>
        var swiper = new Swiper('.review_slider__slider', {
            effect: 'fade',
            fadeEffect: {
                crossFade: true,
            },
            slidesPerView: 1,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: true,
            },
            speed: 1000,
        });
    </script>
<?php
}, 9999);
