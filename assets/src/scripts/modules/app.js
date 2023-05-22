import ClientEnquire from './enquire';
import ClientBootstrap from './bootstrap';
import ClientListeners from './listeners';
import ClientSwiper from './swiper';
import ClientChoises from './choises'
class App {

	constructor() {
		this.init();


	}

	init() {
		window.addEventListener('load', function () {
			$('p:empty').remove();

			new ClientEnquire();
			new ClientBootstrap();
			new ClientListeners();
			new ClientSwiper();
			new ClientSwiper();
			new ClientChoises();
		})


	}
}



export default App;
