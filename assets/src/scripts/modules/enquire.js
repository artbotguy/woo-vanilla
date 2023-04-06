const enquire = require('enquire.js');

const headerShedule = $('.header-shedule');
const navMenuHead = $('.header-menu-nav__head');
const navMenuOffcanvasBody = $('.header-menu-nav .offcanvas-body');
const navMenuOffcanvasHeader = $('.header-menu-nav .offcanvas-header');

const navMenuIcon = $('.header-menu-nav__icon');


const headerNavMenu = $('.header-nav-menu');
const headerNavMenuItemsTypeMain = $('.header-nav-menu__items_type_main')
const headerNavMenuItemInfo = $('.header-nav-menu__item_info'); // элемент меню navigation - Информация
const headerNavMenuItemsTypeInfo = $('.header-nav-menu__items_type_info'); // меню info 

const headerNavMunuLocalContacts = $('.header-menu-nav__local-contacts');
const headerContacts = $('.header-contacts');

const callHeaderMainMenu = $('.call-header-menu-main')
const callHeaderActionsDropdownMenu = $('.call-header-menu-main__dropdown .dropdown-menu');


const headerMenuCatalogMobileBody = $('.header-menu-catalog-mobile__body');
const headerMenuCatalogItems = $('.header-menu-catalog-items');
const headerMenuCatalog = $('.header-menu-catalog');

const headerActionsMobileList = $('.header-actions__list');
const headerMainMenuHeaderSearchWrapper = $('.search-header-menu-main__wrapper');

const headerMenuMain = $('.header-menu-main')

const searchHeaderMenuMain = $('.search-header-menu-main')


//

const linkMyOrders = $('#linkMyOrders')
const linkCart = $('#linkCart')
const linkWishlist = $('#linkWishlist')

class ClientEnquire {

	instance = null

	constructor() {
		this.init();
	}

	init() {
		// after - после элемента
		// append - внутрь элемента в конец
		// this.instance =
		enquire.register('(min-width: 767px)', {
			match() {
				navMenuHead.prepend(headerShedule);
				$('.logo-header-menu-main').append($('.header-menu-nav__head .header-description'));
				headerNavMenuItemInfo.append(headerNavMenuItemsTypeInfo)

				headerNavMunuLocalContacts.before(headerNavMenu)
				callHeaderActionsDropdownMenu.append(headerContacts)

				headerMenuCatalog.prepend(headerMenuCatalogItems)

				// (4) header-search изначально лежит в оболочке, открывающей offcanvas.Catalog, 
				// 		в которой лежит другой header-search. Для десктопа он находится вне оболочки 
				$('.header-menu-main__search').prepend($('.search-header-menu-main__wrapper .header-search'))

				$('.header-menu-main__cart').prepend(linkCart)
				$('.header-menu-main__wishlist').prepend(linkWishlist)
				$('.header-menu-nav__local-contacts').append(linkMyOrders)
				linkCart.addClass('link-item_type_circle')
				linkWishlist.addClass('link-item_type_circle')




				////
				headerNavMenu.find('.header-nav-menu__link_info').attr('data-bs-toggle', 'dropdown')
				headerNavMenu.find('.header-nav-menu__item_info').addClass('dropdown')
				headerNavMenu.find('.header-nav-menu__link_info').addClass('dropdown-toggle')
				headerNavMenu.find('.header-nav-menu__items_type_info').addClass('dropdown-menu')


			},

			unmatch() {
				navMenuOffcanvasHeader.prepend(headerShedule);
				navMenuIcon.after($('.logo-header-menu-main .header-description'));
				headerNavMenu.append(headerNavMenuItemsTypeInfo)

				navMenuOffcanvasBody.append(headerNavMenu)
				navMenuOffcanvasBody.append(headerContacts)

				headerMenuCatalogMobileBody.append(headerMenuCatalogItems)

				// (4)
				headerMainMenuHeaderSearchWrapper.prepend($('.header-menu-main__search .header-search'))

				headerActionsMobileList.append(linkCart)
				headerActionsMobileList.append(linkWishlist)
				headerActionsMobileList.append(linkMyOrders)
				linkCart.removeClass('link-item_type_circle')
				linkWishlist.removeClass('link-item_type_circle')



				////
				headerNavMenu.find('.header-nav-menu__link_info').attr('data-bs-toggle', 'dropdown')
				headerNavMenu.find('.header-nav-menu__item_info').removeClass('dropdown')
				headerNavMenu.find('.header-nav-menu__link_info').removeClass('dropdown-toggle')
				headerNavMenu.find('.header-nav-menu__items_type_info').removeClass('dropdown-menu')

			},

			setup() { },

			destroy() { },

			deferSetup: true,
		});

		enquire.register('(min-width: 767px) and (max-width: 991px)', {
			match() {
				searchHeaderMenuMain.before(callHeaderMainMenu) //

				////
				headerMenuMain.find('#callLink').attr('data-bs-toggle', 'dropdown')

			},
			unmatch() {
				searchHeaderMenuMain.after(callHeaderMainMenu) //

				////
				headerMenuMain.find('#callLink').removeAttr('data-bs-toggle')

			}
		})

		enquire.register('(min-width: 1199px)', {
			match() {
				headerNavMenuItemInfo.before($('#nav-menu-item-795'))
				headerNavMenuItemInfo.before($('#nav-menu-item-796'))


			},
			unmatch() {
				headerNavMenuItemsTypeInfo.append($('#nav-menu-item-795'))
				headerNavMenuItemsTypeInfo.append($('#nav-menu-item-796'))
			}
		})
	}

}
export default ClientEnquire;





