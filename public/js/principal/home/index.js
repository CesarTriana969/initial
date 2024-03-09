
/* ============= Main Home Slider ============= */

const mainHomeSlider = new Swiper('.main__home-slider', {
  spaceBetween: 30,
  effect: 'fade',
  autoplay: {
    delay: 5000,
  },
  // autoplay:false,
  pagination: {
    el: '.main__home-slider--pagination',
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
});


/* ============= Top Sellers Home Slider ============= */

const topSellersHomeSlider = new Swiper('.top__sellers-home--slider', {
  autoplay: {
    delay: 2000,
  },
  // autoplay:false,
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: ".top__sellers-home--next",
    prevEl: ".top__sellers-home--prev",
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1.2,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2.2,
      spaceBetween: 10,
    },
    "@1.00": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
})


/* ============= Our Categories Home Slider ============= */

const ourCategoriesHomeSlider = new Swiper('.our__categories-home--slider', {
  autoplay: {
    delay: 2000,
  },
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: ".our__categories-home--next",
    prevEl: ".our__categories-home--prev",
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1.2,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2.2,
      spaceBetween: 10,
    },
    "@1.00": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
})


/* ============= Our Best Deals Slider ============= */

const ourBestDealsSlider = new Swiper('.our__best-deals--slider', {
  autoplay: {
    delay: 2000,
  },
  // autoplay:false,
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: ".our__best-deals--next",
    prevEl: ".our__best-deals--prev",
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1.2,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2.2,
      spaceBetween: 10,
    },
    "@1.00": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
})


/* ============= Our Best Details Slider ============= */

const ourBestDetailsSlider = new Swiper('.our__best-details--slider', {
  autoplay: {
    delay: 2000,
  },
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: ".our__best-details--next",
    prevEl: ".our__best-details--prev",
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1.2,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2.2,
      spaceBetween: 10,
    },
    "@1.00": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
})


/* ============= Our Best Details Slider ============= */

const reviewsSlider = new Swiper('.reviews__slider', {
  autoplay: {
    delay: 2000,
  },
  pagination: {
    el: '.swiper-pagination',
  },
  navigation: {
    nextEl: ".reviews__next, .swiper-button-next-top",
    prevEl: ".reviews__prev, .swiper-button-prev-top",
  },
  breakpoints: {
    "@0.00": {
      slidesPerView: 1.2,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 2.2,
      spaceBetween: 10,
    },
    "@1.00": {
      slidesPerView: 3,
      spaceBetween: 10,
    },
    "@1.50": {
      slidesPerView: 3,
      spaceBetween: 10,
    },
  },
})