<section class="fade_links">
    <?php
    while (have_rows('links')) {
        the_row();
        $l = get_sub_field('link');
    ?>
        <a href="<?= $l['url'] ?>" class="fade_links__card mb-4">
            <h2 class="fade_links__title"><?= $l['title'] ?></h2>
            <div class="fade_links__content"><?= get_sub_field('content') ?></div>
        </a>
    <?php
    }
    ?>
</section>
<script>
    document.querySelectorAll('.fade_links__card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            document.querySelectorAll('.fade_links__card').forEach(function(otherCard) {
                if (otherCard !== card) {
                    otherCard.classList.add('dimmed');
                }
            });
        });

        card.addEventListener('mouseleave', function() {
            document.querySelectorAll('.fade_links__card').forEach(function(otherCard) {
                otherCard.classList.remove('dimmed');
            });
        });
    });
</script>