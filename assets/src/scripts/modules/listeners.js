class ClientListeners {

  innerWidth = null;

  self = null

  constructor() {
    this.init()
  }

  init() {
    this.click();
    this.resize();
    // $('#linkCart').trigger('side_cart_open');
    this.load();
    this.scroll()
  }

  click() {
    // логика элементов menu-catalog для mobile и desktop
    $('.menu-main__item').click((e) => {
      // if (this.innerWidth < 767) {
      //   if (e.target.localName === 'span') {
      //     e.preventDefault();
      //     $(e.currentTarget).toggleClass('menu-main__item_active')
      //   }
      // }
    })

    /**
     * Данная логика используется в:
     *  - Single Product - изменение значаения инпута => submit
     *  - Cart Item - НЕ РАБОТАЕТ - изменение значения кнопками не запускает
     *    this.$modal.on('change', '.xoo-wsc-qty', this.changeInputQty.bind(this));
     *    Также не работает запуск $input.trigger()
     */
    $(document).on('click', '.wv-quantity__button', function (e) {
      e.preventDefault();
      const $input = $(this).parent().find('input')
      const operator = $(this).data().wvChangeQtyOperator;
      if (operator === '-') {
        if ($input.val() <= $input.attr('min')) return
      }
      if (operator === '+') {
        /**
         * Логика должна основываться на атрибуте max, но он не устанавливается.
         * Тем не менее логика WC, препятвующая добавлению бОльшего количества товаров присутствует
         */
        if ($input.attr('max') ? $input.val() >= $input.attr('max') : false) return
      }
      $input.val(eval($input.val() + operator + '1'))
      // .trigger('change')

    })

    $('.copy-clipboard__button').click(function (e) {
      e.preventDefault()
      const $input = $(this).parent().find('input')
      // $input.select();
      navigator.clipboard.writeText($input.val());
    })

    $('.woocommerce-loop-product__preview-btn').click(function (e) {
      $(this).parents('.woocommerce-loop-product').toggleClass('woocommerce-loop-product_visible_preview')
    })

    // $('#linkCall').click(function (e) {
    //   e.preventDefault()

    // })
  }

  resize() {
    this.innerWidth = window.innerWidth
    window.addEventListener('resize', function () {
      this.innerWidth = window.innerWidth;
    })
  }

  load() {


    const $placeholders = $('.placeholder')
    for (let i = 0; i < $placeholders.length; i++) {
      const placeholder = $placeholders[i];
      placeholder.classList.remove('placeholder')
      placeholder.parentNode.classList.remove('placeholder-wave')
    }

    // setTimeout(() => {
    //   $('.wv-header-bot').scrollLeft(500)
    // }, 3000)

    // setTimeout(() => {
    //   $('.wv-header-bot').scrollLeft(-500)
    // }, 6000)

    // this.setTimeout(() => {
    //   $('.wv-advantages').scrollLeft(1000)
    // }, 3000)

    // this.setTimeout(() => {
    //   $('.wv-advantages').scrollLeft(-1000)
    // }, 6000)
  }

  scroll() {

  }
}

export default ClientListeners;