class ClientListeners {

  innerWidth = null;

  constructor() {
    this.init()
  }

  init() {
    this.click();
    this.resize();
    // $('#linkCart').trigger('side_cart_open');
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

    $('.quantity__button').click(function (e) {
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

    })


  }

  resize() {
    this.innerWidth = window.innerWidth
    window.addEventListener('resize', function () {
      this.innerWidth = window.innerWidth;
    })
  }
}

export default ClientListeners;