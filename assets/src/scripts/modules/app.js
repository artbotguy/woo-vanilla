import ClientEnquire from './enquire';
import ClientBootstrap from './bootstrap';
import ClientListeners from './listeners';
import ClientSwiper from './swiper';

class App {

	constructor() {
		this.init();

		// var swiper = new Swiper(".mySwiper", {
		// 	freeMode: true,
		// 	// autoplay: {
		// 	// 	delay: 2500,
		// 	// 	disableOnInteraction: false,
		// 	// },
		// });

	}

	init() {
		new ClientEnquire();
		new ClientBootstrap();
		new ClientListeners();
		new ClientSwiper();
	}
}

export default App;
