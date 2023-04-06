class ClientListeners {

  innerWidth = null;

  constructor() {
    this.init()
  }

  init() {
    this.click();
    this.resize();
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
  }

  resize() {
    this.innerWidth = window.innerWidth
    window.addEventListener('resize', function () {
      this.innerWidth = window.innerWidth;
    })
  }
}

export default ClientListeners;