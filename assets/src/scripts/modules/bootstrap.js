import Modal from "bootstrap/js/src/modal";
import Dropdown from "bootstrap/js/src/dropdown";
import Offcanvas from "bootstrap/js/src/offcanvas";
import Popover from "bootstrap/js/src/popover";
import Collapse from "bootstrap/js/src/collapse";
// import Toast from "bootstrap/js/src/toast";

class ClientBootstrap {
	constructor() {
		const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
		const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new Popover(popoverTriggerEl))
		// console.log($.noConflict());
		// $.noConflict();
		var offcanvas = new Offcanvas(document.getElementById('offcanvasWishlist'), {})
		// offcanvas.toggle()
	}
}

export default ClientBootstrap