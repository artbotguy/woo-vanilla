import Modal from "bootstrap/js/src/modal";
import Dropdown from "bootstrap/js/src/dropdown";
import Offcanvas from "bootstrap/js/src/offcanvas";

class ClientBootstrap {
	constructor() {
		// console.log($.noConflict());
		// $.noConflict();
		$(window).on('load', function () {
			// var navModal = new Offcanvas(document.getElementById('offcanvasCatalog'), {})
			// navModal.toggle()
			// console.log($('#navModal'));
			// $('#offcanvasNav').offcanvas('toggle');
		});

		// 	const myModal = new Modal(document.getElementById('navModal'),
		// 	// options
		// )


		// const modal = new Modal('#navModal',
		// 	// options
		// )
		// $('.header-nav-menu__icon').click(function () {
		// 	modal.toggle()
		// })
	}
}

export default ClientBootstrap