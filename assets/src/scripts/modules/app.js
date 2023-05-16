import ClientEnquire from './enquire';
import ClientBootstrap from './bootstrap';
import ClientListeners from './listeners';
import ClientSwiper from './swiper';
import ClientChoises from './choises'
// import ClientGoogleMap from './google-map'
class App {

	constructor() {
		this.init();
	}

	init() {
		$('p:empty').remove();

		new ClientEnquire();
		new ClientBootstrap();
		new ClientListeners();
		new ClientSwiper();
		new ClientSwiper();
		new ClientChoises();
		// new ClientGoogleMap();
	}
}



export default App;
