<section class="work_slider">
	<div class="container-xl">
		<div class="swiper work_slider__slider">
			<div class="swiper-wrapper">
				<?php
				foreach (get_field('work') as $w) {
				?>
					<a href="<?= get_the_permalink($w) ?>" class="work_slider__card swiper-slide">
						<?= get_the_post_thumbnail($w, 'large', array('class' => 'work_slider__image')) ?>
						<h3 class="work_slider__title"><?= get_the_title($w) ?></h3>
						<div class="work_slider__ul"><?= get_field('short_subtitle', $w) ?></div>
					</a>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</section>
<?php
add_action('wp_footer', function () {
?>
	<script>
		var swiper = new Swiper('.work_slider__slider', {
			slidesPerView: 1, // default view for xs (extra small)
			spaceBetween: 10, // space between slides
			breakpoints: {
				576: { // sm breakpoint (Bootstrap: ≥576px)
					slidesPerView: 2,
				},
				768: { // md breakpoint (Bootstrap: ≥768px)
					slidesPerView: 3,
				},
				992: { // lg breakpoint (Bootstrap: ≥992px)
					slidesPerView: 4,
				}
			},
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: true,
			},
		});
	</script>
<?php
}, 9999);
