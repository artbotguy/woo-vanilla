const enquire = require('enquire.js');

/**
 * Warning!
 * Использование коллекций элементов в переменных, в частности для получения длинны коллекции
 * может вести к некорректной логике, когда длинна коллекции изменяется, а в переменной остается экземпляр
 * коллекци ДО изменений!
 */
class ClientEnquire {

	instance = null

	constructor() {
		this.init();
	}

	init() {


		// CATALOG
		for (let index = 0; index < 2; index++) {
			const items = $('.wv-widget-area_location_catalog div .berocket_single_filter_widget')
			const el = items[items.length - 1];
			$('.wv-widget-area_location_catalog').append(el)
		}

		// woovanilla_template_popover_info()
		$('.wv-single-product__summary .wv-variation-sub-wrapper').append($('.wv-single-product__summary .wv-popover'))
		$('.wv-single-product__summary .wv-add-to-cart').before($('.wv-single-product__summary .wv-buy-one-click'))


		// /**
		//  * (min-width: 0px)
		//  */
		// enquire.register('(min-width: 0px)', {
		// 	setup() {

		// 	}
		// })

		// after - после элемента
		// append - внутрь элемента в конец
		enquire.register('(min-width: 0px) and (max-width: 768px)', {
			match() {

			},
			setup() {
				$('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub').removeClass('dropdown-menu')
			}
		})

		/**
		 * min-width: 767px
		 */
		enquire.register('(min-width: 767px)', {
			match() {
				/**
				 * Header Top
				 */
				// HT0
				$('.wv-header-top__head').prepend($('.wv-header-shedule'));
				// HT1
				$('.wv-header-top__local-contacts').before($('.wv-menu-navigation_location_header'));
				// HT2 - производит вставку двух элеменов меню, остальные оставляет в .dropdown
				const menuSubItemsNavigationLocationHeader = $('.wv-menu-navigation_location_header .menu-sub > li')
				$('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub').addClass('dropdown-menu')
				for (let index = 0; index < 2; index++) {
					const el = menuSubItemsNavigationLocationHeader[index];
					$('.wv-menu-navigation_location_header').prepend(el)
				}
				// HT3
				$('.wv-header-main-call .dropdown-menu').prepend($('.wv-header-contacts'))


				/**
				 * Menu Main
				 */
				// MM0
				$('.wv-header-bot__wrapper').prepend($('.wv-header-bot-mobile .wv-menu-categories')) // note (!)
				// MM1 - wv-product-search изначально лежит в оболочке, открывающей offcanvas.Catalog, 
				// 		в которой лежит другой wv-product-search. Для десктопа он находится вне оболочки 
				$('.wv-header-main__search').prepend($('.wv-header-main-search__wrapper .wv-product-search'))
				// MM2
				$('.wv-header-main-cart').prepend($('#linkCart'))
				$('.wv-header-main-wishlist').prepend($('#linkWishlist'))
				$('.wv-header-top__local-contacts').append($('#linkMyOrders'))
				$('#linkCart').addClass('wv-link-item_type_circle')
				$('#linkWishlist').addClass('wv-link-item_type_circle')

				/**
				 * FOOTER
				 */
				// Меню навигации и контактов помещаются в меню категорий как элементы li
				$('.wv-menu-categories_location_footer').append($('.wv-menu-navigation_location_footer'))
				$('.wv-menu-categories_location_footer').append($('.wv-menu-contacts_location_footer '))

				/**
			 * Class and atrrs manipulations
			 */
				// headerNavMenu.find('.header-nav-menu__link_info').attr('data-bs-toggle', 'dropdown')
				// headerNavMenu.find('.header-nav-menu__item_info').addClass('dropdown')
				// headerNavMenu.find('.header-nav-menu__link_info').addClass('wv-universal-toggle')
				// headerNavMenu.find('.header-nav-menu__items_type_info').addClass('dropdown-menu')

			},

			unmatch() {
				/**
			 * Header Top
			 */
				// HT0
				$('.wv-offcanvas-header-top .offcanvas-header').prepend($('.wv-header-shedule'))
				// HT1
				$('.wv-offcanvas-header-top .offcanvas-body').prepend($('.wv-menu-navigation_location_header'))
				// HT2
				const menuItemsNavigationLocationHeader = $('.wv-menu-navigation_location_header > li')
				$('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub').removeClass('dropdown-menu')
				for (let index = 0; index < 2; index++) {
					const el = menuItemsNavigationLocationHeader[index];
					$('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub').prepend(el)
				}
				// HT3
				$('.wv-offcanvas-header-top .offcanvas-body').append($('.wv-header-main-call .dropdown-menu .wv-header-contacts'))

				/**
				 * Menu Main
				 */
				// MM0
				$('.wv-header-bot-mobile__body').append($('.wv-header-bot__wrapper .wv-menu-categories'))

				// MM1
				$('.wv-header-main-search__wrapper').prepend($('.wv-header-main__search .wv-product-search'))
				// MM2
				$('.wv-header-mobile-menu__list').append($('#linkCart'))
				$('.wv-header-mobile-menu__list').append($('#linkWishlist'))
				$('.wv-header-mobile-menu__list').append($('#linkMyOrders'))
				$('#linkCart').removeClass('wv-link-item_type_circle')
				$('#linkWishlist').removeClass('wv-link-item_type_circle')

				/**
				 * FOOTER
				 */
				// Меню навигации и контактов возвращаются в общий узел
				$('.wv-footer__main').append($('.wv-menu-navigation_location_footer'))
				$('.wv-footer__main').append($('.wv-menu-contacts_location_footer'))

				/**
				 * Class and atrrs manipulations
				 */
				// headerNavMenu.find('.header-nav-menu__link_info').attr('data-bs-toggle', 'dropdown')
				// headerNavMenu.find('.header-nav-menu__item_info').removeClass('dropdown')
				// headerNavMenu.find('.header-nav-menu__link_info').removeClass('wv-universal-toggle')
				// headerNavMenu.find('.header-nav-menu__items_type_info').removeClass('dropdown-menu')
			},

			setup() {
				// $('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub').removeClass('dropdown-menu')

			},

			destroy() { },

			deferSetup: true,
		});

		/**
		 * (min-width: 767px) and (max-width: 991px)
		 */
		enquire.register('(min-width: 767px) and (max-width: 991px)', {
			match() {
				$('.wv-header-main-search').before($('.wv-header-main-call')) //

				$('.wv-header-main').find('#callLink').attr('data-bs-toggle', 'dropdown')

			},
			unmatch() {
				$('.wv-header-main-search').after($('.wv-header-main-call')) //

				$('.wv-header-main').find('#callLink').removeAttr('data-bs-toggle')
			}
		})

		/**
 * (min-width: 991px)
 */
		enquire.register('(min-width: 991px)', {
			match() {

			},
			unmatch() {

			}
		})

		/**
		 * (min-width: 1199px)
		 */
		enquire.register('(min-width: 1199px)', {
			match() {

				/**
				 * Header Top
				 */
				// HT0
				// HT1
				// HT2
				const menuSubItemsNavigationLocationHeader = $('.wv-menu-navigation_location_header .menu-sub > li')
				const menuMainItem = $('.wv-menu-navigation_location_header .menu-item-has-children')
				// "Отзывы", "Блог" перед "Информация"
				for (let index = 0; index < 2; index++) {
					const el = menuSubItemsNavigationLocationHeader[index];
					menuMainItem.before(el)
				}
				// "Контакты" после "Информация"
				menuMainItem.after(menuSubItemsNavigationLocationHeader[menuSubItemsNavigationLocationHeader.length - 1])

				// CATALOG
				$('.wv-catalog-sidebar').prepend($('.wv-catalog-filter-desktop__content .widget-area'))
			},
			unmatch() {
				/**
				 * Header Top
				 */
				// HT2
				const menuSubNavigationLocationHeader = $('.wv-menu-navigation_location_header .menu-item-has-children .menu-sub')
				// const menuItemsNavigationLocationHeader = $('.wv-menu-navigation_location_header > li')
				for (let index = 0; index < 2; index++) {
					menuSubNavigationLocationHeader.prepend($('.wv-menu-navigation_location_header > li')[$('.wv-menu-navigation_location_header > li').length - 3])
				}
				menuSubNavigationLocationHeader.append($('.wv-menu-navigation_location_header > li')[$('.wv-menu-navigation_location_header > li').length - 1])

				// CATALOG
				$('.wv-catalog-filter-desktop__content').prepend($('.wv-catalog-sidebar .widget-area'))

			}
		})
	}

}
export default ClientEnquire;





