<section class="work_slider">
    <div class="container-xl">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">Slide 1</div>
                <div class="swiper-slide">Slide 2</div>
                <div class="swiper-slide">Slide 3</div>
                <div class="swiper-slide">Slide 4</div>
                <div class="swiper-slide">Slide 5</div>
                <div class="swiper-slide">Slide 6</div>
                <div class="swiper-slide">Slide 7</div>
                <div class="swiper-slide">Slide 8</div>
            </div>

            <!-- Pagination -->
            <div class="swiper-pagination"></div>

            <!-- Navigation Buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper('.mySwiper', {
    slidesPerView: 1,  // default view for xs (extra small)
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
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
    loop: true
  });
</script>