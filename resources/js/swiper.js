// import Swiper bundle with all modules installed
import Swiper from 'swiper/bundle';

// import styles bundle
import 'swiper/css/bundle';

const swiper = new Swiper(".prokerImgSwiper", {
  slidesPerView: 1,
  allowTouchMove: false,
  loop: true,
  spaceBetween: 20,
  centeredSlides: true,
  autoplay: true,
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 2,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 4,
      spaceBetween: 10,
    },
  },
});

const descSwiper = new Swiper(".prokerDescriptionSwiper", {
  slidesPerView: 1,
  allowTouchMove: false,
  loop: true,
  spaceBetween: 20,
  centeredSlides: true,
  autoplay: true,
});