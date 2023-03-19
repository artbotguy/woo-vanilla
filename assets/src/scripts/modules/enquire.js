const enquire = require('enquire.js');

const headerShedule = $('.header-shedule');
const navMenuHead = $('.header-nav-menu__head');
const navMenuModalBody = $('.header-nav-menu .modal-body');

const navMenuIcon = $('.header-nav-menu__icon');
const headerDescription = $('.header-description');
const headerMainMenuLogo = $('.header-main-menu__logo');

const headerActions = $('.header-actions');

const enquireHandler = () => {
	enquire.register('(min-width: 767px)', {
		match() {
			navMenuHead.prepend(headerShedule);
			headerMainMenuLogo.after(headerDescription);
		},

		unmatch() {
			navMenuModalBody.prepend(headerShedule);
			navMenuIcon.after(headerDescription);
		},

		setup() {},

		destroy() {},

		deferSetup: true,
	});
};
export default enquireHandler;
