import Swiper, { FreeMode, Navigation, Pagination, Thumbs, Controller } from 'swiper'
import cloneDeep from 'lodash-es/cloneDeep'
import has from 'lodash-es/has'
import get from 'lodash-es/get'

/**
 * Класс пользовательских Свайперов
 */
export default class ClientSwiper {

  /**
   * Опционально добавляется кастомные версии слайдеров, нарпимер из бекенда, добавляется
   * свойство customSliders, имеющее структуру {selector, options}
   */
  sliders = {

    // слайдеры для блоков loop-product`s
    sliderProducts: {
      swipers: [],
      selector: '.wv-slider-products',
      options: {
        modules: [Navigation],
        spaceBetween: 20,
        navigation: {},
        breakpoints: {
          319: {
            slidesPerView: 1.2,
          },
          480: {
            slidesPerView: 1.5,
          },
          600: {
            slidesPerView: 2,
          },
          767: {
            slidesPerView: 2.5,
          },
          991: {
            slidesPerView: 3,
          },
          1199: {
            slidesPerView: 4,
          },
        },
      }
    },

    // Product Images
    sliderProduct: {
      swipers: [],
      selector: '.wv-slider-product',
      options: {
        modules: [Pagination],
        pagination: {},
      }
    },


    // Single product gallery
    sliderThumbsSingleProduct: {
      swipers: [],
      selector: '.wv-slider-thumbs-single-product',
      options: {
        spaceBetween: 10,
        freeMode: true,
        modules: [
          FreeMode
        ],
        breakpoints: {
          319: {
            slidesPerView: 3,
          },
          991: {
            slidesPerView: 4,
          },
        },

      }
    },

    // Single product preview
    sliderPreviewSingleProduct: {
      swipers: [],
      selector: '.wv-slider-preview-single-product',
      options: {
        modules: [Thumbs],
        thumbs: {
          swiper: 'sliderThumbsSingleProduct.swipers[0]'
        },
        spaceBetween: 10,
        slidesPerView: 1,
        watchSlidesProgress: true,
      }
    },

    /**
    * Slider Banners in Homepage
    * 
    * note: меньший из слайдеров не показывается на разрешениях меньше десктопного! 
    * он должен инициироваться, согласно особой логике
    */
    sliderBanners: {
      swipers: [],
      selector: '.wv-slider-banners',
      options: {
        slidesPerView: 1,
        modules: [Navigation, Pagination],
        navigation: {},
        pagination: {},
      },
    },

    // /**
    //  *   slider-advantages
    //  */
    // sliderAdvantages: {
    //   swipers: [],
    //   selector: '.wv-slider-advantages',
    //   options: {
    //     modules: [FreeMode],
    //     spaceBetween: 10,
    //     freeMode: true,
    //     slidesPerView: 4,
    //   }
    // }
  }

  /**
   * Получаемые из бекенда настройки для слайдеров. Ключом является селектор класса,
   * который является одним из селекторов, вместе с .swiper
   */
  customSlidersSettings = {}

  constructor() {
    this.init()
  }

  init() {
    const customSliders = __WooVanilla__.customSliders
    const customSlidersKeys = Object.keys(customSliders)

    /**
     * Не уверен, что реализация перебора для всех эффективна
     */
    customSlidersKeys.forEach(key => {
      if (has(this.sliders, key)) {
        this.sliders[key].customSliders = customSliders[key]
      }
    });

    for (const key in this.sliders) {
      if (Object.hasOwnProperty.call(this.sliders, key)) {
        const slider = this.sliders[key];
        const $sliders = $(slider.selector)
        for (let i = 0; i < $sliders.length; i++) {
          const nodeSlider = $sliders[i];
          let handledOptions = this.optionsHandler(key, nodeSlider, slider.options)
          slider.swipers.push(new Swiper(nodeSlider, handledOptions))
        }
      }
    }
  }

  /**
   * 
   * @param {Object} nodeSlider 
   * @param {Object} options 
   * @param {Array} modules 
   * @returns 
   */
  optionsHandler(sliderKey, nodeSlider, options = {}) {
    /**
    * Не уверен, что глубокое клонирование нужно всегда
    */
    let localOptions = cloneDeep(options)

    if (has(this.sliders[sliderKey], 'customSliders')) {
      nodeSlider.classList.forEach(className => {
        this.sliders[sliderKey].customSliders.forEach(value => {
          if (className === value.selector) {
            localOptions = Object.assign(localOptions, value.options)
          }
        });
      });
    }

    if (has(options, 'modules') && options.modules.length !== 0) {
      if (options.modules.find(el => el.name === 'Navigation')) {
        localOptions.navigation.nextEl = $(nodeSlider).find(".swiper-button-next")[0]
        localOptions.navigation.prevEl = $(nodeSlider).find(".swiper-button-prev")[0]
      }
      if (options.modules.find(el => el.name === 'Pagination')) {
        localOptions.pagination.el = $(nodeSlider).find(".swiper-pagination")[0]
      }
      if (options.modules.find(el => el.name === 'Thumb')) {
        localOptions.thumbs.swiper = get(this.sliders, localOptions.thumbs.swiper)
      }
      if (options.modules.find(el => el.name === 'Controller')) {
        localOptions.controller.control = get(this.sliders, localOptions.thumbs.swiper)
      }
    }

    return localOptions;
  }

  // slider-advantages


}

