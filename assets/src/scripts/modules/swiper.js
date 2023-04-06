import Swiper, { FreeMode, Navigation, Pagination } from 'swiper'
export default class ClientSwiper {
  constructor() {
    this.init()
  }

  init() {


    const productsSliders = $('.slider-products .swiper')
    for (let i = 0; i < productsSliders.length; i++) {
      const nodeSlider = productsSliders[i];
      const slider = new Swiper(nodeSlider, {
        modules: [Navigation, FreeMode],
        spaceBetween: 20,
        slidesPerView: 2,
        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
        freeMode: true,

        breakpoints: {
          319: {
            slidesPerView: 1.2,
          },
          768: {
            slidesPerView: 2.5,
          },
          992: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      })
    }

    const productSliders = $('.slider-product')
    for (let i = 0; i < productSliders.length; i++) {
      const nodeSlider = productSliders[i];
      const slider = new Swiper(nodeSlider, {
        // direction: "vertical",
        modules: [Pagination],
        pagination: {
          el: '.swiper-pagination',
        },
      })

    }


  }
}