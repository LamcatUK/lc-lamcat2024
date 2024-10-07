<?php
$rows = count(get_field('steps'));
if ($rows == 3) {
    $steps = 'stepcard--three';
} else {
    $steps = 'stepcard--four';
}

?>
<section class="stepcard py-5">
    <div class="container-xl">
        <div class="stepcard__container <?= $steps ?>">
            <?php
            $c = 1;
            while (have_rows('steps')) {
                the_row();
            ?>
                <div class="stepcard__card">
                    <div class="stepcard__inner">
                        <div class="stepcard__title"><?= get_sub_field('step_title') ?></div>
                        <div class="stepcard__content"><?= get_sub_field('step_content') ?></div>
                    </div>
                </div>
            <?php
                $c++;
            }
            ?>
        </div>
    </div>
</section>