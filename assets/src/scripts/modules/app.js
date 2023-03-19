import enquireHandler from './enquire';
import modal from "bootstrap/js/src/modal";
class App {
	constructor() {
		this.el = document.querySelector('.el');

		this.listeners();
		this.init();
	}

	init() {
		enquireHandler();
		// console.log($.noConflict());
		// $.noConflict();
		// $(window).on('load', function () {
		// 	console.log($('#navModal'));
		// 	$('#navModal').modal('show');
		// });

		var navModal = new modal(document.getElementById('navModal'), {})
		navModal.toggle()
	}

	listeners() {
		if (this.el) {
			this.el.addEventListener('click', this.elClick);
		}
	}

	elClick(e) {
		e.target.classList.add('text-light-grey');
		e.target.addEventListener('transitionend', (event) =>
			'color' === event.propertyName
				? event.target.classList.remove('text-light-grey')
				: ''
		);
	}
}

export default App;
